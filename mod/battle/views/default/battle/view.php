<?php

/**
 * Battle view page
 * 
 * @package Battle
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Eric Zanol
 * @copyright 
 * @link 
 * 
 * @uses $vars['entity'] An array of messages to view
 * @uses $vars['page_view'] This is the page the messages are being accessed from; inbox or sentbox
 * 
 */
 

if (isloggedin()) {

?>

<div id="battleWrapper"><!-- start the main battle wrapper div -->

	<img id="imgBattleHeader" src="<?php echo $vars['url']; ?>_graphics/jr/battlefield_header.png" />
	
	<ul id="battleMainButtons">
		<li id="battleCreate"><a href="">Create</a></li>
		<li id="battleVote"><a href="">Vote</a></li>
		<li id="battleSearch"><a href="">Search</a></li>
	</ul>

</div><!-- end the main battle wrapper div -->

<?php } ?>