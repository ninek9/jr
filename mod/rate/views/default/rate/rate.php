<?php
/**
 *	RATE PLUGIN
 *	@package rate
 *	@author Miguel Montes mmontesp@gmail.com
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) Miguel Montes 2008
 *	@link http://community.elgg.org/pg/profile/mmontesp
 **/

//extend_view()

$opt = array(elgg_echo("rate:0")=>0, elgg_echo("rate:1")=>1, elgg_echo("rate:2")=>2, elgg_echo("rate:3")=>3, elgg_echo("rate:4")=>4, elgg_echo("rate:5")=>5);

$ratings = $vars['entity']->getAnnotations('generic_rate');
$rate = 0;
foreach ($ratings as $rating) {
	$rate += $rating->value;
}

// user_guid is the person viewing the page in this context. -eric, 1/24/10
$user_guid = $_SESSION['guid'];
$rate = (double) $rate / $vars['entity']->countAnnotations('generic_rate');
$image = round($rate*2,0);
$rate = round($rate, 1);

// create the modal that will popup with all ratings.  while doing this, retrieve the viewers rating of the person if it exists.
echo "<div id=\"allRatings\"><div id=\"psContent\"><span id=\"psScoreSpan\">$rate</span><img src='{$CONFIG->wwwroot}mod/rate/_graphics/$image.png' alt='$rate' title='$rate'/>" . $vars['entity']->name . "</div>";

$comments = $vars['entity']->getAnnotations('rate_comment');

$rowCounter = 1;

foreach ($ratings as $rating) {
		echo "<div class=\"rateListing";
		if ($rowCounter % 2 == 0) {
				 echo " even\">";
		} else {
				echo "\"";
		}
		$commenter = get_user($rating->owner_guid);
		echo "<p class=\"rateListingValue\">" . $rating->value . "</p><h4>" . $commenter->name . "</h4>";
		if ($rating->owner_guid == $user_guid) {
				$yourRating = $rating->value;
				//break;
		}
		foreach ($comments as $comment) {
				if ($comment->owner_guid == $rating->owner_guid) {
						if ($comment->value == "") {
								echo "<p><em>" . $commenter->name . " did not leave a comment. Take that up with him, tough guy.</em></p>";
						} else {
								echo "<p>" . $comment->value . "</p>";
						}
				}
				if ($comment->owner_guid == $user_guid) {
						$yourComment = $comment->value;
						//break;
				}
		}
		echo "</div>";
		$rowCounter++;
}

echo "</div>";

echo "<div id=\"powerScore\">";
echo "<h2><img id=\"powerScoreCorner\" src=\"" . $vars['url'] . "_graphics/jr/powerscore_corner.gif\" /><img id=\"powerScoreTitle\" src=\"" . $vars['url'] . "_graphics/jr/powerscore_title.png\" /><img id=\"powerScoreQuestionMark\" src=\"" . $vars['url'] . "_graphics/jr/question_mark.png\" /></h2><div id=\"psContent\">";

if ($rate == 0) {
		echo "<img src='{$CONFIG->wwwroot}mod/rate/_graphics/0.png' alt='0' title='0'/><span id=\"psVotesSpan\">(Not rated)</span></div>";
} else {
		echo "<span id=\"psScoreSpan\">$rate</span><img src='{$CONFIG->wwwroot}mod/rate/_graphics/$image.png' alt='$rate' title='$rate'/><span id=\"psVotesSpan\">(<a>".$vars['entity']->countAnnotations('generic_rate')." ".elgg_echo("rate:rates")."</a>)</span></div>";
}

//We show the form if the user is logged in and hasn't rated yet
gatekeeper();

//if (!count_annotations($vars['entity']->guid, $vars['entity']->getType(), $vars['entity']->getSubtype(), 'generic_rate', "", "", $_SESSION['guid'])){
if (allow_rate($vars['entity'])) {
		echo "<div id=\"rateAthleteHeader\">Rate This Athlete</div>";
		
		$form_body = "<p><label>".elgg_echo("rate:text")."</label></p>";
		$form_body = elgg_view('input/hidden', array('internalname' => 'guid', 'value' => $vars['entity']->getGUID()));
		
		$form_body .= "<div class=\"ratingCategory\"><ul class=\"ratingStars nostars\">" . elgg_view('input/rate', array('internalname' => 'rate', 'options' => $opt)) . "</ul><label class=\"rateLabel\">Natural Talent</label><input type=\"hidden\" id=\"psTalent\" name=\"psTalent\"></input></div>";
		$form_body .= "<div class=\"ratingCategory\"><ul class=\"ratingStars nostars\">" . elgg_view('input/rate', array('internalname' => 'rate', 'options' => $opt)) . "</ul><label class=\"rateLabel\">Physique</label><input type=\"hidden\" id=\"psPhysique\" name=\"psPhysique\"></input></div>";
		$form_body .= "<div class=\"ratingCategory\"><ul class=\"ratingStars nostars\">" . elgg_view('input/rate', array('internalname' => 'rate', 'options' => $opt)) . "</ul><label class=\"rateLabel\">Marketability</label><input type=\"hidden\" id=\"psMarketability\" name=\"psMarketability\"></input></div>";
		$form_body .= "<div class=\"ratingCategory\"><ul class=\"ratingStars nostars\">" . elgg_view('input/rate', array('internalname' => 'rate', 'options' => $opt)) . "</ul><label class=\"rateLabel\">Work Ethic</label><input type=\"hidden\" id=\"psWorkEthic\" name=\"psWorkEthic\"></input></div>";
		$form_body .= "<div class=\"ratingCategory\"><ul class=\"ratingStars nostars\">" . elgg_view('input/rate', array('internalname' => 'rate', 'options' => $opt)) . "</ul><label class=\"rateLabel\">Potential</label><input type=\"hidden\" id=\"psPotential\" name=\"psPotential\"></input></div>";
		
		$form_body .= "<div id=\"ratingComments\">Your score: <span id=\"spanYourScore\"></span><br />Back up your rating with a good reason, or not.<br /><textarea rows=\"1\" cols=\"19\" id=\"psComments\" name=\"psComments\" style=\"margin-top:3px;\"></textarea></div>";
		
		$form_body .= "<input type=\"hidden\" id=\"rate\" name=\"rate\" ></input>";
		
		$form_body .= "<div id=\"ratingSubmit\">" . elgg_view('input/submit', array('value' => elgg_echo("rate:rateit"))) . "</div>";
		
		$form_body .= "<div class=\"clearfloat\"></div>";
		echo elgg_view('input/form', array('body' => $form_body, 'action' => "{$vars['url']}action/rate/add"));	
} else {
		// TROUBLESHOOTING
		$viewer = get_loggedin_user();
		/*echo $vars['entity']->getAnnotationsSum('generic_rate');
		echo " - ";
		echo $rate;
		echo " - ";
		echo gettype($rate);
		echo " - ";
		echo $viewer->guid;
		echo " - ";
		echo $vars['entity']->guid;*/
		if ($viewer->guid == $vars['entity']->guid) {
				echo "<div id=\"rateAthleteHeader\" class=\"rated\"><strong>You can't rate yourself.</strong></div>";
		} else {
				echo "<div id=\"rateAthleteHeader\" class=\"rated\"><strong>You've rated this athlete!</strong><br />";
				echo "Overall, you gave them a " . $yourRating . "<br />";
				echo "and said <em>\"" . $yourComment . "\"</em>.";
				echo "</div>";
		}
}
echo "</div>";
?>