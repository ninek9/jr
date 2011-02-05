<?php // this is additional javascript that is added for the custom_index page ?>
<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery.label_over.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#register-box input.pw2').focus(function() {
			$('#register-box input.ignore').removeAttr('disabled');
			$('#register-box input.ignore').removeAttr('class');
			$('#register-box #siteaccess-code img').css('opacity', '1');
			$('#register-box #siteaccess-code img').css('filter', 'alpha(opacity = 100)');
		});
		
		$('.login-inputs input.ignore').removeAttr('disabled');
		$('.login-inputs input.ignore').removeAttr('class');
		$('.login-inputs #siteaccess-code img').css('opacity', '1');
		$('.login-inputs #siteaccess-code img').css('filter', 'alpha(opacity=100)');

		$('div.register-inputs > label').labelOver('over-apply');
		
		$('#site_highlights li a').tooltip({
			delay: 0,
			top: 10,
			left: 0,
			track: true
		});
	});
</script>

<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery.dimensions.pack.js"></script>
<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery.tooltip.pack.js"></script>
