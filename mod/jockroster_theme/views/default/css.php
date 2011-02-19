<?php

	/**
	 * This is the original, mostly unedited stylesheet (I think). Edit the other css.php in the custom_index folder to customize.  -eric, 5/7/09
	 * I've actually edited this in places.  Other file referenced above overrides like-named elements. -eric, 5/12/09
	 * Turns out this is the most edited stylesheet. Probably not the intention of the elgg folks, but it works. Still also editing stylesheets in individual mod folders. -eric, 6/2/09
	 ****************************************************************************************************************
	 * Moved the theme stuff into a plugin and so this entire file should completely override the elgg default styles. It is a copy of the default elgg style sheet, but has been heavily edited. -eric, 7/7/09
	 *
	 *
	 *
	 ****************************************************************************************************************
	 *
	 * Jock Roster Theme
	 * core CSS file
	 * 
	 * Updated 10 March 09
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @copyright Eric Zanol 2009-2010
	 * @link http://jockroster.com/
	 * 
	 * @uses $vars['wwwroot'] The site URL
	 */

?>

/* ***************************************
	RESET BASE STYLES
*************************************** */
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-weight: inherit;
	font-style: inherit;
	font-size: 100%;
	font-family: inherit;
	vertical-align: baseline;
}

/* remember to define focus styles! */
:focus {
}

ol, ul {
	list-style: none;
}

/* tables still need cellspacing="0" (for ie6) */
table {
	border-collapse: separate;
	border-spacing: 0;
}

caption, th, td {
	text-align: left;
	font-weight: normal;
	vertical-align: top;
}

blockquote:before, blockquote:after,
q:before, q:after {
	content: "";
}

blockquote, q {
	quotes: "" "";
}

.clearfloat { 
	clear: both;
	height: 0;
	font-size: 1px;
	line-height: 0px;
}

/* ***************************************
	DEFAULTS
*************************************** */

/* elgg open source		blue 			#4690d6 */
/* elgg open source		dark blue 		#0054a7 */
/* elgg open source		light yellow 	#FDFFC3 */
/* elgg open source		light blue	 	#bbdaf7 */


body {
	text-align: left;
	margin: 0 auto;
	padding: 0;
	<?php if (isloggedin()) { ?>
		background: #ffffff;
	<?php } else { ?>
		background-color: #c9d2ef;
	<?php } ?>
	font-family: Arial, sans-serif;
	font-size: 12px;
	color: #000;
}

a {
	color: #083674;
	text-decoration: none;
}

a:hover {
	color: #E05B00;
	text-decoration: none;
}

p {
	margin: 0px 0px 15px 0;
}

img {
	border: none;
}

ul {
	margin: 5px 0px 15px;
	padding-left: 20px;
}

ul li {
	margin: 0px;
}

ol {
	margin: 5px 0px 15px;
	padding-left: 20px;
}

ul li {
	margin: 0px;
}

form {
	margin: 0px;
	padding: 0px;
}

small {
	font-size: 90%;
}

h1, h2, h3, h4, h5, h6 {
	font-weight: bold;
	line-height: normal;
}

h1 { font-size: 1.8em; }
h2 { font-size: 1.5em; }
h3 { font-size: 1.2em; }
h4 { font-size: 1.0em; }
h5 { font-size: 0.9em; }
h6 { font-size: 0.8em; }

dt {
	margin: 0;
	padding: 0;
	font-weight: bold;
}

dd {
	margin: 0 0 1em 1em;
	padding: 0;
}

pre, code {
	font-family: Monaco,"Courier New",Courier,monospace;
	font-size:12px;
	background:#EBF5FF;
	overflow:auto;
}

code {
	padding:2px 3px;
}

pre {
	padding:3px 15px;
	margin:0px 0 15px 0;
	line-height:1.3em;
}

blockquote {
	padding:3px 15px;
	margin:0px 0 15px 0;
	line-height:1.3em;
	background:#EBF5FF;
	border:none !important;
}

blockquote p {
	margin:0 0 5px 0;
}

strong {
	font-weight: bold;
}

em {
	font-style: italic;
}

/*****************************************
	END DEFAULTS
*****************************************/

/*****************************************
	BEGIN NAV DECLARATIONS - applies to header located in /htdocs/elgg/views/default/header_contents.php 
******************************************/

#nav {
	width: 100%;
	background-color: #000;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/menubg.jpg);
	background-position: left top;
	background-repeat: repeat-x;
	height: 48px;
	margin: 0;
	padding: 0;
	text-align: center;
}

#nav ul {
	width: 911px;
	margin: 0 auto;
	padding: 0;
	height: 48px;
}

#nav ul li {
	display: block;
	float: left;
	line-height: 47px;
	margin: 0;
	padding: 0;
}

#nav ul li a {
	display: block;
	height: 100%;
	color: #fff;
	text-decoration: none;
	font-size: 11px;
	font-weight: bold;
	padding: 0 20px;
	line-height: 47px;
}

#nav ul li a.active {
	background-color: #454545;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/menuactivebg.jpg);
	background-position: left top;
	background-repeat: repeat-x;
	border: 0;
}

/****************************************
	END NAV DECLATIONS 
****************************************/


/****************************************
	CUSTOM INDEX
****************************************/

#custom_index {
	margin: 0;
	padding: 0;
	width: 100%;
	position: relative;
	z-index: 1000;
	height: 600px;
}

#index_left {
	width: 512px;
	margin: 0 20px 0 0;
	padding: 0;
	position: absolute;
	top: -40px;
	left: 0;
}

#index_right {
	margin: 0;
	padding: 0;
	position: absolute;
	left: 518px;
	top: 60px;
}

/* registration box stuff found with other register styles */


#site_highlights {
	list-style-image: url(<?php echo $vars['url']; ?>_graphics/jr/highlightsbullet.png);
	font-size: 14px;
	font-weight: bold;
	margin-left: 20px;
}

#site_highlights li {
	padding: 5px 0;
}

#fbintegration {
	color: #3c5ca7;
	width: 140px;
	font-size: 10px;
	font-weight: bold;
	position: absolute;
	top: 300px;
	left: 215px;
}

#custom_index a {
	color: #0623c7;
	cursor: default;
}

#custom_index h3 {
	font-size: 20px;
	font-weight: bold;
}

#custom_index img {
	position: relative;
	left: -4px;
}

#custom_index #signup {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/signup_bluebar_repeat.png);
	background-position: top left;
	background-repeat: repeat-x;
	height: 45px;
	width: 318px;
	position: absolute;
	bottom: 8px;
	left: 90px;
	z-index: 400;
	/*border-bottom: 1px solid #001c2a;
	opacity: .87;
	filter: alpha(opacity=87);*/
	line-height: 45px;
}

#custom_index #signupText {
	font-size: 16px;
	font-weight: bold;
	color: #fff;
	position: absolute;
	z-index: 501;
	bottom: 21px;
	left: 143px;
}

#custom_index #signupText2 {
	font-size: 16px;
	font-weight: bold;
	color: #b1bae1;
	position: absolute;
	z-index: 502;
	bottom: 21px;
	left:  254px;
}

#custom_index #clipboard_icon {
	position: absolute;
	bottom: 20px;
	left: 102px;
	z-index: 503;
}

#custom_index #signup_endpiece {
	position: absolute;
	bottom: 9px;
	left: 442px;
	z-index: 504;
}

#tooltip {
	background-color: #fffffe;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/hover_box_bg.png);
	background-position: bottom left;
	background-repeat: repeat-x;
	border: 1px solid #fff;
	position: absolute;
	width: 200px;
	z-index: 9999;
	padding: 10px;
	opacity: .94;
	filter: alpha(opacity = 94);
	font-size: 11px;
	font-weight: bold;
}

#tooltip h3 {
	font-size: 1em;
	font-weight: normal;
}

div.register-inputs {
	position: relative;
	float: left;
}

div.register-inputs label.over-apply {
	color: #9a9a9a;
	position: absolute;
	top: 3px;
	left: 7px;
}

/****************************************
	END CUSTOM INDEX
****************************************/



/* ***************************************
	LOGIN / REGISTER
*************************************** */
#login-box {
	margin: 0;
	padding: 0;
	/* width: 257px; */
	height: 100px;
	text-align: right;
	position: absolute;
	right: 10px;
	top: -187px;
}

/*
#login-box form {
	margin: 0;
	padding: 0;
	display: block;
}
*/

#login-box h2 {
	color: #0054A7;
	font-size: 1.35em;
	line-height: 1.2em;
	margin: 0 0 0 8px;
	padding: 5px 5px 0 5px;
}

#login-box .login-inputs {
	width: 210px;
	text-align: right;
	margin-top: 4px;
}

div.login-inputs label {
	float: left;
	font-size: .8em;
	font-weight: bold;
	color: #888;
	line-height: 18px;
	width: 82px;
	text-align: right;
	padding-right: 3px;
}

#login-box .login-username, #login-box .login-password {
	width: 120px;
	padding: 2px 0 0 0;
	margin-bottom: 4px;
	height: 18px;
	line-height: 20px;
	text-align: left;
	-moz-box-shadow: 1px 1px 1px #ddd;
}

/*
#login-box .login-password {
	width: 148px;
	margin-bottom: 7px;
	padding: 0;
	border: 0;
	float: left;
	height: 22px;
	line-height: 22px;
}
*/

#login-box .login-submit {
	width: 54px;
	height: 27px;
	margin: 0;
	margin-left: 5px;
	padding: 0;
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -1px -1px;
	background-repeat: no-repeat;
	text-indent: -999em;
	border: 0;
	font-size: 0px;
	line-height: 0px;
}

#login-box .login-submit:hover {
	background-position: -1px -28px;
}

#login-box .remember-label {
	margin: 0;
	padding: 0;
	text-align: right;
	vertical-align: middle;
	width: 210px;		/* 200 is fine in FF, but IE needs at least 206. -eric */
	font-size: 11px;
	line-height: 23px;
}

#login-box .remember-label p {
	margin: 0;
	padding: 0;
	width: 100%;
}

#login-box .remember-label label {
	color: #00254A;
	font-weight: normal;
	margin: 0;
}

#login-box .remember-label input {
	margin: 0 4px;
	padding: 0;
	border: 0;
	vertical-align: middle;
}

#login-box .remember-label a {
	line-height: 23px;
}

#login-box .remember-label a:hover {
	color: #81c0e9 !important;
}

#login-box p.loginbox {
	margin: 0;
}

#login-box a, #login-box a:hover, #login-box a:visited {
	color: #0a3675 !important;
	text-decoration: none;
}

#custom_index #register-box p {
	margin-bottom: 2px;
}

#custom_index #register-box label {
	width: 85px;
	margin-bottom: 0;
	margin-right: 5px;
	font-weight: bold;
	text-align: right;
	position: relative;
	top: 7px;
	float: left;
	font-size: 85%;
}

#custom_index #register-box input[type="text"],
#custom_index #register-box input[type="password"] {
	width: 187px;
	height: 26px;
	margin: 0 5px 2px 10px;
	border: 1px solid #a7a7a7;
	-moz-box-shadow: inset 0 0 6px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.2);
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
}

#custom_index #register-box input[type="submit"] {
	width: 54px;
	height: 27px;
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -88px -253px;
	background-repeat: no-repeat;
	border: 0;
	position: absolute;
	top: 187px;
	left: 187px;
	margin: 0;
	padding: 0;
}

#custom_index #register-box input[type="submit"]:hover {
	background-position: -88px -280px;
}

#login-box h2,
#login-box-openid h2,
#register-box h2,
#add-box h2,
#forgotten_box h2 {
	color: #0054A7;
	font-size: 1.35em;
	line-height: 1.2em;
	margin: 0 0 5px;
}

#register {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/registerbg.jpg);
	background-position: top left;
	background-repeat: repeat-x;
	height: 24px;
	line-height: 24px;
	width: 201px;
	margin: 0;
	padding: 0 15px;
	font-size: 11px;
	color: #FFCC18;
	clear: left;
	border: 1px solid #526DB2;
	border-top: none;
}

#register a {
	color: #fff;
}

#register-box {
	text-align: left;
	width: 400px;
	padding: 10px;
	background: #dedede;
	margin: 0;
}

#custom_index #register-box {
	width: 334px;
	height: 235px;
	padding: 12px 20px;
	position: absolute;
	top: 300px;
	left: 82px;
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/signup_box.png);
	background-position: top left;
	background-repeat: no-repeat;
}

#persistent_login label {
	font-size: 1.0em;
	font-weight: normal;
}

/* login and openID boxes when not running custom_index mod */
#two_column_left_sidebar #login-box {
	width: auto;
	background: none;
}

#two_column_left_sidebar #login-box form {
	width:auto;
	margin: 10px 10px 0 10px;
	padding: 5px 0 5px 10px;
}

#two_column_left_sidebar #login-box h2 {
	margin: 0 0 0 5px;
	padding: 5px 5px 0 5px;
}

#two_column_left_sidebar #login-box .login-textarea {
	width: 158px;
}
/***************************************
 *	 END LOGIN/REGISTER
****************************************/


/* **************************************
    PAGE LAYOUT - MAIN STRUCTURE
****************************************/
#page_container {
	margin: 0;
	padding: 0;
	<?php if (!isloggedin()) { ?>
		background-color: #c9d2ef;
		background-image: url(<?php echo $vars['url']; ?>_graphics/jr/logged_out_body_blue_bg.jpg);
		background-position: left 191px;
		background-repeat: repeat-x;
	<?php } ?>
}

#page_wrapper {
	width: 911px;
	margin: 0 auto;
	margin-top: 15px;
	padding: 0;
	min-height: 300px;
}

