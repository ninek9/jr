<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 */

$blurb = "Using this method, invited users won't know who invited them until after they signed up.
It's an easy way to drive users to your site.  Make sure you configure the default message below 
to not include any user information (%USER_NAME% or %USER_FULLNAME%) so it will be a surprise!";

$body = "Dear %INVITED_NAME%,

%USER_FULLNAME% invited you to join %SITE_NAME%!  Just click on " .  
"the link below to start the registration process!  After you " .
"register, you and %USER_FULLNAME% will automatically be linked " . 
"and you can enjoy all the benefits of %SITE_NAME%.

Click below to get started!
(This link is especially for you--Don't share it with anyone else!)
%OI_JOIN_LINK%

If you can't see this link or clicking on it doesn't work, you can " .
"use the information below to sign up for the site.  Just go to %SITE_DOMAIN_SHORTENED% " .
"and click on the Register link.
Invitation ID: %OI_INVITATION_ID%
Invitation code: %OI_INVITATION_CODE%

Here's what the person who invited you has to say about %SITE_NAME%:
%USER_MESSAGE%

Thanks!
%SITE_NAME%

!!!!!!ATTN ELGG ADMINS: UPDATE THIS WITH YOUR PRIVACY POLICY!!!!!!

Privacy Policy:  Your email address was specifically entered into " . 
"our system by one of our users.  %SITE_NAME% will not release your " . 
"contact information to any third parties, nor will your contact " . 
"information be used for any reason other than creating a new " .
"account on %SITE_NAME% if you so choose.
";




$en = array(
	'oi:method:secret:description' => 'Send invitations that require users to join to know who invited them.',
	'oi:method:secret:invite_who' => 'Friends with email address secretly.',
	'oi:method:secret:settings_blurb' => $blurb,
	
	'oi:method:secret:message_subject_default' => 'Someone wants you to join %SITE_NAME%!',
	'oi:method:secret:message_from_default' => '%SITE_NAME% <%SITE_EMAIL%>',
	'oi:method:secret:message_body_default' => $body,

	// @todo these are horrible defaults.
	'oi:method:secret:post_reg_subj' => 'You joined!!',
	'oi:method:secret:post_reg_message' => 'I invited you!  Glad you joined ;)',
);

add_translation("en", $en);