<?php
/**
 *	RATE PLUGIN
 *	@package rate
 *	@author Miguel Montes mmontesp@gmail.com
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) Miguel Montes 2008
 *	@link http://community.elgg.org/pg/profile/mmontesp
 **/
	
	$class = $vars['class'];
	if (!$class) $class = "input-radio";

    foreach ($vars['options'] as $label => $option) {
        if ($option != $vars['value']) {
            $selected = "";
        } else {
            $selected = "checked = \"checked\"";
        }
        $labelint = (int) $label;
        if ("{$label}" == "{$labelint}") {
        	$label = $option;
        }
		
        //if ($vars['disabled']) $disabled = ' disabled="yes" '; 	// sets the disabled attribute of the input if applicable.  not using in star rating.
		echo "<li class=\"{$vars['internalname']}" . $label . "\"><a>" . $label . "</a></li>";
    }
?> 