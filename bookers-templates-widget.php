<?php

// Block direct requests
if (!defined('ABSPATH'))
	die('-1');

add_action('widgets_init', function () {
	register_widget('bookers_templates');
});

/**
 * Adds My_Widget widget.
 */
class bookers_templates extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'top_bookers', // Base ID
			__('Top Bookers'), // Name
			array(
				'classname' => '',
				'description' => __('Top Bookers')
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
		add_filter( 'widget_text', 'do_shortcode' );

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

		if (isset($instance['title'])){
			$title = $instance['title'];
		}else{
			$title = __('Default Title');
		}
		if (isset($instance['txt'])){
			$txt = $instance['txt'];
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