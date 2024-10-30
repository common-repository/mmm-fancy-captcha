<?php
class mmm_fc_admin_menu_items 
{

	// ---------------------------------------------------------------------------------------------------------------------
	// 	THE ADMIN MENU ITEMS
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function add_admin_menu_items ()
		{
			add_menu_page( '', MMM_FC_PLUGIN_NAME, 'manage_options', MMM_FC_PLUGIN_ID_LONG_MINUS.'-settings', array( MMM_FC_PLUGIN_ID_SHORT.'_admin_pages', 'add_admin_page' ), MMM_FC_PLUGIN_URL.'/images/admin/menu-icon.png' );
		}	
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	ADD SETTINGS PAGE TO PLUGIN PAGE
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function add_plugin_settings_link($actions, $file) 
		{			
			if(false !== strpos($file, MMM_FC_PLUGIN_ID_LONG_MINUS.'.php'))
			{
			 	$actions['settings']						= 	'<a href="admin.php?page='.MMM_FC_PLUGIN_ID_LONG_MINUS.'-settings">'.__('Settings', MMM_FC_PLUGIN_TRANSLATE).'</a>';
			}
			return $actions; 
		}
}