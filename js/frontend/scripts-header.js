	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	JAVASCRIPT FUNCTIONS
	//	@since									MultiMediaMonster
	/*
		On loading the website in the head ... what should we do?
	*/
	// ---------------------------------------------------------------------------------------------------------------------

		// functions
		
		function getCookie(name) 
		{
			var cookie_name						= 	name + "=";
			var cookie_splitted					= 	document.cookie.split(';');
			for(var i = 0; i < cookie_splitted.length; i++)
			{
				var cookie_val					= 	cookie_splitted[i];
				while (cookie_val.charAt(0)==' ') 
				{
					cookie_val 					= 	cookie_val.substring(1,cookie_val.length);
				}
				if (cookie_val.indexOf(cookie_name) == 0) 
				{
					return cookie_val.substring(cookie_name.length,cookie_val.length);
				}
			}
			return null;
		}
		jQuery( document ).ready(function()
		{
			// ---------------------------------------------------------------------------------------------------------------------
			// 	CAPTCHA
			// ---------------------------------------------------------------------------------------------------------------------
				
				var fancy_captcha_container_counter 	= 	1;
				var form_selector_find					= 	mmm_fc_js_variables_array_header.mmm_fc_form_selectors.split(',');
				
				for (var i = 1; i <= form_selector_find.length; i++) 
				{
					var selector 						= 	form_selector_find[i-1];
					jQuery( selector ).each( function()
					{
						var create 					= 	'';
						create 						+= 	'<div id="fancy-captcha-container-'+fancy_captcha_container_counter+'" class="form-row form-row-wide fancy-captcha-container">';
						create 						+= 	'<label for="fancy-captcha">';
						create 						+= 	mmm_fc_js_variables_array_header.mmm_fc_label;
						create 						+= 	'</label>';
						create 						+= 	'<div class="fancy-captcha-container-ajax"></div>';
						create 						+= 	'<input type="hidden" id="fancy-captcha-hidden-'+fancy_captcha_container_counter+'" name="fancy-captcha" value="" />';
						create 						+= 	'<input type="hidden" id="fancy-captcha-hidden-id-'+fancy_captcha_container_counter+'" name="fancy-captcha-id" value="'+fancy_captcha_container_counter+'" />';
						create 						+= 	'</div>';
						
						if (mmm_fc_js_variables_array_header.mmm_fc_position == 1)
						{
							jQuery(this).before(create);
						}
						else if (mmm_fc_js_variables_array_header.mmm_fc_position == 2)
						{
							jQuery(this).append(create);
						} 
						jQuery("#fancy-captcha-container-"+fancy_captcha_container_counter).captcha();
						fancy_captcha_container_counter++;
					});
				}
				function check_captcha(the_form, e)
				{
					jQuery('.fancy-captcha-container-error').hide('slow', function (){ jQuery(this).remove(); });
					var formfield_find				= 	the_form.find('input[name=fancy-captcha-id]').val();
					var posted						= 	the_form.find('input[name=fancy-captcha]').val();
					var cookie 						= 	getCookie('fancy-captcha-'+formfield_find);
					if (posted != cookie)
					{
						var create 					= 	'';
						create 						+= 	'<ul class="fancy-captcha-container-error">';
						create 						+= 	'<li>';
						if (!posted)
						{
							create 					+= 	mmm_fc_js_variables_array_header.mmm_fc_error_empty;
						}
						else if (posted != cookie)
						{
							create 					+= 	mmm_fc_js_variables_array_header.mmm_fc_error_incorrect;
						}
						create 						+= 	'</li>';
						create 						+= 	'</ul>';
						jQuery('#fancy-captcha-container-'+formfield_find).before(create);
						jQuery('.fancy-captcha-container-error').show('slow');
						e.preventDefault();
						return false;
					}
				}
				jQuery( 'form' ).each( function()
				{
					the_form								=	jQuery(this);
					has_input_submit						=	the_form.find('input[type=submit]');
					has_button_submit						=	the_form.find('button[type=submit]');
					has_image_submit						=	the_form.find('input[type=image]');
					
					has_fancy_captcha						=	the_form.find('input[name=fancy-captcha]');
					if (has_fancy_captcha.length > 0)
					{
						has_input_submit.click( function(e)
						{
							check_captcha(the_form, e);
						});
						has_button_submit.click( function(e)
						{
							check_captcha(the_form, e);
						});
						has_image_submit.click( function(e)
						{
							check_captcha(the_form, e);
						});
					}
				});
		});