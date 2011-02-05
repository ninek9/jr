<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @subpackage Secret
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009  
 */

$oi_author = 'Brett Profitt';
$oi_description = elgg_echo('oi:method:secret:description');
$oi_invite_who = elgg_echo('oi:method:secret:invite_who');

// used to print method-specific settings.
$oi_settings_callback = 'oi_settings_secret';

// Called during invitation creation
// useful to set info that will be used during send.
// Username, access_id, and method will be automatically set.
// If you want to POST info from content.php, use javascript:oiAddInvitedUser()'s
// params field.  See content.php for more info.
$oi_new_invitation_callback = 'oi_new_invitation_secret';

// used to send messages for this type of invite.
$oi_send_invitation_callback = 'oi_send_invitation_secret';

// Called during invitation creation and used during invitation use (registration)
// Useful to pass friend_guid and invitecode to Elgg's internal registration system
// or to pass params to the registration callback through $_SESSION
$oi_use_invitation_callback = 'oi_use_invitation_secret';

// called after invited user successfully registers.
// Useful to do relationships or garbage collection.
$oi_post_register_callback = 'oi_post_register_secret';

/**
 * Sets defaults and return settings config for OI settings page.
 * 
 * @return str
 */
function oi_settings_secret() {
	// set some defaults...
	if (!get_plugin_setting('secret_message_subject', 'omni_inviter')) {
		set_plugin_setting('secret_message_subject', elgg_echo('oi:method:secret:message_subject_default'), 'omni_inviter');
	}
	
	// @todo option to allow from to change?
	// might be weird for non-email.
	if (!get_plugin_setting('secret_message_from', 'omni_inviter')) {
		set_plugin_setting('secret_message_from', elgg_echo('oi:method:secret:message_from_default'), 'omni_inviter');
	}
	
	if (!get_plugin_setting('secret_message_body', 'omni_inviter')) {
		set_plugin_setting('secret_message_body', elgg_echo('oi:method:secret:message_body_default'), 'omni_inviter');
	}
	
	$subj_field = elgg_view('input/text', array(
	'internalname' => 'params[secret_message_subject]',
	'value' => get_plugin_setting('secret_message_subject', 'omni_inviter')
	));
	
	$from_field = elgg_view('input/text', array(
		'internalname' => 'params[secret_message_from]',
		'value' => get_plugin_setting('secret_message_from', 'omni_inviter')
	));
	
	$body_field = elgg_view('input/longtext', array(
		'internalname' => 'params[secret_message_body]',
		'value' => get_plugin_setting('secret_message_body', 'omni_inviter')
	));
	
	$settings = '
	<p>' . elgg_echo('oi:method:secret:settings_blurb') . '</p>
	<label>' . elgg_echo('oi:settings:message_from') . $from_field . '</label>
	<label>' . elgg_echo('oi:settings:message_subject') . $subj_field . '</label>
	<label>' . elgg_echo('oi:settings:message_body') . $body_field . '</label>
	';
	
	return $settings;
}

/**
 *  Performs actions after initial object creation
 *  Must return true or inivitation obj will not
 *  be created.
 * 
 * @param obj the populated inviter object 
 * @return true
 */
function oi_new_invitation_secret($invite) {
	$user_guid = $invite->owner_guid;
	$user = get_entity($user_guid);
	
	$invite->friend_guid = $user_guid;
	$invite->invitecode = generate_invite_code($user->username);
	
	return true;
}

/**
 * Performs actions during use.
 * Useful to set_input() friend_guid and invitecode.
 * If this function returns false, it will stop
 * display of standard reg form and this function will
 * be required to handle form display.
 * 
 * 
 * @param $invite Invitation object
 * @return bool
 */
function oi_use_invitation_secret($invite) {
	set_input('friend_guid', $invite->friend_guid);
	set_input('invitecode', $invite->invitecode);
	
	return true;
}

/**
 * Performed after successful registration.
 * 
 * @param $invite Invitation object
 * @return bool
 */
function oi_post_register_secret($invite) {
	
	// send a notification to the new user telling them
	// who it was that invited them.
	
	$to = get_entity($invite->invited_guid);
	$from = get_entity($invite->owner_guid);
	$subject = elgg_echo('oi:method:secret:post_reg_subj');
	$message = elgg_echo('oi:method:secret:post_reg_message');
	notify_user($new_user, $from, $subject, $message);
	
	return true;
}


/**
 * Sends an invite using this method.
 * 
 * @param $invite
 * @return bool
 */
function oi_send_invitation_secret($invite) {
	$owner = get_entity($invite->owner_guid);
	return oi_send_email($owner->email, $owner->name, $invite->invited_account_id, $invite->invited_name, 
		$invite->title, $invite->description);
}
