<?php

/**
 * Friend Request Mod for Elgg - By Zac
 * 
 * Updates: http://www.addicted2kicks.com/devblog/
 *
 * This plugin requires a friend request to be made before someone can become friends.
 * Once the request is approved then both users will be friends.
 * (By default Elgg will let you friend someone and they don't friend you back unless
 * they want. I'd call this more of a "fan" than a "friend" so this mod will make all
 * new relationships work both ways.
 */

function iagree_init() {
	global $CONFIG;
	
	//Load translations file (TODO: I don't think this is required anymore?)
	register_translations($CONFIG->pluginspath . "friend_request/languages/");
	
	//Register our CSS for the topbar notification
	extend_view('css','friendrequest/css');
	
	//Extend topbar to add our link if needed
	extend_view('elgg_topbar/extend','friendrequest/topbar');
	
	//This overwrites the original friend requesting stuff.
	register_action("friends/add", false, $CONFIG->pluginspath . "friend_request/actions/friendrequest/add.php", false);
	
	//Our friendrequest handlers...
	register_action("friendrequest/approve", false, $CONFIG->pluginspath . "friend_request/actions/friendrequest/approve.php");
	register_action("friendrequest/decline", false, $CONFIG->pluginspath . "friend_request/actions/friendrequest/decline.php");
	
	//We need to override the friend remove action to remove the relationship we created
	register_action("friends/remove", false, $CONFIG->pluginspath . "friend_request/actions/friendrequest/removefriend.php");

	//Regular Elgg engine sends out an email via an event. The 400 priority will let us run first.
	//Then we return false to stop the event chain. The normal event handler will never get to run.
	register_elgg_event_handler('create','friend','iagree_event_create_friend',400);
	
	//Handle our add action event:
	register_elgg_event_handler('create','friendrequest','iagree_event_create_friendrequest');
	
	//This will let uesrs view their friend requests
	register_page_handler('friendrequests','friendrequests_page_handler');
}

function iagree_event_create_friend($event, $object_type, $object) {
	global $CONFIG;
		
	if (($object instanceof ElggRelationship) && ($event == 'create') && ($object_type == 'friend') ) {
		//We don't want anything happening here... (no email/etc)
		
		//Returning false will interrupt the rest of the chain.
		//The normal handler for the create friend event has a priority of 500 so it will never be called.	
		return false;
	}
	return true; //Shouldn't get here...
}

//Allow us to send an notification email:
function iagree_event_create_friendrequest($event, $object_type, $object) {
	global $CONFIG;
		
	if (($object instanceof ElggRelationship) && ($event == 'create') && ($object_type == 'friendrequest')) {
		$user_one = get_entity($object->guid_one);
		$user_two = get_entity($object->guid_two);
		
		$view_friends_url = $CONFIG->url . "pg/friendrequests";
		
		// Notify target user
		return notify_user($object->guid_two, $object->guid_one, sprintf(elgg_echo('friendrequest:newfriend:subject'), $user_one->name), 
			sprintf(elgg_echo("friendrequest:newfriend:body"), $user_one->name, $view_friends_url)); 
	}
}

function friendrequests_page_handler($page_elements) {
	global $CONFIG;
	
	//Keep the URLs uniform:
	if (isset($page_elements[1])) {
		forward("pg/friendrequests");
	}
	
	include($CONFIG->pluginspath . "friend_request/list.php"); 
}


function count_friend_requests() {
	global $CONFIG;
	return get_entities_from_relationship('friendrequest', $_SESSION['user']->guid, true, "", "", 0, "", 0, 0, true);
}



register_elgg_event_handler('init','system','iagree_init',100);
?>