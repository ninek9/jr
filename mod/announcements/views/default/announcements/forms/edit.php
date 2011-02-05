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

	// get id of modified newsletter entity and redirect if not present
	$announcement_id = (int)get_input('id');
	if ( ! $announcement_id ){
        system_message(elgg_echo("announcements:invalid_announcement"));
        forward("pg/announcements/");
	}
	// loading newsletter entity for modification
	$announcement = get_entity($announcement_id);
	//get the full page owner entity
	$entity = get_entity(page_owner());

	// building edit form
	$form_body = '';
	$form_body .= elgg_echo('announcements:manage:date');
	$form_body .= elgg_view('input/calendar', array('internalname' => 'date', 'value' => $announcement->date ));
	$form_body .= '<br />';
	$form_body .= elgg_echo('announcements:manage:title');
	$form_body .= elgg_view('input/text', array('internalname' => 'title', 'value' => $announcement->title));
	$form_body .= elgg_echo('announcements:manage:content');
	$form_body .= elgg_view('input/longtext', array('internalname' => 'content', 'value' => $announcement->content));
    $form_body .= elgg_echo('announcements:manage:signature');
	$form_body .= elgg_view('input/text', array('internalname' => 'signature', 'value' => $announcement->signature));
	
	$form_body .= elgg_echo('announcements:manage:tags');
	$form_body .= elgg_view('input/text', array('internalname' => 'tags', 'value' => $announcement->tags));
	
	$form_body .= elgg_view('input/submit', array('value' => elgg_echo('announcements:manage:update')));
	$form_body .= elgg_view('input/hidden', array('internalname' => 'guid', 'value' => $announcement->guid));

	echo elgg_view('input/form', array('body' => $form_body, 'action' => $CONFIG->url . "action/announcements/edit"));
	
?>
