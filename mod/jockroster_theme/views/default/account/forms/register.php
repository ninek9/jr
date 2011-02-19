<?php

     /**
	 * JockRoster Theme register form
	 * 
	 * @package JockRoster Theme
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Eric Zanol
	 * @copyright JockRoster 2009-2011
	 * @link http://jockroster.com
	 */
	 
	$username = get_input('u');
	$email = get_input('e');
	$name = get_input('n');

	$admin_option = false;
if (($_SESSION['user']->admin) && ($vars['show_admin'])) {
		$admin_option = true;
}

$form_body = "<p><label>" . elgg_echo('name') . "</label>" . elgg_view('input/text' , array('internalname' => 'regname', 'class' => "general-textarea", 'value' => $name, 'autocomplete' => 'off')) . "</p>";	
$form_body .= "<p><label>" . elgg_echo('email') . "</label>" . elgg_view('input/text' , array('internalname' => 'regemail', 'class' => "general-textarea", 'value' => $email, 'autocomplete' => 'off')) . "</p>";
$form_body .= "<p><label>" . elgg_echo('username') . "</label>" . elgg_view('input/text' , array('internalname' => 'regusername', 'class' => "general-textarea", 'value' => $username, 'autocomplete' => 'off')) . "</p>";
$form_body .= "<p><label>" . elgg_echo('password') . "</label>" . elgg_view('input/password' , array('internalname' => 'regpassword', 'class' => "general-textarea", 'autocomplete' => 'off')) . "</p>";
$form_body .= "<p><label>" . elgg_echo('passwordagain') . "</label>" . elgg_view('input/password' , array('internalname' => 'regpassword2', 'class' => "general-textarea", 'autocomplete' => 'off')) . "</p>";
	
// view to extend to add more fields to the registration form
$form_body .= elgg_view('register/extend');
	
// Add captcha hook
$form_body .= elgg_view('input/captcha');
	
if ($admin_option) {
		$form_body .= elgg_view('input/checkboxes', array('internalname' => "admin", 'options' => array(elgg_echo('admin_option'))));
}
	
	$form_body .= elgg_view('input/hidden', array('internalname' => 'friend_guid', 'value' => $vars['friend_guid']));
	$form_body .= elgg_view('input/hidden', array('internalname' => 'invitecode', 'value' => $vars['invitecode']));
	$form_body .= elgg_view('input/hidden', array('internalname' => 'action', 'value' => 'register'));
$form_body .= elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('register'))) . "</p>";
?>

	<div id="register-box">
		<?php echo elgg_view('input/form', array('action' => "{$vars['url']}action/register", 'body' => $form_body)) ?>
	</div>