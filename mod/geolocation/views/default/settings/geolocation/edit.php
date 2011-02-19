<?php
	/**
	* Geolocation Module
	* 
	* @author Pedro Prez
	* @link http://community.elgg.org/pg/profile/pedroprez
	* @copyright (c) Keetup 2009-2010
	* @link http://www.keetup.com/
	* @license GNU General Public License (GPL) version 2
	*/
	$google_api = $vars['entity']->google_api;
?>

<p>
	<?php 	echo elgg_echo('geolocation:settings:apikey:label'); ?><br />
	<small>
	<?php
		$link_help_api =  "<a target=\"_blank\" href=\"http://code.google.com/apis/maps/signup.html\">here</a>";
		echo sprintf(elgg_echo('geolocation:settings:apikey:help'),$link_help_api);
	?>
	</small>
	
	<?php 
		echo elgg_view('input/text', array(
			'internalname' => 'params[google_api]',
            'value' => $google_api
		));
	?>
</p>