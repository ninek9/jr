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


$size = $_GET['size'];
$name = $_GET['name'];
$graphics_root = dirname(__FILE__) . '/graphics/';


if (!$name) {
	$name = 'default';
}

if (!$size) {
	$size = 'medium';
} 

$file = $graphics_root . $name . '_' . $size . '.png';

// check if medium size of name exists
if (!is_file($file)) {
	$file = $graphics_root . $name . '_medium' . '.png';
	if (!is_file($file)) {
		$file = $graphics_root . 'default_medium.png';
	}
}

$contents = file_get_contents($file);
header("Content-type: image");
header("Pragma: public");
header("Cache-Control: public");
header("Content-Length: " . strlen($contents));
echo $contents;