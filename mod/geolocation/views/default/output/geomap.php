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
	$now = time();
	$map_instance = "map_{$now}";
	
	$context = get_context();
	
	$type = $vars['type'];
	if (!$type) {
		$type = 'static';
	}
	$maptype = $vars['maptype'];
	if (!$maptype) {
		$maptype = 'mobile';
	}
	
	$debug = $vars['debug'];
	if(!$debug)
		$debug = false;
		
	$size = $vars['size'];
	if (!$size) {
		switch ($context) {
			case 'profile':
				$size = "360x260";
				break;
			case 'groups':
				$size = "468x260";	
				break;
			default:
				$size = "670x280";
				break;
		}
	}	
	
	$format = $vars['format'];
	if (!$format) {
		$format = "jpg";	
	}
	
	$zoom = $vars['zoom'];
	if (!$zoom) {
		$zoom = 13;	
	}
	
	$location = get_input('location');
	
	$classname = $vars['classname'];
		if(!$classname) {
			if ($type == 'static') {
				$classname = 'container_staticmap_output';
			} else {
				$classname = 'container_map_output';	
			}
			
			switch ($context) {
				case 'profile':
					$classname .= " {$type}map_profile";
					break;
				case 'groups':
					$classname .= " {$type}map_groups";
					break;
				default:
					$classname .= " {$type}map_all";
					break;
			}
		}
			
	$entity = $vars['entity'];

	if (!$entity) {
		$entity = page_owner_entity();
	}
	
	if ($entity) {
		if (!$location) {
			$location = $entity->location;
		}
	}
	
	$havecontainer =  true;
	if ($type == 'static') {
		//Get API key
		$google_api = get_plugin_setting('google_api', 'geolocation');
		if ($entity instanceof ElggEntity && $entity->getLatitude() && $entity->getLongitude()) {
			$lat = $entity->getLatitude();
			$lng = $entity->getLongitude();
			$map_content =  "<img border=\"0\" alt=\"Output Map\"  src=\"http://maps.google.com/staticmap?markers=$lat,$lng,blue&size=$size&maptype=$maptype&zoom=$zoom&key=$google_api&format=$format&sensor=false\" />";
			$content = "<div class=\"{$classname}\">
					$map_content
				  </div>";
		} else {
			$havecontainer = false;			
		}
	} else { /*interactive*/
		if ($entity instanceof ElggEntity && $entity->getLatitude() && $entity->getLongitude()) {
			$map_content = elgg_view('geolocation/map', array(
				'map_instance' => $map_instance,
				'classname' => $classname,
				'entity' => $entity,
			));
			$content = $map_content; 
		}  else {
			$havecontainer = false;			
		}
	}

	if ($havecontainer) {
		$content .= "<p class='geo_location'>$location</p>";	
	}
	//Print location
	echo $content;
?>
	