<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 */

$blurb = "Configure the message to send, how often and how many 
messages to send at once, which methods to enable, and any optional 
method settings below.<br /><br />

In the subject, body, and email fields these variables will 
automatically be filled in when the message is sent:<br />
<ul>
	<li>%USER_NAME% -- The username of the person inviting.</li>
	<li>%USER_FULLNAME% -- The full name of the person inviting.</li>
	<li>%USER_EMAIL% -- The email address of the person inviting.</li>
	<li>%USER_MESSAGE% -- A message from the person inviting.</li>
	
	<li>%INVITED_NAME% -- The name of the invited person.</li>
	<li>%INVITED_EMAIL% -- The email of the invited person.</li>
	
	<li>%SITE_EMAIL% -- The email address configured for the site.</li>
	<li>%SITE_NAME% -- The name of the site.</li>
	<li>%SITE_DOMAIN_SHORTENED% -- A version of the main Elgg site URL that helps get around link filters.</li>
	
	<li>%OI_JOIN_LINK% -- The link invited users should click on to register.</li>
	<li>%OI_INVITATION_ID% -- The invitation ID.</li>
	<li>%OI_INVITATION_CODE% -- The invitation code.</li>
</ul>

For maximum compatibility with email clients, disable all HTML editors.
";

// the weird formatting is because we use wordwrap to wrap at 75 chars.
// can't do that here because of the vars, but long lines annoy me.
$body = "Dear %INVITED_NAME%,

%USER_FULLNAME% invited you to join %SITE_NAME%!  Just click on " .  
"the link below to start the registration process!  After you " .
"register, you and %USER_FULLNAME% will automatically be linked " . 
"and you can enjoy all the benefits of %SITE_NAME%.

