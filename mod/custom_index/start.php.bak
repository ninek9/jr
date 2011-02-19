<?php

	/**
	 * Elgg custom index page
	 * 
	 * @package ElggIndexCustom
	 */

	 
    function indexCustom_init() {
        // Extend system CSS with our own styles
		elgg_extend_view('css','custom_index/css');
		// extend_view('js/initialise_elgg','embed/js');
		elgg_extend_view('metatags','custom_index/metatags', 400);		// adding a higher priority may or may not have helped. eric, 11-08-09
       	// Replace the default index page
		register_plugin_hook('index','system','custom_index');
    }
    
    function custom_index() {
			
			if (!include_once(dirname(__FILE__) . "/index.php")) return false;
			return true;
			
		}


    // Make sure the
		    register_elgg_event_handler('init','system','indexCustom_init');

?>