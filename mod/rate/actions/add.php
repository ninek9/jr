<?php
/**
 *	RATE PLUGIN
 *	@package rate
 *	@author Miguel Montes mmontesp@gmail.com
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) Miguel Montes 2008
 *	@link http://community.elgg.org/pg/profile/mmontesp
 **/

// Make sure action is secure
gatekeeper();
action_gatekeeper();
	
// Get input data
$guid = (int) get_input('guid');
$rate = (float) get_input('rate');
$rateComments = (string) get_input('psComments');

// Make sure we actually have the entity
if (!$entity = get_entity($guid)) {
	register_error(elgg_echo('rate:badguid'));
	forward();
}

// Make sure we have a correct rating
if ($rate && ($rate >= 1 || $rate <= 5)) {
	//$rate--; 
} else {
	register_error(elgg_echo('rate:badrate'));
	forward($entity->getUrl());
}

// have we rated before?	
//if (count_annotations ($entity->guid, $entity->getType(), $entity->getSubtype(), 'generic_rate', "", "", $_SESSION['guid'])){
if (!allow_rate($entity)) {
	register_error(elgg_echo('rate:rated'));
	forward($entity->getUrl());
}
	
// If they haven't rated, save the rate
// removed the type from the annotate() func to fix type error in 1.7
if ($entity->annotate('generic_rate', $rate, 2, $_SESSION['guid']) && $entity->annotate('rate_comment', $rateComments, 2, $_SESSION['guid'])) {
	system_message(elgg_echo('rate:saved'));
} else {
	register_error(elgg_echo('rate:error'));
}

// add to river
add_to_river('river/object/rate/create','generic_rate',$_SESSION['user']->guid,$user->guid);

forward($entity->getUrl());
?>