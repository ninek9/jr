<?php
    /**
     * Elgg Feedback plugin
     * Feedback interface for Elgg sites
     * 
     * @package Feedback
     * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
     * @author Prashant Juvekar
     * @copyright Prashant Juvekar
     * @link http://www.linkedin.com/in/prashantjuvekar
     */

    /*
     * Initialize Plugin
     */
	function feedback_init() {
	
        global $CONFIG;

		// page handler        
		register_page_handler('feedback','feedback_page_handler');
        
        // load the language translations
        register_translations($CONFIG->pluginspath . "feedback/languages/");
        
        // extend the view
		extend_view('page_elements/footer', 'page_elements/feedback');
		
		// extend the site CSS
		extend_view('css','feedback/css');			                       
	}
	
	/**
	 * Feedback Page handler
	 *
	 * @param unknown_type $page
	 */
	function feedback_page_handler($page)
	{
		@include(dirname(__FILE__) . "/feedback.php");
		return true;
	}

	/*
	 * Create Admin Menu
	 */
	function feedback_menu()
	{
		global $CONFIG;
		if (get_context() == 'admin' && isadminloggedin()) {
			add_submenu_item(elgg_echo('feedback:admin:menu'), $CONFIG->url . "pg/feedback");
		}
	}
	
	register_elgg_event_handler('init','system','feedback_init');
	
	// create the admin menu
	register_elgg_event_handler('pagesetup','system','feedback_menu');
	
	// Register actions
	global $CONFIG;
	register_action("feedback/delete", false, $CONFIG->pluginspath."feedback/actions/delete.php");

?>