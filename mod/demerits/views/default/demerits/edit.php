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




//$state = get_plugin_setting('connect_reported_content_state', 'demerits');
//
//$description = elgg_echo('demerits:from_reported_content') . $params['entity']->description;
//$demerit = new Demerit('', $content_owner->getGUID(), $description, $state);
//$demerit->reported_content_id = $params['entity']->getGUID();
//return $demerit->save();
if (array_key_exists('entity', $vars)) {
	$demerit_guid = $vars['entity']->getGUID();
	$description = $vars['entity']->description;
	$state = $vars['entity']->state;
	if ($owner_obj = get_entity($vars['entity']->owner_guid)) {
		$owner = $owner_obj->username;
	}
	
} elseif (array_key_exists('owner', $vars)) {
	$owner = $vars['owner']->username;
	$description = '';
	$state = 'confirmed';
	$demerits_guid = false;
} else {
	$owner = '';
	$description = '';
	$state = 'confirmed';
	$demerits_guid = false;
}

$demerit_state_input = '<label>' . elgg_view("input/pulldown", array(
		'internalname' => 'state',
		'value' => $state,
		'options_values' => demerits_get_supported_demerit_states(true)
	)
) . '</label>';

$demerit_owner_search_input = '<label>' . elgg_view('input/text', array(
	'internalname' => 'owner_search',
	'value' => $owner
));

$demerit_owner_input = elgg_view('input/hidden', array(
	'internalname' => 'owner',
	'value' => $owner
));

$demerit_description_input = '<label>' . elgg_view('input/longtext', array(
	'internalname' => 'description',
	'value' => $description
));

$form_body  = '<h2>' . elgg_echo('demerits:state') . '</h2>' . $demerit_state_input;
$form_body .= '<h2>' . elgg_echo('demerits:owner') . '</h2>' . $demerit_owner_search_input;
$form_body .= $demerit_owner_input; 
$form_body .= '<h2>' . elgg_echo('demerits:description') . '</h2>' . $demerit_description_input;
if ($demerit_guid) {
	$form_body .= elgg_view('input/hidden', array(
		'internalname' => 'demerit_guid',
		'value' => $demerit_guid
	));
}

$form_body .= '<br />';
$form_body .= elgg_view('input/hidden', array(
	'internalname' => 'forward_to',
	'value' => $_SERVER['HTTP_REFERER']
));
$form_body .= elgg_view('input/submit', array(
	'internalname' => 'submit',
	'value' => elgg_echo('save')
));

echo elgg_view('input/form', array(
	'action' => $vars['url'] . 'action/demerits/save',
	'body' => $form_body
));

?>
<script type="text/javascript">
$('input[name=owner_search]').autocomplete('<?php echo $vars['url']; ?>mod/reportedcontent/ajax_endpoint/user_search.php');
$('input[name=owner_search]').result(function (event, data, formatted) {
	$('input[name=owner]')[0].value = data[1];
});
</script>