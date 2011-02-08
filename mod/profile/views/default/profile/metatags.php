<?php

	/**
	 * Adds metatags to load Javascript required for the profile
	 * 
	 * @package ElggProfile
	 * 
	 */

	/*
	 * <script type="text/javascript" src="<?php echo $vars['url']; ?>pg/iconjs/profile.js" ></script>
	 */

?>

		<?php if ($owner = page_owner_entity()) { ?><link rel="meta" type="application/rdf+xml" title="FOAF" href="<?php echo full_url(); ?>?view=foaf" /><?php } ?>
		<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery.rating.js"></script>
		<script type="text/javascript">
				$(document).ready(function() {
						$('#allRatings').dialog({
								autoOpen: false,
								modal: true,
								resizeable: false,
								show: 'scale',
								hide: 'scale',
								position: 'top'
						});
						$('#psVotesSpan a').click(function(){
								$('#allRatings').dialog('open');
						});
				});
		</script>
	
