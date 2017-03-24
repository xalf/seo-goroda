<?php
/**
 * Bonno back compat functionality
 *
 * Prevents Bonno from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.6.
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

/**
 * Prevent switching to Bonno on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Bonno 1.0
 *
 * @return void
 */
function bonno_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'bonno_upgrade_notice' );
}
add_action( 'after_switch_theme', 'bonno_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Bonno on WordPress versions prior to 3.6.
 *
 * @since Bonno 1.0
 *
 * @return void
 */
function bonno_upgrade_notice() {
	$message = sprintf( __( 'Bonno requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', BONNO_TEXTDOMAIN ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.6.
 *
 * @since Bonno 1.0
 *
 * @return void
 */
function bonno_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Bonno requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', BONNO_TEXTDOMAIN ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'bonno_preview' );
