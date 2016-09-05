<?php

	/*========================================================================================================================================================================
		Register B2 Logos Post Type
	========================================================================================================================================================================*/
	
	add_action('init', 'b2logos_init');
	function b2logos_init() 
	{
		/*----------------------------------------------------------------------
			B2 Logos Post Type Labels
		----------------------------------------------------------------------*/
		
		$labels = array(
			'name' => _x('Logos', 'Post type general name'),
			'singular_name' => _x('Logos', 'Post type singular name'),
			'add_new' => _x('Add New Logo', 'Logo Item'),
			'add_new_item' => __('Add a New Logo'),
			'edit_item' => __('Edit Logo'),
			'new_item' => __('New Logo'),
			'all_items' => __('All Logos'),
			'view_item' => __('View'),
			'search_items' => __('Search'),
			'not_found' =>  __('No Logos Found'),
			'not_found_in_trash' => __('No Logos Found'), 
			'parent_item_colon' => '',
			'menu_name' => 'B2 Logos'
		);
		
		/*----------------------------------------------------------------------
			B2 Logos Post Type Properties
		----------------------------------------------------------------------*/
		
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail', 'page-attributes')
		);
		
		
		/*----------------------------------------------------------------------
			B2 Logos Post Type Categories Register
		----------------------------------------------------------------------*/
		
		register_taxonomy(
			'b2logocategory',
			array('b2logo'),
			array(
				'hierarchical' => true,
				'labels' => array( 'name'=>'Categories', 'add_new_item' => 'Add New Logo Category', 'parent_item' => 'Parent Category'),
				'query_var' => true,
				'rewrite' => array( 'slug' => 'b2logocategory' )
			)
		);
		
		/*----------------------------------------------------------------------
			Register B2 Logos Post Type Function
		----------------------------------------------------------------------*/
		
		register_post_type('b2logo',$args);
		
		//Enabling Support for Post Thumbnails
		add_theme_support( 'post-thumbnails');
	}
	
	
	/*========================================================================================================================================================================
		B2 Logos Post Type All Themes Table Columns
	========================================================================================================================================================================*/
	
	/*----------------------------------------------------------------------
		B2 Logos Declaration Function
	----------------------------------------------------------------------*/
	function b2logos_columns($b2logos_columns){
		
		$order='asc';
		
		if($_GET['order']=='asc') {
			$order='desc';
		}
		
		$b2logos_columns = array(

			"cb" => "<input type=\"checkbox\" />",
		
			"thumbnail" => "Image",
			
			"order" => "<a href='?post_type=b2logo&orderby=menu_order&order=".$order."'>
								<span>Order</span>
								<span class='sorting-indicator'></span>
							</a>",

			"title" => "Title",
			
			"b2logoscategories" => "Categories",

			"author" => "Author",
			
			"date" => "Date",

		);

		return $b2logos_columns;

	}
	
	/*----------------------------------------------------------------------
		B2 Logos Value Function
	----------------------------------------------------------------------*/
	function b2logos_columns_display($b2logos_columns, $post_id){
		
		global $post;
		
		$width = (int) 200;
		$height = (int) 200;
		
		if ( 'thumbnail' == $b2logos_columns ) {
			
			if ( has_post_thumbnail($post_id)) {
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				echo $thumb;
			}
			else 
			{
				echo __('None');
			}

		}
		
		if ( 'order' == $b2logos_columns ) {
			echo $post->menu_order;
		}
		
		if ( 'b2logoscategories' == $b2logos_columns ) {
			
			$terms = get_the_terms( $post_id , 'b2logocategory');
			$count = count($terms);
			
			if ( $terms ){
				
				$i = 0;
				
				foreach ( $terms as $term ) {
					echo '<a href="'.admin_url( 'edit.php?post_type=b2logo&b2logocategory='.$term->slug ).'">'.$term->name.'</a>';	
					
					if($i+1 != $count) {
						echo " , ";
					}
					$i++;
				}
				
			}
		}
		
	}
	
	/*----------------------------------------------------------------------
		Add manage_b2logo_posts_columns Filter 
	----------------------------------------------------------------------*/
	add_filter("manage_b2logo_posts_columns", "b2logos_columns");
	
	/*----------------------------------------------------------------------
		Add manage_b2logo_posts_custom_column Action
	----------------------------------------------------------------------*/
	add_action("manage_b2logo_posts_custom_column",  "b2logos_columns_display", 10, 2 );
	
	/*========================================================================================================================================================================
		Add Meta Box For B2 Logos Post Type
	========================================================================================================================================================================*/
	
	/*----------------------------------------------------------------------
		add_meta_boxes Action For B2 Logos Post Type
	----------------------------------------------------------------------*/
	
	add_action( 'add_meta_boxes', 'b2logos_add_custom_box' );
	
	/*----------------------------------------------------------------------
		Properties Of B2 Logos Options Meta Box 
	----------------------------------------------------------------------*/
	
	function b2logos_add_custom_box() {
		add_meta_box( 
			'b2logos_sectionid',
			__( 'Options', 'b2logos_textdomain' ),
			'b2logos_inner_custom_box',
			'b2logo'
		);
	}
	
	/*----------------------------------------------------------------------
		Content Of B2 Logos Options Meta Box 
	----------------------------------------------------------------------*/
	
	function b2logos_inner_custom_box( $post ) {

		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'b2logos_noncename' );
		
		?>
		
		<!-- Description -->
							
		<p><label for="description_text_input"><strong>Logo Description</strong></label></p>
		
		<?php wp_editor( get_post_meta($post->ID, 'description', true), 'description_text_input') ?>
		
		<hr class="horizontalRuler"/>
		
		
		<!-- Website URL -->
							
		<p><label for="link_input"><strong>Website URL</strong></label></p>
		
		http:// <input type="text" name="link_input" id="link_input" class="regular-text code" value="<?php echo get_post_meta($post->ID, 'link', true); ?>" />
							
		<p><span class="description">Example: www.domain.com</span></p>
		
		<hr class="horizontalRuler"/>
		
		
		<p><label for="link_target_list"><strong>URL Target</strong></label></p>
			
		<select id="link_target_list" name="link_target_list">
			<option value="_blank" <?php if(get_post_meta($post->ID, 'link_target', true)=='_blank') { echo 'selected'; } ?> >Open in a new browser tab/window</option>
			<option value="_self" <?php if(get_post_meta($post->ID, 'link_target', true)=='_self') { echo 'selected'; } ?> >Open in the same browser tab/window</option>
        </select>
		
		<hr class="horizontalRuler"/>
		
		<!-- Logo Image Display Size -->
		
		<p><label for="imageSize_list"><strong>Logo Image Render Size</strong></label></p>
			
		<select id="imageSize_list" name="imageSize_list">
			<option value="99%">99%</option>
			<?php 
			
			for($i=95 ; $i>=10 ; $i-=5) { 
				echo '<option ';
				
				if(get_post_meta($post->ID, 'imageSize', true) == '' && $i == 99)
				{
					echo 'selected ';
				}
				else if( get_post_meta($post->ID, 'imageSize', true) == $i.'%' )
				{
					echo 'selected ';
				}
				
				echo 'value="'.$i.'%">'.$i.'%</option>';
			} ?>
			
        </select>
		
		
		
		
		<?php
	}
	
	/*========================================================================================================================================================================
		Save B2 Logos Options Meta Box Function
	========================================================================================================================================================================*/
	
	function b2logos_save_meta_box($post_id) 
	{
		
		/*----------------------------------------------------------------------
			Description
		----------------------------------------------------------------------*/
		if(isset($_POST['description_text_input'])) {
			update_post_meta($post_id, 'description', $_POST['description_text_input']);
		}
		
		
		/*----------------------------------------------------------------------
			Link
		----------------------------------------------------------------------*/
		if(isset($_POST['link_input'])) {
			update_post_meta($post_id, 'link', $_POST['link_input']);
		}
		
		/*----------------------------------------------------------------------
			link target
		----------------------------------------------------------------------*/
		if(isset($_POST['link_target_list'])) {
			update_post_meta($post_id, 'link_target', $_POST['link_target_list']);
		}
		
		/*----------------------------------------------------------------------
			Image Size
		----------------------------------------------------------------------*/
		if(isset($_POST['imageSize_list'])) {
			update_post_meta($post_id, 'imageSize', $_POST['imageSize_list']);
		}
		
	}
	
	/*----------------------------------------------------------------------
		Save B2 Logos Options Meta Box Action
	----------------------------------------------------------------------*/
	add_action('save_post', 'b2logos_save_meta_box');

?>