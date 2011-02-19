<?php

	/**
	 * Elgg footer
	 * The standard HTML footer that displays across the site
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @author Curverider Ltd
	 * @link http://elgg.org/
	 * 
	 */
	 
	 // get the tools menu
	//$menu = get_register('menu');

?>

<div id="layout_footer">
	<a href="http://www.elgg.org" target="_blank"><img src="<?php echo $vars['url']; ?>_graphics/powered_by_elgg_badge_drk_bckgnd.gif" border="0" alt="Powered by Elgg, the leading open source social networking platform" title="Powered by Elgg, the leading open source social networking platform" /></a>
</div>

<?php echo elgg_view('footer/analytics'); ?>

</div><!-- /#page_wrapper -->
</div><!-- /#page_container -->

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9360878-3");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>