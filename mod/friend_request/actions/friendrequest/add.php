<?php
// Friend request relationship plugin. This action code is based on the regular friend/add action but with a different relationship type.

//Ensure we're logged in
gatekeeper();

//If the user has a referer string then let's send them back to their previous page, otherwise we'll send them to their friend list.
$forward_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "pg/friends/" . $_SESSION['user']->username . "/";

//Get our data
$friend_guid = (int) get_input('friend');
$friend = get_entity($friend_guid);
$user_guid = (int) $_SESSION['guid'];
$user = get_entity($user_guid);

$errors = false;

//Now we need to attempt to create the relationship
if(get_class($user) != "ElggUser" || get_class($friend) != "ElggUser") {
	$errors = true;
	register_error(elgg_echo("friendrequest:add:failure"));
} else {
	//New for v1.1 - If the other user is already a friend (fan) of this user we should auto-approve the friend request...
	if(check_entity_relationship($friend_guid, "friend", $user_guid)) {
		try {
			if(isset($CONFIG->events['create']['friend'])) {
				$oldEventHander = $CONFIG->events['create']['friend'];
				$CONFIG->events['create']['friend'] = array();			//Removes any event handlers
			}

			$user->addFriend($friend_guid);
			system_message(sprintf(elgg_echo("friends:add:successful"),$friend->name));
			
			if(isset($CONFIG->events['create']['friend'])) {
				$CONFIG->events['create']['friend'] = $oldEventHander;
			}
			
			forward($forward_url);
		} catch (Exception $e) {
			register_error(sprintf(elgg_echo("friends:add:failure"),$friend->name));
			$errors = true;
		}
	} else {
		try {
			$result = add_entity_relationship($user_guid, "friendrequest", $friend_guid);
			if($result == false) {
				$errors = true;
				register_error(sprintf(elgg_echo("friendrequest:add:exists"),$friend->name));
			}
		} catch(Exception $e) {	//register_error calls insert_data which CAN raise Exceptions.
			$errors = true;
			register_error(sprintf(elgg_echo("friendrequest:add:exists"),$friend->name));
		}
	}
}

if(!$errors) {
	system_message(sprintf(elgg_echo("friendrequest:add:successful"),$friend->name));
}

forward($forward_url);

?>