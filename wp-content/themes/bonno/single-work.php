<?php
/**
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

get_header();
?>
<div class="content">
	<?php
		the_post();
		bonno_work_heading();
		//echo do_shortcode( get_the_content() );
		the_content();
	?>

</div>
<?php get_footer(); ?>
