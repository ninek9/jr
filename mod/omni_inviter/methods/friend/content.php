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
	'internalname' => 'friend_name',
));

$email_field = elgg_view('input/text', array(
	'internalname' => 'friend_email'
));

$friend_input = '<label>' . elgg_echo('oi:name') . $name_field . '</label>';
$friend_input .= '<label>' . elgg_echo('email') . $email_field . '</label>'; 
$friend_input .= elgg_view('input/button', array(
	'value' => elgg_echo('oi:add'),
	'internalname' => 'oi_friend_add'
));

// prepare JS i10n...
$notemail = addslashes(elgg_echo('registration:notemail'));
$dupeemail = addslashes(elgg_echo('registration:dupeemail'));
$delete = addslashes(elgg_echo('delete'));

?>

<div id="oi_friend_input"><?php echo $friend_input; ?></div>

<div id="oi_friend_list"></div>

<script type="text/javascript">
var oiFriendList = new Array();

function oiFriendAdd() {
	var name = $('input[name=friend_name]').val();
	var email = $('input[name=friend_email]').val();
	if (!oiIsValidEmail(email)) {
		oiDisplayError('<?php echo $notemail; ?>');
		return false;
	}
	
	if (oiAddInvitedUser(name, email, 'friend')) {
		$('input[name=friend_name]').val('');
		$('input[name=friend_email]').val('');
		oiFriendAddListDisplay(name, email);
	} else {
		oiDisplayError('<?php echo $dupeemail; ?>');
		return false;
	}
}

function oiFriendRemove(name, email) {
	oiRemoveInvitedUser(name, email, 'friend');
}

function oiFriendAddListDisplay(name, email) {
	$('#oi_friend_list').prepend(oiFriendFormatListDisplay(name, email));
	// this doesn't work :(
	// no pretty effects.
	//$('#' + email).slideDown('slow');
	// also means we have to use onClick events in the delete.
}

function oiFriendFormatListDisplay(name, email) {
	return '<div id="' + email + '">' + name + ' &lt;' + email + '&gt; ' +
		'<a onClick="$(this.parentNode).fadeOut(); oiFriendRemove(\'' + name + '\', \'' + email + '\');">[<?php echo $delete; ?>]</a></div>'; 
}

function oiRedrawFriendListDisplay() {
	// fill out all the friends already in this session.
	var oiFriendList = oiGetInvitedUsers('friend');
	for (i in oiFriendList) {
		friend = oiFriendList[i];
		oiFriendAddListDisplay(friend.name, friend.id);
	}
}

$(document).ready(function() {
	$('input[name=oi_friend_add]').click(function() {
		oiFriendAdd();
	});

	// bind return to oiFriendAdd()
	oiBindContentEnter(oiFriendAdd);
	oiRedrawFriendListDisplay();

});

</script>