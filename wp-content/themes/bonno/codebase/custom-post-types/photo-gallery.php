<?php 
$photo_gallery_args = array (
	'post_type' => 'photo_gallery',
	'description' => __( 'Photo Gallery', BONNO_TEXTDOMAIN ),
	'public' => false,
	'exclude_from_search' => true,
	'publicly_queryable' => false,
	'show_ui' => true,
	'show_in_nav_menus' => false,
	'show_in_menu' => true,
	'show_in_admin_bar' => true,
	'menu_position' => '20',
	'menu_icon' => 'dashicons-images-alt',
	'hierarchical' => false,
	'has_archive' => false,
	'rewrite' => false,
	'query_var' => false,
	'can_export' => true,
	'label' => __( 'Photo gallery', BONNO_TEXTDOMAIN ),
	'labels' => array (
		'name' => __( 'Photo galleries', BONNO_TEXTDOMAIN ),
		'singular_name' => __( 'Photo Gallery', BONNO_TEXTDOMAIN ),
		'menu_name' => __( 'Photo Galleries', BONNO_TEXTDOMAIN ),
		'name_admin_bar' => __( 'Photo Galleries', BONNO_TEXTDOMAIN ),
		'all_items' => __( 'All photo galleries', BONNO_TEXTDOMAIN ),
		'add_new' => __( 'Add photo gallery', BONNO_TEXTDOMAIN ),
		'add_new_item' => __( 'Add photo gallery', BONNO_TEXTDOMAIN ),
		'edit_item' => __( 'Edit photo gallery', BONNO_TEXTDOMAIN ),
		'new_item' => __( 'New photo gallery', BONNO_TEXTDOMAIN ),
		'view_item' => 'View photo gallery',
		'search_items' => __( 'Search photo galleries', BONNO_TEXTDOMAIN ),
		'not_found' => __( 'Photo galleries not found', BONNO_TEXTDOMAIN ),
		'not_found_in_trash' => __( 'Photo galleries not found in trash', BONNO_TEXTDOMAIN )
	),
	'supports' => array (
		'title'
	),
);

register_post_type( "photo_gallery", $photo_gallery_args );



/* Metaboxes */

add_action( 'admin_init', 'bonno_photogallery_add_metabox' );

function bonno_photogallery_add_metabox() {
	add_meta_box( 'bonno_photogallery_create_metabox', __( 'Shortcode', BONNO_TEXTDOMAIN ), 'bonno_photogallery_create_metabox', 'photo_gallery', 'side', 'default' );
}

function bonno_photogallery_create_metabox() {
	global $post;
	if (!$post->ID) {
		return;
	}
	?>
	<div class="bonno_gallery_link_meta">
		<div>
			<div>[photo_gallery id="<?php echo $post->ID; ?>"]</div>
		</div>
	</div> <?php
}