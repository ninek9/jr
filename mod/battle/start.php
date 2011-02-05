<?php

	/**
	 *  JR Battles
	 * This plugin provides voting competition between two selected teams.
	 * 
	 * @package battle
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Eric Zanol ezanol@gmail.com
	 * @copyright Eric Zanol 2009
	 * @link http://www.candlesandfoil.com
	 */

function battle_init() {
	// Load system configuration
	global $CONFIG;
	
	// Register a page handler, so we can have nice URLs
	register_page_handler('battle','battle_page_handler');
	
	// Extend the elgg topbar
	extend_view('elgg_topbar/extend','battle/topbar');
	
	// Register a notification handler for site messages
	//register_notification_handler("site", "battle_site_notify_handler");
	//if (is_callable('register_notification_object'))
	register_notification_object('object','battle',elgg_echo('battle:new'));
		
	// Override metadata permissions
    //register_plugin_hook('permissions_check:metadata','object','battle_can_edit_metadata');
}

/**
* Override the canEditMetadata function to return true for messages
*
*/
function battle_can_edit_metadata($hook_name, $entity_type, $return_value, $parameters) {

   global $battleflag;
   
   if ($battleflag == 1) {
	   $entity = $parameters['entity'];
	   if ($entity->getSubtype() == "battle") {
		   return true;
	   }
   }
   return $return_value;
}

/**
* battle page handler; allows the use of fancy URLs
*
* @param array $page From the page_handler function
* @return true|false Depending on success
*/
function battle_page_handler($page) {
   
   // The first component of a messages URL is the username
   if (isset($page[0])) {
	   set_input('username',$page[0]);
   }
   
   // The second part dictates what we're doing
   if (isset($page[1])) {
	   switch($page[1]) {
		case "read":
			set_input('battle',$page[2]);
			include(dirname(__FILE__) . "/read.php");
			return true;
			break;
	   }
   // If the URL is just 'battle/username', or just 'battle/', load the standard messages index
   } else {
	   include(dirname(__FILE__) . "/index.php");
	   return true;
   }
   
   return false;
   
}


// Make sure the battle initialisation function is called on initialisation
register_elgg_event_handler('init','system','battle_init');

// Register actions
global $CONFIG;