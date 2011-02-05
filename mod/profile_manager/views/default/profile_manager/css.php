<?php 
	/**
	* Profile Manager
	* 
	* CSS
	* 
	* @package profile_manager
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
?>
#custom_fields_ordering {
	width: 518px;
	float: left;
}

.custom_fields_ordering_group {
	width: inherit !important;
	float: none !important;
}

#custom_fields_lists{
	width: 183px;
	float: right;
}

.custom_fields_lists_green {
	border-color: green !important; 
}

#custom_fields_category_list .ui-sortable{
	min-height: 0px;
}

#custom_fields_category_list .droppable-hover{
	background: #BBDAF7;
}

#profile_type {
	height: 27px;
	padding: 4px 10px;
	background-image: url(<?php echo $vars['url']?>_graphics/jr/gradient_1_gray.png);
	background-position: top left;
	background-repeat: repeat-x;
	height: 35px;
	padding: 0;
	width: 100%;
	border-right: 1px solid #d9d9d9;
	border-left: 1px solid #f1ef53;
}

#profile_type label {
	background-image: url(<?php echo $vars['url']?>_graphics/jr/gradient_1_yellow.png);
	background-position: top left;
	background-repeat: repeat-x;
	display: inline-block;
	height: 35px;
	line-height: 35px;
	margin: 0;
	padding: 0 15px 0 10px;
	float: left;
}

#profile_type_desc {
	background-image: url(<?php echo $vars['url']?>_graphics/jr/yellow_arrow.png);
	background-position: top left;
	background-repeat: no-repeat;
	height: 35px;
	line-height: 35px;
	display: inline-block;
	margin: 0;
	padding: 0 0 0 20px;
}

.custom_fields_category,
.custom_profile_type  {
	width: 100%;
	border: 1px solid #CCCCCC;
	border-left: 5px solid #CCCCCC;
	margin-bottom: 2px;
	padding: 1px;
	word-wrap: break-word;
	background-color: white; /* fix so pickup of draggable will work in IE (7) */
}

.custom_profile_type {
	border-left: 1px solid #CCCCCC;
}

.custom_profile_type_description {
	display: none;
	margin-bottom: 10px;
}

.custom_fields_category_selected {
	border-color: #4690D6;
}

.custom_fields_category_edit,
.custom_profile_type_edit {
	cursor: pointer;
	width: 16px;
	height: 16px;
	background: url(<?php echo $vars['url']?>mod/profile_manager/_graphics/edit.png);
	margin-top: 1px;
	float: right;
}

.custom_fields_category_delete_button,
.custom_fields_profile_type_delete_button {
	display: none;
}

#custom_fields_category_list_custom .custom_fields_category { 
	cursor: move;
}

#custom_fields_ordering .search_listing {
	border: 1px solid #CCCCCC;
	cursor: move;
}

#custom_fields_ordering .search_listing_icon img {
	width: 16px;
	cursor: pointer;
}

#custom_fields_ordering .search_listing_info {
	min-height: 0px;
	margin-left: 25px;
}

#custom_fields_form, 
#custom_fields_category_form,
#custom_fields_profile_type_form {
	display: none;
}

#custom_fields_ordering.ui-sortable {
	min-height: 0px;
}
#custom_fields_category_list_custom .ui-sortable-helper,
#custom_fields_ordering .ui-sortable-helper {
	width: 100%;
}

.metadata_config_right{
	float: right;
}

.metadata_config_left{
	float: left;
}

.metadata_config_left_extra{
	display:none;
}

.metadata_config_right_status {
	width: 16px;
	height: 13px;
	display: inline-block;
	cursor: default;
	background: url(<?php echo $vars['url'];?>mod/profile_manager/_graphics/field_metadata_status.png);
}

.metadata_config_right_status_enabled{
	background-position: 0 -16px;
	cursor: pointer;
}

.metadata_config_right_status_disabled{
	background-position: 0 -32px;
	cursor: pointer;
}

.datepicker_hidden{
	display: none;
}

.custom_fields_add_form_table,
.custom_fields_add_form_table_left {
	width: 100%;
}

.custom_fields_add_form_table_right {
	white-space: nowrap;
}

.custom_fields_add_form_table_right label{
	font-size:inherit;
	font-weight:inherit;
}
.custom_fields_add_form_table_right .input-checkboxes{
	vertical-align: middle;
}

/* actions */
.custom_profile_fields_actions_list td{
	vertical-align: middle;
	padding-left: 5px;
	font-size:90%;
}

