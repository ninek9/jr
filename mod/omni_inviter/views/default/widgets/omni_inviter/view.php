<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt <brett.profitt@gmail.com 
 */

$owner = get_user($vars['entity']->owner_guid);
set_page_owner($owner->getGUID());

$num_display = $vars['entity']->num_display;

if (false === $num_display) {
	$vars['entity']->num_display = 10;
	$num_display = 10;
	
}

if (!$show_invited) {
	$vars['entity']->show_invited = true;
}

$size = (int) $vars['entity']->icon_size;
if (!$size || $size == 1){
	$size_value = "small";
} else {
    $size_value = "tiny";
}

//$constraints = array(
//	'used' => true,
//);
//$invited_count = get_entities_from_metadata_multi($constraints, 'object', 'invitation', $owner->getGUID(), limit, offset, orderby. site, true);

$invited_count = get_entities_from_metadata('used', true, 'object', 'invitation', $owner->getGUID(), 
	$limit = 10, $offset = 0, $order_by = "", $site_guid = 0, $count = true);

$sent = get_entities('object', 'invitation', $owner->getGUID(), $orderby='', $limit='', $offset='', $count=true, $site='');

// get a msg to display...
if ($invited_count == 1) {
	$msg = elgg_echo('oi:widget:i_invited_singular');
} else {
	$msg = elgg_echo('oi:widget:i_invited');
}
$header = sprintf($msg, (int) $invited_count);

// get a link to OI invite...
$oi_link = $vars['url'] . 'pg/omni_inviter/invite/';
$oi_link_msg = elgg_echo('oi:widget:link_msg');

$content = "<h3>$header</h3>
<a href=\"$oi_link\">$oi_link_msg</a>
";

// add a list of users if set
// if a user is banned, deleted, or still unvalidated
// he will not show up in the listed objects below.
if ($num_display > 0) {
	$invited_entities = get_entities_from_metadata('used', true, 'object', 'invitation', $owner->getGUID(), $limit=$num_display);
	
	$content .= '<hr /><h3>' . elgg_echo('oi:widget:my_invited_users') . '</h3>
		<div class="oi_widget_invited_users_list">';
	
	foreach($invited_entities as $entity) {
		$content .= "<div class=\"oi_widget_invited_user\" >";
		$content .= elgg_view("profile/icon",array('entity' => get_user($entity->invited_guid), 'size' => $size_value));
		$content .= "</div>";
	}
	
	$content .= '</div>';
}

echo '<div class="oi_widget contentWrapper">' . $content . '</div>';