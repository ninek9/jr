<?php
/**
    delete.php, part of Announcements
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
// Loading Elgg engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Load announcements model
require_once(dirname(__FILE__) . "/models/model.php");

// Define context
set_context('admin');
// only for admin user
admin_gatekeeper();

global $CONFIG;

$announcement_id = (int) get_input('id',0);

// Make sure we actually have permission to edit
$announcement = get_entity($announcement_id);

if ($announcement->getSubtype() == "announcement" && $announcement->canEdit()) {

	// Delete it!
	$rowsaffected = $announcement->delete();
	if ($rowsaffected > 0) {
		// Success message
		system_message(elgg_echo("announcements:deleted"));
	} else {
		// show error
		register_error(elgg_echo("announcements:notdeleted"));
	}
}

// Forward to the manage page
forward("pg/announcements/manage");

?>
