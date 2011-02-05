<?php
	/**
	 * Login by Email
	 * 
	 * @author Pedro Prez
	 * @link http://community.elgg.org/pg/profile/pedroprez
	 * @copyright (c) Keetup 2009
	 * @link http://www.keetup.com/
	 * @license GNU General Public License (GPL) version 2
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");
	global $CONFIG;

	gatekeeper();
	action_gatekeeper();
	
	trigger_plugin_hook('usersettings:save:loginbyemail','user');
	
	forward($_SERVER['HTTP_REFERER']);
	
?>