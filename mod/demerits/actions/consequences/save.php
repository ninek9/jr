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
$demerit_count = get_input('demerit_count');
$demerit_state = get_input('demerit_state');
$consequence_action = get_input('consequence_action');

if (!$demerit_count || !$consequence_action) {
	register_error(elgg_echo('demerits:errors:consequence_missing_data'));
	forward($_SERVER['HTTP_REFERER']);
}

// check the state is valid
if (!in_array($demerit_state, demerits_get_supported_demerit_states(false))) {
	register_error(elgg_echo('demerits:errors:consequence_missing_data'));
	forward($_SERVER['HTTP_REFERER']);
}

// check that we have the right params.
$sent_params = get_input('params', array());
$required_params = demerits_get_required_consequence_params($consequence_action);
$params = array();
foreach ($required_params as $param => $info) {
	if (!array_key_exists($param, $sent_params) || empty($sent_params[$param])) {
		register_error(elgg_echo('demerits:errors:consequence_missing_data'));
		forward($_SERVER['HTTP_REFERER']);
	} else {
		$params[$param] = $sent_params[$param];
	}
}

$consequence = new ElggObject($consequence_guid);
$consequence->subtype = 'demerit_consequence';
$consequence->demerit_count = $demerit_count;
$consequence->demerit_state = $demerit_state;
$consequence->action = $consequence_action;
$consequence->access_id = ACCESS_PUBLIC;
foreach ($params as $name=>$value) {
	$consequence->$name = $value;
}
//$consequence->params = serialize($params);

if (!$consequence->save()) {
	register_error(elgg_echo('demerits:errors:consequence_save_error'));
	forward($_SERVER['HTTP_REFERER']);
}

//@todo this will eat all your data if you make a mistake.
system_message(elgg_echo('demerits:consequences:saved'));
forward($CONFIG->url . 'pg/demerits/consequences');
?>