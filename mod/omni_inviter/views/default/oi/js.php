<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */


// prepare all the i18n strings for javascript.
// this _feels_ dirty--is there a better way to do i10n with javascript?
$oiInvitingCountMsg = addslashes(elgg_echo('oi:invite:inviting'));
$oiInvitingCountMsSingular = addslashes(elgg_echo('oi:invite:inviting_singular'));
$noInvitedUsers = addslashes(elgg_echo('oi:errors:no_invited_users'));
$noUserMessage = addslashes(elgg_echo('oi:errors:no_user_message'));
$methodError = addslashes(elgg_echo('oi:errors:method_error'));

header('content-type: text/javascript');
?>

var oiURL = '<?php echo $vars['url'] . 'pg/omni_inviter/ajax/method_content/'; ?>';
var oiUsers = $('#oi_users');


// stores the actual invitation objects.
var oiInvitedUsers = new Array();

// stores a hash of invitedName and accountId for easy dupe checking.
var oiInvitedUsersHash = new Array();
var oiMessageCount = 0;

var oiInvitingCountMsg = '<?php $oiInvitingCountMsg ?>';
var oiInvitingCountMsgSingular = '<?php $oiInvitingCountMsgSingular ?>';

// updates method content container.
// @todo pass on any get params.
function oiUpdateMethodContent(method) {
	$('#oi_content_loader').slideDown('fast');
	$('#oi_done_button').slideUp('fast');
	$('#oi_content').slideToggle();

	//@todo cancel all pending requests
	
	var url = oiURL +  method;
	$('#oi_content').load(url, '', function(content, status, xhr) {
		// some servers don't return 500 errors on php failure
		// so need to check if there's actual content also.
		if (status != 'success' || content.length == 0) {
			$(this).html('<?php echo $methodError; ?>');
		}
		
		$('#oi_content_loader').slideUp('fast');
		$('#oi_done_button').slideDown('fast');
		$('#oi_content').slideToggle();
	});
}

// hashes an id and a method to check for dupes
function oiHashInvite(id, method) {
	return id + '::' + method;
}

// add invite
function oiAddInvitedUser(invitedName, invitedId, method, params) {
	params = params || {};

	//@todo need to hash params also...
	var hash = oiHashInvite(invitedId, method);

	// only add once.
	if (!oiInvitedUserExists(invitedId, method)) {
		oiInvitedUsers.push({
		"name": invitedName,
		"id": invitedId,
		"method": method,
		"params": params
		});
		
		oiInvitedUsersHash.push(hash);
		
		var count = oiInvitedUsersHash.length;
		if (count == 1) {
			var msg = oiInvitingCountMsgSingular.replace('%s', oiInvitedUsersHash.length);
		} else {
			var msg = oiInvitingCountMsg.replace('%s', oiInvitedUsersHash.length);
		}
		$('#oi_invited_user_count').html(msg);
		
		return true;
	}
	
	return false;
}

function oiInvitedUserExists(invitedId, method) {
	var hash = oiHashInvite(invitedId, method);
	
	if (jQuery.inArray(hash, oiInvitedUsersHash) < 0) {
		return false;
	}
	
	return true;
}

// remove an invited user.
// get the index of the hash, which is the
// same as the index of the invite.
function oiRemoveInvitedUser(invitedName, invitedId, method) {
	var hash = oiHashInvite(invitedId, method);

	var i = jQuery.inArray(hash, oiInvitedUsersHash);
	if (i >= 0) {
		//remove from hash
		oiInvitedUsersHash.splice(i, 1);
		
		// remove from invite
		oiInvitedUsers.splice(i, 1);

		return true;
	}
	return false;
}


// returns an array of invited people.
function oiGetInvitedUsers(method) {
	var r = new Array();

	method = method || 'all';
	
	if (method == 'all') {
		return oiInvitedUsers;
	} else {
		for (i in oiInvitedUsers) {
			if (oiInvitedUsers[i].method == method) {
				r.push(oiInvitedUsers[i]);
			}
		}
	}
	return r;
	
	if (typeof(method) != 'undefined') {
		for (i in oiInvitedUsers) {
			var info = oiParseEntry(oiInvitedUsers[i]);
			if (info.method == method) {
				r.push(info);
			}
		}
	} else {
		for (i in oiInvitedUsers) {
			var info = oiParseEntry(oiInvitedUsers[i]);
			r.push(info);
		}
	}

	return r;
}

function oiDisplayMessage(msg, type) {
	type = type || 'messages';

	if (type != 'messages') {
		type = 'messages ' + type;
	}

	var id = 'oi_message_' + oiMessageCount.toString();
	
	// longer messages need longer to read...
	var delay = 2000 + (msg.length * 50);
	
	// ...but we don't want to read them forever.
	if (delay > 15000) {
		delay = 15000;
	}
	
	var timeout = setTimeout("$('#" + id + "').fadeOut('slow');", delay);
	$('#oi_messages').append('<div style="display: none;" id="' + id + '" class="' + type + '">' + msg + '</div>');
	$('#' + id).fadeIn('slow');
	
	oiMessageCount++;
}

