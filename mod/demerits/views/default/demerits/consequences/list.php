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

$consequences = elgg_get_entities('object', 'demerit_consequence');

$consequences_order_state = array();
foreach ($consequences as $consequence) {
	if ($consequence->demerit_count > 0 && in_array($consequence->demerit_state, demerits_get_supported_demerit_states(false))) {
		$consequences_order_state[$consequence->demerit_state][$consequence->demerit_count][] = $consequence;
	}
}
ksort($consequences_order_state);

$html = '<h1 style="text-align: center">' . elgg_echo('demerits:consequences:list') . '</h1>';
foreach ($consequences_order_state as $demerit_state => $consequences_order_count) {
	ksort($consequences_order_count);
	foreach ($consequences_order_count as $demerit_count => $consequences) {
		$html .= '<p class="demerits-consequences-count">' . sprintf(elgg_echo('demerits:consequences:after_demerit_count'), $demerit_count, elgg_echo('demerits:states:' . $demerit_state)) . '</p>';
		$html .= '<div class="demerits-consequences-grouping">';
		foreach ($consequences as $consequence) {
			$html .= elgg_view('demerits/consequences/consequence', array('entity'=>$consequence));
			$html .= '<p class="demerits-consequences-sequence">' . elgg_echo('demerits:then') . '</p>';
		}
		$html .= '<p class="demerits-consequences-sequence">' . elgg_echo('demerits:stop') . '</p>
		</div>';
	}
}

echo $html;