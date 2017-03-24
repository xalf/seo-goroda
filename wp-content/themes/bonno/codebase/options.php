<?php

	/* Enqueue scripts */
	add_action( 'admin_init', 'bonno_theme_options_enqueue_scripts' );

	function bonno_theme_options_enqueue_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script( 'bonno_theme_options_script', CODEBASE_URI . '/options/assets/script.js', array( 'jquery' ) );
	}

	add_action('admin_init', 'bonno_theme_options_register_settings');

	function bonno_theme_options_register_settings() {
		register_setting('bonno_theme_options', 'bonno_main_color');
		register_setting('bonno_theme_options', 'bonno_logotype_text');
		register_setting('bonno_theme_options', 'bonno_logotype_image');
		register_setting('bonno_theme_options', 'bonno_favicon');
		register_setting('bonno_theme_options', 'bonno_hide_preloader');
		register_setting('bonno_theme_options', 'bonno_preloader');
		register_setting('bonno_theme_options', 'bonno_options_use_image_logo');
		register_setting('bonno_theme_options', 'bonno_footer_text');
		register_setting('bonno_theme_options', 'bonno_header_fix_menu');
		register_setting('bonno_theme_options', 'bonno_404_title');
		register_setting('bonno_theme_options', 'bonno_404_subtitle');
		register_setting('bonno_theme_options', 'bonno_404_button_text');
		register_setting('bonno_theme_options', 'bonno_404_button_link');
		
		register_setting('bonno_theme_options', 'bonno_post_format_icon_aside');
		register_setting('bonno_theme_options', 'bonno_post_format_icon_gallery');
		register_setting('bonno_theme_options', 'bonno_post_format_icon_link');
		register_setting('bonno_theme_options', 'bonno_post_format_icon_image');
		register_setting('bonno_theme_options', 'bonno_post_format_icon_quote');
		register_setting('bonno_theme_options', 'bonno_post_format_icon_status');
		register_setting('bonno_theme_options', 'bonno_post_format_icon_video');
		register_setting('bonno_theme_options', 'bonno_post_format_icon_audio');
		register_setting('bonno_theme_options', 'bonno_post_format_icon_chat');
		
		register_setting('bonno_theme_options', 'bonno_posts_list_navigation');
		register_setting('bonno_theme_options', 'bonno_post_show_nav');

		register_setting('bonno_theme_options', 'bonno_works_title');
		register_setting('bonno_theme_options', 'bonno_works_filter_all_label');
		register_setting('bonno_theme_options', 'bonno_works_icon');
		register_setting('bonno_theme_options', 'bonno_works_autonavigation');
		register_setting('bonno_theme_options', 'bonno_works_reverse_autonavigation');

		register_setting('bonno_theme_options', 'bonno_blog_post_use_header');
		register_setting('bonno_theme_options', 'bonno_blog_post_header_text');
		register_setting('bonno_theme_options', 'bonno_blog_post_header_icon');
		register_setting('bonno_theme_options', 'bonno_blog_post_sidebar_position');
		register_setting('bonno_theme_options', 'bonno_slide_height');
		register_setting('bonno_theme_options', 'bonno_gallery_preview_height');
	}

	add_action('admin_menu', 'bonno_theme_options_create_menu');

	function bonno_theme_options_create_menu() {
		add_theme_page(
			__( 'Bonno Settings', BONNO_TEXTDOMAIN),
			__( 'Bonno Settings', BONNO_TEXTDOMAIN),
			'manage_options',
			'bonno-theme-options',
			'bonno_theme_options_render_page'
		);
	}

	function bonno_theme_options_render_page() {
		?>
		<style>
			.wrap h2 {
				margin-bottom: 20px;
			}
			.bonno_options_block {
				background: none repeat scroll 0 0 #fff;
				border: 1px solid #ccc;
				-webkit-border-radius: 2px;
				-moz-border-radius: 2px;
				border-radius: 2px;
				-webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
				-moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
				box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
				clear: both;
				display: block;
				margin: 0 0 20px;
				padding: 20px 20px 0px 20px;
				position: relative;
			}

			.bonno_options_block h3 {
				margin-top: 0;
			}

			.bonno_options_block h4 {
				margin-bottom: 5px;
			}

			.bonno_options_block label {
				display: block;
				margin-bottom: 5px;
			}

			#bonno_options_delete_logo {
				display: none;
			}
			
			.file-loaded #bonno_options_delete_logo {
				display: inline-block;
			}

			.bonno_options_block input[type="text"],
			.bonno_options_block textarea {
				border: 1px solid #ccc;
				padding: 10px;
				border-radius: 3px;
				clear: both;
				color: #666;
				display: inline-block;
				font-size: 14px;
				padding: 5px 8px;
				width: 100%;
				transition: border-color 0.05s ease-in-out 0s;
				line-height: 20px;
			}

			.bonno_options_block input[type="text"]:focus,
			.bonno_options_block textarea:focus {
				border-color: #999;
				box-shadow: 0 0 3px #ccc;
			}
			
			.bonno_options_block textarea {
				min-width: 100%;
				max-width: 100%;
				height: auto;
				width: 100%;
			}

			.bonno_inputs_block {
				margin-top: 10px;
			}

			.bonno_logo_image {
				margin-bottom: 10px;
				max-width: 100%;
			}

			.bonno_logo_image img {
				max-width: 300px;
			}

			.bonno_options_block img[src=""] {
				display: none;
			}

			.bonno_options_block .bonno_footer_textarea {
				display: none;
			}

			.bonno_options_note {
				color: #999;
				font-style: italic;
				margin-top: 10px;
			}



	
			.bonno_options_header_image {
				margin-bottom: 10px;
			}

			.bonno_options_header_image img[src=""] {
				display: none;
			}

			.bonno_options_header_image img {
				cursor: pointer;
				max-width: 100%;
			}

			.bonno_options_header_image .bonno_delete_image {
				display: none;
			}

			.bonno_options_header_image.file-loaded .bonno_upload_image {
				display: none;
			}
			.bonno_options_header_image.file-loaded .bonno_delete_image {
				display: inline;
			}
		</style>
		<div class="wrap">

			<form id="landingOptions" action="options.php" method="post">
				<?php settings_fields('bonno_theme_options')?>
				<h2><?php _e( 'Bonno Settings', BONNO_TEXTDOMAIN); ?></h2>
				<p class="submit">
					<input class="button-primary" type="submit" value="<?php echo _e('Save Changes', BONNO_TEXTDOMAIN ); ?>"/>
				</p>
				<div class="bonno_options_block">
					<h3><?php _e( 'Colors', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Main color', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input class="bonno-color-picker" type="text" name="bonno_main_color" data-default-color="#e7543d" value="<?php echo get_option( 'bonno_main_color', '#e7543d' ); ?>" />
							</td>
						</tr>
					</table>
				</div>
				<div class="bonno_options_block">
					<h3><?php _e( 'Logotype', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Text', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="text" name="bonno_logotype_text"  value="<?php echo get_option( 'bonno_logotype_text', BONNO_TEXTDOMAIN); ?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Image', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $heading_icon = get_option( 'bonno_logotype_image' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $heading_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_logotype_image" value="<?php echo $heading_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Use image', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="hidden" value="0" name="bonno_options_use_image_logo">
								<label for="bonno_options_use_image_logo_checkbox">
									<input type="checkbox" id="bonno_options_use_image_logo_checkbox" name="bonno_options_use_image_logo" value="1" <?php checked( get_option( 'bonno_options_use_image_logo', 0 ), 1 ); ?>> <?php _e( 'Yes', BONNO_TEXTDOMAIN); ?>
								</label>
							</td>
						</tr>
					</table>
				</div>
				<div class="bonno_options_block">
					<h3><?php _e( 'Favicon', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Image', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $image = get_option( 'bonno_favicon' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $image;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_favicon" value="<?php echo $image;?>" />
							</td>
						</tr>
					</table>
				</div>
				<div class="bonno_options_block">
					<h3><?php _e( 'Preloader', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Hide preloader', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="hidden" value="0" name="bonno_hide_preloader">
								<label for="bonno_hide_preloader">
									<input type="checkbox" id="bonno_hide_preloader" name="bonno_hide_preloader" value="1" <?php checked( get_option( 'bonno_hide_preloader', 0 ), 1 ); ?>> <?php _e( 'Yes', BONNO_TEXTDOMAIN); ?>
								</label>
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Image', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $image = get_option( 'bonno_preloader' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo bonno_ajust_subfolder_icon_path( $image );?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_preloader" value="<?php echo $image;?>" />
							</td>
						</tr>
					</table>
				</div>
				<div class="bonno_options_block">
					<h3><?php _e( 'Header', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Fix menu', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="hidden" value="0" name="bonno_header_fix_menu">
								<label for="bonno_header_fix_menu">
									<input type="checkbox" id="bonno_header_fix_menu" name="bonno_header_fix_menu" value="1" <?php checked( get_option( 'bonno_header_fix_menu', 0 ), 1 ); ?>> <?php _e( 'Make header menu fixed', BONNO_TEXTDOMAIN); ?>
								</label>
							</td>
						</tr>
					</table>
				</div>
				<div class="bonno_options_block">
					<h3><?php _e( 'Footer', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Text', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<textarea class="bonno_footer_textarea" name="bonno_footer_text" id=""><?php echo get_option( 'bonno_footer_text' ); ?></textarea>
								<?php wp_editor( get_option( 'bonno_footer_text' ), 'bonno_footer_text', array(
									'wpautop' => false,
									'media_buttons' => true,
									'editor_class' => 'bonno_footer_text_editor ',
									'teeny' => false,
									'quicktags' => true,
									'textarea_name' => 'bonno_footer_text',
									'tinymce' => array(
										'theme_advanced_buttons1' => 'bold,italic,underline,strikethrough,|,bullist,numlist,|,link,unlink'
									)
								));?>
							</td>
						</tr>
					</table>
				</div>
				<div class="bonno_options_block">
					<h3><?php _e( '404 page', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Title', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="text" name="bonno_404_title"  value="<?php echo get_option( 'bonno_404_title' ); ?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Subtitle', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="text" name="bonno_404_subtitle"  value="<?php echo get_option( 'bonno_404_subtitle' ); ?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Button text', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="text" name="bonno_404_button_text"  value="<?php echo get_option( 'bonno_404_button_text' ); ?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Button link', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="text" name="bonno_404_button_link"  value="<?php echo get_option( 'bonno_404_button_link' ); ?>" />
							</td>
						</tr>
					</table>
				</div>

				<div class="bonno_options_block">
					<h3><?php _e( 'Post Formats', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Aside', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_aside' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_aside" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Gallery', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_gallery' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_gallery" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Link', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_link' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_link" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Image', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_image' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_image" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Quote', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_quote' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_quote" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Status', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_status' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_status" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Video', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_video' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_video" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Audio', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_audio' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_audio" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Chat', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $post_format_icon = get_option( 'bonno_post_format_icon_chat' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $post_format_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_post_format_icon_chat" value="<?php echo $post_format_icon;?>" />
							</td>
						</tr>
					</table>
				</div>


				
				<div class="bonno_options_block">
					<h3><?php _e( 'Posts Navigation', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Posts list navigation', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<label for="bonno_posts_list_navigation_pagination">
									<input autocomplete="off" id="bonno_posts_list_navigation_pagination" type="radio" name="bonno_posts_list_navigation" value="pagination" <?php checked( get_option( 'bonno_posts_list_navigation', 'pagination'), 'pagination' ); ?>> <?php _e( 'Pagination', BONNO_TEXTDOMAIN); ?>
								</label>
								<label for="bonno_posts_list_navigation_ajax">
									<input autocomplete="off" id="bonno_posts_list_navigation_ajax" type="radio" name="bonno_posts_list_navigation" value="ajax" <?php checked( get_option( 'bonno_posts_list_navigation', 'pagination'), 'ajax' ); ?>> <?php _e( 'AJAX', BONNO_TEXTDOMAIN); ?>
								</label>
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Show prev/next links for single post', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<label for="bonno_post_show_nav_use">
									<input autocomplete="off" id="bonno_post_show_nav_use" type="radio" name="bonno_post_show_nav" value="1" <?php checked( get_option( 'bonno_post_show_nav', 1), 1 ); ?>> <?php _e( 'Show', BONNO_TEXTDOMAIN); ?>
								</label>
								<label for="bonno_post_show_nav_use_dont">
									<input autocomplete="off" id="bonno_post_show_nav_use_dont" type="radio" name="bonno_post_show_nav" value="2" <?php checked( get_option( 'bonno_post_show_nav', 1), 2 ); ?>> <?php _e( 'Do not show', BONNO_TEXTDOMAIN); ?>
								</label>
							</td>
						</tr>
					</table>
				</div>


				<div class="bonno_options_block">
					<h3><?php _e( 'Works', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Works archive title', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="text" name="bonno_works_title"  value="<?php echo get_option( 'bonno_works_title' ); ?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Works archive header icon', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $heading_icon = get_option( 'bonno_works_icon' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $heading_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_works_icon" value="<?php echo $heading_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Works filter "All Works" label', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="text" name="bonno_works_filter_all_label"  value="<?php echo get_option( 'bonno_works_filter_all_label' ); ?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Works navigation links', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="hidden" value="0" name="bonno_works_autonavigation">
								<label for="bonno_works_autonavigation">
									<input type="checkbox" id="bonno_works_autonavigation" name="bonno_works_autonavigation" value="1" <?php checked( get_option( 'bonno_works_autonavigation', 0 ), 1 ); ?>> <?php _e( 'Show under content', BONNO_TEXTDOMAIN); ?>
								</label>
								
								<input type="hidden" value="0" name="bonno_works_reverse_autonavigation">
								<label for="bonno_works_reverse_autonavigation">
									<input type="checkbox" id="bonno_works_reverse_autonavigation" name="bonno_works_reverse_autonavigation" value="1" <?php checked( get_option( 'bonno_works_reverse_autonavigation', 0 ), 1 ); ?>> <?php _e( 'Reverse position', BONNO_TEXTDOMAIN); ?>
								</label>
							</td>
						</tr>
					</table>
				</div>

				<div class="bonno_options_block">
					<h3><?php _e( 'Blog', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Header', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<label for="bonno_blog_post_use_header">
									<input autocomplete="off" id="bonno_blog_post_use_header" type="radio" name="bonno_blog_post_use_header" value="1" <?php checked( get_option( 'bonno_blog_post_use_header', 1), 1 ); ?>> <?php _e( 'Use', BONNO_TEXTDOMAIN); ?>
								</label>
								<label for="bonno_blog_post_do_not_use_header">
									<input autocomplete="off" id="bonno_blog_post_do_not_use_header" type="radio" name="bonno_blog_post_use_header" value="2" <?php checked( get_option( 'bonno_blog_post_use_header', 2), 2 ); ?>> <?php _e( 'Do not use', BONNO_TEXTDOMAIN); ?>
								</label>
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Header text', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<input type="text" id="bonno_blog_post_header_text" name="bonno_blog_post_header_text" value="<?php echo get_option( 'bonno_blog_post_header_text', __( 'Our Works', BONNO_TEXTDOMAIN) );?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Header icon', BONNO_TEXTDOMAIN); ?></th>
							<td class="bonno_options_header_image <?php echo ( $heading_icon = get_option( 'bonno_blog_post_header_icon' ) ) ? ' file-loaded' : '';?>">
								<img src="<?php echo $heading_icon;?>" title="<?php _e( 'Click to upload or choose new image', BONNO_TEXTDOMAIN ); ?>">
								<div class="buttons">
									<a href="#" class="bonno_upload_image"><?php _e( 'Upload Image', BONNO_TEXTDOMAIN ); ?></a>
									<a href="#" class="bonno_delete_image"><?php _e( 'Delete Image', BONNO_TEXTDOMAIN ); ?></a>
								</div>
								<input type="hidden" name="bonno_blog_post_header_icon" value="<?php echo $heading_icon;?>" />
							</td>
						</tr>
						<tr>
							<th class="label"><?php _e( 'Sidebar position', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<label for="bonno_blog_post_sidebar_left">
									<input id="bonno_blog_post_sidebar_left" type="radio" name="bonno_blog_post_sidebar_position" value="2" <?php checked( get_option( 'bonno_blog_post_sidebar_position', 2), 2 ); ?>> <?php _e( 'Left', BONNO_TEXTDOMAIN); ?>
								</label>
								<label for="bonno_blog_post_sidebar_right">
									<input id="bonno_blog_post_sidebar_right" type="radio" name="bonno_blog_post_sidebar_position" value="3" <?php checked( get_option( 'bonno_blog_post_sidebar_position', 2), 3); ?>> <?php _e( 'Right', BONNO_TEXTDOMAIN); ?>
								</label>
								<label for="bonno_blog_post_sidebar_do_not_use">
									<input id="bonno_blog_post_sidebar_do_not_use" type="radio" name="bonno_blog_post_sidebar_position" value="1" <?php checked( get_option( 'bonno_blog_post_sidebar_position', 2), 1 ); ?>> <?php _e( 'Do not use', BONNO_TEXTDOMAIN); ?>
								</label>
							</td>
						</tr>
					</table>
				</div>
				<div class="bonno_options_block">
					<h3><?php _e( 'Slides', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Slide height', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<?php
									$slide_height = get_option( 'bonno_slide_height', 500 );
									if ( (int)$slide_height < 1 ) {
										$slide_height = 500;
									}
								?>
								<input type="text" name="bonno_slide_height"  value="<?php echo $slide_height; ?>" />
							</td>
						</tr>

					</table>
				</div>
				<div class="bonno_options_block">
					<h3><?php _e( 'Photo gallery', BONNO_TEXTDOMAIN); ?></h3>
					<table class="form-table">
						<tr>
							<th class="label"><?php _e( 'Preview height', BONNO_TEXTDOMAIN); ?></th>
							<td>
								<?php
									$preview_height = get_option( 'bonno_gallery_preview_height', 250 );
									if ( (int)$preview_height < 1) {
										$preview_height = 250;
									}
								?>
								<input type="text" name="bonno_gallery_preview_height"  value="<?php echo $preview_height; ?>" />
							</td>
						</tr>

					</table>
				</div>
				<p class="submit">
					<input class="button-primary" type="submit" value="<?php echo _e('Save Changes', BONNO_TEXTDOMAIN ); ?>"/>
				</p>
			</form>
		</div>
	<?php } ?>