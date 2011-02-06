<?php
/**
 * Demerits
 * 
 * @package Demerits
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt
 * @copyright Brett Profitt 2009
 * @link http://eschoolconsultants.com
 * 
 * 
 * 
 */

/**
 * Start up plugin. 
 * 
 * @return unknown_type
 */
function demerits_init() {
	global $CONFIG;
	
	require_once 'demerit_class.php';
	
	//run_function_once('demerits_run_once');
	register_entity_type('object', 'demerit');
	
	register_page_handler('demerits','demerits_pagehandler');
	
	register_action("demerits/save", false, $CONFIG->pluginspath . "demerits/actions/save.php");
	register_action("demerits/delete", false, $CONFIG->pluginspath . "demerits/actions/delete.php");
	register_action("demerits/consequences/save", false, $CONFIG->pluginspath . "demerits/actions/consequences/save.php");
	register_action("demerits/consequences/delete", false, $CONFIG->pluginspath . "demerits/actions/consequences/delete.php");
	
	extend_view('css', 'demerits/css');
	extend_view('js/initialise_elgg', 'demerits/js');
	
	//tie into reported content.
	if (get_plugin_setting('connect_reported_content_state', 'demerits')) {
		//register_elgg_event_handler('create', 'object', 'demerits_auto_create_for_reported_content');
		register_plugin_hook('reportedcontent:add', 'object', 'demerits_reported_content_add');
		register_plugin_hook('reportedcontent:delete', 'object', 'demerits_reported_content_delete');
		register_plugin_hook('reportedcontent:archive', 'object', 'demerits_reported_content_archive');
	}
	
	if (isadminloggedin()) {
		extend_view('profile/menu/adminlinks', 'demerits/admin_links');
	}
	
	// on adding a new demerit...
	// run the clean first to remove any old demerits
	register_plugin_hook('demerits:add', 'object', 'demerits_clean_demerits', 100);
	register_plugin_hook('demerits:add', 'object', 'demerits_process_user_consequences', 500);
	register_plugin_hook('demerits:change_state', 'object', 'demerits_process_user_consequences');
	
	// pull in all the consequences hooks and functions
	require_once 'consequences_lib.php';
	
	return true;
}

/**
 * Add subtype and class.
 * 
 * @return bool
 */
function demerits_run_once() {
	global $CONFIG;
	
	return add_subtype("object", "demerit", "Demerit");
}

/**
 * Serve up pages.
 * 
 * @param $page
 * @return unknown_type
 */
