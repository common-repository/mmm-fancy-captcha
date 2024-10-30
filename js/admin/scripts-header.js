	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	JAVASCRIPT FUNCTIONS
	//	@since									MultiMediaMonster
	/*
		On loading the admin in the head ... what should we do?
	*/
	// ---------------------------------------------------------------------------------------------------------------------
		
		// functions
		jQuery( document ).ready(function()
		{
			jQuery("body").delegate(".wrap.fancy-captcha .nav-tab","click",function(e)
			{
				var selected_tab_class 						= 	jQuery(this).attr('class');
				// the button class
				jQuery(".nav-tab").each(function(index, element) 
				{
					jQuery(this).removeClass('nav-tab-active');
				});
				jQuery(this).addClass('nav-tab-active');
				// the content class
				jQuery(".nav-tab-content").each(function(index, element) 
				{
					var this_tab_class 						= 	jQuery(this).attr('class');
					if (selected_tab_class.search('active') < 0)
					{
						// remove active class and add active class to the selected
						jQuery(this).removeClass('nav-tab-active-content');
					}
					if (selected_tab_class.replace('nav-tab', 'nav-tab-content') == this_tab_class)
					{
						jQuery(this).addClass('nav-tab-active-content');
					}
				});
			});
			jQuery('textarea[name="mmm_fc_settings[form_selectors]"]').keypress(function(event) 
			{
				if(event.which == '13') 
				{
				  	return false;
				}
			});
			jQuery('.wrap.fancy-captcha form.reset input#reset').click(function() 
			{
				return confirm(mmm_fc_js_variables_array.mmm_fc_reset_confirm_question);
			});
		});