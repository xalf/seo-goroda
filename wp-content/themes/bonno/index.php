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
	<!-- CONTENT -->
	<div class="content section">
		<?php if ( count( $categories ) && !($categories instanceof WP_Error ) ) { ?>
			<div class="section">
				<ul class="nav-blog">
					<li><a href="<?php echo $archive_page_URL; ?>" class="active"><?php _e( 'All posts', BONNO_TEXTDOMAIN ); ?><ins>&nbsp;</ins></a></li>
					<?php foreach ($categories as $category) { ?>
						<li><a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?><ins>&nbsp;</ins></a></li>
					<?php }?>
				</ul>
			</div>
		<?php } ?>
		<?php get_template_part( 'posts', 'list' ); ?>
	</div>
	<!-- /.content -->
</div>
<?php get_footer(); ?>
