<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

get_header();
the_post();
$use_header = (int)meta( '_use_header', false);
$header_text = '';
$header_icon = '';

if ($use_header == 0 ) {
	$use_header = get_option( 'bonno_blog_post_use_header', false );
	if ( $use_header && ( $header_text = get_option( 'bonno_blog_post_header_text' ) ) )
		$header_icon = get_option( 'bonno_blog_post_header_icon' );
} else if ( $use_header == 1 ) {
	$header_text = meta( '_header_text', false );
	$header_icon = meta( '_header_icon', false );
}

$sidebar_position = (int)meta( '_sidebar_position', false);
if ( $sidebar_position == 0 ) {
	$sidebar_position = get_option( 'bonno_blog_post_sidebar_position', 0 );
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content post">
		<?php if ( $use_header != 2) { bonno_heading( $header_text, $header_icon ); } ?>
		<div class="content section">
			<div class="blog col span_9_of_12 <?php echo $sidebar_position == 1 ? 'no_sidebar' : '' ;?> <?php echo $sidebar_position == 2 ? 'fright' : '' ; ?>">
				<a href="<?php echo bonno_get_blog_page_url(); ?>" class="back">Back to Blog</a>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
				<nav class="navigation post-navigation" role="navigation">
					<div class="nav-links">
						<?php
							if ( get_option( 'bonno_post_show_nav', 1) == 1 ) {
								if ( is_attachment() ) {
									previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', BONNO_TEXTDOMAIN ) );
								} else {
									previous_post_link( '%link', __( '<span class="meta-nav prev" title="%title">Previous Post</span>', BONNO_TEXTDOMAIN ) );
									next_post_link( '%link', __( '<span class="meta-nav next" title="%title">Next Post</span>', BONNO_TEXTDOMAIN ) );
								}
							}
						?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->
				<?php edit_post_link( __( 'Edit post', BONNO_TEXTDOMAIN ), '<div class="edit-post-button"><div class="button">', '</div></div>' ); ?>
				<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
			</div>
			<?php if ( $sidebar_position == 3 || $sidebar_position == 2 ) { ?>
				<aside class="blogbar col span_3_of_12">
			<?php get_sidebar(); ?>
				</aside>
			<?php } ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
