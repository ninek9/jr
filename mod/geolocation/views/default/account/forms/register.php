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
	 
	$username = get_input('u');
	$email = get_input('e');
	$name = get_input('n');
	
	//For add geolocation support
	$location = get_input('location');

	$admin_option = false;
	if (($_SESSION['user']->admin) && ($vars['show_admin'])) 
		$admin_option = true;
		
	$form_body = "<p><label>" . elgg_echo('name') . "<br />" . elgg_view('input/text' , array('internalname' => 'name', 'class' => "general-textarea", 'value' => $name)) . "</label><br />";
	
	$form_body .= "<label>" . elgg_echo('email') . "<br />" . elgg_view('input/text' , array('internalname' => 'email', 'class' => "general-textarea", 'value' => $email)) . "</label><br />";
	$form_body .= "<label>" . elgg_echo('username') . "<br />" . elgg_view('input/text' , array('internalname' => 'username', 'class' => "general-textarea", 'value' => $username)) . "</label><br />";
	$form_body .= "<label>" . elgg_echo('password') . "<br />" . elgg_view('input/password' , array('internalname' => 'password', 'class' => "general-textarea")) . "</label><br />";
	$form_body .= "<label>" . elgg_echo('passwordagain') . "<br />" . elgg_view('input/password' , array('internalname' => 'password2', 'class' => "general-textarea")) . "</label><br />";
	
	//Show the map for geotagging
	$form_body .= "<label>" . elgg_echo('location') . "</label>";
	$form_body .= elgg_view('input/geomap', array('value' => $location, 'classname' => 'register_map'));
	
	// Add captcha hook
	$form_body .= elgg_view('input/captcha');
	
	if ($admin_option)
		$form_body .= elgg_view('input/checkboxes', array('internalname' => "admin", 'options' => array(elgg_echo('admin_option'))));

	$form_body .= elgg_view('input/hidden', array('internalname' => 'friend_guid', 'value' => $vars['friend_guid']));
	$form_body .= elgg_view('input/hidden', array('internalname' => 'invitecode', 'value' => $vars['invitecode']));
	$form_body .= elgg_view('input/hidden', array('internalname' => 'action', 'value' => 'register'));
	$form_body .= elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('register'))) . "</p>";
?>

	
	<div id="register-box">
	<h2><?php echo elgg_echo('register'); ?></h2>
	<?php echo elgg_view('input/form', array('action' => "{$vars['url']}action/register", 'body' => $form_body)) ?>
	</div>