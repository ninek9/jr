<?php
    /**
     * Elgg Feedback plugin
     * Feedback interface for Elgg sites
     * 
     * @package Feedback
     * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
     * @author Prashant Juvekar
     * @copyright Prashant Juvekar
     * @link http://www.linkedin.com/in/prashantjuvekar
     */

	$icon = elgg_view(
			'graphics/icon', array(
			'entity' => $vars['entity'],
			'size' => 'small',
		)
	);

	$controls .= elgg_view("output/confirmlink",array(
														'href' => $vars['url'] . "action/feedback/delete?guid=" . $vars['entity']->guid,
                										'text' => elgg_echo('delete'),
														'confirm' => elgg_echo('deleteconfirm'),
													));

	//$controls .= " (<a href=\"{$vars['url']}action/feedback/delete?guid={$vars['entity']->guid}\">" . elgg_echo('delete') . "</a>)";

	$mood = elgg_echo ( "feedback:mood:" . $vars['entity']->mood );
	$about = elgg_echo ( "feedback:about:" . $vars['entity']->about );
	
	$page = "Unknown";
	if ( !empty($vars['entity']->page) ) {
		$page = $CONFIG->wwwroot . $vars['entity']->page;
		$page = "<a href='" . $page . "'>" . $page . "</a>";
	}

	$info .= "<div style='float:left;width:30%'><b>".elgg_echo('feedback:list:mood').": </b>" . $mood . "</div>";
	$info .= "<div style='float:left;width:30%'><b>".elgg_echo('feedback:list:about').": </b>" . $about . "</div>";
	$info .= $controls . "<br />";
	$info .= "<b>".elgg_echo('feedback:list:page').": </b>" . $page . "<br />";
	$info .= "<b>".elgg_echo('feedback:list:from').": </b>" . $vars['entity']->id . "<br />";
	$info .= nl2br($vars['entity']->txt);
	
	echo elgg_view_listing($icon,$info);

?>
