<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt <brett.profitt@gmail.com 
 */

if (get_context() != 'oi_join') {
	$oi_join_link = $vars['url'] . 'pg/omni_inviter/join/';
	echo "
	<div class=\"contentWrapper\" style=\"clear: both;\">
		<h2><a href=\"$oi_join_link\">" . elgg_echo('oi:have_invitation') . '</a></h2>
	</div>';
}