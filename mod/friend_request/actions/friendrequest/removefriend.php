<?php

	// Ensure we are logged in
	gatekeeper();
		
	// Get the GUID of the user to friend
	$friend_guid = get_input('friend');
	$friend = get_entity($friend_guid);
	$errors = false;

	// Get the user
	try{
		if ($friend instanceof ElggUser) {
			$_SESSION['user']->removeFriend($friend_guid);
			try {	//V1.1 - Old relationships might not have the 2 as friends...
				$friend->removeFriend($_SESSION['user']->guid);
			}catch(Exception $e) {}
		}
		else
		{
			register_error(sprintf(elgg_echo("friends:remove:failure"),$friend->name));
			$errors = true;
		}
	} catch (Exception $e) {
		register_error(sprintf(elgg_echo("friends:remove:failure"),$friend->name));
		$errors = true;
	}
	if (!$errors)
		system_message(sprintf(elgg_echo("friends:remove:successful"),$friend->name));			
		
	// Forward to the user friends page
	forward("pg/friends/" . $_SESSION['user']->username . "/");
		
?>