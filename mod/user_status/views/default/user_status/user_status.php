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

$html = '<div id="user_status" class="user_status_' . $vars['size'] . '">';
foreach ($statuses as $status) {
	$status_html .= elgg_view('user_status/' . $status, array('size'=>$vars['size'], 'user_status_name' => $status, 'entity' => $vars['entity']));
}
$html = '<div id="user_status" class="user_status_' . $vars['size'] . '">';
$html .= $status_html;
$html .= '</div>';
if ($status_html) {
	echo $html;
}