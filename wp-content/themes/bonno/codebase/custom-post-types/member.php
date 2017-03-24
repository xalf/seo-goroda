<?php
$photo_slider_args = array (
	'post_type' => 'member',
	'description' => __( 'Team', BONNO_TEXTDOMAIN ),
	'public' => false,
	'exclude_from_search' => true,
	'publicly_queryable' => false,
	'show_ui' => true,
	'show_in_nav_menus' => false,
	'show_in_menu' => true,
	'show_in_admin_bar' => true,
	'menu_position' => '20',
	'menu_icon' => 'dashicons-id',
	'hierarchical' => false,
	'has_archive' => true,
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'label' => __( 'Members', BONNO_TEXTDOMAIN ),
	'labels' => array (
		'name' => __( 'Members', BONNO_TEXTDOMAIN ),
		'singular_name' => __( 'Member', BONNO_TEXTDOMAIN ),
		'menu_name' => __( 'Team', BONNO_TEXTDOMAIN ),
		'name_admin_bar' => __( 'Members', BONNO_TEXTDOMAIN ),
		'all_items' => __( 'All member', BONNO_TEXTDOMAIN ),
		'add_new' => __( 'Add member', BONNO_TEXTDOMAIN ),
		'add_new_item' => __( 'Add member', BONNO_TEXTDOMAIN ),
		'edit_item' => __( 'Edit member', BONNO_TEXTDOMAIN ),
		'new_item' => __( 'New member', BONNO_TEXTDOMAIN ),
		'view_item' => __( 'View member', BONNO_TEXTDOMAIN ),
		'search_items' => __( 'Search members', BONNO_TEXTDOMAIN ),
		'not_found' => __( 'Members not found', BONNO_TEXTDOMAIN ),
		'not_found_in_trash' => __( 'Members not found in trash', BONNO_TEXTDOMAIN )
	),
	'supports' => array (
		'title',
		'editor',
		'thumbnail'
	),
);

register_post_type( "member", $photo_slider_args );



/* Metaboxes */

add_action('admin_init', 'bonno_member_add_metabox');

function bonno_member_add_metabox() {
	add_meta_box( 'bonno_member_create_metabox_post', __( 'Position', BONNO_TEXTDOMAIN ), 'bonno_member_create_metabox_post', 'member', 'side', 'default');
	add_meta_box( 'bonno_member_create_metabox_shortcode', __( 'ID for shortcode', BONNO_TEXTDOMAIN ), 'bonno_member_create_metabox_shortcode', 'member', 'side', 'default');
}

function bonno_member_create_metabox_shortcode() {
	global $post;
	if ( !$post->ID ) {
		return;
	}
	?>
	<div class="bonno_client_link_meta">
		<div><?php echo $post->ID; ?></div>
	</div> <?php
}

function bonno_member_create_metabox_post() {
	global $post;
	$custom = get_post_custom($post->ID);
	if ( !isset( $custom['_position'] ) || !isset($custom['_position'][0] ) ) {
		$custom['_position'] = array();
		$custom['_position'][0] = '';
	} ?>
	<div class="bonno_member_position_meta">
		<input style="width: 100%; " type="text" name="_position" value="<?php echo $custom['_position'][0]; ?>"/>
	</div> <?php
}

add_action('save_post', 'bonno_member_save_metabox_data');

function bonno_member_save_metabox_data() {
	global $post;
	if ( !( $post instanceof WP_Post ) ) {
		return;
	}
	if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || $post->post_type != 'member') {
		return $post->ID;
	}

	update_post_meta( $post->ID, "_position", $_POST["_position"] );
}

add_action( 'do_meta_boxes', 'change_member_featured_image_box' );
function change_member_featured_image_box() {
	remove_meta_box( 'postimagediv', 'member', 'side' );
	add_meta_box( 'postimagediv', __('Photo', BONNO_TEXTDOMAIN ), 'post_thumbnail_meta_box', 'member', 'side' );
}

/* Admin columns */
add_filter( 'manage_edit-member_columns', 'member_admin_header_columns', 10, 1 );
add_action( 'manage_posts_custom_column', 'member_admin_column', 10, 2 );

function member_admin_header_columns( $columns ) {
	if ( !isset($columns['member_image'] ) ) {
		$columns = array_slice( $columns, 0, 1, true ) + array( 'member_image' => 'Image' ) + array_slice( $columns, 1, count( $columns ) - 1, true );
		$columns = array_slice( $columns, 0, 3, true ) + array( 'member_id_for_shortcode' => 'Shorcode ID' ) + array_slice( $columns, 3, count( $columns ) - 1, true );
		$columns = array_slice( $columns, 0, 3, true ) + array( 'position' => 'Position' ) + array_slice( $columns, 3, count( $columns ) - 1, true );
	}
	return $columns;
}

function member_admin_column( $column_name, $post_id ) {
	switch ( $column_name ) {
		case 'member_image':
			echo '<div style="max-width: 100px;"><img style="max-width: 100%;" src="' . wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ) .'" /></div>';
			break;
		case 'member_id_for_shortcode':
			echo $post_id;
			break;
		case 'position':
			echo get_post_meta( $post_id, '_position', true );
			break;
		default: break;
	}
}


// Enqueue scripts
add_action( 'admin_init', 'member_enqueue_scripts' );

function member_enqueue_scripts() {
	wp_enqueue_style( 'client_cpt_style', CODEBASE_URI . '/custom-post-types/assets/css/image-column.css' );
}