(function($){
$(document).ready(function(){
	
	if ( self != top ) {
		$.b2logos_findNotReadyInserted();
	}
	else {
		var b2logos_containers = $('.b2logos_container');
	
		if (b2logos_containers.length )
		{
			b2logos_containers.each(function(){
				$(this).removeClass('b2logos_notready');
				$.b2logos_run($(this));
			});
		}
	}

});


$.b2logos_findNotReadyInserted = function() {
	
	var b2logos_containers = $('.b2logos_container.b2logos_notready');
	
	if (b2logos_containers.length )
	{
		b2logos_containers.each(function(){
			$(this).removeClass('b2logos_notready');
			$.b2logos_run($(this));
		});
	}

			
	setTimeout(function() {
		$.b2logos_findNotReadyInserted();
	},1000);
}


$.b2logos_run = function( b2logos_container ) {

		/*======================== Logos ========================*/
		
		var b2logos = b2logos_container.children('.b2logos');
		var b2logos_items = b2logos.children('.b2logos_item');
		var b2logos_links = b2logos_items.children('a');
		var b2logos_images = b2logos_items.children('img');
		var b2logos_item_height_percentage= 0.65;
    
		
		if(b2logos.hasClass('b2logos_list') && b2logos.hasClass('b2logos_showdetails')) {
			var b2logos_morelink = b2logos_container.find('.b2logos_morelink');
		}
		
		if(b2logos.hasClass('b2logos_showdetails')) {
			var b2logos_detailsarea_closeBtn = b2logos_container.find('.b2logos_detailsarea_closeBtn');
		}
		
		
		var b2logos_detailsarea_page_url = '';
		
		if(b2logos.hasClass('b2logos_showdetails')) {
			b2logos_detailsarea_page_url = b2logos.data('detailspageurl');
			b2logos.removeAttr('data-detailspageurl');
		}
		
		
		if (b2logos.length )
		{

			b2logos_calculateItemsWidthAndHight(b2logos);
			
			if (b2logos.hasClass('b2logos_slider'))
			{
				b2logos_runSlider(b2logos);	
			}

			
			$(window).resize(function() {
                
                b2logos_calculateItemsWidthAndHight(b2logos);

                if (b2logos.hasClass('b2logos_slider'))
                {
                    setTimeout(function(){
                        b2logos_runSlider(b2logos);	
                    },500);
                }
					
			});
			
			
			// Hover Effects
			
			b2logos_items.mouseenter(function(){
				
				if($(this).parent().data('hovereffect')=='effect1') {
					
					$(this).css('box-shadow', '0px 0px 10px 2px '+$(this).parent().data('hovereffectcolor'));
					
				}
				else if($(this).parent().data('hovereffect')=='effect2') {
					
					$(this).children('a').children('.b2logos_effectspan').css('box-shadow', 'inset 0px 0px '+$(this).width()/10+'px 3px '+$(this).parent().data('hovereffectcolor'));
					
				}
				else if($(this).parent().data('hovereffect')=='effect3') {
					$(this).css('border-color', $(this).parent().data('hovereffectcolor'));
				}
				else if($(this).parent().data('hovereffect')=='effect4') {
					
					$(this).parent().children('.b2logos_item').stop().animate({opacity: 0.3},300);
					
					if($(this).parent().hasClass('b2logos_list')) {
						$(this).parent().children('.b2logos_textcontainer').stop().animate({opacity: 0.3},300);
						$(this).next().stop().animate({opacity: 1},300);
					}
					
					$(this).stop().animate({opacity: 1},300);
				}
				
			});
			
			b2logos_items.mouseleave(function(){
				if($(this).parent().data('hovereffect')=='effect1') {
					$(this).css('box-shadow', '');
				}
				else if($(this).parent().data('hovereffect')=='effect2') {
					$(this).children('a').children('.b2logos_effectspan').css('box-shadow', '');
				}
				else if($(this).parent().data('hovereffect')=='effect3') {
					$(this).css('border-color', $(this).parent().data('bordercolor'));
				}
				else if($(this).parent().data('hovereffect')=='effect4') {
					$(this).parent().children('.b2logos_item').stop().animate({opacity: 1},300);
					
					if($(this).parent().hasClass('b2logos_list')) {
						$(this).parent().children('.b2logos_textcontainer').stop().animate({opacity: 1},300);
					}
				}

			});
			
			// Tooltip
			
			if(b2logos.hasClass('b2logos_withtooltip')) {
				
				b2logos_items.mouseenter(function(){
					
					var tooltips=$('.b2logos_tooltip');
					if(tooltips.length) {
						tooltips.remove();
					}
					
					if($(this).data('title')!='') 
					{
						var tooltip=$('<div class="b2logos_tooltip"><span class="b2logos_tooltipText">'+$(this).data('title')+'<span class="b2logos_tooltipArrow"></span></span></div>');
						tooltip.appendTo('body');
							
						tooltip.css('opacity',0);
							
						var arrowBgPosition='';
							
						// Left
						if($(this).offset().left + $(this).width()/2 - tooltip.width()/2 < 0) {
							tooltip.css('left', 1 );
							arrowBgPosition = $(this).offset().left + $(this).width()/2 - 11 +'px';
						}
						else if($(this).offset().left + $(this).width()/2 - tooltip.width()/2 +tooltip.width() > $(window).width()) {
							tooltip.css('right', 1 );
							arrowBgPosition = $(this).offset().left - tooltip.offset().left + $(this).width()/2 - 11 +'px';
						}
						else {
							tooltip.css('left', $(this).offset().left + $(this).width()/2 - tooltip.width()/2 );
							arrowBgPosition='center';
						}
							
						// Top
						if($(window).scrollTop() > $(this).offset().top - tooltip.height()) {
							tooltip.css('top', $(this).offset().top + $(this).height()+13);
							arrowBgPosition+=' top';
							tooltip.find('.b2logos_tooltipArrow').css({'background-position': arrowBgPosition, 'bottom': '100%'});
						}
						else {
							tooltip.css('top', $(this).offset().top - tooltip.height()+9);
							arrowBgPosition+=' bottom';
							tooltip.find('.b2logos_tooltipArrow').css({'background-position': arrowBgPosition, 'top': '100%'});
						}
							
						// Show
						if( $(this).offset().left < $(this).parent().parent().offset().left + $(this).parent().parent().width()) {
							tooltip.animate({opacity:1,top:'-=10px'},'slow');
						}
					}
						
				});
					
				// Remove Tooltip
				b2logos_items.mouseleave(function(){
					var tooltips=$('.b2logos_tooltip');
					if(tooltips.length) {
						tooltips.remove();
					}
				});
			
			}
			
			
		}
		
		
		// Details Area
		
		if(b2logos.hasClass('b2logos_slider') && b2logos.hasClass('b2logos_showdetails')) {
		
			b2logos_items.click(function() {
					
				var b2logos_logoid = $(this).data('id');
				var b2logos_selectedlogo = $(this);
				var b2logos_detailsarea = $(this).parent().parent().parent().children('.b2logos_detailsarea');
				var b2logos_detailsarea_container = $(this).parent().parent().parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container');
				var b2logos_detailsarea_img = $(this).parent().parent().parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_img');
				var b2logos_detailsarea_title = $(this).parent().parent().parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_title');
				var b2logos_detailsarea_text = $(this).parent().parent().parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_text');
				
				
				b2logos_selectedlogo.parent().children('.b2logos_item').removeClass('b2logos_loading');
				b2logos_selectedlogo.addClass('b2logos_loading');
					
				b2logos_detailsarea.slideUp('slow',function(){
					$.get(b2logos_detailsarea_page_url, { logo_id: b2logos_logoid } , function(data){

						b2logos_detailsarea_img.css({'backgroundImage': 'url('+data.thumbnailsrc+')', 'backgroundSize': data.bgSize});
						b2logos_detailsarea_title.text(data.title);
						b2logos_detailsarea_text.html(data.text);
							
						b2logos_detailsarea_title.css('paddingTop',0);
							
						b2logos_detailsarea.slideDown('slow');
							
						if(b2logos_selectedlogo.parent().data('itemsheightpercentage')!='') {
							b2logos_item_height_percentage = b2logos_selectedlogo.parent().data('itemsheightpercentage');
						}
						
						if(b2logos_detailsarea.hasClass('b2logos_withoutLogo')==false) {
							b2logos_detailsarea_img.height(b2logos_detailsarea_img.width()*b2logos_item_height_percentage);
						}
							
						b2logos_selectedlogo.removeClass('b2logos_loading');
						
						if(b2logos_detailsarea.hasClass('b2logos_withoutLogo')==false) {
							if((b2logos_detailsarea_text.height()+b2logos_detailsarea_title.height()) < b2logos_detailsarea_img.height()) {
								b2logos_detailsarea_title.css('paddingTop', (b2logos_detailsarea_img.height() - (b2logos_detailsarea_text.height()+b2logos_detailsarea_title.height()+15))/2)
							}
						}
							
					}, 'json');
				});
					
				return false;
					
			});
			
		}
			
		
		if(b2logos.hasClass('b2logos_grid') && b2logos.hasClass('b2logos_showdetails')) {
		
			b2logos_items.click(function() {
					
				var b2logos_logoid = $(this).data('id');
					
				var b2logos_loopindex = 1;
				var b2logos_selectedlogo = $(this);
				var b2logos_nextlogo = $(this).next('div');
				var b2logos_detailsarea = $(this).parent().children('.b2logos_detailsarea');
				var b2logos_detailsarea_container = $(this).parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container');
				var b2logos_detailsarea_img = $(this).parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_img');
				var b2logos_detailsarea_title = $(this).parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_title');
				var b2logos_detailsarea_text = $(this).parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_text');
				
				
				b2logos_selectedlogo.parent().children('.b2logos_item').removeClass('b2logos_loading');
				b2logos_selectedlogo.addClass('b2logos_loading');
					
				b2logos_detailsarea.slideUp('slow',function(){
					
					while(b2logos_loopindex == 1 ) {
							
						if(b2logos_nextlogo.length == 1) {
								
							if(b2logos_selectedlogo.offset().top != b2logos_nextlogo.offset().top) {
									
								b2logos_detailsarea.insertBefore( b2logos_nextlogo );
								b2logos_loopindex= 0;
									
							}
							else {
								b2logos_nextlogo = b2logos_nextlogo.next('div');
							}
								
						}
						else if(b2logos_nextlogo.length == 0) {

							b2logos_detailsarea.insertAfter( b2logos_selectedlogo.parent().children('div:last-child') );
							b2logos_loopindex= 0;

						}
							
					}
					
						
					$.get(b2logos_detailsarea_page_url, { logo_id: b2logos_logoid } , function(data){

						b2logos_detailsarea_img.css({'backgroundImage': 'url('+data.thumbnailsrc+')', 'backgroundSize': data.bgSize});
						b2logos_detailsarea_title.text(data.title);
						b2logos_detailsarea_text.html(data.text);
							
						b2logos_detailsarea_title.css('paddingTop',0);
							
						b2logos_detailsarea.slideDown('slow');
							
						if(b2logos_selectedlogo.parent().data('itemsheightpercentage')!='') {
							b2logos_item_height_percentage = b2logos_selectedlogo.parent().data('itemsheightpercentage');
						}
						
						if(b2logos_detailsarea.hasClass('b2logos_withoutLogo')==false) {
							b2logos_detailsarea_img.height(b2logos_detailsarea_img.width()*b2logos_item_height_percentage);
						}
						
						b2logos_selectedlogo.removeClass('b2logos_loading');
						
						if(b2logos_detailsarea.hasClass('b2logos_withoutLogo')==false) {
							if((b2logos_detailsarea_text.height()+b2logos_detailsarea_title.height()) < b2logos_detailsarea_img.height()) {
								b2logos_detailsarea_title.css('paddingTop', (b2logos_detailsarea_img.height() - (b2logos_detailsarea_text.height()+b2logos_detailsarea_title.height()+15))/2)
							}
						}
							
					}, 'json');
						
				});
					
					
				return false;
					
			});
		}
		
		
		if(b2logos.hasClass('b2logos_list') && b2logos.hasClass('b2logos_showdetails')) {		
			
			b2logos_items.click(function() {
					
				var b2logos_logoid = $(this).data('id');
				var b2logos_selectedlogo = $(this);
				var b2logos_detailsarea = $(this).parent().children('.b2logos_detailsarea');
				var b2logos_detailsarea_container = $(this).parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container');
				var b2logos_detailsarea_img = $(this).parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_img');
				var b2logos_detailsarea_title = $(this).parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_title');
				var b2logos_detailsarea_text = $(this).parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_text');
			
				
				b2logos_selectedlogo.parent().children('.b2logos_item').removeClass('b2logos_loading');
				b2logos_selectedlogo.addClass('b2logos_loading');
					
				b2logos_detailsarea.slideUp('slow',function(){
						
						
					b2logos_selectedlogo.parent().children('div.b2logos_item').fadeIn('slow');
					b2logos_selectedlogo.parent().children('.b2logos_textcontainer').children('.b2logos_title, .b2logos_text').slideDown('slow');
					b2logos_selectedlogo.parent().children('.b2logos_textcontainer').removeClass('b2logos_withoutMinHeight');
							
					b2logos_detailsarea.insertBefore( b2logos_selectedlogo );
						
					$.get(b2logos_detailsarea_page_url, { logo_id: b2logos_logoid } , function(data){

						b2logos_detailsarea_img.css({'backgroundImage': 'url('+data.thumbnailsrc+')', 'backgroundSize': data.bgSize});
						b2logos_detailsarea_title.text(data.title);
						b2logos_detailsarea_text.html(data.text);
							
						b2logos_detailsarea_title.css('paddingTop',0);
							
							
						b2logos_selectedlogo.css('display','none');
						b2logos_selectedlogo.next('div').children('.b2logos_title, .b2logos_text').css('display','none');
						b2logos_selectedlogo.next('div').addClass('b2logos_withoutMinHeight');
							
							
						b2logos_detailsarea.slideDown('slow');
							
						if(b2logos_selectedlogo.parent().data('itemsheightpercentage')!='') {
							b2logos_item_height_percentage = b2logos_selectedlogo.parent().data('itemsheightpercentage');
						}
						
						if(b2logos_detailsarea.hasClass('b2logos_withoutLogo')==false) {						
							b2logos_detailsarea_img.height(b2logos_detailsarea_img.width()*b2logos_item_height_percentage);
						}
						
						b2logos_selectedlogo.removeClass('b2logos_loading');
						
						if(b2logos_detailsarea.hasClass('b2logos_withoutLogo')==false) {
							if((b2logos_detailsarea_text.height()+b2logos_detailsarea_title.height()) < b2logos_detailsarea_img.height()) {
								b2logos_detailsarea_title.css('paddingTop', (b2logos_detailsarea_img.height() - (b2logos_detailsarea_text.height()+b2logos_detailsarea_title.height()+15))/2)
							}
						}
							
					}, 'json');
				});
					
				return false;
			});
		
		}	
			
			
			
		if(b2logos.hasClass('b2logos_list') && b2logos.hasClass('b2logos_showdetails')) {	
			
			b2logos_morelink.click(function() {
					
				var b2logos_logoid = $(this).parent().parent().prev('.b2logos_item').data('id');
				var b2logos_selectedlogo = $(this).parent().parent().prev('.b2logos_item');
				var b2logos_detailsarea = $(this).parent().parent().parent().children('.b2logos_detailsarea');
				var b2logos_detailsarea_container = $(this).parent().parent().parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container');
				var b2logos_detailsarea_img = $(this).parent().parent().parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_img');
				var b2logos_detailsarea_title = $(this).parent().parent().parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_title');
				var b2logos_detailsarea_text = $(this).parent().parent().parent().children('.b2logos_detailsarea').children('.b2logos_detailsarea_container').children('.b2logos_detailsarea_text');
				
				
				b2logos_selectedlogo.parent().children('.b2logos_item').removeClass('b2logos_loading');
				b2logos_selectedlogo.addClass('b2logos_loading');
					
				b2logos_detailsarea.slideUp('slow',function(){
						
						
					b2logos_selectedlogo.parent().children('div.b2logos_item').fadeIn('slow');
					b2logos_selectedlogo.parent().children('.b2logos_textcontainer').children('.b2logos_title, .b2logos_text').slideDown('slow');
					b2logos_selectedlogo.parent().children('.b2logos_textcontainer').removeClass('b2logos_withoutMinHeight');
							
					b2logos_detailsarea.insertBefore( b2logos_selectedlogo );
						
					$.get(b2logos_detailsarea_page_url, { logo_id: b2logos_logoid } , function(data){

						b2logos_detailsarea_img.css({'backgroundImage': 'url('+data.thumbnailsrc+')', 'backgroundSize': data.bgSize});
						b2logos_detailsarea_title.text(data.title);
						b2logos_detailsarea_text.html(data.text);
							
						b2logos_detailsarea_title.css('paddingTop',0);
							
							
						b2logos_selectedlogo.css('display','none');
						b2logos_selectedlogo.next('div').children('.b2logos_title, .b2logos_text').css('display','none');
						b2logos_selectedlogo.next('div').addClass('b2logos_withoutMinHeight');
							
							
						b2logos_detailsarea.slideDown('slow');
							
						if(b2logos_selectedlogo.parent().data('itemsheightpercentage')!='') {
							b2logos_item_height_percentage = b2logos_selectedlogo.parent().data('itemsheightpercentage');
						}
						
						if(b2logos_detailsarea.hasClass('b2logos_withoutLogo')==false) {
							b2logos_detailsarea_img.height(b2logos_detailsarea_img.width()*b2logos_item_height_percentage);
						}
						
						b2logos_selectedlogo.removeClass('b2logos_loading');
						
						if(b2logos_detailsarea.hasClass('b2logos_withoutLogo')==false) {
							if((b2logos_detailsarea_text.height()+b2logos_detailsarea_title.height()) < b2logos_detailsarea_img.height()) {
								b2logos_detailsarea_title.css('paddingTop', (b2logos_detailsarea_img.height() - (b2logos_detailsarea_text.height()+b2logos_detailsarea_title.height()+15))/2)
							}
						}
							
					}, 'json');
				});
					
				return false;
			});
		
		}		
			
			
			
			
			
		if(b2logos.hasClass('b2logos_showdetails')) {
		
			b2logos_detailsarea_closeBtn.click(function() {
				$(this).parent().stop().slideUp('slow', function(){
						
					if($(this).parent().hasClass('b2logos_list')) {
						$(this).parent().children('div.b2logos_item, div.b2logos_textcontainer .b2logos_title, div.b2logos_textcontainer .b2logos_text').css('display','block');
							
						$(this).parent().children('div.b2logos_item').fadeIn('slow');
						$(this).parent().children('.b2logos_textcontainer').children('.b2logos_title, .b2logos_text').slideDown('slow');
							
						$(this).parent().children('.b2logos_textcontainer').removeClass('b2logos_withoutMinHeight');
					}
					
				});
					
				return false;
			});
			
		}
			
			
}




function b2logos_calculateItemsWidthAndHight(list) {
	
	if(list.data('itemsheightpercentage')!='') {
		var b2logos_item_height_percentage = list.data('itemsheightpercentage');
	}
	else {
		var b2logos_item_height_percentage= 0.65;
	}
	
	var b2logos_itemBorderLeftRight = parseInt(list.children('.b2logos_item').css('borderLeftWidth').replace('px', ''))+parseInt(list.children('.b2logos_item').css('borderRightWidth').replace('px', ''));
	
	
	if(list.hasClass('b2logos_grid') || list.hasClass('b2logos_slider')) {
		
		
		
		if(list.hasClass('b2logos_grid')) {
			list.parent().width('auto');
			
			if(list.hasClass('b2logos_showdetails')) {
				list.children('.b2logos_detailsarea').css('display','none');
				list.children('.b2logos_detailsarea').insertAfter(list.children('div:last-child'));
				
				if(list.parent().width() < 481) {
					list.children('.b2logos_detailsarea').addClass('b2logos_small_width');
				}
				else {
					list.children('.b2logos_detailsarea').removeClass('b2logos_small_width');
				}
			}
		}
		
		if(list.hasClass('b2logos_slider')) {
			list.parents('.b2logos_container').width('auto');
			
			if(list.hasClass('b2logos_showdetails')) {
				list.parents('.b2logos_container').children('.b2logos_detailsarea').css('display','none');
				
				if(list.parents('.b2logos_container').width() < 481) {
					list.parents('.b2logos_container').children('.b2logos_detailsarea').addClass('b2logos_small_width');
				}
				else {
					list.parents('.b2logos_container').children('.b2logos_detailsarea').removeClass('b2logos_small_width');
				}
			}
		}
		
		if(list.data('marginBetweenItems')!='') {
			list.children('.b2logos_item').css('margin', Math.floor(parseFloat(list.data('marginbetweenitems'))/2));
		}
							
		var b2logos_itemMarginLeftRight = parseFloat(list.children('.b2logos_item').css('marginLeft').replace('px', ''))+parseFloat(list.children('.b2logos_item').css('marginRight').replace('px', ''));		
				
		if( $(window).width() >= 1024 || !list.hasClass('b2logos_responsive') ) {
			list.parent().width(Math.floor(list.width()/list.data('columnsnum'))*list.data('columnsnum'));
			list.children('.b2logos_item').width(Math.floor(list.width()/list.data('columnsnum'))-(b2logos_itemMarginLeftRight+b2logos_itemBorderLeftRight) );
		}
		else if( $(window).width() < 1024 && $(window).width() >= 481) {
			var windowHeight = $(window).height();
			var windowWidth = $(window).width();
						
			if(windowHeight < windowWidth && list.data('columnsnum') > 4) {
				list.parent().width(Math.floor(list.width()/4)*4);
				list.children('.b2logos_item').width(Math.floor(list.width()/4)-(b2logos_itemMarginLeftRight+b2logos_itemBorderLeftRight) );
			}
			else if(windowHeight > windowWidth && list.data('columnsnum') > 3) {
				list.parent().width(Math.floor(list.width()/3)*3);
				list.children('.b2logos_item').width(Math.floor(list.width()/3)-(b2logos_itemMarginLeftRight+b2logos_itemBorderLeftRight) );
			}
			else {
				list.parent().width(Math.floor(list.width()/list.data('columnsnum'))*list.data('columnsnum'));
				list.children('.b2logos_item').width(Math.floor(list.width()/list.data('columnsnum'))-(b2logos_itemMarginLeftRight+b2logos_itemBorderLeftRight) );
			}
		}
		else if( $(window).width() < 481 && list.data('columnsnum') > 2 ) {
			list.parent().width(Math.floor(list.width()/2)*2);
			list.children('.b2logos_item').width(Math.floor(list.width()/2)-(b2logos_itemMarginLeftRight+b2logos_itemBorderLeftRight) );
		}
		else {
			list.parent().width(Math.floor(list.width()/list.data('columnsnum'))*list.data('columnsnum'));
			list.children('.b2logos_item').width(Math.floor(list.width()/list.data('columnsnum'))-(b2logos_itemMarginLeftRight+b2logos_itemBorderLeftRight) );
		}
					
					
					
	}
	else if(list.hasClass('b2logos_list')) {
		
		if(list.hasClass('b2logos_showdetails')) {
			list.children('.b2logos_detailsarea').css('display','none');
			list.find('.b2logos_title, .b2logos_text').css('display','block');
			list.find('.b2logos_textcontainer.b2logos_withoutMinHeight').removeClass('b2logos_withoutMinHeight');
			
			if(list.parent().width() < 481) {
				list.children('.b2logos_detailsarea').addClass('b2logos_small_width');
			}
			else {
				list.children('.b2logos_detailsarea').removeClass('b2logos_small_width');
			}
		}	
		
		if( list.parent().width() < 481 ) {
			list.children('.b2logos_item').width(Math.floor(list.width())-b2logos_itemBorderLeftRight ).css({'marginBottom':30, 'float':'none'});
			list.children('.b2logos_item').height(parseInt(list.children('.b2logos_item').width()*b2logos_item_height_percentage));
			list.children('.b2logos_textcontainer').css('min-height',0);
			list.children('.b2logos_textcontainer').children('.b2logos_text, .b2logos_title').css({'marginLeft':0});
		}
		else {
			list.children('.b2logos_item').width(180).css({'marginBottom':0, 'float':'left'});
			list.children('.b2logos_item').height(parseInt(list.children('.b2logos_item').width()*b2logos_item_height_percentage));
			list.children('.b2logos_textcontainer').css('min-height',list.children('.b2logos_item').height()+b2logos_itemBorderLeftRight);
			list.children('.b2logos_textcontainer').children('.b2logos_text, .b2logos_title').css({'marginLeft':210});
		}
		
			
	}
		
	list.children('.b2logos_item').height(parseInt(list.children('.b2logos_item').width()*b2logos_item_height_percentage));	
	
	list.children('.b2logos_item').css('display','inline-block');
	
}




function b2logos_runSlider(slider) {
	
	
			var min=slider.data('columnsnum');
			var max=slider.data('columnsnum');
			var pauseOnHover = true;
			
			if(slider.data('itemsheightpercentage')!='') {
				var b2logos_item_height_percentage = slider.data('itemsheightpercentage');
			}
			else {
				var b2logos_item_height_percentage= 0.65;
			}
			
			if(slider.hasClass('b2logos_responsive')) {
			
				if( $(window).width() <= 480 ) {
					min=1;
					max=1;
				}
				else if($(window).width() > 480 &&  $(window).width() < 600 && slider.data('columnsnum') > 3 ) {		
					min=3;
					max=3;
				}
				else if($(window).width() > 600 &&  $(window).width() < 1024 && slider.data('columnsnum') > 4 ) {
					min=4;
					max=4;
				}
				
			}
			
			
			if(slider.data('pauseduration')=='0') {
				pauseOnHover = 'immediate-resume';
			}
				
			
			slider.carouFredSel({
				responsive: true,
				width:'100%',
				circular:slider.data('circular'),
				infinite:true,
				prev: {
					button: function() {
						if(slider.data('pauseduration')=='0') {
							return null;
						}
						else {
							$(this).parent().append('<a class="b2logos_prev '+$(this).data('buttonsarrowscolor')+'" style="background-color:'+$(this).data('buttonsbgcolor')+';border-color:'+$(this).data('buttonsbordercolor')+';" href="#"></a>');
							return $(this).parents().children(".b2logos_prev");
						}
					}
				},
				next: {
					button: function() {
						if(slider.data('pauseduration')=='0') {
							return null;
						}
						else {
							$(this).parent().append('<a class="b2logos_next '+$(this).data('buttonsarrowscolor')+'" style="background-color:'+$(this).data('buttonsbgcolor')+';border-color:'+$(this).data('buttonsbordercolor')+';" href="#"></a>');
							return $(this).parents().children(".b2logos_next");
						}
					}
				},
				pagination: {
					container: function() {
						if(slider.data('pagination')=='enabled' && slider.data('pauseduration')!='0') {
							return $(this).parents().next(".b2logos_slider_pagination");
						}
					},
					anchorBuilder: function() {
						return '<span style="background-color:'+slider.data('paginationcolor')+';border-color:'+slider.data('paginationcolor')+';"></span>';
					}
				},
				scroll: {
					items:function(num) {
						if(num==1) {
							return 1;
						}
						else if(num>=2 && num<=5) {
							return 2;
						}
						else if(num>=6 && num<=7) {
							return 3;
						}
						else if(num>=8 && num<=9) {
							return 4;
						}
						else if(num>=10) {
							return 5;
						}
					},
					easing:slider.data('easingfunction'),
					duration: slider.data('scrollduration'),
					fx: slider.data('transitioneffect')
				},
				items: {
					width: 200,
					visible: {
						min: min,
						max: max
					}
				},
				auto: {
					play: slider.data('autoplay'),
					timeoutDuration: slider.data('pauseduration'),
					pauseOnHover: pauseOnHover
				},
				swipe: {
					onMouse: false,
					onTouch: true
				}
			});
			
			if( $(window).width() > 1024 && slider.data('pauseduration')!='0') {
				slider.parents('.caroufredsel_wrapper').mouseenter(function(){
					$(this).children(".b2logos_prev").fadeIn('slow');
					$(this).children(".b2logos_next").fadeIn('slow');
				});
				
				slider.parents('.caroufredsel_wrapper').mouseleave(function(){
					$(this).children(".b2logos_prev").fadeOut('slow');
					$(this).children(".b2logos_next").fadeOut('slow');
				});
			}
			
			var b2logos_itemMarginTopBottom = parseFloat(slider.children('.b2logos_item').css('marginLeft').replace('px', ''))+parseFloat(slider.children('.b2logos_item').css('marginRight').replace('px', ''));
			var b2logos_itemBorderTopBottom = parseInt(slider.children('.b2logos_item').css('borderLeftWidth').replace('px', ''))+parseInt(slider.children('.b2logos_item').css('borderRightWidth').replace('px', ''));
			
			slider.children('.b2logos_item').height(parseInt(slider.children('.b2logos_item').width()*b2logos_item_height_percentage));
			
			if(b2logos_itemBorderTopBottom >= 1) {
				slider.parent().height(parseInt(slider.children('.b2logos_item').width()*b2logos_item_height_percentage + b2logos_itemMarginTopBottom + b2logos_itemBorderTopBottom +1));
			}
			else {
				slider.parent().height(parseInt(slider.children('.b2logos_item').width()*b2logos_item_height_percentage + b2logos_itemMarginTopBottom + b2logos_itemBorderTopBottom ));
			}
			
			slider.height(parseInt(slider.children('.b2logos_item').height()+ b2logos_itemMarginTopBottom + b2logos_itemBorderTopBottom));
			
			if(b2logos_itemBorderTopBottom >= 1) {
				slider.parent().height(parseInt(slider.children('.b2logos_item').height()+ b2logos_itemMarginTopBottom + b2logos_itemBorderTopBottom +1));
				slider.parent().width(slider.parent().width()+1);
			}
			else {
				slider.parent().height(parseInt(slider.children('.b2logos_item').height()+ b2logos_itemMarginTopBottom + b2logos_itemBorderTopBottom ));
				slider.parent().width(slider.parent().width());
			}
				
			if(slider.data('pauseduration')!='0') {
				b2logos_prev=slider.parents().children(".b2logos_prev");
				b2logos_prev.css('top',slider.parents().height()/2 - b2logos_prev.height()/2 );
				b2logos_prev.css('display','none');
							
				b2logos_next=slider.parents().children(".b2logos_next");
				b2logos_next.css('top',slider.parents().height()/2 - b2logos_next.height()/2 );
				b2logos_next.css('display','none');
			}
			
}

})(jQuery);