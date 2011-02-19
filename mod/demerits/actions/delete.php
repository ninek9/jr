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

$r = true;

if ($demerits = get_input('demerit_guids', false)) {
	foreach ($demerits as $guid) {
		if ($demerit = get_entity($guid)) {
			$r = $r && $demerit->delete();
		} else {
			$r = false;
		}
	}
} else {
	if ($demerit = get_entity(get_input('demerit_guid'))) {
		$demerit->delete();
	} else {
		$r = false;
	} 
}

if ($r) {
	system_message(elgg_echo('demerits:demerit_deleted'));
} else {
	register_error(elgg_echo('demerits:errors:demerit_not_deleted'));
}

forward($_SERVER['HTTP_REFERER']);