<?php
	/**
	 * Elgg groups plugin language pack
	 *
	 * @package ElggGroups
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	$english = array(

		/**
		 * Menu items and titles
		 */

			'groups' => "Teams",
			'groups:owned' => "Teams you own",
			'groups:yours' => "Your teams",
			'groups:user' => "%s's teams",
			'groups:all' => "All site teams",
			'groups:new' => "Create a new team",
			'groups:edit' => "Edit team",
			'groups:delete' => 'Delete team',
			'groups:membershiprequests' => 'Manage join requests',
			'groups:invitations' => 'Team invitations',

			'groups:icon' => 'Team icon (leave blank to leave unchanged)',
			'groups:name' => 'Team name',
			'groups:username' => 'Team short name (displayed in URLs, alphanumeric characters only)',
			'groups:description' => 'Description',
			'groups:briefdescription' => 'Brief description',
			'groups:interests' => 'Tags',
			'groups:website' => 'Website',
			'groups:members' => 'Team members',
			'groups:membership' => "Team membership permissions",
			'groups:access' => "Access permissions",
			'groups:owner' => "Owner",
			'groups:widget:num_display' => 'Number of teams to display',
			'groups:widget:membership' => 'Team membership',
			'groups:widgets:description' => 'Display the teams you are a member of on your profile',
			'groups:noaccess' => 'No access to team',
			'groups:cantedit' => 'You can not edit this team',
			'groups:saved' => 'Team saved',
			'groups:featured' => 'Featured teams',
			'groups:makeunfeatured' => 'Unfeature',
			'groups:makefeatured' => 'Make featured',
			'groups:featuredon' => 'You have made this team a featured one.',
			'groups:unfeature' => 'You have removed this team from the featured list',
			'groups:joinrequest' => 'Request membership',
			'groups:join' => 'Join team',
			'groups:leave' => 'Leave team',
			'groups:invite' => 'Invite friends',
			'groups:inviteto' => "Invite friends to '%s'",
			'groups:nofriends' => "You have no friends left who have not been invited to this team.",
			'groups:viagroups' => "via teams",
			'groups:group' => "Team",

			'groups:notfound' => "Team not found",
			'groups:notfound:details' => "The requested team either does not exist or you do not have access to it",

			'groups:requests:none' => 'There are no outstanding membership requests at this time.',

			'groups:invitations:none' => 'There are no oustanding invitations at this time.',

			'item:object:groupforumtopic' => "Discussion topics",

			'groupforumtopic:new' => "New discussion post",

			'groups:count' => "teams created",
			'groups:open' => "open team",
			'groups:closed' => "closed team",
			'groups:member' => "members",
			'groups:searchtag' => "Search for teams by tag",


			/*
			 * Access
			 */
			'groups:access:private' => 'Closed - Users must be invited',
			'groups:access:public' => 'Open - Any user may join',
			'groups:closedgroup' => 'This team has a closed membership. To ask to be added, click the "request membership" menu link.',
			'groups:visibility' => 'Who can see this team?',

			/*
			Group tools
			*/
			'groups:enablepages' => 'Enable team pages',
			'groups:enableforum' => 'Enable team discussion',
			'groups:enablefiles' => 'Enable team files',
			'groups:yes' => 'yes',
			'groups:no' => 'no',

			'group:created' => 'Created %s with %d posts',
			'groups:lastupdated' => 'Last updated %s by %s',
			'groups:pages' => 'Team pages',
			'groups:files' => 'Team files',

			/*
			Group forum strings
			*/

			'group:replies' => 'Replies',
			'groups:forum' => 'Team discussion',
			'groups:addtopic' => 'Add a topic',
			'groups:forumlatest' => 'Latest discussion',
			'groups:latestdiscussion' => 'Latest discussion',
			'groups:newest' => 'Newest',
			'groups:popular' => 'Popular',
			'groupspost:success' => 'Your comment was succesfully posted',
			'groups:alldiscussion' => 'Latest discussion',
			'groups:edittopic' => 'Edit topic',
			'groups:topicmessage' => 'Topic message',
			'groups:topicstatus' => 'Topic status',
			'groups:reply' => 'Post a comment',
			'groups:topic' => 'Topic',
			'groups:posts' => 'Posts',
			'groups:lastperson' => 'Last person',
			'groups:when' => 'When',
			'grouptopic:notcreated' => 'No topics have been created.',
			'groups:topicopen' => 'Open',
			'groups:topicclosed' => 'Closed',
			'groups:topicresolved' => 'Resolved',
			'grouptopic:created' => 'Your topic was created.',
			'groupstopic:deleted' => 'The topic has been deleted.',
			'groups:topicsticky' => 'Sticky',
			'groups:topicisclosed' => 'This topic is closed.',
			'groups:topiccloseddesc' => 'This topic has now been closed and is not accepting new comments.',
			'grouptopic:error' => 'Your team topic could not be created. Please try again or contact a system administrator.',
			'groups:forumpost:edited' => "You have successfully edited the forum post.",
			'groups:forumpost:error' => "There was a problem editing the forum post.",
			'groups:privategroup' => 'This team is private, requesting membership.',
			'groups:notitle' => 'Teams must have a title',
			'groups:cantjoin' => 'Can not join team',
			'groups:cantleave' => 'Could not leave team',
			'groups:addedtogroup' => 'Successfully added the user to the team',
			'groups:joinrequestnotmade' => 'Could not request to join team',
			'groups:joinrequestmade' => 'Requested to join team',
			'groups:joined' => 'Successfully joined team!',
			'groups:left' => 'Successfully left team',
			'groups:notowner' => 'Sorry, you are not the owner of this team.',
			'groups:notmember' => 'Sorry, you are not a member of this team.',
			'groups:alreadymember' => 'You are already a member of this team!',
			'groups:userinvited' => 'User has been invited.',
			'groups:usernotinvited' => 'User could not be invited.',
			'groups:useralreadyinvited' => 'User has already been invited',
			'groups:updated' => "Last comment",
			'groups:invite:subject' => "%s you have been invited to join %s!",
			'groups:started' => "Started by",
			'groups:joinrequest:remove:check' => 'Are you sure you want to remove this join request?',
			'groups:invite:body' => "Hi %s,

