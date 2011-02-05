<?php
/**
* Elgg login form
* 
* @package Elgg
* @subpackage Core
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
* @author Curverider Ltd
* @copyright Curverider Ltd 2008-2009
* @link http://elgg.org/
*
* modified by eric zanol
*/

global $CONFIG;
	
	$form_body = "<div id=\"login-box\">";
	$form_body .= "<div class=\"remember-label\"><input type=\"checkbox\" id=\"persistent\" name=\"persistent\" checked=\"checked\" /><label for=\"persistent\">".elgg_echo('user:persistent')."</label> &nbsp;|&nbsp; <a href=\"{$vars['url']}account/forgotten_password.php\">" . elgg_echo('user:password:lost') . "</a></div>";
	$form_body .= "<div class=\"login-inputs\">";
	$form_body .= "<label for=\"username\">user name</label>";
	$form_body .= elgg_view('input/text', array('internalname' => 'username', 'class' => 'login-username'));
	$form_body .= "<label for=\"password\">password</label>";
	$form_body .= elgg_view('input/password', array('internalname' => 'password', 'class' => 'login-password'));
	$form_body .= elgg_view('input/submit', array('value' => elgg_echo('login'), 'class' => 'login-submit'));
	$form_body .= "</div></div>";	
	
	//$form_body .= (!isset($CONFIG->disable_registration) || !($CONFIG->disable_registration)) ? "<div id=\"register\"><a href=\"{$vars['url']}account/register.php\">" . elgg_echo('register') . "</a> - Prove yourself now!</div>" : "";
	
$login_url = $vars['url'];
	if ((isset($CONFIG->https_login)) && ($CONFIG->https_login))
		$login_url = str_replace("http", "https", $vars['url']);


	// displays complete html for login area
	echo elgg_view('input/form', array('body' => $form_body, 'action' => "{$login_url}action/login"));
?>

