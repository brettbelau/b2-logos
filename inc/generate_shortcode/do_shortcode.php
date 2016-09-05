<?php
	if (!headers_sent()) {
		include_once('../../../../../wp-load.php');
	}
	
	$shortcode="[b2logos ";
	
	if(isset($_POST['wpml_current_lang'])) {
		$shortcode.='wpml_current_lang="'.$_POST['wpml_current_lang'].'" ';
	}
	
	if(isset($_POST['columns'])) {
		$shortcode.='columns="'.$_POST['columns'].'" ';
	}
	
	if(isset($_POST['itemsheightpercentage'])) {
		$shortcode.='itemsheightpercentage="'.$_POST['itemsheightpercentage'].'" ';
	}
	
	if(isset($_POST['backgroundcolor'])) {
		$shortcode.='backgroundcolor="'.$_POST['backgroundcolor'].'" ';
	}
	
	if(isset($_POST['layout'])) {
		$shortcode.='layout="'.$_POST['layout'].'" ';
	}
	
	if(isset($_POST['num'])) {
		$shortcode.='num="'.$_POST['num'].'" ';
	}
	
	if(isset($_POST['category'])) {
		$shortcode.='category="'.$_POST['category'].'" ';
	}
	
	if(isset($_POST['orderby'])) {
		$shortcode.='orderby="'.$_POST['orderby'].'" ';
	}
	
	if(isset($_POST['order'])) {
		$shortcode.='order="'.$_POST['order'].'" ';
	}
	
	if(isset($_POST['marginbetweenitems'])) {
		$shortcode.='marginbetweenitems="'.$_POST['marginbetweenitems'].'" ';
	}
	
	if(isset($_POST['tooltip'])) {
		$shortcode.='tooltip="'.$_POST['tooltip'].'" ';
	}
	
	if(isset($_POST['responsive'])) {
		$shortcode.='responsive="'.$_POST['responsive'].'" ';
	}
	
	if(isset($_POST['grayscale'])) {
		$shortcode.='grayscale="'.$_POST['grayscale'].'" ';
	}
	
	if(isset($_POST['border'])) {
		$shortcode.='border="'.$_POST['border'].'" ';
	}
	
	if(isset($_POST['bordercolor'])) {
		$shortcode.='bordercolor="'.$_POST['bordercolor'].'" ';
	}
	
	if(isset($_POST['borderradius'])) {
		$shortcode.='borderradius="'.$_POST['borderradius'].'" ';
	}
	
	
	
	
	
	if(isset($_POST['onclickaction'])) {
		$shortcode.='onclickaction="'.$_POST['onclickaction'].'" ';
	}
	
	if(isset($_POST['detailsarea_padding'])) {
		$shortcode.='detailsarea_padding="'.$_POST['detailsarea_padding'].'" ';
	}
	
	if(isset($_POST['detailsarea_bgcolor'])) {
		$shortcode.='detailsarea_bgcolor="'.$_POST['detailsarea_bgcolor'].'" ';
	}
	
	if(isset($_POST['detailsarea_closebtncolor'])) {
		$shortcode.='detailsarea_closebtncolor="'.$_POST['detailsarea_closebtncolor'].'" ';
	}
	
	if(isset($_POST['detailsarea_border'])) {
		$shortcode.='detailsarea_border="'.$_POST['detailsarea_border'].'" ';
	}
	
	if(isset($_POST['detailsarea_bordercolor'])) {
		$shortcode.='detailsarea_bordercolor="'.$_POST['detailsarea_bordercolor'].'" ';
	}
	
	if(isset($_POST['detailsarea_logo'])) {
		$shortcode.='detailsarea_logo="'.$_POST['detailsarea_logo'].'" ';
	}
	
	if(isset($_POST['detailsarea_logoborder'])) {
		$shortcode.='detailsarea_logoborder="'.$_POST['detailsarea_logoborder'].'" ';
	}
	
	if(isset($_POST['detailsarea_logobordercolor'])) {
		$shortcode.='detailsarea_logobordercolor="'.$_POST['detailsarea_logobordercolor'].'" ';
	}
	
	if(isset($_POST['detailsarea_logobgcolor'])) {
		$shortcode.='detailsarea_logobgcolor="'.$_POST['detailsarea_logobgcolor'].'" ';
	}
	
	
	
	
	
	
	
	if(isset($_POST['autoplay'])) {
		$shortcode.='autoplay="'.$_POST['autoplay'].'" ';
	}
	
	if(isset($_POST['slider_circular'])) {
		$shortcode.='slider_circular="'.$_POST['slider_circular'].'" ';
	}
	
	if(isset($_POST['transitioneffect'])) {
		$shortcode.='transitioneffect="'.$_POST['transitioneffect'].'" ';
	}
	
	if(isset($_POST['easingfunction'])) {
		$shortcode.='easingfunction="'.$_POST['easingfunction'].'" ';
	}
	
	if(isset($_POST['scrollduration'])) {
		$shortcode.='scrollduration="'.$_POST['scrollduration'].'" ';
	}
	
	if(isset($_POST['pauseduration'])) {
		$shortcode.='pauseduration="'.$_POST['pauseduration'].'" ';
	}
	
	if(isset($_POST['buttonsbordercolor'])) {
		$shortcode.='buttonsbordercolor="'.$_POST['buttonsbordercolor'].'" ';
	}
	
	if(isset($_POST['buttonsbgcolor'])) {
		$shortcode.='buttonsbgcolor="'.$_POST['buttonsbgcolor'].'" ';
	}
	
	if(isset($_POST['buttonsarrowscolor'])) {
		$shortcode.='buttonsarrowscolor="'.$_POST['buttonsarrowscolor'].'" ';
	}
	
	if(isset($_POST['slider_pagination'])) {
		$shortcode.='slider_pagination="'.$_POST['slider_pagination'].'" ';
	}
	
	if(isset($_POST['slider_pagination_color'])) {
		$shortcode.='slider_pagination_color="'.$_POST['slider_pagination_color'].'" ';
	}
	
	if(isset($_POST['hovereffect'])) {
		$shortcode.='hovereffect="'.$_POST['hovereffect'].'" ';
	}
	
	if(isset($_POST['hovereffectcolor'])) {
		$shortcode.='hovereffectcolor="'.$_POST['hovereffectcolor'].'" ';
	}
	
	
	
	
	if(isset($_POST['titlefontfamily'])) {
		$shortcode.='titlefontfamily="'.$_POST['titlefontfamily'].'" ';
	}
	
	if(isset($_POST['titlefontcolor'])) {
		$shortcode.='titlefontcolor="'.$_POST['titlefontcolor'].'" ';
	}
	
	if(isset($_POST['titlefontsize'])) {
		$shortcode.='titlefontsize="'.$_POST['titlefontsize'].'" ';
	}
	
	if(isset($_POST['titlefontweight'])) {
		$shortcode.='titlefontweight="'.$_POST['titlefontweight'].'" ';
	}
	
	if(isset($_POST['textfontfamily'])) {
		$shortcode.='textfontfamily="'.$_POST['textfontfamily'].'" ';
	}
	
	if(isset($_POST['textfontcolor'])) {
		$shortcode.='textfontcolor="'.$_POST['textfontcolor'].'" ';
	}
	
	if(isset($_POST['textfontsize'])) {
		$shortcode.='textfontsize="'.$_POST['textfontsize'].'" ';
	}
	
	if(isset($_POST['excerpttextlength'])) {
		$shortcode.='excerpttextlength="'.$_POST['excerpttextlength'].'" ';
	}
	
	if(isset($_POST['listborder'])) {
		$shortcode.='listborder="'.$_POST['listborder'].'" ';
	}
	
	if(isset($_POST['listbordercolor'])) {
		$shortcode.='listbordercolor="'.$_POST['listbordercolor'].'" ';
	}
	
	if(isset($_POST['listborderstyle'])) {
		$shortcode.='listborderstyle="'.$_POST['listborderstyle'].'" ';
	}
	
	if(isset($_POST['morelinktext'])) {
		$shortcode.='morelinktext="'.$_POST['morelinktext'].'" ';
	}
	
	if(isset($_POST['morelinktextcolor'])) {
		$shortcode.='morelinktextcolor="'.$_POST['morelinktextcolor'].'" ';
	}
	
	if(isset($_POST['pagination'])) {
		$shortcode.='pagination="'.$_POST['pagination'].'" ';
	}
	
	if(isset($_POST['pagination_border_style'])) {
		$shortcode.='pagination_border_style="'.$_POST['pagination_border_style'].'" ';
	}
	
	if(isset($_POST['pagination_border_color'])) {
		$shortcode.='pagination_border_color="'.$_POST['pagination_border_color'].'" ';
	}
	
	if(isset($_POST['pagination_bg_color'])) {
		$shortcode.='pagination_bg_color="'.$_POST['pagination_bg_color'].'" ';
	}
	
	if(isset($_POST['pagination_font_color'])) {
		$shortcode.='pagination_font_color="'.$_POST['pagination_font_color'].'" ';
	}
	
	if(isset($_POST['pagination_font_size'])) {
		$shortcode.='pagination_font_size="'.$_POST['pagination_font_size'].'" ';
	}
	
	if(isset($_POST['pagination_font_family'])) {
		$shortcode.='pagination_font_family="'.$_POST['pagination_font_family'].'" ';
	}
	
	if(isset($_POST['pagination_current_font_color'])) {
		$shortcode.='pagination_current_font_color="'.$_POST['pagination_current_font_color'].'" ';
	}
	
	if(isset($_POST['pagination_current_bg_color'])) {
		$shortcode.='pagination_current_bg_color="'.$_POST['pagination_current_bg_color'].'" ';
	}
	
	if(isset($_POST['pagination_current_border_color'])) {
		$shortcode.='pagination_current_border_color="'.$_POST['pagination_current_border_color'].'" ';
	}
	
	if(isset($_POST['pagination_align'])) {
		$shortcode.='pagination_align="'.$_POST['pagination_align'].'" ';
	}
	
	if(isset($_POST['pagination_divider_style'])) {
		$shortcode.='pagination_divider_style="'.$_POST['pagination_divider_style'].'" ';
	}
	
	if(isset($_POST['pagination_divider_color'])) {
		$shortcode.='pagination_divider_color="'.$_POST['pagination_divider_color'].'" ';
	}
	
	
	
	$shortcode.="]";
	
	echo do_shortcode( $shortcode );
	
?>