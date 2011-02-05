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

// this timeout is in minutes
$timeout = 60 * (int)get_plugin_setting('online_timeout', 'user_status');
$last_action = $vars['entity']->last_action;

if (time() - $last_action < $timeout) {
	$params = array(
		'user_status_name' => 'birthday',
		'alt' => elgg_echo('user_status:new_user'),
		'size' => $vars['size']
	);
	echo elgg_view('user_status/user_status_icon', $params);
}