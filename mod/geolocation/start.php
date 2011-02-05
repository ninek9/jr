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

	//Add map support
	require_once(dirname(__FILE__) . '/model/geo_map.php');
	//Add geolocation via IP support
	require_once(dirname(__FILE__) . '/model/geo_location.php');
	//Add geolocation functions (Most likely to be use on the future ;))
	require_once(dirname(__FILE__) . '/model/geolocation_functions.php');

	/** 
	 * geolocation_init
	 *
	 * Module Initialization
	 */	
	function geolocation_init() {
		global $CONFIG;
		
		//Register Plugins Hook (Profile and groups)
		register_plugin_hook("profile:fields", "all", "geolocation_profile_fields");
		//Add geocalization map support for plugins
		register_plugin_hook("geolocation:allowed_contexts", "all", "geolocation_allowed_contexts");
		
		//Extend the views
		extend_view('css', 'geolocation/css');
		extend_view('page_elements/footer', 'geolocation/initial_script');

		// Register geocoder hook
		register_plugin_hook('geocode', 'location', 'geolocation_geocode');
		
		//Add events hooks
		register_elgg_event_handler("create",'user',"geolocation_tagger");
		register_elgg_event_handler("profileupdate","user","geolocation_tagger");

		register_elgg_event_handler("create",'object',"geolocation_tagger");
		register_elgg_event_handler("update",'object',"geolocation_tagger");
		
		register_elgg_event_handler("create",'group',"geolocation_tagger");
		register_elgg_event_handler("update",'group',"geolocation_tagger");
	}
	
	/** 
	 * geolocation_profile_fields
	 *
	 * Add to users and groups the necesary fields to be geolocated
	 */
	function geolocation_profile_fields($hook, $entity_type, $returnvalue, $params) {
		$entities_allowed = array(
			'profile',
			'group',
		);
		if (in_array($entity_type, $entities_allowed)) {
			$returnvalue['location'] = 'geomap';	
		}
		return $returnvalue;
	}
	
	/** 
	 * geolocation_geocode
	 *
	 * Listen for an Elgg Geocode request and use google maps to geocode it.
	 */
	function geolocation_geocode($hook, $entity_type, $returnvalue, $params){ 
		if (isset($params['location'])) {
			$google_api = get_plugin_setting('google_api', 'geolocation');
			// Desired address
			$address = "http://maps.google.com/maps/geo?q=".urlencode(geolocation_clean_text($params['location']))."&output=json&key=" . $google_api;
			
			// Retrieve the URL contents
	   		$result = file_get_contents($address);
	   		$obj = json_decode($result);
	   		
	   		$obj = $obj->Placemark[0]->Point->coordinates;
   		
	   		return array('lat' => $obj[1], 'long' => $obj[0]);
  		}
	}
	
	/** 
	 * geolocation_blacklist_objects
	 *
	 * Object's blacklist not to be considered
	 */
	function geolocation_blacklist_objects() {
		$blacklist_objects = array (
			'widget',
		); 
		return trigger_plugin_hook('geolocation:blacklist_objects', "geolocation", NULL, $blacklist_objects); 
	}
	
	/** 
	 * geolocation_tagger
	 *
	 * Geolocalize an object, group or user
	 */
	function geolocation_tagger($event, $object_type, $object){
		//Si el evento es crete o update chequeamos que los objetos sean de los tipos permitidos
		//If the objects are created or updated we check if they aren't on the blacklist
		if ((($event == 'create' || $event == 'update') &&
			 (($object_type == 'object' && !in_array($object->getSubtype(),geolocation_blacklist_objects())) || $object_type == 'group') && $object instanceof Locatable) || 
			(($event == 'profileupdate' || 
			 ($event == 'create' && $object_type == 'user')) && $object instanceof Locatable)){

			$location = get_input('location');
			$geolocation = false;
			
			//To clean up the location value from the wire on riverdashboard home page
			if ($location == 'activity') {
				unset($location);
			}
			
			// See if object has a specific location
			if (!$location && isset($object->location)) {
				$location = $object->location;
				
				if ($object->getLatitude() && $object->getLongitude()) {
					$geolocation = sprintf("(%s,%s)", $object->getLatitude(), $object->getLongitude());		
				}
			}
			
			// If not, see if user has a location
			if (!$location) {
				if (isset($object->owner_guid)) {
					$user = get_entity($object->owner_guid);
					if (isset($user->location)) {
						$location = $user->location;
						if ($user->getLatitude() && $user->getLongitude()) {
							$geolocation = sprintf("(%s,%s)", $user->getLatitude(), $user->getLongitude());		
						}
					}
				}
			}
			
			//Get logged in user
			$user = get_loggedin_user();
			
			// Nope, so use logged in user
			if (!$location) {
				if (($user) && (isset($user->location))) {
					$location = $user->location;
					
					if ($user->getLatitude() && $user->getLongitude()) {
						$geolocation = sprintf("(%s,%s)", $user->getLatitude(), $user->getLongitude());		
					}
				}
			}
			
			// Have we got a coordenates
			if ($location) {
				// Handle when location is given in a tag field (as it is with users register)
				$first_time_geo = false;
				
				if ($user) {
					if (!($user->getLatitude() && $user->getLongitude())) {
						//First time the object is geopositioned
						$first_time_geo = true;
					}
				}
				
				if (!$geolocation) {
					//Get the new geolocation value
					$geolocation = get_input('geolocation');
				}
				
				//We set lat and long from geolocation
				if ($geolocation) {
					$geolocation = geolocation_coordinates2array($geolocation);
					//Set lat and long
					$object->setLatLong($geolocation[0], $geolocation[1]);
				} else {
					//We go out
					return false;
				}
				
				//Update the location
				$object->setLocation($location);
				//We try to find out the country
				$location_parts = explode(',', $location);
				if (is_array($location_parts)) {
					$last_element = sizeof($location_parts)-1;
					$object->location_country = $location_parts[$last_element];
					
					$latlong = elgg_geocode_location($object->location_country);
					
					if ($latlong) {
						$object->location_country_lat = $latlong['lat'];
			   			$object->location_country_lng = $latlong['long'];
			   			
			   			if (!$geolocation) {
			   				$object->setLatLong($latlong['lat'], $latlong['long']);		
			   			}
					}
		   		}
		   		
				if ($first_time_geo && $object instanceof ElggUser) {
					//If this is the first time the user is geopositioned we try to establish the geoposition for all his element 
					$count_entities = get_entities('', '', $user->guid, '', '', '', true);
					$entities = get_entities('', '', $user->guid, '', $count_entities);
					
					foreach ($entities as $entity) {
						if ($entity instanceof Locatable && !in_array($entity->getSubtype(),geolocation_blacklist_objects())) {
							/*
							 * TODO: Should check that the entity has already a latitude and longitude asigned
							 * */
							geolocation_tagger('update', $entity->getType(), $entity);	
						}
					}
				}
			}
		}
		
	}
	
	/** 
	 * geolocation_pagesetup
	 *
	 * We check that everything is all right before drawing the page ;)
	 */
	function geolocation_pagesetup() {
		global $CONFIG;
		$allowed_contexts = array(
			'groups',
			'profile', 
		);
		//Use the following plugin hook to add map geolocalization support for your pluggin 
		$allowed_contexts = trigger_plugin_hook('geolocation:allowed_contexts', "geolocation", NULL, $allowed_contexts);
		if (!defined('googlemap') && in_array(get_context(), $allowed_contexts)) {
			define('googlemap', true);
		} else {
			$script_name = explode('/', $_SERVER['SCRIPT_NAME']);
			//If the page is register view so we can geomap support
			if (is_array($script_name) && sizeof($script_name) > 0) {
				$last_item_no = sizeof($script_name)-1;
				$script_name = $script_name[$last_item_no];
				if ($script_name == 'register.php') {
					define('googlemap', true);					
				} 
			}
		}
		
		if ((defined('googlemap')) && !isset($CONFIG->geolocation->map)) {
			$options = array(
				'zoom' => get_plugin_setting('map_zoom', 'geolocation'),
				'type' => get_plugin_setting('map_type', 'geolocation'),
			);
			$CONFIG->geolocation->map = new GeoMap($options);
		}
	}
	
	/** 
	 * geolocation_allowed_contexts
	 *
	 * Extend the current context options to allow map geolocalization to show up
	 */
	function geolocation_allowed_contexts($hook, $entity_type, $returnvalue, $params) {
		/*
		 * Add desired context into the $allowed_contexts array
		 * Example:
		 * $entities_allowed = array(
		 * 		'file',
		 * 		'pages',
		 * );
		*/
		$allowed_contexts = array(
			'file',
		);
		return array_merge($allowed_contexts, $returnvalue);
	}
	
	/** 
	 * geolocation_coordinates2array
	 *
	 * Convert coordinates like this "(45.2,30.10)" into an array 
	 */
	function geolocation_coordinates2array($coordinates) {
		$latlong = explode(',',substr($coordinates,1,strlen($coordinates)-2));
		if($latlong && is_array($latlong)){
			$latlong = array_map("floatval",$latlong);
			return $latlong;
		}
	}
	
	/** 
	 * geolocation_gps_devices_support
	 *
	 * Inicialization GPS device support
	 */
	function geolocation_gps_devices_support() {
		global $CONFIG;
		$gps_devices_defaults = array (
			'iphone',
		);
		$CONFIG->geolocation->gps_devices = trigger_plugin_hook('geolocation:gps:devices', "geolocation", NULL, $gps_devices_defaults);
	}
	
	/** 
	 * geolocation_get_gps_devices
	 *
	 * Get GPS Support
	 */
	function geolocation_get_gps_devices(){
		global $CONFIG;
		$gps_devices = array();
		if(isset($CONFIG->geolocation->gps_devices))
			$gps_devices = $CONFIG->geolocation->gps_devices;
		return $gps_devices;
	}
	
	/** 
	 * geolocation_is_gps_support
	 *
	 * Check if the browser is from a compatible gps device from the previus list
	 */
	function geolocation_is_gps_support() {
		$gps_devices = geolocation_get_gps_devices();
		foreach($gps_devices as $devices) {
			$found = false;
			if(preg_match("/($devices)/i",$_SERVER['HTTP_USER_AGENT'])){
				$found = true;
				break;
			}
		}
		if ($found) {
			return true;
		}
		return false;
	}
	
	// Initialisation
	register_elgg_event_handler('init','system','geolocation_init');
	register_elgg_event_handler('pagesetup','system','geolocation_pagesetup');
	register_elgg_event_handler('init','system','geolocation_gps_devices_support', 10000); // Ensure this runs after other plugins
?>