#layout_header {
	text-align: center;
	width: 100%;
	background-color: #dedede;
	background-position: bottom left;
	background-repeat: repeat-x;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/header_gray_bg.jpg);
	height: 89px;
	border-bottom: 1px solid #e4e4e4;
}

#logged_out_layout_header {
	text-align: center;
	width: 100%;
	background-color: #dedede;
	background-position: bottom left;
	background-repeat: repeat-x;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/logged_out_header_gray_bg.jpg);
	height: 191px;
}

#logged_out_no_nav {
	width: 911px;
	background: transparent;
	height: 84px;
	margin: 0 auto;
	padding: 0;
	position: relative;
	height: 1px;
}

#grayRibbon {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/gray_ribbon.png);
	background-position: top left;
	background-repeat: repeat-x;
	width: 2908px;
	height: 91px;
	position: absolute;
	right: 36px;
	top: -47px;
}

#grayRibbonEnd {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/gray_ribbon_end.png);
	background-position: top left;
	background-repeat: no-repeat;
	width: 77px;
	height: 91px;
	position: absolute;
	right: -41px;
	top: -47px;
}

#jockTheRoster {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/stake_your_claim.png);
	background-position: top left;
	background-repeat: no-repeat;
	width: 252px;
	height: 37px;
	position: absolute;
	right: 142px;
	top: -19px;
}

#loseSomething {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/lose_something.png);
	background-position: top left;
	background-repeat: no-repeat;
	width: 252px;
	height: 45px;
	position: absolute;
	left: 301px;
	top: -25px;
}

#wrapper_header {
	width: 911px;
	margin: 0 auto;
	padding: 0:
	position: relative;
	text-align: left;
}

#wrapper_header img {
	margin: 0;
	padding: 0;
	position: absolute;
	<?php if (isloggedin()) { ?>
		top: 11px;
	<?php } else { ?>
		top: 37px;
	<?php } ?>
}

span.headertagline_text {
	position: relative;
	top: 32px;
	left: 300px;
	font-size: 15pt;
	color: #d66900;
	font-weight: bold;
}

span.headertagline_image {
	color: #004672;
	position: relative;
	top: 26px;
	left: 300px;
}

#layout_canvas {
	margin: 0;
	padding: 0;
	width: 100%;
}

/* canvas layout: 1 column, no sidebar */
#one_column {
	margin: 0;
	padding: 30px 0 10px 0;
	background-color: #e0e0e0;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/inboxmessagelistbg.png);
	background-position: left top;
	background-repeat: repeat-x;
}

#one_column_small {
	width: 350px;
	margin: 64px auto 0;
	background: #dedede;
	padding: 0;
	-moz-box-shadow: 0 0 4px #999;
	-webkit-box-shadow: 0 0 4px #999;
	border: 1px solid #fff;
}

#one_column_small #content_area_user_title h2 {
	margin: 10px 20px;
}


/* canvas layout: 2 column left sidebar */
#two_column_left_sidebar {
	width: 171px;
	margin: 0 19px 0 0;
	min-height: 360px;
	float: left;
	padding: 0;
	background-color:  #d9ddf0;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/inboxmenucolbg.png);
	background-position: left top;
	background-repeat: repeat-x;
}

#two_column_left_sidebar_maincontent {
	width: 701px;
	margin: 0;
	min-height: 458px;
	float: left;
	padding: 0 10px 10px;
	background-color: #e0e0e0;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/inboxmessagelistbg.png);
	background-position: left top;
	background-repeat: repeat-x;
}

#two_column_left_sidebar_maincontent_boxes {
	margin: 0 0 20px;
	padding: 0 0 5px 0;
	width: 675px;
	background-color: #e0e0e0;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/inboxmessagelistbg.png);
	background-position: left top;
	background-repeat: repeat-x;
	float: left;
}

#two_column_left_sidebar_boxes {
	width: 210px;
	margin: 0 19px 20px 0;
	min-height: 360px;
	float: left;
	padding: 0;
}

#two_column_left_sidebar_boxes .sidebarBox {
	margin: 0 0 22px;
	background: #e0e0e0;
	padding: 0 0 10px;
}

#two_column_left_sidebar_boxes .sidebarBox h3 {
	padding: 0 10px;
	margin-bottom: 10px;
	font-size: 1.25em;
	color: #fff;
	height: 37px;
	font-weight: bold;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/inboxusernamebg.png);
	background-position: top left;
	background-repeat: repeat-x;
	line-height: 37px;
}

#two_column_left_sidebar_boxes .sidebarBox p, #two_column_left_sidebar_boxes .sidebarBox form {
	padding: 0 10px;
}

#two_column_left_sidebar_boxes .sidebarBox form p {
	padding: 0;
}

#two_column_left_sidebar_boxes .sidebarBox h3 + p + p {
	font-size: 120%;
	font-weight: bold;
}

/* for group search widget button on group page */
#two_column_left_sidebar_boxes .sidebarBox #groupsearchform input[type="submit"] {
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -484px -1px;
	background-repeat: no-repeat;
	text-indent: -999em;
	width: 36px;
	height: 27px;
	padding: 0;
	border: 0;
	font-size: 0px;
	line-height: 0px;
}

#two_column_left_sidebar_boxes .sidebarBox #groupsearchform input[type="submit"]:hover {
	background-position: -484px -28px;
}
/* end group search widget button */


/* two column right sidebar styles */

#two_column_right_sidebar {
	width: 230px;
	margin: 0 0 0 19px;
	min-height: 360px;
	float: left;
	padding: 0;
	background-color: #fff;
	/* background-color:  #d8dff2;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/inboxmenucolbg.png);
	background-position: left top;
	background-repeat: repeat-x; */
}

#two_column_right_sidebar_maincontent {
	width: 658px;
	margin: 0;
	min-height: 435px;
	float: left;
	padding: 0 0 5px 0;
}

/* end two column right sidebar styles */


.contentWrapper {
	background: #fff;
	padding: 10px;
	margin: 0 10px 10px 10px;
	border: 1px solid #bcbcbc;
}

.forgotPassword {
	padding: 15px 10px;	
}

span.contentIntro p {
	margin: 0;
}

.notitle {
	margin-top: 10px;
}

/* canvas layout: widgets (profile and dashboard) */


#widgets_left {
	width: 200px;
	margin: 0 19px 20px 0;
	min-height: 360px;
	padding: 0;
	float: left;
}

#widgets_middle {
	width: 432px;
	margin: 0 0 20px 0;
	padding: 0;
	float: left;
}

#widgets_right {
	margin: 0px 0 20px 10px;
	padding: 0;
	width: 240px;
	float: left;
}

#widget_table {

}

#widget_table td {
	border: 0;
	padding: 0;
	margin: 0;
	text-align: left;
	vertical-align: top;
}

/* IE6 fixes */
* html #widgets_right { 
	float:none; 
}

* html #profile_info_column_left {
	margin: 0 10px 0 0;
	width: 200px;
}

* html #dashboard_info { 
	width: 585px;
}

/* IE7 */
*:first-child+html #profile_info_column_left { 
	width: 200px;
}


/* ***************************************
	SPOTLIGHT
*************************************** */
#layout_spotlight {
	margin:20px 0 20px 0;
	padding:0;
	background: white;
	border-bottom:1px solid #cccccc;
	border-right:1px solid #cccccc;
}

#wrapper_spotlight {
	margin:0;
	padding:0;
	height:auto;
}

#wrapper_spotlight #spotlight_table h2 {
	color:#4690d6;
	font-size:1.25em;
	line-height:1.2em;
}

#wrapper_spotlight #spotlight_table li {
	list-style: square;
	line-height: 1.2em;
	margin:5px 20px 5px 0;
	color:#4690d6;
}
#wrapper_spotlight .collapsable_box_content  {
	margin:0;
	padding:10px 10px 5px 10px;
	background:none;
	min-height:60px;
	border:none;
	border-top:1px solid #cccccc;
}
#spotlight_table {
	margin:0 0 2px 0;
}
#spotlight_table .spotlightRHS {
	float:right;
	width:270px;
	margin:0 0 0 50px;
}
/* IE7 */
*:first-child+html #wrapper_spotlight .collapsable_box_content {
	width:958px;
}
#layout_spotlight .collapsable_box_content p {
	padding:0;
}
#wrapper_spotlight .collapsable_box_header  {
	border: none;
	background: none;
}


/* ***************************************
	FOOTER
*************************************** */
#layout_footer {
	height: 80px;
	margin: 40px 0 20px 0;
	text-align: right;
}

#layout_footer a, #layout_footer p {
   color:#333333;
   margin:0;
}

#layout_footer .footer_toolbar_links {
	text-align:right;
	padding:15px 0 0 0;
	font-size:1.2em;
}

#layout_footer .footer_legal_links {
	text-align:right;
}


/*****************************************
	SEARCH
*****************************************/
/* search bar originally applied within topbar file, but absolutely placed outside topbar */
#elgg_topbar_container_search {
	height: 48px;
	margin: 0 auto;
	position: absolute;
	right: 0;
	text-align: right;
}

#searchform {
	margin: 0;
	padding: 0;
	width: 200px;
	height: 48px;
	line-height: 48px;
}

#searchform input.search_input {
	background-color: #fff;
	border: 1px solid #bbb;
	color: #999999;
	font-size: 12px;
	margin: 0;
	margin-left: 0;
	padding: 2px;
	width: 133px;
}

#searchform input.search_submit_button {
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/searchgobutton.png);
	background-position: top left;
	background-repeat: no-repeat;
	width: 26px;
	height: 26px;
	border: none;
	margin: 0;
	padding: 0;
	cursor: pointer;
	text-indent: -999em;
}

#searchform input.search_submit_button:hover {
	color: #E05B00;
}


/* ***************************************
  HORIZONTAL ELGG TOPBAR
*************************************** */
#elgg_topbar {
	position: relative;
	width: 100%;
	background-color: #000;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/menubg.png);
	background-position: top left;
	background-repeat: repeat-x;
	color: #fff;
	height: 48px;
	margin: 0;
	text-align: center;
	border-bottom: 0; /* must include otherwise default kicks in */
	z-index: 1000; /* if you have multiple position:relative elements, then IE sets up separate Z layer contexts for each one, which ignore each other */
}

#elgg_topbar_container {
	position: relative;
	width: 911px;
	margin: 0 auto;
	text-align: left;
}

#elgg_topbar_container_left {
	top: 0px;
	position: absolute;
	height: 48px;
	line-height: 48px;
	margin: 0;
	float: left;
	left: 0;
	text-align: left;
	width: 60%;
}

#elgg_topbar_container_right {
	position: absolute;
	float: right;
	right: 0;
	top: -89px;
	height: 24px;
	line-height: 24px;
	text-align: right;
	margin: 0;
}

#elgg_topbar_container_left li.chMenu {
	margin-right: 9px;
}

#elgg_topbar_container_left li.chMenu a {
	border-left: 1px dotted #777;
	border-right: 1px dotted #777;
}

#elgg_topbar_container_left li.chMenu ul li a {
	border: 0;
}

#elgg_topbar_container_left li.chMenu a + ul li a:hover {
	color: #0a3675 !important;
	text-decoration: underline;
}

#elgg_topbar_container_left .toolbarimages {
	display: none;
	float: left;
	margin: 5px 20px 5px 20px;
}

#elgg_topbar_container_left .toolbarlinks, 
#elgg_topbar_container_left .toolbarlinks2 {
	margin: 0;
	float: left;
	height: 48px;
}

#elgg_topbar_container_left .toolbarlinks a, 
#elgg_topbar_container_left .toolbarlinks2 a {
	display: block;
	margin: 0;
	padding: 0 10px;
	float: left;
	color: #fff;
}

#elgg_topbar_container_left .toolbarlinks2 a.menuitemtools {
	cursor: default;
}

#elgg_topbar_container_right a {
	display: block;
	margin: 0;
	padding: 0 5px;
	color: #000;
	float: left;
	font-size: 10px;
}

#elgg_topbar_container_left .toolbarlinks a:hover, 
#elgg_topbar_container_left .toolbarlinks2 a:hover {
	color: #81c0e9;
}

#elgg_topbar_container_right a:hover {
	color: #328fcd;
}

#elgg_topbar_container_left a.loggedinuser {
	font-weight:bold;
	margin:0 0 0 5px;
}

#elgg_topbar_container_left a.pagelinks, 
#elgg_topbar_container_left a.privatemessages,
#elgg_topbar_container_left a.privatemessages_new,  
#elgg_topbar_container_left a.usersettings,
#elgg_topbar_container_left a.new_friendrequests {
	display: block;
}

#elgg_topbar_container_left a.pagelinks:hover, 
#elgg_topbar_container_left a.privatemessages:hover,
#elgg_topbar_container_left a.privatemessages_new:hover,
#elgg_topbar_container_left a.usersettings:hover,
#elgg_topbar_container_left a.new_friendrequests:hover {
	
}

#elgg_topbar_container_left a.privatemessages_new {
	color: #fff;
}

#elgg_topbar_container_left a.new_friendrequests {
	color: #ffec94;
}

/* IE6 */
* html #elgg_topbar_container_left a.privatemessages_new { 
		background-position: left -18px;
} 

/* IE7 */
*+html #elgg_topbar_container_left a.privatemessages_new { 
		background-position: left -18px;
} 

#elgg_topbar_container_left img {
	margin:0 0 0 5px;
}

#elgg_topbar_container_left .user_mini_avatar {
	border: 1px solid #fff;
	margin: 0;
}

#elgg_topbar_container_left a.current,
#elgg_topbar_container_left a.current {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/nav_carrot.png);
	background-repeat: no-repeat;
	background-position: bottom center;
	font-weight: bold;
	margin: 0;
}

/* IE6 fix */
* html #elgg_topbar_container_right a { 
	width: 120px;
}

