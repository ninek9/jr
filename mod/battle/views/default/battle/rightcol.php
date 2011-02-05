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

<div id="battleRightCol"><!-- start the right battle column div -->

	<h3>Battle Record</h3>
	
	<table>
		<tr>
			<td>Row 1</td>
		</tr>
		<tr>
			<td>Row 2</td>
		</tr>
	</table>

</div><!-- end the right battle column div -->

<?php } ?>