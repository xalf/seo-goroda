<?php
/**
 * Yemplate for author pages
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
		<h1 class="page-title"><?php _e('All posts by', BONNO_TEXTDOMAIN ); ?>&nbsp;
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_the_author(); ?>
			</a>
		</h1>
	</header>
	<!-- CONTENT -->
	<div class="content section">
		<?php get_template_part( 'posts', 'list' ); ?>
	</div>
	<!-- /.content -->
</div>
<?php get_footer(); ?>
