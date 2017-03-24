<?php
/**
 * Template Name: Page 404
 * 
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */
get_header();
?>
<div class="page404">
	<div class="content section aligned center">
		<div class="heading">
			<h1><?php echo get_option( 'bonno_404_title', __( 'ERROR 404', BONNO_TEXTDOMAIN ) ) ;?> <small><?php echo get_option( 'bonno_404_subtitle', __( 'The page you are looking for can not be found!', BONNO_TEXTDOMAIN ) ); ?></small></h1>
			<hr>
		</div>
		<?php if ( ( $text = get_option( 'bonno_404_button_text' ) ) && ( $link = get_option( 'bonno_404_button_link' ) ) ) { ?>
			<a class="button" href="<?php echo $link; ?>"><?php echo $text; ?></a>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>
