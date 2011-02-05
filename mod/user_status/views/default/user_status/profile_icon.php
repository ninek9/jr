<?php
/**
 * User Status
 * 
 * @package User Status
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt
 * @copyright Brett Profitt 2009
 * @link http://eschoolconsultants.com
 */

$statuses = user_status_get_supported_statuses(true);


$html = '<div id="user_status">';
foreach ($statuses as $status) {
	$html .= elgg_view('user_status/' . $status, $vars);
}
$html .= '</div>';
echo $html;

echo elgg_echo('profiles/icon', $vars);