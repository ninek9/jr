<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */

require_once 'omni_lib.php';

function oi_init() {
	global $CONFIG;
	
	require_once 'invitation_class.php';
	
	register_entity_type('object', 'invitation');
	run_function_once('oi_run_once');
	
	// omni inviter widget.
	// @todo disabling this if users have already added it won't make
	// the widget "break"
	// need to do some conditional on the view extensions and put the views
	// in a non-standard place to force it to look broken.
	if (get_plugin_setting('enable_widget', 'omni_inviter')) {
		add_widget_type('omni_inviter', elgg_echo('oi:widget:name'), elgg_echo('oi:widget:description'));
	}
	
	register_page_handler('omni_inviter', 'oi_page_handler');
	
	register_action('omni_inviter/invite', false, dirname(__FILE__) . '/actions/invite.php');
	register_action('omni_inviter/send', false, dirname(__FILE__) . '/actions/send.php');
	register_action('omni_inviter/delete', false, dirname(__FILE__) . '/actions/delete.php');
	
	extend_view('css', 'oi/css');
	// show the "I have an invitation" link at the bottom.
	extend_view('account/forms/register', 'oi/register_extend');

	// permissions checks for invitations.
	// used so the invited user can see the invitation too.
	register_plugin_hook('permissions_check', 'object', 'oi_permissions_check');
	
	// call cron to send invites
	$period = get_plugin_setting('message_cron', 'omni_inviter');
	if ($period != 'disabled') {
		register_plugin_hook('cron', $period, 'oi_cron');
	}
	
	// call method's post reg
	register_elgg_event_handler('create', 'user', 'oi_call_post_registration');
	
	// Load menu
	// add for friends and member listings
	// check for enabled methods.
	$methods = oi_get_supported_methods(false, true);
	
	if (is_array($methods) && count($methods) > 0 &&
		get_context() == "friends" || 
		get_context() == "friendsof" || 
		get_context() == "collections") {
		if (isloggedin()) {
			add_submenu_item(elgg_echo('oi:invite'), $CONFIG->wwwroot . 'pg/omni_inviter/invite');
		}
	}
}

/**
 * Set up subtype
 * @return unknown_type
 */
function oi_run_once() {
	add_subtype('object', 'invitation', 'Invitation');
}

/**
 * Draw menus for pages
 * //@todo figure out how to add a 'Tools Administration" link
 * // above this.
 * 
 * @return unknown_type
 */
function oi_pagesetup() {
	global $CONFIG;
	
	if (get_context() == 'admin' && isadminloggedin()) {
		add_submenu_item(elgg_echo('oi:omni_inviter'), $CONFIG->wwwroot . 'pg/omni_inviter/admin');
		//add_submenu_item(elgg_echo('demerits:add_demerits'), $CONFIG->wwwroot . 'pg/demerits/');
	}
	
	//add submenu options
	if (get_context() == 'oi_admin') {
		if ((page_owner() == $_SESSION['guid'] || !page_owner()) && isloggedin()) {
			$stats = elgg_echo('oi:admin:stats');
			$invitations = elgg_echo('oi:admin:invitations');
			// do searching by username here...
			
			add_submenu_item($stats, $CONFIG->wwwroot . "pg/omni_inviter/admin/stats");
			add_submenu_item($invitations, $CONFIG->wwwroot . "pg/omni_inviter/admin/view_invitations/");
		}
	}
}


/**
 * OI Pagehandler
 * @todo pull this insanity out into functions.
 * 
 * @param $page
 * @return unknown_type
 */
