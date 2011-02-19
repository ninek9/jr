<?php

	/**
	 * Elgg header contents
	 * This file holds the header output that a user will see
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @author Curverider Ltd
	 * @link http://elgg.org/
	 *
	 * adds custom Jock Roster navigation and search if the user is logged in, otherwise adds non-logged in homepage specific elements. -eric 11/19/09
	 */
	 
?>

<div id="page_container">
		
<?php if (isloggedin()) { ?>
	<div id="layout_header">
		<div id="wrapper_header">
			<!-- display the page title image -->
			<a href="<?php echo $vars['url']; ?>pg/dashboard/" title="<?php echo $vars['config']->sitename; ?>"><img src="<?php echo $vars['url']; ?>_graphics/jr/jrlogo.png" alt="JockRoster logo image" title="JockRoster: Be all you could've been!" /></a>
			<span class="headertagline_image"><img src="<?php echo $vars['url']; ?>_graphics/jr/header_phrase_3.png" title="Saluting the athlete in you." alt="Saluting the athlete in you." /></span>
		</div>
	</div>
<?php } else { ?>
	<div id="logged_out_layout_header">
		<div id="wrapper_header">
			<!-- display the page title image -->
			<a href="<?php echo $vars['url']; ?>" title="<?php echo $vars['config']->sitename; ?>"><img src="<?php echo $vars['url']; ?>_graphics/jr/jrlogo.png" alt="JockRoster logo image" title="JockRoster: Be all you could've been!" /></a>
			<span class="headertagline_image"><img src="<?php echo $vars['url']; ?>_graphics/jr/header_phrase_3.png" title="Saluting the athlete in you." alt="Saluting the athlete in you." /></span>			
		</div>
	</div>
	<div id="logged_out_no_nav">
		<div id="grayRibbon"></div>
		<div id="grayRibbonEnd"></div>
		<?php if (get_context() == 'main') { ?>
			<div id="loseSomething"></div>
		<?php } else { ?>
			<div id="jockTheRoster"></div>
		<?php } ?>
	</div>
<?php } ?>
	