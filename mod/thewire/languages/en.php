<?php

	$english = array(
	
		/**
		 * Menu items and titles
		 */
	
			'thewire' => "Ticker",
			'thewire:user' => "%s's Ticker",
			'thewire:posttitle' => "%s's notes on the Ticker: %s",
			'thewire:everyone' => "All Ticker Updates",
	
			'thewire:read' => "Ticker",
			
			'thewire:strapline' => "%s",
	
			'thewire:add' => "Post to the Ticker",
		    'thewire:text' => "A note on the Ticker",
			'thewire:reply' => "Reply",
			'thewire:via' => "via",
			'thewire:wired' => "Posted to the Ticker",
			'thewire:charleft' => "characters left",
			'item:object:thewire' => "Ticker Updates",
			'thewire:notedeleted' => "note deleted",
			'thewire:doing' => "What are you doing? Update the Ticker!",
			'thewire:newpost' => 'New Ticker Update',
			'thewire:addpost' => 'Post to the Ticker',

	
        /**
	     * The wire river
	     **/
	        
	        //generic terms to use
	        'thewire:river:created' => "%s posted",
	        
	        //these get inserted into the river links to take the user to the entity
	        'thewire:river:create' => "on the Ticker.",
	        
	    /**
	     * Wire widget
	     **/
	     
	        'thewire:sitedesc' => 'This widget shows the latest site notes posted to the Ticker',
	        'thewire:yourdesc' => 'This widget shows your latest notes posted to the Ticker',
	        'thewire:friendsdesc' => 'This widget will show the latest from your friends on the Ticker',
	        'thewire:friends' => 'Your friends on the Ticker',
	        'thewire:num' => 'Number of items to display',
	        
	        
	
		/**
		 * Status messages
		 */
	
			'thewire:posted' => "Your message was successfully posted to the Ticker.",
			'thewire:deleted' => "Your note was successfully deleted.",
	
		/**
		 * Error messages
		 */
	
			'thewire:blank' => "Sorry; you need to actually put something in the textbox before we can save it.",
			'thewire:notfound' => "Sorry; we could not find the specified note.",
			'thewire:notdeleted' => "Sorry; we could not delete this shout.",
	
	
		/**
		 * Settings
		 */
			'thewire:smsnumber' => "Your SMS number if different from your mobile number (mobile number must be set to public for the wire to be able to use it). All phone numbers must be in international format.",
			'thewire:channelsms' => "The number to send SMS messages to is <b>%s</b>",
			
	);
					
	add_translation("en",$english);

?>