#restoreForm {
	display: none;
}

/* end actions */

.custom_fields_more_info {
	width: 14px;
	height: 14px;
	float: right;
	background: url(<?php echo $vars['url'];?>_graphics/icon_customise_info.gif);
	cursor: pointer;
}

.custom_fields_more_info_text {
	display:none;
}

#custom_fields_more_info_tooltip {
	position:absolute;
	border:1px solid #333333;
	background:#e4ecf5;
	color:#333333;
	padding:5px;
	display:none;
	width: 250px;
	line-height: 1.2em;
	font-size: 90%;
}

/* fix for max-height multi-select drop down*/
.ui-dropdownchecklist-dropcontainer {
	max-height: 150px;
}
/* end fix */

/* user details */
#custom_fields_userdetails {
	margin: 2px 0;
}

#custom_fields_userdetails div {
	display: inline-block;
	display: block;
	overflow: hidden;
	clear: both;
}

#custom_fields_userdetails h3 {
	padding: 1px;
	border-bottom: 1px solid #ccc;
	clear: both;
	margin-top: 12px;
}


.ui-accordion-header {
	
	border: 1px solid #CCCCCC;
	cursor: pointer;
	margin-top:2px;
}

.ui-accordion-header:hover {
	background: #DEDEDE;
}

.ui-accordion-header .accordion-icon {
	margin-top: 1px;
	background: url(<?php echo $vars['url'];?>mod/profile_manager/_graphics/accordion.png) no-repeat -16px 0;
	width: 16px;
	height: 16px;
	float: left;
}

.ui-accordion-header:hover .accordion-icon{
	background-position: -32px 0;
}


.ui-accordion-header.selected .accordion-icon {
	background-position: 0 0;
}

.submit_button {

	width: 1;  /* IE table-cell margin fix */
    overflow: visible; /* IE table-cell margin fix */
}

.submit_button[type="reset"] {
	background-position: -583px -1px;
	width: 54px;
	height: 27px;
}


/* non_editables */

.hidden_non_editable {
	display: none;
}
/* end non_editables */

/* full profile */
#custom_profile_fields_full_profile_icon {
	
	padding: 10px 20px;
}

#custom_profile_fields_full_profile_details {
	width: 100%;
}

#custom_profile_fields_full_profile_details h3 {
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	border: none;
	background:#E4E4E4 none repeat scroll 0 0;
	color:#333333;
	font-size:1.1em;
	line-height:1em;
	margin:0 0 10px;
	padding:5px;
}

#custom_profile_fields_full_profile_details .profile_status {
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	background:#E3E3ED none repeat scroll 0 0;
	line-height:1.2em;
	padding:2px 4px;
}

.profile_manager_profile_edit_tab_content,
li.custom_fields_edit_profile_category {
	display: none;
}

#profile_manager_profile_edit_tab_content_wrapper {
	margin-top: 15px;
}

.profile_manager_profile_edit_tab_content p {
	width: 322px;
	float: left;
	background-image: url(<?php echo $vars['url'];?>_graphics/jr/gradient_1_main.png);
	background-position: top left;
	background-repeat: repeat-x;
}

.profile_manager_profile_edit_tab_content p.right {
	margin-left: 15px;
}

.profile_manager_profile_edit_tab_content p label {
	width: 208px;
	float: left;
	font-weight: bold;
	color: #fff;
	padding: 2px 5px;
}

.profile_manager_profile_edit_tab_content p select {
	width: 100px;
	font-size: 9px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	border-color: #777;
}

.profile_manager_profile_edit_tab_content p select.input-access {
	margin-top: 2px;
}

.profile_manager_profile_edit_tab_content p input {
	margin: 5px 0 0;
	width: 318px;
}


/* Profile Manager Members Search Form */
#profile_manager_members_search_form{
	float: left; 
	width: 250px;
}

#profile_manager_members_search_form h3{
	cursor: pointer;
}

#members_search_result{
	float: right; 
	width: 619px;
}

.profile_manager_members_wait{
	cursor: wait !important;
}

.profileFields input {
	background: #ddd;
	background-image: none;
	text-indent: 0;
	width: auto;
	font-size: 1em;
	line-height: 1em;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border: 1px solid #aaa;
	border-color: #aaa #898989 #898989 #aaa;
}

.profileFields input:hover {
	background: #eee;
}

div.mceEditor {
	width: 100%;
}