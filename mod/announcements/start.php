<?php
/**
    start.php, part of Announcements
    Copyright (C) 2009, Lorinthe, BV and Web100 Net technology Center,Ltd
    Author: Bogdan Nikovskiy, bogdan@web100.com.ua
	    
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
			    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
					    
    You should have received a copy of the GNU General Public License
    along with this program. If not, see <http://www.gnu.org/licenses/>.
						    	
*/

// unique function for plugin initialization
function announcements_init(){
    global $CONFIG;
    // registering languages translation constants
    register_translations($CONFIG->pluginspath . "announcements/languages/");
    // register handler for announcements list page
    register_page_handler('announcements', 'announcements_list_handler');
    // registering action for add announcements
    register_action('announcements/add', false, $CONFIG->pluginspath . 'announcements/actions/add.php');
    // registering action for edit announcements
    register_action('announcements/edit', false, $CONFIG->pluginspath . 'announcements/actions/edit.php');
    // register plugin widget
    add_widget_type('announcements', elgg_echo('announcements:widget:title'), elgg_echo('announcements:widget:description'));
	// registering css styles
	extend_view('css','announcements/css');
	// Register entity type
	register_entity_type('object','announcement');
}

// handler for page setup, registered to add menu items for page menu
function announcements_pagesetup(){
	global $CONFIG;
	// if requested admin area by logged admin
	if ( get_context() == 'admin' && isadminloggedin() ){
		add_submenu_item( elgg_echo('announcements:manage'), $CONFIG->wwwroot . 'pg/announcements/manage/');
	} else {
		if ( isloggedin() ) // only for logged in users
			add_submenu_item( elgg_echo('announcements:show'), $CONFIG->wwwroot . 'pg/announcements/');
	}
}

// handler for list page
function announcements_list_handler($page){
	global $CONFIG;
	// if requested announcements/manage url include admin area script
	if ( isset($page[0]) && $page[0] == 'manage' )
		include($CONFIG->pluginspath . 'announcements/manage.php');
	else    // else include index page for news
		include($CONFIG->pluginspath . 'announcements/index.php');
}

// register plugin event handler for plugin initialization
register_elgg_event_handler('init', 'system', 'announcements_init');
// register plugin event handler for page setup
register_elgg_event_handler('pagesetup', 'system', 'announcements_pagesetup');
// define constant for using in other parts
define('ANNOUNCEMENTS_SHORT_DESCRIPTION_LEN', 20);

?>
