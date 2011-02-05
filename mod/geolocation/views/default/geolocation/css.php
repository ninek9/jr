<?php
	/**
	* Geolocation Module
	* 
	* @author Pedro Prez
	* @link http://community.elgg.org/pg/profile/pedroprez
	* @copyright (c) Keetup 2009-2010
	* @link http://www.keetup.com/
	* @license GNU General Public License (GPL) version 2
	*/
?>

.container_map{
	background: #99B3CC;
	border-left: 5px solid #99B3CC;
	border-right: 5px solid #99B3CC;
	height:700px;
	width:99%; 
}

.container_map_input, .container_map_output{
	/*-moz-border-radius:8px;
	-webkit-border-radius:8px;
	background: #99B3CC;
	padding: 7px;*/
	height:350px;
	width: 360px;
}

.container_map_input p input {
	background: #999999;
}

.container_staticmap_output{
	/*-moz-border-radius:8px;
	-webkit-border-radius:8px;
	background: #99B3CC;
	padding: 7px;*/
}

.staticmap_profile {}
.staticmap_groups {}
.staticmap_all {
	padding: 12px; 
	width: 448px;
}

.interactivemap_profile {}
.interactivemap_groups { width: 465px; }
.interactivemap_all { margin: 12px; width: 670px; }

.register_map{
	height:388px;
	width:388px;
}

#register-box .go_to_address input[type="text"] {
	width: 340px;
}

.go_to_address ul {
	padding:2px 1px;
}

.go_to_address ul li {
	display:inline;
}

.unknow_error {
	display: none;
}

.map_message_error {
	color: red;
	display: none;
}

/*Output map*/
#profile_info_column_middle p.geo_location, 
#groups_info_column_left p.geo_location,
p.geo_location {
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	background: #F5F5F5;
	margin: 4px 2px 10px;
	padding: 2px 8px;
}

p.geo_location {
	margin-left: 10px;
	margin-right: 10px;
}

.profile_field_info .container_map_output {
	height: 400px;
	width:206px;
}

/*Register*/
.map_register { width: 448px; }

/*Loading*/
.img-loading {
	background: transparent url(<?php echo "{$vars['url']}_graphics/ajax_loader.gif";?>) no-repeat;
	display: block;
	height: 33px;
	margin: 0px auto;
	padding-top: 20px;
	width: 33px;
}	