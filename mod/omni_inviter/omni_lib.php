<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009
 */

/**
 * Elevate user to admin.
 *
 * @param bool $unsu -- Return to original permissions? 
 * @return old 
 */
function oi_su($unsu=false) {
	global $is_admin;
	static $is_admin_orig = null; 
	
	if (is_null($is_admin_orig)) {
		$is_admin_orig = $is_admin;
	}
	
	if ($unsu) {
		return $is_admin = $is_admin_orig;
	} else {
		return $is_admin = true;
	}
}

/**
 * Sends an email.  Makes sure things are tidied up and such.
 * 
 * @param $from_email Email address of sender
 * @param $from_name Name of sender
 * @param $to_email Email address of recipient
 * @param $to_name Name of recipient
 * @param $subj
 * @param $body	Automatically wrapped to 75 chars
 * @param $headers
 * @return bool
 */
function oi_send_email($from_email, $from_name, $to_email, $to_name, $subj, $body, $headers='') {
	
	// make RCF 2822 compliant.
	$from = (!empty($from_name)) ? "$from_name <$from_email>" : $from_email;
	$to = (!empty($to_name)) ? "$to_name <$to_email>" : $to_email; 
	
	// can't use empty(trim($from)) ??
	if (trim($from) == '' || trim($to) == '') { return false; }
	
	$headers = "From: $from\r\n"
		. "Content-Type: text/plain; charset=UTF-8; format=flowed\r\n"
		. "MIME-Version: 1.0\r\n" . $headers;

	$log = "Sending...
	head: $headers
	to: $to
	subj: $subj
	body: $body
	";

	//eschool_log($log);
	
	// support for Cash's PHPMailer plugin.  If it's enabled
	// and the function exists, use it.  No need to clutter
	// the settings with another option.
	if (is_plugin_enabled('phpmailer') && function_exists('phpmailer_send')) {
		return phpmailer_send($from_email, $from_name, $to_email, $to_name, $subj, $body);
	} else {
		return mail($to, $subj, wordwrap($body), $headers);
	}
}


/**
 * Generate random code for an invitation object.
 * 
 * @return string
 */
function oi_generate_code() {
	return md5(rand());
}


/**
 * Returns a link to use the invitation
 * 
 * @param $guid GUID of invitation.
 * @return str
 */
function oi_make_join_link($guid, $part='full') {
	global $CONFIG;
	
	if (!$invite = get_entity($guid) AND $invite instanceof Invitation) {
		return false;
	}
	
	switch ($part) {
		case 'id':
			return $invite->getGUID();
			break;
		
		case 'code':
			return $invite->code;
			break;
		
		default:
			return $CONFIG->wwwroot . 'pg/omni_inviter/join?invitation_id=' . $invite->getGUID() . '&invitation_code=' . $invite->code;
	}	
}

/**
 * Returns a string after replacing supported vars.
 * 
 * @param str $string
 * @param array $overrides -- An override as array('%VAR_NAME%' => 'value')
 * @return str
 */
function oi_format_string($string, $overrides = array()) {
	global $CONFIG;
	$user = get_loggedin_user();
	$site = $CONFIG->site;
	
	$supported_vars = oi_get_supported_string_vars();
	
	$values = array();
	foreach ($supported_vars as $var) {
		if (array_key_exists($var, $overrides)) {
			$values[$var] = $overrides[$var];
			continue;
		} else {
			switch ($var) {
				case '%USER_NAME%':
					$values[$var] = $user->username;
					break;
					
				case '%USER_FULLNAME%':
					$values[$var] = $user->name;
					break;
					
				case '%USER_EMAIL%':
					$values[$var] = $user->email;
					break;
				
				case '%SITE_EMAIL%':
					$values[$var] = $site->email;
					break;
					
				case '%SITE_NAME%':
					$values[$var] = $site->name;
					break;
					
				// changes http://example.com into example.com.
				// help to avoid link-blocking sites (facebook)
				case '%SITE_DOMAIN_SHORTENED%':
					$site_short = str_replace('https://', '', $site->url);
					$site_short = str_replace('http://', '', $site_short);
					$char = substr($site_short, -1);
					if ($char == '/') {
						$site_short = substr($site_short, 0, strlen($site_short)-1);
					}
					
					$values[$var] = $site_short;
					break;
					
				// these *MUST* be passed as overrides.
				// there is no way of knowing
				case '%USER_MESSAGE%':
				case '%INVITED_NAME%':
				case '%INVITED_ACCOUNT_ID%':
				case '%OI_JOIN_LINK%':
				case '%OI_INVITATION_ID%':
				case '%OI_INVITATION_CODE%':
				default:
					$values[$var] = $var;
					break;
			}
			
		}
		
	}
	
	foreach ($values as $var => $value) {
		$string = str_replace($var, $value, $string);
	}
	
	return $string;
}

/**
 * Returns an array of known vars.
 * 
 * @return arr
 */
