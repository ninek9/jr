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

	/**
	 * Return entities within a given geographic area.
	 *
	 * @param real $lat_min Latitude Southwest
	 * @param real $long_min Longitude Southwest
	 * @param real $lat_max Latitude Northeast
	 * @param real $long_max Longitude Northeast
	 * @param int $category_id Category of the entity
	 * @param int $subcategory_id Subcategory of the entity
	 * @param string $keyword Keyword for search a word 
	 * @param string $type The type of entity (eg "user", "object" etc)
	 * @param string $subtype The arbitrary subtype of the entity
	 * @param int $owner_guid The GUID of the owning user
	 * @param string $order_by The field to order by; by default, time_created desc
	 * @param int $limit The number of entities to return; 10 by default
	 * @param int $offset The indexing offset, 0 by default
	 * @param boolean $count Set to true to get a count rather than the entities themselves (limits and offsets don't apply in this context). Defaults to false.
	 * @param int $site_guid The site to get entities for. Leave as 0 (default) for the current site; -1 for all sites.
	 * @param int|array $container_guid The container or containers to get entities from (default: all containers).
	 * @return array A list of entities. 
	 */
	function geolocation_get_entities_inside_bounds($lat_min, $long_min, $lat_max, $long_max, $category_id = null, $subcategory_id = null, $keyword = null, $type = "", $subtype = "", $owner_guid = 0, $order_by = "", $limit = 10, $offset = 0, $count = false, $site_guid = 0, $container_guid = null)
	{
		global $CONFIG;
		
		if ($subtype === false || $subtype === null || $subtype === 0)
			return false;
			
		$lat = (real)$lat;
		$long = (real)$long;
		$radius = (real)$radius;

		$order_by = sanitise_string($order_by);
		$limit = (int)$limit;
		$offset = (int)$offset;
		$site_guid = (int) $site_guid;
		if ($site_guid == 0)
			$site_guid = $CONFIG->site_guid;
			
		$where = array();
		
		if (is_array($type)) {			
			$tempwhere = "";
			if (sizeof($type))
			foreach($type as $typekey => $subtypearray) {
				foreach($subtypearray as $subtypeval) {
					$typekey = sanitise_string($typekey);
					if (!empty($subtypeval)) {
						$subtypeval = (int) get_subtype_id($typekey, $subtypeval);
					} else {
						$subtypeval = 0;
					}
					if (!empty($tempwhere)) $tempwhere .= " or ";
					$tempwhere .= "(e.type = '{$typekey}' and e.subtype = {$subtypeval})";
				}								
			}
			if (!empty($tempwhere)) $where[] = "({$tempwhere})";
			
		} else {
		
			$type = sanitise_string($type);
			$subtype = get_subtype_id($type, $subtype);
			
			if ($type != "")
				$where[] = "e.type='$type'";
			if ($subtype!=="")
				$where[] = "e.subtype=$subtype";
				
		}

		if ($owner_guid != "") {
			if (!is_array($owner_guid)) {
				$owner_array = array($owner_guid);
				$owner_guid = (int) $owner_guid;
				$where[] = "e.owner_guid = '$owner_guid'";
			} else if (sizeof($owner_guid) > 0) {
				$owner_array = array_map('sanitise_int', $owner_guid);
				// Cast every element to the owner_guid array to int
				$owner_guid = implode(",",$owner_guid); //
				$where[] = "e.owner_guid in ({$owner_guid})" ; //
			}
			if (is_null($container_guid)) {
				$container_guid = $owner_array;
			}
		}
		
		if ($site_guid > 0)
			$where[] = "e.site_guid = {$site_guid}";
			
		if (!is_null($container_guid)) {
			if (is_array($container_guid)) {
				foreach($container_guid as $key => $val) $container_guid[$key] = (int) $val;
				$where[] = "e.container_guid in (" . implode(",",$container_guid) . ")";
			} else {
				$container_guid = (int) $container_guid;
				$where[] = "e.container_guid = {$container_guid}";
			}
		}	
	
		// Add the calendar stuff
		$loc_join = "
			JOIN {$CONFIG->dbprefix}metadata loc_start on e.guid=loc_start.entity_guid
			JOIN {$CONFIG->dbprefix}metastrings loc_start_name on loc_start.name_id=loc_start_name.id
			JOIN {$CONFIG->dbprefix}metastrings loc_start_value on loc_start.value_id=loc_start_value.id
			
			JOIN {$CONFIG->dbprefix}metadata loc_end on e.guid=loc_end.entity_guid
			JOIN {$CONFIG->dbprefix}metastrings loc_end_name on loc_end.name_id=loc_end_name.id
			JOIN {$CONFIG->dbprefix}metastrings loc_end_value on loc_end.value_id=loc_end_value.id
		";
		
		$where[] = "loc_start_name.string='geo:lat'";
		$where[] = "loc_start_value.string>=$lat_min";
		$where[] = "loc_start_value.string<=$lat_max";
		$where[] = "loc_end_name.string='geo:long'";
		$where[] = "loc_end_value.string >= $long_min";
		$where[] = "loc_end_value.string <= $long_max";
		
		//Add support for filter
		$category_id = clear_category($category_id);
		if ($category_id) {
			$loc_join .= "
			
				JOIN {$CONFIG->dbprefix}metadata loc_cat on e.guid=loc_cat.entity_guid
				JOIN {$CONFIG->dbprefix}metastrings loc_cat_name on loc_cat.name_id=loc_cat_name.id
				JOIN {$CONFIG->dbprefix}metastrings loc_cat_value on loc_cat.value_id=loc_cat_value.id
			";
			
			$where[] = "loc_cat_name.string='category'";
			$where[] = "loc_cat_value.string = '{$category_id}'";
		}
		
		$subcategory_id = clear_category($subcategory_id);
		if ($subcategory_id) {
			$loc_join .= "
			
				JOIN {$CONFIG->dbprefix}metadata loc_subcat on e.guid=loc_subcat.entity_guid
				JOIN {$CONFIG->dbprefix}metastrings loc_subcat_name on loc_subcat.name_id=loc_subcat_name.id
				JOIN {$CONFIG->dbprefix}metastrings loc_subcat_value on loc_subcat.value_id=loc_subcat_value.id
			";
			
			$where[] = "loc_subcat_name.string='subcategory'";
			$where[] = "loc_subcat_value.string = '{$subcategory_id}'";
		}
		
		if ($keyword && !empty($keyword)) {
			$loc_join .= "
			
				LEFT JOIN {$CONFIG->dbprefix}objects_entity loc_object on e.guid=loc_object.guid
				LEFT JOIN {$CONFIG->dbprefix}groups_entity loc_group on e.guid=loc_group.guid
			    LEFT JOIN {$CONFIG->dbprefix}users_entity loc_user on e.guid=loc_user.guid
			";
			
			$where[] = "(loc_object.title LIKE '%$keyword%' or loc_object.description LIKE '%$keyword%' or loc_group.name LIKE '%$keyword%' or loc_group.description LIKE '%$keyword%' or loc_user.name LIKE '%$keyword%')";
		}
		
		if (!$count) {
			$query = "SELECT e.* from {$CONFIG->dbprefix}entities e $loc_join where ";
		} else {
			$query = "SELECT count(e.guid) as total from {$CONFIG->dbprefix}entities e $loc_join where ";
		}
		foreach ($where as $w)
			$query .= " $w and ";
			
		$query .= get_access_sql_suffix('e'); // Add access controls
		
		if (!$count) {
			//$query .= " order by n.calendar_start $order_by";
			$query .= " $order_by";
			if ($limit) $query .= " limit $offset, $limit"; // Add order and limit
			$dt = get_data($query, "entity_row_to_elggstar");
			return $dt;
		} else {
			$total = get_data_row($query);
			return $total->total;
		}	
	}


	function geolocation_clean_text($str) {
		$str = utf8_decode($str);
		return (str_replace(array(
									'\\\u00e1',
								 	'\\\u00c1',
								 	'\\\u00e9',
								 	'\\\u00c9',
								 	'\\\u00ed',
								 	'\\\u00cd',
								 	'\\\u00f3',
								 	'\\\u00d3',
								 	'\\\u00fa',
								 	'\\\u00dA',
								 	'\\\u00f1',
								 	'\\\u00d1',
									//NCR hexadecimal. Todas las NCR comienzan con &# y terminan con ;. La x indica que lo que sigue es un número hexadecimal que representa el valor escalar de un carácter Unicode, es decir, el número asignado a las tablas de códigos Unicode. El número hexadecimal no distingue mayúsculas de minúsculas.
									'&#xe1;',
								 	'&#xc1;',
								 	'&#xe9;',
								 	'&#xc9;',
								 	'&#xed;',
								 	'&#xcd;',
								 	'&#xf3;',
								 	'&#xd3;',
								 	'&#xfa;',
								 	'&#xdA;',
								 	'&#xf1;',
								 	'&#xd1;',
									//Son igual a los 12 anteriores solo que difiere la forma de representarlo
									'\xe1',
								 	'\xc1',
								 	'\xe9',
								 	'\xc9',
								 	'\xed',
								 	'\xcd',
								 	'\xf3',
								 	'\xd3',
								 	'\xfa',
								 	'\xdA',
								 	'\xf1',
								 	'\xd1',
								),
							array(
									'á',
									'Á',
									'é',
									'É',
									'í',
									'Í',
									'ó',
									'Ó',
									'ú',
									'Ú',
									'ñ',
									'Ñ',
							
									'á',
									'Á',
									'é',
									'É',
									'í',
									'Í',
									'ó',
									'Ó',
									'ú',
									'Ú',
									'ñ',
									'Ñ',
							
									'á',
									'Á',
									'é',
									'É',
									'í',
									'Í',
									'ó',
									'Ó',
									'ú',
									'Ú',
									'ñ',
									'Ñ',
							),$str));	
	}
	
	function clear_category($string_category) {
		if($string_category == '0' || $string_category == 'null')
			$string_category = null;
		
		return $string_category;
	}
	
?>