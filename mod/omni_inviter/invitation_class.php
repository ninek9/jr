<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt <brett.profitt@gmail.com 
 */

/**
 * Add a few more methods to this class.
 * Make sure the delete function respects the reportedcontent tie-ins.
 * @author Brett Profitt
 *
 */
class Invitation extends ElggObject {
	/**
	 * Set up the subtype.
	 * @see engine/lib/ElggObject#initialise_attributes()
	 */
	protected function initialise_attributes() {
		parent::initialise_attributes();
		$this->attributes['subtype'] = 'invitation';
		
		// method of invititation
		$this->method = '';
		
		// invited info
		$this->invited_name = '';
		$this->invited_account_id = '';
		
		// inviter message
		$this->inviter_message = '';
		
		// special code.
		$this->code = oi_generate_code();
		
		// There is NO WAY AT ALL AHHHHH to let logged out users 
		// access anything other than ACCESS_PUBLIC.
		// The amount of hacking required to make this work is
		// incredible.
		$this->access_id = ACCESS_PRIVATE;
		
		// how many times this message has been sent.
		$this->sent_count = 0;
		
		// don't allow over-spamming.
		$this->sent_max = 3;
		
		// how many times we've attempted to send.
		$this->send_attempts = 0;
		
		$this->send_attempted_on = 0;
		
		// @todo max or per-method / invite max?
		// how many times to attempt to send
		//$this->send_attempts_max = 3;
	}

	/**
	 * Create or load an invitation object.
	 * 
	 * @param $guid of invitation object
	 * @param $method Method to invite.  Must be installed and enabled.
	 * @param $params an array of params to set.
	 * @return unknown_type
	 */
	public function __construct($guid=null, $invited_name='', $invited_account_id='', $inviter_message='', $method='', $params=array()) {
		parent::__construct($guid);
		
		if ($guid) {
			// stop processing...loaded from parent.
			return true;
		}

		if (!in_array($method, oi_get_supported_methods(false, true))) {
			return false;
		}
		
		$this->method = $method;
		$this->invited_name = $invited_name;
		$this->invited_account_id = $invited_account_id;
		$this->inviter_message = $inviter_message;
		
		// set up passed params
		foreach ($params as $param=>$value) {
			$this->$param = $value;
		}
		
		// set up the invitation method's callbacks.
		$method_details = oi_get_method_details($this->method);
		
		$callbacks = array(
			'new_invitation_callback',
			'send_invitation_callback', 
			'use_invitation_callback', 
			'post_register_callback'
		);
		
		foreach ($callbacks as $callback) {
			if (!function_exists($method_details[$callback])) {
				print "RETURNING FOR $callback = " . $method_details[$callback];
				return false;
			}
			$this->$callback = $method_details[$callback];
		}
		
		// save to get a GUID for all the access hacks.
		$this->save();
		
		// prepare stock message.
		$this->prepare_stock_messages();
		
		// create public 'sent' and 'invited_guid' MD
		// this MD will be updated after successful registration
		// by a new user who cannot see the invitation.
		
		// this MUST be done after a save.
		// saving reverts public metadata to private metadata.
		// THIS IS A HUGE NASTY HACK. 
		create_metadata($this->getGUID(), 'sent_count', 0, $value_type='integer', $owner_guid='', ACCESS_PUBLIC);
		create_metadata($this->getGUID(), 'invited_guid', false, $value_type='integer', $owner_guid='', ACCESS_PUBLIC);

		// do method init for object.
		if ($init = $this->new_invitation_callback) {
			$init($this);
		}
	}
	
	/**
	 * Sends an invite via the specified method
	 * 
	 * @return bool on success.
	 */
	public function send() {
		$this->send_attempts++;
		$this->send_attempted_on = time();
		
		// deal with disabled methods.
		// cron will not get here, but manual send might.
		// @todo MUST strtolower() this because of case issues with metadata
		if (!in_array(strtolower($this->method), oi_get_supported_methods(false, true))) {
			return false;
		}
		
		// see if we're at send_max.
		if ($this->sent_count >= $this->sent_max) {
			// @todo this should just return false.
			//register_error(sprintf(elgg_echo('oi:errors:over_max_sent_count'), $this->sent_max));
			return false;
		}

		// prepare the message.
		// do it again here in case the admin changes the message between queuing and send.
		// can't do this because of the MD access issues.
		//$this->prepare_stock_messages();
		
		// prep for sending.
		$send_func = $this->send_invitation_callback;
		
		if (!function_exists($send_func)) {
			$this->log('Unknown send function...method disabled?');
			return false;
		}
		
		if ($send_func($this)) {
			$this->sent_on = time();
			$this->sent_count++;
			return true;
		} else {
			return false;
		}
	}
	
	/*
	 * Replaces vars with their actual values.
	 * 
	 * return bool on success
	 */
	public function prepare_stock_messages() {
		$owner = get_entity($this->owner_guid);
		
		$overrides = array(
			'%INVITED_NAME%' => ucwords($this->invited_name),
			'%INVITED_ACCOUNT_ID%' => $this->invited_account_id,
			'%USER_NAME%' => $owner->username,
			'%USER_FULLNAME%' => $owner->name,
			'%USER_EMAIL%' => $owner->email,
			'%USER_MESSAGE%' => $this->inviter_message,
			'%OI_JOIN_LINK%' => oi_make_join_link($this->getGUID()),
			'%OI_INVITATION_ID%' => oi_make_join_link($this->getGUID(), 'id'),
			'%OI_INVITATION_CODE%' => oi_make_join_link($this->getGUID(), 'code'),
		);
		
		// these are here--might as well use them to prevent complicated db calls.
		$subject = get_plugin_setting('message_subject', 'omni_inviter');
		$body = get_plugin_setting('message_body', 'omni_inviter');
		
		$this->title = oi_format_string($subject, $overrides);
		$this->description = oi_format_string($body, $overrides);
		
		return $this->save();
	}
	
	/**
	 * Creates a log for this invitation.
	 * 
	 * @param $msg
	 * @return unknown_type
	 */
	public function log($msg) {
		$old_log = $this->log;
		$this->log = $old_log . "\n" . date('Y-m-d H:i:s') . ': ' . $msg;
	}
}