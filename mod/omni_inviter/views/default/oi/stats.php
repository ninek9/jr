<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */

admin_gatekeeper();

/*

// this goes for previous month 30 days.
// invites expire after 30 days, so it works well.
// might be able to do week, but will have 100%+ cases possible.
quick summary : 
	type=p invites created: errored / used / unused	(below, clicked but not used)
	    
	type=bvs invites created / sent / errored 
	type=bvs invites sent / used / unused
	type=bvs invites
	type=lc invited users over last year

 */

// range needs to be strtotime able and make sense with a - in front.
$range = get_input('range', '1 month');

$colors = array(
	'0054a7',
	'2579CC',
	'4A9EF1',
	'6FC3F1',
	'94E8F1',
	'BAFFF1'
);

$scolors = array(
	'0f3775',
	'a4c6e1',
	'84a4ca'
);

if (!$created_c = oi_get_invitation_count('created', strtotime("-$range"), time())) {
	echo '<div class="contentWrapper">' . elgg_echo('oi:admin:no_invitations') . '</div>';
	
	return;
}


$sent_c = oi_get_invitation_count('sent', strtotime("-$range"), time());
$sent_p = round($sent_c / $created_c * 100, 2);

$used_c = oi_get_invitation_count('used', strtotime("-$range"), time());
$used_p_of_sent = round($used_c / $sent_c * 100, 2);
$used_p_of_all = round($used_c / $created_c * 100, 2);

$error_c  = oi_get_invitation_count('error', strtotime("-$range"), time());
$error_p = round($error_c / $sent_c * 100, 2);

$clicked_c = oi_get_invitation_count('clicked', strtotime("-$range"), time());
$clicked_p_of_sent = round($clicked_c / $sent_c * 100, 2);
$clicked_p_of_all = round($clicked_c / $created_c * 100, 2);

$clicked_and_ignored_c = $clicked_c - $used_c;
$clicked_and_ignored_p_of_sent = round($clicked_and_ignored_c / $sent_c * 100, 2);
$clicked_and_ignored_p_of_all = round($clicked_and_ignored_c / $created_c * 100, 2);

$ignored_c = $sent_c - $clicked_c;
$ignored_p_of_sent = round($ignored_c / $sent_c * 100, 2);
$ignored_p_of_all = round($ignored_c / $created_c * 100, 2);

$unsent_c = $created_c - $sent_c;
$unsent_p = round($unsent_c / $created_c * 100, 2);

//echo "<pre>
//all: $created_c
//
//sent: $sent_c
//sent_p: $sent_p
//
//used: $used_c
//used_p_all: $used_p_of_all
//used_p_sent: $used_p_of_sent
//
//error: $error_c
//error_p: $error_p
//
//clicked: $clicked_c
//clicked p/s: $clicked_p_of_sent
//clicked p/a: $clicked_p_of_all
//
//c_a_i: $clicked_and_ignored_c
//c_a_i p/s: $clicked_and_ignored_p_of_sent
//c_a_i p/a: $clicked_and_ignored_p_of_all
//
//ignored: $ignored_c
//ignored_pa: $ignored_p_of_all
//ignored_ps: $ignored_p_of_sent
//
//unsent: $unsent_c
//unsentp: $unsent_p
//</pre>
//";

$s_sent = urlencode(elgg_echo('oi:stats:sent')); 
$s_unsent = urlencode(elgg_echo('oi:stats:unsent'));
$s_error = urlencode(elgg_echo('oi:stats:error'));

$s_used = urlencode(elgg_echo('oi:stats:used')); 
$s_ignored = urlencode(elgg_echo('oi:stats:ignored'));
$s_clicked_and_ignored = urlencode(elgg_echo('oi:stats:clicked_and_ignored'));

$chart_url = 'http://chart.apis.google.com/chart?';

