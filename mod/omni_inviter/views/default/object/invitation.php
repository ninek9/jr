<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */

$invite = new Invitation();
$invite = $vars['entity'];
$owner = get_entity($invite->owner_guid);
$max_attempts = get_plugin_setting('max_send_attempts', 'omni_inviter');


// set them all here and let things override with truth.
$class = 'unsent';
$used_status = elgg_echo('oi:admin:not_used');
$sent_status = elgg_echo('oi:admin:not_sent');
$clicked_status = elgg_echo('oi:admin:not_clicked');

// get status
if ($invite->send_attempts > 0) {
	$date = date('Y-m-d H:i:s', $invite->send_attempted_on);
	
	if ($invite->send_attempts >= $max_attempts) {
		$class = 'error';
		
		$sent_status = sprintf(elgg_echo('oi:admin:sent_error'), (string)$invite->send_attempts, $date);
	} else {
		$sent_status = sprintf(elgg_echo('oi:admin:sent_stalled'), (string)$invite->send_attempts, $date);
	}
}

if ($invite->sent_count > 0) {
	$class = 'sent';
	
	$date = date('Y-m-d H:i:s', $invite->sent_on);
	$sent_status = sprintf(elgg_echo('oi:admin:sent_status_value'), $date, (string)$invite->send_attempts, (string)$invite->sent_count);
}

if ($invite->used) {
	$class = 'used';
	$used_by = get_entity($invite->invited_guid);
	$used_by_link = '<a href="' . $used_by->getURL() . '">' . $used_by->username . '</a>';
	$date = date('Y-m-d H:i:s', $invite->used_on);
	$used_status = sprintf(elgg_echo('oi:admin:used_status_value'), $used_by_link, $date);
}

if ($invite->clicked) {
	$date = date('Y-m-d H:i:s', $invite->clicked_on);
	$clicked_status = sprintf(elgg_echo('oi:admin:clicked_status_value'), $date);
}

// @todo I don't know if I like this method of abstracting it out....
if ($invite->stats_extra) {
	$stats_extra = unserialize($invite->stats_extra);
	
	$stats_extra_html = '';
	foreach ($stats_extra as $stat_name) {
		if (!$stat_name_i10n = elgg_echo('oi:method:' . $invite->method . ':' . $stat_name)) {
			$stat_name_i10n = $stat_name;
		}
		$stats_extra_html =
		"<span class=\"oi_data_label\">$stat_name:</span>
		<span class=\"oi_data_value\">{$invite->$stat_name}</span><br />
		";
	}
}

$created_by_link = '<a href="' . $owner->getURL() . '">' . $owner->username . '</a>';
$date = date('Y-m-d H:i:s', $invite->time_created); 
$created_by = sprintf(elgg_echo('oi:admin:created_by_value'), $created_by_link, $date);

echo "
<div class=\"contentWrapper oi_invitation_{$class}\" id=\"oi_invitation\">
	<div class=\"oi_invitation_toolbar\">
		<a onClick=\"$('#oi_invite_details_{$invite->guid}').slideToggle();\" class=\"oi_pointer oi_invite_details_link\">Details</a>
		| <a href=\"{$vars['url']}action/omni_inviter/send?guid={$invite->getGUID()}\">" . elgg_echo('oi:send') . "</a>
		| <a onClick=\"if (!confirm('" . elgg_echo('question:areyousure') . "')) { return false; }\"; href=\"{$vars['url']}action/omni_inviter/delete?guid={$invite->getGUID()}\">" . elgg_echo('delete') . "</a>
	</div>
	
	<span class=\"oi_data_label\">" . elgg_echo('oi:admin:created_by') . ":</span>
		<span class=\"oi_data_value\">$created_by</span><br />
		
	<span class=\"oi_data_label\">" . elgg_echo('oi:admin:invited_name') . ":</span>
		<span class=\"oi_data_value\">{$invite->invited_name}</span><br />
		
	<span class=\"oi_data_label\">" . elgg_echo('oi:admin:sent_status') . "</span>
		<span class=\"oi_data_value\">$sent_status</span><br />
		
	<span class=\"oi_data_label\">" . elgg_echo('oi:admin:clicked_status') . "</span>
		<span class=\"oi_data_value\">$clicked_status</span><br />
		
	<span class=\"oi_data_label\">" . elgg_echo('oi:admin:used_status') . "</span>
		<span class=\"oi_data_value\">$used_status</span><br />
		
	<div id=\"oi_invite_details_{$invite->guid}\" class=\"oi_invite_details\" style=\"display: none;\">
		<span class=\"oi_data_label\">" . elgg_echo('oi:invitation_id') . ":</span>
			<span class=\"oi_data_value\">{$invite->guid}</span><br />
			
		<span class=\"oi_data_label\">" . elgg_echo('oi:invitation_code') . ":</span>
			<span class=\"oi_data_value\">{$invite->code}</span><br />
			
		<span class=\"oi_data_label\">" . elgg_echo('oi:invite:user_message') . ":</span>
			<span class=\"oi_data_value\">{$invite->inviter_message}</span><br />
			
		<span class=\"oi_data_label\">" . elgg_echo('oi:method') . ":</span>
			<span class=\"oi_data_value\">{$invite->method}</span><br />$stats_extra_html
			
		<span class=\"oi_data_label\">" . elgg_echo('oi:admin:log') . ":</span>
			<pre class=\"oi_data_value\">{$invite->log}</pre>
	</div>
</div>";

?>