<?php
	
// B2 Logos Widget
class b2logos_widget extends WP_Widget
{
	function b2logos_widget() {
		$widget_options = array(
		'classname'		=>		'b2logos-widget',
		'description' 	=>		'B2 Logos Widget'
		);
		
		parent::__construct( false, 'B2 Logos' );
	}
	
	function widget( $args, $instance ) {
		extract ( $args, EXTR_SKIP );
		$title = ( $instance['title'] ) ? $instance['title'] : '';
		$shortcode = ( $instance['shortcode'] ) ? $instance['shortcode'] : '[b2logos]';
		echo $before_widget;
		
		if($title!='')
		{
			echo $before_title . $title . $after_title; 
		}
		
		echo do_shortcode( $shortcode );
		
		echo $after_widget;
		
	}
	
	function form( $instance ) {
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" >Title:</label> 
                <input id="<?php echo $this->get_field_id('title'); ?>"
                        class="widefat"
                        name="<?php echo $this->get_field_name('title'); ?>"
                        value="<?php if (isset($instance['title'])) { echo esc_attr( $instance['title'] ); } ?>" type="text" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('shortcode'); ?>" >Shortcode:</label>
                <input id="<?php echo $this->get_field_id('shortcode'); ?>"
                        class="widefat"
                        name="<?php echo $this->get_field_name('shortcode'); ?>"
                        value="<?php if (isset($instance['shortcode'])) { echo esc_attr( $instance['shortcode'] ); } ?>" type="text" />
            
        </p>
		
		<?php
	}
	
}
	
function b2logos_widget_init() {
	register_widget("b2logos_widget");
}
add_action('widgets_init','b2logos_widget_init');

?>