function oi_get_supported_string_vars() {
	return array(
	'%USER_NAME%',
	'%USER_FULLNAME%',
	'%USER_EMAIL%',
	'%USER_MESSAGE%',
	
	'%INVITED_NAME%',
	'%INVITED_ACCOUNT_ID%',
	
	'%SITE_EMAIL%',
	'%SITE_NAME%',
	'%SITE_DOMAIN_SHORTENED%',
	
	'%OI_JOIN_LINK%',
	'%OI_INVITATION_ID%',
	'%OI_INVITATION_CODE%'
	);
}

/**
 * Get a list of supported methods for inviting friends.
 * 
 * @param $pretty Bool to return array(method=>Pretty Name)
 * @param $enabled_only
 * @return unknown_type
 */
function oi_get_supported_methods($details=false, $enabled_only=true) {
	global $CONFIG;
	static $methods_cache;
	
	if (!is_array($methods_cache)) {
		$methods_cache = array();
		$method_root = dirname(__FILE__) . '/methods/';
		$method_dirs = scandir($method_root);
		$methods_tmp = array();
		foreach ($method_dirs as $method) {
			if ($method != '.' && $method != '..') {
				if ($method_details = oi_get_method_details($method, true)) {
					$methods_cache[$method] = $method_details;
				}
			}
		}
	}
	
	// find only enabled ones.
	if ($enabled_only) {
		$methods = array();
		foreach ($methods_cache as $name => $info) {
			if (get_plugin_setting('method_enabled_' . $name, 'omni_inviter')) {
				$methods[$name] = $info;
			}
		}
	} else {
		$methods = $methods_cache;
	}
	
	// include details
	if ($details) {
		return $methods;
	} else {
		$array = array();
		foreach ($methods as $method => $info) {
			$array[] = $method;
		}
		
		return $array;
	}
}
/**
 * Pulls method details from files or cache 
 * 
 * @param $method
 * @return array
 */

function oi_get_method_details($method) {
	global $CONFIG;
	static $methods_cache;
	
	// pull from cache.
	if (is_array($methods_cache) && 
		array_key_exists($method, $methods_cache) && is_array($methods_cache[$method])) {
		return $methods_cache[$method];
	}
	
	// pull from files
	$dir = dirname(__FILE__) . '/methods/' . $method . '/';
	
	// try to include any language file first.
	$lang_include = $dir . '/language.php';
	
	if (is_file($lang_include)) {
		require_once $lang_include;
	}
	
	// on to the good bits.
	$include = $dir . '/start.php';
	
	if (is_file($include) && require_once $include) {
		$methods_cache[$method] = array(
			//'name' => $pretty_name,
			'author' => $oi_author,
			'description' => $oi_description,
			'invite_who' => $oi_invite_who,
			'settings_callback' => $oi_settings_callback,
			'usersettings_callback' => $oi_usersettings_callback,
			'send_invitation_callback' => $oi_send_invitation_callback,
			
			'new_invitation_callback' => $oi_new_invitation_callback,
			'use_invitation_callback' => $oi_use_invitation_callback,
			'post_register_callback' => $oi_post_register_callback
		);
		
		return $methods_cache[$method];
	}
	
	return false;
}

/**
 * Provides estimates for Beta 1 version of invites.
 * 
 * @param $invite
 * @return invite object.
 */
function oi_fix_b1_invite($invite) {
	if ($invite->sent_count > 0) {
		if (!$invite->sent_on) {
			$invite->sent_on = $invite->time_created;
		}
	}
	
	if ($invite->used) {
		if (!$invite->used_on) {
			$user = get_entity($invite->invited_guid);
			$invite->used_on = $user->time_created;
		}
	}
	
	if ($invite->method == 'openinviter') {
		$invite->stats_extra = serialize(array('provider'));
	}
	
	$invite->clicked = $invite->used;
	$invite->clicked_on = $invite->used_on;
	
	return $invite;
}


/**
 * Upgrades to newest feature version
 * 
 * @param $from_version
 * @param $to_version
 * @return new feature version
 */
function oi_upgrade($from_version, $to_version) {
	// don't break to do all upgrade
	oi_su();
	$old_mem_val = ini_set('memory_limit', '64M');
	$old_time_limit = ini_set('max_execution_time', 60 * 5);
	switch ($from_version) {
		default:
		case 2:
			// upgrade to new version of object.
			$invites = get_entities('object', 'invitation', '', '', 99999);
			foreach ($invites as $invite) {
				oi_fix_b1_invite($invite);
			}
			$new_version = 2;
		//case 3:
		//	$new_version = 3;
		//case 4:
		//	$new_version = 4;
	}
	oi_su(true);
	ini_set('memory_limit', $old_mem_val);
	ini_set('max_execution_time', $old_time_limit);
	
	return $new_version;
}


