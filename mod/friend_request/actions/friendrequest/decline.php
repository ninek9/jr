<?php

global $CONFIG;
gatekeeper();
action_gatekeeper();

$user = $_SESSION['user'];
if(!$friend = get_entity(get_input("guid",0))) {
	exit;
}

if(remove_entity_relationship($friend->guid, 'friendrequest', $user->guid)) {
	system_message(elgg_echo("friendrequest:remove:success"));
} else {
	system_message(elgg_echo("friendrequest:remove:fail"));
}

forward($_SERVER['HTTP_REFERER']);
?>