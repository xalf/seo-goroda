<?php
/**
 * Template Name: Blog archive
 * 
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

$categories = get_terms( 'category' );
$archive_page_URL = '/?post_type=post';

if ( $archive_page_ID = get_option('page_for_posts' ) ) {
	$archive_page_URL = get_permalink( $archive_page_ID );
}


get_header();
?>
<div class="content">
	<?php echo shortcode_heading(array( 
			'text' => get_option( 'bonno_blog_post_header_text' ), 
			'icon' => get_option( 'bonno_blog_post_header_icon' ) 
		) 
	); ?>
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Search results for', BONNO_TEXTDOMAIN ); ?> <a href="#"><?php echo get_query_var( 's' ); ?></a></h1>
	</header>
	<!-- CONTENT -->
	<?php if ( have_posts() ) { ?>
		<div class="content section">
			<?php get_template_part( 'posts', 'list' ); ?>
		</div>
	<?php } else { ?>
		<p class="nothing-found"><?php  _e( 'Sorry, nothing found for your search request.', BONNO_TEXTDOMAIN ); ?></p>
	<?php } ?>
	<!-- /.content -->
</div>
<?php get_footer(); ?>
