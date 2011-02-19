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

$url = $vars['url'] . 'mod/user_status/icon.php?name=' . $vars['user_status_name'] . '&size=' . $vars['size'];

echo "<img alt=\"{$vars['alt']}\" title=\"{$vars['alt']}\" src=\"$url\" class=\"user_status_{$vars['size']}\" />";

?>