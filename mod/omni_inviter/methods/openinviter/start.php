<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @subpackage openinviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009  
 */

$oi_author = 'Brett Profitt';
$oi_description = elgg_echo('oi:method:openinviter:description');
$oi_invite_who = elgg_echo('oi:method:openinviter:invite_who');

// used to print method-specific settings.
$oi_settings_callback = 'oi_settings_openinviter';

// used to print method-specific settings for users
$oi_usersettings_callback = 'oi_usersettings_openinviter';

// Called during invitation creation
$oi_new_invitation_callback = 'oi_new_invitation_openinviter';

// used to send messages for this type of invite.
$oi_send_invitation_callback = 'oi_send_invitation_openinviter';

// Called during invitation creation and used during invitation use (registration)
$oi_use_invitation_callback = 'oi_use_invitation_openinviter';

// called after invited user successfully registers.
$oi_post_register_callback = 'oi_post_register_openinviter';

/**
 * Sets defaults and return settings config for OI settings page.
 *
 * @return str
 */
function oi_settings_openinviter() {
	global $CONFIG;
	// make sure we have a cache dir.
	if (!is_dir($CONFIG->dataroot . 'openinviter')) {
		mkdir($CONFIG->dataroot . 'openinviter');
	}
	
	// check that we have a correct bundle
	//if (!is_dir(__FILE__) . '/vendor/OpenInviter') {
	if (!is_file(dirname(__FILE__) . '/vendor/OpenInviter/openinviter.php')) {
		return '<span style="color: #f00;">' . elgg_echo('oi:method:openinviter:incorrectly_installed') . '</span>';
	}
	
	if (is_file(dirname(__FILE__) . '/vendor/OpenInviter/postinstall.php')) {
		return '<span style="color: #f00;">' . elgg_echo('oi:method:openinviter:remove_postinst') . '</span>';
	}
	
	// check for dom ext
	if (!extension_loaded('dom') || !class_exists('DOMDocument')) {
		return '<span style="color: #f00;">' . elgg_echo('oi:method:openinviter:no_dom_ext') . '</span>';  
	}

	// check for curl exts and wget binary.
	$curl_good = (extension_loaded('curl') && function_exists('curl_init'));
	exec('wget --version', $output, $wget_status);
	// unix processes return error code 0 on success.
	$wget_good = ($wget_status == 0);
	
	$transport_array = array();
	$transport = '';
	
	if ($wget_good) {
		$transport = 'wget';
		$transport_array['wget'] = 'wget';
	}
	
	// prefer curl.
	if ($curl_good) {
		$transport = 'curl';
		$transport_array['curl'] = 'curl';
	}
	
	if (!$transport) {
		return '<span style="color: #f00;">' . elgg_echo('oi:method:openinviter:no_transport') . '</span>';
	}
	
	if (!get_plugin_setting('openinviter_transport', 'omni_inviter')) {
		set_plugin_setting('openinviter_transport', $transport, 'omni_inviter');
	}
	
	$username_input = elgg_view('input/text', array(
		'internalname' => 'params[openinviter_username]',
		'value' => get_plugin_setting('openinviter_username', 'omni_inviter')
	));

	$code_input = elgg_view('input/text', array(
		'internalname' => 'params[openinviter_key]',
		'value' => get_plugin_setting('openinviter_key', 'omni_inviter')
	));
		
	$local_debug_input = elgg_view('input/pulldown', array(
		'internalname' => 'params[openinviter_local_debug]',
		'value' => get_plugin_setting('openinviter_local_debug', 'omni_inviter'),
		//@todo i18n this.
		'options_values' => array(
			'on_error' => 'on_error',
			'always' => 'always',
			'false' => 'false'
		))
	);
		
	$remote_debug_input = elgg_view('input/pulldown', array(
		'internalname' => 'params[openinviter_remote_debug]',
		'value' => get_plugin_setting('openinviter_remote_debug', 'omni_inviter'),
		'options_values' => array(
			1 => elgg_echo('option:yes'),
			0 => elgg_echo('option:no')
			)
		));

	$transport_input = elgg_view('input/pulldown', array(
		'internalname' => 'params[openinviter_transport]',
		'value' => get_plugin_setting('openinviter_transport', 'omni_inviter'),
		'options_values' => $transport_array
	));

	return '
<label>' . elgg_echo('oi:method:openinviter:username') . $username_input . '</label><br />
<label>' . elgg_echo('oi:method:openinviter:key') . $code_input . '</label><br />
<label>' . elgg_echo('oi:method:openinviter:remote_debug') . $remote_debug_input . '</label><br />
<label>' . elgg_echo('oi:method:openinviter:transport') . $transport_input . '</label>
';
}