#elgg_topbar_panel {
	background: #333333;
	color: #eeeeee;
	height: 200px;
	width: 100%;
	padding: 10px 20px 10px 20px;
	display: none;
	position: relative;
}




/* ***************************************
	TOP BAR - VERTICAL TOOLS MENU
*************************************** */
/* elgg toolbar menu setup */
ul.topbardropdownmenu, ul.topbardropdownmenu ul {
	margin: 0;
	padding: 0;
	display: block;
	list-style-type: none;
	z-index: 9000;
	position: relative;
}

ul.topbardropdownmenu {
	float: left;
}

ul.topbardropdownmenu li { 
	display: block;
	list-style: none;
	margin: 0;
	padding: 0;
	float: none;
}

ul.topbardropdownmenu li.odd {
	background-color: #c9d4f0;
}

ul.topbardropdownmenu a {
	display: block;
	padding: 3px;
	text-decoration: none;
	cursor: pointer;
}

ul.topbardropdownmenu a:hover {
	color: #81c0e9 !important;
}

#elgg_topbar_container_left ul.topbardropdownmenu a.current:hover {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/nav_carrot_blue.png);
	background-repeat: no-repeat;
	background-position: bottom center;
}

ul.topbardropdownmenu a.menuitemtools + ul li a:hover {
	color: #0a3675 !important;
	text-decoration: underline;
}

ul.topbardropdownmenu ul {
	display: none;
	position: absolute;
	left: 0;
	margin: 0;
	padding: 0;
	width: 96px;
	top: 48px;
	float: none;
	border: 1px solid #97A8D4;
	border-top: none;
	line-height: 28px;
	background-color: #e2e9fb;
}

/* IE6 fix */
* html ul.topbardropdownmenu ul {
	line-height: 1.1em;
}

/* IE6/7 fix */
ul.topbardropdownmenu ul a {
	zoom: 1;
} 

ul.topbardropdownmenu ul li {
	float: none;
}

ul.topbardropdownmenu ul li.drop a {
	font-weight: normal;
}

/* IE7 fixes */
*:first-child+html #elgg_topbar_container_left a.pagelinks {

}
*:first-child+html ul.topbardropdownmenu li.drop a.menuitemtools {
	padding-bottom: 6px;
}

ul.topbardropdownmenu ul li a {
	color: #0a3675 !important;
}

ul.topbardropdownmenu li.drop ul li a {
	float: none !important;
}



/* ***************************************
  SYSTEM MESSSAGES
*************************************** */
.messages {
	background-color: #fce96d;
	background-image: url(<?php  echo $vars['url']; ?>_graphics/jr/confirmation_repeat.gif);
	background-position: top left;
	background-repeat: repeat-x;
	border: 1px solid #fff9cd;
	-moz-box-shadow: 0 0 1px #e1c11a;
	-webikit-box-shadow: 0 0 1px #e1c11a;
}

.messages_error {
	background: #F7DAD8;
	border: 4px solid #D3322A;
}

.messages, .messages_error {
	color: #000;
	padding: 0 10px;
	z-index: 10000;
	margin: 0 0 0 -455px;
	position: fixed;
	top: 0;
	left: 50%;
	width: 890px;
	cursor: pointer;
	font-weight: bold;
}

.messages p, .messages_error p {
	margin-bottom: 14px;
	text-align: center;
}

.closeMessages {
	float: right;
	margin-top: 10px;
}

.closeMessages a {
	color: #666;
	cursor: pointer;
	text-decoration: none;
	font-size: 80%;
}

.closeMessages a:hover {
	color: black;
}


/* ***************************************
  COLLAPSABLE BOXES
*************************************** */
.collapsable_box {
	margin: 0 0 20px 0;
	height: auto;
	padding: 0;
}

/* IE6 fix */
* html .collapsable_box  { 
	height:10px;
}

.collapsable_box_header {
	color: #000;
	/* padding: 5px 10px; */
	padding: 0 10px 5px 10px;
	margin: 0;
	height: 21px;
	line-height: 21px;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/header_rule.png);
	background-position: left bottom;
	background-repeat: repeat-x;
}

#widgets_right .collapsable_box_header {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/widgetheaderbg.jpg);
	background-position: left top;
	background-repeat: no-repeat;	
	border-bottom: none;
	padding: 0 10px;
	color: #fff;
	height: 25px;
}

.collapsable_box_header h1 {
	font-size: 1em;
	line-height: 25px;
	font-weight: bold;
	text-transform: uppercase;
}

.collapsable_box_content {
	padding: 7px 9px;
	margin: 0;
	height: auto;
	/* background-color: #ddd; */
}

.collapsable_box_content .contentWrapper {
	margin: 0 0 5px 0;
	padding: 0;
	border: 0;
}

.collapsable_box_editpanel {
	display: none;
	background: #dedede;
	padding: 10px 10px 5px;
}

.collapsable_box_editpanel p {
	margin: 0 0 5px 0;
}

.collapsable_box_header a.toggle_box_contents {
	cursor: pointer;
	float: right;
	margin: 2px -2px 0 0;
	padding: 2px 0 2px 2px;
	width: 15px;
	height: 15px;
}

.collapsable_box_header a.toggle_box_edit_panel {
	float: right;
	margin: 2px 0 0;
	padding: 2px;
	width: 15px;
	height: 15px;
}

.collapsable_box_editpanel label {
	font-weight: normal;
	font-size: 100%;
}

/* used for collapsing a content box */
.display_none {
	display:none;
}

/* used on spotlight box - to cancel default box margin */
.no_space_after {
	margin: 0 0 0 0;
}


/* ***************************************
	GENERAL FORM ELEMENTS
*************************************** */
label {
	color: #333;
}

input {
	
}

textarea {
	border: solid 1px #cccccc;
	padding: 5px;
	color: #666;
}

textarea:focus, input[type="text"]:focus, input[type="password"]:focus {
	background: #e4ecf5;
	color: #333;
}

input[type="submit"], input[type="button"] {
	height: 27px;
	margin: 10px 0;
	cursor: pointer;
}

input[value="Save"] {
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -182px -1px;
	background-repeat: no-repeat;
	border: 0;
	width: 48px;
	padding: 0;
	text-indent: -999em;
	font-size: 0px;
	line-height: 0px;
}

input[value="Save"]:hover {
	background-position: -182px -28px;
}

.submit_button {
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -55px -1px;
	background-repeat: no-repeat;
	width: 62px;
	margin: 10px 0 10px 0;
	cursor: pointer;
	text-indent: -999em;
	border: 0;
	font-size: 0px;
	line-height: 0px;
}

.submit_button:hover {
	background-position: -55px -28px;
}

.cancel_button {
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -230px -1px;
	background-repeat: no-repeat;
	width: 62px;
	margin: 10px 0 10px 10px;
	cursor: pointer;
	text-indent: -999em;
	border: 0;
	font-size: 0px;
	line-height: 0px;
}

.cancel_button:hover {
	background-position: -230px -28px;
}

.input-text,
.input-tags,
.input-url,
.input-textarea {
	width:98%;
}

.input-textarea {
	height: 200px;
}


/* ***************************************
	PROFILE
*************************************** */
#profile_wrapper_left {
	float: left;
	width: 661px;
}

/* #profile_wrapper_right {
	float: left;
	margin-left: 15px;
} */

#profile_info {
	margin: 0 0 20px;
	padding: 0;
	float: left;
}

#profile_info_column_left {
	float: left;
	padding: 0;
	margin: 0 20px 0 0;
	width: 198px;
}

#profile_info_column_middle {
	float: left;
	width: 432px;
	padding: 0;
}

#profile_info_column_right {
	width: 109px;
	margin: 0;
	background: #dedede;
	padding: 4px;
}

#dashboard_info {
	margin: 0;
	padding: 20px;
	background: #bbdaf7;
}

#profile_menu_wrapper {
	margin: 10px 0;
	width: 200px;
}

#profile_menu_wrapper p {
	border-bottom: 1px solid #ccc;
}

#profile_menu_wrapper p:first-child {
	border-top: 1px solid #ccc;
}

#profile_menu_wrapper a {
	display: block;
	padding: 0 0 0 3px;
}

#profile_menu_wrapper a:hover {
	color: #fff;
	background: #4690d6;
	text-decoration: none;
}

p.user_menu_friends,
p.user_menu_profile, 
p.user_menu_removefriend, 
p.user_menu_friends_of {
	margin: 0;
}

#profile_menu_wrapper .user_menu_admin {
	border-top: none;
}

#profile_info_column_middle p {
	margin: 1px 0;
	padding: 0 4px;
}

#profile_info_column_middle p.profile_aboutme_title {
	color: #000;
	padding: 0 0 5px 12px;
	margin: 0;
	height: 21px;
	line-height: 21px;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/header_rule.png);
	background-position: left top;
	background-repeat: repeat-x;	
}

#profile_info_column_middle p.profile_aboutme_title + p {
	margin-bottom: 15px;
}

/* profile owner name */
#profile_info_column_middle h2 {
	padding: 0 0 14px 0;
	margin: 0;
}

#profile_info_column_middle .profile_status {
	background: #fffb9c;
	padding: 4px 6px;
	margin-bottom: 15px;
	line-height: 1.2em;
	border: 1px solid #f4ec53;
	/* border-top: 1px solid #aaa;
	border-right: 1px solid #888;
	border-bottom: 1px solid #888; */
}

/* summary subtitle in profile */
#profile_info_column_middle .profile_status + p.odd, 
#profile_info_column_middle h2 + p.odd {
	padding: 0;
	padding-left: 10px;
	margin: 0 0 5px;
	height: 21px;
	line-height: 21px;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/header_rule.png);
	background-position: left top;
	background-repeat: repeat-x;
	width: 422px;
}

/* summary subtitle in profile, whether or not the person has made a status update
#profile_info_column_middle .profile_status + p.odd strong,
#profile_info_column_middle h2 + p.odd strong {
} */

#profile_info_column_middle .profile_status + p.odd + p,
#profile_info_column_middle h2 + p.odd + p {
	padding-left: 10px;
}

#profile_info_column_middle .profile_status span {
	display: block;
	font-size: 90%;
	color: #666;
}

#profile_info_column_middle a.status_update {
	text-decoration: underline;
	float: right;
}

#profile_info_column_middle .odd {
	float: left;
	clear: right;
	width: 45%;
}

#profile_info_column_middle .even {
	float: left;
	width: 45%;
	padding-left: 10px;
}

#profile_info_column_right p {
	margin: 0 0 7px 0;
}

#profile_info_column_right .profile_aboutme_title {
	margin: 0;
	padding: 0;
	line-height: 1em;
}

/* edit profile button */
.profile_info_edit_buttons {
	float: right;
	margin: 0 !important;
	padding: 0 !important;
}

.profile_info_edit_buttons a {
	font-weight: bold;
	color: #fff;
	margin: 0;
	width: 108px;
	height: 27px;
	cursor: pointer;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -9px -88px;
	background-repeat: no-repeat;
	text-indent: -999em;
	display: block;
	font-size: 0px;
	line-height: 0px;
}

.profile_info_edit_buttons a:hover {
	text-decoration: none;
	background-position: -9px -117px;
}

#summary_parent {
	float: left;
}