Click below to get started!
(This link is especially for you...Don't share it with anyone else!)
%OI_JOIN_LINK%

If you can't see this link or clicking on it doesn't work, you can " .
"use the information below to sign up for the site.  Just go to %SITE_DOMAIN_SHORTENED% " .
"and click on the Register link, then look for the \"I have an invitation\" section.

Invitation ID: %OI_INVITATION_ID%
Invitation code: %OI_INVITATION_CODE%

Here's what %USER_FULLNAME% has to say about %SITE_NAME%:
%USER_MESSAGE%

Thanks!
%SITE_NAME%

!!!!!!ATTN ELGG ADMINS: UPDATE THIS WITH YOUR PRIVACY POLICY!!!!!!

Privacy Policy:  Your email address was specifically entered into " . 
"our system by %USER_FULLNAME%.  %SITE_NAME% will not release your " . 
"contact information to any third parties, nor will your contact " . 
"information be used for any reason other than creating a new " .
"account on %SITE_NAME% if you so choose.
";

$default_user_message = 'Hurry up and join...I can\'t wait to see you here!!';


$en = array(
	'oi:settings:rename' => 'Rename',
	'oi:settings:blurb' => $blurb,
	'oi:settings:installed_methods' => 'Installed Methods',
	
	'oi:settings:message_subject_default' => '%USER_FULLNAME% is inviting you to %SITE_NAME%!',
	//'oi:settings:message_from_default' => '%SITE_NAME% <%SITE_EMAIL%>',
	'oi:settings:message_from_default' => '%SITE_EMAIL%',
	'oi:settings:message_body_default' => $body,
	'oi:settings:message_rate' => 'Send at most %s invitations every %s',
	'oi:settings:message_subject' => 'Invitation Message Subject',
	'oi:settings:message_from' => 'Invitation Message From',
	'oi:settings:message_body' => 'Invitation Message Body',
	
	'oi:settings:disabled' => 'Disabled -- Manual Sending Only',
	'oi:settings:minute' => 'Minute',
	'oi:settings:fiveminute' => 'Five Minutes',
	'oi:settings:fifteenminute' => 'Fifteen Minutes',
	'oi:settings:halfhour' => 'Thirty Minutes',
	'oi:settings:hourly' => 'Hour',
	'oi:settings:daily' => 'Day',
	'oi:settings:weekly' => 'Week',

	'oi:settings:enable_widget' => 'Enable the Omni Inviter widget?',

	'oi:settings:max_send_attempts' => 'Maximum send attempts before an invitation is disabled',
	
	/* User Settings */
	'oi:usersettings:notify_on_invite_use' => 'Notify me when someone I invited joins',

	'oi:message:invited_join_subject' => '%s just joined %s!',
	'oi:message:invited_join_body' => '%s just used your invitation to join %s!  Why not stop by and say hello?',

	'oi:invite:i_want_to_invite' => 'I want to invite',
	'oi:invite:default_user_message' => $default_user_message,
	'oi:invite:user_message' => 'Personalized Message',

	'oi:invite:invitations_created' => '%s invitations have been created and will be sent soon!',
	'oi:invite:invitations_created_singular' => '%s invitation has been created and will be sent soon!',

	'oi:invite' => 'Invite Users',
	'oi:invite:inviting' => 'I am inviting %s users.',
	'oi:invite:inviting_singular' => 'I am inviting %s user.',
	'oi:invite:send_invitations' => 'Send Invitations!',
	'oi:invite:send_success' => 'Sent invitation!',
	'oi:invite:delete_success' => 'Invitation has been deleted.', 

	'oi:send' => 'Send',
	'oi:name' => 'Name',
	'oi:method' => 'Method',
	'oi:log' => 'Log',
	'oi:add' => 'Add User',
	'oi:done' => 'Done adding users',
	'oi:added_users' => 'Your users have been added but no invitations have been sent yet!  You can search for more users or push the Send Invitations button to send all invitations now.',
	
	'oi:have_invitation' => 'I have an invitation ID and code.',
	'oi:invitation_id' => 'Invitation ID',
	'oi:invitation_code' => 'Invitation Code',
	'oi:invitation_info_accepted' => 'Invitation ID and code confirmed!  Please continue registering!',

	/* WIDGET */
	'oi:widget:name' => 'My Invited Users',
	'oi:widget:description' => 'Show off the users you\'ve invited!',
	'oi:widget:i_invited' => 'I\'ve invited %s users!',
	'oi:widget:i_invited_singular' => 'I\'ve invited %s user!',
	'oi:widget:link_msg' => 'See if you can invited more!',
	'oi:widget:my_invited_users' => 'My Invited Users',
	'oi:widget:num_display' => 'Number of invited users to display',
	'oi:widget:icon_size' => 'Icon size for invited users',
	'oi:widget:small' => 'Small',
	'oi:widget:tiny' => 'Tiny',
	'oi:widget:disabled' => 'Disabled',


	/* ERRORS */
	'oi:errors:unknown_method' => 'Unknown Omni Inviter method.  Cannot continue.',
	'oi:errors:cannot_create_all_invitations' => 'Only %s of your %s invitations could be created.  Please see the Invitations section for more details.',
	'oi:errors:used_code' => 'The code you entered has already been used!  Please check your invitation ID and code and try again.  If you do not have an invitation ID and code, you can still sign up!  Just fill out the form below!',
	'oi:errors:invalid_code' => 'The ID or code you entered is not valid.  Please check your invitation ID and code and try again.  If you do not have an invitation ID and code, you can still sign up!  Just fill out the form below!',
	'oi:errors:method_error' => 'There is an error with the method you selected.  Please select a different one.',
	'oi:errors:unknown_user' => 'Unknown user.',
	'oi:errors:send_fail' => 'Could not send invitation.  Please check the details are correct, the method is available, and the maximum send count hasn\'t been reached.',

	/* ADMIN */
	'oi:omni_inviter' => 'Omni Inviter',
	'oi:admin:stats' => 'Statistics',
	'oi:admin:invitations' => 'List Invitations',
	'oi:admin:no_invitations' => 'No invitations found.',

	'oi:admin:invites:list_user' => 'Invitations sent by %s',
	'oi:admin:invites:list_all' => 'All Invitations',

	'oi:admin:sent_status' => 'Sent Status:',
	'oi:admin:not_sent' => 'Not sent.',
	'oi:admin:sent_error' => 'Could not send. (Attempts: %s, Last attempt: %s)',
	'oi:admin:sent_stalled' => 'Stalled.  (Attempts: %s, Last attempt:  %s)',
	'oi:admin:sent_status_value' => 'Last sent on %s (Attempts: %s, Success: %s)',
	
	'oi:admin:used_status' => 'Used Status:',
	'oi:admin:not_used' => 'Not used.',
	'oi:admin:used_status_value' => 'Used by %s on %s',

	'oi:admin:clicked_status' => 'Clicked Status:',
	'oi:admin:not_clicked' => 'Not clicked.',
	'oi:admin:clicked_status_value' => 'Clicked on %s',

	'oi:admin:created_by' => 'Created by',
	'oi:admin:created_by_value' => '%s on %s',
	'oi:admin:invited_name' => 'Invited User\'s Name',

	'oi:admin:log' => 'Log',

	/* Stats */

	// section headers
	'oi:stats' => 'Statistics',
	'oi:stats:sent_invitations' => 'Sent Invitations',
	'oi:stats:all_invitations' => 'All Invitations',
	'oi:stats:used_invitations' => 'Used Invitations',
	'oi:stats:total' => 'Total',


	// types
	'oi:stats:sent' => 'Sent',
	'oi:stats:unsent' => 'Not Sent',
	'oi:stats:error' => 'Error Sending',
	'oi:stats:used' => 'Used',
	'oi:stats:ignored' => 'Ignored',
	'oi:stats:clicked_and_ignored' => 'Clicked',
	'oi:stats:sent' => 'Sent',
	'oi:stats:error_sending' => 'Error Sending',


	

	


	
	

	'item:object:invitation' => 'Invitations'
);

add_translation("en", $en);
