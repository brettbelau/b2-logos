(function($){
$(document).ready(function(){
	
	// inputs
	b2logos_wpml_current_lang = $('#b2logos_wpml_current_lang');
	
	b2logos_id = $('#b2logos_id');
	b2logos_categoriesList = $("#b2logos_categoriesList input[name='tax_input[b2logocategory][]']");
	b2logos_columnsNumberList = $('#b2logos_columnsNumberList');
	b2logos_itemsHeightPercentage = $('#b2logos_itemsHeightPercentage');
	b2logos_layout = $('#b2logos_layout');
	b2logos_tooltipList = $('#b2logos_tooltipList');
	b2logos_responsiveList = $('#b2logos_responsiveList');
	b2logos_grayscaleList = $('#b2logos_grayscaleList');
	b2logos_orderByList = $('#b2logos_orderByList');
	b2logos_orderList = $('#b2logos_orderList');
	b2logos_bgColorInput = $('#b2logos_bgColorInput');
	b2logos_NumberInput = $('#b2logos_NumberInput');
	
	b2logos_marginBetweenItems = $('#b2logos_marginBetweenItems');
	b2logos_border = $('#b2logos_border');
	b2logos_borderColor = $('#b2logos_borderColor');
	b2logos_borderRadius = $('#b2logos_borderRadius');
	
	
	b2logos_onClickAction = $('#b2logos_onClickAction');
	b2logos_detailsArea_padding = $('#b2logos_detailsArea_padding');
	b2logos_detailsArea_bgColor = $('#b2logos_detailsArea_bgColor');
	b2logos_detailsArea_closeBtnColor = $('#b2logos_detailsArea_closeBtnColor');
	b2logos_detailsArea_border = $('#b2logos_detailsArea_border');
	b2logos_detailsArea_borderColor = $('#b2logos_detailsArea_borderColor');
	b2logos_detailsArea_logo = $('#b2logos_detailsArea_logo');
	b2logos_detailsArea_logoBorder = $('#b2logos_detailsArea_logoBorder');
	b2logos_detailsArea_logoBorderColor = $('#b2logos_detailsArea_logoBorderColor');
	b2logos_detailsArea_logoBgColor = $('#b2logos_detailsArea_logoBgColor');
	
	
	b2logos_autoplay = $('#b2logos_autoplay');
	b2logos_slider_circular = $('#b2logos_slider_circular');
	b2logos_transitionEffect = $('#b2logos_transitionEffect');
	b2logos_easingFunction = $('#b2logos_easingFunction');
	b2logos_scrollduration = $('#b2logos_scrollduration');
	b2logos_pauseduration = $('#b2logos_pauseduration');
	b2logos_buttonsbordercolor = $('#b2logos_buttonsbordercolor');
	b2logos_buttonsbgcolor = $('#b2logos_buttonsbgcolor');
	b2logos_buttonsarrowscolor = $('#b2logos_buttonsarrowscolor');
	b2logos_slider_pagination = $('#b2logos_slider_pagination');
	b2logos_slider_pagination_color = $('#b2logos_slider_pagination_color');
	
	b2logos_hovereffect = $('#b2logos_hovereffect');
	b2logos_hoverEffectColor = $('#b2logos_hoverEffectColor');
	
	
	
	
	
	b2logos_font_style = $('#b2logos_font_style');
	b2logos_title_font_family = $('#b2logos_title_font_family');
	b2logos_title_font_color = $('#b2logos_title_font_color');
	b2logos_title_font_size = $('#b2logos_title_font_size');
	b2logos_title_font_weight = $('#b2logos_title_font_weight');
	b2logos_text_font_family = $('#b2logos_text_font_family');
	b2logos_text_font_color = $('#b2logos_text_font_color');
	b2logos_text_font_size = $('#b2logos_text_font_size');
	b2logos_excerptText_length = $('#b2logos_excerptText_length');
	b2logos_list_border = $('#b2logos_list_border');
	b2logos_listBorderColor = $('#b2logos_listBorderColor');
	b2logos_list_border_style = $('#b2logos_list_border_style');
	b2logos_moreLinkText = $('#b2logos_moreLinkText');
	b2logos_more_link_text_color = $('#b2logos_more_link_text_color');
	
	b2logos_pagination = $('#b2logos_pagination');
	b2logos_pagination_border_style = $('#b2logos_pagination_border_style');
	b2logos_pagination_border_color = $('#b2logos_pagination_border_color');
	b2logos_pagination_bg_color = $('#b2logos_pagination_bg_color');
	b2logos_pagination_font_color = $('#b2logos_pagination_font_color');
	b2logos_pagination_font_size = $('#b2logos_pagination_font_size');
	b2logos_pagination_font_family = $('#b2logos_pagination_font_family');
	b2logos_pagination_current_font_color = $('#b2logos_pagination_current_font_color');
	b2logos_pagination_current_bg_color = $('#b2logos_pagination_current_bg_color');
	b2logos_pagination_current_border_color = $('#b2logos_pagination_current_border_color');
	b2logos_pagination_align = $('#b2logos_pagination_align');
	b2logos_pagination_divider_style = $('#b2logos_pagination_divider_style');
	b2logos_pagination_divider_color = $('#b2logos_pagination_divider_color');
	
	
	
	
	b2logos_controls = $('input,select');
	b2logos_buttons = $('.button-primary');
	
	// Sections titles and rows containers
	b2logos_sectionsTitles = $('.b2logos_sectionTitle');
	b2logos_rowsContainers = $('.b2logos_rowsContainer');
	
	
	// options 
	
	b2logos_slider_options = $('.b2logos_slider_option');
	b2logos_slider_pagination_options = $('.b2logos_slider_pagination_option');
	b2logos_grid_options = $('.b2logos_grid_option');
	b2logos_list_options = $('.b2logos_list_option');
	b2logos_border_options = $('.b2logos_border_option');
	b2logos_hovereffect_options = $('.b2logos_hovereffect_option');
	b2logos_font_options = $('.b2logos_font_option');
	b2logos_list_border_options = $('.b2logos_list_border_option');
	b2logos_details_area_options = $('.b2logos_details_area_option');
	b2logos_details_area_border_options = $('.b2logos_details_area_border_option');
	b2logos_details_area_logo_options = $('.b2logos_details_area_logo_option');
	b2logos_details_area_logoborder_options = $('.b2logos_details_area_logoborder_option');
	b2logos_pagination_options = $('.b2logos_pagination_option');
	b2logos_pagination_border_options = $('.b2logos_pagination_border_option');
	b2logos_pagination_divider_options = $('.b2logos_pagination_divider_option');
	
	
	
	// Current menu page
	
	menu_posts_b2logo = $('#menu-posts-b2logo');
	menu_posts_b2logo_a = menu_posts_b2logo.children('a');
	menu_posts_b2logo_li_current = menu_posts_b2logo.find('li.current');
					
	if( menu_posts_b2logo_li_current.length && menu_posts_b2logo.hasClass('wp-not-current-submenu') ) {
		menu_posts_b2logo.removeClass('wp-not-current-submenu');
		menu_posts_b2logo.addClass('wp-has-current-submenu');
		menu_posts_b2logo.addClass('wp-menu-open');
						
		menu_posts_b2logo_a.removeClass('wp-not-current-submenu');
		menu_posts_b2logo_a.addClass('wp-has-current-submenu');
	}
	
	
					
	if(b2logos_layout.val() == 'slider') {
		b2logos_grid_options.slideUp();
		b2logos_list_options.slideUp();
		b2logos_slider_options.slideDown();
		b2logos_pagination_options.slideUp('slow');
		
		if( b2logos_slider_pagination.val() == 'disabled' ) {
			b2logos_slider_pagination_options.slideUp('slow');
		}
		else {
			b2logos_slider_pagination_options.slideDown('slow');
		}
	}
	else if(b2logos_layout.val() == 'grid') {
		b2logos_slider_options.slideUp();
		b2logos_list_options.slideUp();
		b2logos_grid_options.slideDown();
		
		if( b2logos_pagination.val() == 'disabled' ) {
			b2logos_pagination_options.slideUp('slow');
		}
		else {
			b2logos_pagination_options.slideDown('slow');
			
			if( b2logos_pagination_border_style.val() == 'none' ) {
				b2logos_pagination_border_options.slideUp('slow');
			}
			
			if( b2logos_pagination_divider_style.val() == 'none' ) {
				b2logos_pagination_divider_options.slideUp('slow');
			}
		}
	}
	else if(b2logos_layout.val() == 'list') {
		b2logos_slider_options.slideUp();
		b2logos_grid_options.slideUp();
		b2logos_list_options.slideDown();
		
		if( b2logos_pagination.val() == 'disabled' ) {
			b2logos_pagination_options.slideUp('slow');
		}
		else {
			b2logos_pagination_options.slideDown('slow');
			
			if( b2logos_pagination_border_style.val() == 'none' ) {
				b2logos_pagination_border_options.slideUp('slow');
			}
			
			if( b2logos_pagination_divider_style.val() == 'none' ) {
				b2logos_pagination_divider_options.slideUp('slow');
			}
		}
	}
		
	if(b2logos_border.val() == 'disabled') {
		b2logos_border_options.slideUp();
	}
	
	
	
	if(b2logos_list_border.val() == 'disabled') {
		b2logos_list_border_options.slideUp();
	}
	
	if(b2logos_hovereffect.val() == '' || b2logos_hovereffect.val() == 'effect4') {
		b2logos_hovereffect_options.slideUp();
	}
	
	if(b2logos_onClickAction.val() != 'showDetails') {
		b2logos_details_area_options.slideUp();
	}
	else {
		b2logos_details_area_options.slideDown();
	}
	
	if(b2logos_font_style.val() == 'default') {
		b2logos_font_options.slideUp();
	}
	
	if(b2logos_detailsArea_border.val() == 'disabled') {
		b2logos_details_area_border_options.slideUp();
	}
	
	if(b2logos_detailsArea_logoBorder.val() == 'disabled') {
		b2logos_details_area_logoborder_options.slideUp();
	}
	
	if(b2logos_detailsArea_logo.val() == 'disabled') {
		b2logos_details_area_logo_options.slideUp();
	}
	
	
	b2logos_layout.change(function(){
	
		if(b2logos_layout.val() == 'slider') {
			b2logos_grid_options.slideUp();
			b2logos_list_options.slideUp();
			b2logos_slider_options.slideDown();
			b2logos_pagination_options.hide();
			
			if( b2logos_slider_pagination.val() == 'disabled' ) {
				b2logos_slider_pagination_options.slideUp('slow');
			}
			else {
				b2logos_slider_pagination_options.slideDown('slow');
			}
			
			if(b2logos_onClickAction.val() != 'showDetails') {
				b2logos_details_area_options.slideUp();
			}
			else {
				b2logos_details_area_options.slideDown();
			}
		}
		else if(b2logos_layout.val() == 'grid') {
			b2logos_slider_options.slideUp();
			b2logos_list_options.slideUp();
			b2logos_grid_options.slideDown();
			
			if(b2logos_onClickAction.val() != 'showDetails') {
				b2logos_details_area_options.slideUp();
			}
			else {
				b2logos_details_area_options.slideDown();
			}
			
			if( b2logos_pagination.val() == 'disabled' ) {
				b2logos_pagination_options.hide();
			}
			else {
				b2logos_pagination_options.show();
				
				if( b2logos_pagination_border_style.val() == 'none' ) {
					b2logos_pagination_border_options.slideUp('slow');
				}
				
				if( b2logos_pagination_divider_style.val() == 'none' ) {
					b2logos_pagination_divider_options.slideUp('slow');
				}
			}
		}
		else if(b2logos_layout.val() == 'list') {
			b2logos_slider_options.slideUp();
			b2logos_grid_options.slideUp();
			
			
			if(b2logos_onClickAction.val() != 'showDetails') {
				b2logos_details_area_options.slideUp();
			}
			else {
				b2logos_details_area_options.slideDown();
			}
			
			b2logos_list_options.slideDown();
			
			if(b2logos_font_style.val() == 'custom') {
				b2logos_font_options.slideDown();
			}
			else if(b2logos_font_style.val() == 'default') {
				b2logos_font_options.slideUp();
			}
			
			if(b2logos_list_border.val() == 'enabled') {
				b2logos_list_border_options.slideDown();
			}
			else if(b2logos_list_border.val() == 'disabled') {
				b2logos_list_border_options.slideUp();
			}
			
			if( b2logos_pagination.val() == 'disabled' ) {
				b2logos_pagination_options.hide();
			}
			else {
				b2logos_pagination_options.show();
				
				if( b2logos_pagination_border_style.val() == 'none' ) {
					b2logos_pagination_border_options.slideUp('slow');
				}
				
				if( b2logos_pagination_divider_style.val() == 'none' ) {
					b2logos_pagination_divider_options.slideUp('slow');
				}
			}
		}
		
		
		if(b2logos_detailsArea_logo.val() == 'enabled') {
			b2logos_details_area_logo_options.slideDown();
				
			if(b2logos_detailsArea_logoBorder.val() == 'enabled') {
				b2logos_details_area_logoborder_options.slideDown();
			}
			else if(b2logos_detailsArea_logoBorder.val() == 'disabled') {
				b2logos_details_area_logoborder_options.slideUp();
			}
		}
		else if(b2logos_detailsArea_logo.val() == 'disabled') {
			b2logos_details_area_logo_options.slideUp();
		}
		
	
	});
	
	
	b2logos_border.change(function(){
	
		if(b2logos_border.val() == 'enabled') {
			b2logos_border_options.slideDown();
		}
		else if(b2logos_border.val() == 'disabled') {
			b2logos_border_options.slideUp();
		}
		
	});
	
	b2logos_font_style.change(function(){
	
		if(b2logos_font_style.val() == 'custom') {
			b2logos_font_options.slideDown();
		}
		else if(b2logos_font_style.val() == 'default') {
			b2logos_font_options.slideUp();
		}
		
	});
	
	b2logos_list_border.change(function(){
	
		if(b2logos_list_border.val() == 'enabled') {
			b2logos_list_border_options.slideDown();
		}
		else if(b2logos_list_border.val() == 'disabled') {
			b2logos_list_border_options.slideUp();
		}
		
	});
	
	b2logos_slider_pagination.change(function(){
		if( b2logos_slider_pagination.val() == 'disabled' ) {
				b2logos_slider_pagination_options.slideUp('slow');
			}
			else {
				b2logos_slider_pagination_options.slideDown('slow');
			}
	});
	
	b2logos_hovereffect.change(function(){
	
		if(b2logos_hovereffect.val() == '' || b2logos_hovereffect.val() == 'effect4') {
			b2logos_hovereffect_options.slideUp();
		}
		else {
			b2logos_hovereffect_options.slideDown();
		}
		
	});
	
	b2logos_onClickAction.change(function(){
		
		if(b2logos_onClickAction.val() == 'showDetails') {
			b2logos_details_area_options.slideDown();
			
			if(b2logos_detailsArea_border.val() == 'enabled') {
				b2logos_details_area_border_options.slideDown();
			}
			else if(b2logos_detailsArea_border.val() == 'disabled') {
				b2logos_details_area_border_options.slideUp();
			}
			
			if(b2logos_detailsArea_logo.val() == 'enabled') {
				b2logos_details_area_logo_options.slideDown();
				
				if(b2logos_detailsArea_logoBorder.val() == 'enabled') {
					b2logos_details_area_logoborder_options.slideDown();
				}
				else if(b2logos_detailsArea_logoBorder.val() == 'disabled') {
					b2logos_details_area_logoborder_options.slideUp();
				}
			}
			else if(b2logos_detailsArea_logo.val() == 'disabled') {
				b2logos_details_area_logo_options.slideUp();
			}
			
			
			if(b2logos_font_style.val() == 'custom') {
				b2logos_font_options.slideDown();
			}
			else if(b2logos_font_style.val() == 'default') {
				b2logos_font_options.slideUp();
			}
			
		}
		else {
			b2logos_details_area_options.slideUp();
			
			if(b2logos_layout.val() == 'list') {
				b2logos_list_options.slideDown();
			}
		}
		
	});
	
	
	b2logos_detailsArea_border.change(function(){
		
		if(b2logos_detailsArea_border.val() == 'enabled') {
			b2logos_details_area_border_options.slideDown();
		}
		else if(b2logos_detailsArea_border.val() == 'disabled') {
			b2logos_details_area_border_options.slideUp();
		}
		
	});
	
	
	b2logos_detailsArea_logoBorder.change(function(){
		
		if(b2logos_detailsArea_logoBorder.val() == 'enabled') {
			b2logos_details_area_logoborder_options.slideDown();
		}
		else if(b2logos_detailsArea_logoBorder.val() == 'disabled') {
			b2logos_details_area_logoborder_options.slideUp();
		}
		
	});
	
	b2logos_detailsArea_logo.change(function(){
		
		if(b2logos_detailsArea_logo.val() == 'enabled') {
			b2logos_details_area_logo_options.slideDown();
			
			if(b2logos_detailsArea_logoBorder.val() == 'enabled') {
				b2logos_details_area_logoborder_options.slideDown();
			}
			else if(b2logos_detailsArea_logoBorder.val() == 'disabled') {
				b2logos_details_area_logoborder_options.slideUp();
			}
		}
		else if(b2logos_detailsArea_logo.val() == 'disabled') {
			b2logos_details_area_logo_options.slideUp();
		}
		
	});
	
	// Pagination
	b2logos_pagination.change(function(){
	
		if( b2logos_pagination.val() == 'disabled' ) {
			b2logos_pagination_options.slideUp('slow');
		}
		else {
			b2logos_pagination_options.slideDown('slow');
			
			if( b2logos_pagination_border_style.val() == 'none' ) {
				b2logos_pagination_border_options.slideUp('slow');
			}
			
			if( b2logos_pagination_divider_style.val() == 'none' ) {
				b2logos_pagination_divider_options.slideUp('slow');
			}
		}
		
	});
	
	
	// Pagination Border Style
	b2logos_pagination_border_style.change(function(){
		
		if( b2logos_pagination_border_style.val() == 'none' ) {
			b2logos_pagination_border_options.slideUp('slow');
		}
		else {
			b2logos_pagination_border_options.slideDown('slow');
		}
		
	});

	// Pagination Divider Style
	b2logos_pagination_divider_style.change(function(){
		
		if( b2logos_pagination_divider_style.val() == 'none' ) {
			b2logos_pagination_divider_options.slideUp('slow');
		}
		else {
			b2logos_pagination_divider_options.slideDown('slow');
		}
		
	});
	
	
	// containers
	
	b2logos_div_shortcode = $('#b2logos_div_shortcode');
	b2logos_shortcode = $('#b2logos_shortcode');
	
	b2logos_gene_short_preview = $('#b2logos_gene_short_preview');
	
	b2logos_generate_shortcode();
	
	
	b2logos_controls.change(function(){
		b2logos_generate_shortcode();
	});
	
	b2logos_buttons.click(function(){
		b2logos_generate_shortcode();
	});
	
	
	
	b2logos_sectionsTitles.click(function(){
		b2logos_rowsContainers.removeClass('b2logos_rowsContainerOpend');
		$(this).next().addClass('b2logos_rowsContainerOpend');
	});
	
	
	
	if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){

		jQuery( '#b2logos_hoverEffectColor' ).wpColorPicker();
		jQuery( '#b2logos_borderColor' ).wpColorPicker();
		jQuery( '#b2logos_bgColorInput' ).wpColorPicker();
		jQuery( '#b2logos_buttonsbordercolor' ).wpColorPicker();
		jQuery( '#b2logos_buttonsbgcolor' ).wpColorPicker();
		jQuery( '#b2logos_slider_pagination_color' ).wpColorPicker();
		jQuery( '#b2logos_title_font_color' ).wpColorPicker();
		jQuery( '#b2logos_text_font_color' ).wpColorPicker();
		jQuery( '#b2logos_listBorderColor' ).wpColorPicker();
		jQuery( '#b2logos_more_link_text_color' ).wpColorPicker();
		jQuery( '#b2logos_detailsArea_bgColor' ).wpColorPicker();
		jQuery( '#b2logos_detailsArea_closeBtnColor' ).wpColorPicker();
		jQuery( '#b2logos_detailsArea_borderColor' ).wpColorPicker();
		jQuery( '#b2logos_detailsArea_logoBorderColor' ).wpColorPicker();
		jQuery( '#b2logos_detailsArea_logoBgColor' ).wpColorPicker();
		jQuery( '#b2logos_pagination_border_color' ).wpColorPicker();
		jQuery( '#b2logos_pagination_bg_color' ).wpColorPicker();
		jQuery( '#b2logos_pagination_font_color' ).wpColorPicker();
		jQuery( '#b2logos_pagination_current_font_color' ).wpColorPicker();
		jQuery( '#b2logos_pagination_current_bg_color' ).wpColorPicker();
		jQuery( '#b2logos_pagination_current_border_color' ).wpColorPicker();
		jQuery( '#b2logos_pagination_divider_color' ).wpColorPicker();

	}
	else {
		//We use farbtastic if the WordPress color picker widget doesn't exist
		jQuery('#b2logos_hoverEffectColor_colorpicker').farbtastic('#b2logos_hoverEffectColor');
		jQuery('#b2logos_borderColor_colorpicker').farbtastic('#b2logos_borderColor');
		jQuery('#b2logos_bgColorInput_colorpicker').farbtastic('#b2logos_bgColorInput');
		jQuery('#b2logos_buttonsbordercolor_colorpicker').farbtastic('#b2logos_buttonsbordercolor');
		jQuery('#b2logos_buttonsbgcolor_colorpicker').farbtastic('#b2logos_buttonsbgcolor');
		jQuery('#b2logos_slider_pagination_color_colorpicker').farbtastic('#b2logos_slider_pagination_color');
		jQuery('#b2logos_title_font_color_colorpicker').farbtastic('#b2logos_title_font_color');
		jQuery('#b2logos_text_font_color_colorpicker').farbtastic('#b2logos_text_font_color');
		jQuery('#b2logos_listBorderColor_colorpicker').farbtastic('#b2logos_listBorderColor');
		jQuery('#b2logos_more_link_text_color_colorpicker').farbtastic('#b2logos_more_link_text_color');
		jQuery('#b2logos_detailsArea_bgColor_colorpicker').farbtastic('#b2logos_detailsArea_bgColor');
		jQuery('#b2logos_detailsArea_closeBtnColor_colorpicker').farbtastic('#b2logos_detailsArea_closeBtnColor');
		jQuery('#b2logos_detailsArea_borderColor_colorpicker').farbtastic('#b2logos_detailsArea_borderColor');
		jQuery('#b2logos_detailsArea_logoBorderColor_colorpicker').farbtastic('#b2logos_detailsArea_logoBorderColor');
		jQuery('#b2logos_detailsArea_logoBgColor_colorpicker').farbtastic('#b2logos_detailsArea_logoBgColor');
		jQuery('#b2logos_pagination_border_color_colorpicker').farbtastic('#b2logos_pagination_border_color');
		jQuery('#b2logos_pagination_bg_color_colorpicker').farbtastic('#b2logos_pagination_bg_color');
		jQuery('#b2logos_pagination_font_color_colorpicker').farbtastic('#b2logos_pagination_font_color');
		jQuery('#b2logos_pagination_current_font_color_colorpicker').farbtastic('#b2logos_pagination_current_font_color');
		jQuery('#b2logos_pagination_current_bg_color_colorpicker').farbtastic('#b2logos_pagination_current_bg_color');
		jQuery('#b2logos_pagination_current_border_color_colorpicker').farbtastic('#b2logos_pagination_current_border_color');
		jQuery('#b2logos_pagination_divider_color_colorpicker').farbtastic('#b2logos_pagination_divider_color');
			
		b2logos_farbtastic_inputs = $('#b2logos_slider_pagination_color,#b2logos_pagination_border_color,#b2logos_pagination_bg_color,#b2logos_pagination_font_color,#b2logos_pagination_current_font_color,#b2logos_pagination_current_bg_color,#b2logos_pagination_current_border_color,#b2logos_pagination_divider_color,#b2logos_hoverEffectColor,#b2logos_borderColor,#b2logos_bgColorInput,#b2logos_buttonsbordercolor,#b2logos_buttonsbgcolor,#b2logos_title_font_color,#b2logos_text_font_color,#b2logos_listBorderColor,#b2logos_more_link_text_color,#b2logos_detailsArea_bgColor,#b2logos_detailsArea_closeBtnColor,#b2logos_detailsArea_borderColor,#b2logos_detailsArea_logoBorderColor,#b2logos_detailsArea_logoBgColor');
			
		b2logos_farbtastic_inputs.focus(function(){
			$(this).parent().children('.b2logos_farbtastic').slideDown();
		});
			
		b2logos_farbtastic_inputs.focusout(function(){
			$(this).parent().children('.b2logos_farbtastic').slideUp();
		});
	}

});




function b2logos_generate_shortcode() {
	
	var postarray = {};
	var shortcode='[b2logos ';
	
	if( b2logos_wpml_current_lang.val()!='' ) {
		postarray['wpml_current_lang'] = b2logos_wpml_current_lang.val(); 
	}
	
	postarray['id'] = b2logos_id.val();
	shortcode+='id="'+b2logos_id.val()+'" ';
	
	if( b2logos_layout.val()!='list' ) {
		postarray['columns'] = b2logos_columnsNumberList.val();
		shortcode+='columns="'+b2logos_columnsNumberList.val()+'" ';
	}
	
	postarray['itemsheightpercentage'] = b2logos_itemsHeightPercentage.val();
	shortcode+='itemsheightpercentage="'+ b2logos_itemsHeightPercentage.val() +'" ';
	
	if( b2logos_bgColorInput.val()!='' ) {
		postarray['backgroundcolor'] = b2logos_bgColorInput.val();
		shortcode+='backgroundcolor="'+b2logos_bgColorInput.val()+'" ';
	}
	
	postarray['layout'] = b2logos_layout.val();
	shortcode+='layout="'+ b2logos_layout.val() +'" ';
	
	if( b2logos_NumberInput.val()!='' ) {
		postarray['num'] = b2logos_NumberInput.val();
		shortcode+='num="'+b2logos_NumberInput.val()+'" ';
	}
	
	var b2logos_categoriesList_value = '';
	b2logos_categoriesList.each(function() {
	   if($(this).is(':checked')){
		   b2logos_categoriesList_value += $(this).val()+',';
	   }
	});
	
	b2logos_categoriesList_value = b2logos_categoriesList_value.slice(0,-1);
	
	if(b2logos_categoriesList_value !='') {
		postarray['category'] = b2logos_categoriesList_value;
		shortcode+='category="'+b2logos_categoriesList_value+'" ';
	}
	
	postarray['orderby'] = b2logos_orderByList.val();
	shortcode+='orderby="'+b2logos_orderByList.val()+'" ';
	
	postarray['order'] = b2logos_orderList.val();
	shortcode+='order="'+b2logos_orderList.val()+'" ';
	
	if( b2logos_layout.val()!='list' ) {
		if( b2logos_marginBetweenItems.val()!='' ) {
			postarray['marginbetweenitems'] = b2logos_marginBetweenItems.val();
			shortcode+='marginbetweenitems="'+b2logos_marginBetweenItems.val()+'" ';
		}
	}
	
	if( b2logos_layout.val()!='list' ) {
		postarray['tooltip'] = b2logos_tooltipList.val();
		shortcode+='tooltip="'+ b2logos_tooltipList.val() +'" ';
	}
	
	postarray['responsive'] = b2logos_responsiveList.val();
	shortcode+='responsive="'+ b2logos_responsiveList.val() +'" ';
	
	
	postarray['grayscale'] = b2logos_grayscaleList.val();
	shortcode+='grayscale="'+ b2logos_grayscaleList.val() +'" ';
	
	postarray['border'] = b2logos_border.val();
	shortcode+='border="'+ b2logos_border.val() +'" ';
	
	if( b2logos_border.val()=='enabled' ) {
		
		if( b2logos_borderColor.val()!='list' ) {
			postarray['bordercolor'] = b2logos_borderColor.val();
			shortcode+='bordercolor="'+ b2logos_borderColor.val() +'" ';
		}
	}
	
	postarray['borderradius'] = b2logos_borderRadius.val();
	shortcode+='borderradius="'+ b2logos_borderRadius.val() +'" ';
	
	
	postarray['onclickaction'] = b2logos_onClickAction.val();
	shortcode+='onclickaction="'+ b2logos_onClickAction.val() +'" ';
	
	if( b2logos_onClickAction.val()=='showDetails' ) {
		
		postarray['detailsarea_padding'] = b2logos_detailsArea_padding.val();
		shortcode+='detailsarea_padding="'+ b2logos_detailsArea_padding.val() +'" ';
		
		postarray['detailsarea_bgcolor'] = b2logos_detailsArea_bgColor.val();
		shortcode+='detailsarea_bgcolor="'+ b2logos_detailsArea_bgColor.val() +'" ';
		
		postarray['detailsarea_closebtncolor'] = b2logos_detailsArea_closeBtnColor.val();
		shortcode+='detailsarea_closebtncolor="'+ b2logos_detailsArea_closeBtnColor.val() +'" ';
		
		
		postarray['detailsarea_border'] = b2logos_detailsArea_border.val();
		shortcode+='detailsarea_border="'+ b2logos_detailsArea_border.val() +'" ';
			
		if( b2logos_detailsArea_border.val()=='enabled' ) {
			
			postarray['detailsarea_bordercolor'] = b2logos_detailsArea_borderColor.val();
			shortcode+='detailsarea_bordercolor="'+ b2logos_detailsArea_borderColor.val() +'" ';
			
		}
		
		
		postarray['detailsarea_logo'] = b2logos_detailsArea_logo.val();
		shortcode+='detailsarea_logo="'+ b2logos_detailsArea_logo.val() +'" ';
		
		
		if(b2logos_detailsArea_logo.val() == 'enabled') {	
			
			postarray['detailsarea_logoborder'] = b2logos_detailsArea_logoBorder.val();
			shortcode+='detailsarea_logoborder="'+ b2logos_detailsArea_logoBorder.val() +'" ';
		
			if( b2logos_detailsArea_logoBorder.val()=='enabled' ) {
				
				postarray['detailsarea_logobordercolor'] = b2logos_detailsArea_logoBorderColor.val();
				shortcode+='detailsarea_logobordercolor="'+ b2logos_detailsArea_logoBorderColor.val() +'" ';
				
			}
			
			postarray['detailsarea_logobgcolor'] = b2logos_detailsArea_logoBgColor.val();
			shortcode+='detailsarea_logobgcolor="'+ b2logos_detailsArea_logoBgColor.val() +'" ';
		}
	
	}
	
	
	if( b2logos_layout.val()=='slider' ) {
	
		postarray['autoplay'] = b2logos_autoplay.val();
		shortcode+='autoplay="'+b2logos_autoplay.val()+'" ';
		
		postarray['slider_circular'] = b2logos_slider_circular.val();
		shortcode+='slider_circular="'+b2logos_slider_circular.val()+'" ';
		
		postarray['transitioneffect'] = b2logos_transitionEffect.val();
		shortcode+='transitioneffect="'+b2logos_transitionEffect.val()+'" ';
		
		postarray['easingfunction'] = b2logos_easingFunction.val();
		shortcode+='easingfunction="'+b2logos_easingFunction.val()+'" ';
		
		postarray['scrollduration'] = b2logos_scrollduration.val();
		shortcode+='scrollduration="'+b2logos_scrollduration.val()+'" ';
		
		postarray['pauseduration'] = b2logos_pauseduration.val();
		shortcode+='pauseduration="'+b2logos_pauseduration.val()+'" ';
		
		if( b2logos_buttonsbordercolor.val()!='' ) {
			postarray['buttonsbordercolor'] = b2logos_buttonsbordercolor.val();
			shortcode+='buttonsbordercolor="'+ b2logos_buttonsbordercolor.val() +'" ';
		}
		
		if( b2logos_buttonsbgcolor.val()!='' ) {
			postarray['buttonsbgcolor'] = b2logos_buttonsbgcolor.val();
			shortcode+='buttonsbgcolor="'+ b2logos_buttonsbgcolor.val() +'" ';
		}
		
		postarray['buttonsarrowscolor'] = b2logos_buttonsarrowscolor.val();
		shortcode+='buttonsarrowscolor="'+b2logos_buttonsarrowscolor.val()+'" ';
		
		postarray['slider_pagination'] = b2logos_slider_pagination.val();
		shortcode+='slider_pagination="'+b2logos_slider_pagination.val()+'" ';
		
		if( b2logos_slider_pagination.val()=='enabled' ) {
			postarray['slider_pagination_color'] = b2logos_slider_pagination_color.val();
			shortcode+='slider_pagination_color="'+b2logos_slider_pagination_color.val()+'" ';
		}
		
	}
	
	if( b2logos_layout.val()=='list' || b2logos_onClickAction.val()=='showDetails') {
	
		if(b2logos_font_style.val() == 'custom') {
			
			if( b2logos_title_font_family.val()!='' ) {
				postarray['titlefontfamily'] = b2logos_title_font_family.val();
				shortcode+='titlefontfamily="'+b2logos_title_font_family.val()+'" ';
			}
			
			if( b2logos_title_font_color.val()!='' ) {
				postarray['titlefontcolor'] = b2logos_title_font_color.val();
				shortcode+='titlefontcolor="'+b2logos_title_font_color.val()+'" ';
			}
			
			postarray['titlefontsize'] = b2logos_title_font_size.val();
			shortcode+='titlefontsize="'+b2logos_title_font_size.val()+'" ';
			
			postarray['titlefontweight'] = b2logos_title_font_weight.val();
			shortcode+='titlefontweight="'+b2logos_title_font_weight.val()+'" ';
			
			if( b2logos_text_font_family.val()!='' ) {
				postarray['textfontfamily'] = b2logos_text_font_family.val();
				shortcode+='textfontfamily="'+b2logos_text_font_family.val()+'" ';
			}
			
			if( b2logos_text_font_color.val()!='' ) {
				postarray['textfontcolor'] = b2logos_text_font_color.val();
				shortcode+='textfontcolor="'+b2logos_text_font_color.val()+'" ';
			}
			
			postarray['textfontsize'] = b2logos_text_font_size.val();
			shortcode+='textfontsize="'+b2logos_text_font_size.val()+'" ';
			
			if( b2logos_layout.val()=='list') {
				if( b2logos_excerptText_length.val()!='' ) {
					postarray['excerpttextlength'] = b2logos_excerptText_length.val();
					shortcode+='excerpttextlength="'+b2logos_excerptText_length.val()+'" ';
				}
				
				if( b2logos_more_link_text_color.val()!='' ) {
					postarray['morelinktextcolor'] = b2logos_more_link_text_color.val();
					shortcode+='morelinktextcolor="'+b2logos_more_link_text_color.val()+'" ';
				}
			}
			
		}
		
		
		if( b2logos_layout.val()=='list') {
			postarray['listborder'] = b2logos_list_border.val();
			shortcode+='listborder="'+b2logos_list_border.val()+'" ';
				
			if(b2logos_list_border.val() == 'enabled') {
				
				if( b2logos_listBorderColor.val()!='' ) {
					postarray['listbordercolor'] = b2logos_listBorderColor.val();
					shortcode+='listbordercolor="'+b2logos_listBorderColor.val()+'" ';
				}
				
				postarray['listborderstyle'] = b2logos_list_border_style.val();
				shortcode+='listborderstyle="'+b2logos_list_border_style.val()+'" ';
				
			}
			
			
			if( b2logos_moreLinkText.val()!='' ) {
				postarray['morelinktext'] = b2logos_moreLinkText.val();
				shortcode+='morelinktext="'+b2logos_moreLinkText.val()+'" ';
			}
		}
		
		
	}
	
	
	
	
	if( b2logos_hovereffect.val()!='' ) {
		
		postarray['hovereffect'] = b2logos_hovereffect.val();
		shortcode+='hovereffect="'+ b2logos_hovereffect.val() +'" ';
	
		if( b2logos_hoverEffectColor.val()!='' && b2logos_hovereffect.val() != '' && b2logos_hovereffect.val() != 'effect4' ) {
			postarray['hovereffectcolor'] = b2logos_hoverEffectColor.val();
			shortcode+='hovereffectcolor="'+b2logos_hoverEffectColor.val()+'" ';
		}
		
	}
	
	if( b2logos_pagination.val()=='enabled' ) {
		postarray['pagination'] = b2logos_pagination.val();
		shortcode+='pagination="'+b2logos_pagination.val()+'" ';
		
		postarray['pagination_border_style'] = b2logos_pagination_border_style.val();
		shortcode+='pagination_border_style="'+b2logos_pagination_border_style.val()+'" ';
		
		postarray['pagination_border_color'] = b2logos_pagination_border_color.val();
		shortcode+='pagination_border_color="'+b2logos_pagination_border_color.val()+'" ';
		
		postarray['pagination_bg_color'] = b2logos_pagination_bg_color.val();
		shortcode+='pagination_bg_color="'+b2logos_pagination_bg_color.val()+'" ';
		
		postarray['pagination_font_color'] = b2logos_pagination_font_color.val();
		shortcode+='pagination_font_color="'+b2logos_pagination_font_color.val()+'" ';
		
		postarray['pagination_font_size'] = b2logos_pagination_font_size.val();
		shortcode+='pagination_font_size="'+b2logos_pagination_font_size.val()+'" ';
		
		postarray['pagination_font_family'] = b2logos_pagination_font_family.val();
		shortcode+='pagination_font_family="'+b2logos_pagination_font_family.val()+'" ';
		
		postarray['pagination_current_font_color'] = b2logos_pagination_current_font_color.val();
		shortcode+='pagination_current_font_color="'+b2logos_pagination_current_font_color.val()+'" ';
		
		postarray['pagination_current_bg_color'] = b2logos_pagination_current_bg_color.val();
		shortcode+='pagination_current_bg_color="'+b2logos_pagination_current_bg_color.val()+'" ';
		
		postarray['pagination_current_border_color'] = b2logos_pagination_current_border_color.val();
		shortcode+='pagination_current_border_color="'+b2logos_pagination_current_border_color.val()+'" ';
		
		postarray['pagination_align'] = b2logos_pagination_align.val();
		shortcode+='pagination_align="'+b2logos_pagination_align.val()+'" ';
		
		postarray['pagination_divider_style'] = b2logos_pagination_divider_style.val();
		shortcode+='pagination_divider_style="'+b2logos_pagination_divider_style.val()+'" ';
		
		postarray['pagination_divider_color'] = b2logos_pagination_divider_color.val();
		shortcode+='pagination_divider_color="'+b2logos_pagination_divider_color.val()+'" ';
        
	}
	
	shortcode+=']';
	
	b2logos_div_shortcode.html(shortcode);
	b2logos_shortcode.val(shortcode);
	
	b2logos_gene_short_preview.html('<p>Loading ...</p>');
	
	b2logos_gene_short_preview.load('../wp-content/plugins/wp_b2logos_plugin/inc/generate_shortcode/do_shortcode.php', postarray , function(){
		
		var b2logos_containers = $('.b2logos_container');
	
		if (b2logos_containers.length )
		{
			b2logos_containers.removeClass('b2logos_notready');
			$.b2logos_run(b2logos_containers);
		}

	});
	
}

})(jQuery);