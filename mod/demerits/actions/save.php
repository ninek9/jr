<?php
/**
 * Demerits
 * 
 * @package Demerits
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt
 * @copyright Brett Profitt 2009
 * @link http://eschoolconsultants.com
 */

admin_gatekeeper();

$state = get_input('state');
$description = get_input('description');
$forward_to = get_input('forward_to');

// check owner first, then check the owner_search field in case they
// directly entered a username.
if (!$owner = get_user_by_username(get_input('owner'))
	AND !$owner = get_user_by_username(get_input('owner_search'))
) {
	register_error(elgg_echo('demerits:errors:invalid_user'));
	forward($_SERVER['HTTP_REFERRER']);
}

if ($demerit_guid = get_input('demerit_guid')) {
	if (!$demerit = get_entity($demerit_guid)) {
		register_error(elgg_echo('demerits:errors:invalid_demerit_guid'));
		forward($_SERVER['HTTP_REFERRER']);
	}
	$demerit->set_state($state);
	$demerit->owner_guid = $owner->getGUID();
	$demerit->container_guid = $owner->getGUID();
	$demerit->description = $description;
	$demerit->save();
	// @todo hook here?
	system_message(elgg_echo('demerits:demerit_saved'));
	//print_r($demerit);
	forward($forward_to);
	
} elseif ($demerit = demerits_add_demerit($owner->getGUID(), $description, $state)) {
	system_message(elgg_echo('demerits:demerit_saved'));
	forward($forward_to);
} else {
	register_error(elgg_echo('demerits:errors:demerit_not_save'));
	forward($_SERVER['HTTP_REFERRER']);
}