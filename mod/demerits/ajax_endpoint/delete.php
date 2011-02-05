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

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

if ($demerits = get_input('demerit_guids', false)) {
	$r = true;
	foreach ($demerits as $guid) {
		if ($demerit = get_entity($guid)) {
			$r = $r && $demerit->delete();
		} else {
			$r = false;
		}
	}
	
	echo $r;
} else {
	if (!$demerit = get_entity(get_input('demerit_guid'))) {
		echo 0;
		exit;
	}

	echo $demerit->delete();
}