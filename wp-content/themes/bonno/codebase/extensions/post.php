<?php
/* Metaboxes */

add_action('admin_init', 'bonno_post_add_meta_boxes');

function bonno_post_add_meta_boxes() {
	add_meta_box( 'bonno_post_header_meta_box', __( 'Header', BONNO_TEXTDOMAIN ), 'bonno_post_header_create_meta_box', 'post', 'side', 'default');
	add_meta_box( 'bonno_post_sidebar_meta_box', __( 'Sidebar position', BONNO_TEXTDOMAIN ), 'bonno_post_sidebar_create_meta_box', 'post', 'side', 'default');
}

function bonno_post_header_create_meta_box() {
	global $post;
	$use_header = (int)get_post_meta( $post->ID, '_use_header', true ); ?>
	<label for="post-use-header-0">
		<input id="post-use-header-0" type="radio" name="_use_header" value="0" <?php checked( !$use_header ); ?> />
		<?php _e( 'Use default value', BONNO_TEXTDOMAIN ); ?>
	</label>
	<label for="post-use-header-1">
		<input id="post-use-header-1" type="radio" name="_use_header" value="1" <?php echo checked( $use_header, 1 ); ?> />
		<?php _e( 'Use custom (see "Heading" box)', BONNO_TEXTDOMAIN ); ?>
	</label>
	<label for="post-use-header-2">
		<input id="post-use-header-2" type="radio" name="_use_header" value="2" <?php echo checked( $use_header, 2 ); ?> />
		<?php _e( 'Do not use', BONNO_TEXTDOMAIN ); ?>
	</label> <?php
}

function bonno_post_sidebar_create_meta_box() {
		global $post;
	$sidebar_position = (int)get_post_meta( $post->ID, '_sidebar_position', true ); ?>
	<label for="sidebar-position-0">
		<input id="sidebar-position-0" type="radio" name="_sidebar_position" value="0" <?php checked( !$sidebar_position ); ?> />
		<?php _e( 'Use default position', BONNO_TEXTDOMAIN ); ?>
	</label>
	<label for="sidebar-position-1">
		<input id="sidebar-position-1" type="radio" name="_sidebar_position" value="1" <?php checked( $sidebar_position, 1 ); ?> />
		<?php _e( 'Do not use sidebar', BONNO_TEXTDOMAIN ); ?>
	</label>
	<label for="sidebar-position-2">
		<input id="sidebar-position-2" type="radio" name="_sidebar_position" value="2" <?php checked( $sidebar_position, 2 ); ?> />
		<?php _e( 'Left', BONNO_TEXTDOMAIN ); ?>
	</label> 
	<label for="sidebar-position-3">
		<input id="sidebar-position-3" type="radio" name="_sidebar_position" value="3" <?php checked( $sidebar_position, 3 ); ?> />
		<?php _e( 'Right', BONNO_TEXTDOMAIN ); ?>
	</label> 

	<?php
}

/* Save meta boxes data*/
add_action('save_post', 'bonno_post_save_meta_boxes_data');

function bonno_post_save_meta_boxes_data() {
	global $post;
	if ( !( $post instanceof WP_Post ) ) {
		return;
	}
	if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || $post->post_type != 'post') {
		return $post->ID;
	}
	if ( !empty($_POST["_use_header"]) ) {
		update_post_meta( $post->ID, "_use_header", $_POST["_use_header"] );
	}
	if ( !empty($_POST["_sidebar_position"]) ) {
		update_post_meta( $post->ID, "_sidebar_position", $_POST["_sidebar_position"] );
	}
}


/* Enqueue scripts */
add_action( 'admin_init', 'post_enqueue_scripts' );

function post_enqueue_scripts() {
	wp_enqueue_style( 'post_metaboxes_style', CODEBASE_URI . '/assets/css/post-meta-boxes.css' );
}