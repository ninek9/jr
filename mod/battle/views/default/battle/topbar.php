<?php
/**
	 * Battle topbar extender
	 * 
	 * @package Battle
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author 
	 * @copyright 
	 * @link
	 */
	 
	 //need to be logged in to view battle content
	 //gatekeeper();

?>

	<a href="<?php echo $vars['url']; ?>pg/battle/<?php echo $_SESSION['user']->username; ?>" class="<?php if (get_context() == 'battle') echo 'current'; ?>" >Battle</a>