<style>
	.imaginarium-item-template {
		display: none;
	}

	.imaginarium-container {
		border-top: 1px solid #eee;
		margin: 20px -12px 0;
		overflow: hidden;
	}

	#imaginarium-add-item {
		margin-top: 12px;
	}

	#imaginarium-delete-items {
		margin-top: 12px;
		float: right;
	}

	.imaginarium-container .sorter {
		color: #bbb;
		cursor: pointer;
		float: left;
		height: 20px;
		margin-right: 10px;
		margin-top: 3px;
		width: 20px;
	}
	.imaginarium-container .sorter:hover {
		color: #888
	}

	.imaginarium-container.images-only .item {
		border: none;
		float: left;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		height: 250px;
		width: 25%;
	}

	.imaginarium-container.images-only .item .images {
		float: none;
	}

	.imaginarium-container.images-only .item .image {
		clear: none;
		float: none;
		margin-left: 30px;
	}

	.imaginarium-container.images-only .item.ui-sortable-helper {
		height: 250px !important;
	}

	.imaginarium-container.images-only .ui-state-highlight {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		float: left;
		height: 250px !important;
		width: 25%;
	}

	.imaginarium-container.images-only {
		float: none;
	}

	.imaginarium-container.images-only .images img {
		max-height: 180px;
	}

	.imaginarium-container .item {
		background: #fff;
		border-bottom: 1px solid #eee;
		padding: 10px 15px;
		overflow: hidden;
		transition: height, opacity 100ms linear;
	}

	.imaginarium-container .item.ui-sortable-helper {
		border: none;
		box-shadow: 0 0 0px 1px #aaa;
		height: 20px !important;
		opacity: .7;
		overflow: hidden;
	}

	.imaginarium-container .item:last-child {
		border-bottom: none;
	}

	.imaginarium-container .images {
		float: left;
		width: 200px;
	}

	.imaginarium-container .images img {
		display: block;
		max-width: 100%;
		max-height: 200px;
	}

	.imaginarium-container .image {
		float: left;
		margin-bottom: 10px;
		min-height: 100px;
		position: relative;
		width: 200px;
	}

	.imaginarium-container .image.file-loaded .buttons {
		display: none;
		left: .3em;
		top: 1.7em;
	}

	.imaginarium-container .image:hover.file-loaded .buttons {
		display: block;
	}

	.imaginarium-container .image .buttons {
		position: absolute;
		top: 1.5em;
		left: 0;
		-webkit-transition: all 100ms linear;
		-moz-transition: all 100ms linear;
		transition: all 100ms linear;
	}

	.imaginarium-container .ui-state-highlight {
		background: #eee;
		border: 3px dashed #ddd;
		height: 40px;
		line-height: 1.2em;
	}

	.imaginarium-container .delete-item {
		clear: both;
		float: left;
		margin-top: 5px;
		margin-left: 29px;
	}
	.imaginarium-container .images img[src=""] {
		display: none;
	}

	.imaginarium-container .texts {
		margin-left: 240px;
	}

	.imaginarium-container .text {
		margin-bottom: 10px;
	}

	.imaginarium-container label {
		display: block;
		vertical-align: top;
	}

	.imaginarium-container input[type="text"],
	.imaginarium-container textarea {
		max-width: 99%;
		min-width: 99%;
		width: 99%;
	}

	.wp-picker-default,
	.wp-picker-clear {
		display: none !important;
	}
