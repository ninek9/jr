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

	$now = time();
	//Define var js
	$map_instance = "map_{$now}";
	
	$input_address = "go_to_address_{$now}";
	
	$debug = $vars['debug'];
	if(!$debug)
		$debug = false;
		
	$location = $vars['value'];
	
	$classname = $vars['classname'];
		if(!$classname)
			$classname = 'container_map_input';

	$entity = $vars['entity'];

	if (!$entity) {
		$entity = page_owner_entity();
	}
	
	if ($entity) {
		if (!$location) {
			$location = $entity->location;
		}
	}
	
	if ($entity) {								
		if ($entity->getLatitude() && $entity->getLongitude()) {	  
			$geolocation = "({$entity->getLatitude()},{$entity->getLongitude()})";
		}
	}
	
	if (!isset($geolocation) || !$geolocation) {
		//Try determine witch is the user position
		$geolocation = '';
	}
	
	echo elgg_view('input/hidden', array(
		'internalname' => 'geolocation',
		'value' => $geolocation,	
	));
	
	echo elgg_view('geolocation/map', array(
		'classname' => $classname,
		'entity' => $entity,
		'map_instance' => $map_instance,
		'map_type' => 'input',
		'zoom' => 2,
	));
?>	
	<div id="<?php echo $input_address; ?>" class="go_to_address">
		<ul>
			<li><?php echo elgg_echo('geolocation:input:gotoaddress'); ?></li>
			<li><input type="text" name="address" value="" /></li>
			<li><button class='submit_button' rel="gotoaddress"><?php echo elgg_echo('geolocation:input:go'); ?></button></li>
		</ul>
	</div>

<?php 
	echo "<p><input type=\"text\" readonly=\"readonly\" class=\"input-text\" value=\"$location\" name=\"location\"/>";
	echo "<span class=\"unknow_error\">" . elgg_echo('geolocation:input:location:unknow') . "</span>"; 
	echo "<small class=\"map_message_error\">" . elgg_echo('geolocation:messages:unknowplace') . "</small>";
	echo "</p>";
	
	if ($debug){
?>	
		<div id='geolocation_debug'></div>	
<?php
	}
?>
	
<script type="text/javascript">
	//Add the events
	$('#<?php echo $input_address; ?> input').keypress(function (e) {
		if (e.which == 13) { //if enter key is pressed
			$('#<?php echo $input_address; ?> button').click();
			e.stopPropagation();
			return false;
		}
	});

	$('#<?php echo $input_address; ?> button').click(function(e){
		address = $('#<?php echo $input_address; ?> input').val();
		if (address != '') {
			goToAddress(address, <?php echo $map_instance; ?>)
			e.stopPropagation();
			return false;
		}
	});
</script>