<?php
/**
 * The Header for Bonno theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<?php if (is_404()) { ?>
		<title><?php echo get_option( 'bonno_404_title' ); ?> | <?php wp_title( '|', true, 'right' ); ?></title>
	<?php } else { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php } ?>
	<?php bonno_favicon(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- WRAPPER -->
	<div class="wrapper">
		<!-- HEADER -->
		<header class="header section">
			<div class="col span_4_of_12">
				<a href="<?php echo site_url(); ?>" class="logo">
					<?php if ( get_option( 'bonno_options_use_image_logo', 0) ) { 
						if ( get_option( 'bonno_logotype_image' ) ) { ?>
							<img src="<?php echo get_option( 'bonno_logotype_image' ); ?>" alt="">
						<?php }
					} else { 
						echo get_option( 'bonno_logotype_text', 'Bonno' ); 
					} ?>
				</a>
			</div>
			<div class="col span_8_of_12 aligned right slicknav_target">
				<?php wp_nav_menu( array(
							'theme_location'  => 'primary',
							'container'       => '',
							'menu_class'      => 'mainmenu'
						) 
					); 
				?>
			</div>
		</header> <!-- /header -->
