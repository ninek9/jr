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

if ($invite->delete()) {
	system_message(elgg_echo('oi:invite:delete_success'));
} else {
	register_error(elgg_echo('oi:errors:delete_fail'));
}

forward($referer);