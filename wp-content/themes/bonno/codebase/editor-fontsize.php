<?php
function bonno_editor_fontsize_filter( $options ) {
	array_shift( $options );
	array_unshift( $options, 'fontsizeselect');
	array_unshift( $options, 'formatselect');
	return $options;
}
add_filter('mce_buttons_2', 'bonno_editor_fontsize_filter');

// Customize mce editor font sizes
if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
	function wpex_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 20px 21px 24px 28px 32px 36px";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );