<?php 
$works_args = array (
	'post_type' => 'work',
	'description' => __( 'Portfolio works', BONNO_TEXTDOMAIN ),
	'public' => true,
	'exclude_from_search' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_nav_menus' => true,
	'show_in_menu' => true,
	'show_in_admin_bar' => true,
	'menu_position' => '20',
	'menu_icon' => 'dashicons-portfolio',
	'hierarchical' => false,
	'has_archive' => true,
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'label' => __( 'Works', BONNO_TEXTDOMAIN ),
	'labels' => array (
		'name' => __( 'Works', BONNO_TEXTDOMAIN ),
		'singular_name' => __( 'Work', BONNO_TEXTDOMAIN ),
		'menu_name' => __( 'Portfolio', BONNO_TEXTDOMAIN ),
		'name_admin_bar' => __( 'Works', BONNO_TEXTDOMAIN ),
		'all_items' => __( 'All works', BONNO_TEXTDOMAIN ),
		'add_new' => __( 'Add work', BONNO_TEXTDOMAIN ),
		'add_new_item' => __( 'Add work', BONNO_TEXTDOMAIN ),
		'edit_item' => __( 'Edit work', BONNO_TEXTDOMAIN ),
		'new_item' => __( 'New work', BONNO_TEXTDOMAIN ),
		'view_item' => __( 'View work', BONNO_TEXTDOMAIN ),
		'search_items' => __( 'Search works', BONNO_TEXTDOMAIN ),
		'not_found' => __( 'Works not found', BONNO_TEXTDOMAIN ),
		'not_found_in_trash' => __( 'Works not found in trash', BONNO_TEXTDOMAIN ),
	),
	'supports' => array (
		'title',
		'editor',
		'thumbnail'
	),
);

register_post_type( "work", $works_args );

