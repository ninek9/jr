<?php

	/**
	 * Elgg profile image Javascript
	 * 
	 * @package ElggProfile
	 * 
	 * @uses $vars['entity'] The user entity
	 */

//		header("Content-type: text/javascript");
//		header("Pragma: public");
//		header("Cache-Control: public");

?>

var submenuLayer = 1000;

function setup_avatar_menu(parent) {
	if (!parent) {
		parent = document;
	}

	// avatar image menu link
	$(parent).find("div.usericon img").mouseover(function() {
		// find nested avatar_menu_button and show
		$(this.parentNode.parentNode).children(".avatar_menu_button").show();
		$(this.parentNode.parentNode).children("div.avatar_menu_button").addClass("avatar_menu_arrow");
		//$(this.parentNode.parentNode).css("z-index", submenuLayer);
	})
	.mouseout(function() { 
		if($(this).parent().parent().find("div.sub_menu").css('display')!="block") {
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow_on");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow_hover");
			$(this.parentNode.parentNode).children(".avatar_menu_button").hide();
		}
		else {
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow_on");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow_hover");
			$(this.parentNode.parentNode).children(".avatar_menu_button").show();
			$(this.parentNode.parentNode).children("div.avatar_menu_button").addClass("avatar_menu_arrow");
		}
	});


	// avatar contextual menu
	$(".avatar_menu_button img").click(function(e) { 
		
		var submenu = $(this).parent().parent().find("div.sub_menu");
		
		// close submenu if arrow is clicked & menu already open
		if(submenu.css('display') == "block") {
			//submenu.hide(); 		
		}
		else {
			// get avatar dimensions
			var avatar = $(this).parent().parent().parent().find("div.usericon");
			//alert( "avatarWidth: " + avatar.width() + ", avatarHeight: " + avatar.height() );
			
			// move submenu position so it aligns with arrow graphic
			if (e.pageX < 840) { // popup menu to left of arrow if we're at edge of page
			submenu.css("top",(avatar.height()) + "px")
				.css("left",(avatar.width()-15) + "px")
				.fadeIn('normal');	
			}	
			else {
			submenu.css("top",(avatar.height()) + "px")
				.css("left",(avatar.width()-166) + "px")
				.fadeIn('normal');		
			}	
			
			// force z-index - workaround for IE z-index bug			
			avatar.css("z-index",  submenuLayer);
			avatar.find("a.icon img").css("z-index",  submenuLayer);
			submenu.css("z-index", submenuLayer+1);
						
			submenuLayer++;
			
			// change arrow to 'on' state
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow_hover");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").addClass("avatar_menu_arrow_on");
		}
		
		// hide any other open submenus and reset arrows
		$("div.sub_menu:visible").not(submenu).hide();
		$(".avatar_menu_button").removeClass("avatar_menu_arrow");
		$(".avatar_menu_button").removeClass("avatar_menu_arrow_on");
		$(".avatar_menu_button").removeClass("avatar_menu_arrow_hover");
		$(".avatar_menu_button").hide();
		$(this.parentNode.parentNode).children("div.avatar_menu_button").addClass("avatar_menu_arrow_on");
		$(this.parentNode.parentNode).children("div.avatar_menu_button").show();
		//alert("submenuLayer = " +submenu.css("z-index"));
	})
	// hover arrow each time mouseover enters arrow graphic (eg. when menu is already shown)
	.mouseover(function() {
		$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow_on");
		$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow");
		$(this.parentNode.parentNode).children("div.avatar_menu_button").addClass("avatar_menu_arrow_hover");
	})
	// if menu not shown revert arrow, else show 'menu open' arrow
	.mouseout(function() { 
		if($(this).parent().parent().find("div.sub_menu").css('display')!="block"){
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow_hover");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").addClass("avatar_menu_arrow");
		}
		else {
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow_hover");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").removeClass("avatar_menu_arrow");
			$(this.parentNode.parentNode).children("div.avatar_menu_button").addClass("avatar_menu_arrow_on");
		}
	});
	
	// hide avatar menu if click occurs outside of menu	
	// and hide arrow button						
	$(document).click(function(event) { 		
		var target = $(event.target);
		if (target.parents(".usericon").length == 0) {				
			$(".usericon div.sub_menu").fadeOut();
			$(".avatar_menu_button").removeClass("avatar_menu_arrow");
			$(".avatar_menu_button").removeClass("avatar_menu_arrow_on");
			$(".avatar_menu_button").removeClass("avatar_menu_arrow_hover");
			$(".avatar_menu_button").hide();
		}
	});			   
	

}

