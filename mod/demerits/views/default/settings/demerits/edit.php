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

/**
 * Default Settings
 */

if (false === get_plugin_setting('connect_reported_content', 'demerits')) {
	set_plugin_setting('connect_reported_content', true, 'demerits');
}

if (!get_plugin_setting('connect_reported_content_state', 'demerits')) {
	set_plugin_setting('connect_reported_content_state', 'submitted', 'demerits');
}

if (!get_plugin_setting('submitted_expiration_days', 'demerits')) {
	set_plugin_setting('submitted_expiration_days', 7, 'demerits');
}

if (!get_plugin_setting('confirmed_expiration_days', 'demerits')) {
	set_plugin_setting('confirmed_expiration_days', 30, 'demerits');
}

$connect_reported_content_form = elgg_view('input/pulldown', array(
	'internalname' => 'params[connect_reported_content]',
	'value' => get_plugin_setting('connect_reported_content', 'demerits'),
	'options_values' => array(
		1 => elgg_echo('option:yes'),
		0 => elgg_echo('option:no')
		)
	)
);

$connect_reported_content_state_form = elgg_view('input/pulldown', array(
	'internalname' => 'params[connect_reported_content_state]',
	'value' => get_plugin_setting('connect_reported_content_state', 'demerits'),
	'options_values' => demerits_get_supported_demerit_states()
	)
);

$submitted_expiration_days_form = '<input size="5" type="text" name="params[submitted_expiration_days]" ' .
	'value="' . get_plugin_setting('submitted_expiration_days', 'demerits') . '" />';

$confirmed_expiration_days_form = '<input size="5" type="text" name="params[confirmed_expiration_days]" ' .
	'value="' . get_plugin_setting('confirmed_expiration_days', 'demerits') . '" />';

?>
<p>
<?php echo elgg_echo('demerits:settings:blurb'); ?>
</p>
<p>
	<label><?php echo elgg_echo('demerits:settings:submitted_expiration_days'); echo $submitted_expiration_days_form; ?></label><br />
	<label><?php echo elgg_echo('demerits:settings:confirmed_expiration_days'); echo $confirmed_expiration_days_form; ?></label><br />	
	<label><?php echo elgg_echo('demerits:settings:connect_reported_content'); echo $connect_reported_content_form; ?></label><br />
	<label><?php echo elgg_echo('demerits:settings:connect_reported_content_state'); echo $connect_reported_content_state_form; ?></label><br />
</p>