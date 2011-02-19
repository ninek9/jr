<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @subpackage Fusefly
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */

// grab our class...
require_once 'openinviter_class.php';

$user = get_loggedin_user();
$step = get_input('step', 'select_provider');
$provider = get_input('provider');

//weirdness ensues.
global $openi, $openi_plugins;
$openi = new oiOpenInviter();
$openi_plugins = $openi->getPlugins();

switch ($step) {
	default: 
	case 'select_provider':
		$content = oi_openinviter_select_provider($provider);
		break;
		
	case 'select_invited':
		$content = oi_openinviter_select_invited($provider);
		break;
}

echo "<div id=\"oi_openinviter_content\">$content</div>";
echo oi_openinviter_get_js();

/**
 * Select a provider from OmniInviter
 * 
 * @return str
 */
function oi_openinviter_select_provider() {
	global $openi, $openi_plugins, $CONFIG;
	
	$provider = get_input('provider');
	$account_login = get_input('account_login');
	
	$email = $openi_plugins['email'];
	$social = $openi_plugins['social'];
	
	$select_values = array();
	
	// @todo does it really help to separate these in display?
	foreach ($email as $plugin => $info) {
		$select_values[$plugin] = $info['name'];
	}
	
	foreach ($social as $plugin => $info) {
		$select_values[$plugin] = $info['name'];
	}
	
	if (!is_array($select_values) || count($select_values) < 1) {
		return elgg_echo('oi:method:openinviter:no_plugins_found');
	}
	
	$provider_select_field = elgg_view('input/pulldown', array(
		'internalname' => 'provider',
		'value' => $provider,
		'options_values' => $select_values,
	));
	
	$account_login_field = elgg_view('input/text', array(
		'internalname' => 'account_login',
		'value' => $account_login,
		'class' => 'oi-textarea'
	));
	
	$account_password_field = elgg_view('input/password', array(
		'internalname' => 'account_password',
		'class' => 'oi-textarea'
	));

	$submit_button .= elgg_view('input/button', array(
		'value' => elgg_echo('oi:method:openinviter:get_contacts'),
		'internalname' => 'oi_openinviter_get_contacts'
	));
	$src = $CONFIG->site->url . 'mod/omni_inviter/methods/openinviter/logo_small.png';
	
	$content = '<a target="_blank" href="http://openinviter.com"><img src="' . $src . '" style="float: left; padding: 10px;" /></a>';
	$content .= '<p>' . elgg_echo('oi:method:openinviter:blurb') . '</p>';
	$content .= '<hr style="clear: both; margin: 15px 0;" />';
	$content .= '<label>' . elgg_echo('oi:method:openinviter:provider_select') . $provider_select_field . '</label><br />';
	$content .= '<label>' . elgg_echo('oi:method:openinviter:account_login') . $account_login_field . '</label><br />';
	$content .= '<label>' . elgg_echo('oi:method:openinviter:account_password') . $account_password_field . '</label><br />'; 
	$content .= $submit_button;
	return $content;
}


/**
 * Select invited users.
 * 
 * @return str
 */