%s invited you to join the '%s' team, click below to confirm:

%s",

			'groups:welcome:subject' => "Welcome to the %s team!",
			'groups:welcome:body' => "Hi %s!

You are now a member of the '%s' team! Click below to begin posting!

%s",

			'groups:request:subject' => "%s has requested to join %s",
			'groups:request:body' => "Hi %s,

%s has requested to join the '%s' team, click below to view their profile:

%s

or click below to confirm request:

%s",

			/*
				Forum river items
			*/

			'groups:river:member' => 'is now a member of',
			'groupforum:river:updated' => '%s has updated',
			'groupforum:river:update' => 'this discussion topic',
			'groupforum:river:created' => '%s has created',
			'groupforum:river:create' => 'a new discussion topic titled',
			'groupforum:river:posted' => '%s has posted a new comment',
			'groupforum:river:annotate:create' => 'on this discussion topic',
			'groupforum:river:postedtopic' => '%s has started a new discussion topic titled',
			'groups:river:member' => '%s is now a member of',
			'groups:river:togroup' => 'to the team',

			'groups:nowidgets' => 'No widgets have been defined for this team.',


			'groups:widgets:members:title' => 'Team members',
			'groups:widgets:members:description' => 'List the members of a team.',
			'groups:widgets:members:label:displaynum' => 'List the members of a team.',
			'groups:widgets:members:label:pleaseedit' => 'Please configure this widget.',

			'groups:widgets:entities:title' => "Objects in team",
			'groups:widgets:entities:description' => "List the objects saved in this team",
			'groups:widgets:entities:label:displaynum' => 'List the objects of a team.',
			'groups:widgets:entities:label:pleaseedit' => 'Please configure this widget.',

			'groups:forumtopic:edited' => 'Forum topic successfully edited.',

			'groups:allowhiddengroups' => 'Do you want to allow private (invisible) teams?',

			/**
			 * Action messages
			 */
			'group:deleted' => 'Team and team contents deleted',
			'group:notdeleted' => 'Team could not be deleted',

			'grouppost:deleted' => 'Team posting successfully deleted',
			'grouppost:notdeleted' => 'Team posting could not be deleted',
			'groupstopic:deleted' => 'Topic deleted',
			'groupstopic:notdeleted' => 'Topic not deleted',
			'grouptopic:blank' => 'No topic',
			'grouptopic:notfound' => 'Could not find the topic',
			'grouppost:nopost' => 'Empty post',
			'groups:deletewarning' => "Are you sure you want to delete this team? There is no undo!",

			'groups:joinrequestkilled' => 'The join request has been deleted.',
	);

	add_translation("en",$english);
?>
