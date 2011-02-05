<?php
 
    /**
	 * Elgg Twitter CSS
	 * 
	 * @package ElggTwitter
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */
     
?>

#twitter_widget {
    margin: 0;
}

#twitter_widget ul {
	margin: 0;
	padding: 0;
}

#twitter_widget li {
	list-style-image: none;
	list-style-position: outside;
	list-style-type: none;
	margin: 0 0 10px;
	padding: 0;
	overflow-x: hidden;
}

#twitter_widget li span {
	color :#666666;
	padding: 5px 0 0;
	display: block;
}

p.visit_twitter a {
    background: url(<?php echo $vars['url']; ?>mod/twitter/graphics/twitter.png) left no-repeat;
    padding: 0 0 0 20px;
    margin: 0;
}

.visit_twitter {
	padding: 2px;
	margin: 0 0 5px;
}

#twitter_widget li a {
	display: block;
	margin: 0;
}

#twitter_widget li span a {
	display: inline !important;
}