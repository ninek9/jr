<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @subpackage Friend
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009  
 */

$oi_author = 'Brett Profitt';
$oi_description = elgg_echo('oi:method:friend:description');
$oi_invite_who = elgg_echo('oi:method:friend:invite_who');

// used to print method-specific settings.
$oi_settings_callback = 'oi_settings_friend';

// used to print method-specific user settings
$oi_usersettings_callback = 'oi_usersettings_friend';

// Called during invitation creation
// useful to set info that will be used during send.
// Username, access_id, and method will be automatically set.
// If you want to POST info from content.php, use javascript:oiAddInvitedUser()'s
// params field.  See content.php for more info.
$oi_new_invitation_callback = 'oi_new_invitation_friend';

// used to send messages for this type of invite.
$oi_send_invitation_callback = 'oi_send_invitation_friend';

// Called during invitation creation and used during invitation use (registration)
// Useful to pass friend_guid and invitecode to Elgg's internal registration system
// or to pass params to the registration callback through $_SESSION
$oi_use_invitation_callback = 'oi_use_invitation_friend';

// called after invited user successfully registers.
// Useful to do relationships or garbage collection.
$oi_post_register_callback = 'oi_post_register_friend';

/**
 * Sets defaults and return settings config for OI settings page.
 * 
 * @return str
 */
function oi_settings_friend() {
	return false;
}

/**
 * Sets defaults and returns settings HTML for OI user settings page.
 * 
 * @return str
 */
function oi_usersettings_friend() {
	return false;
}

/**
 *  Performs actions after initial object creation
 *  Must return true or inivitation obj will not
 *  be created.
 * 
 * @param obj the populated inviter object 
 * @return true
 */
function oi_new_invitation_friend($invite) {
	$user_guid = $invite->owner_guid;
	$user = get_entity($user_guid);
	
	$invite->friend_guid = $user_guid;
	$invite->invitecode = generate_invite_code($user->username);
	
	// use this to make additional information show up in the
	// display page and eventually the stats page.
	// see omni inviter for a working example.
	//$invite->stats_extra = serialize(array('names', 'of', 'invitation', 'properties'));
	
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
function oi_use_invitation_friend($invite) {
	set_input('friend_guid', $invite->friend_guid);
	set_input('invitecode', $invite->invitecode);
	
	return true;
	
	// example to handle form display:
	//echo elgg_view('my_custom_reg_page');
	//return false;
}

/**
 * Performed after successful registration.
 * Must return true.
 * 
 * 
 * @param $invite Invitation object
 * @return bool
 */
function oi_post_register_friend($invite) {
	
	return true;
}


/**
 * Sends an invite using this method.
 * Must return true or object will not be marked sent.
 * 
 * @param $invite
 * @return bool
 */
function oi_send_invitation_friend($invite) {
	$owner = get_entity($invite->owner_guid);

	return oi_send_email($owner->email, $owner->name, $invite->invited_account_id, $invite->invited_name, 
		$invite->title, $invite->description);
}
