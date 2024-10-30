<?php
/**
 Plugin Name: 										MMM Fancy Captcha
 Plugin URI: 										http://www.multimediamonster.nl
 Description: 										The plugin adds a fancy drag and drop (or click on mobile and tablets) captcha field to specific forms you choose by inserting the tag, classname or for example id as a selector and a form tag as to where the captcha should be displayed.
 Version: 											1.12
 Author: 											MultiMediaMonster, Renske van der Heijden
 Author URI: 										http://www.multimediamonster.nl
 License: 											GPLv2 or later
*/

// ---------------------------------------------------------------------------------------------------------------------
// 	PRE DEFINED VARIABLES
// 	@since											MultiMediaMonster 1.1
// ---------------------------------------------------------------------------------------------------------------------
  
	define('MMM_FC_PLUGIN_CREATOR',					'MultiMediaMonster');
	define('MMM_FC_PLUGIN_CREATOR_AUTHOR',			'Renske van der Heijden');
	define('MMM_FC_PLUGIN_CREATOR_URL',				'www.multimediamonster.nl');
	define('MMM_FC_PLUGIN_CREATOR_EMAIL',			'renske@multimediamonster.nl');
	define('MMM_FC_PLUGIN_NAME', 					'MMM Fancy Captcha');
	
	define('MMM_FC_PLUGIN_ID_LONG', 				'fancy_captcha');
	define('MMM_FC_PLUGIN_ID_LONG_MINUS', 			str_replace('_', '-', MMM_FC_PLUGIN_ID_LONG));
	define('MMM_FC_PLUGIN_ID_SHORT', 				'mmm_fc');
	define('MMM_FC_PLUGIN_ID_SHORT_MINUS',			str_replace('_', '-', MMM_FC_PLUGIN_ID_SHORT));
	
	define('MMM_FC_PLUGIN_PATH',					dirname( __FILE__ ));
	define('MMM_FC_PLUGIN_FOLDER',					basename(MMM_FC_PLUGIN_PATH));
	define('MMM_FC_PLUGIN_URL',						plugins_url().'/'.MMM_FC_PLUGIN_FOLDER);
	define('MMM_FC_PLUGIN_IMAGE_FOLDER',			'/images/fancy-captcha/');
	
	define('MMM_FC_PLUGIN_TRANSLATE',				MMM_FC_PLUGIN_ID_SHORT_MINUS.'-translated');
	define('MMM_FC_PLUGIN_TEXTDOMAIN',				MMM_FC_PLUGIN_FOLDER . '/languages/');

	// ---------------------------------------------------------------------------------------------------------------------
	// 	ADMIN & FRONTEND
	// ---------------------------------------------------------------------------------------------------------------------

		// includes
		include_once( 'classes/class-mmm-copyright.php' );
		include_once( 'classes/class-'.MMM_FC_PLUGIN_ID_SHORT_MINUS.'-settings.php' );
		include_once( 'classes/class-'.MMM_FC_PLUGIN_ID_SHORT_MINUS.'-register.php' );
		add_action('init', MMM_FC_PLUGIN_ID_SHORT.'_register::plugin_load_textdomain');
		
		// ---------------------------------------------------------------------------------------------------------------------
		// 	ADMIN
		// ---------------------------------------------------------------------------------------------------------------------
			
			// includes
			include_once( 'classes/class-'.MMM_FC_PLUGIN_ID_SHORT_MINUS.'-admin-menu-items.php' );
			include_once( 'classes/class-'.MMM_FC_PLUGIN_ID_SHORT_MINUS.'-admin-pages.php' );
			include_once( 'classes/class-'.MMM_FC_PLUGIN_ID_SHORT_MINUS.'-admin-functions.php' );
			
			// actions: registering
			register_activation_hook( __FILE__, array( MMM_FC_PLUGIN_ID_SHORT.'_register', 'activate' ) );
			register_deactivation_hook( __FILE__, array( MMM_FC_PLUGIN_ID_SHORT.'_register', 'deactivate' ) );
			register_uninstall_hook( __FILE__, array( MMM_FC_PLUGIN_ID_SHORT.'_register', 'uninstall' ) );
			
			// actions
			add_action( 'admin_init', MMM_FC_PLUGIN_ID_SHORT.'_register::load_this_plugin' );			
			add_action( 'admin_init', MMM_FC_PLUGIN_ID_SHORT.'_settings::settings_fields_init' );
			add_action( 'admin_init', MMM_FC_PLUGIN_ID_SHORT.'_settings::settings_fields_update' );
			add_action( 'admin_init', MMM_FC_PLUGIN_ID_SHORT.'_register::admin_styles' );
			add_action( 'admin_init', MMM_FC_PLUGIN_ID_SHORT.'_register::admin_scripts' );
			add_action( 'admin_menu', MMM_FC_PLUGIN_ID_SHORT.'_admin_menu_items::add_admin_menu_items' );
			
			// filters
			add_filter( 'plugin_action_links', MMM_FC_PLUGIN_ID_SHORT.'_admin_menu_items::add_plugin_settings_link', 2, 2);
			
		// ---------------------------------------------------------------------------------------------------------------------
		// 	FRONTEND
		// ---------------------------------------------------------------------------------------------------------------------
			
			// includes
			include_once( 'classes/class-'.MMM_FC_PLUGIN_ID_SHORT_MINUS.'-frontend-widget.php' );
			
			// actions
			add_action('wp_enqueue_scripts', MMM_FC_PLUGIN_ID_SHORT.'_register::frontend_scripts');
			add_action('wp_enqueue_scripts', MMM_FC_PLUGIN_ID_SHORT.'_register::frontend_styles');
			add_action('wp_head', MMM_FC_PLUGIN_ID_SHORT.'_frontend_widget::add_ajax_url');
			
			add_action( 'wp_ajax_create_random_captcha', MMM_FC_PLUGIN_ID_SHORT.'_frontend_widget::create_random_captcha', 10 );		
			add_action( 'wp_ajax_nopriv_create_random_captcha', MMM_FC_PLUGIN_ID_SHORT.'_frontend_widget::create_random_captcha', 10 );