function demerits_pagehandler($page) {
	global $CONFIG;
	
	admin_gatekeeper();
	$title = elgg_echo('demerits:demerits');
	$content_title = '';
	$page0 = (array_key_exists('0', $page)) ? $page[0] : '';
	switch($page0){
		default:
		case 'list':
			if ($user = get_user_by_username($page[1])) {
				//$demerits = elgg_get_entities('demerit', '');
				$guid = $user->getGUID();
			} else {
				$guid = '';
			}
			$content_title = elgg_view_title(elgg_echo('demerits:demerits'));
			
			if ($state = get_input('state', 'submitted') AND in_array($state, demerits_get_supported_demerit_states(false))) {
				$demerits = list_entities_from_metadata('state', $state, 'object', 'demerit', $guid, 10);
			} else {
				//$demerits = get_entities_from_metadata_multi(array(''))
				$demerits = list_entities('object', 'demerit', $guid, 10);
			}
			
			
			$mass_selection = elgg_echo('demerits:with_selected') 
				. elgg_view('input/pulldown', array(
					'internalname' => 'demerits_mass_state',
					'options_values' => array_merge(array(''=>''), demerits_get_supported_demerit_states()),
					// @todo: this is a horrible hack.
					'js' => "onChange = \"$('select[name=demerits_mass_state]').val($(this).val());\""
				))
				. " <a onClick=\"demeritsSubmitForm('changeState');\" style=\"cursor: pointer;\">" . elgg_echo('demerits:change_state') . '</a>'
				. " | <a onClick=\"demeritsSubmitForm('delete');\" style=\"cursor: pointer;\">" . elgg_echo('delete') . '</a>'
				. " | <a onClick=\"$('input[name=\'demerit_guids[]\']').attr('checked', true);\" style=\"cursor: pointer;\">" . elgg_echo('demerits:check_all') . '</a>';
			
			$content  = '<div class="contentWrapper">';
			$content .= elgg_echo('demerits:state');
			$content .= elgg_view('input/form', array(
				'action' => $_SERVER['REQUEST_URI'],
				'method' => 'GET',
				'body' => elgg_view('input/pulldown', array(
					'internalname' => 'state',
					'value' => $state,
					'options_values' => array('' => elgg_echo('demerits:any')) + demerits_get_supported_demerit_states(true),
					'js' => 'onChange=this.form.submit();'
					)
				)
			));
			// can't do this here because of form.submit() problems on the change state.
			$content .= $mass_selection . "<br />";
			$content .= ($demerits) ? $demerits : '<h3>' . elgg_echo('demerits:no_demerits') . '</h3>';
			$content .= $mass_selection . '</div>';

			break;
			
		case 'edit':
			if (!$demerit = get_entity($page[1])) {
				register_error(elgg_echo('demerits:errors:invalid_demerit_guid'));
				forward($_SERVER['HTTP_REFERER']);
			}
			$content = elgg_view('demerits/edit', array('entity'=>$demerit));
			break;
		
		case 'add':
			if ($user = get_user_by_username($page[1])) {
				//register_error(elgg_echo('demerits:errors:invalid_username'));
				//forward($_SERVER['HTTP_REFERER']);
				$params = array('owner' => $user);
			} else {
				$params = array();
			}
			$content = elgg_view('demerits/edit', $params);
			break;
			
		case 'consequences':
			$page1 = (array_key_exists('1', $page)) ? $page[1] : '';
			switch ($page1) {
				default:
				case 'list':
					// form uses action save_consequences
					$content_title = elgg_view_title(elgg_echo('demerits:demerits'));
					$content  = '<div class="contentWrapper">';
					$content .= elgg_view('demerits/consequences/list');
					$content .= elgg_view('demerits/consequences/edit', array('hidden'=>true));
					$content .= '</div>';
					break;
				
				case 'add':
				case 'edit':
					if (!$consequence = get_entity($page[2])) {
						register_error(elgg_echo('demerits:errors:invalid_consequence_id'));
						forward($_SERVER['HTTP_REFERER']);
					}
					$content = elgg_view('demerits/consequences/edit', array('consequence'=>$consequence));
					break;
			}
			break;
	}
	$body = elgg_view_layout('two_column_left_sidebar', '', '' . $content_title . $content);
	page_draw($title, $body);
}

/**
 * Draw menus for pages
 * 
 * @return unknown_type
 */
function demerits_pagesetup() {
	global $CONFIG;
	
	if (get_context() == 'admin' && isadminloggedin()) {
		add_submenu_item(elgg_echo('demerits:demerits'), $CONFIG->wwwroot . 'pg/demerits');
		//add_submenu_item(elgg_echo('demerits:add_demerits'), $CONFIG->wwwroot . 'pg/demerits/');
	}
	
	//add submenu options
	if (get_context() == 'demerits') {
		if ((page_owner() == $_SESSION['guid'] || !page_owner()) && isloggedin()) {
			$add = elgg_echo('demerits:add_demerit');
			$list = elgg_echo('demerits:admin:list_demerits');
			$consequences = elgg_echo('demerits:admin:list_consequences');
			
			add_submenu_item($add, $CONFIG->wwwroot . "pg/demerits/add");
			add_submenu_item($list, $CONFIG->wwwroot . "pg/demerits");
			add_submenu_item($consequences, $CONFIG->wwwroot . "pg/demerits/consequences");
		}
	}
}

/**
 * Add a demerit to a user.
 * 
 * @param $guid User Guid
 * @param $description Description of Demerit
 * @param $state State of demerit
 * @return Bool on success.
 */
