<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */

gatekeeper();

$referer = $_SERVER['HTTP_REFERER'];

if (!$invite = get_entity(get_input('guid', false))) {
	register_error('oi:errors:invalid_invitation_guid');
	forward($referer);
	exit;
}

// check the method is still valid
// this is done in the object's send method.
//$method = $invite->method;
//$supported_methods = oi_get_supported_methods(false, true);
//
//if (!in_array($method, $supported_methods)) {
//	register_error('oi:errors:invalid_method');	
//	forward($referer);
//	exit;
//}

if ($invite->send()) {
	system_message(elgg_echo('oi:invite:send_success'));
} else {
	register_error(elgg_echo('oi:errors:send_fail'));
}

forward($referer);