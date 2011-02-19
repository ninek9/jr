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

/* Demerit Listing */
.demerit {
	border: 1px solid black;
	margin-bottom: 1em;
}

.demerit-links {
	float: right;
	margin-left: 5px;
	xmargin-top: -0.9em;
}

.demerit-ajax-loader {
	float: left;
	display: none;
}

/* color for demerit states */
<?php
$states = demerits_get_supported_demerit_states(false);

foreach ($states as $state) {
	switch ($state) {
		case 'confirmed':
			$color = 'green'; 
			break;
		
		case 'archived':
			$color = 'gray';
			break;
			
		case 'submitted':
			$color = 'red';
			break;
	}
	// leave at default if nothing changes.
	if (!$color) { continue; }
	echo "
.demerit-state-$state {
	border: 1px solid $color;
}
";
}
?>


/* Consequences */
.demerits-consequence {
	border: 1px dashed gray;
	padding: 2px;
}

.demerits-consequence legend {
	font-weight: bold;
	font-size: 1.2em;
	margin-left: .5em;
}

/* Add color coding for listing consequences */
<?php
$actions = demerits_get_supported_consequence_actions(false);

foreach ($actions as $action) {
	switch ($action) {
		case 'ban':
			$color = 'red'; 
			break;
		
		case 'suspend':
			$color = 'orange';
			break;
			
		case 'notify':
			$color = 'blue';
			break;
	}
	// leave at default if nothing changes.
	if (!$color) { continue; }
	echo "
.demerits-consequence-$action {
	border: 1px dashed $color;
}
.demerits-consequence-$action legend {
	color: $color;
}
";
}
?>

.demerits-consequences-param-name {
	font-weight: bold;
}

.demerits-consequences-param-value {
	xpadding-left: 3px;
}

#demerits_new_consequence_form fieldset {
	border: 1px solid black;
	padding: 1em;
}

.demerits-consequences-links {
	float: right;
	margin-left: 5px;
	margin-top: -0.9em;
}

.demerits-consequences-grouping {
	padding-left: 3em;
}

.demerits-consequences-count {
	font-size: 1.3em;
	font-weight: bold;
}

.demerits-consequences-sequence {
	font-weight: bold;
	text-align: center;
	font-size: 1.1em;
}
