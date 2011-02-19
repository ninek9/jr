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

$consequence_guid = get_input('consequence_guid', null);

if ($consequence = get_entity($consequence_guid) AND $consequence->getSubtype() == 'demerit_consequence') {
	$consequence->delete();
	system_message(elgg_echo('demerits:consequences:deleted'));
	forward($CONFIG->url . 'pg/demerits/consequences');
}

register_error(elgg_echo('demerits:errors:consequence_delete_error'));
forward($_SERVER['HTTP_REFERER']);