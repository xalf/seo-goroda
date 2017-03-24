<?php
/**
 * Template for blog posts tags
 * 
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

get_header();
?>
<div class="content">
	<?php echo shortcode_heading(array( 
			'text' => get_option( 'bonno_blog_post_header_text' ), 
			'icon' => get_option( 'bonno_blog_post_header_icon' ) 
		) 
	); ?>
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Tag archives', BONNO_TEXTDOMAIN ) ?> 
			<a href="<?php echo get_tag_link( get_query_var( 'tag_id' ) ); ?>"><?php echo single_tag_title(); ?></a>
		</h1>
	</header>
	<!-- CONTENT -->
	<div class="content section">
		<?php get_template_part( 'posts', 'list' ); ?>
	</div>
	<!-- /.content -->
</div>
<?php get_footer(); ?>
