<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 *
 * @todo maybe eventually use json.
 * 
 */
$invited = json_decode(get_input('oi_invited_users_list'), true);
$user_message = get_input('oi_user_message', false);

// is checked in JS.
if (!is_array($invited) || !count($invited) > 0) {
	register_error(elgg_echo('oi:errors:no_invited_users'));
	forward($_SERVER['HTTP_REFERER']);
}

// Is checked in JS.
if (!$user_message) {
	register_error(elgg_echo('oi:error:no_user_message'));
	forward($_SERVER['HTTP_REFERER']);
}

$errors = '';
$count = 0;
// create a new invitation
foreach ($invited as $info) {
	if (!$invite = new Invitation(null, $info['name'], $info['id'], $user_message, $info['method'], $info['params'])) {
		$errors .= '<p>' . sprintf(elgg_echo('oi:errors:could_not_create_invite'), $info['name']) . '</p>';
	} else {
		$count++;
	}
}

// only show list of errors.
if ($errors) {
	$errors = '<p>' . sprintf(elgg_echo('oi:errors:cannot_create_all_invitations'), $count, count($invited)) . '</p>' . $errors; 
	register_error($errors);
} else {
	if ($count == 1) {
		$msg = elgg_echo('oi:invite:invitations_created_singular');
	} else {
		$msg = elgg_echo('oi:invite:invitations_created');
	}
	
	system_message(sprintf($msg, $count));
}

forward($_SERVER['HTTP_REFERER']);