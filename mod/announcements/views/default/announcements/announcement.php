<?php
/**
    announcement.php, part of Announcements
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
$context = isset($vars['context']) ? $vars['context'] : get_context();

	if ( $entity ) {
		$content = $entity->content;
		// strip content if necessary
		if ( strlen($content) > ANNOUNCEMENTS_SHORT_DESCRIPTION_LEN ){

			$pos = ANNOUNCEMENTS_SHORT_DESCRIPTION_LEN;
			while ( $content[$pos] != ' ') $pos--;
			$content = substr($content, 0, $pos) . ' ...';
		}
		if ( $context == 'admin'){
			// show item for admin
?>
<div id="announcements_manage_main">
	<div class="announcements_manage_commands">
	<a href="<?php echo $vars['url'];?>mod/announcements/edit.php?id=<?php echo $entity->guid;?>" class="announcements_link">Edit</a>
	<a href="<?php echo $vars['url'];?>mod/announcements/delete.php?id=<?php echo $entity->guid;?>" class="announcements_link" onclick="return confirm('<?php echo elgg_echo('announcements:are_you_sure_delete')?>');">Delete</a>
	</div>
	<div class="announcements_manage_date"><?php echo $entity->date;?></div>
	<div class="announcements_manage_title"><?php echo $entity->title; ?></div>
	<div class="announcements_manage_description"><?php echo nl2br($content); ?></div>
</div>
<?php
		} else {
			// show item for other
?>
<div id="announcements_main">
	<div class="announcements_date"><?php echo $entity->date;?></div>
	<div class="announcements_title"><a href="<?php echo $vars['url'];?>mod/announcements/view.php?id=<?php echo $entity->guid;?>" class="announcement"><?php echo $entity->title; ?></a></div>
	<div class="announcements_description"><?php echo nl2br($content); ?></div>
</div>
<?php
		}
	}
?>