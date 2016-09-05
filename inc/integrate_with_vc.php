<?php


	if ( defined( 'WPB_VC_VERSION' ) ) {
		add_action( 'vc_before_init', 'b2logos_integrateWithVC' );	
	}
	
	function b2logos_integrateWithVC() {
		
		$args =	array ( 'post_type' => 'b2logo_sc',
						'posts_per_page' => -1,
						'orderby' => 'post_title',
						'suppress_filters' => 0);
						
		$saved_sc = get_posts( $args );
		$saved_sc_array = array();
		
		foreach ( $saved_sc as $post ) {
		   $saved_sc_array[$post->post_title] = $post->ID;
		}
	   
	    vc_map( array(
		    "name" => "B2 Logos",
		    "base" => "b2logos_saved",
		    "category" => "Content",
		    "description" => "Place Logos",
			"icon" => plugins_url('../images/composer-icon.png', __FILE__),
		    "params" => array(
			    array(
				    "type" => "dropdown",
				    "heading" => "Saved Shortcode",
				    "param_name" => "id",
				    "value" => $saved_sc_array,
					"admin_label" => true,
				    "description" => "Please select the saved shortcode name from the dropdown list."
			    )
		    )
			
	    ) );
	   
	}
	
?>