$(document).ready(function() {

	setup_avatar_menu();
	
	$("#ratingComments").hide();
	$("#ratingSubmit input.submit_button").attr("disabled", "disabled");
	
	$("li.rateone").click(function(){
		$(this).parent().removeClass();
		$(this).parent().addClass("ratingStars onestar");
		$(this).parent().next("label").next("input").attr("value","1");
		if (checkVotes())
		{
			$("#ratingComments").slideDown();
			$("#ratingSubmit input.submit_button").removeAttr("disabled");
			$("#spanYourScore").html(calculateScore());
		}
	});
	$("li.ratetwo").click(function(){
		$(this).parent().removeClass();
		$(this).parent().addClass("ratingStars twostars");
		$(this).parent().next("label").next("input").attr("value","2");
		if (checkVotes())
		{
			$("#ratingComments").slideDown();
			$("#ratingSubmit input.submit_button").removeAttr("disabled");
			$("#spanYourScore").html(calculateScore());
		}
	});
	$("li.ratethree").click(function(){
		$(this).parent().removeClass();
		$(this).parent().addClass("ratingStars threestars");
		$(this).parent().next("label").next("input").attr("value","3");
		if (checkVotes())
		{
			$("#ratingComments").slideDown();
			$("#ratingSubmit input.submit_button").removeAttr("disabled");
			$("#spanYourScore").html(calculateScore());
		}
	});
	$("li.ratefour").click(function(){
		$(this).parent().removeClass();
		$(this).parent().addClass("ratingStars fourstars");
		$(this).parent().next("label").next("input").attr("value","4");
		if (checkVotes())
		{
			$("#ratingComments").slideDown();
			$("#ratingSubmit input.submit_button").removeAttr("disabled");
			$("#spanYourScore").html(calculateScore());
		}
	});
	$("li.ratefive").click(function(){
		$(this).parent().removeClass();
		$(this).parent().addClass("ratingStars fivestars");
		$(this).parent().next("label").next("input").attr("value","5");
		if (checkVotes())
		{
			$("#ratingComments").slideDown();
			$("#ratingSubmit input.submit_button").removeAttr("disabled");
			$("#spanYourScore").html(calculateScore());
		}
	});
	
	$("#ratingSubmit input").click(function(){
		$("#rate").attr("value", calculateScore());
	});
});

function calculateScore() {
		var totalScore = 0;
		totalScore += parseInt($("#psTalent").attr("value"));
		totalScore += parseInt($("#psPhysique").attr("value"));
		totalScore += parseInt($("#psMarketability").attr("value"));
		totalScore += parseInt($("#psWorkEthic").attr("value"));
		totalScore += parseInt($("#psPotential").attr("value"));
		totalScore = totalScore*0.2;
		//alert(totalScore.toPrecision(2));
		return totalScore.toPrecision(2).toString();
}

//  checking to see if a vote has been placed in each of the categories before showing the comments field
function checkVotes() {
	var i = 0;
	if ($("#psTalent").attr("value") > 0)
	{
		i++;
	}
	if ($("#psPhysique").attr("value") > 0)
	{
		i++;
	}
	if ($("#psMarketability").attr("value") > 0)
	{
		i++;
	}
	if ($("#psWorkEthic").attr("value") > 0)
	{
		i++;
	}
	if ($("#psPotential").attr("value") > 0)
	{
		i++;
	}
	
	if (i == 5)
	{
		return true;
	}
	else
	{
		return false;
	}
}
