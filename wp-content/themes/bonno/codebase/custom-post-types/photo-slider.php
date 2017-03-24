<?php 
$photo_slider_args = array (
	'post_type' => 'photo_slider',
	'description' => __( 'Photo Slides', BONNO_TEXTDOMAIN ),
	'public' => false,
	'exclude_from_search' => true,
	'publicly_queryable' => false,
	'show_ui' => true,
	'show_in_nav_menus' => false,
	'show_in_menu' => true,
	'show_in_admin_bar' => true,
	'menu_position' => '20',
	'menu_icon' => 'dashicons-format-gallery',
	'hierarchical' => false,
	'has_archive' => false,
	'rewrite' => false,
	'query_var' => false,
	'can_export' => true,
	'label' => __( 'Slides', BONNO_TEXTDOMAIN ),
	'labels' => array (
		'name' => __( 'Photo sliders', BONNO_TEXTDOMAIN ),
		'singular_name' => __( 'Photo Slider', BONNO_TEXTDOMAIN ),
		'menu_name' => __( 'Photo Sliders', BONNO_TEXTDOMAIN ),
		'name_admin_bar' => __( 'Photo Sliders', BONNO_TEXTDOMAIN ),
		'all_items' => __( 'All photo sliders', BONNO_TEXTDOMAIN ),
		'add_new' => __( 'Add photo slider', BONNO_TEXTDOMAIN ),
		'add_new_item' => __( 'Add photo slider', BONNO_TEXTDOMAIN ),
		'edit_item' => __( 'Edit photo slider', BONNO_TEXTDOMAIN ),
		'new_item' => __( 'New photo slider', BONNO_TEXTDOMAIN ),
		'view_item' => __( 'View photo slider', BONNO_TEXTDOMAIN ),
		'search_items' => __( 'Search photo sliders', BONNO_TEXTDOMAIN ),
		'not_found' => __( 'Photo sliders not found', BONNO_TEXTDOMAIN ),
		'not_found_in_trash' => __( 'Photo sliders not found in trash', BONNO_TEXTDOMAIN ),
	),
	'supports' => array (
		'title'
	),
);

register_post_type( "photo_slider", $photo_slider_args );


/* Metaboxes */

add_action('admin_init', 'bonno_photo_slider_add_metabox');

function bonno_photo_slider_add_metabox() {
	add_meta_box( 'bonno_photo_slider_create_metabox', __( 'ID for shortcode', BONNO_TEXTDOMAIN ), 'bonno_photo_slider_create_metabox', 'photo_slider', 'side', 'low');
}

function bonno_photo_slider_create_metabox() {
	global $post;
	if ( !$post->ID ) {
		return;
	}
	?>
	<div class="bonno_client_link_meta">
		<div><?php echo $post->ID; ?></div>
	</div> <?php
}


/* Admin columns */
add_filter( 'manage_edit-photo_slider_columns', 'photo_slider_admin_header_columns', 10, 1 );
add_action( 'manage_posts_custom_column', 'photo_slider_admin_column', 10, 2 );

function photo_slider_admin_header_columns( $columns ) {
	if ( !isset($columns['photo_slider_id_for_shortcode'] ) ) {
		$columns = array_slice( $columns, 0, 2, true ) + array( 'photo_slider_id_for_shortcode' => 'Shorcode ID' ) + array_slice( $columns, 2, count( $columns ) - 1, true );
	}
	return $columns;
}

function photo_slider_admin_column( $column_name, $post_id ) {
	switch ( $column_name ) {
		case 'photo_slider_id_for_shortcode':
			echo $post_id;
			break;
	}
}