<?php
/**
 * Demerits
 * 
 * @package Demerits
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt
 * @copyright Brett Profitt 2009
 * @link http://eschoolconsultants.com
 */
?>

demeritsURL = '<?php echo $vars['url']; ?>mod/demerits/';

$('select[name=demerits_mass_state]').change(function() {
	console.log('here');
	// should only return 1 value ever.
	var selected = $('select[name=demerits_mass_state] option:selected')[0];
	
	demeritsSubmitForm('changeState', {
		newState: selected.value,
		newStateDisplay: selected.innerHTML
	});
});

function demeritsAjaxCall(action, username, params) {
	var url = demeritsURL + 'ajax_endpoint/' + action + '.php';
	var demeritGuid = params.demerit_guid;
	$('#demerit-' + demeritGuid + ' .demerit-ajax-loader').fadeIn();
	$.post(url, params ,
		function(data) {
			if (data == 1) {
				$('.demerit-count-' + username).load(demeritsURL + 'ajax_endpoint/get_count.php',
					{'username': username}, function() {
						$('#demerit-' + demeritGuid + ' .demerit-ajax-loader').fadeOut('slow');
					});
			} else {
				$('#demerit-' + demeritGuid + ' .demerit-ajax-loader').fadeOut('slow').css('border-color', '#ffff00');
			}
		}
	);
}

function demeritsSubmitForm(action, params) {
	var demerits = demeritsGetSelected();
	var demeritsCount = demerits.length;
	var demeritsPlural = (demeritsCount > 1) ? 's' : '';
	
	if (demerits.length < 1) {
		return true;
	}
	
	switch (action) {
		case 'delete':
			if (!confirm('Are you sure you want to delete ' + demeritsCount + ' demerit' + demeritsPlural + '?')) {
				return false;
			}
			
			var url = demeritsURL + 'ajax_endpoint/delete.php';
			$.post(url, {'demerit_guids[]': demerits}, function(data) {
				// this is a reload but makes firefox not cache the form elements.
				window.location =  window.location;
			});
			break;
			
		case 'changeState':
			newState = $('select[name=demerits_mass_state] option:selected')[0].value;
			newStateDisplay = $('select[name=demerits_mass_state] option:selected')[0].innerHTML;
			if (!confirm('Are you sure you want to set ' + demeritsCount + ' demerit' + demeritsPlural + ' to ' + newStateDisplay + '?')) {
				return false;
			}
			var url = demeritsURL + 'ajax_endpoint/change_state.php';
			$.post(url, {'state': newState, 'demerit_guids[]': demerits}, function(data) {
				// this is a reload but makes firefox not cache the form elements.
				window.location =  window.location;
			});
			break;
	}
}

function demeritsGetSelected() {
	demerits = [];
	$('.demerit-guids').each(function(i, obj) {
		if (obj.checked) {
			demerits.push(obj.value);
		}
	});
	
	return demerits;
}