</style>
<a id="imaginarium-add-item" class="button-primary" href="#"><?php _e( 'Add', BONNO_TEXTDOMAIN ); ?></a>
<a id="imaginarium-delete-items" class="button-secondary" href="#"><?php _e( 'Delete all', BONNO_TEXTDOMAIN ); ?></a>
<div class="imaginarium-item-template">
	<div class="item">
		<div class="sorter dashicons dashicons-image-flip-vertical" title="<?php _e( 'Drag to sort items', BONNO_TEXTDOMAIN ); ?>"></div>
		<?php if ( isset( $this->fields['images'] ) && count( $this->fields['images'] ) ) { ?>
			<div class="images">
				<?php foreach ( $this->fields['images'] as $field_name => $image_field ) { ?>
					<div class="image">
						<?php if ( isset($image_field['title'] ) ) { ?>
							<label><?php echo $image_field['title']; ?></label>
						<?php } ?>
						<img src="" alt="">
						<input type="hidden" data-name="_imaginarium[%index%][<?php echo $field_name; ?>]" />
						<div class="buttons">
							<a href="#" class="upload-image button-secondary"><?php _e( 'Upload', BONNO_TEXTDOMAIN ); ?></a>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if ( isset( $this->fields['texts'] ) && count( $this->fields['texts'] ) ) { ?>
			<div class="texts">
				<?php foreach ( $this->fields['texts'] as $field_name => $text_field ) { ?>
					<div class="text">
						<?php if ( isset($text_field['title'] ) ) { ?>
							<label><?php echo $text_field['title']; ?></label>
						<?php } ?>
						<?php if ( isset( $text_field['type'] ) && $text_field['type'] == 'textarea' ) { ?>
							<textarea data-name="_imaginarium[%index%][<?php echo $field_name; ?>]"></textarea>
						<?php } else if ( isset( $text_field['type'] ) && $text_field['type'] == 'color' ) { ?>
								<input class="imaginarium-color-picker" data-default-color="#ffffff" type="text" data-name="_imaginarium[%index%][<?php echo $field_name; ?>]" value="#ffffff" />
						<?php } else { ?>
							<input type="text" data-name="_imaginarium[%index%][<?php echo $field_name; ?>]" />
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<a href="#" class="delete-item button-secondary"><?php _e( 'Delete', BONNO_TEXTDOMAIN ); ?></a>
	</div>
</div>
<?php
	$imaginarium_container_class = '';
	if ( isset( $this->fields['container-class'] ) ) {
		$imaginarium_container_class = $this->fields['container-class'];
	}
?>
<div class="imaginarium-container <?php echo $imaginarium_container_class; ?>">
	<?php if ( is_array( $meta ) && count( $meta ) ) {


		function pippin_get_image_id($image_url) {
			global $wpdb;
			$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		        return $attachment[0];
		}

		?>
		<?php foreach( $meta as $index => $item ) {
			?>
			<div class="item">
				<div class="sorter dashicons <?php echo !$imaginarium_container_class ? 'dashicons-image-flip-vertical' : 'dashicons-image-flip-horizontal'; ?>" title="<?php _e( 'Drag to sort items', BONNO_TEXTDOMAIN ); ?>"></div>
				<?php if ( isset( $this->fields['images'] ) && count( $this->fields['images'] ) ) { ?>
					<div class="images">
						<?php foreach ( $this->fields['images'] as $field_name => $image_field ) { ?>
							<div class="image file-loaded">
								<?php if ( isset($image_field['title'] ) ) { ?>
									<label><?php echo $image_field['title']; ?></label>
								<?php } ?>
								<img src="<?php echo wp_get_attachment_url( $item[$field_name], 'full' ); ?>" alt="">

								<input type="hidden" name="_imaginarium[<?php echo $index; ?>][<?php echo $field_name; ?>]" value="<?php echo $item[$field_name]; ?>" />
								<div class="buttons">
									<a href="#" class="upload-image button-secondary"><?php _e( 'Upload', BONNO_TEXTDOMAIN ); ?></a>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if ( isset( $this->fields['texts'] ) && count( $this->fields['texts'] ) ) { ?>
					<div class="texts">
						<?php foreach ( $this->fields['texts'] as $field_name => $text_field ) {
								$value = $item[$field_name] ? $item[$field_name] : ( !empty( $text_field['default'] ) ? $text_field['default'] : '' );
							?>
							<div class="text">
								<?php if ( isset($text_field['title'] ) ) { ?>
									<label><?php echo $text_field['title']; ?></label>
								<?php }
								if ( isset( $text_field['type'] ) && $text_field['type'] == 'textarea' ) { ?>
									<textarea name="_imaginarium[<?php echo $index; ?>][<?php echo $field_name; ?>]"><?php echo $value; ?></textarea>
								<?php } else if ( isset( $text_field['type'] ) && $text_field['type'] == 'color' ) { ?>
									<input class="imaginarium-color-picker" data-default-color="<?php echo $value; ?>" type="text" name="_imaginarium[<?php echo $index; ?>][<?php echo $field_name; ?>]" value="<?php echo $value; ?>" />
								<?php } else { ?>
									<input type="text" name="_imaginarium[<?php echo $index; ?>][<?php echo $field_name; ?>]" value="<?php echo $value; ?>" />
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<a href="#" class="delete-item button-secondary"><?php _e( 'Delete', BONNO_TEXTDOMAIN ); ?></a>
			</div>
		<?php } ?>
	<?php } ?>

</div>

<script>
	(function($) {
		"use strict";
		$(function() {
			function inArray(needle, haystack){
				var found = 0;
				for (var i=0, len=haystack.length;i<len;i++) {
					if (haystack[i] == needle) return i;
						found++;
				}
				return -1;
			}

			var usedRandomInts = [];

			function randomInt() {
				var random = Math.floor(Math.random() * 100) + Math.floor(Math.random() * 100) + new Date().getTime();
				if (inArray(random, usedRandomInts) != -1) {
					return randomInt();
				}
				usedRandomInts.push(random);
				return random;
			}

			$('#imaginarium-add-item').click(function() {
				var cloned = $('.imaginarium-item-template .item').clone( true );
				var index = randomInt();
				$.each(cloned.find('input, select, textarea'), function(i, element) {
					$(element).attr('name', $(element).attr('data-name').replace('%index%', index));
				});
				cloned.prependTo( ".imaginarium-container" );
				cloned.find('.imaginarium-color-picker').wpColorPicker();
				return false;
			});

			/* Media upload */
			var original_send_to_editor = window.send_to_editor;
			var currentUploadContainer = null;
            var mediaUploader;

			$('.imaginarium-container').on('click', '.upload-image', function (e) {
                e.preventDefault();
                currentUploadContainer = $(this).parents('.image');
                // If the uploader object has already been created, reopen the dialog
                if (mediaUploader) {
                  mediaUploader.open();
                  return;
                }

                mediaUploader = wp.media.frames.file_frame = wp.media({
                  title: 'Choose Image',
                  button: {
                  text: 'Choose Image'
                }, multiple: false });

                // When a file is selected, grab the URL and set it as the text field's value
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#image-url').val(attachment.url);
                    currentUploadContainer.find('input').val(attachment.id);
                    currentUploadContainer.addClass('file-loaded');
                    currentUploadContainer.find('img').attr('src', attachment.url);
                });
                // Open the uploader dialog
                mediaUploader.open();



				// window.send_to_editor = function(html) {
				// 	var attachment_id = $('img', html).data('attachment-id');
				// 	var imgurl = $('img', html).attr('src');
				// 	currentUploadContainer.find('input').val(attachment_id);
				// 	currentUploadContainer.addClass('file-loaded');
				// 	currentUploadContainer.find('img').attr('src', imgurl);
				// 	tb_remove();
				// 	window.send_to_editor = original_send_to_editor;
				// }
                //
				// currentUploadContainer = $(this).parents('.image');
				// tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				// return false;
			});

			$('.imaginarium-container').on('click', '.delete-item', function (e) {
				if (confirm('<?php _e( "Are you sure you want to delete this item?", BONNO_TEXTDOMAIN ); ?>')) {
					$(this).parents('.item').remove();
				}
				return false;
			})

			$('#imaginarium-delete-items').click(function() {
				if (confirm('<?php _e( "Are you sure you want to delete all items?", BONNO_TEXTDOMAIN ); ?>')) {
					$('.imaginarium-container').empty();
				}
				return false;
			});

			$( ".imaginarium-container" ).sortable({
				placeholder: "ui-state-highlight",
				handle: ".sorter"
			});

			$('.imaginarium-container .imaginarium-color-picker').wpColorPicker();
		})
	})(jQuery);
</script>
