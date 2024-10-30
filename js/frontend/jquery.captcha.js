(function( $ )
{
	$.fn.captcha = function(options)
	{
		var items_names 				= Array();
		var path		 				= parent.document.location.hostname;
		var formId		 				= $(this).attr('id');

		var defaults = 
		{ 
			items_uri					: mmm_fc_js_variables_array_jquery.mmm_fc_uri,
			items_uris					: mmm_fc_js_variables_array_jquery.mmm_fc_array_uris.split(','),
			items_names					: mmm_fc_js_variables_array_jquery.mmm_fc_array_names.split(',')
	  	};
		var options 					= $.extend(defaults, options);
		// create the element and images
		var create 						= '';
		create 							+= "<div class='content loading'>";
		create 							+= "<div class='left'>";
		create 							+= "<div class='fancy-captcha-loader'></div>";
		create 							+= "<ul>";
		for(var i=1; i <= options.items_names.length; i++)
		{
			var img_path				= options.items_uris[i];
			create 						+= "<li class='element-"+i+"'><img src='" + img_path + "' alt='' /></li>";
		}
		create 							+= "</ul>";
		create 							+= "</div>";
		create 							+= "<div class='right'><div class='arrow'></div></div>";
		create 							+= "</div>";
		$(this).find(".fancy-captcha-container-ajax").html(create);
		
		$.ajax({
			type						: 	"POST",
			url							: 	window.ajaxurl_captcha,
			data						: 	'action=create_random_captcha',
			cache						: 	false,
			success						:	function (data) 
											{					
												var hidden_id				=	formId.replace('container', 'hidden');
												var cookie_id				=	formId.replace('fancy-captcha-container-', '');
												var rand					= 	data;
												// create a unique cookie for each captcha form
												document.cookie 			= 	"fancy-captcha-"+cookie_id+"="+rand+"; domain="+path+";";
												$("#" + formId + " span.replace .fancy-captcha-loader" ).hide(
													function () 
													{
														$("#" + formId + " span.replace").html(options.items_names[rand-1]);
														$("#" + formId + " .content .left .fancy-captcha-loader").hide(
															function () 
															{
																$("#" + formId + " .content").removeClass('loading');
															}
														);
													}
												);
												
												$("#" + formId + " input[id='"+hidden_id+"']").attr('value', '');
												if (mmm_fc_js_variables_array_jquery.mmm_fc_mobile == true)
												{
													for(var i=1; i <= options.items_names.length; i++)
													{
														$("#" + formId + " .element-" + i).addClass('selectable');
														$("#" + formId + " .element-" + i).click(function() 
														{
															$('.selectable img').animate({'opacity' : 1});
															// hide all cloned elements
															$(".fancy-captcha-cloned").hide("slow", function () { $(this).remove(); } );
															// copy and emtpy the element
															var new_i				 	= 	$(this).attr('class');
															var new_i	 				= 	new_i.replace("element-", '');
															var new_i 					= 	new_i.replace(" selectable", '');
															
															// set hidden input
															$("#" + formId + " input[id='"+hidden_id+"']").val(new_i.trim());
															
															$(this).clone().addClass("fancy-captcha-cloned").css({
																'position' 				: 	'absolute', 
																'marginLeft' 			: 	$(this).width() * (new_i - 1)+'px'
															}).insertBefore($(this)).animate({
																marginLeft				: 	$("#" + formId + " .left").width()+"px"
															});
															$(this).children().animate({'opacity' : 0});
															
															if(new_i == rand)
															{
																for(var j=1; j <= options.items_names.length; j++)
																{
																	if(j != rand)
																	{
																		$("#" + formId + " .element-" + j +" img").addClass("gray");
																	}
																	$("#" + formId + " .element-" + j).unbind();
																	$("#" + formId + " .element-" + j).css("cursor", "default");
																}
															}
														});
													}
												}
												else
												{
													for(var i=1; i <= options.items_names.length; i++)
													{
														$("#" + formId + " .element-" + i).addClass('selectable');
														$("#" + formId + " .element-" + i).draggable({ containment: '#' + formId + ' .fancy-captcha-container-ajax', stack: ".selectable" });
													}
													
													$("#" + formId + " .right").droppable(
													{
														drop					: 
																					function(event, ui) 
																					{
																						var draggedClass 		= ui.draggable.attr('class').split(' ');
																						var draggedNr 			= draggedClass[0].replace('element-', '');																						
																						if(rand == draggedNr)
																						{
																							for(var i=1; i <= options.items_names.length; i++)
																							{
																								$("#" + formId + " .element-" + i).draggable("disable");											
																								$("#" + formId + " .element-" + i).css("cursor", "default");
																								if(i != rand)
																								{
																									$("#" + formId + " .element-" +i+" img").addClass("gray");
																								}
																							}
																						}
																						$(this).addClass("ui-state-highlight");
																						$("#" + formId + " input[id='"+hidden_id+"']").val(draggedNr.trim());
																					},
														tolerance				: 'touch'
													});
												}
											}
		});
	};

})( jQuery );