/* Category */
add_action('init', 'bonno_taxonomy_register', 0);
function bonno_taxonomy_register() {
	$args = array(
		'labels'            => array(
			'name'                  => __( 'Work categories', BONNO_TEXTDOMAIN ),
			'singular_name'         => __( 'Category', BONNO_TEXTDOMAIN ),
			'menu_name'             => __( 'Categories', BONNO_TEXTDOMAIN ),
			'all_items'             => __( 'Categories', BONNO_TEXTDOMAIN ),
			'new_item_name'         => __( 'New category', BONNO_TEXTDOMAIN ),
			'add_new_item'          => __( 'New category', BONNO_TEXTDOMAIN ),
			'edit_item'             => __( 'Edit category', BONNO_TEXTDOMAIN ),
			'update_item'           => __( 'Update category', BONNO_TEXTDOMAIN ),
			'search_items'          => __( 'Search categories', BONNO_TEXTDOMAIN ),
			'add_or_remove_items'   => __( 'Add or remove category', BONNO_TEXTDOMAIN ),
			'choose_from_most_used' => __( 'Choose from the most used categories', BONNO_TEXTDOMAIN ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'query_var'         => 'workcategory',
		'rewrite'           => array(
			'slug'         => 'workcategory',
			'with_front'   => true,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'workcategory', 'work', $args );
}


/* Metaboxes */

add_action('admin_init', 'bonno_work_add_meta_boxes');

function bonno_work_add_meta_boxes() {
	add_meta_box( 'bonno_work_featured_meta_box', __( 'Featured', BONNO_TEXTDOMAIN ), 'bonno_work_create_featured_meta_box', 'work', 'side', 'default');
	add_meta_box( 'bonno_work_sidebar_meta_box', __( 'Works navigation', BONNO_TEXTDOMAIN ), 'bonno_work_navigation_create_meta_box', 'work', 'side', 'default');
}

function bonno_work_create_featured_meta_box() {
	global $post;
	?>
	<div class="bonno_work_featured_meta">
		<input type="hidden" name="_featured" value="0">
		<label for="work-is-featured">
			<input id="work-is-featured" type="checkbox" name="_featured" value="1" <?php checked( get_post_meta( $post->ID, '_featured', true ) ); ?> />
			<?php _e( 'Yes', BONNO_TEXTDOMAIN ); ?>
		</label>
	</div> <?php
}

function bonno_work_navigation_create_meta_box() {
	global $post;
	?>
	<div class="bonno_work_autonavigation_meta">
		<?php
			$_use_global_navigation_settings = get_post_meta( $post->ID, '_use_global_navigation_settings', true );
			if ( $_use_global_navigation_settings !== '0' && empty( $_use_global_navigation_settings ) ) {
				$_use_global_navigation_settings = 1;
			}
		?>
		<input type="hidden" name="_use_global_navigation_settings" value="0">
		<label for="work-use-custom-navigation-settings">
			<input id="work-use-custom-navigation-settings" type="checkbox" name="_use_global_navigation_settings" value="1" <?php checked( $_use_global_navigation_settings ); ?> />
			<?php _e( 'Use global settings', BONNO_TEXTDOMAIN ); ?>
		</label><br>
		<input type="hidden" name="_autonavigation" value="0">
		<label for="work-autonavigation">
			<input id="work-autonavigation" type="checkbox" name="_autonavigation" value="1" <?php checked( get_post_meta( $post->ID, '_autonavigation', true ) ); ?> />
			<?php _e( 'Show under content', BONNO_TEXTDOMAIN ); ?>
		</label><br>
		<input type="hidden" name="_reverse-autonavigation" value="0">
		<label for="work-reverse-autonavigation">
			<input id="work-reverse-autonavigation" type="checkbox" name="_reverse-autonavigation" value="1" <?php checked( get_post_meta( $post->ID, '_reverse-autonavigation', true ) ); ?> />
			<?php _e( 'Reverse position', BONNO_TEXTDOMAIN ); ?>
		</label>
	</div> <?php
}

add_action( 'do_meta_boxes', 'change_work_featured_image_box' );
function change_work_featured_image_box() {
	remove_meta_box( 'postimagediv', 'work', 'side' );
	add_meta_box( 'postimagediv', __('Preview', BONNO_TEXTDOMAIN ), 'post_thumbnail_meta_box', 'work', 'side' );
}

/* Save meta boxes data*/
add_action('save_post', 'bonno_work_save_meta_boxes_data');

function bonno_work_save_meta_boxes_data() {
	global $post;
	if ( !( $post instanceof WP_Post ) ) {
		return;
	}
	if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || $post->post_type != 'work')
		return $post->ID;
	if ( empty( $_POST["_featured"] ) ) { 
		$_POST["_featured"] = 0;
	}
	update_post_meta( $post->ID, "_featured", $_POST["_featured"] );
	if ( empty( $_POST["_use_global_navigation_settings"] ) ) { 
		$_POST["_use_global_navigation_settings"] = 0;
	}
	update_post_meta( $post->ID, "_use_global_navigation_settings", $_POST["_use_global_navigation_settings"] );
	if ( empty( $_POST["_autonavigation"] ) ) { 
		$_POST["_autonavigation"] = 0;
	}
	update_post_meta( $post->ID, "_autonavigation", $_POST["_autonavigation"] );
	if ( empty( $_POST["_reverse-autonavigation"] ) ) { 
		$_POST["_reverse-autonavigation"] = 0;
	}
	update_post_meta( $post->ID, "_reverse-autonavigation", $_POST["_reverse-autonavigation"] );
	if ( empty( $_POST["_imaginarium"] ) ) {
		$_POST["_imaginarium"] = array();
	}
	update_post_meta( $post->ID, "_imaginarium", $_POST["_imaginarium"] );
	if ( empty( $_POST["_textarium"] ) ) {
		$_POST["_textarium"] = array();
	}
	update_post_meta( $post->ID, "_textarium", $_POST["_textarium"] );
}

/* Admin columns */
add_filter( 'manage_edit-work_columns', 'work_admin_header_columns', 10, 1 );
add_action( 'manage_posts_custom_column', 'work_admin_column', 10, 2 );

function work_admin_header_columns( $columns ) {
	if ( !isset($columns['work_image'] ) ) {
		$columns = array_slice( $columns, 0, 1, true ) + array( 'work_image' => __( 'Image', BONNO_TEXTDOMAIN ) ) + array_slice( $columns, 1, count( $columns ) - 1, true );
	}
	if ( !isset($columns['work_featured'] ) ) {
		$columns = array_slice( $columns, 0, 4, true ) + array( 'work_featured' => __( 'Featured', BONNO_TEXTDOMAIN ) ) + array_slice( $columns, 4, count( $columns ) - 1, true );
	}
	return $columns;
}

function work_admin_column( $column_name, $post_id ) {
	switch ( $column_name ) {
		case 'work_image':
			echo '<div style="max-width: 100px;"><img style="max-width: 100%;" src="' . wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ) .'" /></div>';
			break;
		case 'work_featured':
			echo get_post_meta( $post_id, '_featured', true ) ? '<span class="green">'. __( 'Yes', BONNO_TEXTDOMAIN) .'</span>' : '<span class="green">'. __( 'No', BONNO_TEXTDOMAIN) .'</span>' ;
			break;
	}
}

/* Enqueue scripts */
add_action( 'admin_init', 'work_enqueue_scripts' );

function work_enqueue_scripts() {
	wp_enqueue_style( 'work_cpt_style', CODEBASE_URI . '/custom-post-types/assets/css/image-column.css' );
	wp_enqueue_style( 'work_cpt_tt_style', CODEBASE_URI . '/custom-post-types/assets/css/work-meta-boxes.css' );
}