/**
 *  Performs actions after initial object creation
 *  Must return true or inivitation obj will not
 *  be created.
 * 
 * @param obj the populated inviter object 
 * @return true
 */
function oi_new_invitation_openinviter($invite) {
	$user_guid = $invite->owner_guid;
	$user = get_entity($user_guid);
	
	$invite->friend_guid = $user_guid;
	$invite->invitecode = generate_invite_code($user->username);
	
	$invite->stats_extra = serialize(array('provider'));
	
	// provider, username, and password are saved via the ajax call
	
	return true;
}

/**
 * Performs actions during use.
 * Useful to set_input() friend_guid and invitecode.
 * If this function returns false, it will stop
 * display of standard reg form and this function will
 * be required to handle form display.
 * 
 * @param $invite Invitation object
 * @return bool
 */
function oi_use_invitation_openinviter($invite) {
	set_input('friend_guid', $invite->friend_guid);
	set_input('invitecode', $invite->invitecode);
	
	return true;
}

/**
 * Performed after successful registration.
 * Must return true
 * 
 * @param $invite Invitation object
 * @return bool
 */
function oi_post_register_openinviter($invite) {
	
	return true;
}


/**
 * Sends an invite using this method.
 * 
 * @param $invite
 * @return bool
 */
function oi_send_invitation_openinviter($invite) {
	// grab our class...
	require_once 'openinviter_class.php';
	
	$provider = $invite->provider;
	$subject = $invite->title;
	$body = $invite->description;
	$message_arr = array(
		'subject' => $subject,
		'body' => $body
	);
	
	// @todo this REALLY needs to be encrypted better.
	// two-way encryption is insecure, though...
	$username = $invite->account_login;
	$password = oi_openinviter_decrypt($invite->account_password);
	
	$contact_arr = array($invite->invited_account_id => $invite->invited_name);
	
	// override config for messages
	$overrides = array (
		'message_subject' => $subject,
		'message_body' => $body
	);
	
	$openi = new oiOpenInviter($overrides);
	
	$openi->startPlugin($provider);
	if ($error = $openi->getInternalError()) {
		$invite->log('Internal error: ' . $error);
		return false;
	}
	
	// attempt to login
	if (!$openi->login($username, $password)) {
		$invite->log('Could not log in...');
		return false;
	}
	
	// @todo: there's this session thing... 
	// I have no idea if we need to save the session.
	// it looks like it's just used for cookies, which wouldn't
	// be worthwhile because we don't send immediately and they'll likely
	// expire.
	//$sent = $openi->sendMessage($session_id = '', $message, $contact);
	//$sent = $openi->sendMessage($openi->plugin->session_id, $body, $contact);
	$sent = $openi->sendMessage('', $message_arr, $contact_arr);
	$openi->logout();
	
	// returning -1 means "use normal email.
	if ($sent === -1) {
		$owner = get_entity($invite->owner_guid);
		$invite->log("Sending as email...");
				
		return oi_send_email($owner->email, $owner->name, $invite->invited_account_id, $invite->invited_name, 
			$invite->title, $invite->description);
	} elseif ($sent === false) {
		$error = $openi->getInternalError();
		$invite->log('Unknown error...');
		return false;
	} else {
		// all is good...??
		return true;
	}
	
	return false;
}


/**
 * Right now this is a simple base64 encode
 * Might explore more secure options later.
 * 
 * @param $string String to encrypt
 * @return encoded string
 */
function oi_openinviter_encrypt($string) {
	return base64_encode($string);
}

/**
 * Decode a base64 encoded string.
 * 
 * @param $string
 * @return unknown_type
 */
function oi_openinviter_decrypt($string) {
	return base64_decode($string);
}