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
	$english = array(
		//Titles
			'geolocation:map' => 'Geolocation Map',
		//Fields & Labels
			'location' => 'Location',
	 		'groups:location' => 'Location',
		//Messages
			'geolocation:messages:unavaiblaemap' => 'The map option is unavailable. %s',
			'geolocation:messages:loading' => 'Loading map...',
			'geolocation:messages:unknowplace' => 'Your location was not found. Please write your location above.',
		//Settings
			'geolocation:settings:apikey:label' => 'Enter your Google Maps API Key',
			'geolocation:settings:apikey:help' => 'You can obtain an API Key %s.',
		//Input
			'geolocation:input:gotoaddress' => 'Go to address',
			'geolocation:input:go' => 'Go',
			'geolocation:input:location:unknow' => 'Unknow',
	);
	add_translation("en",$english);
?>