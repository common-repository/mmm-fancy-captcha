<?php
class mmm_fc_settings 
{
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	PAGES AND TABS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		public static function settings_pages_tabs($to_return = '')
		{
			$pages_tabs 											= 	array();
			$pages_tabs['settings']									=	array
																		(
																			"page_title"	=>	__('Settings', MMM_FC_PLUGIN_TRANSLATE),
																			"page_tabs"		=> 	array
																								(
																									"tab1" => __('Configuration', MMM_FC_PLUGIN_TRANSLATE),
																									"tab2" => __('Help', MMM_FC_PLUGIN_TRANSLATE)
																								)
																		);
			if ($to_return)
			{
				$pages_tabs											=	$pages_tabs[$to_return];
			}
			return $pages_tabs;
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	DEFAULT VALUES
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------

		public static function shapes_to_return($with_zero = false) 
		{
			$shapes_to_return										= 	array();
			if ($with_zero == true)
			{
				$shapes_to_return[0]								= 	__("the house", MMM_FC_PLUGIN_TRANSLATE);
			}
			$shapes_to_return[1]									= 	__("the heart", MMM_FC_PLUGIN_TRANSLATE);
			$shapes_to_return[2]									= 	__("the circle", MMM_FC_PLUGIN_TRANSLATE);
			$shapes_to_return[3]									= 	__("the square", MMM_FC_PLUGIN_TRANSLATE);
			$shapes_to_return[4]									= 	__("the triagle", MMM_FC_PLUGIN_TRANSLATE);
			$shapes_to_return[5]									= 	__("the star", MMM_FC_PLUGIN_TRANSLATE);
			return ($shapes_to_return);
		}
		public static function default_values($to_return = '', $return_as = 'all') 
		{
			$defaults 												= 	array();
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	TAB1
			// ---------------------------------------------------------------------------------------------------------------------
				
				$replace_array 										= 	array(
																			MMM_FC_PLUGIN_NAME,
																			MMM_FC_PLUGIN_CREATOR_EMAIL
																		);
				$defaults['settings_tab1']['section'] 				= 	array
																		(
																			'the_title' 	=> 		__('Configuration', MMM_FC_PLUGIN_TRANSLATE),
																			'the_text' 		=> 		mmm_fc_admin_functions::return_replaced_array(__('This section contains configuration settings for setting up %s plugin. This plugin was custom build for <a href="http://www.switchingacademy.nl/" target="_blank">Swtiching Academy</a>, a website based on a Woocommerce webshop with Ninja Forms. If you have any questions that you cannot find on the help-tab please send me an <a href="mailto:%s">e-mail</a>.', MMM_FC_PLUGIN_TRANSLATE), $replace_array),
																			'the_type'		=> 		'section'
																		);
				$defaults['settings_tab1']['form_selectors']		= 	array
																		(
																			'the_title' 	=> 		__('Add captcha to ...<br /><span class="small">Insert the selectors that we need to search within. You may use multiple selectors seperated by a comma (,).</span>', MMM_FC_PLUGIN_TRANSLATE),
																			'the_val' 		=> 		'.register input[type=submit], .ninja-forms-form input[type=submit]',
																			'the_type'		=> 		'textarea'
																		);
				$defaults['settings_tab1']['position']				= 	array
																		(
																			'the_title' 	=> 		__('and insert ...<br /><span class="small">What is the position of the captcha?</span>', MMM_FC_PLUGIN_TRANSLATE),
																			'the_val' 		=> 		1,
																			'the_type'		=> 		'radio',
																			'the_vals'		=> 		array
																									(
																										1 	=>	__('before', MMM_FC_PLUGIN_TRANSLATE), 
																										2 	=> 	__('after', MMM_FC_PLUGIN_TRANSLATE)
																									)
																		);
				$defaults['settings_tab1']['label'] 				= 	array
																		(
																			'the_title' 	=> 		__('Input label<br /><span class="small">Place %x% on the spot where the shape text should come.</span>', MMM_FC_PLUGIN_TRANSLATE),
																			'the_val' 		=> 		__('Are you a robot? <span class="required">*</span><br /><span class="small">drag %x% into the rectangle</span>', MMM_FC_PLUGIN_TRANSLATE),
																			'the_type'		=> 		'textarea'
																		);
				$defaults['settings_tab1']['label_mobile']			= 	array
																		(
																			'the_title' 	=> 		__('Input label mobile<br /><span class="small">Place %x% on the spot where the shape text should come.</span>', MMM_FC_PLUGIN_TRANSLATE),
																			'the_val' 		=> 		__('Are you a robot? <span class="required">*</span><br /><span class="small">click on %x%</span>', MMM_FC_PLUGIN_TRANSLATE),
																			'the_type'		=> 		'textarea'
																		);
				$replace_array										=	array(
																			join(', ', mmm_fc_settings::shapes_to_return())
																		);
				$defaults['settings_tab1']['shapes'] 				= 	array
																		(
																			'the_title' 	=> 		mmm_fc_admin_functions::return_replaced_array(__('Custom shapes?<br /><span class="small">The plugin uses the following standard shapes: %s. Need more help to change them? Check the help-tab.</span>', MMM_FC_PLUGIN_TRANSLATE), $replace_array),
																			'the_val' 		=> 		mmm_fc_settings::shapes_to_return(true),
																			'the_type'		=> 		'shapes',
																			'the_vals'		=> 		mmm_fc_settings::shapes_to_return(true)
																		);
				$defaults['settings_tab1']['error_empty'] 			= 	array
																		(
																			'the_title' 	=> 		__('Error empty<br /><span class="small">The error to display if the captcha is empty.</span>', MMM_FC_PLUGIN_TRANSLATE),
																			'the_val' 		=> 		__('You forgot to tell me if you are a robot?', MMM_FC_PLUGIN_TRANSLATE),
																			'the_type'		=> 		'textarea'
																		);
				$defaults['settings_tab1']['error_incorrect'] 		= 	array
																		(
																			'the_title' 	=> 		__('Error wrong<br /><span class="small">The error to display if the captcha is incorrect.</span>', MMM_FC_PLUGIN_TRANSLATE),
																			'the_val' 		=> 		__('Seems like you are a robot or just not that good with shapes?', MMM_FC_PLUGIN_TRANSLATE),
																			'the_type'		=> 		'textarea'
																		);												
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	TAB2
			// ---------------------------------------------------------------------------------------------------------------------
			
				$defaults['settings_tab2']['section'] 				= 	array
																		(
																			'the_title' 	=> 		__('Help', MMM_FC_PLUGIN_TRANSLATE),
																			'the_text' 		=> 		__('How does this work?', MMM_FC_PLUGIN_TRANSLATE),
																			'the_type'		=> 		'section'
																		);
				$replace_array 										= 	array(
																			join(', ', mmm_fc_settings::shapes_to_return())
																		);
				$defaults['settings_tab2']['section2'] 				= 	array
																		(
																			'the_title' 	=> 		__('Help', MMM_FC_PLUGIN_TRANSLATE),
																			'the_text' 		=> 		mmm_fc_admin_functions::return_replaced_array(__('<b>Add captcha to ...</b><br />Type the selectors you want to use to to add the captcha. This needs to be an element within a form. If you use captcha outside a form, it will be added, but not checked (because there will be no $_POST action). If you use a selector like &#8216;form input&#8217; tags all the input elements of the form will appended/prepended with the captcha. So use wisely. A good example (with Woocommerce) would be &#8216;.woocommerce .comment-respond p.comment-form-comment&#8217;. In this case only the review textarea paragraph gets appended/prepended. You can add multiple selectors by seperating them by a comma (,).<br /><br /><b>and insert ...</b><br />Well ... before or after elements?<br /><br /><b>Custom shapes?</b><br />This is a little bit more difficult but not rocketscience. The plugin uses the following standard shapes: %s. If you want to change these you can do one of two things.<br /><br /><u>Option 1: overwrite the standard images</u><br />Create a folder in your theme named images/fancy-captcha/ and upload your own images that look like the standard shapes (else the names would be really silly). The image types should be .png files and the image names should be the same as the originals (item-0.png (the base, not show but necessary) to item-5.png).<br /><u>Option 2: completely create your own</u><br />Exectute option 1 with the exception that the images do not have to look like the standard shapes. On the settings tab as the last option you can change the names. For example "red square" or "yellow" circle.', MMM_FC_PLUGIN_TRANSLATE), $replace_array),
																			'the_type'		=> 		'section'
																		);
			if ($to_return)
			{
				$defaults											= 	$defaults[$to_return];
			}
			if ($return_as == 'vals_only')
			{
				$defaults_new										=	array();
				if (count($defaults) > 0)
				{
					foreach ($defaults as $defaults_key => $defaults_val_array)
					{
						if (isset($defaults_val_array['the_val']))
						{
							$defaults_new[$defaults_key]			= 	$defaults_val_array['the_val'];
						}
					}
				}
				$defaults											= 	$defaults_new;
			}
			return $defaults;
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	ADD SETTINGS PAGE TO PLUGIN PAGE
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function wp_parse_args_multidimensional( &$a, $b )
		{
			$a 														= 	(array) $a;
			$b 														= 	(array) $b;
			$result 												= 	$b;
			foreach($a as $k => &$v)
			{
				if (is_array($v) && isset($result[$k]))
				{
					$result[$k] 									=	self::wp_parse_args_multidimensional($v, $result[$k]);
				}
				else 
				{
					$result[$k]										= 	$v;
				}
			}
			return $result;
		}
		static function strip_empty($array)
		{
			if(is_array($array))
			{
				$array 												= 	array_filter($array);
			}
			if (isset($array) && is_array($array))
			{
				foreach ($array as $key => $value)
				{
					if(is_array($value))
					{
						$value 										= 	array_filter($value);
						$array[$key] 								= 	self::strip_empty($value);
					}
				}
			}
			return ($array);
		}
		static function settings_fields_update()
		{
			if (isset($_POST['reset']) && $_POST['reset'])
			{
				$pages 													= 	mmm_fc_settings::settings_pages_tabs();
				foreach( $pages as $pages_id => $pages_name )
				{
                    $tab_counter									= 	1;
					foreach( $pages_name['page_tabs'] as $tab_key => $tab_val)
					{
						if ($tab_counter == 1)
						{
							$option_group								=	$pages_id.'_'.$tab_key;
							if (isset($_POST['option_page']) && $_POST['option_page'] == $option_group)
							{
								delete_option( $option_group );
								add_settings_error(
									MMM_OH_PLUGIN_ID_SHORT.'_settings_resetted',
									esc_attr( 'settings_updated' ),
									__('Settings resetted.', MMM_FC_PLUGIN_TRANSLATE),
									'updated'
								);
							}
						}
						$tab_counter++;
					}
				}
			}
		}
		static function settings_fields_init()
		{
			$pages 													= 	mmm_fc_settings::settings_pages_tabs();
			foreach( $pages as $pages_id => $pages_name )
			{
				foreach( $pages_name['page_tabs'] as $tab_key => $tab_val)
				{
					register_setting($pages_id.'_'.$tab_key, MMM_FC_PLUGIN_ID_SHORT.'_'.$pages_id);
					
					$values_defaults_pp_pt							= 	self::default_values($pages_id.'_'.$tab_key);
					$values_defaults_val_only_pp_pt					= 	self::default_values($pages_id.'_'.$tab_key, 'vals_only');
					
					$values_db_pp_pt								= 	get_option( MMM_FC_PLUGIN_ID_SHORT.'_'.$pages_id, $values_defaults_val_only_pp_pt );
					$values_db_pp_pt 								= 	self::strip_empty($values_db_pp_pt);
					$values_combined_pp_pt							= 	self::wp_parse_args_multidimensional( $values_db_pp_pt, $values_defaults_val_only_pp_pt );
					foreach( $values_defaults_pp_pt as $defaults_pp_pt_key => $tab_val)
					{
						$the_type 									=	'';
						$the_title 									=	'';
						$the_val 									=	'';
						$the_vals 									=	'';
						$the_class									= 	'';
						
						if (isset($tab_val['the_type']) && $tab_val['the_type'])												{ $the_type								= 	$tab_val['the_type'];							}
						if (isset($tab_val['the_title']) && $tab_val['the_title'])												{ $the_title							= 	$tab_val['the_title'];							}
						if (isset($values_combined_pp_pt[$defaults_pp_pt_key]) && $values_combined_pp_pt[$defaults_pp_pt_key])	{ $the_val								= 	$values_combined_pp_pt[$defaults_pp_pt_key];	}
						if (isset($tab_val['the_vals']) && $tab_val['the_vals'])												{ $the_vals								= 	$tab_val['the_vals'];							}
						if (isset($tab_val['the_class']) && $tab_val['the_class'])												{ $the_class							= 	$tab_val['the_class'];							}
						
						if ($the_type == 'section')
						{
							add_settings_section(
								MMM_FC_PLUGIN_ID_SHORT.'_'.$pages_id.'_'.$tab_key, 
								$the_title, 
								MMM_FC_PLUGIN_ID_SHORT.'_settings::section_render', 
								$pages_id.'_'.$tab_key
							);
						}
						else
						{
							add_settings_field( 
								MMM_FC_PLUGIN_ID_SHORT.'_'.$defaults_pp_pt_key, 
								$the_title,
								apply_filters( MMM_FCP_PLUGIN_ID_SHORT.'_premium_field_render', MMM_FC_PLUGIN_ID_SHORT.'_settings::field_render', $the_type ),
								$pages_id.'_'.$tab_key, 
								MMM_FC_PLUGIN_ID_SHORT.'_'.$pages_id.'_'.$tab_key,
								array(
									"the_type" 						=> 	$the_type,
									"the_type_name" 				=> 	$pages_id,
									"label_for" 					=> 	$defaults_pp_pt_key,
									"the_key" 						=> 	$defaults_pp_pt_key,
									"the_val" 						=> 	$the_val,
									"the_vals" 						=> 	$the_vals,
									"the_class" 					=> 	$the_class
								)
							);
						}
					}
				}
			}
		}
		static function section_render($args)
		{
			$main_key_section 		= 	str_replace(MMM_FC_PLUGIN_ID_SHORT.'_', '', $args['id']);
			$the_defaults			= 	self::default_values($main_key_section);
			foreach ($the_defaults as $the_defaults_key => $the_defaults_val)
			{
				if ($the_defaults_val['the_type'] == 'section' && $the_defaults_val['the_title'] == $args['title'])
				{
					echo '<div class="tab-help">'.$the_defaults_val['the_text'].'</div>';
				}
			}
		}
		static function field_render($args)
		{
			$field_class			= 	'';
			//echo '<pre>';
			//print_r ($args);
			//echo '</pre>';
			if (isset($args['the_class']) && $args['the_class'])
			{
				$field_class		= 	' class="'.$args['the_class'].'"';
			}
			if ($args['the_type'] == 'shapes')
			{
				$custom_theme_path										=	get_theme_root() . '/' . get_template() . MMM_FC_PLUGIN_IMAGE_FOLDER;
				$custom_theme_uri										=	get_template_directory_uri() . MMM_FC_PLUGIN_IMAGE_FOLDER;
				foreach ($args['the_vals'] as $val_key => $val_val)
				{
					// CUSTOM IMAGE
					$custom_image_error_counter							=	0;
					if( is_dir( $custom_theme_path ) ) 
					{
						$custom_image_path 								=	$custom_theme_path.'item-'.$val_key.'.png';
						$custom_image_uri 								=	$custom_theme_uri.'item-'.$val_key.'.png';
						$custom_image_class								=	'';
						$default_image_class							=	'';
						if (file_exists($custom_image_path))
						{
							$custom_image								=	$custom_image_uri;
							$default_image_class						=	' gray';
						}
						else
						{
							$custom_image								=	MMM_FC_PLUGIN_URL.MMM_FC_PLUGIN_IMAGE_FOLDER.'item-x.png';
							$custom_image_error_counter					=	1;
							$custom_image_class							=	' gray';
						}
					}
					else
					{
						$custom_image								=	MMM_FC_PLUGIN_URL.MMM_FC_PLUGIN_IMAGE_FOLDER.'item-x.png';
						$custom_image_error_counter					=	1;
						$custom_image_class							=	' gray';
					}
					// END CUSTOM IMAGE
					?>
					<img src="<?php echo MMM_FC_PLUGIN_URL.MMM_FC_PLUGIN_IMAGE_FOLDER.'item-'.$val_key.'.png'; ?>" class="captcha-image<?php echo $default_image_class; ?>" />
					<img src="<?php echo $custom_image; ?>" class="captcha-image<?php echo $custom_image_class; ?>"  />
					<input<?php echo $field_class; ?> type='text' name='<?php echo MMM_FC_PLUGIN_ID_SHORT.'_'.$args['the_type_name']; ?>[<?php echo $args['the_key']; ?>][<?php echo $val_key; ?>]' value='<?php echo $args['the_val'][$val_key]; ?>'>
					<span class="small">
					<?php
					if ($args['the_val'][$val_key] != $val_val)
					{
						echo __('Original:', MMM_FC_PLUGIN_TRANSLATE).' '.$val_val;
					}
					?></span>
					<br />
					<?php
				}
			}
			if ($args['the_type'] == 'radio')
			{
				foreach ($args['the_vals'] as $val_key => $val_val)
				{
					?>
					<input name="<?php echo MMM_FC_PLUGIN_ID_SHORT.'_'.$args['the_type_name']; ?>[<?php echo $args['the_key']; ?>]" type="radio" value='<?php echo $val_key; ?>' <?php checked( $args['the_val'], $val_key); ?>> <?php echo $val_val; ?><br />
					<?php
				}
			}
			if ($args['the_type'] == 'checkbox')
			{
				foreach ($args['the_vals'] as $val_key => $val_val)
				{
					?>
					<input name="<?php echo MMM_FC_PLUGIN_ID_SHORT.'_'.$args['the_type_name']; ?>[<?php echo $args['the_key']; ?>][<?php echo $val_key; ?>]" type="checkbox" value='<?php echo $val_key; ?>' <?php checked( $args['the_val'][$val_key], $val_key); ?>> <?php echo $val_val; ?><br />
					<?php
				}
			}
			if ($args['the_type'] == 'select')
			{
				?>
				<select<?php echo $field_class; ?> name='<?php echo MMM_FC_PLUGIN_ID_SHORT.'_'.$args['the_type_name']; ?>[<?php echo $args['the_key']; ?>]'>
					<?php
					foreach ($args['the_vals'] as $val_key => $val_val)
					{
						?>
	                    <option value='<?php echo $val_key; ?>' <?php selected( $args['the_val'], $val_key); ?>><?php echo $val_val; ?></option>
                        <?php
					}
					?>
				</select>
				<?php
			}
			if ($args['the_type'] == 'text')
			{
				?>
                <input<?php echo $field_class; ?> type='text' name='<?php echo MMM_FC_PLUGIN_ID_SHORT.'_'.$args['the_type_name']; ?>[<?php echo $args['the_key']; ?>]' value='<?php echo $args['the_val']; ?>'>
                <?php
			}	
			if ($args['the_type'] == 'textarea')
			{
				?>
                <textarea<?php echo $field_class; ?> name='<?php echo MMM_FC_PLUGIN_ID_SHORT.'_'.$args['the_type_name']; ?>[<?php echo $args['the_key']; ?>]'><?php echo $args['the_val']; ?></textarea>
                <?php
			}		
		}
}
?>