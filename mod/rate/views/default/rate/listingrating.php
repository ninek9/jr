<?php
$context = get_context();
if ($context == 'members'){
	$ratings = $vars['entity']->getAnnotations('generic_rate');
	$rate = 0;
	foreach ($ratings as $rating) {
		$rate += $rating->value;
	}
	$rate = $rate / $vars['entity']->countAnnotations('generic_rate');
	$image = round($rate*2);
	$rate = round($rate, 1);
	
	if ($rate == 0) {
			echo "<img src='{$CONFIG->wwwroot}mod/rate/_graphics/0.png' alt='0' title='0'/><span id=\"psVotesSpan\">(Not rated)</span>";
	} else {
			echo "<div><span id=\"psScoreSpan\">$rate</span><img src='{$CONFIG->wwwroot}mod/rate/_graphics/$image.png' alt='$rate' title='$rate'/><span id=\"psVotesSpan\">(".$vars['entity']->countAnnotations('generic_rate')." ".elgg_echo("rate:rates").")</span></div>";
	}
}
?>