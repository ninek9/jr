<?php
/**
 * User Status
 * 
 * @package User Status
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt
 * @copyright Brett Profitt 2009
 * @link http://eschoolconsultants.com
 */

function user_status_init() {
	extend_view('css', 'user_status/css');
	extend_view('profile/icon', 'user_status/user_status');
	//set_view_location('profile/icon', 'user_status/profile_icon');
	
	/*
		status for online
		status for new user
		status for very active
		status for moderately active
		status for low active
	*/
}

function user_status_get_supported_statuses($enabled_only = false) {
	$statuses = array (
		elgg_echo('user_status:online') => 'online',
		elgg_echo('user_status:new_user') => 'new_user',
	);
	
	if ($enabled_only) {
		$enabled = array();
		foreach ($statuses as $pretty_name => $name) {
			if (get_plugin_setting('show_status_' . $name, 'user_status')) {
				$enabled[$pretty_name] = $name;
			}
		}
		return $enabled;
	}
	return $statuses;
}

// Make sure the plugin has been registered
register_elgg_event_handler('init', 'system', 'user_status_init');