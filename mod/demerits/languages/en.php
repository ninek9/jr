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

$english = array(
	// Generic
	'demerits:demerits' => 'Demerits',
	'demerits:add_demerit' => 'Add Demerit',
	'demerits:list_demerits' => 'List Demerits',
	'demerits:then' => 'Then...',
	'demerits:stop' => 'Stop',
	'demerits:from_reported_content' => 'From reported content: ',
	'demerits:with_selected' => 'With Selected: ',
	'demerits:no_demerits' => 'No demerits.',
	'demerits:owner' => 'Owner',
	'demerits:description' => 'Reason for demerit:',
	'demerits:demerit_saved' => 'Demerit Saved',
	'demerits:demerit_deleted' => 'Demerit Deleted',
	'demerits:any' => 'Any',

	// Settings
	'demerits:settings:blurb' => '',
	'demerits:settings:submitted_expiration_days' => 'Days to expire submitted demerits: ',
	'demerits:settings:confirmed_expiration_days' => 'Days to expire confirmed demerits: ',
	'demerits:settings:connect_reported_content' => 'Connect reported content and demerits?',
	'demerits:settings:connect_reported_content_state' => 'Set demerits from reported content as: ',
	
	// Admin
	'demerits:admin:list_demerits' => 'List Demerits',
	'demerits:admin:list_consequences' => 'List Consequences',

	// Demerit States
	'demerits:state' => 'State',
	'demerits:states:submitted' => 'Submitted',
	'demerits:states:confirmed' => 'Confirmed',
	'demerits:states:archived' => 'Archived',
	'demerits:change_state' => 'Change State',
	'demerits:check_all' => 'Check All',

	// Consequences
	'demerits:consequences:after_demerit_count' => 'After %s %s demerits',	// count, type (reported || confirmed)
	'demerits:consequences:saved' => 'Saved consequence',
	'demerits:consequences:deleted' => 'Deleted consequence',
	'demerits:consequences:new' => 'Add consequence',
	'demerits:consequences:list' => 'Active Consequences',
	'demerits:consequences:variables_message' => 'Notification supports variables including: %USER_FULLNAME%, %USER_EMAIL%, %USERNAME%, %DEMERIT%, and %DEMERIT_HISTORY%',

	// Consequence Actions
	'demerits:actions:notify' => 'Send Notification',
	'demerits:actions:ban' => 'Ban User',
	'demerits:actions:suspend' => 'Suspend User',
	'demerits:actions:delete' => 'Delete User',

	// Consequence Action Params
	// Notify
	'demerits:consequences:params:to' => 'To',
	'demerits:consequences:params:subject' => 'Subject',
	'demerits:consequences:params:body' => 'Message',
	'demerits:consequences:params:num_days' => 'Number of days',
	'demerits:formatted_demerit' => '
Date: %s
Description: %s
',

	// Ban
	'demerits:consequences:ban_message' => 'Banned by Demerits',

	// Suspend
	'demerits:consequences:suspend_message' => 'Suspended by Demerits until %s',

	// Errors
	'demerits:errors:consequence_missing_data' => 'Missing data for consequence!',
	'demerits:errors:consequence_save_error' => 'Could not save consequence!',
	'demerits:errors:invalid_consequence_id' => 'Invalid consequence id',
	'demerits:errors:invalid_demerit_guid' => 'Unknown Demerit',
	'demerits:errors:invalid_user' => 'Unknown User',
	'demerits:errors:demerit_not_saved' => 'Could not save demerit.',
	'demerits:errors:demerit_not_deleted' => 'Could not delete demerit.',
	'demerits:errors:consequence_delete_error' => 'Could not delete consequence',

);

add_translation("en", $english);
?>
