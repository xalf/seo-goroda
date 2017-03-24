<?php
/**
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

get_header();
the_post();
?>
<div class="content">
	<?php if ( wp_attachment_is_image( $post->id ) ) { 
		$att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
		<p class="attachment">
			<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
				<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" alt="<?php $post->post_excerpt; ?>" />
			</a>
		</p>
	<?php } else { ?>
		<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
	<?php } ?>
</div>
<?php get_footer(); ?>
