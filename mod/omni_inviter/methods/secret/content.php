<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */

/*
Quick tutorial on writing OI metaplugins.

Add users using a javascript call oiAddInvitedUser(name, account_id, method, params)
name = the user's name
account_id = account id that your method uses to identify them.  email, username, etc
method = your method's name
params = js object (!!) of params to send to the invitation object.
Useful to get user-specific data during the method's content.php call.
*/


$name_field = elgg_view('input/text', array(
	'internalname' => 'secret_name',
));

$email_field = elgg_view('input/text', array(
	'internalname' => 'secret_email'
));

$secret_input = '<label>' . elgg_echo('oi:name') . $name_field . '</label>';
$secret_input .= '<label>' . elgg_echo('email') . $email_field . '</label>'; 
$secret_input .= elgg_view('input/button', array(
	'value' => elgg_echo('oi:add'),
	'internalname' => 'oi_secret_add'
))

?>

<div id="oi_secret_input"><?php echo $secret_input; ?></div>

<div id="oi_secret_list"></div>

<script type="text/javascript">
var oiSecretList = new Array();

function oiSecretAdd() {
	var name = $('input[name=secret_name]').val();
	var email = $('input[name=secret_email]').val();
	if (!oiIsEmail(email)) {
		// is this dirty?
		oiDisplayError('<?php echo elgg_echo('registration:notemail'); ?>');
		return false;
	}
	
	if (oiAddInvitedUser(name, email, 'secret')) {
		$('input[name=secret_name]').val('');
		$('input[name=secret_email]').val('');
		oiSecretAddListDisplay(name, email);
	} else {
		// it's dirty.
		oiDisplayError('<?php echo elgg_echo('registration:dupeemail'); ?>');
		return false;
	}
}

function oiSecretRemove(name, email) {
	oiRemoveInvitedUser(name, email, 'secret');
}

function oiSecretAddListDisplay(name, email) {
	$('#oi_secret_list').prepend(oiSecretFormatListDisplay(name, email));
	// this doesn't work :(
	// no pretty effects.
	//$('#' + email).slideDown('slow');
	// also means we have to use onClick events in the delete.
}

function oiSecretFormatListDisplay(name, email) {
	return '<div id="' + email + '">' + name + ' &lt;' + email + '&gt; ' +
		'<a onClick="$(this.parentNode).fadeOut(); oiSecretRemove(\'' + name + '\', \'' + email + '\');">[<?php echo elgg_echo('delete'); ?>]</a></div>'; 
}

function oiRedrawSecretListDisplay() {
	// fill out all the friends already in this session.
	var oiSecretList = oiGetInvitedUsers('secret');
	for (i in oiSecretList) {
		friend = oiSecretList[i];
		oiSecretAddListDisplay(friend.name, friend.id);
	}
}

$(document).ready(function() {
	$('input[name=oi_secret_add]').click(function() {
		oiSecretAdd();
	});

	oiRedrawSecretListDisplay();

});

</script>