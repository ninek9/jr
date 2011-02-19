<?php

	/**
	 * controls at least the dashboard home page, maybe more. -eric, 5/17/09
	 *
	 * Elgg 2 column left sidebar with boxes
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @author Curverider Ltd
	 * @link http://elgg.org/
	 */

?>

<!-- left sidebar -->
<div id="two_column_left_sidebar_boxes">

     <?php if (isset($vars['area1'])) echo $vars['area1']; ?>

</div><!-- /two_column_left_sidebar -->  <!-- now right side -eric, 5/17/09.  now left again -eric, 11/30/09 -->

<!-- main content -->
<div id="two_column_left_sidebar_maincontent_boxes">

<?php if (isset($vars['area2'])) echo $vars['area2']; ?>

</div><!-- /two_column_left_sidebar_maincontent -->