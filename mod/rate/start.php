<?php
/**
 *	RATE PLUGIN
 *	@package rate
 *	@author Miguel Montes mmontesp@gmail.com
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) Miguel Montes 2008
 *	@link http://community.elgg.org/pg/profile/mmontesp
 **/

// Start
function rate_init(){
	global $CONFIG;
	register_translations($CONFIG->pluginspath . "rate/languages/");
	elgg_extend_view('css', 'rate/css');
	
	//show points and rank on user listings
	elgg_extend_view('profile/status','rate/listingrating');
}

// Events
register_elgg_event_handler('init','system','rate_init');

function allow_rate ($entity){
	if (isloggedin()) {
		$viewer = get_loggedin_user();
		
		// don't let the owner of the entity vote on stuff they own. checks viewer guid against entity guid.
		if ($viewer->guid == $entity->guid) {
			return false;
		}
		
		// if the viewer has already already submitted a rating, don't let them rate again. checks all ratings owners against the current viewer.
		
		$annotations = $entity->getAnnotations('generic_rate');
		foreach ($annotations as $annotation) {
			if ($annotation->owner_guid == $_SESSION['user']->guid) {
				return false;
			}
		}
		return true;
	} else {
		return false;
	}
}

// Actions
register_action("rate/add",false,$CONFIG->pluginspath . "rate/actions/add.php");

?>