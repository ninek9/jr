<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 * 
 * @todo jQuery can't find elements that are created in the content div.
 * I have to resort to weird hacks to get them to work. 
 * Usually saying $(this) or $(this.parentNode) works...
 */

$methods = oi_get_supported_methods(true, true);

$who = array();
foreach ($methods as $method=>$info) {
	$who[$method] = $info['invite_who'];
}

$current_tmp = array_keys($who);
$current_method = get_input('method', $current_tmp[0]);

$select = elgg_view('input/pulldown', array(
	'internalname' => 'oi_invite_who',
	'options_values' => $who,
	'value' => $current_method
));

// a fake button that simply redraws the initial screen
// and shows a popup
$js = 'onClick="oiDisplayMessage(\'' . elgg_echo('oi:added_users') . '\'); ' .
	'oiUpdateMethodContent(\'' . $current_method . '\');"';

// button that reloads the content for openinviter and
// shows a flash
$done_button = elgg_view('input/button', array(
	'internalname' => 'oi_openinviter_done',
	'value' => elgg_echo('oi:done'),
	'js' => $js
));

// ajax load and method content container.
echo elgg_view('page_elements/title', array('title' => elgg_echo('oi:invite')));

echo '
<div class="contentWrapper">
	<h2>' . elgg_echo('oi:invite:i_want_to_invite') . $select . '</h2><br />

	<div id="oi_content_wrapper" style="border: 1px solid black; padding: 1em; margin-bottom: 2em;">
		<div class="ajax_loader" id="oi_content_loader"></div>
		<div id="oi_content"></div>
		<div id="oi_done_button" style="display: none; text-align: center;">' . $done_button . '</div>
	</div>
</div>';

$submit = elgg_view('input/button', array(
	'type' => 'button',
	'value' => elgg_echo('oi:invite:send_invitations'),
	'internalname' => 'oi_send'
));

// no input/longtext because of tinymce issues...

$form_body = '
<textarea style="display: none;" name="oi_invited_users_list" id="oi_invited_users"></textarea>

<h2>' . elgg_echo('oi:invite:user_message') . '</h2>
<textarea name="oi_user_message" style="width: 75%; height: 100px;">
'. elgg_echo('oi:invite:default_user_message') . '</textarea><br />
' . $submit . '
<div id="oi_invited_user_count">' . sprintf(elgg_echo('oi:invite:inviting'), 0) . '</div>';

$form = elgg_view('input/form', array(
	'internalname' => 'oi_form',
	'action' => $vars['url'] . 'action/omni_inviter/invite',
	'body' => $form_body
)) . "\n";


echo '
<div class="contentWrapper">' . $form . '</div>
<script type="text/javascript" src="' . $vars['url'] . 'pg/omni_inviter/js"></script>
';


