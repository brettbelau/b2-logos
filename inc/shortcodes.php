<?php
	
	// B2 Logos Shortcode
	
	function b2logos_shortcode($atts, $content=null) {  
		extract(shortcode_atts( array(  
			'id' => '',
			'columns' => '5',
			'itemsheightpercentage' => '0.65',
			'backgroundcolor' => 'transparent',
			'layout' => 'grid',
			'num' => '-1',
			'category' => '-1',
			'orderby' => 'date',
			'order' => 'DESC',
			'marginbetweenitems' =>'' ,
			'tooltip' => 'disabled',
			'responsive' => 'enabled',
			'grayscale' => 'disabled',
			'border' => 'disabled',
			'bordercolor' => 'transparent',
			'borderradius' => 'b2logos_no_radius',
			'onclickaction' => 'openLink',
			'detailsarea_padding' => '30px',
			'detailsarea_bgcolor' => '#f6f6f6',
			'detailsarea_closebtncolor' => '#777777',
			'detailsarea_border' => 'enabled',
			'detailsarea_bordercolor' => '#dcdcdc',
			'detailsarea_logo' => 'enabled',
			'detailsarea_logoborder' => 'enabled',
			'detailsarea_logobordercolor' => '#dcdcdc',
			'detailsarea_logobgcolor' => 'transparent',
			'autoplay' => 'true',
			'slider_circular' => 'true',
			'transitioneffect' => 'scroll',
			'easingfunction' => 'quadratic',
			'scrollduration' => '1000',
			'pauseduration' => '900',
			'buttonsbordercolor' => '#DCDCDC',
			'buttonsbgcolor' => '#FFFFFF',
			'buttonsarrowscolor' => 'lightgray',
			'slider_pagination' => 'disabled',
			'slider_pagination_color' => '#999999',
			'hovereffect' => '',
			'hovereffectcolor' => '#DCDCDC',
			'titlefontfamily' => '',
			'titlefontcolor' => '#777777',
			'titlefontsize' => '15px',
			'titlefontweight' => 'bold',
			'textfontfamily' => '',
			'textfontcolor' => '#777777',
			'textfontsize' => '12px',
			'excerpttextlength' => '55',
			'listborder' => 'enabled',
			'listbordercolor' => '#DCDCDC',
			'listborderstyle' => 'dashed',
			'morelinktext' => '',
			'morelinktextcolor' => '',
			'pagination' => 'disabled',
			'pagination_border_style' => 'solid',
			'pagination_border_color' => '#DDDDDD',
			'pagination_bg_color' => 'transparent',
			'pagination_font_color' => '#777777',
			'pagination_font_size' => '14px',
			'pagination_font_family' => '',
			'pagination_current_font_color' => '#F47E00',
			'pagination_current_bg_color' => 'transparent',
			'pagination_current_border_color' => '#DDDDDD',
			'pagination_align' => 'center',
			'pagination_divider_style' => 'solid',
			'pagination_divider_color' => '#DDDDDD',
			'wpml_current_lang' =>''
		), $atts));  
		
		$b2logos_suppress_filters = false;
		
		// 	query posts
		
		if(function_exists('icl_object_id') && $wpml_current_lang != '') {
			global $sitepress;
			if(isset($sitepress)) {
				$sitepress->switch_lang($wpml_current_lang);
			}
		}
		
		if($category != '-1') {
			$b2logos_suppress_filters = true;
		}
		
		$args =	array ( 'post_type' => 'b2logo',
						'posts_per_page' => $num,
						'orderby' => $orderby,
						'order' => $order,
						'suppress_filters' => $b2logos_suppress_filters);
		
		if($category != '-1') {
			$args['tax_query'] = array(array('taxonomy' => 'b2logocategory', 'include_children' => false, 'field' => 'term_id', 'terms' => array_map('intval', explode(',',$category)) ));
		}
		
		if(($layout=='list' || $layout=='grid') && $pagination=='enabled') {
			$b2logos_current_page = isset($_GET['b2logos_page']) ? b2logos_test_query_var($_GET['b2logos_page']) : 1;
			$args['paged'] = $b2logos_current_page;
		}
		
		$b2logos_query = new WP_Query( $args );
		
		$html='';

		if ($b2logos_query->have_posts()) {
			
			// ======== Classes ======== //
			$classes='';
			
			//layout
			if($layout=='grid') {
				$classes.='b2logos_grid ';
			}
			else if($layout=='slider') {
				$classes.='b2logos_slider ';
			}
			else if($layout=='list') {
				$classes.='b2logos_list ';
			}
			
			//responsive
			if($responsive=='enabled') {
				$classes.='b2logos_responsive ';
			}
			
			//tooltip
			if($layout!='list') {
				if($tooltip=='enabled') {
					$classes.='b2logos_withtooltip ';
				}
			}
			
			//grayscale
			if($grayscale=='enabled') {
				$classes.='b2logos_grayscale ';
			}
			
			//border
			if($border=='enabled') {
				$classes.='b2logos_border ';
			}
			else {
				$classes.='b2logos_no_border ';
			}
			
			//list border
			if($listborder=='enabled') {
				$classes.='b2logos_listborder ';
			}
			
			//border radius
			$classes.=$borderradius.' ';
			
			//hover effect
			$classes.=$hovereffect.' ';
			
			//show details
			if($onclickaction=='showDetails') {
				$classes.='b2logos_showdetails ';
			}
			
			
			
			// ======== Data ======== //
			
			$data= '';
			
			//columns
			if($layout!='list') {
				$data='data-columnsnum="'.$columns.'" ';
			}
			
			//margin between items
			if($layout!='list') {
				$data.='data-marginbetweenitems="'.$marginbetweenitems.'" ';
			}
			
			//items height percentage
			$data.='data-itemsheightpercentage="'.$itemsheightpercentage.'" ';
			
			//hover effect
			$data.='data-hovereffect="'.$hovereffect.'" ';
			
			//hover effect color
			$data.='data-hovereffectcolor="'.$hovereffectcolor.'" ';
			
			//border color
			$data.='data-bordercolor="'.$bordercolor.'" ';
			
			if($layout == 'slider') {
				// autoplay
				$data.='data-autoplay="'.$autoplay.'" ';
				// autoplay
				$data.='data-circular="'.$slider_circular.'" ';
				// Transition Effect
				$data.='data-transitioneffect="'.$transitioneffect.'" ';
				//easing function
				$data.='data-easingfunction="'.$easingfunction.'" ';
				// scroll duration
				$data.='data-scrollduration="'.$scrollduration.'" ';
				// pause duration
				$data.='data-pauseduration="'.$pauseduration.'" ';
				// buttons border color
				$data.='data-buttonsbordercolor="'.$buttonsbordercolor.'" ';
				// buttons background color
				$data.='data-buttonsbgcolor="'.$buttonsbgcolor.'" ';
				// pagination
				$data.='data-pagination="'.$slider_pagination.'" ';
				// pagination buttons color
				$data.='data-paginationcolor="'.$slider_pagination_color.'" ';
				
				// buttons arrows color
				if($buttonsarrowscolor == 'darkgray') {
					$data.='data-buttonsarrowscolor="b2logos_darkgrayarrows" ';
				}
				else if($buttonsarrowscolor == 'lightgray') {
					$data.='data-buttonsarrowscolor="b2logos_lightgrayarrows" ';
				}
				else if($buttonsarrowscolor == 'white') {
					$data.='data-buttonsarrowscolor="b2logos_whitearrows" ';
				}
				
			}
			
			if($onclickaction == 'showDetails') {
				$data.='data-detailspageurl='.plugins_url( 'details_area.php', __FILE__ ).' ';
			}
			
			$html.='<div id="'.$id.'" class="b2logos_container b2logos_notready"><div class="b2logos '.$classes.'" '.$data.' >';
			
			
			
			
			$detailsAreaStyle = '';
			$detailsAreaClass = '';
			$detailsArea_container_style ='';
			$detailsArea_logo_style = '';
			$detailsArea_closeBtn_style = '';
			
			$titleStyle='';
			$textStyle='';
			
			$detailsArea_html ='';
			
			if($onclickaction == 'showDetails' || $layout=='list') {
				
				// title style
	
				if($titlefontfamily !='') {
					$titleStyle.='font-family:'.$titlefontfamily.'; ';
				}
				if($titlefontcolor !='') {
					$titleStyle.='color:'.$titlefontcolor.'; ';
				}
				if($titlefontsize !='') {
					$titleStyle.='font-size:'.$titlefontsize.'; ';
				}
				if($titlefontweight !='') {
					$titleStyle.='font-weight:'.$titlefontweight.'; ';
				}
					
					
				// text style
	
				if($textfontfamily !='') {
					$textStyle.='font-family:'.$textfontfamily.'; ';
				}
				if($textfontcolor !='') {
					$textStyle.='color:'.$textfontcolor.'; ';
				}
				if($textfontsize !='') {
					$textStyle.='font-size:'.$textfontsize.'; ';
				}

			}
				
			if($onclickaction == 'showDetails') {
				
				// Details Area Style
				
				if($marginbetweenitems != '') {
					$detailsAreaStyle .= 'margin:'.floor($marginbetweenitems/2).'px;';
				}
				
				// Details Area Class
				
				if($borderradius!= '') {
					$detailsAreaClass .= $borderradius.' ';
				}
				
				if($detailsarea_logo == 'disabled') {
					$detailsAreaClass .= 'b2logos_withoutLogo ';
				}
				
				// Details Area Container Style
				
				if($detailsarea_bgcolor != '') {
					$detailsArea_container_style .= 'background-color:'.$detailsarea_bgcolor.';';
				}
				
				if($detailsarea_border == 'enabled' && $detailsarea_bordercolor !='') {
					$detailsArea_container_style .= 'border: 1px solid '.$detailsarea_bordercolor.';';
				}
				
				if($detailsarea_padding != '') {
					$detailsArea_container_style .= 'padding: '.$detailsarea_padding.';';
				}
				
				if($itemsheightpercentage != '' && $detailsarea_logo == 'enabled') {
					$detailsArea_container_style .= 'min-height: '.(200 * $itemsheightpercentage).'px;';
				}
				
				
				// Details Area Logo Style
				
				if($detailsarea_logoborder == 'enabled' && $detailsarea_logobordercolor != '') {
					$detailsArea_logo_style .= 'border: 1px solid '.$detailsarea_logobordercolor.';';
				}
				
				if($detailsarea_logobgcolor != '') {
					$detailsArea_logo_style .= 'background-color: '.$detailsarea_logobgcolor.';';
				}
				
				if($itemsheightpercentage != '') {
					$detailsArea_logo_style .= 'height: '.(200 * $itemsheightpercentage).'px;';
				}
				
				
				// Details Area Close Button Style
				if($detailsarea_padding != '') {
					$detailsArea_closeBtn_style .= 'top: '.$detailsarea_padding.';';
					$detailsArea_closeBtn_style .= 'right: '.$detailsarea_padding.';';
				}
				
				
				$detailsArea_html = '<div class="b2logos_detailsarea '.$detailsAreaClass.'" style="'.$detailsAreaStyle.'">
								
										<a class="b2logos_detailsarea_closeBtn" href="#" style="'.$detailsArea_closeBtn_style.'" >
											<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 15 15" enable-background="new 0 0 15 15" xml:space="preserve">
												<g>
													<rect x="6.97" y="-2.576" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.1068 7.5001)" fill="'.$detailsarea_closebtncolor.'" width="1.061" height="20.152"/>
													<rect x="6.97" y="-2.576" transform="matrix(-0.7069 -0.7073 0.7073 -0.7069 7.497 18.1068)" fill="'.$detailsarea_closebtncolor.'" width="1.061" height="20.152"/>
												</g>
											</svg>
										</a>
										
										<div class="b2logos_detailsarea_container" style="'.$detailsArea_container_style.'">
											<div class="b2logos_detailsarea_img" style="'.$detailsArea_logo_style.'"></div>
											<div class="b2logos_detailsarea_title" style="'.$titleStyle.'" ></div>
											<div class="b2logos_detailsarea_text" style="'.$textStyle.'" ></div>
										</div>
							
									</div>';
				
				if($layout == 'list') {
					$html.=$detailsArea_html;
				}
				
			}
			
			
			$i = 0;
			
			while ($i < $b2logos_query->post_count) {
				
				$post = $b2logos_query->posts;
				$thumbnailsrc="";
				$href='';
				$link ='';
				$imgSize='99%';
				$bgSize='99%';
				$link_target='_blank';
					
					
					
				if(get_post_meta($post[$i]->ID, 'link', true)!='' && $onclickaction == 'openLink') { 
					
					$link = get_post_meta($post[$i]->ID, 'link', true);
					
					if (strpos($link, 'http://') === false && strpos($link, 'https://') === false && strpos($link, 'mailto:') === false ) {
						$href='href="http://'.get_post_meta($post[$i]->ID, 'link', true).'"';
					}
					else {
						$href='href="'.get_post_meta($post[$i]->ID, 'link', true).'"';
					}
					
				}
				
				if(get_post_meta($post[$i]->ID, 'imageSize', true) !='' ) {
					$imgSize=get_post_meta($post[$i]->ID, 'imageSize', true);
					$bgSize='-webkit-background-size: '.$imgSize.'; -moz-background-size: '.$imgSize.'; background-size: '.$imgSize.';';
				}
				
				// if has post thumbnail		
				if ( has_post_thumbnail($post[$i]->ID)) {
					$thumbnailsrc = wp_get_attachment_url(get_post_meta($post[$i]->ID, '_thumbnail_id', true));
				}
				
				if(get_post_meta($post[$i]->ID, 'link_target', true) !='' ) {
					$link_target=get_post_meta($post[$i]->ID, 'link_target', true);
				}
				
				
				$html.='<div class="b2logos_item" data-id="'.$post[$i]->ID.'" data-title="'.$post[$i]->post_title.'" style="background-color:'.$backgroundcolor.'; border-color:'.$bordercolor.'">
						<a rel="nofollow" '.$href.' target="'.$link_target.'">';
				
				if($thumbnailsrc!='') {
					$html.='<img src="'.$thumbnailsrc.'" title="" style="max-width:'.$imgSize.' !important; max-height:'.$imgSize.' !important;" alt="'.$post[$i]->post_title.'" />';
				}
				
				if($hovereffect=='effect2') {
					$html.='<span class="b2logos_effectspan"></span>';
				}
								
				$html.='</a>';
				
				
							
				$html.='</div>';
				
				
				
				
				
				
				
				if($layout=='list') {
					
					
					
					// text container style 
					
					$textContainerStyle = '';
					
					if($listborder =='enabled') {
					
						if($listbordercolor !='') {
							$textContainerStyle.='border-bottom-color:'.$listbordercolor.'; ';
						}
						if($listborderstyle !='') {
							$textContainerStyle.='border-bottom-style:'.$listborderstyle.'; ';
						}
						
					}
					
					$html.='<div class="b2logos_textcontainer" style="'.$textContainerStyle.'">
								<div class="b2logos_title" style="'.$titleStyle.'">'.$post[$i]->post_title.'</div>
								<div class="b2logos_text" style="'.$textStyle.'"><div>'.wp_trim_words(get_post_meta($post[$i]->ID, 'description', true), $excerpttextlength).'</div>';
					
					if(($morelinktext!='' && get_post_meta($post[$i]->ID, 'link', true) !='' && $onclickaction == 'openLink') || ($onclickaction == 'showDetails' && $morelinktext!='')) {
					
						$linkColor ='';
						if($morelinktextcolor != '') {
							$linkColor ='color:'.$morelinktextcolor;
						}
						
						$html.= '<a rel="nofollow" '.$href.' target="'.$link_target.'" data-id="'.$post[$i]->ID.'" class="b2logos_morelink" style="'.$linkColor.'" >'.$morelinktext.'</a>';
					}
					
					$html.=	'	</div>
							</div>';
				}
				
				$i++;
			}
			
			if($onclickaction == 'showDetails' && $layout == 'grid') {
				$html.=$detailsArea_html.'<div class="b2logos_detailsarea_clear"></div>';
			}
			
			$html.='</div>';
			
			if($layout=='slider' && $slider_pagination=='enabled') {
				
				$b2logos_slider_pagination_style ='';
				switch($marginbetweenitems) {
					case '5px':
						$b2logos_slider_pagination_style.='padding:13px 2px 13px 2px;';
						break;
					case '10px':
						$b2logos_slider_pagination_style.='padding:10px 5px 10px 5px;';
						break;
					case '15px':
						$b2logos_slider_pagination_style.='padding:8px 7px 8px 7px;';
						break;
					case '20px':
						$b2logos_slider_pagination_style.='padding:5px 10px 5px 10px;';
						break;
					case '25px':
						$b2logos_slider_pagination_style.='padding:3px 12px 3px 12px;';
						break;
					case '30px':
						$b2logos_slider_pagination_style.='padding:0px 15px 0px 15px;';
						break;
					default:
						$b2logos_slider_pagination_style.='padding:15px 0px 15px 0px;';
				}
				
				$html.= '<div class="b2logos_slider_pagination" style="'.$b2logos_slider_pagination_style.'"></div>';
			
			}
			
			if($onclickaction == 'showDetails' && $layout == 'slider') {
				$html.=$detailsArea_html;
			}
			
			$html.='</div>';
			
			
			// Pagination
			
			if(($layout=='list' || $layout=='grid') && $pagination=='enabled') {
				
				$b2logos_total_pages = $b2logos_query->max_num_pages;
				
				$b2logos_pagination_style = '';
				$b2logos_paginationItem_style = '';
				$b2logos_paginationCurrentItem_style ='';
				
				if($pagination_border_style !='') {
					$b2logos_paginationItem_style.= 'border-style:'.$pagination_border_style.';';
					$b2logos_paginationCurrentItem_style.= 'border-style:'.$pagination_border_style.';';
				}
				
				if($pagination_border_color !='') {
					$b2logos_paginationItem_style.= 'border-color:'.$pagination_border_color.';';
				}
				
				if($pagination_bg_color !='') {
					$b2logos_paginationItem_style.= 'background-color:'.$pagination_bg_color.';';
				}
				
				if($pagination_font_color !='') {
					$b2logos_paginationItem_style.= 'color:'.$pagination_font_color.';';
				}
				
				if($pagination_font_size !='') {
					$b2logos_pagination_style.= 'font-size:'.$pagination_font_size.';';
				}
				
				if($pagination_font_family !='') {
					$b2logos_pagination_style.= 'font-family:'.$pagination_font_family.';';
				}
				
				if($pagination_current_font_color !='') {
					$b2logos_pagination_style.= 'color:'.$pagination_current_font_color.';';
				}
				
				if($pagination_current_bg_color !='') {
					$b2logos_paginationCurrentItem_style.= 'background-color:'.$pagination_current_bg_color.';';
				}
				
				if($pagination_current_border_color !='') {
					$b2logos_paginationCurrentItem_style.= 'border-color:'.$pagination_current_border_color.';';
				}
				
				if($pagination_align !='') {
					$b2logos_pagination_style.= 'text-align:'.$pagination_align.';';
				}
				
				if($pagination_divider_style !='') {
					$b2logos_pagination_style.= 'border-top-style:'.$pagination_divider_style.';';
				}
				
				if($pagination_divider_color !='') {
					$b2logos_pagination_style.= 'border-top-color:'.$pagination_divider_color.';';
				}
				
				if($layout=='list') {
					if($pagination_divider_style=='none') {
						$b2logos_pagination_style.='margin:15px 0 0 0;';
					}
					else {
						$b2logos_pagination_style.='margin:30px 0 0 0;';
					}
				}
				
				
				if($layout=='grid') {
					
					if($pagination_divider_style=='none') {
						switch($marginbetweenitems) {
							case '5px':
								$b2logos_pagination_style.='padding:18px 2px 0 2px;';
								break;
							case '10px':
								$b2logos_pagination_style.='padding:15px 5px 0 5px;';
								break;
							case '15px':
								$b2logos_pagination_style.='padding:13px 7px 0 7px;';
								break;
							case '20px':
								$b2logos_pagination_style.='padding:10px 10px 0 10px;';
								break;
							case '25px':
								$b2logos_pagination_style.='padding:13px 12px 0 12px;';
								break;
							case '30px':
								$b2logos_pagination_style.='padding:15px 15px 0 15px;';
								break;
							default:
								$b2logos_pagination_style.='padding:20px 0px 0 0px;';
						}
					}
					else {
						switch($marginbetweenitems) {
							case '5px':
								$b2logos_pagination_style.='margin:13px 2px 0 2px;';
								break;
							case '10px':
								$b2logos_pagination_style.='margin:10px 5px 0 5px;';
								break;
							case '15px':
								$b2logos_pagination_style.='margin:8px 7px 0 7px;';
								break;
							case '20px':
								$b2logos_pagination_style.='margin:10px 10px 0 10px;';
								break;
							case '25px':
								$b2logos_pagination_style.='margin:13px 12px 0 12px;';
								break;
							case '30px':
								$b2logos_pagination_style.='margin:15px 15px 0 15px;';
								break;
							default:
								$b2logos_pagination_style.='margin:15px 0px 0 0px;';
						}
					}
				}
				
  
				$html.= '<div class="b2logos_pagination" style="'.$b2logos_pagination_style.'">'.paginate_links(array('base' => str_replace('#038;', '', str_replace( 999999999, '%#%', esc_url( add_query_arg('b2logos_page', '999999999#'.$id, html_entity_decode(get_permalink()) )) )), 'format' => '?paged=%#%', 'current' => $b2logos_current_page, 'total' => $b2logos_total_pages, 'before_page_number' => '<span class="b2logos_pagination_currentItem" style="'.$b2logos_paginationCurrentItem_style.'"></span><span class="b2logos_pagination_item" style="'.$b2logos_paginationItem_style.'">', 'after_page_number' => '</span>', 'prev_next' => true, 'prev_text' => __('<span class="b2logos-fa b2logos_pagination_item" style="'.$b2logos_paginationItem_style.'"></span>'), 'next_text' => __('<span class="b2logos-fa b2logos_pagination_item" style="'.$b2logos_paginationItem_style.'"></span>') )).'</div>';
				
			}
			
			
			
		
		}
		
		return $html; 

		
	}  
	add_shortcode('b2logos', 'b2logos_shortcode');
	
	
	
	// B2 Logos Saved Shortcode
	
	function b2logos_saved_shortcode( $atts ) {
	    
		extract( shortcode_atts( array(
		    'id' => ''
	    ), $atts ) );
		
		$b2logos_sc = '';
		
		if($id != ''){
			$b2logos_sc = get_post($id);
			
			if(get_post_meta($b2logos_sc->ID, 'shortcode', true) != '') {
				return do_shortcode( get_post_meta($b2logos_sc->ID, 'shortcode', true) );
			}
		}
		
	}
	
	add_shortcode( 'b2logos_saved', 'b2logos_saved_shortcode' );
	
	function b2logos_test_query_var($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>