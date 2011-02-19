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

$demerit = $vars['entity'];
if ($owner = get_entity($demerit->owner_guid)) {
	$submitted_count = demerits_get_count($owner->getGUID(), 'submitted');
	$demerit_count = demerits_get_count($owner->getGUID());
} else {
	$submitted_count = '??';
	$demerit_count = '??';
}

$div_id = 'demerit-' . $demerit->getGUID();

$links = elgg_view('input/pulldown', array(
	'options_values' => demerits_get_supported_demerit_states(),
	'value' => $demerit->state,
	'js' => "onChange=\"demeritsAjaxCall('change_state',
		'{$owner->username}',
		{
			'demerit_guid': '{$demerit->getGUID()}',
			'state': this.options[this.selectedIndex].value
		})\""))
//	. " | <a style=\"cursor-type: pointer;\" onClick=\"demeritsEdit('{$demerit->getGUID()}')\">" . elgg_echo('edit') . '</a>'
	. " | <a href=\"{$vars['url']}pg/demerits/edit/{$demerit->getGUID()}\">" . elgg_echo('edit') . '</a>'
//	. " | <a style=\"cursor-type: pointer;\" onClick=\"if (confirm('" . elgg_echo('deleteconfirm') . "')) 
//		demeritsAjaxCall(
//			'delete',
//			'{$owner->username}', 
//			{'demerit_guid': '{$demerit->getGUID()}'})\">" . elgg_echo('delete') . '</a>'
	. " | <a style=\"cursor: pointer;\" onClick=\"if (confirm('" . elgg_echo('deleteconfirm') . "')) 
		window.location = '{$vars['url']}action/demerits/delete?demerit_guid={$demerit->getGUID()}';\">" . elgg_echo('delete') . '</a>'
	. " | <input type=\"checkbox\" class=\"demerit-guids\" name=\"demerit_guids[]\" value=\"{$demerit->getGUID()}\" />
";


echo "
<div id=\"$div_id\" class=\"demerit demerit-state-{$demerit->state}\">	
	<span class=\"demerit-links\">
		<img height=\"24\" class=\"demerit-ajax-loader\" src=\"{$vars['url']}_graphics/ajax_loader.gif\" />
		$links
	</span>
	
	<span class=\"demerit-username\">
		<a href = \"{$vars['url']}pg/demerits/list/{$owner->username}/\">{$owner->username} 
			<span class=\"demerit-count-{$owner->username}\">($submitted_count/$demerit_count)</span>
		</a>
	</span>
	
	<span class=\"demerit-date\"> @ " . date('Y-m-d H:i:s', $demerit->time_updated) . "</span>";
		
//if ($demerit->reported_content_id AND $rc = get_entity($demerit->reported_content_id)) {
if (false) {
	//echo "<span class=\"demerit-reported-conent-link\"><a href="
	
}
echo "
	<p class=\"demerit-description\">{$demerit->description}</p>
</div>
";