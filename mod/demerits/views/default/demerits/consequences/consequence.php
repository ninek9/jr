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

$consequence = $vars['entity'];
$action_names = demerits_get_supported_consequence_actions(true);

$action = $consequence->action;

if (!array_key_exists($action, $action_names)) {
	return false;
} else {
	$action_name = $action_names[$action];
}

$required_params = demerits_get_required_consequence_params($action);

$params_html = '';
foreach ($required_params as $param=>$info) {
	// truncate any strings > 150 chars
	//$value = $params[$param];
	$value = $consequence->$param;
	$preview = strip_tags($value);
	$id = uniqid();
	if (strlen($preview) > 150 ) {
		$preview = substr($preview, 0, 147);
		$preview .= "<a style=\"cursor: pointer;\" onClick=\"$('.$id').toggle();\">...&gt;</a>"; 
	}
	$value .= "<a style=\"cursor: pointer;\" onClick=\"$('.$id').toggle();\">&lt;...</a>"; 
	
	$param_name = elgg_echo('demerits:consequences:params:' . $param);
	$params_html .= "
<span class=\"demerits-consequences-param\">
	<span class=\"demerits-consequences-param-name\">$param_name</span>: 
	<span class=\"$id demerits-consequences-param-value\">$preview</span>
	<span class=\"$id\" style=\"display: none;\">$value</span>
</span><br />
";
}

$html = "
<fieldset class=\"demerits-consequence demerits-consequence-$action\"><legend>$action_name</legend>
	<span class=\"demerits-consequences-links\">
		<a href=\"{$vars['url']}pg/demerits/consequences/edit/{$vars['entity']->getGUID()}\">" .
		elgg_echo('edit') . "</a>
		| <a href=\"{$vars['url']}action/demerits/consequences/delete?consequence_guid={$vars['entity']->getGUID()}\">" . elgg_echo('delete') . "</a>
	</span>
	" . $params_html . "
</fieldset>";

echo $html;