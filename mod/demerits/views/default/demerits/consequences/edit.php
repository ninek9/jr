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

if ($consequence = $vars['consequence']) {
	$demerit_count = $consequence->demerit_count;
	$demerit_state = $consequence->demerit_state;
	$action = $consequence->action;
	$form_body = elgg_view('input/hidden', array('internalname'=>'consequence_guid', 'value'=>$consequence->getGUID()));
} else {
	$demerit_count = null;
	$demerit_state = 'confirmed'; //@todo make this default?
	$action = 'notify';	//@todo make this default?
	$form_body = '';
}

$demerit_count_input = '<label><input type="text" name="demerit_count" size="3" value="' . $demerit_count .'"></label>';
$demerit_state_input = '<label>' . elgg_view("input/pulldown", array(
								'internalname' => 'demerit_state',
								'value' => $demerit_state,
								'options_values' => demerits_get_supported_demerit_states(true)
							)
						) . '</label>';

$form_body .= '
<p>
	' . sprintf(elgg_echo('demerits:consequences:after_demerit_count'), $demerit_count_input, $demerit_state_input) . '
</p>';

$form_body .= '
<p>
	<label>
	' . elgg_view("input/pulldown", array(
			'internalname' => 'consequence_action',
			'value' => $action,
			'options_values' => demerits_get_supported_consequence_actions(true),
			'js' => 'onChange="updateConsequenceForm(this.value);"'
		)
	) . '
	</label>
</p>';


$form_body .= '
<p>
	' . elgg_echo('demerits:consequences:variables_message') . '
</p>
';

$supported_actions = demerits_get_supported_consequence_actions(true);

foreach ($supported_actions as $name=>$display) {
	$style = ($action==$name) ? '' : 'display: none;';
	$form_body .= '
<div id="consequence_action_' . $name . '" class="demerits-consequence-edit-form" style="' . $style . '">
	<p>
';
		
	$required_params = demerits_get_required_consequence_params($name);
	foreach ($required_params as $param=>$info) {
		// check type and create form items based on type.
		//$form_body .= elgg_echo('demerits:consequences:params:' . $param) . '<br />
		$form_body .= '<label>' . elgg_echo('demerits:consequences:params:' . $param) . '<br />
		' . elgg_view('input/' . $info['type'], array(
			'internalname' => "params[$param]",
			'value' => ($consequence) ? $consequence->$param : ''
			)
		) . '
		';
		$form_body .= '</label>';
	}
	
	$form_body .= '
	</p>
</div>';
}

$form_body .= '
<input type="submit" class="submit_button" value="' . elgg_echo("save") . '" />
';

if ($vars['hidden']) {
	?>
	<input type="button" value="<?php echo elgg_echo('demerits:consequences:new'); ?>" onClick="$('#demerits_new_consequence_form').slideToggle('slow');" />
	<div id="demerits_new_consequence_form" style="display: none;">
	<fieldset><legend><?php echo elgg_echo('demerits:consequences:new'); ?></legend>
	<?php
}
?>
<script type="text/javascript">
current_action = '<?php echo $action; ?>';

function updateConsequenceForm(action) {
	$('#consequence_action_' + current_action).slideUp('slow');
	$('#consequence_action_' + action).slideDown('slow');
	current_action = action;
}
</script>

<form action="<?php echo $vars['url']; ?>action/demerits/consequences/save" method="post">
<?php 
echo $form_body;
?>
</form>

<?php
if ($vars['hidden']) {
	?>
	</fieldset>
	</div>
	<?php
}