<?php
/**
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */
get_header();
$icon = get_option( 'bonno_works_icon' );
$text = get_option( 'bonno_works_title' );
?>
<?php if ( $icon || $text ) { ?>
	<div class="heading section">
		<h1><?php if ( $icon ) { ?><img src="<?php echo $icon; ?>" alt=""><?php } ?><?php echo $text  ? $text : '' ; ?></h1>
		<hr>
	</div>
<?php } ?>
<div class="content">
	<?php echo do_shortcode('[works_filter]'); ?>
	<?php echo do_shortcode('[works]'); ?>
</div>
<?php get_footer(); ?>
