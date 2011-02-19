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



$url = $vars['url'] . 'pg/demerits/list/' . $vars['entity']->username;
$active_count = demerits_get_count($vars['entity']->getGUID(), 'confirmed');
$inactive_count = demerits_get_count($vars['entity']->getGUID());

echo "<a href='$url'>" . elgg_echo('demerits:list_demerits') . 
	" ($active_count/$inactive_count)" . "</a>\n";

$url = $vars['url'] . 'pg/demerits/add/' . $vars['entity']->username; 

echo "<a href='$url'>" . elgg_echo('demerits:add_demerit') . '</a>';

?>