/**
 * This hot little bit of code is brought to you in part by by Alivin70 <alivin70@gmail.com>
 *
 * @global Array $CONFIG
 * @param Array $meta_array Is a multidimensional array with the list of metadata to filter.
 * For each metadata you have to provide 3 values:
 * - name of metadata
 * - value of metadata
 * - operand ( <, >, <=, >=, =, like)
 * For example
 *      $meta_array = array(
 *              array(
 *                  'name'=>'my_metadatum',
 *                  'operand'=>'>=',
 *                  'value'=>'my value'
 *              )
 *      )
 * @param String $entity_type
 * @param String $entity_subtype
 * @param Boolean $count
 * @param Integer $owner_guid
 * @param Integer $container_guid
 * @param Integer $limit
 * @param Integer $offset
 * @param String $order_by "Order by" SQL string. If you want to sort by metadata string,
 * possible values are vN.string, where N is the first index of $meta_array,
 * hence our example is $order by = 'v1.string ASC'
 * @param Integer $site_guid
 * @param Integer $timelower
 * @param Integer $imeupper
 * @return Mixed Array of entities or false
 *
 */
function oi_get_entities_from_metadata_by_value($meta_array, $entity_type = "", $entity_subtype = "", $count = false,
                    $owner_guid = 0, $container_guid = 0, $limit = 10, $offset = 0,
                    $order_by = "", $site_guid = 0, $timelower = 0, $timeupper = 0)
    {
        global $CONFIG;
   
        $timelower = (int) $timelower;
		$timeupper = (int) $timeupper;
        
        // ORDER BY
        if ($order_by == "") $order_by = "e.time_created desc";
        $order_by = sanitise_string($order_by);
       
        $where = array();

        // Filetr by metadata
        $mindex = 1; // Starting index of joined metadata/metastring tables
        $join_meta = "";
        $query_access = "";
        foreach($meta_array as $meta) {
            $join_meta .= "JOIN {$CONFIG->dbprefix}metadata m{$mindex} on e.guid = m{$mindex}.entity_guid ";
            $join_meta .= "JOIN {$CONFIG->dbprefix}metastrings v{$mindex} on v{$mindex}.id = m{$mindex}.value_id ";
           
            $meta_n = get_metastring_id($meta['name']);
            $where[] = "m{$mindex}.name_id='$meta_n'";


            if (strtolower($meta['operand']) == "like"){
                // "LIKE" search   
                $where[] = "v{$mindex}.string LIKE ('".$meta['value']."') ";
            }elseif(strtolower($meta['operand']) == "in"){
                // TO DO - "IN" search
            }else{   
                // Simple operand search
                $where[] = "v{$mindex}.string".$meta['operand']."'".$meta['value']."'";
            }

            $query_access .= ' and ' . get_access_sql_suffix("m{$mindex}"); // Add access controls
           
            $mindex++;
        }

        $limit = (int)$limit;
        $offset = (int)$offset;

        if ((is_array($owner_guid) && (count($owner_guid)))) {
            foreach($owner_guid as $key => $guid) {
                $owner_guid[$key] = (int) $guid;
            }
        } else {
            $owner_guid = (int) $owner_guid;
        }

        if ((is_array($container_guid) && (count($container_guid)))) {
            foreach($container_guid as $key => $guid) {
                $container_guid[$key] = (int) $guid;
            }
        } else {
            $container_guid = (int) $container_guid;
        }

        $site_guid = (int) $site_guid;
        if ($site_guid == 0)
            $site_guid = $CONFIG->site_guid;

        $entity_type = sanitise_string($entity_type);
        if ($entity_type!="")
            $where[] = "e.type='$entity_type'";
       
        $entity_subtype = get_subtype_id($entity_type, $entity_subtype);
        if ($entity_subtype)
            $where[] = "e.subtype=$entity_subtype";

        if ($site_guid > 0)
            $where[] = "e.site_guid = {$site_guid}";
       
        if (is_array($owner_guid)) {
            $where[] = "e.owner_guid in (".implode(",",$owner_guid).")";
        } else if ($owner_guid > 0) {
            $where[] = "e.owner_guid = {$owner_guid}";
        }

        if (is_array($container_guid)) {
            $where[] = "e.container_guid in (".implode(",",$container_guid).")";
        } else if ($container_guid > 0)
            $where[] = "e.container_guid = {$container_guid}";

        if ($timelower)
			$where[] = "e.time_created >= {$timelower}";
		if ($timeupper)
			$where[] = "e.time_created <= {$timeupper}";
            
        if (!$count) {
            $query = "SELECT distinct e.* ";
        } else {
            $query = "SELECT count(distinct e.guid) as total ";
        }

        $query .= "FROM {$CONFIG->dbprefix}entities e ";
        $query .= $join_meta;

        $query .= "  WHERE ";
        foreach ($where as $w)
            $query .= " $w and ";
        $query .= get_access_sql_suffix("e"); // Add access controls
        $query .= $query_access;
        
        if (!$count) {
            $query .= " order by $order_by limit $offset, $limit"; // Add order and limit

            return get_data($query, "entity_row_to_elggstar");
        } else {
            $row = get_data_row($query);       
            //echo $query.mysql_error().__FILE__.__LINE__;
            if ($row)
                return $row->total;
        }
        return false;
    }

?>