function demerits_add_demerit($guid, $description, $state) {
	if (!$user = get_entity($guid) AND $user instanceof Elgguser) {
		return false;
	}
	
	if ($demerit = new Demerit('', $guid, $description, $state)) {
		$demerit->save();
		if (!trigger_plugin_hook('demerits:add', $demerit->getType(), array('owner'=>$user, 'demerit'=>$demerit), true)) {
			$demerit->delete();
			return false;
		}
	}
	
	if (function_exists('expirationdate_set')) {
		$expire_in = get_plugin_setting($state . '_expiration_days', 'demerits');
		expirationdate_set($demerit->getGUID(), "+ $expire_in days", $disable_only=false);
	}
	
	return $demerit;
}

/*
 * Hook for binding added reportedcontent to demerits
 * 
 * @param $hook
 * @param $entity_type
 * @param $returnvalue
 * @param $params
 * @return unknown_type
 */
function demerits_reported_content_add($hook, $entity_type, $returnvalue, $params) {

	// if the reported content has an owner and it is NOT the logged in user,
	// the demerit goes to that person.
	
	if (!$content_owner = get_entity($params['entity']->content_owner)) { 
		$content_owner = get_entity($params['entity']->owner_guid);
	}
	$state = get_plugin_setting('connect_reported_content_state', 'demerits');
	
	$description = elgg_echo('demerits:from_reported_content') . $params['entity']->description;
	$demerit = demerits_add_demerit($content_owner->getGUID(), $description, $state);
	$demerit->reported_content_id = $params['entity']->getGUID();
	return $demerit->save();
	//return demerits_add($content_owner->getGUID(), 'inappropriate_content', $params['entity']->description, $params['entity']->getGUID(), $state);	
}

/*
* Hook for binding deleted reportedcontent to demerits
 * 
 * @param $hook
 * @param $entity_type
 * @param $returnvalue
 * @param $params
 * @return unknown_type
 */
function demerits_reported_content_delete($hook, $entity_type, $returnvalue, $params) {
	if ($demerits = elgg_get_entities_from_metadata('reported_content_id', $params['entity']->getGUID(), '', 'demerit')
		AND is_array($demerits)) {
		foreach ($demerits as $demerit) {
			if (!$demerit->delete(false)) {
				return false;
			}
		}
	}
	
	return true;
}


/*
* Hook for binding archived reportedcontent to demerits
 * 
 * @param $hook
 * @param $entity_type
 * @param $returnvalue
 * @param $params
 * @return unknown_type
 */
function demerits_reported_content_archive($hook, $entity_type, $returnvalue, $params) {
	if ($demerits = elgg_get_entities_from_metadata('reported_content_id', $params['entity']->getGUID(), '', 'demerit')
		AND is_array($demerits)) {
		foreach ($demerits as $demerit) {
			if (!$demerit->set_state('archived', false)) {
				return false;
			}
		}
	}
	
	return true;
}

/**
 * Returns a count of demerits of $state for $user
 * @param $user GUID of user.
 * @param $state State of demerits
 * @return unknown_type
 */
function demerits_get_count($user_guid, $state=null) {
	if ($state) {
		return elgg_get_entities_from_metadata('state', $state, 'object', 'demerit', $user_guid, '', '', '', '', true);
	} else {
		return elgg_get_entities('object', 'demerit', $user_guid, '', '', '', true);
	}
}

/**
 * Removes all demerits > expiration time in case the cron hasn't run.
 * @param $hook
 * @param $entity_type
 * @param $returnvalue
 * @param $params
 * @return unknown_type
 */
function demerits_clean_demerits($hook, $entity_type, $returnvalue, $params) {
	if (function_exists('expirationdate_expire_entities')) {
		expirationdate_expire_entities(false);
	}
}

