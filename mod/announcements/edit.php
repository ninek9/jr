<?php
/**
    edit.php, part of Announcements
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

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	// Load newsletters model
	require_once(dirname(__FILE__) . "/models/model.php");

	// only for admin
	admin_gatekeeper();
	// set page context
	set_context('admin');
	// Set admin user for user block
	set_page_owner($_SESSION['guid']);

	$title = elgg_view_title(elgg_echo('announcements:edit'));

	// load plugin form into page body
 	$body .= elgg_view('announcements/forms/edit');

	// render requested page
	page_draw(elgg_echo('announcements'),elgg_view_layout("two_column_left_sidebar", '', $title . $body));
?>