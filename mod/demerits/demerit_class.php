<?php
/**
 * Demerits
 * 
 * @package Demerits
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt
 * @copyright Brett Profitt 2009
 * @link http://eschoolconsultants.com
 */

/**
 * Add a few more methods to this class.
 * Make sure the delete function respects the reportedcontent tie-ins.
 * @author Brett Profitt
 *
 */
class Demerit extends ElggObject {
	
	/**
	 * Set up the subtype.
	 * @see engine/lib/ElggObject#initialise_attributes()
	 */
	protected function initialise_attributes() {
		parent::initialise_attributes();
		$this->attributes['subtype'] = 'demerit';
	}
	
	/**
	 * Create or load a demerit for a user.
	 * @param $guid Guid
	 * @param $user_guid
	 * @param $state
	 * @return unknown_type
	 */
	public function __construct($guid=null, $user_guid=null, $description=null, $state='submitted') {
		
		parent::__construct($guid);
		
		if ($guid) {
			// stop processing.
			return true;
		}
		
		if (!$user=get_entity($user_guid)) {
			return false;
		}
		if (!in_array($state, demerits_get_supported_demerit_states(false))) {
			$state = 'submitted';
		}
		
		$this->owner_guid = $user_guid;
		$this->container_guid = $user_guid;
		$this->access_id = ACCESS_PRIVATE;
		$this->description = $description;
		$this->save();
		
		return $this->set_state($state);
	}
	
	public function delete($reported_content = true) {
		if ($reported_content AND $reported = get_entity($this->reported_content_id) 
		AND $reported->getSubtype() == 'reported_content') {
			$reported->delete();
		}
		
		return parent::delete();
	}
	
	/**
	 * Changes the state of a demerit.
	 * Optionally sets the changed_by to $user_guid
	 * 
	 * @param $state
 	 * @param $user_guid
	 * @return bool
	 */
	public function set_state($new_state, $reported_content=true, $user_guid=null) {
		// @todo check if we need to archive an RC item
		
		if (!in_array($new_state, demerits_get_supported_demerit_states(false))) {
			return false;
		}
		
		if ($user_guid) {
			if (!$user = get_entity($user_guid)) {
				return false;
			}
		} else {
			$user = get_loggedin_user();
		}
		
		// set the state to the new state, but reset it if the plugin hook returns false.
		// this is so the count functions work as expected.
		$old_state = $this->state;
		if ($this->state = $new_state) {
			if (!trigger_plugin_hook('demerits:change_state', $this->getType(), array('owner'=>get_entity($this->owner_guid), 'demerit'=>$this, 'old_state'=>$old_state, 'new_state'=>$new_state), true)) {
				$this->state = $old_state;
				return false;
			}
			$this->state_changed_by = $user->getGUID();
			$this->state_changed_on = date('Y-m-d H:i:s');
			return true;
		}
		
		// reset to expiration date for new state.
		// @todo use the original date or now() from a state change?
		if (function_exists('expirationdate_set')) {
			expirationdate_unset($this->getGUID());
			$expire_in = get_plugin_setting($state . '_expiration_days', 'demerits');
			expirationdate_set($demerit->getGUID(), "+ $expire_in days", $disable_only=false);
			
			//$original_date = $this->time_created;
		}
		
		return false;
	}
}