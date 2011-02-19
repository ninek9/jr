<?php gatekeeper(); ?>

<a href="<?php echo $vars['url']; ?>pg/friends" class="pagelinks<?php if (get_context() == 'friends' && page_owner_entity() == $vars['user']) echo ' current'; ?>">Friends</a>