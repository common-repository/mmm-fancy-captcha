<?php
class mmm_fc_frontend_widget 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	SET AJAX URL
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function add_ajax_url()
		{
			$html																	= 	'<script type="text/javascript">';
			$html 																	.= 	'var ajaxurl_captcha = "' . admin_url( 'admin-ajax.php' ) . '";';
			$html 																	.= 	'</script>';
			echo $html;
		}	
		static function create_random_captcha()
		{
			$from_rand																= 	1;
			$to_rand																= 	count(mmm_fc_settings::shapes_to_return());
			$rand 																	= 	rand($from_rand,$to_rand);
			echo $rand;
			die ();
		}
}
?>