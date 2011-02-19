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

// create default settings.
if (!get_plugin_setting('online_timeout', 'user_status')) {
	set_plugin_setting('online_timeout', 10, 'user_status');
}
if (!get_plugin_setting('new_user_timeout', 'user_status')) {
	set_plugin_setting('new_user_timeout', 7, 'user_status');
}

$statuses = user_status_get_supported_statuses();
$timeout = get_plugin_setting('timeout','online_mark');
if(!$timeout) set_plugin_setting('timeout', 600, 'online_mark');

foreach ($statuses as $pretty_name => $name) {
	$select_menu = elgg_view('input/pulldown', array(
		'internalname' => 'params[show_status_' . $name . ']',
		'value' => get_plugin_setting('show_status_' . $name, 'user_status'),
		'options_values' => array(
			1 => elgg_echo('option:yes'),
			0 => elgg_echo('option:no')
			)
		)
	);
	echo '<label>' . elgg_echo('user_status:enable_icon') . ' ' . $pretty_name . $select_menu . '</label><br />';
	switch ($name) {
		case 'online':
			echo '<p>';
			$input = '<input name="params[online_timeout]" type="text" size="5" value="' 
				. get_plugin_setting('online_timeout', 'user_status') . '" >';
			echo '<label>' . elgg_echo('user_status:timeout_in_minutes') . ' ' . $input . '</label>';
			echo '</p>';
			break;
			
		case 'new_user':
			$input = '<input name="params[new_user_timeout]" type="text" size="5" value="' 
				. get_plugin_setting('new_user_timeout', 'user_status') . '" >';
			echo '<label>' . elgg_echo('user_status:timeout_in_days') . ' ' . $input . '</label>';
			break;
	}
	echo '<br />';
}