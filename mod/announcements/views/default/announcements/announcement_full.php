<?php
/**
    announcement_fill.php, part of Announcements
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

$entity = isset($vars['entity']) ? $vars['entity'] : null;

	if ( $entity ) {
?>
<div id="announcements_main">
	<div class="announcements_date"><?php echo $entity->date;?></div>
	<div class="announcements_title"><?php echo $entity->title; ?></div>
	<div class="announcements_description"><?php echo nl2br($entity->content); ?></div>
</div>
<?php
	}
?>