function demerits_process_user_consequences($hook, $entity_type, $returnvalue, $params) {
	$owner = $params['owner'];
	$demerit = $params['demerit'];
	if (array_key_exists('new_state', $params)) {
		$new_state = $params['new_state'];
	} else {
		$new_state = null;
	}
	// @todo add support for consequences with any state of demerits
	//$all_demerits = demerits_get_count($user->getGUID());
	$states = demerits_get_supported_demerit_states(false);
	
	// only run the consequences for this state.
	if ($new_state && in_array($new_state, $states)) {
		$states = array($new_state);
	}
	
	foreach ($states as $state) {
		// add one for the current demerit being added.
		$count = demerits_get_count($owner->getGUID(), $state);
		$test = elgg_get_entities('object', 'demerit_consequence', '', '', 10000);
		$consequences = elgg_get_entities_from_metadata('demerit_count', $count, 'object', 'demerit_consequence', '', 10000);
		// can't pass multiple metadata values so we have to foreach to get the real ones.
		if (!is_array($consequences)) {
			continue;
		}
		foreach ($consequences as $consequence) {
			if ($consequence->demerit_state != $state) {
				continue;
			}
			demerits_execute_consequence($consequence, $demerit, $owner);
		}
	}
}

/**
 * Dispatch function for executing consequences.
 * 
 * @param $consequence The consequence we're on.
 * @param $demerit The demerit that caused this consequence
 * @param $user The
 * @return unknown_type
 */
function demerits_execute_consequence($consequence, $demerit, $user) {
	if (!in_array($consequence->action, demerits_get_supported_consequence_actions(false))) {
		return false;
	}
	$params = array(
		'user' => $user,
		'consequence' => $consequence,
		'demerit' => $demerit
	);
	if(!trigger_plugin_hook('demerits:execute_consequence', $demerit->getType(), $params, true)) {
		return false;
	}
	
	$hook = 'demerits:execute_consequence_' . $consequence->action;
	return trigger_plugin_hook($hook, $demerit->getType(), $params, true);
}

/**
 * Returns a list of supported actions for consequences.
 * Returns array('action1', 'action2')
 *  
 * @param $friendly_names bool to return array('internal_name' => 'Pretty Name');
 * @return array
 */
function demerits_get_supported_consequence_actions($friendly_names = true) {
	$supported_actions = array(
		'notify',
		'ban',
		'suspend',
		'delete'
	);
	
	sort($supported_actions);
	
	if ($friendly_names) {
		$friendly_actions = array();
		foreach ($supported_actions as $action) {
			$friendly_actions[$action] = elgg_echo('demerits:actions:' . $action);
		}
		return $friendly_actions;
	}
	
	return $supported_actions;
}

function demerits_get_supported_demerit_states($friendly_names = true) {
	$supported_states = array(
		'confirmed',
		'submitted',
		'archived'
	);
	
	sort($supported_states);
	
	if ($friendly_names) {
		$friendly_states = array();
		foreach ($supported_states as $state) {
			$friendly_states[$state] = elgg_echo('demerits:states:' . $state);
		}
		return $friendly_states;
	}
	
	return $supported_states;
}

function demerits_get_supported_types($friendly_names = true) {
	$supported_types = array(
		'inappropriate_content',
		'harrassment',
	);
	
	sort($supported_types);
	
	if ($friendly_names) {
		$friendly_types = array();
		foreach ($supported_types as $types) {
			$friendly_types[$types] = elgg_echo('demerits:types:' . $types);
		}
		return $friendly_types;
	}
	
	return $supported_types;
}

/**
 * Returns an array of required params for $consequence in they format
 * array(param_name => array('type' => param_type, ...)
 * 
 * @param $consequence
 * @return array
 */
function demerits_get_required_consequence_params($consequence_action) {
	switch ($consequence_action) {
		case 'notify':
			return array(
				'to' => array('type' => 'text'),
				//'from' => array('type' => 'text'),
				'subject' => array('type' => 'text'),
				'body' => array('type' => 'longtext')
			);
			break;

		case 'suspend':
			return array('num_days' => array('type' => 'text'));
			break;

		case 'ban':
		case 'delete':
			return array();
			break;
	}
}

register_elgg_event_handler('init','system','demerits_init');
register_elgg_event_handler('pagesetup', 'system', 'demerits_pagesetup');