function oi_openinviter_select_invited() {
	global $user, $openi, $openi_plugins;
	
	$provider = get_input('provider');
	$account_login = get_input('account_login');
	$account_password = get_input('account_password');
	
	// attempt to load plugin.
	// doesn't return true, only populates internal error log on fail...
	$openi->startPlugin($provider);
	
	// error for loading...
	if ($internal_error = $openi->getInternalError()) {
		echo '<p class="oi_errorr">' . sprintf(elgg_echo('oi:method:openinviter:internal_error'), $internal_error) . '</p>';
		set_input('provider', $provider);
		echo oi_openinviter_select_provider();
		return false;
	}
	
	// attempt to login
	if (!$openi->login($account_login, $account_password)) {
		echo '<p class="oi_errorr">' . sprintf(elgg_echo('oi:method:openinviter:invalid_login'), ucwords($provider), ucwords($provider)) . '</p>';
		set_input('provider', $provider);
		echo oi_openinviter_select_provider();
		return false;
	}

	// attempt to grab contacts
	if (false === $contacts = $openi->getMyContacts()) {
		echo '<p class="oi_errorr">' . sprintf(elgg_echo('oi:method:openinviter:contacts_error'), ucwords($provider)) . '</p>';
		set_input('provider', $provider);
		echo oi_openinviter_select_provider();
		return false;
	}
	
	// ok (or so) on the grab, but none exist
	if (!is_array($contacts) || count($contacts) < 1) {
		echo '<p class="oi_errorr">' . sprintf(elgg_echo('oi:method:openinviter:no_contacts'), ucwords($provider)) . '</p>';
		set_input('provider', $provider);
		echo oi_openinviter_select_provider();
		return false;
	}
	
	// rewrite them as an array of objects for js.
	$js_contacts_arr = array();
	foreach ($contacts as $id => $name) {
		$js_contacts_arr[] = array(
			'accountId' => $id,
			'accountName' => $name
		);
	}
	
	// sort by account name
	$keys = array();
	foreach($js_contacts_arr as $i => $row) {
		$keys[$i] = strip_tags($row['accountName']);
	}
    // preserve original array
	$temp = $js_contacts_arr;
	array_multisort($keys, SORT_ASC, $temp);
	
	$js_contacts = json_encode($temp);
    
	// this is being parsed immediately as JS
	// so no need to eval() it.
	echo '
	<a name="contacts" />
	<div class="oi_openinviter_pager"></div>
	<div id="oi_openinviter_controls">
		<a class="oi_pointer" id="oi_openinviter_checkall">' . elgg_echo('oi:method:openinviter:checkall') . '</a>
		| <a class="oi_pointer" id="oi_openinviter_checknone">' . elgg_echo('oi:method:openinviter:checknone') . '</a>
	</div>
	<div id="oi_openinviter_message" style="display: none; border: 1px solid blue; background-color: #99ccff; padding:1em;"></div>
	<div id="oi_openinviter_contacts"></div>
	<div class="oi_openinviter_pager"></div>
	
	<script type="text/javascript">
		oiOpenInviterContacts = ' . $js_contacts . ';
		oiOpenInviterShowContacts(0);
		
		oiOpenInviterProvider = "' . $provider . '";
		oiOpenInviterAccountLogin = "' . $account_login . '";
		oiOpenInviterAccountPassword = "' . oi_openinviter_encrypt($account_password) . '";
	</script>';
}

/**
 * Specific JS for OpenInviter method.
 * 
 * @return string
 */