function oi_page_handler($page) {
	global $CONFIG;

	// @todo for non-logged in users.
	if (array_key_exists('guid', $_SESSION)) {
		set_page_owner($_SESSION['guid']);
	}
	
	// @todo: add an admin section with stats.
	// sent vs unset, used invites vs unused.
	
	if (!is_array($page) || count($page)<1) {
		$page = array (0 => 'invite');
	}

	// all but join require login.
	if ($page[0] != 'join') {
		gatekeeper();
	}
	
	switch ($page[0]) {
		case 'js':
			echo elgg_view('oi/js');
			exit;
			break;
		case 'css':
			echo elgg_view('oi/css');
			exit;
			break;
			
		case 'ajax':
			// see which ajax we're doing.
			switch ($page[1]) {
				case 'method_content':
					$method = $page[2];
					
					if (in_array($method, oi_get_supported_methods(false, true))) {
						$file = dirname(__FILE__) . '/methods/' . $method . '/content.php';
						if (is_file($file)) {
							include_once $file;
						}
						else {
							print 'error with ' . $file;
						}
					} else {
						echo elgg_echo('oi:errors:unknown_method');
					}
					
					break;
				default:
					echo elgg_echo('oi:errors:unknown_method');
					break;
			}
			
			exit;
			break;
		
		default:
		case 'invite':
			$title = elgg_echo('oi:invite');
			$content = elgg_view('oi/invite');
			$body = elgg_view_layout('two_column_left_sidebar', $area1, $content);

			break;
		
		case 'join':
			// only for new users.
			if (isloggedin()) {
				forward();
			}
			
			$code = get_input('invitation_code', false);
			$id = get_input('invitation_id', false);
			
			$context = get_context();
			
			// sudo to admin to grab entity.
			oi_su();
			$invite = get_entity($id);
			oi_su(true);
			
			set_context('oi_join');
			
			// if there is no id or code, let them enter one...
			if (!$id) {
				$content = elgg_view('oi/invitation_input', array('id'=>$id, 'code'=>$code));
				$body = elgg_view_layout('one_column', $content);
			} 
			// check if guid and code match.  if not, display entry for code and link to redirect
			// to normal reg page.
			//elseif (!$invite = oi_get_entity($id) OR $invite->code != $code) {
			elseif (!$invite OR $invite->code != $code) {
				$content = elgg_view('oi/invitation_input', array('id'=>$id, 'code'=>$code));
				
				$content .= '<h2 style="padding: 1em;">' . elgg_echo('oi:errors:invalid_code') . '</h2><br />';
				//$content .= elgg_view('account/forms/register', array('friend_guid' => get_input('friend_guid', 'invitecode' => $invitecode));
				$content .= elgg_view('account/forms/register');
				
				$body = elgg_view_layout('one_column', $content);
			} 
			// error for used invitation
			elseif ($invite->used == true) {
				$content = elgg_view('oi/invitation_input', array('id'=>$id, 'code'=>$code));
				
				$content .= '<h2 style="padding: 1em;">' . elgg_echo('oi:errors:used_code') . '</h2><br />';
				//$content .= elgg_view('account/forms/register', array('friend_guid' => get_input('friend_guid', 'invitecode' => $invitecode));
				$content .= elgg_view('account/forms/register');
				
				$body = elgg_view_layout('one_column', $content);
				
			}
			// print the registration form
			else {
				$invite->clicked_on = time();
				system_message(elgg_echo('oi:invitation_info_accepted'));
								
				// store invitation guid for later
				$_SESSION['oi_join'] = true;
				$_SESSION['oi_invitation_guid'] = $invite->guid;
				$_SESSION['oi_invitation_code'] = $invite->code;
				
				$show_form = true;
				
				// check if we can use the account_id as the email
				if (is_email_address($invite->invited_account_id)) {
					set_input('e', $invite->invited_account_id);
				}
				
				set_input('n', $invite->invited_name);
				
				// call method's setup
				$func = $invite->use_invitation_callback;
				
				if (function_exists($func)) {
					oi_su();
					// if function returns FALSE it means to stop.
					// it will handle the form display
					if (!$func($invite)) {
						$show_form = false;
					}
					oi_su(true);
				}
				
				if ($show_form) {
					// @todo create a custom registration page.
					// ext normal reg page if not in context oi_join.
					
					// add a link "I have an invitation id and code"
					$friend_guid = (int) get_input('friend_guid', 0);
					$invitecode = get_input('invitecode');
					$title = elgg_echo('register');
					//$body = elgg_view("oi/register", array('friend_guid' => $friend_guid, 'invitecode' => $invitecode));
					$body = elgg_view('account/forms/register', array('friend_guid' => $friend_guid, 'invitecode' => $invitecode));
				}
			}
			
			set_context($context);
			
			break;
			
			
		case 'admin':
			admin_gatekeeper();
			$old_context = get_context();
			set_context('oi_admin');
			switch($page[1]) {
				default:
				case 'stats':
					require_once 'stats_lib.php';
					
					$title = elgg_echo('oi:stats');
					$content = elgg_view('oi/stats');
					$content_title = elgg_view_title($title);
					$body = elgg_view_layout('two_column_left_sidebar', '', '' . $content_title . $content);
					break;
				
				// single invite
				//case 'view_invite':
					
					break;
				
				// invites per user / all
				case 'view_invitations':
					if (array_key_exists('2', $page) AND $user = get_user_by_username($page[2])) {
						$title = sprintf(elgg_echo('oi:admin:invites:list_user'), $user->username);
						$guid = $user->getGUID();
					} else {
						$title = elgg_echo('oi:admin:invites:list_all');
						$guid = false;
						if (array_key_exists('2', $page) && !empty($page[2])) {
							register_error(elgg_echo('oi:errors:unknown_user'));
						}
					}
					
					// @todo move this to the side bar and make it
					// check boxes of what to show.
					// all, sent, used, not sent, 
					// @todo bahh this will require more effort than I want right now.
					// you can't send a zero as a match for metadata_multi().
					//$view = (array_key_exists('3', $page)) ? $page[3] : 'all';
					
//					$types = array('sent', 'used', 'stalled', 'error');
//					
//					$constraints = array();
//					
//					foreach ($types as $type) {
//						$show = get_input('oi_show_' . $type);
//						if ($show) {
//							switch ($type) {
//								case 'sent':
//									break;
//							}
//						}
//					}
//
//					switch($filter) {
//						case 'sent':
//							$type = array('sent'=>1);
//							break;
//						case 'unsent':
//							// really need a !=
//							$type = array('sent'=>0);
//							break;
//						case 'used':
//							$type = array('used'=>1);
//							break;
//						case 'unused':
//							$type = array('used'=>0);
//							break;
//						case 'all':
//						default:
//							$content = list_entities('object', 'invitation', $guid, 10, true, false, true);
//					}
//					
//					if (!isset($content)) {
//						$content = list_entities_from_metadata_multi($type, 'object', 'invitation', $guid);
//					}
					
					$content = list_entities('object', 'invitation', $guid, 10, true, false, true);
					
					if (!$content) {
						$content = '<div class="contentWrapper">' . elgg_echo('oi:admin:no_invitations') . '</div>';
					}
					
					$content_title = elgg_view_title($title);
					$body = elgg_view_layout('two_column_left_sidebar', '', '' . $content_title . $content);
					break;
			}
			set_context($old_context);

			break;
	}
	
	echo page_draw($title, $body);
}

