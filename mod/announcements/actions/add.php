<?php

/**
    add.php, part of Announcements
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

	// Make sure we're logged in (send us to the front page if not)
	admin_gatekeeper();

	// Load newsletters model
	require_once(dirname(__FILE__) . "/../models/model.php");
	
	$date = get_input('date');
	$title = get_input('title');
	$content = get_input('content');
	$signature = get_input('signature');
	$tags = get_input('tags');
	
 	$access = 2; // public access
	

	// Cache to the session
	$_SESSION['announce_date'] = $date;
	$_SESSION['announce_title'] = $title;
	$_SESSION['announce_content'] = $content;
 	$_SESSION['announce_signature'] = $signature;
 	$_SESSION['announce_tags'] = $tags;
 	
	// Convert title to string of tags into a preformatted array
	$tagarray = string_to_tag_array($tags);

	// Check for empty fields
	if (empty($date) || empty($title) || empty($content) || empty($signature)) {
		register_error(elgg_echo("announcements:blank"));
		forward("pg/announcements/manage");

	// Otherwise, save the announcement post
	} else {
			
	// Initialise a new ElggObject
			$announcement = new ElggObject();
	// Tell the system it's a blog post
			$announcement->subtype = "announcement";
	// Set its owner to the current user
			$announcement->owner_guid = $_SESSION['user']->getGUID();
	// Set its access according to delivery group (public or loged in)
			$announcement->access_id = $access;
	// Set its information appropriately
			$announcement->date = $date;
			$announcement->title = $title;
			$announcement->content = $content;
			$announcement->signature = $signature;

	// Save the newsletter post
			if (!$announcement->save()) {
				register_error(elgg_echo("announcements:save_error"));
				forward("pg/announcements/manage");
			}
	// Now let's add tags. We can pass an array directly to the object property! Easy.
			if (is_array($tagarray)) {
				$announcement->tags = $tagarray;
			}
	// Success message
			system_message(elgg_echo("announcements:posted"));
	// Remove the blog post cache
			unset($_SESSION['announce_date']);
			unset($_SESSION['announce_title']);
			unset($_SESSION['announce_content']);
			unset($_SESSION['announce_signature']);
			unset($_SESSION['announce_tags']);
	// Forward to the main announcements page
			forward("pg/announcements/manage");
		}
		
?>
