<?php

	if (!headers_sent()) {
		include_once('../../../../wp-load.php');
	}
	
	if(isset($_REQUEST['logo_id'])) {
	
		$b2logos_singlepost = get_post($_REQUEST['logo_id']);
		global $imgSize;
		
		if($b2logos_singlepost->post_type == 'b2logo') {
			$thumbnailsrc = wp_get_attachment_url(get_post_meta($_REQUEST['logo_id'], '_thumbnail_id', true));
			$bgSize=get_post_meta($_REQUEST['logo_id'], 'imageSize', true);
			$bgSizeStyle='-webkit-background-size: '.$imgSize.'; -moz-background-size: '.$imgSize.'; background-size: '.$imgSize.';';

			echo json_encode( array( "thumbnailsrc" => $thumbnailsrc, "bgSize" => $bgSize, "title" => $b2logos_singlepost->post_title, "text" => apply_filters('the_content', get_post_meta($b2logos_singlepost->ID, 'description', true))  ) );
		}
		
	}
?>