/**
 * Check permissions for invitations.
 * 
 * @param $hook_name
 * @param $entity_type
 * @param $return_value
 * @param $parameters
 * @return unknown_type
 */
function oi_permissions_check($hook_name, $entity_type, $return_value, $parameters) {
	if ($parameters['entity']->getSubtype() == 'invitation') {
		$invite = $parameters['entity'];

		// allow access for joining
		if (get_context() == 'oi_join' || get_context() == 'oi_cron') {
			return true;
		}
		 
		// allow access if logged in user was the one invited
		elseif ($user = get_loggedin_user() AND $user->getGUID() == $invite->invited_user_guid) {
			return true;
		}
		
		// let the permissions go through as normal for everyone else.
		else {
			return null;
		}
	}
	return null;
}

/**
 * Sends invites in batches to avoid server congestion.
 * 
 * @return Bool on success
 */
function oi_cron() {
	$max = get_plugin_setting('message_limit', 'omni_inviter');
	$attempt_max = get_plugin_setting('max_send_attempts', 'omni_inviter');
	
	// avoid OOM errors on very high number of messages by only
	// processing 25 at a time.
	$limit = 25;
	$count = 0;
	$offset = 0;
	
	set_context('oi_cron');
	oi_su();

	$md_arr = array(
		array('name' => 'sent_count', 'operand' => '=', 'value' => '0'),
		array('name' => 'send_attempts', 'operand' => '<', 'value' => $attempt_max)
	);
	
	$invites = oi_get_entities_from_metadata_by_value($md_arr, 'object', 'invitation', false, '', '', $limit, $offset);
	$result = (is_array($invites));
	while(is_array($invites) && count($invites) >= 1 && $count < $max) {
		foreach ($invites as $invite) {
			$sent = $invite->send();
			if ($sent) {
				$count++;
			}
			$result = $result && $sent;
		}
		
		$offset += $limit;
		$invites = oi_get_entities_from_metadata_by_value($md_arr, 'object', 'invitation', false, '', '', $limit, $offset);
	}
	oi_su(true);
	
	echo "Sent $count invitations\n";
	return $result;
}

