<?php
class mmm_fc_register 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU ACTIVATE THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function activate() 
		{
			add_option( 'activated_'.MMM_FC_PLUGIN_ID_LONG, 'slug-'.MMM_FC_PLUGIN_ID_LONG_MINUS );
		}
		static function load_this_plugin()
		{
			if ( is_admin() && get_option( 'activated_'.MMM_FC_PLUGIN_ID_LONG ) == 'slug-'.MMM_FC_PLUGIN_ID_LONG_MINUS )
			{
				delete_option( 'activated_'.MMM_FC_PLUGIN_ID_LONG );
			}
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU DEACTIVATE THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function deactivate() 
		{
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU UNINSTALL THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function uninstall() 
		{
			$pages 										= 	mmm_fc_settings::settings_pages_tabs();
			foreach( $pages as $pages_id => $pages_name )
			{
				delete_option( MMM_FC_PLUGIN_ID_SHORT.'_'.$pages_id );
			}
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	LOADING THE TEXTDOMAIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function plugin_load_textdomain() 
		{
			load_plugin_textdomain( 'mmm-fc-translated', false, MMM_FC_PLUGIN_TEXTDOMAIN ); 
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	FRONTEND SCRIPTS AND STYLES
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function frontend_scripts()
		{																									
			wp_enqueue_script( 'jquery-ui-draggable' ); 
			wp_enqueue_script( 'jquery-ui-droppable' ); 
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	GET SETTINGS FOR JAVASCRIPT VARIABLES
			// ---------------------------------------------------------------------------------------------------------------------
				
				// settings
				$fancy_captcha_settings_default														= 	mmm_fc_settings::default_values('settings_tab1', 'vals_only');
				$fancy_captcha_settings_db															= 	get_option( MMM_FC_PLUGIN_ID_SHORT.'_settings');
				$fancy_captcha_settings_db 															= 	mmm_fc_settings::strip_empty($fancy_captcha_settings_db);
				$fancy_captcha_settings																= 	mmm_fc_settings::wp_parse_args_multidimensional( $fancy_captcha_settings_db, $fancy_captcha_settings_default );
				
			// ---------------------------------------------------------------------------------------------------------------------
			// 	END GET SETTINGS FOR JAVASCRIPT VARIABLES
			// ---------------------------------------------------------------------------------------------------------------------
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	ADD SOME VARIABLES TO JAVASCRIPT (JQUERY)
			// ---------------------------------------------------------------------------------------------------------------------
				
				$fc_jquery_js_vars																	=	MMM_FC_PLUGIN_ID_SHORT."_js_variables_array_jquery"; 
				${$fc_jquery_js_vars}																=	array();
				
				$fancy_captcha_array_uris															= 	array();	
				$custom_theme_path																	=	get_theme_root() . '/' . get_template() . MMM_FC_PLUGIN_IMAGE_FOLDER;
				$custom_theme_uri																	=	get_template_directory_uri() . MMM_FC_PLUGIN_IMAGE_FOLDER;
				foreach ($fancy_captcha_settings['shapes'] as $val_key => $val_val)
				{
					$fancy_captcha_array_uris[$val_key] 											= 	MMM_FC_PLUGIN_URL.MMM_FC_PLUGIN_IMAGE_FOLDER.'item-'.$val_key.'.png';
					if( is_dir( $custom_theme_path ) ) 
					{
						$custom_image_path 															=	$custom_theme_path.'item-'.$val_key.'.png';
						$custom_image_uri 															=	$custom_theme_uri.'item-'.$val_key.'.png';
						if (file_exists($custom_image_path))
						{
							$fancy_captcha_array_uris[$val_key] 									= 	$custom_image_uri;
						}
					}
				}
				${$fc_jquery_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_array_uris']							=	join(',', $fancy_captcha_array_uris);
				${$fc_jquery_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_uri'] 								= 	MMM_FC_PLUGIN_URL.MMM_FC_PLUGIN_IMAGE_FOLDER;
				unset($fancy_captcha_settings['shapes'][0]);
				${$fc_jquery_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_array_names']						= 	join(',', $fancy_captcha_settings['shapes']);
				${$fc_jquery_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_mobile'] 							= 	wp_is_mobile();

			// ---------------------------------------------------------------------------------------------------------------------
			// 	END ADD SOME VARIABLES TO JAVASCRIPT (JQUERY)
			// ---------------------------------------------------------------------------------------------------------------------
				
			// ---------------------------------------------------------------------------------------------------------------------
			// 	ADD SOME VARIABLES TO JAVASCRIPT (HEADER)
			// ---------------------------------------------------------------------------------------------------------------------
				
				$fc_header_js_vars																	=	MMM_FC_PLUGIN_ID_SHORT."_js_variables_array_header"; 
				${$fc_header_js_vars}																=	array();
				${$fc_header_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_form_selectors'] 					= 	$fancy_captcha_settings['form_selectors']; 
				${$fc_header_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_position'] 							= 	$fancy_captcha_settings['position']; 
				
				
				if (wp_is_mobile())
				{
					${$fc_header_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_label']							= 	str_replace('%x%', '<span class="replace"><span class="fancy-captcha-loader"></span></span>', $fancy_captcha_settings['label_mobile']);
				}
				else
				{
					${$fc_header_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_label']							= 	str_replace('%x%', '<span class="replace"><span class="fancy-captcha-loader"></span></span>', $fancy_captcha_settings['label']);
				}
				${$fc_header_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_error_empty']						= 	$fancy_captcha_settings['error_empty'];
				${$fc_header_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_error_incorrect']					= 	$fancy_captcha_settings['error_incorrect'];

			// ---------------------------------------------------------------------------------------------------------------------
			// 	END ADD SOME VARIABLES TO JAVASCRIPT (HEADER)
			// ---------------------------------------------------------------------------------------------------------------------
			
			// load admin scripts
			wp_enqueue_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-scripts-jquery', MMM_FC_PLUGIN_URL . '/js/frontend/jquery.captcha.js', array( 'jquery' ), date('d-m-Y'), false );
			wp_localize_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-scripts-jquery', $fc_jquery_js_vars, ${$fc_jquery_js_vars} );
			
			wp_register_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-scripts-header', MMM_FC_PLUGIN_URL . '/js/frontend/scripts-header.js', array( 'jquery' ), MMM_FC_PLUGIN_ID_SHORT_MINUS, false );
			wp_enqueue_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-scripts-header' );
			wp_localize_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-scripts-header', $fc_header_js_vars, ${$fc_header_js_vars} );
			
			wp_register_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-scripts-footer', MMM_FC_PLUGIN_URL . '/js/frontend/scripts-footer.js', array( 'jquery' ), MMM_FC_PLUGIN_ID_SHORT_MINUS, true );
			wp_enqueue_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-scripts-footer' );
		}
		static function frontend_styles() 
		{
			// load admin scripts
			wp_register_style('mmm-fancy-captcha', MMM_FC_PLUGIN_URL . '/css/frontend/style-fancy-captcha.css');
			wp_enqueue_style('mmm-fancy-captcha');
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	ADMIN SCRIPTS AND STYLES
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------

		static function admin_scripts() 
		{
			// ---------------------------------------------------------------------------------------------------------------------
			// 	ADD SOME VARIABLES TO JAVASCRIPT
			// ---------------------------------------------------------------------------------------------------------------------
				
				$fc_js_vars																			=	MMM_FC_PLUGIN_ID_SHORT."_js_variables_array"; 
				${$fc_js_vars}																		=	array();
				${$fc_js_vars}[MMM_FC_PLUGIN_ID_SHORT.'_reset_confirm_question'] 					= 	__('Are you sure you want to reset the plugin? This is irreversible.', MMM_FC_PLUGIN_TRANSLATE); 
			
			// ---------------------------------------------------------------------------------------------------------------------
			// 	END ADD SOME VARIABLES TO JAVASCRIPT
			// ---------------------------------------------------------------------------------------------------------------------
				
			// load admin scripts
			wp_register_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'scripts-header', MMM_FC_PLUGIN_URL . '/js/admin/scripts-header.js', array( 'jquery' ), MMM_FC_PLUGIN_ID_SHORT_MINUS, false );
			wp_enqueue_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'scripts-header' );
			wp_localize_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'scripts-header', $fc_js_vars, ${$fc_js_vars} );
			
			wp_register_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'scripts-footer', MMM_FC_PLUGIN_URL . '/js/admin/scripts-footer.js', array( 'jquery' ), MMM_FC_PLUGIN_ID_SHORT_MINUS, true );
			wp_enqueue_script( MMM_FC_PLUGIN_ID_SHORT_MINUS.'scripts-footer' );
		}
		static function admin_styles() 
		{
			wp_enqueue_style( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-admin-styles', MMM_FC_PLUGIN_URL . '/css/admin/style.css', array(), MMM_FC_PLUGIN_ID_SHORT_MINUS.'-admin-styles' );
			wp_enqueue_style( MMM_FC_PLUGIN_ID_SHORT_MINUS.'-admin-styles-copyright', MMM_FC_PLUGIN_URL . '/css/admin/style-copyright.css', array(), MMM_FC_PLUGIN_ID_SHORT_MINUS.'-admin-styles-copyright' );
		}
		
}