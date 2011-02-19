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

$tiny = 9;
$small = 12;
$medium = 16;
$large = 32;
$full = 64;

?>

#user_status img{
	position: relative;
	
	border: none;
	xfloat: left;
	z-index: 1010;
}

#user_status.user_status_tiny {
	margin-top: -<?php echo $tiny; ?>px;
}

#user_status.user_status_tiny img {
	width: <?php echo $tiny; ?>px;
	height: <?php echo $tiny; ?>px;
}

#user_status.user_status_small {
	margin-top: -<?php echo $small; ?>px;
}

#user_status.user_status_small img {
	width: <?php echo $small; ?>px;
	height: <?php echo $small; ?>px;
}



#user_status.user_status_medium {
	margin-top: -<?php echo $medium; ?>px;
}

#user_status.user_status_medium img {
	width: <?php echo $medium; ?>px;
	height: <?php echo $medium; ?>px;
}



#user_status.user_status_large {
	margin-top: -<?php echo $large; ?>px;
}

#user_status.user_status_large img {
	width: <?php echo $large; ?>px;
	height: <?php echo $large; ?>px;
}



#user_status.user_status_full {
	margin-top: -<?php echo $full; ?>px;
}

#user_status.user_status_full img {
	width: <?php echo $full; ?>px;
	height: <?php echo $full; ?>px;
}