function oiDisplayError(msg) {
	oiDisplayMessage(msg, 'messages_error');
}

function oiUpdateCount() {
	$('#oi_invited_users_count').html(oiInvitedUsers.length.toString());
}

// @todo switch to real regexp check.
// also ajax through check against existing users.
function oiIsValidEmail(email) {
	if (email.indexOf('@') < 0 && email.indexOf('.') < 0) {
		return false;
	}
	return true;
}

// checks things are in order and submits...
function oiSubmitForm() {
	var noInvitedUsers = '<?php echo $noInvitedUsers; ?>';
	var noUserMessage = '<?php echo $noUserMessage; ?>';
	var invitedUsers = oiGetInvitedUsers();
	
	// check for users to invite...
	if (invitedUsers.length < 1) {
		oiDisplayError(noInvitedUsers);
		return false;	
	}
	
	// check for user message...
	if ($('textarea[name=oi_user_message]').val() == '') {
		oiDisplayError(noUserMessage);
		return false;
	}
	
	// load everything into the text area.
	// @todo I don't think this is needed.
	// jquery should be able to do it without the
	// json method.
	var invited = $.toJSON(invitedUsers);

	$('#oi_invited_users').val(invited);
	$('form[name=oi_form]').submit();
}

// binds return on all inputs in the 
// content area to specified function.
function oiBindContentEnter(fn) {
	if (typeof fn != 'function') {
		return false;
	}

	$('#oi_content input').bind(($.browser.opera ? "keypress" : "keydown"), function(e) {
		var keyCode = (e.keyCode ? e.keyCode : e.which);
		// 13 is return
		if (keyCode == 13) {
			fn();
		}
	});
}

// register event handler for method select
// force a change on select
$(document).ready(function() {
	var inviteWho = $('select[name=oi_invite_who]');
	
	inviteWho.change( function() {
		 oiUpdateMethodContent(inviteWho.val());
	});

	inviteWho.change();

	// unset any browser-saved form elements.
	$('#oi_invited_users').val('');

	// submit form
	$('input[name=oi_send]').click(oiSubmitForm);

	// set up a place for our messages
	$('#page_wrapper').prepend('<div id="oi_messages"></div>');
});


// jquery plugin for .toJSON
(function($){function toIntegersAtLease(n)
{return n<10?'0'+n:n;}
Date.prototype.toJSON=function(date)
{return this.getUTCFullYear()+'-'+
toIntegersAtLease(this.getUTCMonth())+'-'+
toIntegersAtLease(this.getUTCDate());};var escapeable=/["\\\x00-\x1f\x7f-\x9f]/g;var meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'};$.quoteString=function(string)
{if(escapeable.test(string))
{return'"'+string.replace(escapeable,function(a)
{var c=meta[a];if(typeof c==='string'){return c;}
c=a.charCodeAt();return'\\u00'+Math.floor(c/16).toString(16)+(c%16).toString(16);})+'"';}
return'"'+string+'"';};$.toJSON=function(o,compact)
{var type=typeof(o);if(type=="undefined")
return"undefined";else if(type=="number"||type=="boolean")
return o+"";else if(o===null)
return"null";if(type=="string")
{return $.quoteString(o);}
if(type=="object"&&typeof o.toJSON=="function")
return o.toJSON(compact);if(type!="function"&&typeof(o.length)=="number")
{var ret=[];for(var i=0;i<o.length;i++){ret.push($.toJSON(o[i],compact));}
if(compact)
return"["+ret.join(",")+"]";else
return"["+ret.join(", ")+"]";}
if(type=="function"){throw new TypeError("Unable to convert object of type 'function' to json.");}
var ret=[];for(var k in o){var name;type=typeof(k);if(type=="number")
name='"'+k+'"';else if(type=="string")
name=$.quoteString(k);else
continue;var val=$.toJSON(o[k],compact);if(typeof(val)!="string"){continue;}
if(compact)
ret.push(name+":"+val);else
ret.push(name+": "+val);}
return"{"+ret.join(", ")+"}";};$.compactJSON=function(o)
{return $.toJSON(o,true);};$.evalJSON=function(src)
{return eval("("+src+")");};$.secureEvalJSON=function(src)
{var filtered=src;filtered=filtered.replace(/\\["\\\/bfnrtu]/g,'@');filtered=filtered.replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']');filtered=filtered.replace(/(?:^|:|,)(?:\s*\[)+/g,'');if(/^[\],:{}\s]*$/.test(filtered))
return eval("("+src+")");else
throw new SyntaxError("Error parsing JSON, source is not valid.");};})(jQuery);