<?php

	/**
	 * Elgg list system messages
	 * Lists system messages
	 * 
	 * @package Elgg
	 * @subpackage Core

	 * @author Curverider Ltd

	 * @link http://elgg.org/
	 * 
	 * @uses $vars['object'] An array of system messages
	 */

	if (!empty($vars['object']) && is_array($vars['object'])) {

?>
<!-- used to fade out the system messages after 3 seconds -->
<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery.pause-resume-0.2.1.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.messages').slideDown('slow').animate({opacity: 0.93}, 1500);
		$('.messages').slideUp(1000);
		
		$('span.closeMessages a').click(function () {
			$(".messages").stop();
			$('.messages').slideUp('slow').fadeOut('slow');
			return false;
		});
		
		$('div.messages').click(function () {
			$(".messages").stop();
			$('.messages').slideUp('slow').fadeOut('slow');
			return false;
		});
	});  
</script>

	<div class="messages">
	<span class="closeMessages"><a href="#"><img src="<?php  echo $vars['url']; ?>_graphics/jr/popup_dismiss.gif" alt="Close to dismiss" /><?php// echo elgg_echo('systemmessages:dismiss'); ?></a></span>
<?php
			foreach($vars['object'] as $message) {
				echo elgg_view('messages/messages/message',array('object' => $message));
			}

?>

	</div>
	
<?php

	}

?>
