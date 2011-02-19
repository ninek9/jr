<?php
	/**
	 * Login by Email
	 * 
	 * @author Pedro Prez
	 * @link http://community.elgg.org/pg/profile/pedroprez
	 * @copyright (c) Keetup 2009
	 * @link http://www.keetup.com/
	 * @license GNU General Public License (GPL) version 2
	 */

	$form_body = "<p>" . elgg_echo('user:password:text') . "</p>";
	$form_body .= "<p><b>". elgg_echo('username/email') . "</b> " . elgg_view('input/text', array('internalname' => 'username')) . "</p>";
	$form_body .= "<p>" . elgg_view('input/submit', array('value' => elgg_echo('request'))) . "</p>";

?>
<div id="forgotten_box">
	<?php echo elgg_view('input/form', array('action' => "{$vars['url']}action/loginbyemail/requestnewpassword", 'body' => $form_body)); ?>
</div>