<?php

gatekeeper();

//get unread messages
$num_fr = count_friend_requests();
if($num_fr){
	$num = $num_fr;
} else {
	$num = 0;
}

if($num > 0){ ?>
	<a href="<?php echo $vars['url']; ?>pg/friendrequests" class="new_friendrequests" title="<?php echo elgg_echo('newfriendrequests'); ?>">Request<?php if ($num > 1) { ?>s<?php } ?> (<?php echo $num; ?>)</a>
<?php } ?>