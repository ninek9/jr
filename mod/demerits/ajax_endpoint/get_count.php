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

if (!$user = get_user_by_username(get_input('username'))) {
	echo '???';
	exit;
} 

echo '(' . demerits_get_count($user->getGUID(), 'confirmed') . 
	'/' . demerits_get_count($user->getGUID()) . ')';