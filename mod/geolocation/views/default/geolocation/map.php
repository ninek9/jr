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

	$map = $vars['config']->geolocation->map;
	
	if(!($map && $map instanceof GeoMap)){
		if(isadminloggedin())
			echo elgg_view('geolocation/unavailable_map');
	}else{
		//The map is available
		$time = time();
		$id_map = 'containermap_' . $time;
		
		$map_instance = $vars['map_instance'];
		if(!$map_instance)
			$map_instance = "map_$time"; 
		
		$classname = $vars['classname'];
		if(!$classname)
			$classname = 'container_map';
			
		$zoom = $vars['zoom'];
		if (!$zoom){
			$zoom = $map->getZoom();
		}
		
		$map_type = $vars['map_type'];
		if (!$map_type){
			$map_type = 'output';
		}
		if ($map_type == 'output') {
			$zoom = 7;
		}
		$entity = $vars['entity'];
		if ($entity) {
			$lat = $entity->getLatitude();
			$lng = $entity->getLongitude(); 
		}
		
		$hidecontrols = $vars['hidecontrols'];
		
		echo "<div id=\"{$id_map}\" class=\"{$classname}\">
				<img class='img-loading' src=\"{$vars['url']}_graphics/spacer.gif\" alt=\"" . elgg_echo('geolocation:messages:loading') . "\" />
			  </div>";

?>
<script type="text/javascript">
		$(document).ready(function(){
		<?php
			if ((empty($lat) || empty($lng))) {
				$object_geo = new GeoLocation();
				$lat_map = $object_geo->get_lat();
				$lng_map = $object_geo->get_long();
			} else {
				$lat_map = $lat;
				$lng_map = $lng;
			}
		?>

		var mapOptions = {
	      zoom: <?php echo $zoom ?>,
	      center: new google.maps.LatLng(<?php echo $lat_map ?>,<?php echo $lng_map ?>),
<?php 	      
		if ($hidecontrols) {
?>
	    	  navigationControl: false,
	    	  scaleControl: false,
<?php
		} //if ($hidecontrols)
?>
			  /*Disable scroll wheel for all the maps*/
			  scrollwheel: false,
			  mapTypeId: google.maps.MapTypeId.<?php echo $map->getType();?>,
	      };

	    <?php echo $map_instance; ?> = new google.maps.Map(document.getElementById("<?php echo $id_map; ?>"), mapOptions);

	    if (<?php echo $lat_map; ?> !=0 || <?php echo $lng_map; ?> !=0) {
	    	//Draw the point
		    drawPoint(<?php echo $map_instance; ?>, {
				lat: <?php echo $lat_map; ?>,
				lng: <?php echo $lng_map; ?>,
	    	});
		    latlng = new google.maps.LatLng(<?php echo $lat_map ?>,<?php echo $lng_map ?>);
		    goToAddressByLatLng(latlng);
	    }		   
});			
</script>
<?php 
	}//if(!($map && $map instanceof GeoMap))
?>