<?php

/**
    model.php, part of Announcements
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

function announcements_get_entities($limit = 0, $offset = 0){
	$entities = elgg_get_entities('object', 'announcement', 0, '', $limit, $offset);
    return $entities; 
}

// show list of entities
function announcements_list_entities($limit = 0, $offset = 0){
	$entities = announcements_get_entities($limit, $offset);
	return elgg_view('announcements/announcements', array(
				'entities' => $entities,
				'context' => get_context(),
		));
}


?>