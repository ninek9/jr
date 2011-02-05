<?php

	/**
	 * Elgg 2 column right sidebar canvas layout
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @author Curverider Ltd
	 * @link http://elgg.org/
	 */

?>
<!-- main content -->
<div id="two_column_left_sidebar_maincontent">



	<?php
		if (isset($vars['area2'])) echo $vars['area2'];
	?>

</div><!-- /two_column_right_sidebar_maincontent -->


<div id="two_column_right_sidebar"><!-- right sidebar -->

	<?php
		//echo elgg_view('page_elements/owner_block',array('content' => $vars['area1']));
		if (isset($vars['area1'])) echo $vars['area1'];
	?>

</div><!-- /two_column_right_sidebar -->