function oi_openinviter_get_js() {
	
	// i10n...
	$dupeemail = addslashes(elgg_echo('registration:dupeemail'));
	
	$select_this_page = elgg_echo('oi:method:openinviter:select_this_page');
	$select_all_contacts = elgg_echo('oi:method:openinviter:select_all_contacts');
	$selected_all_contacts = elgg_echo('oi:method:openinviter:selected_all_contacts');

	$unselect_this_page = elgg_echo('oi:method:openinviter:unselect_this_page');
	$unselect_all_contacts = elgg_echo('oi:method:openinviter:unselect_all_contacts');
	$unselected_all_contacts = elgg_echo('oi:method:openinviter:unselected_all_contacts');
	
?>

<script type="text/javascript">
function oiOpenInviterShowContacts(offset, limit) {
	offset = offset || 0;
	limit = limit || 15;

	var contactContainer = $('#oi_openinviter_contacts');
	var pagerContainer = $('.oi_openinviter_pager');
	var accountName = '';
	var accountId = '';
	var content = '';
	var contactsLength = oiOpenInviterContacts.length;

	for (var i=offset; i<limit + offset; i++) {
		if (i >= contactsLength) {
			break;
		}

		accountName = oiOpenInviterContacts[i].accountName;
		accountId = oiOpenInviterContacts[i].accountId;

		// @todo: need to check against params too.
		if (oiInvitedUserExists(accountId, 'openinviter')) {
			var checked = 'checked="checked"';
		} else {
			var checked = '';
		}

		//content += '<p><label><input onClick="oiToggleOpenInviterEntry(this)" class="oi_openinviter_entry" type="checkbox" ' + checked + 'value="' + i + '">' + accountName + ' &lt;' + accountId + '&gt;</label></p>';
		content += '<p><label><input onClick="oiToggleOpenInviterEntry(this)" class="oi_openinviter_entry" type="checkbox" ' + checked + 'value="' + i + '">' + accountName + '</label></p>';
	}
	
	// show pagination
	var pages = Math.ceil(oiOpenInviterContacts.length / limit);
	var curPage = Math.floor(offset / limit);
	var curPageDisp = curPage + 1;
	var pager = '';

	if (pages > 1) {
	//	console.log("offset: " + offset + " limit: " + limit);
	//	console.log("pages: " + pages + " curPage: " + curPage);
		
		// wish I could text-align: justify this...
		pager += '<p class="pager" style="text-align: center; font-size: 1.3em;">';
		if (curPage != 0) {
			//pager += ' <a class="oi_pointer" href="#contacts" onClick="oiOpenInviterShowContacts(' + parseInt((curPage-1) * limit).toString() + ', ' + limit +');">&lt&lt;&lt;</a> ';
			pager += ' <a class="oi_pointer" onClick="oiOpenInviterShowContacts(' + parseInt((curPage-1) * limit).toString() + ', ' + limit +');">&lt&lt;&lt;</a> ';
		} else {
			pager += '&lt;&lt;&lt; ';
		}
		
		//while (var c <= pages) {
		for (var c=0; c<pages; c++) {
			disPage = parseInt(c + 1).toString();
			pageOffset = parseInt(c * limit).toString();
			//console.log('c: ' + c + ' disPage: ' + disPage + ' pageOffset: ' + pageOffset); 
			
			if (c == curPage) {
				pager += ' &nbsp; <span style="font-face: bold;">' + disPage + '</span> &nbsp; ';
			} else {
				//pager += ' <a class="oi_pointer" href="#contacts" onClick="oiOpenInviterShowContacts(' + pageOffset + ', ' + limit +');">' + disPage + '</a> ';
				pager += ' &nbsp; <a class="oi_pointer" onClick="oiOpenInviterShowContacts(' + pageOffset + ', ' + limit +');">' + disPage + '</a> &nbsp; ';
			}
		}
	
		if (curPage == pages-1) {
			pager += '&gt;&gt;&gt; ';
		} else {
			//pager += ' <a class="oi_pointer" href="#contacts" onClick="oiOpenInviterShowContacts(' + parseInt((curPage+1) * limit).toString() + ', ' + limit +');">&gt&gt;&gt;</a> ';
			pager += ' <a class="oi_pointer" onClick="oiOpenInviterShowContacts(' + parseInt((curPage+1) * limit).toString() + ', ' + limit +');">&gt&gt;&gt;</a> ';
		}
		pager  += '</p>';
	}

	pagerContainer.each(function() {
		$(this).html(pager);
	});
	contactContainer.html(content);
}

//@todo: must be an onclick event, so cannot be an attached event
function oiToggleOpenInviterEntry(entry) {
	entry = $(entry);
	var contactInfo = oiOpenInviterContacts[entry.val()];
	
	var params = {
		"account_login": oiOpenInviterAccountLogin,
		"account_password": oiOpenInviterAccountPassword,
		"provider": oiOpenInviterProvider
	};

	if (!entry.is(':checked')) {
		oiRemoveInvitedUser(contactInfo.accountName, contactInfo.accountId, 'openinviter', params);
		return true;
	} else {
		if (oiAddInvitedUser(contactInfo.accountName, contactInfo.accountId, 'openinviter', params)) {
			return true;
		} else {
			oiDisplayError('<?php echo $dupeemail; ?>');
			return false;
		}
	}
};

function oiOpenInviterGetContacts() {
	var url = oiURL + 'openinviter/content.php';
	var params = {
		"step": "select_invited",
		"account_password": $('input[name=account_password]').val(),
		"account_login": $('input[name=account_login]').val(),
		"provider": $('select[name=provider]').val()
	};
	$('#oi_openinviter_content').html('');
	$('#oi_openinviter_content').addClass('ajax_loader');
	$('#oi_openinviter_content').load(
		url, 
		params, 
		function() {
			$('#oi_openinviter_content').removeClass('ajax_loader');
		}
	);
}

// @todo this is a sllloooowwww way to do it.
// fixing it would require making something other than
// the onclick event be what does oiAddInvitedUser()
function oiOpenInviterCheckAll(visibleOnly) {
	visibleOnly = visibleOnly || false;
	var justSelectedCount = 0;
	var contactsLength = oiOpenInviterContacts.length;
	
	if (!visibleOnly) {
		// keep track and see if there are any that can't be selected and display notice
		var errorAdding = 0;
		var params = {
			"account_login": oiOpenInviterAccountLogin,
			"account_password": oiOpenInviterAccountPassword,
			"provider": oiOpenInviterProvider
		};
		
		$(oiOpenInviterContacts).each(function(i, val) {
			if (!oiAddInvitedUser(val.accountName, val.accountId, 'openinviter', params)) {
				errorAdding++;
			}
			if (errorAdding) {
				//oiDisplayMessage('Added all contacts but some looked like duplicates...');
			}
		});

		var msg = '<?php echo $selected_all_contacts; ?>';
		msg = msg.replace('%allContactsCount', contactsLength);

		// @todo use the oiDisplayMessage popup instead?
		//oiDisplayMessage(msg);
		$('#oi_openinviter_message').html(msg).show();
		
	} else {
		// have to make sure not to add dupes because of previously
		// poorly implemented methods.
		$('.oi_openinviter_entry').each(function() {
			var element = $(this);
			if (!element.is(':checked')) {
				element.click();
				justSelectedCount++;
			}
		});
		var msg = '<?php echo $select_this_page; ?>';
		var selectAll = '<?php echo $select_all_contacts; ?>';
		// wow i wish JS had sprintf...
		msg = msg.replace('%justSelectedCount', justSelectedCount);
		selectAll = selectAll.replace('%allContactsCount', contactsLength);

		//oiDisplayMessage(msg + '  <a onClick="oiOpenInviterCheckAll(false);">' + selectAll + '</a>');
		$('#oi_openinviter_message').html(msg + '  <a class="oi_pointer" onClick="oiOpenInviterCheckAll(false);">' + selectAll + '</a>').show();
	}
}

function oiOpenInviterCheckNone(visibleOnly) {
	visibleOnly = visibleOnly || false;
	var justUnselectedCount = 0;
	var contactsLength = oiOpenInviterContacts.length;

	if (!visibleOnly) {
		var errorAdding = 0;
		var params = {
			"account_login": oiOpenInviterAccountLogin,
			"account_password": oiOpenInviterAccountPassword,
			"provider": oiOpenInviterProvider
		};
		
		$(oiOpenInviterContacts).each(function(i, val) {
			oiRemoveInvitedUser(val.accountName, val.accountId, 'openinviter', params);
		});

		var msg = '<?php echo $unselected_all_contacts; ?>';
		msg = msg.replace('%allContactsCount', contactsLength);

		// @todo use the oiDisplayMessage popup instead?
		//oiDisplayMessage(msg);
		$('#oi_openinviter_message').html(msg).show();
	} else {
		$('.oi_openinviter_entry').each(function() {
			var element = $(this);
			if (element.is(':checked')) {
				element.click();
				justUnselectedCount++;
			}
		});

		var msg = '<?php echo $unselect_this_page; ?>';
		var unselectAll = '<?php echo $unselect_all_contacts; ?>';
		// wow i wish JS had sprintf...
		msg = msg.replace('%justSelectedCount', justUnselectedCount);
		unselectAll = unselectAll.replace('%allContactsCount', contactsLength);

		//oiDisplayMessage(msg + '  <a onClick="oiOpenInviterCheckAll(false);">' + selectAll + '</a>');
		$('#oi_openinviter_message').html(msg + '  <a class="oi_pointer" onClick="oiOpenInviterCheckNone(false);">' + unselectAll + '</a>').show();
	}
}

$(document).ready(function() {
	$('#oi_openinviter_checkall').click(function() {
		oiOpenInviterCheckAll(true);
	});

	$('#oi_openinviter_checknone').click(function() {
		oiOpenInviterCheckNone(true);
	});

	// hide message on click
	$('#oi_openinviter_message').click(function() {
		$(this).hide();
	});

	// bind enter to inputs
	oiBindContentEnter(oiOpenInviterGetContacts);
	
	$('input[name=oi_openinviter_get_contacts]').click(function() {
		oiOpenInviterGetContacts();
	});
});

</script>

<?php

}