/**
 * Calls an invitation's post_registration callback.
 * 
 * @param $event
 * @param $object_type
 * @param $object
 * @return unknown_type
 */
function oi_call_post_registration($event, $object_type, $object) {
	// only make the call if we're using an invitation
	if (array_key_exists('oi_join', $_SESSION) && $_SESSION['oi_join'] == true){
		$guid = $_SESSION['oi_invitation_guid'];
		$code = $_SESSION['oi_invitation_code'];
		
		// cannot use standard get_entity() because of annoying access problem.
		oi_su();
		if ($invite = get_entity($guid) AND $code = $invite->code) {
			
			if (get_plugin_usersetting('notify_on_invite_use', $invite->owner_guid)) {
				global $CONFIG;
				
				// check in case using an old invite and the user no longer exists...
				if ($user = get_entity($invite->owner_guid)) {
					$subj = sprintf(elgg_echo('oi:message:invited_join_subject'), $invite->invited_name, $CONFIG->site->name);
					$body = sprintf(elgg_echo('oi:message:invited_join_body'), $invite->invited_name, $CONFIG->site->name);
					notify_user($user->getGUID(), $invite->getGUID(), $subj, $body);
				}
			}
			
			// make sure we have permissions
			$context = get_context();
			set_context('oi_join');
			
			$func = $invite->post_register_callback;
			if (function_exists($func)) {
				if (!$used = $func($invite)) {
					set_context($context);
					return false;
				}
				// save the new user's guid and mark as sent.
				//oi_set_metadata($invite->guid, 'used', true, null, ACCESS_PUBLIC);
				//oi_set_metadata($invite->guid, 'invited_guid', $object->getGUID(), null, ACCESS_PUBLIC);
				$invite->used = true;
				$invite->used_on = time();
				$invite->invited_guid = $object->getGUID();
				
				set_context($context);
				oi_su(true);
				return true;
			}
			else {
				register_error(elgg_echo('oi:errors:invalid_post_reg_callback'));
				oi_su(true);
				return false;
			}
		} else {
			register_error(elgg_echo('oi:errors:invalid_post_reg_invite'));
			oi_su(true);
			return false;
		}
	}
	oi_su(true);
	return true;
}

register_elgg_event_handler('pagesetup', 'system', 'oi_pagesetup');
register_elgg_event_handler('init', 'system', 'oi_init');
