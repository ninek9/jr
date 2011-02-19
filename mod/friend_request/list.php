<?php
	/**
	 * list_entities_from_relationship modified a little bit...
	 */
	function list_fr_for_user($relationship_guid) {	
		$relationship = 'friendrequest';
		$inverse_relationship = true;
		$type = "user";
		$subtype = "";
		$owner_guid = 0;
		$limit = 10;
		$fullview = false;
		$viewtypetoggle = false;
		$pagination = true;
		$limit = (int) $limit;
		$offset = (int) get_input('offset');
		$count = get_entities_from_relationship($relationship, $relationship_guid, $inverse_relationship, $type, $subtype, $owner_guid, "", $limit, $offset, true);
		$entities = get_entities_from_relationship($relationship, $relationship_guid, $inverse_relationship, $type, $subtype, $owner_guid, "", $limit, $offset);
		
		return fr_view_entity_list($entities, $count, $offset, $limit, $fullview, $viewtypetoggle);
	}
	
	//elgg_view_entity_list just with the view modififed
	function fr_view_entity_list($entities, $count, $offset, $limit, $fullview = true, $viewtypetoggle = true, $pagination = true) {
		$count = (int) $count;
		$offset = (int) $offset;
		$limit = (int) $limit;
		
		$context = get_context();
		
		$html = elgg_view('friendrequest/entity_list',array(
												'entities' => $entities,
												'count' => $count,
												'offset' => $offset,
												'limit' => $limit,
												'baseurl' => $_SERVER['REQUEST_URI'],
												'fullview' => $fullview,
												'context' => $context, 
												'viewtypetoggle' => $viewtypetoggle,
												'viewtype' => get_input('search_viewtype','list'), 
												'pagination' => $pagination
											  ));
			
		return $html;
		
	}
	
	
	if (!$owner = page_owner_entity()) {
		gatekeeper();
		set_page_owner($_SESSION['user']->getGUID());
		$owner = $_SESSION['user'];
	}
	
	$area1 = elgg_view_title(elgg_echo('friendrequests'));
	$area2 = list_fr_for_user($_SESSION['user']->guid);
	$body = elgg_view_layout('two_column_left_sidebar', '', $area1 . $area2);
	
	echo page_draw(sprintf(elgg_echo("friendrequests:title"),$owner->name),$body);
	
?>