<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */

/** Math is hard, mm k?
/*
array(0=>array(
	'sent' =>
	'used' =>
	'error' =>
	'clicked' =>
	'methods' => array(available_method => %of this chunk used)
	'stats_extra' => array(stat_name => % of this chunk)  This won't == 100% when added.
	'sent_to_click_time' => time in seconds
	'sent_to_used_time' => time in secs
	'click_to_use_time' => time
	
))

function oi_make_stats($start_date=0, $end_date=null, $data_points=30) {
	if ($end_date == null) { $end_date = time(); }
	if ($data_points == 0) { return false; }
	
	// figure out how many we need to average together for a data point.
	$invites_count = get_entities($type='object', $subtype='invitation', $owner_guid=null, $order_by=null, $limit, 
		$offset, $count=true, $site_guid=null, $container_guid=null, $timelower=$start_date, $timeupper=$end_date);
		
	$invites_count_dec = $invites_count;
		
	if ($invites_count == 0) { return false; }
		
	if ($data_points > $invites_count) { $data_points = $invites_count; }
	
	// how many invites = 1 data point
	$invites_per_data_point = ceil($invites_count / $data_points);
	
	// i'm not convinced this will make it more accurate and the above is easier.
//	$invites_per_point = floor($invites_count / $data_points);
//	// after X data points are gathered we need a recovery invite.
//	$points_per_recovery = ceil($invites_per_point / ($invites_count - ($invites_per_point * $data_points)));
//	
//	echo '<pre>';
//	echo "
//	IC: $invites_count
//	I/P: $invites_per_point
//	I/R: $points_per_recovery
//	invites_per_recovery = $invites_per_point / ($invites_count - ($invites_per_point * $data_points));
//	";
	echo '<pre>';
	$results = array();
	$data_point_set_count = 0;
	$data_point_set = array();
	
	// again only process 25 at a time...
	$limit = 25;
	$offset = 0;
	oi_su();

	$invites = get_entities($type='object', $subtype='invitation', $owner_guid=null, $order_by='time_created asc', $limit, 
		$offset, $count=false, $site_guid=null, $container_guid=null, $timelower=$start_date, $timeupper=$end_date);
	
	$result = (is_array($invites));
	while(is_array($invites) && count($invites) >= 1 && $invites_count_dec > 0) {
		foreach ($invites as $invite) {
			if ($data_point_set_count == 0) {
				//$k = $invite->time_created;
				
			}
			
			
			$data_point_set = array();
			
			// average / count / stuff into array
			if (++$data_point_set_count == $invites_per_data_point) {
				foreach ($data_point_set as $set) {
					
				}
				
				$data_point_set_count = 0;
			}
			
			$invites_count_dec--;
		}
		$offset += $limit;
		$invites = get_entities($type='object', $subtype='invitation', $owner_guid=null, $order_by=null, $limit, 
			$offset, $count=false, $site_guid=null, $container_guid=null, $timelower=$start_date, $timeupper=$end_date);
	}
	oi_su(true);
	
	print_r($results);
	
	// return 
}
*/

function oi_get_invitation_count($status, $start_date=0, $end_date=null) {
	if (null == $end_date) {
		$end_date = time();
	}
	
	// status can be created, sent, attempt, clicked, used
	
	switch ($status) {
		default:
		case 'created':
			return get_entities('object', 'invitation', null, null, 99999, null, true, null, null, $start_date, $end_date);
			break;
		
		case 'sent':
			$md_array= array(
				array(
					'name' => 'sent_on',
					'operand' => '>',
					'value' => '0')
				);
			break;
			
		case 'error':
			$md_array= array(
				array(
					'name' => 'send_attempts',
					'operand' => '>=',
					'value' => get_plugin_setting('max_send_attempts', 'omni_inviter'))
				);
			break;
						
		case 'attempt':
			$md_array= array(
				array(
					'name' => 'send_attempts',
					'operand' => '>=',
					'value' => '1')
				);
			break;
			
		case 'clicked':
			$md_array= array(
				array(
					'name' => 'clicked_on',
					'operand' => '>',
					'value' => '0')
				);
			break;
			
		case 'used':
			$md_array= array(
				array(
					'name' => 'used',
					'operand' => '>',
					'value' => '0')
				);
			break;	
	}
	
	// she's a beast of a function.
	return oi_get_entities_from_metadata_by_value($md_array, 'object', 'invitation', true, null, null, 
		null, null, null, null, $start_date, $end_date);
}