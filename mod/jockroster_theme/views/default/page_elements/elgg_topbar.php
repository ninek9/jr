<?php

	/**
	 * defines the user menu that is displayed whenever a user is logged in. -eric, 5/16/09
	 *
	 * Elgg top toolbar
	 * The standard elgg top toolbar
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @author Curverider Ltd
	 * @link http://elgg.org/
	 * 
	 */
?>
	
<?php
	if (isloggedin()) {
?>
		
<div id="elgg_topbar">
	<div id="elgg_topbar_container">
		<div id="elgg_topbar_container_left">
			<div class="toolbarimages">
			</div>
			<div class="toolbarlinks">
				<ul class="topbardropdownmenu">
					<li class="drop chMenu"><a href="<?php echo $vars['url']; ?>pg/dashboard/"<?php if (get_context() == 'dashboard') echo ' class="current"'; ?>>CLUBHOUSE</a>
					  <ul>
							<li class="odd"><a href="<?php echo $vars['url']; ?>pg/members/">Roster</a></li>
							<!--<li><a href="<?php //echo $vars['url']; ?>pg/messageboard/<?php //echo $_SESSION['username']; ?>">The Cooler</a></li>
							<li class="odd"><a>Trophycase</a></li>
							<li><a>Pressbox</a></li>-->
					  </ul>
					</li>
				</ul>
				<?php // check context and page owner against logged in user to add current page to only the logged in user's own profile link ?>
				<a href="<?php echo $vars['url']; ?>pg/profile/<?php echo $_SESSION['username']; ?>" class="pagelinks<?php if (get_context() == 'profile' && page_owner_entity() == $vars['user']) echo ' current'; ?>"><?php echo $_SESSION['name']; ?></a>
			</div>
			
			<div class="toolbarlinks2">
			<?php
				//allow people to extend this top menu
				echo elgg_view('elgg_topbar/extend', $vars);
			?>
				<!--<a href="<?php //echo $vars['url']; ?>pg/friends/" class="pagelinks<?php //if (get_context() == 'friends') echo ' current'; ?>">Friends</a>-->
				
				<?php // the "Friends" link in the Tools drop down is removed via the elgg/engine/lib/users.php file line 1467 .  find a better way to extend that so that it's not blown on upgrade. ?>
				
				<div style="float:left;"><?php echo elgg_view("navigation/topbar_tools"); ?></div>
			</div>
		
		</div>
			
		<div id="elgg_topbar_container_right">			
			<?php
				// The administration link is for admin or site admin users only
				if ($vars['user']->isAdmin()) { 
			?>
				<a href="<?php echo $vars['url']; ?>pg/admin/" class="usersettings<?php if (get_context() == 'admin') echo ' current'; ?>"><?php echo elgg_echo("admin"); ?></a>
			<?php } ?>
			<a href="<?php echo $vars['url']; ?>pg/settings/" class="usersettings<?php if (get_context() == 'settings') echo ' current'; ?>"><?php echo elgg_echo('settings'); ?></a>
			<?php echo elgg_view('output/url', array('href' => "{$vars['url']}action/logout", 'text' => elgg_echo('logout'), 'is_action' => TRUE)); ?>
		</div>
		
		<div id="elgg_topbar_container_search">
			<?php echo elgg_view('page_elements/searchbox'); ?>
			<!--<form id="searchform" action="<?php //echo $vars['url']; ?>search/" method="get">
				<input type="text" size="21" name="tag" value="Search" onclick="if (this.value=='Search') { this.value='' }" class="search_input" />
				<?php //elgg_view('input/securitytoken'); ?>
				<input type="submit" value="&nbsp;" class="search_submit_button" title="Find!" />
			</form>-->
		</div>	
	</div>
</div><!-- /#elgg_topbar -->

<div class="clearfloat"></div>

<?php } ?>

<!-- have to put this here since we're not using it in the header_contents file -->
<div id="page_wrapper">