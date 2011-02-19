Geolocation 0.1b
Copyright (c) 2009-2010 Keetup Development

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307  
USA


** ABOUT **

This plugin allows you to geoposicionate every object/user/group on elgg. 


Geolocation is released under the GNU Public License (GPL), which
is supplied in this distribution as LICENSE.


** CONTRIBUTORS **

See CONTRIBUTORS.txt for development credits.


** LICENSE INFORMATION **

This software is governed under rights, privileges, and restrictions in 
addition to those provided by the GPL v2.  Please carefully read the
LICENSE.txt file for more information.


** INSTALLATION **

	* Unzip the file to the elgg/mods/ directory.

	* Go to your Elgg tools administration section, find the new tool, and 
	  enable it.
	  
	* Get an API key from Google Map (if you don't have one) http://code.google.com/apis/maps/signup.html
	  * Enter the API key on the administration tools plugin settings.   
	  
	* Enjoy.
	
** TO KEEP IN MIND **

	* The plugin is enable by default for users and groups, but to make it work in objects (files, blogposts, pages)
	  there is something else to do, we have to:
	  
	  	* On "start.php" under "geolocation_pagesetup" function, then will look for $allowed_contexts and we add to 
	  		the array the context where we will add, edit, and show the objects. 
	  		As an example, for the file plugin we add, edit and show the objects on the same context, file.
	  		
	  	* This is an example to show up how to modify a view file from the file plugin, this will enable the geolocalization of object furthermore than getting the owners geolocalization.
	  	
	  	file:mod/file/views/default/file/upload.php
	  	
	  	//Show the map for geotagging
		if (isset($vars['entity'])) {
			$entity = $vars['entity'];
		}
		$form_body .= "<p>";
		$form_body .= "<label>" . elgg_echo('location') . "</label>";
		$form_body .= elgg_view('input/geomap', array(
			'value' => $location,
			'classname' => 'register_map',
			'entity' => $entity
		));
		$form_body .= "</p>";
		echo $form_body;
		
		*This is to draw the map on the object view.
		
		file:mod/file/views/default/object/file.php
		echo "<p>" . elgg_echo('location') . "<p>";
		echo elgg_view('output/geomap', array('value' => $location, 'entity' => $file));
	  


** TODO **
	  
	* Nothing TODO at the moment.
	
	
** CHANGES **

v0.1b (2010-01-29)
	* First beta release.