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

// this timeout is in days
$timeout = 24 * 60 * 60 * (int)get_plugin_setting('new_user_timeout', 'user_status');
$created = $vars['entity']->time_created;

if (time() - $created < $timeout) {
	$params = array(
		'user_status_name' => $vars['user_status_name'],
		'alt' => elgg_echo('user_status:new_user'),
		'size' => $vars['size']
	);
	echo elgg_view('user_status/user_status_icon', $params);
}