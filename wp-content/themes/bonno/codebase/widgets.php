<?php
/**
 * Custom Widget for displaying post data
 *
 * Displays author avatar, date, comments count
 *
 * @link http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Bonno Theme
 * @since Bonno 1.0
 */

class Bonno_Post_Widget extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since Bonno 1.0
	 *
	 * @return Twenty_Fourteen_Ephemera_Widget
	 */
	public function __construct() {
		parent::__construct( 'widget_bonno_post', __( 'Bonno Post Data', BONNO_TEXTDOMAIN ), array(
			'classname'   => 'widget_bonno_post',
			'description' => __( 'Use this widget to show post author avatar, comments count and date', BONNO_TEXTDOMAIN ),
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since Bonno 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 * @return void Echoes its output.
	 */
	public function widget( $args, $instance ) {
		global $post; 
		if ( !$post )
			return;

		$author_ID = get_the_author_meta( 'ID' );
		$author_URL = get_author_posts_url( $author_ID );

		
		echo $args['before_widget']; ?>
			<div class="bonno_post_widget">
				<div class="ava">
					<a href="<?php echo $author_URL; ?>"><?php echo get_avatar( $author_ID ); ?></a>
				</div>
				<h5><a href="<?php echo $author_URL; ?>"><?php the_author(); ?></a></h5>
				<div class="date"><?php the_date(); ?></div>
				<nav class="categories">
					<?php the_category( ', ' ); ?>
				</nav>
				<nav class="tags">
					<?php the_tags(' '); ?>
				</nav>
				<?php echo bonno_comments(); ?>
			</div>
			<?php echo $args['after_widget'];
	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @since Bonno 1.0
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		return $new_instance;
	}

}
