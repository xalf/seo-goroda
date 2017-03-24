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
	<?php bonno_heading(); ?>
	<?php the_content(); ?>
	<?php 
		$link_pages = wp_link_pages(array(
			'echo' => false
		)); 
		if ( $link_pages ) { ?>
			<div class="section">
				<div class="col span_12_of_12">

				</div>
			</div>
	<?php } ?>
	<?php edit_post_link( __( 'Edit page', BONNO_TEXTDOMAIN ), '<div class="edit-post-button"><div class="button">', '</div></div>' ); ?>
</div>
<?php get_footer(); ?>
