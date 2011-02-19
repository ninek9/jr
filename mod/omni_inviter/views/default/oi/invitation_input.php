<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt <brett.profitt@gmail.com 
 */


$id_field = elgg_view('input/text', array(
	'internalname' => 'invitation_id',
	'value' => $vars['id'],
	'class' => 'oi-input'
));

$code_field = elgg_view('input/text', array(
	'internalname' => 'invitation_code',
	'value' => $vars['code'],
	'class' => 'oi-input'
));

$submit = elgg_view('input/submit', array(
	'value' => elgg_echo('accept')
));

$form_body =  "
	<label>" . elgg_echo('oi:invitation_id') . ": $id_field</label><br />
	<label>" . elgg_echo('oi:invitation_code') . ": $code_field</label><br />
	$submit
";

echo '<div style="text-align: center;">' . 
	elgg_view('input/form', array(
		'name' => 'oi_invitation',
		'action' => $vars['url'] . 'pg/omni_inviter/join',
		'body' => $form_body
	)) .
	'</div>';