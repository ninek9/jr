<?php

	/**
	 * Elgg blog CSS extender
	 * 
	 * @package ElggBlog
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

?>


.singleview {
	margin-top: 10px;
}

.blog_post_icon {
	float: left;
	margin: 3px 0 0;
	padding: 0;
}

.blog_post h3 {
	font-size: 150%;
	margin: 0 0 10px 0;
	padding: 0;
}

.blog_post h3 a {
	text-decoration: none;
}

.blog_post p {
	margin: 5px 0;
}

.blog_post_body {
	margin: 20px 0;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
}

.blog_post .strapline {
	margin: 0 0 0 35px;
	padding: 0;
	color: #aaa;
	line-height: 1em;
}

.blog_post p.tags {
	background: transparent url(<?php echo $vars['url']; ?>_graphics/icon_tag.gif) no-repeat scroll left 2px;
	margin: 0 0 7px 35px;
	padding: 0 0 0 16px;
	min-height: 22px;
}

.blog_post .options {
	margin: 0;
	padding: 0;
}

.blog_post_body img[align="left"] {
	margin: 10px 10px 10px 0;
	float: left;
}

.blog_post_body img[align="right"] {
	margin: 10px 0 10px 10px;
	float: right;
}

.blog_post_body img {
	margin: 10px !important;
}

.blog-comments h3 {
	font-size: 150%;
	margin-bottom: 10px;
}

.blog-comment {
	margin-top: 10px;
	margin-bottom: 20px;
	border-bottom: 1px solid #aaaaaa;
}

.blog-comment img {
	float: left;
	margin: 0 10px 0 0;
}

.blog-comment-menu {
	margin:0;
}

.blog-comment-byline {
	background: #dddddd;
	height: 22px;
	padding-top: 3px;
	margin: 0;
}

.blog-comment-text {
	margin: 5px 0;
}

/* New blog edit column */
#blog_edit_page {
	/* background: #bbdaf7; */
	margin-top: -10px;
}

#blog_edit_page #content_area_user_title h2 {
	background: none;
	border-top: none;
	margin: 0 0 10px 0px;
	padding: 0;
}

#blog_edit_page #blog_edit_sidebar #content_area_user_title h2 {
	background: none;
	border-top: none;
	margin: inherit;
	padding: 0 0 5px 5px;
	font-size: 1.25em;
	line-height: 1.2em;
}

#blog_edit_page #blog_edit_sidebar {
	margin: 0 0 22px;
	background: #dedede;
	padding: 5px;
}

#blog_edit_page #two_column_left_sidebar_210 {
	width: 210px;
	margin: 0 0 20px;
	min-height: 360px;
	float: left;
	padding: 0;
}

#blog_edit_page #two_column_left_sidebar_maincontent {
	margin: 0 0 20px 20px;
	padding: 10px 20px 20px;
	width: 640px;
}

/* unsaved blog post preview */
.blog_previewpane {
    border: 1px solid #D3322A;
    background: #F7DAD8;
	padding: 10px;
	margin: 10px;	
}

.blog_previewpane p {
	margin: 0;
}

#blog_edit_sidebar .publish_controls,
#blog_edit_sidebar .blog_access,
#blog_edit_sidebar .publish_options,
#blog_edit_sidebar .publish_blog,
#blog_edit_sidebar .allow_comments,
#blog_edit_sidebar .categories {
	margin: 0 5px 5px;
	border-top: 1px solid #cccccc;
}

#blog_edit_page ul {
	padding-left: 0px;
	margin: 5px 0;
	list-style: none;
}

#blog_edit_page p {
	margin: 5px 0;
}

#blog_edit_page #two_column_left_sidebar_maincontent p {
	margin: 0 0 15px;
}

#blog_edit_page .publish_blog input[type="submit"] {
	
}

#blog_edit_page .preview_button a {
	font-weight: bold;
	background: white;
	border: 1px solid #ccc;
	border-bottom-color: #aaa;
	border-right-color: #aaa;
	color: #999999;
	width: auto;
	height: auto;
	padding: 3px;
	margin: 13px 1px 5px 10px;
	cursor: pointer;
	float: right;
}

#blog_edit_page .preview_button a:hover {
	background: #4690D6;
	color: white;
	text-decoration: none;
	border: 1px solid #4690D6;
}

#blog_edit_page .allow_comments label {
	font-size: 100%;
}