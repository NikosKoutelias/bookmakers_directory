<?php

// Block direct requests
if (!defined('ABSPATH'))
	die('-1');

add_action('widgets_init', function () {
	register_widget('Bookmakers_directory');
});

/**
 * Adds My_Widget widget.
 */
class Bookmakers_directory extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'bookmakers_directory', // Base ID
			__('Bookmakers Directory'), // Name
			array(
				'classname' => '',
				'description' => __('Templates for sidebar or main content for all Bookmakers')
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{ 
				
		add_filter( 'widget_text', 'do_shortcode' );
		If ( ! empty ( $title ) ){
			echo $args['before_title'] . $title . $args['after_title'];
		}
		//add_filter( 'widget_text', 'do_shortcode' );

		$output_text = do_shortcode($instance['txt']);

		echo $output_text;


		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{

		if (isset($instance['txt'])){
			$txt = $instance['txt'];
		}else{
			$txt = "";
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'txt' ); ?>"><?php echo "Text" ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('txt'); ?>" name="<?php echo $this->get_field_name('txt'); ?>" type="text" value="<?php echo esc_attr($txt); ?>" />
		</p>

		<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance)
	{
		$instance = array();

		$instance['txt'] = ( ! empty( $new_instance['txt'] ) ) ? strip_tags( $new_instance['txt'] ) : '';

		return $instance;
	}
}
?>