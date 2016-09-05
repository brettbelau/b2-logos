<?php
	/*
	Plugin Name: B2 Logos
	Plugin URI: http://b2webstudios.com
	Description: Logo Carousel Plugin by B2 Web Studios
	Version: 1.0.5
	Author: Brett Belau, B2 Web Studios
	*/
	
	
	/*==========================================================================
		enqueue
	==========================================================================*/
	
	function b2logos_theme_enqueue() {
	
		wp_register_style( 'b2logos-style', plugins_url('css/logos.css', __FILE__) );
		wp_enqueue_style( 'b2logos-style' );
		
		wp_enqueue_script('jquery');
		
		wp_register_script( 'bth_touchSwipe', plugins_url('js/helper-plugins/jquery.touchSwipe.min.js', __FILE__), null, null, true );
		wp_enqueue_script( 'bth_touchSwipe' );
		
		wp_register_script( 'bth_carouFredSel', plugins_url('js/jquery.carouFredSel-6.2.1.js', __FILE__), null, null, true );
		wp_enqueue_script( 'bth_carouFredSel' );
		
		wp_register_script( 'b2logos_script', plugins_url('js/logos.js', __FILE__), null, null, true );
		wp_enqueue_script( 'b2logos_script' );
		
	}
	
	add_action( 'wp_enqueue_scripts', 'b2logos_theme_enqueue' );
	
	function b2logos_admin_enqueue($hook) {
		
		global $post;
		
		if ( isset($post) && $post->post_type == 'b2logo_sc' && ($hook == 'post-new.php' || $hook == 'post.php') ) {
			
			wp_register_style( 'b2logos-style', plugins_url('css/logos.css', __FILE__) );
			wp_enqueue_style( 'b2logos-style' );
				
			wp_register_style( 'b2logos-admin-style', plugins_url('css/admin.css', __FILE__) );
			wp_enqueue_style( 'b2logos-admin-style' );
				
			wp_register_script( 'bth_touchSwipe', plugins_url('js/helper-plugins/jquery.touchSwipe.min.js', __FILE__), null, null, true );
			wp_enqueue_script( 'bth_touchSwipe' );
				
			wp_register_script( 'bth_carouFredSel', plugins_url('js/jquery.carouFredSel-6.2.1.js', __FILE__), null, null, true );
			wp_enqueue_script( 'bth_carouFredSel' );
				
			wp_register_script( 'b2logos-generate-shortcode', plugins_url('js/generate_shortcode.js', __FILE__), null, null, true );
			wp_enqueue_script( 'b2logos-generate-shortcode' );
				
			wp_register_script( 'b2logos_script', plugins_url('js/logos.js', __FILE__), null, null, true );
			wp_enqueue_script( 'b2logos_script' );
				
			global $wp_version;
				
			//If the WordPress version is greater than or equal to 3.5, then load the new WordPress color picker.
			if ($wp_version >= 3.5){
				//Both the necessary css and javascript have been registered already by WordPress, so all we have to do is load them with their handle.
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );

			}
			//If the WordPress version is less than 3.5 load the older farbtasic color picker.
			else {
				//As with wp-color-picker the necessary css and javascript have been registered already by WordPress, so all we have to do is load them with their handle.
				wp_enqueue_style( 'farbtastic' );
				wp_enqueue_script( 'farbtastic' );
			}
				
			
			
		}
		
	}
	
	add_action( 'admin_enqueue_scripts', 'b2logos_admin_enqueue' );

	
	
	/*==========================================================================
		Register B2 Logos Post Type
	============================================================================*/
	
	include('inc/b2logo_custom_post.php');
	
	
	/*==========================================================================
		Shortcode
	============================================================================*/
	
	include('inc/shortcodes.php');
	
	
	/*==========================================================================
		Register B2 Logos Shortcode Post Type
	============================================================================*/
	
	include('inc/generate_shortcode/generate_shortcode.php');
	
	
	/*==========================================================================
		Admin Menu
	============================================================================*/
	
	add_action('admin_menu', 'register_b2logo_custom_submenu_page');

	function register_b2logo_custom_submenu_page() {
		
		// Generate Shortcode Page
		add_submenu_page( 'edit.php?post_type=b2logo', 'Generate Shortcode', 'Generate Shortcode', 'manage_options', 'post-new.php?post_type=b2logo_sc' );
		
		// Saved Shortcodes Page
		add_submenu_page( 'edit.php?post_type=b2logo', 'Saved Shortcodes', 'Saved Shortcodes', 'manage_options', 'edit.php?post_type=b2logo_sc' );
		
		// Restore old data
		$args =	array ( 'post_type' => 'myclients', 'posts_per_page' => -1, 'post_status' => 'any');
		$clients_query = new WP_Query( $args );
		
		if($clients_query->post_count > 0 && get_option('b2logos_data_restored')=='') {
			add_submenu_page( 'edit.php?post_type=b2logo', 'Restore Old Data', 'Restore Old Data', 'manage_options', 'b2logos_restore_old_data', 'b2logos_restore_old_data_callback' );
		}
		
	}
	
	
	// Restore old data
	function b2logos_restore_old_data_callback() {
		
		include('inc/restore_old_data.php');

	}
	
	
	/*==========================================================================
		Shortcode Widget
	============================================================================*/
	
	include('inc/widget.php');
	
	/*==========================================================================
		Integrate With Visual Composer
	============================================================================*/
	
	include('inc/integrate_with_vc.php');
	
	


?>