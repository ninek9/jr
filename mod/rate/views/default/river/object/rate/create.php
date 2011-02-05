<?php

	$performed_by = get_entity($vars['generic_rate']->owner_guid); // $statement->getSubject();
	$performed_on = get_entity($vars['generic_rate']->guid);

    $url = "<a href=\"{$performed_by->getURL()}\">{$performed_by->name}</a>";
    $string = sprintf(elgg_echo("rate:river:added"),$url) . " <a href=\"{$performed_on->getURL()}\">" . $performed_on->name . "'s</a> " . elgg_echo("rate:river:profile");
	    
	
    echo $string; 

?>