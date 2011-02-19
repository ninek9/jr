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

$state = get_input('state');

if ($demerits = get_input('demerit_guids', false)) {
	if (!$state) {
		echo false;
		exit;
	}
	$r = true;
	foreach ($demerits as $demerit_gui) {
		//if (!$demerit = new Demerit($demerit_gui)) {
		if ($demerit = get_entity($demerit_gui)) {
			$r = $r && $demerit->set_state($state);
		} else {
			$r = false;
		}
	}
	echo $r;
	
} else {
	//$demerit = new Demerit(get_input('demerit_guid'));
	$demerit = get_entity(get_input('demerit_guid'));
	
	if (!$state || !$demerit) {
		echo false;
		exit;
	}
	
	echo $demerit->set_state($state);
}