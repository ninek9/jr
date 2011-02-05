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

	$english = array(

		'item:object:feedback' => 'Feedback',
		'feedback:label' => 'Feedback',
		'feedback:title' => 'Feedback',

		'feedback:message' => 'Love it? Hate it? Want to suggest new features or report a bug? We would love to hear from you.',
		
		'feedback:default:id' => 'Name and/or Email',
		'feedback:default:txt' => 'Let us know what you think!',
		'feedback:default:txt:err' => 'No feedback message has been provided.\nWe value your suggestions and criticisms.\nPlease enter your message and press Send.',

		'feedback:captcha:blank' => 'No captcha input provided',
		
		'feedback:submit_msg' => 'Submitting...',
		'feedback:submit_err' => 'Could not submit feedback!',
		
		'feedback:submit:error' => 'Could not submit feedback!',
		'feedback:submit:success' => 'Feedback submitted successfully. Thank you!',
		
		'feedback:admin:menu' => 'Feedback for Site',
		'feedback:admin:title' => 'Site Feedback',
		
		'feedback:delete:success' => 'Feedback was deleted successfully',
		
		'feedback:mood:' => 'None',
		'feedback:mood:angry' => 'Angry',
		'feedback:mood:neutral' => 'Neutral',
		'feedback:mood:happy' => 'Happy',

		'feedback:about:' => 'None',
		'feedback:about:bug_report' => 'Bug Report',
		'feedback:about:content' => 'Content',
		'feedback:about:suggestions' => 'Suggestions',
		'feedback:about:compliment' => 'Compliment',
		'feedback:about:other' => 'Other',
		
		'feedback:list:mood' => 'Mood',
		'feedback:list:about' => 'About',
		'feedback:list:page' => 'Submit Page',
		'feedback:list:from' => 'From',
		
		'feedback:user_1' => "User Name 1: ",
		'feedback:user_2' => "User Name 2: ",
		'feedback:user_3' => "User Name 3: ",
		'feedback:user_4' => "User Name 4: ",
		'feedback:user_5' => "User Name 5: ",
		
		'feedback:email:subject' => 'Received feedback from %s',
		'feedback:email:body' => '%s',
	);
					
	add_translation("en",$english);
?>