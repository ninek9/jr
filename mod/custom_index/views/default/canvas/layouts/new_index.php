<?php

	/**
	 * Elgg custom profile 
	 * You can edit the layout of this page with your own layout and style. Whatever you put in the file
	 * will replace the frontpage of your Elgg site.
	 * 
	 * @package Elgg
	 */
	 
?>

<div id="custom_index">
	        <?php
	            //this displays some content when the user is logged out
			    if (!isloggedin()){
	            	//display the login form
			    	echo $vars['area1'];
			    	echo "<div class=\"clearfloat\"></div>";
		        }
	        ?>
    <!-- left column content -->
    <div id="index_left">	
		<img src="<?php echo $vars['url']; ?>_graphics/jr/home_mainphoto_1.png" alt="You can do it!" title="You can do it!" />
		<div id="signup"></div>
		<img id="clipboard_icon" src="<?php echo $vars['url']; ?>_graphics/jr/clipboard_icon.png" alt="Sign up!" title="Sign up!" />
		<span id="signupText">Sign Up Here.</span>
		<span id="signupText2">It's free and easy!</span>
		<!--<img id="signup_endpiece" src="<?php //echo $vars['url']; ?>_graphics/jr/signup_endpiece.png" />-->
    </div>
    
    <!-- right hand column -->
    <div id="index_right">
        <h3>Join the #1 sports networking site</h3>
		<ul id="site_highlights">
			<li><a title="Build your sports profile with all of the information that made you great: Your photos, career details, teams, awards, statistics, and much more.">Profile</a> your athletic career</li>
			<li>Connect with <a title="Whether you're still playing together or not, the bond between teammates is everlasting. Unite and connect with your comrades and defend the reputation of your dynasty!">teammates</a> and create <a title="You and your teammates can form teams and recreate rosters. Whether it's middle school, high school, college, or even just intramural, you can assemble the old squad.">teams</a></li>
			<li><a title="As a Jock Roster member you get your own Power Score, which is your personal athlete rating. This is determined by your teammates, fans, and opponents. You can rate others, and get rated on all the dimensions of a complete athlete.">Get rated</a> and build your Power Score</li>
			<li>Talk trash and <a title="Your history never dies, and neither do your rivalries! Build teams, challenge opponents, and avenge those missed opportunities. You can Captain a roster to compete against anybody for any reason.">compete</a> with old rivals</li>
			<li>Earn notoriety and win <a title="Showcase the Awards, Trophies, and Titles you've won throughout your career. You can even win Awards within Jock Roster for all sorts of accomplishments!">awards</a></li>
			<li><a title="As an athlete you represent your alma mater, which is as important as representing yourself. Build your school's reputation and stake a claim for your hometown.">Represent</a> your school and hometown</li>
			<li>Build a <a title="Where would any athlete or team be without its fans? Luckily, you can bring in the cavalry to support you and team.">fan</a> base.</li>
		</ul>
        </div>

	<!-- registration form -->
	<?php echo elgg_view("account/forms/register"); ?>
</div>