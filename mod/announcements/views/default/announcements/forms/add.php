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

	//get the full page owner entity
	$entity = get_entity(page_owner());


	// creating form body
	$form_body = '';
	$form_body .= elgg_echo('announcements:manage:date');
	$form_body .= elgg_view('input/calendar', array('internalname' => 'date', 'value' => isset($_SESSION['announce_date']) ? $_SESSION['announce_date'] : time() ));
	$form_body .= '<br />';
	$form_body .= elgg_echo('announcements:manage:title');
	$form_body .= elgg_view('input/text', array('internalname' => 'title', 'value' => isset($_SESSION['announce_title']) ? $_SESSION['announce_title'] : ''));
	$form_body .= elgg_echo('announcements:manage:content');
	$form_body .= elgg_view('input/longtext', array('internalname' => 'content', 'value' => isset($_SESSION['announce_content'])? $_SESSION['announce_content'] : ''));
    $form_body .= elgg_echo('announcements:manage:signature');
	$form_body .= elgg_view('input/text', array('internalname' => 'signature', 'value' => isset($_SESSION['announce_signature']) ? $_SESSION['announce_signature'] : $entity->name));
	
	$form_body .= elgg_echo('announcements:manage:tags');
	$form_body .= elgg_view('input/text', array('internalname' => 'tags', 'value' => isset($_SESSION['announce_tags']) ? $_SESSION['announce_tags'] : ''));
	
	$form_body .= elgg_view('input/submit', array('value' => elgg_echo('announcements:manage:save')));

	echo elgg_view('input/form', array('body' => $form_body, 'action' => $CONFIG->url . "action/announcements/add"));
	
?>