/* ***************************************
	RIVER
*************************************** */
#river,
.river_item_list {
	border-top: 1px solid #ddd;
}
.river_item p {
	margin: 0;
	padding: 0 0 0 21px;
	line-height: 1.1em;
	min-height: 17px;
}
.river_item {
	border-bottom: 1px solid #ddd;
	padding: 10px 0;
}
.river_item_time {
	font-size: 90%;
	color: #666;
}
/* IE6 fix */
* html .river_item p { 
	padding:3px 0 3px 20px;
}
/* IE7 */
*:first-child+html .river_item p {
	min-height:17px;
}
.river_user_update {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_profile.gif) no-repeat left -1px;
}
.river_object_user_profileupdate {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_profile.gif) no-repeat left -1px;
}
.river_object_user_profileiconupdate {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_profile.gif) no-repeat left -1px;
}
.river_object_annotate {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_bookmarks_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_bookmarks.gif) no-repeat left -1px;
}
.river_object_bookmarks_comment {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_status_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_status.gif) no-repeat left -1px;
}
.river_object_file_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_files.gif) no-repeat left -1px;
}
.river_object_file_update {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_files.gif) no-repeat left -1px;
}
.river_object_file_comment {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_widget_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_plugin.gif) no-repeat left -1px;
}
.river_object_forums_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_forums_update {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_widget_update {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_plugin.gif) no-repeat left -1px;	
}
.river_object_blog_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_blog.gif) no-repeat left -1px;
}
.river_object_blog_update {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_blog.gif) no-repeat left -1px;
}
.river_object_blog_comment {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_forumtopic_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_user_friend {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_friends.gif) no-repeat left -1px;
}
.river_object_relationship_friend_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_friends.gif) no-repeat left -1px;
}
.river_object_relationship_member_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_thewire_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_thewire.gif) no-repeat left -1px;
}
.river_group_join {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_groupforumtopic_annotate {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_groupforumtopic_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_sitemessage_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_blog.gif) no-repeat left -1px;	
}
.river_user_messageboard {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;	
}
.river_object_page_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_pages.gif) no-repeat left -1px;
}
.river_object_page_top_create {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_pages.gif) no-repeat left -1px;
}
.river_object_page_top_comment {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_page_comment {
	background: url(<?php echo $vars['url']; ?>_graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}

/* ***************************************
	SEARCH LISTINGS	
*************************************** */
.search_listing {
	display: block;
	background:white;
	margin:0 10px 5px 10px;
	padding:5px;
}
.search_listing_icon {
	float:left;
}
.search_listing_icon img {
	width: 40px;
}
.search_listing_icon .avatar_menu_button img {
	width: 15px;
}
.search_listing_info {
	margin-left: 50px;
	min-height: 40px;
}
/* IE 6 fix */
* html .search_listing_info {
	height:40px;
}
.search_listing_info p {
	margin:0 0 3px 0;
	line-height:1.2em;
}
.search_listing_info p.owner_timestamp {
	margin:0;
	padding:0;
	color:#666666;
	font-size: 90%;
}
table.search_gallery {
	border-spacing: 10px;
	margin:0 0 0 0;
}
.search_gallery td {
	padding: 5px;
}
.search_gallery_item {
	background: white;
	width:170px;
}
.search_gallery_item:hover {
	background: black;
	color:white;
}
.search_gallery_item .search_listing {
	background: none;
	text-align: center;
}
.search_gallery_item .search_listing_header {
	text-align: center;
}
.search_gallery_item .search_listing_icon {
	position: relative;
	text-align: center;
}
.search_gallery_item .search_listing_info {
	margin: 5px;
}
.search_gallery_item .search_listing_info p {
	margin: 5px;
	margin-bottom: 10px;
}
.search_gallery_item .search_listing {
	background: none;
	text-align: center;
}
.search_gallery_item .search_listing_icon {
	position: absolute;
	margin-bottom: 20px;
}
.search_gallery_item .search_listing_info {
	margin: 5px;
}
.search_gallery_item .search_listing_info p {
	margin: 5px;
	margin-bottom: 10px;
}


/* ***************************************
	FRIENDS
*************************************** */
/* friends widget */
#widget_friends_list {
	display: table;
	margin: 0;
	padding: 0;
}

.widget_friends_singlefriend {
	float: left;
	margin: 0 2px 5px;
	text-align: center;
	font-size: 10px;
}

.widget_friends_singlefriend div.usericon a.icon img {
	width: 70px;
}


/* ***************************************
	ADMIN AREA - PLUGIN SETTINGS
*************************************** */
.plugin_details {
	margin:0 10px 5px 10px;
	padding:0 7px 4px 10px;
}
.admin_plugin_reorder {
	float:right;
	width:200px;
	text-align: right;
}
.admin_plugin_reorder a {
	padding-left:10px;
	font-size:80%;
	color:#999999;
}
.plugin_details a.pluginsettings_link {
	cursor:pointer;
	font-size:80%;
}
.active {
	border:1px solid #999999;
    background:white;
}
.not-active {
    border:1px solid #999999;
    background:#dedede;
}
.plugin_details p {
	margin:0;
	padding:0;
}
.plugin_details a.manifest_details {
	cursor:pointer;
	font-size:80%;
}
.manifest_file {
	background:#dedede;
	padding:5px 10px 5px 10px;
	margin:4px 0 4px 0;
	display:none;
}
.admin_plugin_enable_disable {
	width:150px;
	margin:10px 0 0 0;
	float:right;
	text-align: right;
}
.contentIntro .enableallplugins,
.contentIntro .disableallplugins {
	float:right;
}
.contentIntro .enableallplugins {
	margin-left:10px;
}
.contentIntro .enableallplugins, 
.not-active .admin_plugin_enable_disable a {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:#4690d6;
	border: 1px solid #4690d6;
	width: auto;
	padding: 4px;
	cursor: pointer;
}
.contentIntro .enableallplugins:hover, 
.not-active .admin_plugin_enable_disable a:hover {
	background: #0054a7;
	border: 1px solid #0054a7;
	text-decoration: none;
}
.contentIntro .disableallplugins, 
.active .admin_plugin_enable_disable a {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:#999999;
	border: 1px solid #999999;
	width: auto;
	padding: 4px;
	cursor: pointer;
}
.contentIntro .disableallplugins:hover, 
.active .admin_plugin_enable_disable a:hover {
	background: #333333;
	border: 1px solid #333333;
	text-decoration: none;
}
.pluginsettings {
	margin:15px 0 5px 0;
	background:#bbdaf7;
	padding:10px;
	display:none;
}
.pluginsettings h3 {
	padding:0 0 5px 0;
	margin:0 0 5px 0;
	border-bottom:1px solid #999999;
}
#updateclient_settings h3 {
	padding:0;
	margin:0;
	border:none;
}
.input-access {
	margin:5px 0 0 0;
}

/* ***************************************
	GENERIC COMMENTS
*************************************** */
.generic_comment_owner {
	font-size: 90%;
	color:#666666;
}
.generic_comment {
	background:white;
    padding:10px;
    margin:0 10px 10px 10px;
}
.generic_comment_icon {
	float:left;
}
.generic_comment_details {
	margin-left: 60px;
}
.generic_comment_details p {
	margin: 0 0 5px 0;
}
.generic_comment_owner {
	color:#666666;
	margin: 0px;
	font-size:90%;
	border-top: 1px solid #aaaaaa;
}
/* IE6 */
* html #generic_comment_tbl { width:676px !important;}

	
/* ***************************************
  PAGE-OWNER BLOCK
*************************************** */
#owner_block {
	padding: 0;
}

#owner_block_icon {
	float: left;
	margin: 4px 10px 0 9px;
}

#owner_block_rss_feed,
#owner_block_odd_feed,
#owner_block_bookmark_this,
#owner_block_report_this {
	padding: 0;
	margin: 10px;
}

#owner_block_bookmark_this {
    margin: 10px;
}

#owner_block_report_this {
	padding-bottom:5px;
	border-bottom:1px solid #cccccc;
	padding: 0;
	margin: 10px;
	border: 0;
}
#owner_block_rss_feed a {
	font-size: 90%;
	color:#999999;
	padding:0 0 4px 20px;
	background: url(<?php echo $vars['url']; ?>_graphics/icon_rss.gif) no-repeat left top;
}
#owner_block_odd_feed a {
	font-size: 90%;
	color:#999999;
	padding:0 0 4px 20px;
	background: url(<?php echo $vars['url']; ?>_graphics/icon_odd.gif) no-repeat left top;
}
#owner_block_bookmark_this a {
	font-size: 90%;
	color:#999999;
	padding:0 0 4px 20px;
	background: url(<?php echo $vars['url']; ?>_graphics/icon_bookmarkthis.gif) no-repeat left top;
}
#owner_block_report_this a {
	font-size: 90%;
	color:#999999;
	padding:0 0 4px 20px;
	background: url(<?php echo $vars['url']; ?>_graphics/icon_reportthis.gif) no-repeat left top;
}
#owner_block_rss_feed a:hover,
#owner_block_odd_feed a:hover,
#owner_block_bookmark_this a:hover,
#owner_block_report_this a:hover {
	color: #0054a7;
}
#owner_block_desc {
	padding:4px 0 4px 0;
	margin:0 0 0 0;
	line-height: 1.2em;
	border-bottom:1px solid #cccccc;
	color:#666666;
}

/* controls inbox username in left column heading. maybe other stuff? -eric 5-28-09 */
#owner_block_content {
	margin: 0 0 4px 0;
	padding: 0;
	height: 37px;
	font-weight: bold;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/inboxusernamebg.png);
	background-position: top left;
	background-repeat: repeat-x;
}

#owner_block_content a {
	line-height: 37px;
	color: #fff;
}

#owner_block_content a:hover {
	color: #E05B00;
}

.ownerblockline {
	padding:0;
	margin:0;
	border-bottom:1px solid #cccccc;
	height:1px;
	border: 0;
	display: none;
}
#owner_block_submenu {
	margin:20px 0 20px 0;
	padding: 0;
	width:100%;
	margin-top: 0;
}
#owner_block_submenu ul {
	list-style: none;
	padding: 0;
	margin: 0;
}

#owner_block_submenu ul li.selected a {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/inboxmenuselected.png);
	background-position: top left;
	background-repeat: repeat-y;
	border-top: 1px solid #fff;
	border-bottom: 1px solid #fff;
	color: #003558;
	width: 190px;
	margin-right: -20px;
}

#owner_block_submenu ul li.selected a:hover {
	color: #E05B00;
}

#owner_block_submenu ul li a {
	text-decoration: none;
	display: block;
	margin: 2px 0 0 0;
	color: #003558;
	padding:4px 6px 4px 10px;
	font-weight: bold;
	line-height: 19px;
}

#owner_block_submenu ul li a:hover {
	color: #E05B00;
}

/* IE 6 + 7 menu arrow position fix */
* html #owner_block_submenu ul li.selected a {
	background-position: left 10px;
}
*:first-child+html #owner_block_submenu ul li.selected a {
	background-position: left 8px;
}

#owner_block_submenu .submenu_group {
	border-bottom: 1px solid #cccccc;
	margin:10px 0 0 0;
	padding-bottom: 10px;
	margin: 0;
	padding: 0;
	border: 0;
}

#owner_block_submenu .submenu_group .submenu_group_filter ul li a,
#owner_block_submenu .submenu_group .submenu_group_filetypes ul li a {
	color:#666666;
}
#owner_block_submenu .submenu_group .submenu_group_filter ul li.selected a,
#owner_block_submenu .submenu_group .submenu_group_filetypes ul li.selected a {
	background:#999999;
	color:white;
}
#owner_block_submenu .submenu_group .submenu_group_filter ul li a:hover,
#owner_block_submenu .submenu_group .submenu_group_filetypes ul li a:hover {
	color:white;
	background: #999999;
}


/* ***************************************
	PAGINATION
*************************************** */
.pagination {
	background:white;
	margin:5px 10px 5px 10px;
	padding:5px;
}
.pagination .pagination_number {
	display:block;
	float:left;
	background:#ffffff;
	border:1px solid #4690d6;
	text-align: center;
	color:#4690d6;
	font-size: 12px;
	font-weight: normal;
	margin:0 6px 0 0;
	padding:0px 4px;
	cursor: pointer;
}
.pagination .pagination_number:hover {
	background:#4690d6;
	color:white;
	text-decoration: none;
}
.pagination .pagination_more {
	display:block;
	float:left;
	background:#ffffff;
	border:1px solid #ffffff;
	text-align: center;
	color:#4690d6;
	font-size: 12px;
	font-weight: normal;
	margin:0 6px 0 0;
	padding:0px 4px;
}
.pagination .pagination_previous,
.pagination .pagination_next {
	display:block;
	float:left;
	border:1px solid #4690d6;
	color:#4690d6;
	text-align: center;
	font-size: 12px;
	font-weight: normal;
	margin:0 6px 0 0;
	padding:0px 4px;
	cursor: pointer;
}
.pagination .pagination_previous:hover,
.pagination .pagination_next:hover {
	background:#4690d6;
	color:white;
	text-decoration: none;
}
.pagination .pagination_currentpage {
	display:block;
	float:left;
	background:#4690d6;
	border:1px solid #4690d6;
	text-align: center;
	color:white;
	font-size: 12px;
	font-weight: bold;
	margin:0 6px 0 0;
	padding:0px 4px;
	cursor: pointer;
}

	
/* ***************************************
	FRIENDS COLLECTIONS ACCORDIAN
*************************************** */	
ul#friends_collections_accordian {
	margin: 0 0 0 0;
	padding: 0;
}
#friends_collections_accordian li {
	margin: 0 0 0 0;
	padding: 0;
	list-style-type: none;
	color: #666666;
}
#friends_collections_accordian li h2 {
	background:#4690d6;
	color: white;
	padding:4px 2px 4px 6px;
	margin:10px 0 10px 0;
	font-size:1.2em;
	cursor:pointer;
}
#friends_collections_accordian li h2:hover {
	background:#333333;
	color:white;
}
#friends_collections_accordian .friends_picker {
	background:white;
	padding:0;
	display:none;
}
#friends_collections_accordian .friends_collections_controls {
	font-size:70%;
	float:right;
}
#friends_collections_accordian .friends_collections_controls a {
	color:#999999;
	font-weight:normal;
}
	
	
/* ***************************************
	FRIENDS PICKER SLIDER
*************************************** */		
.friendsPicker_container h3 {
	font-size:4em !important;
	text-align: left;
	margin:0 0 10px 0 !important;
	color:#999999 !important;
	background: none !important;
	padding:0 !important;
}

.friendsPicker .friendsPicker_container .panel ul {
	text-align: left;
	margin: 0;
	padding:0;
}

.friendsPicker_wrapper {
	margin: 0;
	padding:0;
	position: relative;
	width: 100%;
}

.friendsPicker {
	position: relative;
	overflow: hidden; 
	margin: 0;
	padding: 0;
	width: 659px;
	height: auto;
	background: #dedede;
}

.friendspicker_savebuttons {
	background: white;
	margin:0 10px 10px 10px;
}

.friendsPicker .friendsPicker_container { /* long container used to house end-to-end panels. Width is calculated in JS  */
	position: relative;
	left: 0;
	top: 0;
	width: 100%;
	list-style-type: none;
}

.friendsPicker .friendsPicker_container .panel {
	float:left;
	height: 100%;
	position: relative;
	width: 659px;
	margin: 0;
	padding: 0;
}

.friendsPicker .friendsPicker_container .panel .wrapper {
	margin: 0;
	padding: 4px 10px 10px;
	min-height: 230px;
}

.friendsPickerNavigation {
	margin: 0 0 10px 0;
	padding:0;
}

.friendsPickerNavigation ul {
	list-style: none;
	padding-left: 0;
}

.friendsPickerNavigation ul li {
	float: left;
	margin:0;
	background:white;
}

.friendsPickerNavigation a {
	font-weight: bold;
	text-align: center;
	background: white;
	color: #999999;
	text-decoration: none;
	display: block;
	padding: 0;
	width:20px;
}

.tabHasContent {
	background: white; color:#333333 !important;
}

.friendsPickerNavigation li a:hover {
	background: #333333;
	color:white !important;
}

.friendsPickerNavigation li a.current {
	background: #4690D6;
	color: white !important;
}

