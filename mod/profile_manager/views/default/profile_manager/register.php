<?php
	/**
	* Profile Manager
	* 
	* Extended registerpage view
	* 
	* @package profile_manager
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/

	$categorized_fields = profile_manager_get_categorized_fields(null, true, true);
	$cats = $categorized_fields['categories'];
	$fields = $categorized_fields['fields'];
	
	if(count($fields) > 0 || get_plugin_setting("profile_icon_on_register", "profile_manager") == "yes"){
	    $bounced_values = get_input("custom_profile_fields");
	?>
	<div id="custom_profile_fields">
	<?php 
		$types_count = elgg_get_entities("object", CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE, null, null, null, null, true);
			
		if($types_count > 0){
			$types = elgg_get_entities("object", CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE, null, null, $types_count);
			
			$options = array();
			$options[""] = elgg_echo("profile_manager:profile:edit:custom_profile_type:default");
			foreach($types as $type){
				if(!empty($type->metadata_label)){
					$title = $type->metadata_label;
				} else {
					$trans_key = "profile:profile_types:" . $type->metadata_name;
					if($trans_key != elgg_echo($trans_key)){
						$title = elgg_echo($trans_key);
					} else {
						$title = $type->metadata_name;
					}
				}
				
				$options[$type->guid] = $title;
				
				// preparing descriptions of profile types
				$description = "";
				if(!empty($type->metadata_description)){
					$description = $type->metadata_description;
				} else {
					$trans_key = "profile:profile_types:" . $type->metadata_name . ":description";
					if($trans_key != elgg_echo($trans_key)){
						$description = elgg_echo($trans_key);
					} 
				}
				
				if(!empty($description)){
					$types_description .= "<div id='custom_profile_type_description_" . $type->guid . "' class='custom_profile_type_description'>";
					$types_description .= "<h3 class='settings'>" . elgg_echo("profile_manager:profile:edit:custom_profile_type:description") . "</h3>";
					$types_description .= $description;
					$types_description .= "</div>";
				}
			}
			
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					changeProfileType();
				});
	
				function changeProfileType(){
					
					var selVal = $('select[name="custom_profile_fields_custom_profile_type"]').val();
					$('.custom_profile_type_description').hide();
	
					if(selVal != ""){
						$('#custom_profile_type_description_'+ selVal).show();
					}
				}
			</script>
			<?php 
			echo "<p>\n";
			echo "<h3 class='settings'>\n";
			echo elgg_echo("profile_manager:profile:edit:custom_profile_type:label") . "</h3>\n";
			
			echo elgg_view("input/pulldown", array("internalname" => "custom_profile_fields_custom_profile_type",
													"options_values" => $options,
													"js" => "onchange='changeProfileType();'",
													"value" => $bounced_values['custom_profile_type']));
			
			echo "</p>\n";
			echo $types_description;
		}	
	
		if(count($fields) > 0){
			
			if(count($cats) > 1){
				$show_header = true;
			} else {
				$show_header = false;
			}
			
			foreach($cats as $cat_guid => $cat){
				if($show_header){
					// make nice title
					if($cat_guid == 0){
						$title = elgg_echo("profile_manager:categories:list:default");
					} else {
						if(!empty($cat->metadata_label)){
							$title = $cat->metadata_label;
						} else {
							$trans_key = "profile:categories:" . $cat->metadata_name;
							
							if($trans_key != elgg_echo($trans_key)){
								$title = elgg_echo($trans_key);
							} else {
								$title = $cat->metadata_name;
							}
						}
					}
					
					echo "<h3 class='settings'>" . $title . "</h3>\n";
				}
				
				foreach($fields[$cat_guid] as $field){
					$metadata_type = $field->metadata_type;
					if($metadata_type == "longtext"){
						// bug when showing tinymce on register page (when moving) newer versions of tinymce are working correctly
						$metadata_type = "plaintext";
					}
					$options = $field->metadata_options;
					$value = $bounced_values[$field->metadata_name];
					
					if(!empty($options)){
						$options = explode(",", $options);
					} else {
						$options = "";
					}
					
					?>
					<p>
						<label>
							<?php echo elgg_echo("profile:{$field->metadata_name}") ?><br />
							<?php echo elgg_view("input/{$metadata_type}",array(
																	'internalname' => "custom_profile_fields_" . $field->metadata_name,
																	'value' => $value,
																	'options' => $options
																	)); ?>
						</label>
					</p>
				
					<?php
				}
			}
		}
		
		if(get_plugin_setting("profile_icon_on_register", "profile_manager") == "yes"){
			echo elgg_view("input/profile_icon");
		}
	?>
	
	</div>
	<script type="text/javascript">		
			$("#custom_profile_fields").insertBefore("#register-box input[type=submit]");
	</script>
	<?php
	} 
?>