<?php
/**
    view.php, part of Announcements
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

	// Load newsletters model
	require_once(dirname(__FILE__) . "/../../../../models/model.php");
	
	// load number of members to display
    $display_count = get_plugin_setting('display_count', 'announcements');
	// set default values if settings absent
	if ( !$display_count )
		$display_count = 10;
?>

<div id="announcements_list">
<?php

$announcements = announcements_get_entities($display_count);
if( $announcements ){
	// if announcements list not empty
    foreach($announcements as $announcement){
	// Show member icon from profile plugin for each member
	    echo elgg_view('announcements/announcement_widget', array('entity' => $announcement));
    }
}
?>
<div style="clear:both;">&nbsp;</div>
</div>
