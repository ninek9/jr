<?php

	/**
     * Elgg Feedback plugin
     * Feedback interface for Elgg sites
     * 
     * @package Feedback
     * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
     * @author Prashant Juvekar
     * @copyright Prashant Juvekar
     * @link http://www.linkedin.com/in/prashantjuvekar
	 */

?>

#feedbackWrapper {
	position: fixed;
	top: 148px;
	left: 0;
	width: 450px;
	z-index: 100000; 
}

#feedBackToggler {
	float: left;
}

#feedBackContent {
	width: 400px;
	display: none;
	overflow: hidden;
	float: left;
	border: solid #ccc 1px;
	background-color: #ffffe0;
}

#feedbackError {
	color: #ff0000;
}

#feedbackSuccess {
	color: #00ff00;
}

.feedbackLabel {
}

.feedbackText {
	width:350px;  
}

.feedbackTextbox {
	width:350px;  
	height:75px;
}
 
.captcha {
	padding:10px;
}
.captcha-left {
	float:left;
	border:1px solid #0000ff;
}
.captcha-middle {
	float:left;
}
.captcha-right {
	float:left;
}
.captcha-input-text {
	width:100px;
}
