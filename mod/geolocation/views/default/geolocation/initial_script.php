<?php
	/**
	* Geolocation Module
	* 
	* @author Pedro Prez
	* @link http://community.elgg.org/pg/profile/pedroprez
	* @copyright (c) Keetup 2009-2010
	* @link http://www.keetup.com/
	* @license GNU General Public License (GPL) version 2
	*/
	if(defined('googlemap')){
		
		$device_support_gps = geolocation_is_gps_support();
		
		$sensor_gps = 'false';
		if ($device_support_gps) {
			$sensor_gps = 'true';
		}
?>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=<?php echo $sensor_gps?>"></script>
		<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/geolocation/js/clearoverlay_hack.js"></script>
		
		<!-- Add custom functions for do the magic on the geolocation mod -->
		<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/geolocation/js/geolocation_functions.js"></script>
		
<?php

	}
?>