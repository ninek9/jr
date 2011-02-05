<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 *
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 */

$blurb = <<<___END
OpenInviter Technology makes it easy to invite your friends and contacts from other social networking
and email sites!  Just select what site you want to use, enter your
login name and password for that site, and click the "Get Contacts" button
to receive a list of your contacts.
___END;

$en = array(
	'oi:method:openinviter:description' => 'Invite friends from other social networks or common web-based email accounts using Openinviter.',
	'oi:method:openinviter:blurb' => $blurb,
	'oi:method:openinviter:invite_who' => 'Friends from other E-mail and Social Networking sites',
	'oi:method:openinviter:key' => 'OpenInviter private key from config.php',
	'oi:method:openinviter:username' => 'OpenInviter username from config.php',
	'oi:method:openinviter:remote_debug' => 'Remote Debug (WARNING: Enabling this is potentially insecure!)',
	'oi:method:openinviter:username' => 'OpenInviter username from config.php',
	'oi:method:openinviter:transport' => 'Transport to use for sending/receiving data',

	'oi:method:openinviter:provider_select' => 'Email / Social Networking Site:',
	'oi:method:openinviter:account_login' => 'Login Name:',
	'oi:method:openinviter:account_password' => 'Password:',
	'oi:method:openinviter:get_contacts' => 'Get Contacts',
		
	'oi:method:openinviter:invalid_login' => 'We couldn\'t log in to %s with the supplied username and password.  Please double-check your login details for %s and try again!',
	'oi:method:openinviter:contacts_error' => 'There was a problem getting contacts from %s.  Please try again later.',
	'oi:method:openinviter:no_contacts' => 'No contacts were found for you on %s!',

	'oi:method:openinviter:internal_error' => 'There was an internal error with OpenInviter.  Please try again later.  Error details below: %s',

	'oi:method:openinviter:incorrectly_installed' => 'OpenInviter is not correctly installed.  Please refer to this plugin\'s README file for more information.',
	'oi:method:openinviter:remove_postinst' => 'Please remove the postinstall.php file from the OpenInviter directory.  Refer to this plugin\'s README file for more details.',
	'oi:method:openinviter:no_dom_ext' => 'The DOMDocument extension for PHP is not installed.  OpenInviter requires this to operate correctly.',
	'oi:method:openinviter:no_transport' => 'Neither libcurl nor wget is installed.  OpenInviter requires one of these to be installed to operate correctly.',
	'oi:method:openinviter:no_plugins_found' => 'No plugins for OpenInviter were found.',
	
	'oi:method:openinviter:checkall' => 'Check all',
	'oi:method:openinviter:checknone' => 'Check none',

	// this is horrible. these are used for JS and we have no sprintf...
	'oi:method:openinviter:select_this_page' => 'Selecting %justSelectedCount contacts on this page.',
	'oi:method:openinviter:select_all_contacts' => 'Select all %allContactsCount contacts instead?',
	'oi:method:openinviter:selected_all_contacts' => 'Selected all %allContactsCount contacts.',

	'oi:method:openinviter:unselect_this_page' => 'Unselecting %justSelectedCount contacts on this page.',
	'oi:method:openinviter:unselect_all_contacts' => 'Unselect all %allContactsCount contacts instead?',
	'oi:method:openinviter:unselected_all_contacts' => 'Unselected all %allContactsCount contacts.',

	
);

add_translation("en", $en);