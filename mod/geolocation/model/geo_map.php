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

	//Constant for geolocation module
	define('GEOLOCATION_MAP_LAT','0');
	define('GEOLOCATION_MAP_LNG','0');
	define('GEOLOCATION_MAP_ZOOM_WORLD',2);
	define('GEOLOCATION_MAP_ZOOM_PLACE',10);
	
	/* Type Options
	 *
	 * ROADMAP displays the normal, default 2D tiles of Google Maps.
     * SATELLITE displays photographic tiles.
     * HYBRID displays a mix of photographic tiles and a tile layer for prominent features (roads, city names).
     * TERRAIN displays physical relief tiles for displaying elevation and water features (mountains, rivers, etc.).
	*/
	define('GEOLOCATION_MAP_TYPE','ROADMAP');
	
	class GeoMap {
		
		//private vars
		private $lat;
		private $lng;
		private $zoom;
		private $type;
		
		//Constructor	
		public function __construct($options){

			//Set the options
			foreach($options as $key_option => $option){
				if(isset($this->$key_option))
					$this->$key_option = $option;
			}
			
			$this->lat = (float) GEOLOCATION_MAP_LAT;
			$this->lng = (float) GEOLOCATION_MAP_LNG;
			$this->zoom = GEOLOCATION_MAP_ZOOM_WORLD;
			$this->type = GEOLOCATION_MAP_TYPE;
		}
		
		/*
		 * Setters and getters
		 */
		 
		public function getLat(){
			return $this->lat;
		}
			
		public function setLat($lat){
			$this->lat = (float) $lat;
		}
		
		public function getLng(){
			return $this->lng;
		}
			
		public function setLng($lng){
			$this->lng = (float) $lng;
		}
		
		public function getZoom(){
			return $this->zoom;
		}
			
		public function setZoom($zoom){
			$this->zoom = (int) $zoom;
		}
		
		public function getType(){
			return $this->type;
		}
			
		public function setType($type){
			$this->type = strtoupper($type);
		}
		
	}
?>