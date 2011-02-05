<?php

	/**
	 * Elgg Messages CSS extender
	 * 
	 * @package ElggMessages
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

?>

/*-------------------------------
MESSAGING PLUGIN
-------------------------------*/
#messages {
	margin: 0;
	padding: 10px;
	background-color: #fff;
	position: relative;
	border: 1px solid #c2c2c2;
}

.actiontitle {
	font-weight: bold;
	font-size: 110%;
	margin: 0 0 10px 0;
}

#messages .pagination {
	margin: 5px 0;
}

#messages input[type="checkbox"] {
	margin: 0 7px 0 0;
	padding: 0;
	border: none;
}

#messages input.sendMessage {
	background-color: transparent;
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-position: -292px -1px;
	background-repeat: no-repeat;
	width: 48px;
	text-indent: -999em;
	font-size: 0px;
	line-height: 0px;
}

#messages input.sendMessage:hover {
	background-position: -292px -28px;
}

/* message action menu */
.messages_buttonbank {
	margin: 15px 0 5px;
	padding: 0;
	text-align: right;
}

.messages_buttonbank input, 
.messages_buttonbank input[type="button"], 
.messages_buttonbank input[type="submit"] {
	background-color: transparent;
	margin: 0;
	border: 0;
}

.messages_buttonbank input:hover,
.messages_buttonbank input[type="button"]:hover, 
.messages_buttonbank input[type="submit"]:hover {
	color: #e05b00;
}

input[value="Delete"],
input[value="Mark read"],
input[value="Toggle all"] {
	background-image: url(<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png);
	background-repeat: no-repeat;
	text-indent: -999em;
	font-size: 0px;
	line-height: 0px;
}

input[value="Delete"] {
	background-position: -520px -1px;
	width: 62px;
	height: 27px;
}

input[value="Delete"]:hover {
	background-position: -520px -28px;
}

input[value="Mark read"] {
	background-position: -1px -172px;
	width: 87px;
	height: 27px;
}

input[value="Mark read"]:hover {
	background-position: -1px -199px;
}

input[value="Toggle all"] {
	background-position: -1px -253px;
	width: 87px;
	height: 27px;
}

input[value="Toggle all"]:hover {
	background-position: -1px -280px;
}

/* end message action menu */


#messages td {
	text-align: left;
	vertical-align:middle;
	padding: 5px;
}

#messages .message_sent {
	margin-bottom: -1px;
	background: #efefef;
	border: 1px solid #c2c2c2;
	color: #6a6a6a;
}

#messages .message_notread {
	margin: 0 0 -1px;
	background: #e2e6f7;
	color: #000;
	border: 1px solid #487797;
	position: relative;
	z-index: 10;
}

#messages .message_read {
	margin: 0 0 -1px;
	background: #efefef;
	border: 1px solid #c2c2c2;
	color: #6a6a6a;
	position: relative;
	z-index: 5;
}

#messages .message_notread td {
	font-weight: bold;
}

#messages .message_read td {
	font-weight: normal;
}

#messages .delete_msg a {
	display: block;
	width: 16px;
	height: 16px;
	margin: 0;
	background-image: url("<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png");
	background-position: -139px -151px;
	background-repeat: no-repeat;
	text-indent: -9000px;
	float: right;
}

#messages .delete_msg a:hover {
	background-position: -159px -151px;
}

/* IE6
* html #messages .delete_msg a { background-position: right 4px; }
* html #messages .delete_msg a:hover { background-position: right 4px; } 
*/

#messages .usericon,
#messages .groupicon {
	float: left;
	margin: 0 15px 0 0;
}

#messages .msgsender {
	line-height: 100%;
}


#messages .msgsubject {
	line-height: 100%;
}

#messages .msgsubject a, 
#messages .msgsender a {
	color: #000;
	font-weight: bold;
	text-decoration: underline;
}

#messages .message_read .msgsubject a, 
#messages .message_read .msgsender a {
	color: #6a6a6a;
	font-weight: normal;
}

.messages_single_icon  {
	float: left;
	width: 110px;
}

.messages_single_icon .usericon,
.messages_single_icon .groupicon {
	float: left;
	margin: 0 10px 10px 0;
}

/* view and reply to message view */
.message_body {
	margin-left: 120px;
}

.message_body .messagebody {
	padding: 0;
	margin: 10px 0 10px 0;
	font-size: 120%;
	border-top: 1px solid #cccccc;
}

/* drop down message reply form */
#message_reply_form {
	display: none;
}

#message_reply_form .input-text {
	width: 100%;
	padding: 0;
}

.new_messages_count {
	color:#666666;
}

/* tinyMCE container */
#message_reply_editor #message_tbl {
	width: 100% !important;
}

/* IE6 */
* html #message_reply_editor #message_tbl { width:676px !important;}

#messages_return {
	margin:4px 0 4px 10px;
}

#messages_return p {
	margin:0;
}

.messages_single {
	background: white;
	margin:0 10px 10px;
	padding:10px;	
}

/* when displaying original msg in reply view */
.previous_message {
    background:#dedede;
    padding:10px;
    margin:0 0 20px 0;
}

.previous_message p {
    padding:0;
    margin:0 0 5px 0;
    font-size: 100%;
}



#notificationstable td.sitetogglefield {
	width:50px;
	text-align: center;
	vertical-align: middle;
}

#notificationstable td.sitetogglefield input {
	margin-right:36px;
	margin-top:5px;
}

#notificationstable td.sitetogglefield a {
	width:46px;
	height:24px;
	cursor: pointer;
	display: block;
	outline: none;
}

#notificationstable td.sitetogglefield a.sitetoggleOff {
	background: url(<?php echo $vars['url']; ?>mod/messages/graphics/icon_notifications_site.gif) no-repeat right 2px;
}

#notificationstable td.sitetogglefield a.sitetoggleOn {
	background: url(<?php echo $vars['url']; ?>mod/messages/graphics/icon_notifications_site.gif) no-repeat right -36px;
}