$sent_unsent_errored = $chart_url . "chs=450x150&cht=p3&chds=0,$created_c&chd=t:$sent_c,$unsent_c,$error_c&chl=$s_sent|$s_unsent|$s_error";
//$sent_unsent_errored = $chart_url . "chs=450x150&cht=p3&chds=0,$created_c&chd=t:$sent_c,$unsent_c,$error_c&chl=$s_sent|$s_unsent|$s_error&chco={$colors[0]}|{$colors[1]}|{$colors[2]}";

$used_clicked_ignored = $chart_url . "chs=450x150&cht=p3&chds=0,$sent_c&chd=t:$used_c,$ignored_c,$clicked_and_ignored_c&chl=$s_used|$s_ignored|$s_clicked_and_ignored";

echo '

<div class="contentWrapper oi_stats_section_wrapper">
	<div id="content_area_user_title">
	<h2>' . elgg_echo('oi:stats:all_invitations') . ': ' . $created_c . '</h2>
	</div>
	<div class="oi_stats_data" style="float: right;">
		<div class="oi_stats_table">
			<table class="oi_stats_chunk">
				<tr class="oi_stats_chunk">
					<td><span class="oi_stats_label">' . elgg_echo('oi:stats:sent') . '</span></td>
					<td class="oi_align_right">
						<span class="oi_stats_count">' . $sent_c . '</span>
						<span class="oi_stats_percent">(' . $sent_p .'%)</span>
					</td>
				</tr>
				<tr class="oi_stats_chunk">
					<td><span class="oi_stats_label">' . elgg_echo('oi:stats:unsent') . '</span></td>
					<td class="oi_align_right">
						<span class="oi_stats_count">' . $unsent_c . '</span>
						<span class="oi_stats_percent">(' . $unsent_p. '%)</span>
					</td>
				</tr>
				<tr class="oi_stats_chunk">
					<td><span class="oi_stats_label">' . elgg_echo('oi:stats:error_sending') . '</span></td>
					<td class="oi_align_right">
						<span class="oi_stats_count">' . $error_c . '</span>
						<span class="oi_stats_percent">(' . $error_p . '%)</span>
					</td>
				</tr>
				<tr class="oi_stats_chunk">
					<td><span class="oi_stats_label">' . elgg_echo('oi:stats:total') . '</span></td>
					<td class="oi_align_right">
						<span class="oi_stats_count">' . $created_c . '</span>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<img class="oi_stats_chart" src="' . $sent_unsent_errored . '" />
</div>

<div class="contentWrapper oi_stats_section_wrapper">
	<div id="content_area_user_title">
	<h2>' . elgg_echo('oi:stats:sent_invitations') . ': ' . $sent_c . '</h2>
	</div>
	<div class="oi_stats_data" style="float: right;">
		<div class="oi_stats_table">
			<table class="oi_stats_chunk">
				<tr class="oi_stats_chunk">
					<td><span class="oi_stats_label">' . elgg_echo('oi:stats:used') . '</span></td>
					<td class="oi_align_right">
						<span class="oi_stats_count">'. $used_c .'</span>
						<span class="oi_stats_percent">' . $used_p_of_sent . '%</span>
					</td>
				</tr>
				<tr class="oi_stats_chunk">
					<td><span class="oi_stats_label">' . elgg_echo('oi:stats:ignored') . '</span></td>
					<td class="oi_align_right">
						<span class="oi_stats_count">' . $ignored_c . '</span>
						<span class="oi_stats_percent">' . $ignored_p_of_sent . '%</span>
					</td>
				</tr>
				<tr class="oi_stats_chunk">
					<td><span class="oi_stats_label">' . elgg_echo('oi:stats:clicked_and_ignored') . '</span></td>
					<td class="oi_align_right">
						<span class="oi_stats_count">' . $clicked_and_ignored_c . '</span>
						<span class="oi_stats_percent">' . $clicked_and_ignored_p_of_sent . '%</span>
					</td>
				</tr>
				<tr class="oi_stats_chunk">
					<td><span class="oi_stats_label">' . elgg_echo('oi:stats:total') . '</span></td>
					<td class="oi_align_right">
						<span class="oi_stats_count">' . $sent_c . '</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<img class="oi_stats_chart" src="' . $used_clicked_ignored . '" />
</div>
';

?>