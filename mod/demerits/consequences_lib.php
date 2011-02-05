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


register_plugin_hook('demerits:execute_consequence_notify', 'object', 'demerits_execute_consequence_notify');
register_plugin_hook('demerits:execute_consequence_ban', 'object', 'demerits_execute_consequence_ban');
register_plugin_hook('demerits:execute_consequence_suspend', 'object', 'demerits_execute_consequence_suspend');
// hook into expiration date when it removes the suspend flag so we can unban the user.
register_plugin_hook('expirationdate:expire_entity', 'object', 'demerits_execute_suspend_expirationdate_hook');
register_plugin_hook('demerits:execute_consequence_delete', 'object', 'demerits_execute_consequence_delete');

function demerits_execute_consequence_notify($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;
	
	$demerit = $params['demerit'];
	$consequence = $params['consequence'];
	$user = $params['user'];
	$required_params = demerits_get_required_consequence_params('notify');
	
	$info = array();
	foreach ($required_params as $param_name => $param_info) {
		$string = $consequence->$param_name;
		
		$search = array(
			'%USER_FULLNAME%',
			'%USER_EMAIL%',
			'%USERNAME%',
			'%DEMERIT%',
			'%DEMERIT_HISTORY%'
		);
		
		$replace = array(
			$user->name,
			$user->email,
			$user->username,
			demerits_format_demerit($demerit),
			demerits_format_demerit_history($user->getGUID())
		);
		$string = str_replace($search, $replace, $string);
		$info[$param_name] = $string; 
	}

	$site = get_entity($CONFIG->site_guid);
	//$to = get_user_by_email($info['to']);
	$to = get_user_by_username($info['to']);
	//@todo this whole "can't send to/from email addies" is annoying.
	return notify_user($to->getGUID(), $site->getGUID(), $info['subject'], $info['body']);
	
	
	
	//@todo pull the var replacement out into a function?
	/*
	%USER_FULLNAME%
	%USER_EMAIL%
	%USERNAME%
	%DEMERIT%
	%DEMERIT_HISTORY%
	 */
}

function demerits_execute_consequence_ban($hook, $entity_type, $returnvalue, $params) {
	$demerit = $params['demerit'];
	$consequence = $params['consequence'];
	$user = $params['user'];
	
	return $user->ban(elgg_echo('demerits:consequences:ban_message'));
}

function demerits_execute_consequence_suspend($hook, $entity_type, $returnvalue, $params) {
	$demerit = $params['demerit'];
	$consequence = $params['consequence'];
	$user = $params['user'];
	
	$days = $consequence->num_days;
	$until = strtotime("+ $days days");
	
	if (!$user->ban(sprintf(elgg_echo('demerits:consequences:suspend_message'), date('Y-m-d H:i:s', $until)))) {
		return false;
	}
	
	// this is hacky.  We create an object owned by the user with the subtype of 'demerits_suspend_flag'
	// so we can hook into the expiration date function that deletes it.
	if (function_exists('expirationdate_set')) {
		$flag = new ElggObject();
		$flag->owner_guid = $user->getGUID();
		$flag->subtype = 'demerits_suspend_flag';
		$flag->save();
	
		expirationdate_set($flag->getGUID(), $until, false);
	}
	return true;
}

function demerits_execute_consequence_delete($hook, $entity_type, $returnvalue, $params) {
	$demerit = $params['demerit'];
	$consequence = $params['consequence'];
	$user = $params['user'];
	
	return $user->delete();
}

/**
 * Hook that is called when our suspened flag is expired so we can unban the user.
 * 
 * @param $hook
 * @param $entity_type
 * @param $returnvalue
 * @param $params
 * @return true
 */
function demerits_execute_suspend_expirationdate_hook($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	if ($entity->getSubtype() == 'demerits_suspend_flag') {
		if ($user = get_entity($entity->owner_guid)) {
			$user->unban();
		}
	}
	return true;
}

function demerits_format_demerit($demerit) {
	return sprintf(elgg_echo('demerits:formatted_demerit'), 
		date('Y-m-d H:i:s', $demerit->time_created),
		$demerit->description
	);
}
/**
 * Returns a string of all confirmed demerits for user.
 * @param $user
 * @return unknown_type
 */
function demerits_format_demerit_history($user_guid, $state='confirmed') {
	if ($state == 'any') {
		$state = '';
	}
	
	if (!$user_guid) {
		return '';
	}
	
	$demerits = get_entities_from_metadata('state', $state, 'object', 'demerit', $user_guid, 10000, '', 'time_created', '', false);
	$formatted = array();
	
	if (!is_array($demerits)) {
		return '';
	}
	
	foreach ($demerits as $demerit) {
		$formatted[] = demerits_format_demerit($demerit);
	}
	
	return implode("\n", $formatted);
}