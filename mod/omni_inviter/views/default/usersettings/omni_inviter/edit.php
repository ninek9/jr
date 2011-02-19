<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009 
 */

if (false === get_plugin_usersetting('notify_on_invite_use')) {
	set_plugin_usersetting('notify_on_invite_use', true);
}

$notify = elgg_echo('oi:usersettings:notify_on_invite_use');

$notify_field = elgg_view('input/pulldown', array (
	'internalname' => 'params[notify_on_invite_use]',
	'options_values' => array(
		1 => elgg_echo('option:yes'),
		0 => elgg_echo('option:no')
	),
	'value' => get_plugin_usersetting('notify_on_invite_use')
));

// grab metaplugin user settings..
// @todo sometimes this file is loaded before start.php
// force a load of omni_lib if needed.
if (!function_exists('oi_get_supported_methods')) {
	include_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/omni_lib.php';
}

// grab plugin settings and defaults...
$methods = oi_get_supported_methods(true, false);
$method_settings = '';
foreach ($methods as $method=>$info) {
	if ($callback = $info['usersettings_callback'] AND function_exists($callback) AND $callback_settings = $callback()) {
		$method_settings .= "<div style=\"margin-left: 2em; display: none;\" id=\"oi_method_{$method}_settings\">$callback_settings</div><br />"; 
	}
}

echo <<<___END
<p>
	<label>$notify: $notify_field</label>
	$method_settings
</p>
___END;

?>