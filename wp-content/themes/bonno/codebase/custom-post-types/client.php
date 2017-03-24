<?php
// TODO: link for every client 
$clients_args = array (
	'post_type' => 'client',
	'description' => __( 'Clients', BONNO_TEXTDOMAIN ),
	'public' => false,
	'exclude_from_search' => true,
	'publicly_queryable' => false,
	'show_ui' => true,
	'show_in_nav_menus' => false,
	'show_in_menu' => true,
	'show_in_admin_bar' => true,
	'menu_position' => '20',
	'menu_icon' => 'dashicons-businessman',
	'hierarchical' => false,
	'has_archive' => true,
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'label' => __( 'Clients', BONNO_TEXTDOMAIN ),
	'labels' => array (
		'name' => __( 'Clients', BONNO_TEXTDOMAIN ),
		'singular_name' => __( 'Client', BONNO_TEXTDOMAIN ),
		'menu_name' => __( 'Clients', BONNO_TEXTDOMAIN ),
		'name_admin_bar' => __( 'Clients', BONNO_TEXTDOMAIN ),
		'all_items' => __( 'All clients', BONNO_TEXTDOMAIN ),
		'add_new' => __( 'Add client', BONNO_TEXTDOMAIN ),
		'add_new_item' => __( 'Add client', BONNO_TEXTDOMAIN ),
		'edit_item' => __( 'Edit client', BONNO_TEXTDOMAIN ),
		'new_item' => __( 'New client', BONNO_TEXTDOMAIN ),
		'view_item' => __( 'View client', BONNO_TEXTDOMAIN ),
		'search_items' => __( 'Search clients', BONNO_TEXTDOMAIN ),
		'not_found' => __( 'Clients not found', BONNO_TEXTDOMAIN ),
		'not_found_in_trash' => __( 'Client not found in trash', BONNO_TEXTDOMAIN ),
	),
	'supports' => array (
		'title',
		'thumbnail'
	),
);

register_post_type( "client", $clients_args );



/* Metaboxes */

add_action('admin_init', 'bonno_clients_add_metabox');

function bonno_clients_add_metabox() {
	add_meta_box( 'bonno_client_metabox', __( 'ID for shortcode', BONNO_TEXTDOMAIN ), 'bonno_client_create_metabox', 'client', 'side', 'low');
	add_meta_box( 'bonno_client_link_metabox', __( 'Link', BONNO_TEXTDOMAIN ), 'bonno_client_link_create_metabox', 'client', 'advanced', 'low');
}

function bonno_client_create_metabox() {
	global $post;
	if ( !$post->ID ) {
		return;
	} ?>
	<div class="bonno_client_shortcode_meta">
		<div><?php echo $post->ID; ?></div>
	</div> <?php
}

function bonno_client_link_create_metabox() {
	global $post;
	if ( !$post->ID ) {
		return;
	} ?>
	<div class="bonno_client_link_meta">
		<input type="text" name="_link" value="<?php echo get_post_meta( $post->ID, '_link', true ); ?>" />
	</div> <?php
}

add_action('save_post', 'bonno_client_save_metabox_data');

function bonno_client_save_metabox_data() {
	global $post;
	if ( !( $post instanceof WP_Post ) ) {
		return;
	}
	if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || $post->post_type != 'client' ) {
		return $post->ID;
	}

	update_post_meta( $post->ID, "_link", $_POST["_link"] );
}

add_action( 'do_meta_boxes', 'change_client_featured_image_box' );
function change_client_featured_image_box() {
	remove_meta_box( 'postimagediv', 'client', 'side' );
	add_meta_box( 'postimagediv', __('Logo', BONNO_TEXTDOMAIN ), 'post_thumbnail_meta_box', 'client', 'advanced' );
}



/* Admin columns */
add_filter( 'manage_edit-client_columns', 'client_admin_header_columns', 10, 1 );
add_action( 'manage_posts_custom_column', 'client_admin_column', 10, 2 );

function client_admin_header_columns( $columns ) {
	if ( !isset($columns['client_image'] ) ) {
		$columns = array_slice( $columns, 0, 1, true ) + array( 'client_image' => 'Image' ) + array_slice( $columns, 1, count( $columns ) - 1, true );
	}
	if ( !isset($columns['client_link'] ) ) {
		$columns = array_slice( $columns, 0, 3, true ) + array( 'client_link' => 'Link' ) + array_slice( $columns, 3, count( $columns ) - 1, true );
	}
	if ( !isset($columns['client_id_for_shortcode'] ) ) {
		$columns = array_slice( $columns, 0, 3, true ) + array( 'client_id_for_shortcode' => 'Shorcode ID' ) + array_slice( $columns, 3, count( $columns ) - 1, true );
	}
	return $columns;
}

function client_admin_column( $column_name, $post_id ) {
	switch ( $column_name ) {
		case 'client_image':
			echo '<div style="max-width: 100px;"><img style="max-width: 100%;" src="' . wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ) .'" /></div>';
			break;
		case 'client_link':
			echo get_post_meta( $post_id, '_link', true );
			break;
		case 'client_id_for_shortcode':
			echo $post_id;
			break;
	}
}

// Enqueue scripts
add_action( 'admin_init', 'client_enqueue_scripts' );

function client_enqueue_scripts() {
	wp_enqueue_style( 'client_image_column_style', CODEBASE_URI . '/custom-post-types/assets/css/image-column.css' );
	wp_enqueue_style( 'client_cpt_style', CODEBASE_URI . '/custom-post-types/assets/css/client-meta-boxes.css' );
}