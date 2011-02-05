<?php

	/**
	 * Elgg thewire CSS extender
	 * 
	 * @package ElggTheWire
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

?>
#two_column_left_sidebar_maincontent .thewire-singlepage {
	margin: 15px 10px;
}

/* widget */
.thewire-singlepage {
	margin: 14px 0;
}

.thewire-singlepage .note_body {
}

.collapsable_box_content .note_body {
	line-height: 1.2em;
}

.thewire-singlepage .thewire-post {
	padding-bottom: 10px;
	border-bottom: 1px solid #bbb;
}

.thewire-post {

}

.thewire-post .note_date {
	font-size: 95%;
	color: #666666;
	padding: 0;
	margin-top: 7px;
}

.thewire_icon {
    float: left;
    margin: 0 8px 4px 0;
}

.note_body {
	margin: 0;
	padding: 0 0 4px;
	min-height: 40px;
	line-height: 1.4em;
}

.thewire_options {
	float: right;
	width: 65px;
}

.thewire-post .reply {
	text-decoration: underline;	
}

.thewire-post .reply:hover {
	
}

.thewire-post .delete_note {
	width:14px;
	height:14px;
	margin:3px 0 0 0;
	float:right;
}

.thewire-post .delete_note a {
	display: block;
	cursor: pointer;
	width: 16px;
	height: 16px;
	background-image: url("<?php echo $vars['url']; ?>_graphics/jr/button_grid_master.png");
	background-position: -139px -151px;
	background-repeat: no-repeat;
	text-indent: -9000px;
}

.thewire-post .delete_note a:hover {
	background-position: -159px -151px;
}

/* IE 6 fix */
* html .thewire-post .delete_note a { background-position-y: 2px; }
* html .thewire-post .delete_note a:hover { background-position-y: -14px; }

.post_to_wire {
	background: white;
	margin: 0 10px 10px;
	padding: 10px;	
}

.post_to_wire input[type="submit"] {
	margin:0;
}

/* reply form */
textarea#thewire_large-textarea {
	width: 648px;
	height: 40px;
	padding: 6px;
	font-size: 100%;
	color:#666666;
}

/* IE 6 fix */
* html textarea#thewire_large-textarea { 
	width: 642px;
}

input.thewire_characters_remaining_field { 
	color:#333333;
	border:none;
	font-size: 100%;
	font-weight: bold;
	padding:0 2px 0 0;
	margin:0;
	text-align: right;
	background: white;
}

input.thewire_characters_remaining_field:focus {
	border:none;
	background:white;
}

.thewire_characters_remaining {
	text-align: right;
}