.friendsPickerNavigationAll {
	margin:0px 0 0 20px;
	float:left;
}

.friendsPickerNavigationAll a {
	font-weight: bold;
	text-align: left;
	font-size:0.8em;
	background: white;
	color: #999999;
	text-decoration: none;
	display: block;
	padding: 0 4px 0 4px;
	width:auto;
}

.friendsPickerNavigationAll a:hover {
	background: #4690D6;
	color:white;
}

.friendsPickerNavigationL, .friendsPickerNavigationR {
	position: absolute;
	top: 46px;
	text-indent: -9000em;
}

.friendsPickerNavigationL a, .friendsPickerNavigationR a {
	display: block;
	height: 43px;
	width: 43px;
}

.friendsPickerNavigationL {
	right: 48px;
	z-index:1;
}

.friendsPickerNavigationR {
	right: 0;
	z-index:1;
}

.friendsPickerNavigationL {
	background: url("<?php echo $vars['url']; ?>_graphics/friends_picker_arrows.gif") no-repeat left top;
}

.friendsPickerNavigationR {
	background: url("<?php echo $vars['url']; ?>_graphics/friends_picker_arrows.gif") no-repeat -60px top;
}

.friendsPickerNavigationL:hover {
	background: url("<?php echo $vars['url']; ?>_graphics/friends_picker_arrows.gif") no-repeat left -44px;
}

.friendsPickerNavigationR:hover {
	background: url("<?php echo $vars['url']; ?>_graphics/friends_picker_arrows.gif") no-repeat -60px -44px;
}	

.friends_collections_controls a.delete_collection {
	display:block;
	cursor: pointer;
	width:14px;
	height:14px;
	margin:2px 3px 0 0;
	background: url("<?php echo $vars['url']; ?>_graphics/icon_customise_remove.png") no-repeat 0 0;
}

.friends_collections_controls a.delete_collection:hover {
	background-position: 0 -16px;
}

.friendspicker_savebuttons .submit_button,
.friendspicker_savebuttons .cancel_button {
	margin:5px 20px 5px 5px;
}

#collectionMembersTable {
	background: #dedede;
	margin:10px 0 0 0;
	padding:10px 10px 0 10px;
}

	
/* ***************************************
  WIDGET PICKER (PROFILE & DASHBOARD)
*************************************** */
/* 'edit page' button */
a.toggle_customise_edit_panel {
	display: block;
	clear: both;
	margin: 0 0 9px 142px;
	text-align: left;
	text-indent: -999em;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -122px -88px;
	background-repeat: no-repeat;
	width: 98px;
	height: 27px;
	font-size: 0px;
	line-height: 0px;
}

a.toggle_customise_edit_panel:hover {
	text-decoration: none;
	background-position: -122px -117px;
}

#customise_editpanel {
	display:none;
	margin: 0 0 20px 0;
	padding:10px;
	background: #dedede;
}

/* Top area - instructions */
.customise_editpanel_instructions {
	width:690px;
	padding:0 0 10px 0;
}
.customise_editpanel_instructions h2 {
	padding:0 0 10px 0;
}
.customise_editpanel_instructions p {
	margin:0 0 5px 0;
	line-height: 1.4em;
}

/* RHS (widget gallery area) */
#customise_editpanel_rhs {
	float: right;
	width: 200px;
	background: #fff;
}

#customise_editpanel #customise_editpanel_rhs h2 {
	color: #333;
	font-size: 1.4em;
	margin: 0;
	padding: 6px;
}

#widget_picker_gallery {
	border-top: 1px solid #cccccc;
	background: #fff;
	width: 180px; 
	height: 340px;
	padding: 10px 10px 20px;
	overflow: auto;
	overflow-x: hidden;
	text-align: center;
}

/* main page widget area */
#customise_page_view {
	width: 650px;
	padding: 10px;
	margin: 0 0 10px 0;
	background: #fff;
}

#customise_page_view h2 {
	border: 1px solid #ccc;
	border-bottom: none;
	margin: 0;
	padding: 5px;
	width: 197px;
	color: #000;
	background: #dedede;
	font-size: 1.25em;
	line-height: 1.2em;
}

#profile_box_widgets {
	width: 416px;
	margin: 0 10px 10px 0;
	padding: 5px 5px 0px;
	min-height: 50px;
	border: 1px solid #ccc;
	background: #dedede;
}

#customise_page_view h2.profile_box {
	width: 416px;
	color: #000;
}

#profile_box_widgets p {
	color: #999;
}

#leftcolumn_widgets {
	width: 197px;
	margin: 0 10px 0 0;
	padding: 5px 5px 40px;
	min-height: 190px;
	border: 1px solid #ccc;
}

#middlecolumn_widgets {
	width: 197px;
	margin: 0 10px 0 0;
	padding: 5px 5px 40px;
	min-height: 190px;
	border: 1px solid #ccc;
}

#rightcolumn_widgets {
	width: 197px;
	margin: 0;
	padding: 5px 5px 40px;
	min-height: 190px;
	border: 1px solid #ccc;
}

#rightcolumn_widgets.long {
	min-height: 288px;
}

/* IE6 fix */
* html #leftcolumn_widgets { 
	height: 135px;
}

* html #middlecolumn_widgets { 
	height: 135px;
}

* html #rightcolumn_widgets { 
	height: 135px;
}

* html #rightcolumn_widgets.long { 
	height: 338px;
}

#customise_editpanel table.draggable_widget {
	width: 120px;
	background: #ccc;
	margin: 10px auto 0;
	vertical-align: text-top;
	border: 1px solid #ccc;
}

#widget_picker_gallery table.draggable_widget {
	width: 120px;
	background: #ccc;
	margin: 10px auto 0;
	vertical-align: text-top;
	border: 1px solid #ccc;
}

/* take care of long widget names */
#customise_editpanel table.draggable_widget h3 {
	word-wrap: break-word; /* safari, webkit, ie */
	width: 130px;
	line-height: 1.1em;
	overflow: hidden; /* ff */
	padding: 4px;
}
#widget_picker_gallery table.draggable_widget h3 {
	word-wrap: break-word;
	width: 130px;
	line-height: 1.1em;
	overflow: hidden;
	padding: 4px;
}
#customise_editpanel img.more_info {
	background: url(<?php echo $vars['url']; ?>_graphics/icon_customise_info.gif) no-repeat top left;
	cursor:pointer;
}
#customise_editpanel img.drag_handle {
	background: url(<?php echo $vars['url']; ?>_graphics/icon_customise_drag.gif) no-repeat top left;
	cursor:move;
}
#customise_editpanel img {
	margin-top:4px;
}
#widget_moreinfo {
	position:absolute;
	border:1px solid #333333;
	background:#e4ecf5;
	color:#333333;
	padding:5px;
	display:none;
	width: 200px;
	line-height: 1.2em;
}
/* droppable area hover class  */
.droppable-hover {
	background:#bbdaf7;
}
/* target drop area class */
.placeholder {
	border:2px dashed #AAA;
	width:196px !important;
	margin: 10px 0 10px 0;
}
/* class of widget while dragging */
.ui-sortable-helper {
	background: #4690d6;
	color:white;
	padding: 4px;
	margin: 10px 0 0 0;
	width:200px;
}
/* IE6 fix */
* html .placeholder { 
	margin: 0;
}
/* IE7 */
*:first-child+html .placeholder {
	margin: 0;
}
/* IE6 fix */
* html .ui-sortable-helper h3 { 
	padding: 4px;
}
* html .ui-sortable-helper img.drag_handle, * html .ui-sortable-helper img.remove_me, * html .ui-sortable-helper img.more_info {
	padding-top: 4px;
}
/* IE7 */
*:first-child+html .ui-sortable-helper h3 {
	padding: 4px;
}
*:first-child+html .ui-sortable-helper img.drag_handle, *:first-child+html .ui-sortable-helper img.remove_me, *:first-child+html .ui-sortable-helper img.more_info {
	padding-top: 4px;
}


/* ***************************************
	BREADCRUMBS
*************************************** */
#pages_breadcrumbs {
	font-size: 87%;
	color: #bdbdbd;
	padding: 0;
	margin: 2px 0 0 10px;
}

#pages_breadcrumbs a {
	color:#999999;
	text-decoration: none;
}

#pages_breadcrumbs a:hover {
	color: #0054a7;
	text-decoration: underline;
}


/* ***************************************
	MISC.
*************************************** */
/* general page titles in main content area */
#content_area_user_title h2 {
	font-size: 1.35em;
	line-height: 1.2em;
	margin: 17px 20px 12px;
	padding: 0;
	color: #00395e;
}

/* reusable generic collapsible box */
.collapsible_box {
	background:#dedede;
	padding:5px 10px 5px 10px;
	margin:4px 0 4px 0;
	display:none;
}	
a.collapsibleboxlink {
	cursor:pointer;
}

/* tag icon */	
.object_tag_string {
	background: url(<?php echo $vars['url']; ?>_graphics/icon_tag.gif) no-repeat left 2px;
	padding:0 0 0 14px;
	margin:0;
}	

/* profile picture upload n crop page */	
#profile_picture_form {
	height:145px;
}	
#current_user_avatar {
	float:left;
	width:160px;
	height:130px;
	border-right:1px solid #cccccc;
	margin:0 20px 0 0;
}	
#profile_picture_croppingtool {
	border-top: 1px solid #cccccc;
	margin:20px 0 0 0;
	padding:10px 0 0 0;
}	
#profile_picture_croppingtool #user_avatar {
	float: left;
	margin-right: 20px;
}	
#profile_picture_croppingtool #applycropping {

}
#profile_picture_croppingtool #user_avatar_preview {
	float: left;
	position: relative;
	overflow: hidden;
	width: 100px;
	height: 100px;
}	


/* ***************************************
	SETTINGS & ADMIN
*************************************** */
.admin_statistics,
.admin_users_online,
.usersettings_statistics,
.admin_adduser_link,
#add-box,
#search-box,
#logbrowser_search_area {
	background:white;
	margin:0 10px 10px 10px;
	padding:10px;
}

.usersettings_statistics h3,
.admin_statistics h3,
.admin_users_online h3,
.user_settings h3,
.notification_methods h3 {
	background:#e4e4e4;
	color:#333333;
	font-size:1.1em;
	line-height:1em;
	margin:0 0 10px 0;
	padding:5px;
}
h3.settings {
	background:#e4e4e4;
	color:#333333;
	font-size:1.1em;
	line-height:1em;
	margin:10px 0 4px 0;
	padding:5px;
}
.admin_users_online .profile_status {
	background:#bbdaf7;
	line-height:1.2em;
	padding:2px 4px;
}
.admin_users_online .profile_status span {
	font-size:90%;
	color:#666666;
}
.admin_users_online  p.owner_timestamp {
	padding-left:3px;
}


.admin_debug label,
.admin_usage label {
	color:#333333;
	font-size:100%;
	font-weight:normal;
}

.admin_usage {
	border-bottom:1px solid #cccccc;
	padding:0 0 20px 0;
}
.usersettings_statistics .odd,
.admin_statistics .odd {

}
.usersettings_statistics .even,
.admin_statistics .even {

}
.usersettings_statistics td,
.admin_statistics td {
	padding:2px 4px 2px 4px;
	border-bottom:1px solid #cccccc;
}
.usersettings_statistics td.column_one,
.admin_statistics td.column_one {
	width:200px;
}
.usersettings_statistics table,
.admin_statistics table {
	width:100%;
}
.usersettings_statistics table,
.admin_statistics table {
	border-top:1px solid #cccccc;
}
.usersettings_statistics table tr:hover,
.admin_statistics table tr:hover {
	background: #E4E4E4;
}
.admin_users_online .search_listing {
	margin:0 0 5px 0;
	padding:5px;
	border:2px solid #cccccc;
}



/* force tinyMCE editor initial width for safari */
.mceLayout {
	width:683px;
}
p.longtext_editarea {
	margin:0 !important;
}
.toggle_editor_container {
	margin:0 0 15px 0;
}
/* add/remove longtext tinyMCE editor */
a.toggle_editor {
	display:block;
	float:right;
	text-align:right;
	color:#666666;
	font-size:1em;
	font-weight:normal;
}

div.ajax_loader {
	background: white url(<?php echo $vars['url']; ?>_graphics/ajax_loader.gif) no-repeat center 30px;
	width:auto;
	height:100px;
	margin:0 10px 0 10px;
}

/* reusable elgg horizontal tabbed navigation 
   (used on friends collections, external pages, & riverdashboard mods)
*/
#elgg_horizontal_tabbed_nav {
	margin:0 0 5px 0;
	padding: 0;
	border-bottom: 1px solid #484848;
	display:table;
	width:100%;
}

#elgg_horizontal_tabbed_nav ul {
	list-style: none;
	padding: 0;
	margin: 0;
}

#elgg_horizontal_tabbed_nav li {
	float: left;
	margin: 0 0 0 5px;
	background-image:  url(<?php echo $vars['url']; ?>_graphics/jr/tab_lightblue.png);
	background-position: top left;
	background-repeat: repeat-x;
}

#elgg_horizontal_tabbed_nav li:hover, #elgg_horizontal_tabbed_nav .selected {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/tab_gray.png);
	background-position: top left;
	background-repeat: repeat-x;
}

#elgg_horizontal_tabbed_nav a {
	text-decoration: none;
	display: block;
	padding: 7px 13px 0;
	color: #666;
	text-align: center;
	height: 22px;
	background-image:  url(<?php echo $vars['url']; ?>_graphics/jr/powerscore_corner_top_right.gif);
	background-position: top right;
	background-repeat: no-repeat;
}

#elgg_horizontal_tabbed_nav .selected a, #elgg_horizontal_tabbed_nav a:hover{
	color: #fff;
}

