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

	// Make sure we're logged in (send us to the front page if not) and admin
	admin_gatekeeper();

	// Load newsletters model
	require_once(dirname(__FILE__) . "/../models/model.php");

	// get input fields
	$announcement_id = (int)get_input('guid');
	$date = get_input('date');
	$title = get_input('title');
	$content = get_input('content');
	$signature = get_input('signature');
	$tags = get_input('tags');
	
	if ( !$announcement_id){
		// redirect if newsletter id not present
        register_error(elgg_echo("announcements:invalid"));
        forward("pg/announcements/");
	}
	$announcement = get_entity($announcement_id);
	if ( !$announcement){
		// redirect if newsletter not exists
        register_error(elgg_echo("announcements:invalid"));
        forward("pg/announcements/");
	}
	
	// if entity is newsletter and we can edit it
	if ($announcement->getSubtype() == 'announcement' && $announcement->canEdit()) {

 		$access = 2; // public access
	
		// Convert title to string of tags into a preformatted array
		$tagarray = string_to_tag_array($tags);

		// Check for empty fields and redirect if required field empty
		if (empty($date) || empty($title) || empty($content) || empty($signature) ) {
			register_error(elgg_echo("announcements:blank"));
			forward("pg/announcements/");

		// Otherwise, update the newsletter 
		} else {
			
			// Set its access according to delivery group (public or loged in)
			$announcement->access_id = $access;
			// Set its information appropriately
			$announcement->date = $date;
			$announcement->title = $title;
			$announcement->content = $content;
			$announcement->signature = $signature;

			// Save the announcement post
			if (!$announcement->save()) {
				register_error(elgg_echo("announcements:save_error"));
				forward("pg/announcements/manage");
			}
			// Now let's add tags. We can pass an array directly to the object property! Easy.
			$announcement->clearMetadata('tags');
			if (is_array($tagarray)) {
				$announcement->tags = $tagarray;
			}
	// Success message
			system_message(elgg_echo("announcements:updated"));

	// Forward to the main newsletters page
			forward("pg/announcements/manage");
		}
	}
		
?>
