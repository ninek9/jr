<?php

function jockroster_theme_init ()
{
	// i don't think you have to extend the css because the css file in an enabled plugin entirely overrides the existing stylesheet, and i started from a copy of the default stylesheet. -eric, 1/24/10
	// Extend system CSS with our own styles
	//extend_view('css','jockroster_theme/css');
	
	extend_view('metatags','jockroster_theme/metatags');
}
// Initialise plugin
register_elgg_event_handler('init','system','jockroster_theme_init');

?>