/*
#elgg_horizontal_tabbed_nav .selected {
	border-color: #cccccc;
	background: white;
}
*/

/****************** end tabbed nav ********************/

/* ***************************************
	ADMIN AREA - REPORTED CONTENT
*************************************** */
.reportedcontent_content {
	margin:0 0 5px 0;
	padding:0 7px 4px 10px;
}
.reportedcontent_content p.reportedcontent_detail,
.reportedcontent_content p {
	margin:0;
}
.active_report {
	border:1px solid #D3322A;
    background:#F7DAD8;
}
.archived_report {
	border:1px solid #666666;
    background:#dedede;
}
a.archive_report_button {
	float:right;
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:#4690d6;
	border: 1px solid #4690d6;
	width: auto;
	padding: 4px;
	margin:15px 0 0 20px;
	cursor: pointer;
}
a.archive_report_button:hover {
	background: #0054a7;
	border: 1px solid #0054a7;
	text-decoration: none;
}
a.delete_report_button {
	float:right;
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:#999999;
	border: 1px solid #999999;
	width: auto;
	padding: 4px;
	margin:15px 0 0 20px;
	cursor: pointer;
}
a.delete_report_button:hover {
	background: #333333;
	border: 1px solid #333333;
	text-decoration:none;
}
.reportedcontent_content .collapsible_box {
	background: white;
}


/***************************************************
**			POWER SCORE - JOCK RATING
***************************************************/
#powerScore {
    margin: 10px 0 30px;
    padding: 0;
    background: #cbd3e8;
    width: 100%;
}

#powerScore h2 {
    margin: 0;
    padding: 7px 10px;
    height: 14px;
    background: #fff;
    background-image: url(<?php echo $vars['url']; ?>_graphics/jr/powerscore_bar.png);
    background-repeat: repeat-x;
    background-position: top left;
}

#powerScore img {
	vertical-align: top;
}

#powerScore form {
    display: block;
}

#psContent {
    padding: 7px;
    line-height: 20px;
    text-align: center;
    background-image: url(<?php echo $vars['url']; ?>_graphics/jr/overallRatingbg.jpg);
    background-repeat: repeat-x;
    background-position: top left;
}

#psScoreSpan {
    font-size: 20px;
    font-weight: bold;
    margin-right: 7px;
    vertical-align: middle;
}

#psContent img {
    vertical-align: middle;
}

#psVotesSpan {
    font-size: 12px;
    font-weight: normal;
    margin-left: 7px;
    vertical-align: middle;
}

#psVotesSpan a {
	color: #d66900;
	cursor: pointer;
}

#psVotesSpan a:hover {
	text-decoration: underline;
}

#powerScoreCorner {
	position: relative;
	top: -7px;
	left: -10px;
}

#powerScoreTitle {
	margin-left: -5px;
}

#powerScoreQuestionMark {
	margin-left: 7px;
}

#powerScore #rateAthleteHeader {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/rateAthlete_bar.png);
	background-position: 0 0;
	background-repeat: repeat-x;
	width: 100%;
	font-weight: bold;
	height: 26px;
	line-height: 26px;
	text-align: center;
}

#powerScore #rateAthleteHeader.rated {
	height: auto;
	line-height: 17px;
	padding: 6px 0;
	font-weight: normal;
}

#powerScore #ratingSubmit {
	text-align: center;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ratingSubmitbg.jpg);
	background-position: bottom left;
	background-repeat: repeat-x;
	height: 24px;
	padding: 7px 0 9px;
}

#powerScore #ratingSubmit input {
	margin: 0;
	height: 27px;
	width: 62px;
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -55px -1px;
	background-repeat: no-repeat;
	padding: 2px 6px;
	text-indent: -999em;
	border: 0;
	font-size: 0px;
	line-height: 0px;
}

#powerScore #ratingSubmit input:hover {
	background-position: -55px -28px;
}

#powerScore #ratingComments {
	padding: 7px;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ratingSubmitbg.jpg);
	background-position: left top;;
	background-repeat: repeat-x;
	font-weight: bold;
}

#spanYourScore {
	font-style: italic;
	font-size: 13px;
}

.rateLabel {
	margin-right: 7px;
}

div.ratingCategory {
	padding: 6px;
	margin: 3px;
	background-color: #fff;
}

.ratingStars {
	width: 80px;
	height: 16px;
	margin: 0;
	padding: 0;
	list-style: none;
	clear: both;
	position: relative;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/star_matrix.png);
	background-position: 0 0;
	background-repeat: no-repeat;
	float: right;
}

.ratingStars li {
	float: left;
	text-indent: -999em;
	cursor: pointer;
}

ul.ratingStars li a {
	position: absolute;
	left: 0;
	top: 0;
	width: 16px;
	height: 16px;
	text-decoration: none;
	z-index: 200;
}

ul.ratingStars li.ratezero a {display: none;}
ul.ratingStars li.rateone a {left: 0;}
ul.ratingStars li.ratetwo a {left: 16px;}
ul.ratingStars li.ratethree a {left: 32px;}
ul.ratingStars li.ratefour a {left: 48px;}
ul.ratingStars li.ratefive a {left: 64px;}

.nostars {background-position: 0 0;}
.onestar {background-position: 0 -16px;}
.twostars {background-position: 0 -32px;}
.threestars {background-position: 0 -48px;}
.fourstars {background-position: 0 -64px;}
.fivestars {background-position: 0 -80px;}

ul.ratingStars li a:hover {
	z-index: 2;
	width: 80px;
	height: 16px;
	overflow: hidden;
	left: 0;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/star_matrix.png);
	background-repeat: no-repeat;
	background-position: 0 0;
}

ul.ratingStars li.rateone a:hover {background-position: 0 -16px;}
ul.ratingStars li.ratetwo a:hover {background-position: 0 -32px;}
ul.ratingStars li.ratethree a:hover {background-position: 0 -48px}
ul.ratingStars li.ratefour a:hover {background-position: 0 -64px}
ul.ratingStars li.ratefive a:hover {background-position: 0 -80px}

/************************
 * end of power rating styles
 * ***********************/


/* message board styles, overriding message board plugin */

/* input msg area */
#mb_input_wrapper {
	margin: 0 0 10px;
	padding: 0;
}

#mb_input_wrapper #postit {
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -388px -1px;
	background-repeat: no-repeat;
	width: 48px;
	margin: 10px 0;
	cursor: pointer;
	text-indent: -999em;
	border: 0;
	font-size: 0px;
	line-height: 0px;
}

#mb_input_wrapper #postit:hover {
	background-position: -388px -28px;
}

#mb_input_wrapper .input_textarea {
	width: 675px;
}

#messageboard_widget_menu {
	float: right;
}

.collapsable_box_content #mb_input_wrapper .input_textarea {
	width: 259px;
}

.message_item_timestamp {
	font-size: 90%;
	padding: 10px 0 0 0;
}

p.message_item_timestamp {
	margin-bottom: 10px;
}

/* wraps each message */
.messageboard {
	margin: 0 0 5px;
	padding: 0;
	background: white;
}

.messageboard .message_sender {
	float: left;
	margin: 5px 10px 0 0;
}

/* IE6 */
* html .messageboard { width: 280px; } 
* html #two_column_left_sidebar_maincontent .messageboard { width: 667px; }
* html .messageboard .message_sender { margin: 5px 10px 0 0; }
* html #mb_input_wrapper .input_textarea { width:645px; }

/* IE7 */
*:first-child+html .messageboard { width: 280px; } 
*:first-child+html #two_column_left_sidebar_maincontent .messageboard { width: 698px; }
*:first-child+html .messageboard .message_sender { margin: 5px 10px 0 0; }

.messageboard .message p {
	line-height: 1.2em;
	background: #dedede;
	margin: 0 6px 4px 0;
	padding: 4px;
	overflow-y: hidden;
	overflow-x: auto;
	color: #333333;
}

.message_buttons {
	padding: 0 0 3px 4px;
	margin: 0;
	font-size: 90%;
	color: #666666;
}

.messageboard .delete_message a {
	display: block;
	float: right;
	cursor: pointer;
	width: 14px;
	height: 14px;
	margin: 0 3px 3px 0;
	background: url("<?php echo $vars['url']; ?>_graphics/icon_customise_remove.png") no-repeat 0 0;
	text-indent: -9000px;
}
.messageboard .delete_message a:hover {
	background-position: 0 -16px;
}

/* end message board styles */

/* powerscore all ratings overlay */
#allRatings #psContent {
	text-align: left;
	border-bottom: 4px solid #878787;
	background-color: #878787;
	font-size: 1.5em;
	font-weight: bold;
	color: #476896;
}

#allRatings #psContent img {
	margin: 0 15px 0 10px;
	padding-bottom: 3px;
}

#allRatings div.rateListing {
	/* height: 56px; */
	padding: 7px;
}

#allRatings div.even {
	background-color: #E4EFF4;
	border: 1px solid #cde1ea;
	border-left: 0;
	border-right: 0;
}

#allRatings div.rateListing p.rateListingValue {
	font-size: 1.3em;
	font-weight: bold;
	width: 45px;
	text-align: center;
	float: left;
	clear: left;
	margin: 0 7px 7px 0;
}

#allRatings div.rateListing p em {
	color: #999;
}


/* battle styles */
#imgBattleHeader {
	margin-top: -14px;
}

#battleMainButtons {
	list-style-image: none;
	list-style-type: none;
	width: 100%;
	text-align: center;
	margin: 0 auto;
}

#battleMainButtons li {
	float: left;
	text-indent: -999em;
}

#battleMainButtons li a {
	width: 100%;
	height: 100%;
	display: block;
}

#battleMainButtons #battleCreate {
	background-color: transparent;
	background-image: url("<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png");
	background-repeat: no-repeat;
	background-position: -228px -190px;
	width: 127px;
	height: 50px;
	margin: 15px 25px;
}

#battleMainButtons #battleVote {
	background-color: transparent;
	background-image: url("<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png");
	background-repeat: no-repeat;
	background-position: -615px -190px;
	width: 127px;
	height: 50px;
	margin: 15px 25px;
}

#battleMainButtons #battleSearch {
	background-color: transparent;
	background-image: url("<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png");
	background-repeat: no-repeat;
	background-position: -486px -190px;
	width: 127px;
	height: 50px;
	margin: 15px 25px;
}

#two_column_right_sidebar #battleRightCol h3 {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/widgetheaderbg.jpg);
	background-position: left top;
	background-repeat: no-repeat;	
	border-bottom: none;
	padding: 0 10px;
	color: #fff;
	height: 25px;
	line-height: 25px;
}








/* jquery ui css */

/*
* jQuery UI CSS Framework
* Copyright (c) 2009 AUTHORS.txt (http://jqueryui.com/about)
* Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.
*/

/* Layout helpers
----------------------------------*/
.ui-helper-hidden {
	display: none;
}

.ui-helper-hidden-accessible {
	position: absolute;
	left: -99999999px;
}

.ui-helper-reset {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	line-height: 1.3;
	text-decoration: none;
	font-size: 100%;
	list-style: none;
}

