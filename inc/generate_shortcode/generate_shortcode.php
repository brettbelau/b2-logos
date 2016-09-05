<?php

	/*========================================================================================================================================================================
		Register b2logo_sc Post Type
	========================================================================================================================================================================*/
	
	add_action('init', 'b2logo_sc_init');
	function b2logo_sc_init() 
	{
		/*----------------------------------------------------------------------
			b2logo_sc Post Type Labels
		----------------------------------------------------------------------*/
		
		$labels = array(
			'name' => _x('Saved Shortcodes', 'Post type general name'),
			'singular_name' => _x('Saved Shortcodes', 'Post type singular name'),
			'add_new' => _x('Generate New Shortcode', 'Logo Item'),
			'add_new_item' => __('Generate New Shortcode'),
			'edit_item' => __('Edit Shortcode'),
			'new_item' => __('Generate Shortcode'),
			'all_items' => __('Saved Shortcodes'),
			'view_item' => __('View'),
			'search_items' => __('Search'),
			'not_found' =>  __('No Shortcodes Found.'),
			'not_found_in_trash' => __('No Shortcodes Found.'), 
			'parent_item_colon' => '',
			'menu_name' => 'Logos Shortcodes'
		);
		
		/*----------------------------------------------------------------------
			b2logo_sc Post Type Properties
		----------------------------------------------------------------------*/
		
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'show_in_menu' => false, 
			'show_in_admin_bar' => false,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title')
		);
		
		/*----------------------------------------------------------------------
			Register b2logo_sc Post Type Function
		----------------------------------------------------------------------*/
		
		register_post_type('b2logo_sc',$args);

	}
	
	
	/*========================================================================================================================================================================
		b2logo_sc Post Type All Themes Table Columns
	========================================================================================================================================================================*/
	
	/*----------------------------------------------------------------------
		b2logo_sc Declaration Function
	----------------------------------------------------------------------*/
	function b2logo_sc_columns($b2logo_sc_columns){
		
		$b2logo_sc_columns = array(

			"cb" => "<input type=\"checkbox\" />",

			"title" => "Title",
			
			"shortcode" => "Shortcode",

			"author" => "Author",
			
			"date" => "Date",

		);

		return $b2logo_sc_columns;

	}
	
	/*----------------------------------------------------------------------
		b2logo_sc Value Function
	----------------------------------------------------------------------*/
	function b2logo_sc_columns_display($b2logo_sc_columns, $post_id){
		
		global $post;
		
		if ( 'shortcode' == $b2logo_sc_columns ) {
			
			echo '[b2logos_saved id="'.$post_id.'"]';
		
		}
		
	}
	
	/*----------------------------------------------------------------------
		Add manage_b2logo_sc_posts_columns Filter 
	----------------------------------------------------------------------*/
	add_filter("manage_b2logo_sc_posts_columns", "b2logo_sc_columns");
	
	/*----------------------------------------------------------------------
		Add manage_b2logo_sc_posts_custom_column Action
	----------------------------------------------------------------------*/
	add_action("manage_b2logo_sc_posts_custom_column",  "b2logo_sc_columns_display", 10, 2 );
	
	/*========================================================================================================================================================================
		Add Meta Box For b2logo_sc Post Type
	========================================================================================================================================================================*/
	
	/*----------------------------------------------------------------------
		add_meta_boxes Action For b2logo_sc Post Type
	----------------------------------------------------------------------*/
	
	add_action( 'add_meta_boxes', 'b2logo_sc_add_custom_box' );
	
	/*----------------------------------------------------------------------
		Properties Of b2logo_sc Meta Boxes 
	----------------------------------------------------------------------*/
	
	function b2logo_sc_add_custom_box() {
		add_meta_box( 
			'b2logo_sc_options_metabox',
			'Options',
			'b2logo_sc_options_metabox',
			'b2logo_sc',
			'side'
		);
		
		add_meta_box( 
			'b2logo_sc_preview_metabox',
			'Preview',
			'b2logo_sc_preview_metabox',
			'b2logo_sc',
			'advanced'
		);
	}
	
	/*----------------------------------------------------------------------
		Content Of b2logo_sc Options Meta Box 
	----------------------------------------------------------------------*/
	
	function b2logo_sc_preview_metabox( $post ) {
		?>
		<p id="b2logos_noteParagraph">
			<strong>Note: </strong>Please copy and paste a shortcode in the yellow box below into page, post editor and logos widget. 
			<?php if ( defined( 'WPB_VC_VERSION' ) ) { echo 'Also you can use logos element into visual composer page builder to insert saved shortcodes.'; } ?>

		</p>
		
		<div id="b2logos_div_shortcode" style="<?php if($post->post_status !='auto-draft'){ echo 'display:none;'; } ?>">[b2logos]</div>
		
		<div id="b2logos_div_shortcode_saved" style="<?php if($post->post_status =='auto-draft'){ echo 'display:none;'; } ?>">[b2logos_saved id="<?php echo $post->ID; ?>"]</div>
		
		<input type="hidden" name="b2logos_shortcode" id="b2logos_shortcode" value="<?php echo get_post_meta($post->ID, 'shortcode', true); ?>" />
		
		<div id="b2logos_gene_short_preview">Loading ...</div>
		<?php
	}
	
	
	/*----------------------------------------------------------------------
		Content Of b2logo_sc Options Meta Box 
	----------------------------------------------------------------------*/
	
	function b2logo_sc_options_metabox( $post ) {

		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'b2logo_sc_noncename' );
		

		// columns
		$columns = metadata_exists('post', $post->ID, 'columns') ? get_post_meta($post->ID, 'columns', true) : '5';

			
		// items height percentage
		$itemsheightpercentage = metadata_exists('post', $post->ID, 'itemsheightpercentage') ? get_post_meta($post->ID, 'itemsheightpercentage', true) : '0.80';
			
		// background color
		$backgroundcolor = metadata_exists('post', $post->ID, 'backgroundcolor') ? get_post_meta($post->ID, 'backgroundcolor', true) : 'transparent';
			
		// layout
		$layout = metadata_exists('post', $post->ID, 'layout') ? get_post_meta($post->ID, 'layout', true) : 'grid';
			
		// num
		$num = metadata_exists('post', $post->ID, 'num') ? get_post_meta($post->ID, 'num', true) : '';
			
		// category
		$category = metadata_exists('post', $post->ID, 'category') ? get_post_meta($post->ID, 'category', true) : '-1';
			
		// orderby
		$orderby = metadata_exists('post', $post->ID, 'orderby') ? get_post_meta($post->ID, 'orderby', true) : 'date';
			
		// order
		$order = metadata_exists('post', $post->ID, 'order') ? get_post_meta($post->ID, 'order', true) : 'DESC';
			
		// margin between items
		$marginbetweenitems = metadata_exists('post', $post->ID, 'marginbetweenitems') ? get_post_meta($post->ID, 'marginbetweenitems', true) : '25px';

		// tooltip
		$tooltip = metadata_exists('post', $post->ID, 'tooltip') ? get_post_meta($post->ID, 'tooltip', true) : 'enabled';
			
		// responsive
		$responsive = metadata_exists('post', $post->ID, 'responsive') ? get_post_meta($post->ID, 'responsive', true) : 'enabled';
			
		// grayscale
		$grayscale = metadata_exists('post', $post->ID, 'grayscale') ? get_post_meta($post->ID, 'grayscale', true) : 'disabled';
			
		// border
		$border = metadata_exists('post', $post->ID, 'border') ? get_post_meta($post->ID, 'border', true) : 'enabled';
			
		// border color
		$bordercolor = metadata_exists('post', $post->ID, 'bordercolor') ? get_post_meta($post->ID, 'bordercolor', true) : '#DCDCDC';
			
		// border radius
		$borderradius = metadata_exists('post', $post->ID, 'borderradius') ? get_post_meta($post->ID, 'borderradius', true) : 'b2logos_no_radius';
			
		// on click action
		$onclickaction = metadata_exists('post', $post->ID, 'onclickaction') ? get_post_meta($post->ID, 'onclickaction', true) : 'openLink';
			
		// details area padding
		$detailsarea_padding = metadata_exists('post', $post->ID, 'detailsarea_padding') ? get_post_meta($post->ID, 'detailsarea_padding', true) : '30px';
			
		// details area bg color
		$detailsarea_bgcolor = metadata_exists('post', $post->ID, 'detailsarea_bgcolor') ? get_post_meta($post->ID, 'detailsarea_bgcolor', true) : '#f6f6f6';
			
		// details area close btn color
		$detailsarea_closebtncolor = metadata_exists('post', $post->ID, 'detailsarea_closebtncolor') ? get_post_meta($post->ID, 'detailsarea_closebtncolor', true) : '#777777';
			
		// details area border
		$detailsarea_border = metadata_exists('post', $post->ID, 'detailsarea_border') ? get_post_meta($post->ID, 'detailsarea_border', true) : 'enabled';
			
		// details area border color
		$detailsarea_bordercolor = metadata_exists('post', $post->ID, 'detailsarea_bordercolor') ? get_post_meta($post->ID, 'detailsarea_bordercolor', true) : '#dcdcdc';
			
		// details area logo
		$detailsarea_logo = metadata_exists('post', $post->ID, 'detailsarea_logo') ? get_post_meta($post->ID, 'detailsarea_logo', true) : 'enabled';
			
		// details area logo border
		$detailsarea_logoborder = metadata_exists('post', $post->ID, 'detailsarea_logoborder') ? get_post_meta($post->ID, 'detailsarea_logoborder', true) : 'enabled';
			
		// details area logo border color
		$detailsarea_logobordercolor = metadata_exists('post', $post->ID, 'detailsarea_logobordercolor') ? get_post_meta($post->ID, 'detailsarea_logobordercolor', true) : '#dcdcdc';
			
		// details area logo bg color
		$detailsarea_logobgcolor = metadata_exists('post', $post->ID, 'detailsarea_logobgcolor') ? get_post_meta($post->ID, 'detailsarea_logobgcolor', true) : 'transparent';
			
		// autoplay
		$autoplay = metadata_exists('post', $post->ID, 'autoplay') ? get_post_meta($post->ID, 'autoplay', true) : 'true';
		
		// slider circular
		$slider_circular = metadata_exists('post', $post->ID, 'slider_circular') ? get_post_meta($post->ID, 'slider_circular', true) : 'true';
		
		// transition effect
		$transitioneffect = metadata_exists('post', $post->ID, 'transitioneffect') ? get_post_meta($post->ID, 'transitioneffect', true) : 'scroll';
			
		// easing function
		$easingfunction = metadata_exists('post', $post->ID, 'easingfunction') ? get_post_meta($post->ID, 'easingfunction', true) : 'quadratic';
			
		// scroll duration
		$scrollduration = metadata_exists('post', $post->ID, 'scrollduration') ? get_post_meta($post->ID, 'scrollduration', true) : '1000';
			
		// pause duration
		$pauseduration = metadata_exists('post', $post->ID, 'pauseduration') ? get_post_meta($post->ID, 'pauseduration', true) : '9000';
			
		// buttons border color
		$buttonsbordercolor = metadata_exists('post', $post->ID, 'buttonsbordercolor') ? get_post_meta($post->ID, 'buttonsbordercolor', true) : '#DCDCDC';
			
		// buttons bg color
		$buttonsbgcolor = metadata_exists('post', $post->ID, 'buttonsbgcolor') ? get_post_meta($post->ID, 'buttonsbgcolor', true) : '#FFFFFF';
			
		// buttons arrows color
		$buttonsarrowscolor = metadata_exists('post', $post->ID, 'buttonsarrowscolor') ? get_post_meta($post->ID, 'buttonsarrowscolor', true) : 'lightgray';
		
		// slider_pagination
		$slider_pagination = metadata_exists('post', $post->ID, 'slider_pagination') ? get_post_meta($post->ID, 'slider_pagination', true) : 'disabled';
		
		// slider_pagination_color
		$slider_pagination_color = metadata_exists('post', $post->ID, 'slider_pagination_color') ? get_post_meta($post->ID, 'slider_pagination_color', true) : '#999999';
		
		// hover effect
		$hovereffect = metadata_exists('post', $post->ID, 'hovereffect') ? get_post_meta($post->ID, 'hovereffect', true) : 'effect1';
			
		// hover effect color
		$hovereffectcolor = metadata_exists('post', $post->ID, 'hovereffectcolor') ? get_post_meta($post->ID, 'hovereffectcolor', true) : '#DCDCDC';
			
		//font style
		$fontstyle = metadata_exists('post', $post->ID, 'fontstyle') ? get_post_meta($post->ID, 'fontstyle', true) : 'custom';
			
		// title font family
		$titlefontfamily = metadata_exists('post', $post->ID, 'titlefontfamily') ? get_post_meta($post->ID, 'titlefontfamily', true) : '';
			
		// title font color
		$titlefontcolor = metadata_exists('post', $post->ID, 'titlefontcolor') ? get_post_meta($post->ID, 'titlefontcolor', true) : '#777777';
			
		// title font size
		$titlefontsize = metadata_exists('post', $post->ID, 'titlefontsize') ? get_post_meta($post->ID, 'titlefontsize', true) : '15px';
			
		// title font weight
		$titlefontweight = metadata_exists('post', $post->ID, 'titlefontweight') ? get_post_meta($post->ID, 'titlefontweight', true) : 'bold';
			
		// text font family
		$textfontfamily = metadata_exists('post', $post->ID, 'textfontfamily') ? get_post_meta($post->ID, 'textfontfamily', true) : '';
			
		// text font color
		$textfontcolor = metadata_exists('post', $post->ID, 'textfontcolor') ? get_post_meta($post->ID, 'textfontcolor', true) : '#777777';
			
		// text font size
		$textfontsize = metadata_exists('post', $post->ID, 'textfontsize') ? get_post_meta($post->ID, 'textfontsize', true) : '12px';
			
		// excerpt text length
		$excerpttextlength = metadata_exists('post', $post->ID, 'excerpttextlength') ? get_post_meta($post->ID, 'excerpttextlength', true) : '55';
			
		// list border
		$listborder = metadata_exists('post', $post->ID, 'listborder') ? get_post_meta($post->ID, 'listborder', true) : 'enabled';
			
		// list border color
		$listbordercolor = metadata_exists('post', $post->ID, 'listbordercolor') ? get_post_meta($post->ID, 'listbordercolor', true) : '#DCDCDC';
			
		// list border style
		$listborderstyle = metadata_exists('post', $post->ID, 'listborderstyle') ? get_post_meta($post->ID, 'listborderstyle', true) : 'dashed';
			
		// more link text
		$morelinktext = metadata_exists('post', $post->ID, 'morelinktext') ? get_post_meta($post->ID, 'morelinktext', true) : 'Read More';
			
		// more link text color
		$morelinktextcolor = metadata_exists('post', $post->ID, 'morelinktextcolor') ? get_post_meta($post->ID, 'morelinktextcolor', true) : '#999999';
			
		// pagination
		$pagination = metadata_exists('post', $post->ID, 'pagination') ? get_post_meta($post->ID, 'pagination', true) : 'disabled';
				
		// pagination_border_style
		$pagination_border_style = metadata_exists('post', $post->ID, 'pagination_border_style') ? get_post_meta($post->ID, 'pagination_border_style', true) : 'solid';
				
		// pagination_border_color
		$pagination_border_color = metadata_exists('post', $post->ID, 'pagination_border_color') ? get_post_meta($post->ID, 'pagination_border_color', true) : '#DDDDDD';
				
		// pagination_bg_color
		$pagination_bg_color = metadata_exists('post', $post->ID, 'pagination_bg_color') ? get_post_meta($post->ID, 'pagination_bg_color', true) : 'transparent';
				
		// pagination_font_color
		$pagination_font_color = metadata_exists('post', $post->ID, 'pagination_font_color') ? get_post_meta($post->ID, 'pagination_font_color', true) : '#777777';
				
		// pagination_font_size
		$pagination_font_size = metadata_exists('post', $post->ID, 'pagination_font_size') ? get_post_meta($post->ID, 'pagination_font_size', true) : '14px';
				
		// pagination_font_family
		$pagination_font_family = metadata_exists('post', $post->ID, 'pagination_font_family') ? get_post_meta($post->ID, 'pagination_font_family', true) : '';
				
		// pagination_current_font_color
		$pagination_current_font_color = metadata_exists('post', $post->ID, 'pagination_current_font_color') ? get_post_meta($post->ID, 'pagination_current_font_color', true) : '#F47E00';
				
		// pagination_current_bg_color
		$pagination_current_bg_color = metadata_exists('post', $post->ID, 'pagination_current_bg_color') ? get_post_meta($post->ID, 'pagination_current_bg_color', true) : 'transparent';
				
		// pagination_current_border_color
		$pagination_current_border_color = metadata_exists('post', $post->ID, 'pagination_current_border_color') ? get_post_meta($post->ID, 'pagination_current_border_color', true) : '#DDDDDD';
				
		// pagination_align
		$pagination_align = metadata_exists('post', $post->ID, 'pagination_align') ? get_post_meta($post->ID, 'pagination_align', true) : 'center';
				
		// pagination_divider_style
		$pagination_divider_style = metadata_exists('post', $post->ID, 'pagination_divider_style') ? get_post_meta($post->ID, 'pagination_divider_style', true) : 'solid';
				
		// pagination_divider_color
		$pagination_divider_color = metadata_exists('post', $post->ID, 'pagination_divider_color') ? get_post_meta($post->ID, 'pagination_divider_color', true) : '#DDDDDD';
		
		
		$b2logos_wpml_current_lang ='';
		
		if(function_exists('icl_object_id')) {
			global $sitepress;
			
			if(isset($sitepress)) {
				$b2logos_wpml_current_lang = $sitepress->get_current_language();
			}
		}
		
		?>
		
		<div id="b2logos_gene_short_leftSidebar">
			
			<input type="hidden" id="b2logos_wpml_current_lang" name="b2logos_wpml_current_lang" value="<?php echo $b2logos_wpml_current_lang; ?>" />
			<input type="hidden" id="b2logos_id" name="b2logos_id" value="<?php echo 'b2logos'.$post->ID; ?>" />
			
			<div class="b2logos_sectionTitle">Logo Categories</div>
			
			<div class="b2logos_rowsContainer b2logos_rowsContainerOpend" >
				<div class="row">
					<ul id="b2logos_categoriesList">
						<?php
						echo wp_count_terms('b2logocategory') > 0 ? wp_terms_checklist($post->ID,array('taxonomy' => 'b2logocategory', 'selected_cats'=> explode(',',get_post_meta($post->ID,'category',true)), 'checked_ontop' => false, 'echo' => false)) : '<li>No items found.</li>';
						?>
					</ul>
				</div>
			</div>
			<div class="b2logos_sectionTitle">General Settings</div>
			
			<div class="b2logos_rowsContainer" >
				
				
				
				
				<div class="row">
					<label for="b2logos_orderByList">Order Logos By</label>
					<select id="b2logos_orderByList" name="b2logos_orderByList">
						<option value="menu_order" <?php if($orderby == 'menu_order'){ echo 'selected'; } ?> >Order</option>
						<option value="date" <?php if($orderby == 'date'){ echo 'selected'; } ?> >Publish Date</option>
						<option value="title" <?php if($orderby == 'title'){ echo 'selected'; } ?> >Title</option>
						<option value="rand" <?php if($orderby == 'rand'){ echo 'selected'; } ?> >Random </option>
					</select>
				</div>
				
				<div class="row">
					<label for="b2logos_orderList">Order</label>
					<select id="b2logos_orderList" name="b2logos_orderList">
						<option value="DESC" <?php if($order == 'DESC'){ echo 'selected'; } ?> >Descending</option>
						<option value="ASC" <?php if($order == 'ASC'){ echo 'selected'; } ?> >Ascending</option>
					</select>
				</div>
			</div>
			
			
			
			
			<div class="b2logos_sectionTitle">Layout</div>
			
			<div class="b2logos_rowsContainer" >
				<div class="row">
					<label for="b2logos_layout">Layout</label>
					<select id="b2logos_layout" name="b2logos_layout">
						<option value="slider" <?php if($layout == 'slider'){ echo 'selected'; } ?> >Slider</option>
						<option value="grid" <?php if($layout == 'grid'){ echo 'selected'; } ?> >Grid</option>
						<option value="list" <?php if($layout == 'list'){ echo 'selected'; } ?> >List</option>
					</select>
				</div>
				
				<div class="row b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination">Pagination</label>
					<select id="b2logos_pagination" name="tmls_pagination">
						<option value="enabled" <?php if($pagination == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($pagination == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
				
				<div class="row">
					<label for="b2logos_NumberInput">Number of Logos<span class="b2logos_pagination_option">per Page</span></label>
					<input type="text" id="b2logos_NumberInput" name="b2logos_NumberInput" value="<?php echo $num; ?>" placeholder="All" />
				</div>
				
				<div class="row b2logos_slider_option b2logos_grid_option">
					<label for="b2logos_columnsNumberList">Columns Number</label>
					<select id="b2logos_columnsNumberList" name="b2logos_columnsNumberList">
						<option value="1" <?php if($columns == '1'){ echo 'selected'; } ?> >1</option>
						<option value="2" <?php if($columns == '2'){ echo 'selected'; } ?> >2</option>
						<option value="3" <?php if($columns == '3'){ echo 'selected'; } ?> >3</option>
						<option value="4" <?php if($columns == '4'){ echo 'selected'; } ?> >4</option>
						<option value="5" <?php if($columns == '5'){ echo 'selected'; } ?> >5</option>
						<option value="6" <?php if($columns == '6'){ echo 'selected'; } ?> >6</option>
						<option value="7" <?php if($columns == '7'){ echo 'selected'; } ?> >7</option>
						<option value="8" <?php if($columns == '8'){ echo 'selected'; } ?> >8</option>
						<option value="9" <?php if($columns == '9'){ echo 'selected'; } ?> >9</option>
						<option value="10" <?php if($columns == '10'){ echo 'selected'; } ?> >10</option>
					</select>
				</div>
				
				<div class="row">
					<label for="b2logos_itemsHeightPercentage">Logo Height</label>
					<select id="b2logos_itemsHeightPercentage" name="b2logos_itemsHeightPercentage">
						<option value="1.50" <?php if($itemsheightpercentage == '1.50'){ echo 'selected'; } ?> >150% of item width</option>
						<option value="1.45" <?php if($itemsheightpercentage == '1.45'){ echo 'selected'; } ?> >145% of item width</option>
						<option value="1.40" <?php if($itemsheightpercentage == '1.40'){ echo 'selected'; } ?> >140% of item width</option>
						<option value="1.35" <?php if($itemsheightpercentage == '1.35'){ echo 'selected'; } ?> >135% of item width</option>
						<option value="1.30" <?php if($itemsheightpercentage == '1.30'){ echo 'selected'; } ?> >130% of item width</option>
						<option value="1.25" <?php if($itemsheightpercentage == '1.25'){ echo 'selected'; } ?> >125% of item width</option>
						<option value="1.20" <?php if($itemsheightpercentage == '1.20'){ echo 'selected'; } ?> >120% of item width</option>
						<option value="1.15" <?php if($itemsheightpercentage == '1.15'){ echo 'selected'; } ?> >115% of item width</option>
						<option value="1.10" <?php if($itemsheightpercentage == '1.10'){ echo 'selected'; } ?> >110% of item width</option>
						<option value="1.05" <?php if($itemsheightpercentage == '1.05'){ echo 'selected'; } ?> >105% of item width</option>
						<option value="1.00" <?php if($itemsheightpercentage == '1.00'){ echo 'selected'; } ?> >100% of item width</option>
						<option value="0.95" <?php if($itemsheightpercentage == '0.95'){ echo 'selected'; } ?> >95% of item width</option>
						<option value="0.90" <?php if($itemsheightpercentage == '0.90'){ echo 'selected'; } ?> >90% of item width</option>
						<option value="0.85" <?php if($itemsheightpercentage == '0.85'){ echo 'selected'; } ?> >85% of item width</option>
						<option value="0.80" <?php if($itemsheightpercentage == '0.80'){ echo 'selected'; } ?> >80% of item width</option>
						<option value="0.75" <?php if($itemsheightpercentage == '0.75'){ echo 'selected'; } ?> >75% of item width</option>
						<option value="0.70" <?php if($itemsheightpercentage == '0.70'){ echo 'selected'; } ?> >70% of item width</option>
						<option value="0.65" <?php if($itemsheightpercentage == '0.65'){ echo 'selected'; } ?> >65% of item width</option>
						<option value="0.60" <?php if($itemsheightpercentage == '0.60'){ echo 'selected'; } ?> >60% of item width</option>
						<option value="0.55" <?php if($itemsheightpercentage == '0.55'){ echo 'selected'; } ?> >55% of item width</option>
						<option value="0.50" <?php if($itemsheightpercentage == '0.50'){ echo 'selected'; } ?> >50% of item width</option>
						<option value="0.45" <?php if($itemsheightpercentage == '0.45'){ echo 'selected'; } ?> >45% of item width</option>
						<option value="0.40" <?php if($itemsheightpercentage == '0.40'){ echo 'selected'; } ?> >40% of item width</option>
						<option value="0.35" <?php if($itemsheightpercentage == '0.35'){ echo 'selected'; } ?> >35% of item width</option>
						<option value="0.30" <?php if($itemsheightpercentage == '0.30'){ echo 'selected'; } ?> >30% of item width</option>
						<option value="0.25" <?php if($itemsheightpercentage == '0.25'){ echo 'selected'; } ?> >25% of item width</option>
						<option value="0.20" <?php if($itemsheightpercentage == '0.20'){ echo 'selected'; } ?> >20% of item width</option>
						<option value="0.15" <?php if($itemsheightpercentage == '0.15'){ echo 'selected'; } ?> >15% of item width</option>
						<option value="0.10" <?php if($itemsheightpercentage == '0.10'){ echo 'selected'; } ?> >10% of item width</option>
					</select>
				</div>
				
				<div class="row b2logos_slider_option b2logos_grid_option">
					<label for="b2logos_marginBetweenItems">Space Between Logos</label>
					<select id="b2logos_marginBetweenItems" name="b2logos_marginBetweenItems">
						<option value="" <?php if($marginbetweenitems == ''){ echo 'selected'; } ?> >0px</option>
						<option value="5px" <?php if($marginbetweenitems == '5px'){ echo 'selected'; } ?> >5px</option>
						<option value="10px" <?php if($marginbetweenitems == '10px'){ echo 'selected'; } ?> >10px</option>
						<option value="15px" <?php if($marginbetweenitems == '15px'){ echo 'selected'; } ?> >15px</option>
						<option value="20px" <?php if($marginbetweenitems == '20px'){ echo 'selected'; } ?> >20px</option>
						<option value="25px" <?php if($marginbetweenitems == '25px'){ echo 'selected'; } ?> >25px</option>
						<option value="30px" <?php if($marginbetweenitems == '30px'){ echo 'selected'; } ?> >30px</option>
					</select>
				</div>
				
				<div class="row b2logos_slider_option b2logos_grid_option">
					<label for="b2logos_tooltipList">Tooltip</label>
					<select id="b2logos_tooltipList" name="b2logos_tooltipList">
						<option value="enabled" <?php if($tooltip == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($tooltip == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
				
				
				
				<div class="row">
					<label for="b2logos_responsiveList">Responsive</label>
					<select id="b2logos_responsiveList" name="b2logos_responsiveList">
						<option value="enabled" <?php if($responsive == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($responsive == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
			</div>
			
			
			
			<div class="b2logos_sectionTitle">Logo Styles</div>
			
			<div class="b2logos_rowsContainer" >
				<div class="row">
					<label for="b2logos_border">Border</label>
					<select id="b2logos_border" name="b2logos_border">
						<option value="enabled" <?php if($border == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($border == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
				
				<div class="row b2logos_border_option">
					<label for="b2logos_borderColor">Border Color</label>
					<input type="text" id="b2logos_borderColor" name="b2logos_borderColor" value="<?php echo $bordercolor; ?>" />
					<div id="b2logos_borderColor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_borderColor_btn" name="b2logos_borderColor_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row">
					<label for="b2logos_borderRadius">Border Radius</label>
					<select id="b2logos_borderRadius" name="b2logos_borderRadius">
						<option value="b2logos_no_radius" <?php if($borderradius == 'b2logos_no_radius'){ echo 'selected'; } ?> >no radius</option>
						<option value="b2logos_small_radius" <?php if($borderradius == 'b2logos_small_radius'){ echo 'selected'; } ?> >small radius</option>
						<option value="b2logos_medium_radius" <?php if($borderradius == 'b2logos_medium_radius'){ echo 'selected'; } ?> >medium radius</option>
						<option value="b2logos_large_radius" <?php if($borderradius == 'b2logos_large_radius'){ echo 'selected'; } ?> >large radius</option>
					</select>
				</div>
				
				<div class="row">
					<label for="b2logos_bgColorInput">Items Background Color</label>
					<input type="text" id="b2logos_bgColorInput" name="b2logos_bgColorInput" value="<?php echo $backgroundcolor; ?>" />
					<div id="b2logos_bgColorInput_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_bgColorInput_btn" name="b2logos_bgColorInput_btn" value="View Color" class="button-primary" />
				</div>
			</div>
			
			
			
			
			
			
			
			
			
			
			<div class="b2logos_sectionTitle b2logos_pagination_option b2logos_grid_option b2logos_list_option">Pagination Style</div>
			
			<div class="b2logos_rowsContainer b2logos_pagination_option b2logos_grid_option b2logos_list_option" >
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_align">Align</label>
					<select id="b2logos_pagination_align" name="b2logos_pagination_align">
						<option value="center" <?php if($pagination_align == 'center'){ echo 'selected'; } ?> >center</option>
						<option value="left" <?php if($pagination_align == 'left'){ echo 'selected'; } ?> >left</option>
						<option value="right" <?php if($pagination_align == 'right'){ echo 'selected'; } ?> >right</option>
					</select>
				</div>
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_border_style">Border Style</label>
					<select id="b2logos_pagination_border_style" name="b2logos_pagination_border_style">
						<option value="solid" <?php if($pagination_border_style == 'solid'){ echo 'selected'; } ?> >solid</option>
						<option value="dashed" <?php if($pagination_border_style == 'dashed'){ echo 'selected'; } ?> >dashed</option>
						<option value="none" <?php if($pagination_border_style == 'none'){ echo 'selected'; } ?> >none</option>
					</select>
				</div>
				
				<div class="row b2logos_pagination_option b2logos_pagination_border_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_border_color">Border Color</label>
					<input type="text" id="b2logos_pagination_border_color" name="b2logos_pagination_border_color" value="<?php echo $pagination_border_color; ?>" />
					<div id="b2logos_pagination_border_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_pagination_border_color_btn" name="b2logos_pagination_border_color_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_bg_color">Background Color</label>
					<input type="text" id="b2logos_pagination_bg_color" name="b2logos_pagination_bg_color" value="<?php echo $pagination_bg_color; ?>" />
					<div id="b2logos_pagination_bg_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_pagination_bg_color_btn" name="b2logos_pagination_bg_color_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_font_color">Font Color</label>
					<input type="text" id="b2logos_pagination_font_color" name="b2logos_pagination_font_color" value="<?php echo $pagination_font_color; ?>" />
					<div id="b2logos_pagination_font_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_pagination_font_color_btn" name="b2logos_pagination_font_color_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_font_size">Font Size (px)</label>
					<select id="b2logos_pagination_font_size" name="b2logos_pagination_font_size">
						<option value="9px" <?php if($pagination_font_size == '9px'){ echo 'selected'; } ?> >9</option>
						<option value="10px" <?php if($pagination_font_size == '10px'){ echo 'selected'; } ?> >10</option>
						<option value="11px" <?php if($pagination_font_size == '11px'){ echo 'selected'; } ?> >11</option>
						<option value="12px" <?php if($pagination_font_size == '12px'){ echo 'selected'; } ?> >12</option>
						<option value="13px" <?php if($pagination_font_size == '13px'){ echo 'selected'; } ?> >13</option>
						<option value="14px" <?php if($pagination_font_size == '14px'){ echo 'selected'; } ?> >14</option>
						<option value="15px" <?php if($pagination_font_size == '15px'){ echo 'selected'; } ?> >15</option>
						<option value="16px" <?php if($pagination_font_size == '16px'){ echo 'selected'; } ?> >16</option>
						<option value="17px" <?php if($pagination_font_size == '17px'){ echo 'selected'; } ?> >17</option>
						<option value="18px" <?php if($pagination_font_size == '18px'){ echo 'selected'; } ?> >18</option>
						<option value="19px" <?php if($pagination_font_size == '19px'){ echo 'selected'; } ?> >19</option>
						<option value="20px" <?php if($pagination_font_size == '20px'){ echo 'selected'; } ?> >20</option>
						<option value="21px" <?php if($pagination_font_size == '21px'){ echo 'selected'; } ?> >21</option>
						<option value="22px" <?php if($pagination_font_size == '22px'){ echo 'selected'; } ?> >22</option>
						<option value="23px" <?php if($pagination_font_size == '23px'){ echo 'selected'; } ?> >23</option>
						<option value="24px" <?php if($pagination_font_size == '24px'){ echo 'selected'; } ?> >24</option>
						<option value="25px" <?php if($pagination_font_size == '25px'){ echo 'selected'; } ?> >25</option>
						<option value="26px" <?php if($pagination_font_size == '26px'){ echo 'selected'; } ?> >26</option>
						<option value="27px" <?php if($pagination_font_size == '27px'){ echo 'selected'; } ?> >27</option>
						<option value="28px" <?php if($pagination_font_size == '28px'){ echo 'selected'; } ?> >28</option>
						<option value="29px" <?php if($pagination_font_size == '29px'){ echo 'selected'; } ?> >29</option>
						<option value="30px" <?php if($pagination_font_size == '30px'){ echo 'selected'; } ?> >30</option>
						<option value="31px" <?php if($pagination_font_size == '31px'){ echo 'selected'; } ?> >31</option>
						<option value="32px" <?php if($pagination_font_size == '32px'){ echo 'selected'; } ?> >32</option>
						<option value="33px" <?php if($pagination_font_size == '33px'){ echo 'selected'; } ?> >33</option>
						<option value="34px" <?php if($pagination_font_size == '34px'){ echo 'selected'; } ?> >34</option>
						<option value="35px" <?php if($pagination_font_size == '35px'){ echo 'selected'; } ?> >35</option>
						<option value="36px" <?php if($pagination_font_size == '36px'){ echo 'selected'; } ?> >36</option>
					</select>
				</div>
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_font_family">Font Family</label>
					<select id="b2logos_pagination_font_family" name="b2logos_pagination_font_family">
						<option value="" <?php if($pagination_font_family == ''){ echo 'selected'; } ?> >current theme font</option>
						<option value="Georgia, serif" <?php if($pagination_font_family == 'Georgia, serif'){ echo 'selected'; } ?> >Georgia</option>
						<option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif" <?php if($pagination_font_family == "'Palatino Linotype', 'Book Antiqua', Palatino, serif"){ echo 'selected'; } ?> >Palatino Linotype</option>
						<option value="'Times New Roman', Times, serif" <?php if($pagination_font_family == "'Times New Roman', Times, serif"){ echo 'selected'; } ?> >Times New Roman</option>
						<option value="Arial, Helvetica, sans-serif" <?php if($pagination_font_family == 'Arial, Helvetica, sans-serif'){ echo 'selected'; } ?> >Arial</option>
						<option value="'Arial Black', Gadget, sans-serif" <?php if($pagination_font_family == "'Arial Black', Gadget, sans-serif"){ echo 'selected'; } ?> >Arial Black</option>
						<option value="'Comic Sans MS', cursive, sans-serif" <?php if($pagination_font_family == "'Comic Sans MS', cursive, sans-serif"){ echo 'selected'; } ?> >Comic Sans MS</option>
						<option value="Impact, Charcoal, sans-serif" <?php if($pagination_font_family == 'Impact, Charcoal, sans-serif'){ echo 'selected'; } ?> >Impact</option>
						<option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif" <?php if($pagination_font_family == "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"){ echo 'selected'; } ?> >Lucida Sans Unicode</option>
						<option value="Tahoma, Geneva, sans-serif" <?php if($pagination_font_family == 'Tahoma, Geneva, sans-serif'){ echo 'selected'; } ?> >Tahoma</option>
						<option value="'Trebuchet MS', Helvetica, sans-serif" <?php if($pagination_font_family == "'Trebuchet MS', Helvetica, sans-serif"){ echo 'selected'; } ?> >Trebuchet MS</option>
						<option value="Verdana, Geneva, sans-serif" <?php if($pagination_font_family == 'Verdana, Geneva, sans-serif'){ echo 'selected'; } ?> >Verdana</option>
						<option value="'Courier New', Courier, monospace" <?php if($pagination_font_family == "'Courier New', Courier, monospace"){ echo 'selected'; } ?> >Courier New</option>
						<option value="'Lucida Console', Monaco, monospace" <?php if($pagination_font_family == "'Lucida Console', Monaco, monospace"){ echo 'selected'; } ?> >Lucida Console</option>
					</select>
				</div>
				
				<div class="row b2logos_pagination_option b2logos_pagination_border_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_current_border_color">Current Border Color</label>
					<input type="text" id="b2logos_pagination_current_border_color" name="b2logos_pagination_current_border_color" value="<?php echo $pagination_current_border_color; ?>" />
					<div id="b2logos_pagination_current_border_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_pagination_current_border_color_btn" name="b2logos_pagination_current_border_color_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_current_bg_color">Current Background Color</label>
					<input type="text" id="b2logos_pagination_current_bg_color" name="b2logos_pagination_current_bg_color" value="<?php echo $pagination_current_bg_color; ?>" />
					<div id="b2logos_pagination_current_bg_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_pagination_current_bg_color_btn" name="b2logos_pagination_current_bg_color_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_current_font_color">Current Font Color</label>
					<input type="text" id="b2logos_pagination_current_font_color" name="b2logos_pagination_current_font_color" value="<?php echo $pagination_current_font_color; ?>" />
					<div id="b2logos_pagination_current_font_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_pagination_current_font_color_btn" name="b2logos_pagination_current_font_color_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_pagination_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_divider_style">Divider Style</label>
					<select id="b2logos_pagination_divider_style" name="b2logos_pagination_divider_style">
						<option value="solid" <?php if($pagination_divider_style == 'solid'){ echo 'selected'; } ?> >solid</option>
						<option value="dashed" <?php if($pagination_divider_style == 'dashed'){ echo 'selected'; } ?> >dashed</option>
						<option value="none" <?php if($pagination_divider_style == 'none'){ echo 'selected'; } ?> >none</option>
					</select>
				</div>
				
				<div class="row b2logos_pagination_option b2logos_pagination_divider_option b2logos_grid_option b2logos_list_option">
					<label for="b2logos_pagination_divider_color">Divider Color</label>
					<input type="text" id="b2logos_pagination_divider_color" name="b2logos_pagination_divider_color" value="<?php echo $pagination_divider_color; ?>" />
					<div id="b2logos_pagination_divider_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_pagination_divider_color_btn" name="b2logos_pagination_divider_color_btn" value="View Color" class="button-primary" />
				</div>
				
			</div>
			
			
			
			
			
			
			
			
			
			
			
			<div class="b2logos_list_option b2logos_sectionTitle">List Dividers Style</div>
			
			<div class="b2logos_list_option b2logos_rowsContainer" >
				<div class="row b2logos_list_option">
					<label for="b2logos_list_border">List Border</label>
					<select id="b2logos_list_border" name="b2logos_list_border">
						<option value="enabled" <?php if($listborder == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($listborder == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
				
				
				<div class="row b2logos_list_option b2logos_list_border_option">
					<label for="b2logos_listBorderColor">List Border Color</label>
					<input type="text" id="b2logos_listBorderColor" name="b2logos_listBorderColor" value="<?php echo $listbordercolor; ?>" />
					<div id="b2logos_listBorderColor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_listBorderColor_btn" name="b2logos_listBorderColor_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_list_option b2logos_list_border_option">
					<label for="b2logos_list_border_style">List Border Style</label>
					<select id="b2logos_list_border_style" name="b2logos_list_border_style">
						<option value="dashed" <?php if($listborderstyle == 'dashed'){ echo 'selected'; } ?> >dashed</option>
						<option value="solid" <?php if($listborderstyle == 'solid'){ echo 'selected'; } ?> >solid</option>
					</select>
				</div>
			</div>
			
			
			<div class="b2logos_sectionTitle">Hover Effect</div>
			
			<div class="b2logos_rowsContainer" >
				<div class="row">
					<label for="b2logos_hovereffect">Hover Effect</label>
					<select id="b2logos_hovereffect" name="b2logos_hovereffect">
						<option value="" <?php if($hovereffect == ''){ echo 'selected'; } ?> >None</option>
						<option value="effect1" <?php if($hovereffect == 'effect1'){ echo 'selected'; } ?> >Effect 1 ( outer shadow )</option>
						<option value="effect2" <?php if($hovereffect == 'effect2'){ echo 'selected'; } ?> >Effect 2 ( inner shadow )</option>
						<option value="effect3" <?php if($hovereffect == 'effect3'){ echo 'selected'; } ?> >Effect 3 ( border color )</option>
						<option value="effect4" <?php if($hovereffect == 'effect4'){ echo 'selected'; } ?> >Effect 4 ( fading )</option>
					</select>
				</div>
				
				<div class="row b2logos_hovereffect_option">
					<label for="b2logos_hoverEffectColor">Hover Effect Color</label>
					<input type="text" id="b2logos_hoverEffectColor" name="b2logos_hoverEffectColor" value="<?php echo $hovereffectcolor; ?>" />
					<div id="b2logos_hoverEffectColor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_hoverEffectColor_btn" name="b2logos_hoverEffectColor_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row">
					<label for="b2logos_grayscaleList">Grayscale</label>
					<select id="b2logos_grayscaleList" name="b2logos_grayscaleList">
						<option value="enabled" <?php if($grayscale == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($grayscale == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
			</div>
			
			
			
			
			<div class="b2logos_sectionTitle">On Click Event</div>
			
			<div class="b2logos_rowsContainer" >
				<div class="row">
					<label for="b2logos_onClickAction">Action</label>
					<select id="b2logos_onClickAction" name="b2logos_onClickAction">
						<option value="none" <?php if($onclickaction == 'none'){ echo 'selected'; } ?> >none</option>
						<option value="openLink" <?php if($onclickaction == 'openLink'){ echo 'selected'; } ?> >open link</option>
						<option value="showDetails" <?php if($onclickaction == 'showDetails'){ echo 'selected'; } ?> >show details</option>
					</select>
				</div>
			</div>
			
			<div class="b2logos_details_area_option b2logos_sectionTitle">Details Area Style</div>
			
			<div class="b2logos_details_area_option b2logos_rowsContainer" >
				<div class="row b2logos_details_area_option">
					<label for="b2logos_detailsArea_padding">Padding</label>
					<select id="b2logos_detailsArea_padding" name="b2logos_detailsArea_padding">
						<option value="0px" <?php if($detailsarea_padding == '0px'){ echo 'selected'; } ?> >0px</option>
						<option value="5px" <?php if($detailsarea_padding == '5px'){ echo 'selected'; } ?> >5px</option>
						<option value="10px" <?php if($detailsarea_padding == '10px'){ echo 'selected'; } ?> >10px</option>
						<option value="15px" <?php if($detailsarea_padding == '15px'){ echo 'selected'; } ?> >15px</option>
						<option value="20px" <?php if($detailsarea_padding == '20px'){ echo 'selected'; } ?> >20px</option>
						<option value="25px" <?php if($detailsarea_padding == '25px'){ echo 'selected'; } ?> >25px</option>
						<option value="30px" <?php if($detailsarea_padding == '30px'){ echo 'selected'; } ?> >30px</option>
					</select>
				</div>
				
				<div class="row b2logos_details_area_option">
					<label for="b2logos_detailsArea_bgColor">Background Color</label>
					<input type="text" id="b2logos_detailsArea_bgColor" name="b2logos_detailsArea_bgColor" value="<?php echo $detailsarea_bgcolor; ?>" />
					<div id="b2logos_detailsArea_bgColor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_detailsArea_bgColor_btn" name="b2logos_detailsArea_bgColor_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_details_area_option">
					<label for="b2logos_detailsArea_closeBtnColor">Close Button Color</label>
					<input type="text" id="b2logos_detailsArea_closeBtnColor" name="b2logos_detailsArea_closeBtnColor" value="<?php echo $detailsarea_closebtncolor; ?>" />
					<div id="b2logos_detailsArea_closeBtnColor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_detailsArea_closeBtnColor_btn" name="b2logos_detailsArea_closeBtnColor_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_details_area_option">
					<label for="b2logos_detailsArea_border">Border</label>
					<select id="b2logos_detailsArea_border" name="b2logos_detailsArea_border">
						<option value="enabled" <?php if($detailsarea_border == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($detailsarea_border == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
				
				<div class="row b2logos_details_area_option b2logos_details_area_border_option">
					<label for="b2logos_detailsArea_borderColor">Border Color</label>
					<input type="text" id="b2logos_detailsArea_borderColor" name="b2logos_detailsArea_borderColor" value="<?php echo $detailsarea_bordercolor; ?>" />
					<div id="b2logos_detailsArea_borderColor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_detailsArea_borderColor_btn" name="b2logos_detailsArea_borderColor_btn" value="View Color" class="button-primary" />
				</div>
				
				
				<div class="row b2logos_details_area_option">
					<label for="b2logos_detailsArea_logo">Logo</label>
					<select id="b2logos_detailsArea_logo" name="b2logos_detailsArea_logo">
						<option value="enabled" <?php if($detailsarea_logo == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($detailsarea_logo == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
				
				<div class="row b2logos_details_area_option b2logos_details_area_logo_option">
					<label for="b2logos_detailsArea_logoBorder">Logo Border</label>
					<select id="b2logos_detailsArea_logoBorder" name="b2logos_detailsArea_logoBorder">
						<option value="enabled" <?php if($detailsarea_logoborder == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($detailsarea_logoborder == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
				
				<div class="row b2logos_details_area_option b2logos_details_area_logoborder_option b2logos_details_area_logo_option">
					<label for="b2logos_detailsArea_logoBorderColor">Logo Border Color</label>
					<input type="text" id="b2logos_detailsArea_logoBorderColor" name="b2logos_detailsArea_logoBorderColor" value="<?php echo $detailsarea_logobordercolor; ?>" />
					<div id="b2logos_detailsArea_logoBorderColor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_detailsArea_logoBorderColor_btn" name="b2logos_detailsArea_logoBorderColor_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_details_area_option b2logos_details_area_logo_option">
					<label for="b2logos_detailsArea_logoBgColor">Logo Background Color</label>
					<input type="text" id="b2logos_detailsArea_logoBgColor" name="b2logos_detailsArea_logoBgColor" value="<?php echo $detailsarea_logobgcolor; ?>" />
					<div id="b2logos_detailsArea_logoBgColor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_detailsArea_logoBgColor_btn" name="b2logos_detailsArea_logoBgColor_btn" value="View Color" class="button-primary" />
				</div>
			</div>
			
			<div class="b2logos_slider_option b2logos_sectionTitle">Slider Settings</div>
			
			<div class="b2logos_slider_option b2logos_rowsContainer" >
				<div class="row b2logos_slider_option">
					<label for="b2logos_autoplay">Autoplay</label>
					<select id="b2logos_autoplay" name="b2logos_autoplay">
						<option value="true" <?php if($autoplay == 'true'){ echo 'selected'; } ?> >true</option>
						<option value="false" <?php if($autoplay == 'false'){ echo 'selected'; } ?> >false</option>
					</select>
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_slider_circular">Circular</label>
					<select id="b2logos_slider_circular" name="b2logos_slider_circular">
						<option value="true" <?php if($slider_circular == 'true'){ echo 'selected'; } ?> >true</option>
						<option value="false" <?php if($slider_circular == 'false'){ echo 'selected'; } ?> >false</option>
					</select>
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_transitionEffect">Transition Effect</label>
					<select id="b2logos_transitionEffect" name="b2logos_transitionEffect">
						<option value="scroll" <?php if($transitioneffect == 'scroll'){ echo 'selected'; } ?> >scroll</option>
						<option value="fade" <?php if($transitioneffect == 'fade'){ echo 'selected'; } ?> >fade</option>
					</select>
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_easingFunction">Animation</label>
					<select id="b2logos_easingFunction" name="b2logos_easingFunction">
						<option value="linear" <?php if($easingfunction == 'linear'){ echo 'selected'; } ?> >linear</option>
						<option value="swing" <?php if($easingfunction == 'swing'){ echo 'selected'; } ?> >swing</option>
						<option value="quadratic" <?php if($easingfunction == 'quadratic'){ echo 'selected'; } ?> >quadratic</option>
						<option value="cubic" <?php if($easingfunction == 'cubic'){ echo 'selected'; } ?> >cubic</option>
						<option value="elastic" <?php if($easingfunction == 'elastic'){ echo 'selected'; } ?> >elastic</option>
					</select>
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_scrollduration">Scroll Duration</label>
					<input type="text" id="b2logos_scrollduration" name="b2logos_scrollduration" value="<?php echo $scrollduration; ?>" />
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_pauseduration">Pause Duration</label>
					<input type="text" id="b2logos_pauseduration" name="b2logos_pauseduration" value="<?php echo $pauseduration; ?>" />
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_buttonsbordercolor">Buttons Border Color</label>
					<input type="text" id="b2logos_buttonsbordercolor" name="b2logos_buttonsbordercolor" value="<?php echo $buttonsbordercolor; ?>" />
					<div id="b2logos_buttonsbordercolor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_buttonsbordercolor_btn" name="b2logos_buttonsbordercolor_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_buttonsbgcolor">Buttons Background Color</label>
					<input type="text" id="b2logos_buttonsbgcolor" name="b2logos_buttonsbgcolor" value="<?php echo $buttonsbgcolor; ?>" />
					<div id="b2logos_buttonsbgcolor_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_buttonsbgcolor_btn" name="b2logos_buttonsbgcolor_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_buttonsarrowscolor">Buttons Arrows Color</label>
					<select id="b2logos_buttonsarrowscolor" name="b2logos_buttonsarrowscolor">
						<option value="darkgray" <?php if($buttonsarrowscolor == 'darkgray'){ echo 'selected'; } ?> >dark gray</option>
						<option value="lightgray" <?php if($buttonsarrowscolor == 'lightgray'){ echo 'selected'; } ?> >light gray</option>
						<option value="white" <?php if($buttonsarrowscolor == 'white'){ echo 'selected'; } ?> >white</option>
					</select>
				</div>
				
				<div class="row b2logos_slider_option">
					<label for="b2logos_slider_pagination">Pagination</label>
					<select id="b2logos_slider_pagination" name="b2logos_slider_pagination">
						<option value="enabled" <?php if($slider_pagination == 'enabled'){ echo 'selected'; } ?> >enabled</option>
						<option value="disabled" <?php if($slider_pagination == 'disabled'){ echo 'selected'; } ?> >disabled</option>
					</select>
				</div>
				
				<div class="row b2logos_slider_option b2logos_slider_pagination_option">
					<label for="b2logos_slider_pagination_color">Pagination Buttons Color</label>
					<input type="text" id="b2logos_slider_pagination_color" name="b2logos_slider_pagination_color" value="<?php echo $slider_pagination_color; ?>" />
					<div id="b2logos_slider_pagination_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_slider_pagination_color_btn" name="b2logos_slider_pagination_color_btn" value="View Color" class="button-primary" />
				</div>
				
			</div>
			
			
			
			
			
			
			
			
			<div class="b2logos_details_area_option b2logos_list_option b2logos_sectionTitle">Font Style</div>
			
			<div class="b2logos_details_area_option b2logos_list_option b2logos_rowsContainer" >
				<div class="row b2logos_details_area_option b2logos_list_option">
					<label for="b2logos_font_style">Font Style</label>
					<select id="b2logos_font_style" name="b2logos_font_style">
						<option value="custom" <?php if($fontstyle == "custom"){ echo 'selected'; } ?> >custom style</option>
						<option value="default" <?php if($fontstyle == "default"){ echo 'selected'; } ?> >current theme style</option>
					</select>
				</div>
				
				<div class="row b2logos_details_area_option b2logos_list_option b2logos_font_option">
					<label for="b2logos_title_font_family">Title Font Family</label>
					<select id="b2logos_title_font_family" name="b2logos_title_font_family">
						<option value="" <?php if($titlefontfamily == ""){ echo 'selected'; } ?> >current theme font</option>
						<option value="Georgia, serif" <?php if($titlefontfamily == "Georgia, serif"){ echo 'selected'; } ?> >Georgia</option>
						<option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif" <?php if($titlefontfamily == "'Palatino Linotype', 'Book Antiqua', Palatino, serif"){ echo 'selected'; } ?> >Palatino Linotype</option>
						<option value="'Times New Roman', Times, serif" <?php if($titlefontfamily == "'Times New Roman', Times, serif"){ echo 'selected'; } ?> >Times New Roman</option>
						<option value="Arial, Helvetica, sans-serif" <?php if($titlefontfamily == "Arial, Helvetica, sans-serif"){ echo 'selected'; } ?> >Arial</option>
						<option value="'Arial Black', Gadget, sans-serif" <?php if($titlefontfamily == "'Arial Black', Gadget, sans-serif"){ echo 'selected'; } ?> >Arial Black</option>
						<option value="'Comic Sans MS', cursive, sans-serif" <?php if($titlefontfamily == "'Comic Sans MS', cursive, sans-serif"){ echo 'selected'; } ?> >Comic Sans MS</option>
						<option value="Impact, Charcoal, sans-serif" <?php if($titlefontfamily == "Impact, Charcoal, sans-serif"){ echo 'selected'; } ?> >Impact</option>
						<option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif" <?php if($titlefontfamily == "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"){ echo 'selected'; } ?> >Lucida Sans Unicode</option>
						<option value="Tahoma, Geneva, sans-serif" <?php if($titlefontfamily == "Tahoma, Geneva, sans-serif"){ echo 'selected'; } ?> >Tahoma</option>
						<option value="'Trebuchet MS', Helvetica, sans-serif" <?php if($titlefontfamily == "'Trebuchet MS', Helvetica, sans-serif"){ echo 'selected'; } ?> >Trebuchet MS</option>
						<option value="Verdana, Geneva, sans-serif" <?php if($titlefontfamily == "Verdana, Geneva, sans-serif"){ echo 'selected'; } ?> >Verdana</option>
						<option value="'Courier New', Courier, monospace" <?php if($titlefontfamily == "'Courier New', Courier, monospace"){ echo 'selected'; } ?> >Courier New</option>
						<option value="'Lucida Console', Monaco, monospace" <?php if($titlefontfamily == "'Lucida Console', Monaco, monospace"){ echo 'selected'; } ?> >Lucida Console</option>
					</select>
				</div>
				
				<div class="row b2logos_details_area_option b2logos_list_option b2logos_font_option">
					<label for="b2logos_title_font_color">Title Font Color</label>
					<input type="text" id="b2logos_title_font_color" name="b2logos_title_font_color" value="<?php echo $titlefontcolor; ?>" placeholder="<?php echo $titlefontcolor; ?>" />
					<div id="b2logos_title_font_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_title_font_color_btn" name="b2logos_title_font_color_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_details_area_option b2logos_list_option b2logos_font_option">
					<label for="b2logos_title_font_size">Title Font Size</label>
					<select id="b2logos_title_font_size" name="b2logos_title_font_size">
						<option value="9px" <?php if($titlefontsize == '9px'){ echo 'selected'; } ?> >9px</option>
						<option value="10px" <?php if($titlefontsize == '10px'){ echo 'selected'; } ?> >10px</option>
						<option value="11px" <?php if($titlefontsize == '11px'){ echo 'selected'; } ?> >11px</option>
						<option value="12px" <?php if($titlefontsize == '12px'){ echo 'selected'; } ?> >12px</option>
						<option value="13px" <?php if($titlefontsize == '13px'){ echo 'selected'; } ?> >13px</option>
						<option value="14px" <?php if($titlefontsize == '14px'){ echo 'selected'; } ?> >14px</option>
						<option value="15px" <?php if($titlefontsize == '15px'){ echo 'selected'; } ?> >15px</option>
						<option value="16px" <?php if($titlefontsize == '16px'){ echo 'selected'; } ?> >16px</option>
						<option value="17px" <?php if($titlefontsize == '17px'){ echo 'selected'; } ?> >17px</option>
						<option value="18px" <?php if($titlefontsize == '18px'){ echo 'selected'; } ?> >18px</option>
						<option value="19px" <?php if($titlefontsize == '19px'){ echo 'selected'; } ?> >19px</option>
						<option value="20px" <?php if($titlefontsize == '20px'){ echo 'selected'; } ?> >20px</option>
						<option value="21px" <?php if($titlefontsize == '21px'){ echo 'selected'; } ?> >21px</option>
						<option value="22px" <?php if($titlefontsize == '22px'){ echo 'selected'; } ?> >22px</option>
						<option value="23px" <?php if($titlefontsize == '23px'){ echo 'selected'; } ?> >23px</option>
						<option value="24px" <?php if($titlefontsize == '24px'){ echo 'selected'; } ?> >24px</option>
						<option value="25px" <?php if($titlefontsize == '25px'){ echo 'selected'; } ?> >25px</option>
						<option value="26px" <?php if($titlefontsize == '26px'){ echo 'selected'; } ?> >26px</option>
						<option value="27px" <?php if($titlefontsize == '27px'){ echo 'selected'; } ?> >27px</option>
						<option value="28px" <?php if($titlefontsize == '28px'){ echo 'selected'; } ?> >28px</option>
						<option value="29px" <?php if($titlefontsize == '29px'){ echo 'selected'; } ?> >29px</option>
						<option value="30px" <?php if($titlefontsize == '30px'){ echo 'selected'; } ?> >30px</option>
						<option value="31px" <?php if($titlefontsize == '31px'){ echo 'selected'; } ?> >31px</option>
						<option value="32px" <?php if($titlefontsize == '32px'){ echo 'selected'; } ?> >32px</option>
						<option value="33px" <?php if($titlefontsize == '33px'){ echo 'selected'; } ?> >33px</option>
						<option value="34px" <?php if($titlefontsize == '34px'){ echo 'selected'; } ?> >34px</option>
						<option value="35px" <?php if($titlefontsize == '35px'){ echo 'selected'; } ?> >35px</option>
						<option value="36px" <?php if($titlefontsize == '36px'){ echo 'selected'; } ?> >36px</option>
					</select>
					
				</div>
				
				<div class="row b2logos_details_area_option b2logos_list_option b2logos_font_option">
					<label for="b2logos_title_font_weight">Title Font Weight</label>
					<select id="b2logos_title_font_weight" name="b2logos_title_font_weight">
						<option value="bold" <?php if($titlefontweight == 'bold'){ echo 'selected'; } ?> >bold</option>
						<option value="normal" <?php if($titlefontweight == 'normal'){ echo 'selected'; } ?> >normal</option>
					</select>
				</div>
				
				<div class="row b2logos_details_area_option b2logos_list_option b2logos_font_option">
					<label for="b2logos_text_font_family">Text Font Family</label>
					<select id="b2logos_text_font_family" name="b2logos_text_font_family">
						<option value="" <?php if($textfontfamily == ""){ echo 'selected'; } ?> >current theme font</option>
						<option value="Georgia, serif" <?php if($textfontfamily == "Georgia, serif"){ echo 'selected'; } ?> >Georgia</option>
						<option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif" <?php if($textfontfamily == "'Palatino Linotype', 'Book Antiqua', Palatino, serif"){ echo 'selected'; } ?> >Palatino Linotype</option>
						<option value="'Times New Roman', Times, serif" <?php if($textfontfamily == "'Times New Roman', Times, serif"){ echo 'selected'; } ?> >Times New Roman</option>
						<option value="Arial, Helvetica, sans-serif" <?php if($textfontfamily == "Arial, Helvetica, sans-serif"){ echo 'selected'; } ?> >Arial</option>
						<option value="'Arial Black', Gadget, sans-serif" <?php if($textfontfamily == "'Arial Black', Gadget, sans-serif"){ echo 'selected'; } ?> >Arial Black</option>
						<option value="'Comic Sans MS', cursive, sans-serif" <?php if($textfontfamily == "'Comic Sans MS', cursive, sans-serif"){ echo 'selected'; } ?> >Comic Sans MS</option>
						<option value="Impact, Charcoal, sans-serif" <?php if($textfontfamily == "Impact, Charcoal, sans-serif"){ echo 'selected'; } ?> >Impact</option>
						<option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif" <?php if($textfontfamily == "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"){ echo 'selected'; } ?> >Lucida Sans Unicode</option>
						<option value="Tahoma, Geneva, sans-serif" <?php if($textfontfamily == "Tahoma, Geneva, sans-serif"){ echo 'selected'; } ?> >Tahoma</option>
						<option value="'Trebuchet MS', Helvetica, sans-serif" <?php if($textfontfamily == "'Trebuchet MS', Helvetica, sans-serif"){ echo 'selected'; } ?> >Trebuchet MS</option>
						<option value="Verdana, Geneva, sans-serif" <?php if($textfontfamily == "Verdana, Geneva, sans-serif"){ echo 'selected'; } ?> >Verdana</option>
						<option value="'Courier New', Courier, monospace" <?php if($textfontfamily == "'Courier New', Courier, monospace"){ echo 'selected'; } ?> >Courier New</option>
						<option value="'Lucida Console', Monaco, monospace" <?php if($textfontfamily == "'Lucida Console', Monaco, monospace"){ echo 'selected'; } ?> >Lucida Console</option>
					</select>
				</div>
				
				<div class="row b2logos_details_area_option b2logos_list_option b2logos_font_option">
					<label for="b2logos_text_font_color">Text Font Color</label>
					<input type="text" id="b2logos_text_font_color" name="b2logos_text_font_color" value="<?php echo $textfontcolor; ?>" placeholder="<?php echo $textfontcolor; ?>" />
					<div id="b2logos_text_font_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_text_font_color_btn" name="b2logos_text_font_color_btn" value="View Color" class="button-primary" />
				</div>
				
				<div class="row b2logos_details_area_option b2logos_list_option b2logos_font_option">
					<label for="b2logos_text_font_size">Text Font Size</label>
					<select id="b2logos_text_font_size" name="b2logos_text_font_size">
						<option value="9px" <?php if($textfontsize == '9px'){ echo 'selected'; } ?> >9px</option>
						<option value="10px" <?php if($textfontsize == '10px'){ echo 'selected'; } ?> >10px</option>
						<option value="11px" <?php if($textfontsize == '11px'){ echo 'selected'; } ?> >11px</option>
						<option value="12px" <?php if($textfontsize == '12px'){ echo 'selected'; } ?> >12px</option>
						<option value="13px" <?php if($textfontsize == '13px'){ echo 'selected'; } ?> >13px</option>
						<option value="14px" <?php if($textfontsize == '14px'){ echo 'selected'; } ?> >14px</option>
						<option value="15px" <?php if($textfontsize == '15px'){ echo 'selected'; } ?> >15px</option>
						<option value="16px" <?php if($textfontsize == '16px'){ echo 'selected'; } ?> >16px</option>
						<option value="17px" <?php if($textfontsize == '17px'){ echo 'selected'; } ?> >17px</option>
						<option value="18px" <?php if($textfontsize == '18px'){ echo 'selected'; } ?> >18px</option>
						<option value="19px" <?php if($textfontsize == '19px'){ echo 'selected'; } ?> >19px</option>
						<option value="20px" <?php if($textfontsize == '20px'){ echo 'selected'; } ?> >20px</option>
						<option value="21px" <?php if($textfontsize == '21px'){ echo 'selected'; } ?> >21px</option>
						<option value="22px" <?php if($textfontsize == '22px'){ echo 'selected'; } ?> >22px</option>
						<option value="23px" <?php if($textfontsize == '23px'){ echo 'selected'; } ?> >23px</option>
						<option value="24px" <?php if($textfontsize == '24px'){ echo 'selected'; } ?> >24px</option>
						<option value="25px" <?php if($textfontsize == '25px'){ echo 'selected'; } ?> >25px</option>
						<option value="26px" <?php if($textfontsize == '26px'){ echo 'selected'; } ?> >26px</option>
						<option value="27px" <?php if($textfontsize == '27px'){ echo 'selected'; } ?> >27px</option>
						<option value="28px" <?php if($textfontsize == '28px'){ echo 'selected'; } ?> >28px</option>
						<option value="29px" <?php if($textfontsize == '29px'){ echo 'selected'; } ?> >29px</option>
						<option value="30px" <?php if($textfontsize == '30px'){ echo 'selected'; } ?> >30px</option>
						<option value="31px" <?php if($textfontsize == '31px'){ echo 'selected'; } ?> >31px</option>
						<option value="32px" <?php if($textfontsize == '32px'){ echo 'selected'; } ?> >32px</option>
						<option value="33px" <?php if($textfontsize == '33px'){ echo 'selected'; } ?> >33px</option>
						<option value="34px" <?php if($textfontsize == '34px'){ echo 'selected'; } ?> >34px</option>
						<option value="35px" <?php if($textfontsize == '35px'){ echo 'selected'; } ?> >35px</option>
						<option value="36px" <?php if($textfontsize == '36px'){ echo 'selected'; } ?> >36px</option>
					</select>
					
				</div>
				
				<div class="row b2logos_list_option">
					<label for="b2logos_excerptText_length">Excerpt Text Length</label>
					<input type="text" id="b2logos_excerptText_length" name="b2logos_excerptText_length" value="<?php echo $excerpttextlength; ?>" placeholder="<?php echo $excerpttextlength; ?>" />
				</div>
				
			</div>
			
			<div class="b2logos_list_option b2logos_sectionTitle">More Link</div>
			
			<div class="b2logos_list_option b2logos_rowsContainer" >
				<div class="row b2logos_list_option">
					<label for="b2logos_moreLinkText">More Link Text</label>
					<input type="text" id="b2logos_moreLinkText" name="b2logos_moreLinkText" value="<?php echo $morelinktext; ?>" />
				</div>
				
				<div class="row b2logos_list_option b2logos_font_option">
					<label for="b2logos_more_link_text_color">More Link Text Color</label>
					<input type="text" id="b2logos_more_link_text_color" name="b2logos_more_link_text_color" value="<?php echo $morelinktextcolor; ?>" placeholder="<?php echo $morelinktextcolor; ?>" />
					<div id="b2logos_more_link_text_color_colorpicker" class="b2logos_farbtastic"></div>
					<input type="button" id="b2logos_more_link_text_color_btn" name="b2logos_more_link_text_color_btn" value="View Color" class="button-primary" />
				</div>
			</div>
			
			
			
			

			
		</div>
		
		<?php
	}
	
	/*========================================================================================================================================================================
		Save b2logo_sc Options Meta Box Function
	========================================================================================================================================================================*/
	
	function b2logo_sc_save_meta_box($post_id) 
	{
		/*----------------------------------------------------------------------
			shortcode
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_shortcode'])) {
			update_post_meta($post_id, 'shortcode', $_POST['b2logos_shortcode']);
		}
		
		/*----------------------------------------------------------------------
			Category
		----------------------------------------------------------------------*/
		if(isset($_POST['tax_input']['b2logocategory'])) {
			$tax_input_count = count($_POST['tax_input']['b2logocategory']);
			$tax_input_values='';
			for($i=0;$i<$tax_input_count;$i++) {
				$tax_input_values.=$_POST['tax_input']['b2logocategory'][$i].',';
			}
			$tax_input_values = rtrim($tax_input_values,',');
			update_post_meta($post_id, 'category', $tax_input_values);
		}
		else {
			update_post_meta($post_id, 'category', '-1');
		}
		
		/*----------------------------------------------------------------------
			Number of items
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_NumberInput'])) {
			update_post_meta($post_id, 'num', $_POST['b2logos_NumberInput']);
		}
		
		/*----------------------------------------------------------------------
			Order by
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_orderByList'])) {
			update_post_meta($post_id, 'orderby', $_POST['b2logos_orderByList']);
		}
		
		/*----------------------------------------------------------------------
			Order
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_orderList'])) {
			update_post_meta($post_id, 'order', $_POST['b2logos_orderList']);
		}
		
		/*----------------------------------------------------------------------
			Layout
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_layout'])) {
			update_post_meta($post_id, 'layout', $_POST['b2logos_layout']);
		}
		
		/*----------------------------------------------------------------------
			Columns
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_columnsNumberList'])) {
			update_post_meta($post_id, 'columns', $_POST['b2logos_columnsNumberList']);
		}
		
		/*----------------------------------------------------------------------
			Items height percentage
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_itemsHeightPercentage'])) {
			update_post_meta($post_id, 'itemsheightpercentage', $_POST['b2logos_itemsHeightPercentage']);
		}
		
		/*----------------------------------------------------------------------
			Margin between items
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_marginBetweenItems'])) {
			update_post_meta($post_id, 'marginbetweenitems', $_POST['b2logos_marginBetweenItems']);
		}
		
		/*----------------------------------------------------------------------
			Tooltip
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_tooltipList'])) {
			update_post_meta($post_id, 'tooltip', $_POST['b2logos_tooltipList']);
		}
		
		/*----------------------------------------------------------------------
			Responsive
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_responsiveList'])) {
			update_post_meta($post_id, 'responsive', $_POST['b2logos_responsiveList']);
		}
		
		/*----------------------------------------------------------------------
			Border
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_border'])) {
			update_post_meta($post_id, 'border', $_POST['b2logos_border']);
		}
		
		/*----------------------------------------------------------------------
			Border color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_borderColor'])) {
			update_post_meta($post_id, 'bordercolor', $_POST['b2logos_borderColor']);
		}
		
		/*----------------------------------------------------------------------
			Border radius
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_borderRadius'])) {
			update_post_meta($post_id, 'borderradius', $_POST['b2logos_borderRadius']);
		}
		
		/*----------------------------------------------------------------------
			Background color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_bgColorInput'])) {
			update_post_meta($post_id, 'backgroundcolor', $_POST['b2logos_bgColorInput']);
		}
		
		/*----------------------------------------------------------------------
			List border
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_list_border'])) {
			update_post_meta($post_id, 'listborder', $_POST['b2logos_list_border']);
		}
		
		/*----------------------------------------------------------------------
			list border color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_listBorderColor'])) {
			update_post_meta($post_id, 'listbordercolor', $_POST['b2logos_listBorderColor']);
		}
		
		/*----------------------------------------------------------------------
			list border style
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_list_border_style'])) {
			update_post_meta($post_id, 'listborderstyle', $_POST['b2logos_list_border_style']);
		}
		
		/*----------------------------------------------------------------------
			hover effect
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_hovereffect'])) {
			update_post_meta($post_id, 'hovereffect', $_POST['b2logos_hovereffect']);
		}
		
		/*----------------------------------------------------------------------
			hover effect color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_hoverEffectColor'])) {
			update_post_meta($post_id, 'hovereffectcolor', $_POST['b2logos_hoverEffectColor']);
		}
		
		/*----------------------------------------------------------------------
			grayscale
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_grayscaleList'])) {
			update_post_meta($post_id, 'grayscale', $_POST['b2logos_grayscaleList']);
		}
		
		/*----------------------------------------------------------------------
			on click action
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_onClickAction'])) {
			update_post_meta($post_id, 'onclickaction', $_POST['b2logos_onClickAction']);
		}
		
		/*----------------------------------------------------------------------
			details area padding
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_padding'])) {
			update_post_meta($post_id, 'detailsarea_padding', $_POST['b2logos_detailsArea_padding']);
		}
		
		/*----------------------------------------------------------------------
			details area bg color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_bgColor'])) {
			update_post_meta($post_id, 'detailsarea_bgcolor', $_POST['b2logos_detailsArea_bgColor']);
		}
		
		/*----------------------------------------------------------------------
			details area close btn color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_closeBtnColor'])) {
			update_post_meta($post_id, 'detailsarea_closebtncolor', $_POST['b2logos_detailsArea_closeBtnColor']);
		}
		
		/*----------------------------------------------------------------------
			details area border
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_border'])) {
			update_post_meta($post_id, 'detailsarea_border', $_POST['b2logos_detailsArea_border']);
		}
		
		/*----------------------------------------------------------------------
			details area border color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_borderColor'])) {
			update_post_meta($post_id, 'detailsarea_bordercolor', $_POST['b2logos_detailsArea_borderColor']);
		}
		
		/*----------------------------------------------------------------------
			details area logo
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_logo'])) {
			update_post_meta($post_id, 'detailsarea_logo', $_POST['b2logos_detailsArea_logo']);
		}
		
		/*----------------------------------------------------------------------
			details area logo border
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_logoBorder'])) {
			update_post_meta($post_id, 'detailsarea_logoborder', $_POST['b2logos_detailsArea_logoBorder']);
		}
		
		/*----------------------------------------------------------------------
			details area logo border color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_logoBorderColor'])) {
			update_post_meta($post_id, 'detailsarea_logobordercolor', $_POST['b2logos_detailsArea_logoBorderColor']);
		}
		
		/*----------------------------------------------------------------------
			details area logo bg color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_detailsArea_logoBgColor'])) {
			update_post_meta($post_id, 'detailsarea_logobgcolor', $_POST['b2logos_detailsArea_logoBgColor']);
		}
		
		/*----------------------------------------------------------------------
			autoplay
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_autoplay'])) {
			update_post_meta($post_id, 'autoplay', $_POST['b2logos_autoplay']);
		}
		
		/*----------------------------------------------------------------------
			slider circular
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_slider_circular'])) {
			update_post_meta($post_id, 'slider_circular', $_POST['b2logos_slider_circular']);
		}
		
		/*----------------------------------------------------------------------
			transition effect
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_transitionEffect'])) {
			update_post_meta($post_id, 'transitioneffect', $_POST['b2logos_transitionEffect']);
		}
		
		/*----------------------------------------------------------------------
			easing function
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_easingFunction'])) {
			update_post_meta($post_id, 'easingfunction', $_POST['b2logos_easingFunction']);
		}
		
		/*----------------------------------------------------------------------
			scroll duration
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_scrollduration'])) {
			update_post_meta($post_id, 'scrollduration', $_POST['b2logos_scrollduration']);
		}
		
		/*----------------------------------------------------------------------
			pause duration
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pauseduration'])) {
			update_post_meta($post_id, 'pauseduration', $_POST['b2logos_pauseduration']);
		}
		
		/*----------------------------------------------------------------------
			buttons border color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_buttonsbordercolor'])) {
			update_post_meta($post_id, 'buttonsbordercolor', $_POST['b2logos_buttonsbordercolor']);
		}
		
		/*----------------------------------------------------------------------
			buttons bg color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_buttonsbgcolor'])) {
			update_post_meta($post_id, 'buttonsbgcolor', $_POST['b2logos_buttonsbgcolor']);
		}
		
		/*----------------------------------------------------------------------
			buttons arrows color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_buttonsarrowscolor'])) {
			update_post_meta($post_id, 'buttonsarrowscolor', $_POST['b2logos_buttonsarrowscolor']);
		}
		
		/*----------------------------------------------------------------------
			slider_pagination
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_slider_pagination'])) {
			update_post_meta($post_id, 'slider_pagination', $_POST['b2logos_slider_pagination']);
		}
		
		/*----------------------------------------------------------------------
			slider pagination color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_slider_pagination_color'])) {
			update_post_meta($post_id, 'slider_pagination_color', $_POST['b2logos_slider_pagination_color']);
		}
		
		
		/*----------------------------------------------------------------------
			font style
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_font_style'])) {
			update_post_meta($post_id, 'fontstyle', $_POST['b2logos_font_style']);
		}
		
		/*----------------------------------------------------------------------
			title font family
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_title_font_family'])) {
			update_post_meta($post_id, 'titlefontfamily', $_POST['b2logos_title_font_family']);
		}
		
		/*----------------------------------------------------------------------
			title font color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_title_font_color'])) {
			update_post_meta($post_id, 'titlefontcolor', $_POST['b2logos_title_font_color']);
		}
		
		/*----------------------------------------------------------------------
			title font size
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_title_font_size'])) {
			update_post_meta($post_id, 'titlefontsize', $_POST['b2logos_title_font_size']);
		}
		
		/*----------------------------------------------------------------------
			title font weight
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_title_font_weight'])) {
			update_post_meta($post_id, 'titlefontweight', $_POST['b2logos_title_font_weight']);
		}
		
		/*----------------------------------------------------------------------
			text font family
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_text_font_family'])) {
			update_post_meta($post_id, 'textfontfamily', $_POST['b2logos_text_font_family']);
		}
		
		/*----------------------------------------------------------------------
			text font color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_text_font_color'])) {
			update_post_meta($post_id, 'textfontcolor', $_POST['b2logos_text_font_color']);
		}
		
		/*----------------------------------------------------------------------
			text font size
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_text_font_size'])) {
			update_post_meta($post_id, 'textfontsize', $_POST['b2logos_text_font_size']);
		}
		
		/*----------------------------------------------------------------------
			excerpt text length
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_excerptText_length'])) {
			update_post_meta($post_id, 'excerpttextlength', $_POST['b2logos_excerptText_length']);
		}
		
		/*----------------------------------------------------------------------
			more link text
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_moreLinkText'])) {
			update_post_meta($post_id, 'morelinktext', $_POST['b2logos_moreLinkText']);
		}
		
		/*----------------------------------------------------------------------
			more link text color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_more_link_text_color'])) {
			update_post_meta($post_id, 'morelinktextcolor', $_POST['b2logos_more_link_text_color']);
		}
		
		/*----------------------------------------------------------------------
			pagination
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination'])) {
			update_post_meta($post_id, 'pagination', $_POST['b2logos_pagination']);
		}
		
		/*----------------------------------------------------------------------
			pagination_border_style
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_border_style'])) {
			update_post_meta($post_id, 'pagination_border_style', $_POST['b2logos_pagination_border_style']);
		}
		
		/*----------------------------------------------------------------------
			pagination_border_color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_border_color'])) {
			update_post_meta($post_id, 'pagination_border_color', $_POST['b2logos_pagination_border_color']);
		}
		
		/*----------------------------------------------------------------------
			pagination_bg_color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_bg_color'])) {
			update_post_meta($post_id, 'pagination_bg_color', $_POST['b2logos_pagination_bg_color']);
		}
		
		/*----------------------------------------------------------------------
			pagination_font_color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_font_color'])) {
			update_post_meta($post_id, 'pagination_font_color', $_POST['b2logos_pagination_font_color']);
		}
		
		/*----------------------------------------------------------------------
			pagination_font_size
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_font_size'])) {
			update_post_meta($post_id, 'pagination_font_size', $_POST['b2logos_pagination_font_size']);
		}
		
		/*----------------------------------------------------------------------
			pagination_font_family
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_font_family'])) {
			update_post_meta($post_id, 'pagination_font_family', $_POST['b2logos_pagination_font_family']);
		}
		
		/*----------------------------------------------------------------------
			pagination_current_font_color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_current_font_color'])) {
			update_post_meta($post_id, 'pagination_current_font_color', $_POST['b2logos_pagination_current_font_color']);
		}
		
		/*----------------------------------------------------------------------
			pagination_current_bg_color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_current_bg_color'])) {
			update_post_meta($post_id, 'pagination_current_bg_color', $_POST['b2logos_pagination_current_bg_color']);
		}
		
		/*----------------------------------------------------------------------
			pagination_current_border_color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_current_border_color'])) {
			update_post_meta($post_id, 'pagination_current_border_color', $_POST['b2logos_pagination_current_border_color']);
		}
		
		/*----------------------------------------------------------------------
			pagination_align
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_align'])) {
			update_post_meta($post_id, 'pagination_align', $_POST['b2logos_pagination_align']);
		}
		
		/*----------------------------------------------------------------------
			pagination_divider_style
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_divider_style'])) {
			update_post_meta($post_id, 'pagination_divider_style', $_POST['b2logos_pagination_divider_style']);
		}
		
		/*----------------------------------------------------------------------
			pagination_divider_color
		----------------------------------------------------------------------*/
		if(isset($_POST['b2logos_pagination_divider_color'])) {
			update_post_meta($post_id, 'pagination_divider_color', $_POST['b2logos_pagination_divider_color']);
		}
		
	}
	
	/*----------------------------------------------------------------------
		Save b2logo_sc Options Meta Box Action
	----------------------------------------------------------------------*/
	add_action('save_post', 'b2logo_sc_save_meta_box');

?>