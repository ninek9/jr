<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009 
 * 
 * @todo: Over zealous kses causes major problems.
 */

// check if we need an upgrade...
$features_version = '2';
$current_features_version = get_plugin_setting('features_version', 'omni_inviter');

if ($current_features_version < $features_version) {
	$new_version = oi_upgrade($current_features_version, $features_version);
	print "Setting new version to $new_version";
	set_plugin_setting('features_version', $new_version, 'omni_inviter');
}

// @todo sometimes this file is loaded before start.php
// force a load of omni_lib if needed.
if (!function_exists('oi_get_supported_methods')) {
	include_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/omni_lib.php';
}

// sometimes the language file doesn't get loaded in time
// english is at least better than language stubs...
if (elgg_echo('oi:settings:message_subject_default') == 'oi:settings:message_subject_default') {
	include_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/languages/en.php';
}

// set some defaults...
if (!get_plugin_setting('message_subject', 'omni_inviter')) {
	set_plugin_setting('message_subject', elgg_echo('oi:settings:message_subject_default'), 'omni_inviter');
}

// @todo option to allow from to change?
// might be weird for non-email.
if (!get_plugin_setting('message_from', 'omni_inviter')) {
	set_plugin_setting('message_from', elgg_echo('oi:settings:message_from_default'), 'omni_inviter');
}

if (!get_plugin_setting('message_body', 'omni_inviter')) {
	set_plugin_setting('message_body', elgg_echo('oi:settings:message_body_default'), 'omni_inviter');
}

if (!get_plugin_setting('message_limit', 'omni_inviter')) {
	set_plugin_setting('message_limit', 25, 'omni_inviter');
}

$rate = get_plugin_setting('message_cron', 'omni_inviter');
switch ($rate) {
	case 'disabled':
	case 'fiveminute':
	case 'fifteenmin':
	case 'halfhour':
	case 'hourly':
	case 'daily':
		break;
	default:
		set_plugin_setting('message_cron', 'fifteenmin', 'omni_inviter');
}

if (!get_plugin_setting('enable_widget', 'omni_inviter')) {
	set_plugin_setting('enable_widget', true, 'omni_inviter');
}

if (!get_plugin_setting('max_send_attempts', 'omni_inviter')) {
	set_plugin_setting('max_send_attempts', 5, 'omni_inviter');
}

// build the fields.
$subj_field = elgg_view('input/text', array(
	'internalname' => 'params[message_subject]',
	'value' => get_plugin_setting('message_subject', 'omni_inviter')
));

$from_field = elgg_view('input/text', array(
	'internalname' => 'params[message_from]',
	'value' => get_plugin_setting('message_from', 'omni_inviter')
));

$body_field = elgg_view('input/longtext', array(
	'internalname' => 'params[message_body]',
	'value' => get_plugin_setting('message_body', 'omni_inviter')
));

$limit_field = elgg_view('input/pulldown', array(
	'internalname' => 'params[message_limit]',
	'value' => get_plugin_setting('message_limit', 'omni_inviter'),
	'options' => array(
		10, 25, 50, 75, 100, 300, 500, 1000
		)
	)
);

$cron_field = elgg_view('input/pulldown', array(
	'internalname' => 'params[message_cron]',
	'options_values' => array(
		'disabled' => elgg_echo('oi:settings:disabled'),
		'fiveminute' => elgg_echo('oi:settings:fiveminute'),
		'fifteenmin' => elgg_echo('oi:settings:fifteenminute'),
		'halfhour' => elgg_echo('oi:settings:halfhour'),
		'hourly' => elgg_echo('oi:settings:hourly'),
		'daily' => elgg_echo('oi:settings:daily'),
	),
	'value' => get_plugin_setting('message_cron', 'omni_inviter'),
));

$widget_field = elgg_view('input/pulldown', array(
	'internalname' => 'params[enable_widget]',
	'options_values' => array(
		1 => elgg_echo('enable'),
		0 => elgg_echo('disable')
		),
	'value' => get_plugin_setting('enable_widget', 'omni_inviter')
));

$max_send_attempts_field = elgg_view('input/pulldown', array(
	'internalname' => 'params[max_send_attempts]',
	'value' => get_plugin_setting('max_send_attempts', 'omni_inviter'),
	'options' => array(
		3, 5, 10
		)
	)
);

// grab plugin settings and defaults...
$methods = oi_get_supported_methods(true, false);
$enable_methods = '';
foreach ($methods as $method=>$info) {
	$enable_select = elgg_view('input/pulldown', array(
		'internalname' => 'params[method_enabled_' . $method . ']',
		'value' => get_plugin_setting('method_enabled_' . $method, 'omni_inviter'),
		'options_values' => array(
			1 => elgg_echo('enable'),
			0 => elgg_echo('disable')
			)
		)
	);
	
	if ($callback = $info['settings_callback'] AND function_exists($callback) AND $callback_settings = $callback()) {
		$method_settings_link = "<a style='cursor: pointer; font-size: small;' onClick=\"$('#oi_method_{$method}_settings').slideToggle()\">[" 
			. elgg_echo('settings') . ']</a>';
		$method_settings = "<div style=\"margin-left: 2em; display: none;\" id=\"oi_method_{$method}_settings\">$callback_settings</div><br />"; 
	} else {
		$method_settings_link = '';
		$method_settings = '';
	}
	
	$enable_methods .= "
<p><label>{$method} $enable_select</label> $method_settings_link</p>
<p style=\"font-size: small;\">{$info['description']}</p>
$method_settings
<br />";
}

// pull it all together.
$settings = '
<label>' . elgg_echo('oi:settings:message_from') . $from_field . '</label><br /><br />
<label>' . elgg_echo('oi:settings:message_subject') . $subj_field . '</label><br /><br />
<label>' . elgg_echo('oi:settings:message_body') . $body_field . '</label><br /><br />
' . sprintf(elgg_echo('oi:settings:message_rate'), $limit_field, $cron_field) . '<br /><br />
<label>' . elgg_echo('oi:settings:max_send_attempts') . $max_send_attempts_field . '</label><br /><br />
<label>' . elgg_echo('oi:settings:enable_widget') . $widget_field . '</label><br />
';

?>
<p>
	<?php echo elgg_echo('oi:settings:blurb'); ?><br />
	<?php echo $settings; ?>
	<br /><br /><h3 style="text-align: center;"> <?php echo elgg_echo('oi:settings:installed_methods'); ?> </h3>
	<?php echo $enable_methods; ?>
</p>