.ui-helper-clearfix:after {
	content: ".";
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

.ui-helper-clearfix {
	display: inline-block;
}

/* required comment for clearfix to work in Opera \*/
* html .ui-helper-clearfix { height:1%; }
.ui-helper-clearfix { display:block; }
/* end clearfix */

.ui-helper-zfix {
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	position: absolute;
	opacity: 0;
	filter:Alpha(Opacity=0);
}

/* Interaction Cues ----------------------------------*/
.ui-state-disabled { cursor: default !important; }

/* Icons ----------------------------------*/

/* states and images */
.ui-icon {
	display: block;
	text-indent: -99999px;
	overflow: hidden;
	background-repeat: no-repeat;
}

/* Misc visuals ----------------------------------*/

/* Overlays */
.ui-widget-overlay {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

/*
* jQuery UI CSS Framework
* Copyright (c) 2009 AUTHORS.txt (http://jqueryui.com/about)
* Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.
* To view and modify this theme, visit http://jqueryui.com/themeroller/?ffDefault=Arial,sans-serif&fwDefault=normal&fsDefault=12px&cornerRadius=0&bgColorHeader=303030&bgTextureHeader=05_inset_soft.png&bgImgOpacityHeader=10&borderColorHeader=303030&fcHeader=ffffff&iconColorHeader=dddddd&bgColorContent=ffffff&bgTextureContent=01_flat.png&bgImgOpacityContent=100&borderColorContent=bcbcbc&fcContent=000000&iconColorContent=dddddd&bgColorDefault=e6e6e6&bgTextureDefault=02_glass.png&bgImgOpacityDefault=75&borderColorDefault=d3d3d3&fcDefault=555555&iconColorDefault=888888&bgColorHover=dadada&bgTextureHover=02_glass.png&bgImgOpacityHover=75&borderColorHover=999999&fcHover=212121&iconColorHover=454545&bgColorActive=ffffff&bgTextureActive=02_glass.png&bgImgOpacityActive=65&borderColorActive=aaaaaa&fcActive=212121&iconColorActive=454545&bgColorHighlight=FFD49A&bgTextureHighlight=01_flat.png&bgImgOpacityHighlight=100&borderColorHighlight=FF8B26&fcHighlight=000000&iconColorHighlight=FF8B26&bgColorError=fef1ec&bgTextureError=05_inset_soft.png&bgImgOpacityError=95&borderColorError=cd0a0a&fcError=cd0a0a&iconColorError=cd0a0a&bgColorOverlay=000000&bgTextureOverlay=01_flat.png&bgImgOpacityOverlay=100&opacityOverlay=75&bgColorShadow=aaaaaa&bgTextureShadow=01_flat.png&bgImgOpacityShadow=0&opacityShadow=30&thicknessShadow=0&offsetTopShadow=0&offsetLeftShadow=0&cornerRadiusShadow=0
*/


/* Component containers
----------------------------------*/
.ui-widget {
	font-family: Arial,sans-serif;
	font-size: 12px;
}

.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button {
	font-family: Arial,sans-serif;
	font-size: 1em;
}

.ui-widget-content {
	border: 1px solid #bcbcbc;
	background: #ffffff url(<?php echo $vars['url']; ?>_graphics/jr/ui-bg_flat_100_ffffff_40x100.png) 50% 50% repeat-x;
	color: #000000;
}

.ui-widget-content a {
	color: #000000;
}

.ui-widget-header {
	background-color: #fff;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/powerscore_bar.png);
	background-position: left top;
	background-repeat: repeat-x;
	color: #ffffff;
	font-weight: bold;
}

.ui-widget-header a {
	color: #ffffff;
}

/* Interaction states ----------------------------------*/
.ui-state-default, .ui-widget-content .ui-state-default {
	border: 1px solid #d3d3d3;
	background: #e6e6e6 url(<?php echo $vars['url']; ?>_graphics/jr/ui-bg_glass_75_e6e6e6_1x400.png) 50% 50% repeat-x;
	font-weight: normal;
	color: #555555;
	outline: none;
}

.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited {
	color: #555555;
	text-decoration: none;
	outline: none;
}

.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus {
	border: 1px solid #999999;
	background: #dadada url(<?php echo $vars['url']; ?>_graphics/jr/ui-bg_glass_75_dadada_1x400.png) 50% 50% repeat-x;
	font-weight: normal;
	color: #212121;
	outline: none;
}

.ui-state-hover a, .ui-state-hover a:hover {
	color: #212121;
	text-decoration: none;
	outline: none;
}

.ui-state-active, .ui-widget-content .ui-state-active {
	border: 1px solid #aaaaaa;
	background: #ffffff url(<?php echo $vars['url']; ?>_graphics/jr/ui-bg_glass_65_ffffff_1x400.png) 50% 50% repeat-x;
	font-weight: normal;
	color: #212121;
	outline: none;
}

.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {
	color: #212121;
	outline: none;
	text-decoration: none;
}

/* Interaction Cues ----------------------------------*/
.ui-state-highlight, .ui-widget-content .ui-state-highlight {
	border: 1px solid #FF8B26;
	background: #FFD49A url(<?php echo $vars['url']; ?>_graphics/jr/ui-bg_flat_100_FFD49A_40x100.png) 50% 50% repeat-x;
	color: #000000;
}

.ui-state-highlight a, .ui-widget-content .ui-state-highlight a {
	color: #000000;
}

.ui-state-error, .ui-widget-content .ui-state-error {
	border: 1px solid #cd0a0a;
	background: #fef1ec url(<?php echo $vars['url']; ?>_graphics/jr/ui-bg_inset-soft_95_fef1ec_1x100.png) 50% bottom repeat-x;
	color: #cd0a0a;
}

.ui-state-error a, .ui-widget-content .ui-state-error a {
	color: #cd0a0a;
}

.ui-state-error-text, .ui-widget-content .ui-state-error-text {
	color: #cd0a0a;
}

.ui-state-disabled, .ui-widget-content .ui-state-disabled {
	opacity: .35;
	filter:Alpha(Opacity=35);
	background-image: none;
}

.ui-priority-primary, .ui-widget-content .ui-priority-primary {
	font-weight: bold;
}

.ui-priority-secondary, .ui-widget-content .ui-priority-secondary {
	opacity: .7;
	filter:Alpha(Opacity=70);
	font-weight: normal;
}

/* Icons ----------------------------------*/

/* states and images */
.ui-icon {
	width: 16px;
	height: 16px;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ui-icons_dddddd_256x240.png);
}

.ui-widget-content .ui-icon {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ui-icons_dddddd_256x240.png);
}
.ui-widget-header .ui-icon {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ui-icons_dddddd_256x240.png);
}

.ui-state-default .ui-icon {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ui-icons_888888_256x240.png);
}

.ui-state-hover .ui-icon, .ui-state-focus .ui-icon {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ui-icons_454545_256x240.png);
}

.ui-state-active .ui-icon {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ui-icons_454545_256x240.png);
}

.ui-state-highlight .ui-icon {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ui-icons_FF8B26_256x240.png);
}

.ui-state-error .ui-icon, .ui-state-error-text .ui-icon {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/ui-icons_cd0a0a_256x240.png);
}

/* positioning */
.ui-icon-carat-1-n { background-position: 0 0; }
.ui-icon-carat-1-ne { background-position: -16px 0; }
.ui-icon-carat-1-e { background-position: -32px 0; }
.ui-icon-carat-1-se { background-position: -48px 0; }
.ui-icon-carat-1-s { background-position: -64px 0; }
.ui-icon-carat-1-sw { background-position: -80px 0; }
.ui-icon-carat-1-w { background-position: -96px 0; }
.ui-icon-carat-1-nw { background-position: -112px 0; }
.ui-icon-carat-2-n-s { background-position: -128px 0; }
.ui-icon-carat-2-e-w { background-position: -144px 0; }
.ui-icon-triangle-1-n { background-position: 0 -16px; }
.ui-icon-triangle-1-ne { background-position: -16px -16px; }
.ui-icon-triangle-1-e { background-position: -32px -16px; }
.ui-icon-triangle-1-se { background-position: -48px -16px; }
.ui-icon-triangle-1-s { background-position: -64px -16px; }
.ui-icon-triangle-1-sw { background-position: -80px -16px; }
.ui-icon-triangle-1-w { background-position: -96px -16px; }
.ui-icon-triangle-1-nw { background-position: -112px -16px; }
.ui-icon-triangle-2-n-s { background-position: -128px -16px; }
.ui-icon-triangle-2-e-w { background-position: -144px -16px; }
.ui-icon-arrow-1-n { background-position: 0 -32px; }
.ui-icon-arrow-1-ne { background-position: -16px -32px; }
.ui-icon-arrow-1-e { background-position: -32px -32px; }
.ui-icon-arrow-1-se { background-position: -48px -32px; }
.ui-icon-arrow-1-s { background-position: -64px -32px; }
.ui-icon-arrow-1-sw { background-position: -80px -32px; }
.ui-icon-arrow-1-w { background-position: -96px -32px; }
.ui-icon-arrow-1-nw { background-position: -112px -32px; }
.ui-icon-arrow-2-n-s { background-position: -128px -32px; }
.ui-icon-arrow-2-ne-sw { background-position: -144px -32px; }
.ui-icon-arrow-2-e-w { background-position: -160px -32px; }
.ui-icon-arrow-2-se-nw { background-position: -176px -32px; }
.ui-icon-arrowstop-1-n { background-position: -192px -32px; }
.ui-icon-arrowstop-1-e { background-position: -208px -32px; }
.ui-icon-arrowstop-1-s { background-position: -224px -32px; }
.ui-icon-arrowstop-1-w { background-position: -240px -32px; }
.ui-icon-arrowthick-1-n { background-position: 0 -48px; }
.ui-icon-arrowthick-1-ne { background-position: -16px -48px; }
.ui-icon-arrowthick-1-e { background-position: -32px -48px; }
.ui-icon-arrowthick-1-se { background-position: -48px -48px; }
.ui-icon-arrowthick-1-s { background-position: -64px -48px; }
.ui-icon-arrowthick-1-sw { background-position: -80px -48px; }
.ui-icon-arrowthick-1-w { background-position: -96px -48px; }
.ui-icon-arrowthick-1-nw { background-position: -112px -48px; }
.ui-icon-arrowthick-2-n-s { background-position: -128px -48px; }
.ui-icon-arrowthick-2-ne-sw { background-position: -144px -48px; }
.ui-icon-arrowthick-2-e-w { background-position: -160px -48px; }
.ui-icon-arrowthick-2-se-nw { background-position: -176px -48px; }
.ui-icon-arrowthickstop-1-n { background-position: -192px -48px; }
.ui-icon-arrowthickstop-1-e { background-position: -208px -48px; }
.ui-icon-arrowthickstop-1-s { background-position: -224px -48px; }
.ui-icon-arrowthickstop-1-w { background-position: -240px -48px; }
.ui-icon-arrowreturnthick-1-w { background-position: 0 -64px; }
.ui-icon-arrowreturnthick-1-n { background-position: -16px -64px; }
.ui-icon-arrowreturnthick-1-e { background-position: -32px -64px; }
.ui-icon-arrowreturnthick-1-s { background-position: -48px -64px; }
.ui-icon-arrowreturn-1-w { background-position: -64px -64px; }
.ui-icon-arrowreturn-1-n { background-position: -80px -64px; }
.ui-icon-arrowreturn-1-e { background-position: -96px -64px; }
.ui-icon-arrowreturn-1-s { background-position: -112px -64px; }
.ui-icon-arrowrefresh-1-w { background-position: -128px -64px; }
.ui-icon-arrowrefresh-1-n { background-position: -144px -64px; }
.ui-icon-arrowrefresh-1-e { background-position: -160px -64px; }
.ui-icon-arrowrefresh-1-s { background-position: -176px -64px; }
.ui-icon-arrow-4 { background-position: 0 -80px; }
.ui-icon-arrow-4-diag { background-position: -16px -80px; }
.ui-icon-extlink { background-position: -32px -80px; }
.ui-icon-newwin { background-position: -48px -80px; }
.ui-icon-refresh { background-position: -64px -80px; }
.ui-icon-shuffle { background-position: -80px -80px; }
.ui-icon-transfer-e-w { background-position: -96px -80px; }
.ui-icon-transferthick-e-w { background-position: -112px -80px; }
.ui-icon-folder-collapsed { background-position: 0 -96px; }
.ui-icon-folder-open { background-position: -16px -96px; }
.ui-icon-document { background-position: -32px -96px; }
.ui-icon-document-b { background-position: -48px -96px; }
.ui-icon-note { background-position: -64px -96px; }
.ui-icon-mail-closed { background-position: -80px -96px; }
.ui-icon-mail-open { background-position: -96px -96px; }
.ui-icon-suitcase { background-position: -112px -96px; }
.ui-icon-comment { background-position: -128px -96px; }
.ui-icon-person { background-position: -144px -96px; }
.ui-icon-print { background-position: -160px -96px; }
.ui-icon-trash { background-position: -176px -96px; }
.ui-icon-locked { background-position: -192px -96px; }
.ui-icon-unlocked { background-position: -208px -96px; }
.ui-icon-bookmark { background-position: -224px -96px; }
.ui-icon-tag { background-position: -240px -96px; }
.ui-icon-home { background-position: 0 -112px; }
.ui-icon-flag { background-position: -16px -112px; }
.ui-icon-calendar { background-position: -32px -112px; }
.ui-icon-cart { background-position: -48px -112px; }
.ui-icon-pencil { background-position: -64px -112px; }
.ui-icon-clock { background-position: -80px -112px; }
.ui-icon-disk { background-position: -96px -112px; }
.ui-icon-calculator { background-position: -112px -112px; }
.ui-icon-zoomin { background-position: -128px -112px; }
.ui-icon-zoomout { background-position: -144px -112px; }
.ui-icon-search { background-position: -160px -112px; }
.ui-icon-wrench { background-position: -176px -112px; }
.ui-icon-gear { background-position: -192px -112px; }
.ui-icon-heart { background-position: -208px -112px; }
.ui-icon-star { background-position: -224px -112px; }
.ui-icon-link { background-position: -240px -112px; }
.ui-icon-cancel { background-position: 0 -128px; }
.ui-icon-plus { background-position: -16px -128px; }
.ui-icon-plusthick { background-position: -32px -128px; }
.ui-icon-minus { background-position: -48px -128px; }
.ui-icon-minusthick { background-position: -64px -128px; }
.ui-icon-close { background-position: -80px -128px; }
.ui-icon-closethick { background-position: -96px -128px; }
.ui-icon-key { background-position: -112px -128px; }
.ui-icon-lightbulb { background-position: -128px -128px; }
.ui-icon-scissors { background-position: -144px -128px; }
.ui-icon-clipboard { background-position: -160px -128px; }
.ui-icon-copy { background-position: -176px -128px; }
.ui-icon-contact { background-position: -192px -128px; }
.ui-icon-image { background-position: -208px -128px; }
.ui-icon-video { background-position: -224px -128px; }
.ui-icon-script { background-position: -240px -128px; }
.ui-icon-alert { background-position: 0 -144px; }
.ui-icon-info { background-position: -16px -144px; }
.ui-icon-notice { background-position: -32px -144px; }
.ui-icon-help { background-position: -48px -144px; }
.ui-icon-check { background-position: -64px -144px; }
.ui-icon-bullet { background-position: -80px -144px; }
.ui-icon-radio-off { background-position: -96px -144px; }
.ui-icon-radio-on { background-position: -112px -144px; }
.ui-icon-pin-w { background-position: -128px -144px; }
.ui-icon-pin-s { background-position: -144px -144px; }
.ui-icon-play { background-position: 0 -160px; }
.ui-icon-pause { background-position: -16px -160px; }
.ui-icon-seek-next { background-position: -32px -160px; }
.ui-icon-seek-prev { background-position: -48px -160px; }
.ui-icon-seek-end { background-position: -64px -160px; }
.ui-icon-seek-first { background-position: -80px -160px; }
.ui-icon-stop { background-position: -96px -160px; }
.ui-icon-eject { background-position: -112px -160px; }
.ui-icon-volume-off { background-position: -128px -160px; }
.ui-icon-volume-on { background-position: -144px -160px; }
.ui-icon-power { background-position: 0 -176px; }
.ui-icon-signal-diag { background-position: -16px -176px; }
.ui-icon-signal { background-position: -32px -176px; }
.ui-icon-battery-0 { background-position: -48px -176px; }
.ui-icon-battery-1 { background-position: -64px -176px; }
.ui-icon-battery-2 { background-position: -80px -176px; }
.ui-icon-battery-3 { background-position: -96px -176px; }
.ui-icon-circle-plus { background-position: 0 -192px; }
.ui-icon-circle-minus { background-position: -16px -192px; }
.ui-icon-circle-close { background-position: -32px -192px; }
.ui-icon-circle-triangle-e { background-position: -48px -192px; }
.ui-icon-circle-triangle-s { background-position: -64px -192px; }
.ui-icon-circle-triangle-w { background-position: -80px -192px; }
.ui-icon-circle-triangle-n { background-position: -96px -192px; }
.ui-icon-circle-arrow-e { background-position: -112px -192px; }
.ui-icon-circle-arrow-s { background-position: -128px -192px; }
.ui-icon-circle-arrow-w { background-position: -144px -192px; }
.ui-icon-circle-arrow-n { background-position: -160px -192px; }
.ui-icon-circle-zoomin { background-position: -176px -192px; }
.ui-icon-circle-zoomout { background-position: -192px -192px; }
.ui-icon-circle-check { background-position: -208px -192px; }
.ui-icon-circlesmall-plus { background-position: 0 -208px; }
.ui-icon-circlesmall-minus { background-position: -16px -208px; }
.ui-icon-circlesmall-close { background-position: -32px -208px; }
.ui-icon-squaresmall-plus { background-position: -48px -208px; }
.ui-icon-squaresmall-minus { background-position: -64px -208px; }
.ui-icon-squaresmall-close { background-position: -80px -208px; }
.ui-icon-grip-dotted-vertical { background-position: 0 -224px; }
.ui-icon-grip-dotted-horizontal { background-position: -16px -224px; }
.ui-icon-grip-solid-vertical { background-position: -32px -224px; }
.ui-icon-grip-solid-horizontal { background-position: -48px -224px; }
.ui-icon-gripsmall-diagonal-se { background-position: -64px -224px; }
.ui-icon-grip-diagonal-se { background-position: -80px -224px; }


