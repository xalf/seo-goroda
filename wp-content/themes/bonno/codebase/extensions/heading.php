<?php
/**
 * Heading metabox
 */

add_action('admin_init', 'bonno_add_heading_meta_box');

function bonno_add_heading_meta_box() {
	add_meta_box( 'bonno_heading_meta_box', __( 'Heading', BONNO_TEXTDOMAIN ), 'bonno_heading_create_meta_box', 'page', 'side', 'default');
	add_meta_box( 'bonno_heading_meta_box', __( 'Heading', BONNO_TEXTDOMAIN ), 'bonno_heading_create_meta_box', 'work', 'side', 'default');
	add_meta_box( 'bonno_heading_meta_box', __( 'Heading', BONNO_TEXTDOMAIN ), 'bonno_heading_create_meta_box', 'post', 'side', 'default');
}

function bonno_heading_create_meta_box() {
	global $post; ?>
	<div>
		<label for="header-text"><?php _e( 'Text', BONNO_TEXTDOMAIN ); ?></label>
		<input type="text" id="header-text" name="_header_text" value="<?php echo get_post_meta( $post->ID, '_header_text', true );?>" />
		<label for="header-icon"><?php _e( 'Icon', BONNO_TEXTDOMAIN ); ?></label>
		<div class="image <?php echo ( $heading_icon = get_post_meta( $post->ID, '_header_icon', true ) ) ? ' file-loaded' : '';?>">
			<img src="<?php echo bonno_ajust_subfolder_icon_path( $heading_icon ); ?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
			<div class="buttons">
				<a href="#" id="bonno_heading_upload_icon"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
				<a href="#" id="bonno_heading_delete_icon"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
			</div>
			<input type="hidden" id="header-icon" name="_header_icon" value="<?php echo $heading_icon;?>" />
		</div>
	</div> <?php
}


/* Save meta boxes data*/
add_action('save_post', 'bonno_save_heading_meta_boxes_data');

function bonno_save_heading_meta_boxes_data() {
	global $post;
	if ( !( $post instanceof WP_Post ) ) {
		return;
	}
	if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )) {
		return $post->ID;
	}
	if ( empty( $_POST["_header_text"] ) ) {
		$_POST["_header_text"] = '';
	}
	update_post_meta( $post->ID, "_header_text", $_POST["_header_text"] );
	if ( empty( $_POST["_header_icon"] ) ) {
		$_POST["_header_icon"] = '';
	}
	update_post_meta( $post->ID, "_header_icon", $_POST["_header_icon"] );
}


/* Enqueue scripts */
add_action( 'admin_init', 'bonno_heading_enqueue_scripts' );

function bonno_heading_enqueue_scripts() {
	wp_enqueue_style( 'bonno_heading_meta_box_style', CODEBASE_URI . '/assets/css/heading-meta-box.css' );
	wp_enqueue_script( 'bonno_heading_meta_box_script', CODEBASE_URI . '/assets/js/heading-meta-box.js', null, true );
}