/* Misc visuals
----------------------------------*/

/* Corner radius */
.ui-corner-tl { -moz-border-radius-topleft: 0; -webkit-border-top-left-radius: 0; }
.ui-corner-tr { -moz-border-radius-topright: 0; -webkit-border-top-right-radius: 0; }
.ui-corner-bl { -moz-border-radius-bottomleft: 0; -webkit-border-bottom-left-radius: 0; }
.ui-corner-br { -moz-border-radius-bottomright: 0; -webkit-border-bottom-right-radius: 0; }
.ui-corner-top { -moz-border-radius-topleft: 0; -webkit-border-top-left-radius: 0; -moz-border-radius-topright: 0; -webkit-border-top-right-radius: 0; }
.ui-corner-bottom { -moz-border-radius-bottomleft: 0; -webkit-border-bottom-left-radius: 0; -moz-border-radius-bottomright: 0; -webkit-border-bottom-right-radius: 0; }
.ui-corner-right {  -moz-border-radius-topright: 0; -webkit-border-top-right-radius: 0; -moz-border-radius-bottomright: 0; -webkit-border-bottom-right-radius: 0; }
.ui-corner-left { -moz-border-radius-topleft: 0; -webkit-border-top-left-radius: 0; -moz-border-radius-bottomleft: 0; -webkit-border-bottom-left-radius: 0; }
.ui-corner-all { -moz-border-radius: 0; -webkit-border-radius: 0; }

/* Overlays */
.ui-widget-overlay { background: #000000 url(<?php echo $vars['url']; ?>_graphics/jr/ui-bg_flat_100_000000_40x100.png) 50% 50% repeat-x; opacity: .75;filter:Alpha(Opacity=75); }
.ui-widget-shadow { margin: 0 0 0 0; padding: 0; background: #aaaaaa url(<?php echo $vars['url']; ?>_graphics/jr/ui-bg_flat_0_aaaaaa_40x100.png) 50% 50% repeat-x; opacity: .30;filter:Alpha(Opacity=30); -moz-border-radius: 0; -webkit-border-radius: 0; }/* Accordion
----------------------------------*/
.ui-accordion .ui-accordion-header { cursor: pointer; position: relative; margin-top: 1px; zoom: 1; }
.ui-accordion .ui-accordion-li-fix { display: inline; }
.ui-accordion .ui-accordion-header-active { border-bottom: 0 !important; }
.ui-accordion .ui-accordion-header a { display: block; font-size: 1em; padding: .5em .5em .5em 2.2em; }
.ui-accordion .ui-accordion-header .ui-icon { position: absolute; left: .5em; top: 50%; margin-top: -8px; }
.ui-accordion .ui-accordion-content { padding: 1em 2.2em; border-top: 0; margin-top: -2px; position: relative; top: 1px; margin-bottom: 2px; overflow: auto; display: none; }
.ui-accordion .ui-accordion-content-active { display: block; }/* Datepicker
----------------------------------*/
.ui-datepicker { width: 17em; padding: .2em .2em 0; }
.ui-datepicker .ui-datepicker-header { position:relative; padding:.2em 0; }
.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next { position:absolute; top: 2px; width: 1.8em; height: 1.8em; }
.ui-datepicker .ui-datepicker-prev-hover, .ui-datepicker .ui-datepicker-next-hover { top: 1px; }
.ui-datepicker .ui-datepicker-prev { left:2px; }
.ui-datepicker .ui-datepicker-next { right:2px; }
.ui-datepicker .ui-datepicker-prev-hover { left:1px; }
.ui-datepicker .ui-datepicker-next-hover { right:1px; }
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span { display: block; position: absolute; left: 50%; margin-left: -8px; top: 50%; margin-top: -8px;  }
.ui-datepicker .ui-datepicker-title { margin: 0 2.3em; line-height: 1.8em; text-align: center; }
.ui-datepicker .ui-datepicker-title select { float:left; font-size:1em; margin:1px 0; }
.ui-datepicker select.ui-datepicker-month-year {width: 100%;}
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 49%;}
.ui-datepicker .ui-datepicker-title select.ui-datepicker-year { float: right; }
.ui-datepicker table {width: 100%; font-size: .9em; border-collapse: collapse; margin:0 0 .4em; }
.ui-datepicker th { padding: .7em .3em; text-align: center; font-weight: bold; border: 0;  }
.ui-datepicker td { border: 0; padding: 1px; }
.ui-datepicker td span, .ui-datepicker td a { display: block; padding: .2em; text-align: right; text-decoration: none; }
.ui-datepicker .ui-datepicker-buttonpane { background-image: none; margin: .7em 0 0 0; padding:0 .2em; border-left: 0; border-right: 0; border-bottom: 0; }
.ui-datepicker .ui-datepicker-buttonpane button { float: right; margin: .5em .2em .4em; cursor: pointer; padding: .2em .6em .3em .6em; width:auto; overflow:visible; }
.ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current { float:left; }

/* with multiple calendars */
.ui-datepicker.ui-datepicker-multi { width:auto; }
.ui-datepicker-multi .ui-datepicker-group { float:left; }
.ui-datepicker-multi .ui-datepicker-group table { width:95%; margin:0 auto .4em; }
.ui-datepicker-multi-2 .ui-datepicker-group { width:50%; }
.ui-datepicker-multi-3 .ui-datepicker-group { width:33.3%; }
.ui-datepicker-multi-4 .ui-datepicker-group { width:25%; }
.ui-datepicker-multi .ui-datepicker-group-last .ui-datepicker-header { border-left-width:0; }
.ui-datepicker-multi .ui-datepicker-group-middle .ui-datepicker-header { border-left-width:0; }
.ui-datepicker-multi .ui-datepicker-buttonpane { clear:left; }
.ui-datepicker-row-break { clear:both; width:100%; }

/* RTL support */
.ui-datepicker-rtl { direction: rtl; }
.ui-datepicker-rtl .ui-datepicker-prev { right: 2px; left: auto; }
.ui-datepicker-rtl .ui-datepicker-next { left: 2px; right: auto; }
.ui-datepicker-rtl .ui-datepicker-prev:hover { right: 1px; left: auto; }
.ui-datepicker-rtl .ui-datepicker-next:hover { left: 1px; right: auto; }
.ui-datepicker-rtl .ui-datepicker-buttonpane { clear:right; }
.ui-datepicker-rtl .ui-datepicker-buttonpane button { float: left; }
.ui-datepicker-rtl .ui-datepicker-buttonpane button.ui-datepicker-current { float:right; }
.ui-datepicker-rtl .ui-datepicker-group { float:right; }
.ui-datepicker-rtl .ui-datepicker-group-last .ui-datepicker-header { border-right-width:0; border-left-width:1px; }
.ui-datepicker-rtl .ui-datepicker-group-middle .ui-datepicker-header { border-right-width:0; border-left-width:1px; }

/* IE6 IFRAME FIX (taken from datepicker 1.5.3 */
.ui-datepicker-cover {
    display: none; /*sorry for IE5*/
    display/**/: block; /*sorry for IE5*/
    position: absolute; /*must have*/
    z-index: -1; /*must have*/
    filter: mask(); /*must have*/
    top: -4px; /*must have*/
    left: -4px; /*must have*/
    width: 200px; /*must have*/
    height: 200px; /*must have*/
}/* Dialog
----------------------------------*/
.ui-dialog { position: relative; padding: .2em; width: 300px; }
.ui-dialog .ui-dialog-titlebar { padding: .5em .3em .3em 1em; position: relative;  }
.ui-dialog .ui-dialog-title {
	float: left;
	margin: .1em 0 .2em;
	text-indent: -999em;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/powerscore_title.png);
	background-position: top left;
	background-repeat: no-repeat;
	width: 105px;
} 
.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
.ui-dialog .ui-dialog-content { border: 0; padding: 0; background: none; overflow: auto; zoom: 1; }
.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em; }
.ui-dialog .ui-dialog-buttonpane button { float: right; margin: .5em .4em .5em 0; cursor: pointer; padding: .2em .6em .3em .6em; line-height: 1.4em; width:auto; overflow:visible; }
.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }
.ui-draggable .ui-dialog-titlebar { cursor: move; }
/* Progressbar
----------------------------------*/
.ui-progressbar { height:2em; text-align: left; }
.ui-progressbar .ui-progressbar-value {margin: -1px; height:100%; }/* Resizable
----------------------------------*/
.ui-resizable { position: relative;}
.ui-resizable-handle { position: absolute;font-size: 0.1px;z-index: 99999; display: block;}
.ui-resizable-disabled .ui-resizable-handle, .ui-resizable-autohide .ui-resizable-handle { display: none; }
.ui-resizable-n { cursor: n-resize; height: 7px; width: 100%; top: -5px; left: 0px; }
.ui-resizable-s { cursor: s-resize; height: 7px; width: 100%; bottom: -5px; left: 0px; }
.ui-resizable-e { cursor: e-resize; width: 7px; right: -5px; top: 0px; height: 100%; }
.ui-resizable-w { cursor: w-resize; width: 7px; left: -5px; top: 0px; height: 100%; }
.ui-resizable-se { cursor: se-resize; width: 12px; height: 12px; right: 1px; bottom: 1px; }
.ui-resizable-sw { cursor: sw-resize; width: 9px; height: 9px; left: -5px; bottom: -5px; }
.ui-resizable-nw { cursor: nw-resize; width: 9px; height: 9px; left: -5px; top: -5px; }
.ui-resizable-ne { cursor: ne-resize; width: 9px; height: 9px; right: -5px; top: -5px;}/* Slider
----------------------------------*/
.ui-slider { position: relative; text-align: left; }
.ui-slider .ui-slider-handle { position: absolute; z-index: 2; width: 1.2em; height: 1.2em; cursor: default; }
.ui-slider .ui-slider-range { position: absolute; z-index: 1; font-size: .7em; display: block; border: 0; }

.ui-slider-horizontal { height: .8em; }
.ui-slider-horizontal .ui-slider-handle { top: -.3em; margin-left: -.6em; }
.ui-slider-horizontal .ui-slider-range { top: 0; height: 100%; }
.ui-slider-horizontal .ui-slider-range-min { left: 0; }
.ui-slider-horizontal .ui-slider-range-max { right: 0; }

.ui-slider-vertical { width: .8em; height: 100px; }
.ui-slider-vertical .ui-slider-handle { left: -.3em; margin-left: 0; margin-bottom: -.6em; }
.ui-slider-vertical .ui-slider-range { left: 0; width: 100%; }
.ui-slider-vertical .ui-slider-range-min { bottom: 0; }
.ui-slider-vertical .ui-slider-range-max { top: 0; }/* Tabs
----------------------------------*/
.ui-tabs { padding: .2em; zoom: 1; }
.ui-tabs .ui-tabs-nav { list-style: none; position: relative; padding: .2em .2em 0; }
.ui-tabs .ui-tabs-nav li { position: relative; float: left; border-bottom-width: 0 !important; margin: 0 .2em -1px 0; padding: 0; }
.ui-tabs .ui-tabs-nav li a { float: left; text-decoration: none; padding: .5em 1em; }
.ui-tabs .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 1px; border-bottom-width: 0; }
.ui-tabs .ui-tabs-nav li.ui-tabs-selected a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-state-processing a { cursor: text; }
.ui-tabs .ui-tabs-nav li a, .ui-tabs.ui-tabs-collapsible .ui-tabs-nav li.ui-tabs-selected a { cursor: pointer; } /* first selector in group seems obsolete, but required to overcome bug in Opera applying cursor: text overall if defined elsewhere... */
.ui-tabs .ui-tabs-panel { padding: 1em 1.4em; display: block; border-width: 0; background: none; }
.ui-tabs .ui-tabs-hide { display: none !important; }

/* end jquery ui css */