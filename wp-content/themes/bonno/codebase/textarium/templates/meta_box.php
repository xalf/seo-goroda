<style>
	.textarium-item-template {
		display: none;
	}

	.textarium-contaner {
		border-top: 1px solid #eee;
		margin: 20px -12px 0;
		overflow: hidden;
	}

	#textarium-add-item {
		margin-top: 12px;
	}

	#textarium-delete-items {
		margin-top: 12px;
		float: right;
	}

	.textarium-contaner .sorter {
		color: #bbb;
		cursor: pointer;
		float: left;
		height: 20px;
		margin-right: 10px;
		margin-top: 3px;
		width: 20px;
	}
	.textarium-contaner .sorter:hover {
		color: #888
	}

	.textarium-contaner .item {
		background: #fff;
		border-bottom: 1px solid #eee;
		padding: 10px 15px;
		overflow: hidden;
		transition: height, opacity 100ms linear;
	}

	.textarium-contaner .item.ui-sortable-helper {
		border: none;
		box-shadow: 0 0 0px 1px #aaa;
		height: 20px !important;
		opacity: .7;
		overflow: hidden;
	}

	.textarium-contaner .item:last-child {
		border-bottom: none;
	}

	.textarium-contaner .ui-state-highlight { 
		background: #eee;
		border: 3px dashed #ddd;
		height: 40px; 
		line-height: 1.2em; 
	}

	.textarium-contaner .delete-item {
		clear: both;
		float: left;
		margin-top: 5px;
		margin-left: 29px;
	}

	.textarium-contaner .text {
		margin-bottom: 10px;
		margin-left: 30px;
	}

	.textarium-contaner label {
		display: block;
		vertical-align: top; 
	}

	.textarium-contaner input[type="text"],
	.textarium-contaner textarea {
		max-width: 99%;
		min-width: 99%;
		width: 99%;
	}
</style>
<a id="textarium-add-item" class="button-primary" href="#"><?php _e( 'Add', BONNO_TEXTDOMAIN ); ?></a>
<a id="textarium-delete-items" class="button-secondary" href="#"><?php _e( 'Delete all', BONNO_TEXTDOMAIN ); ?></a>
<div class="textarium-item-template">
	<div class="item">
		<div class="sorter dashicons dashicons-image-flip-vertical" title="<?php _e( 'Drag to sort items', BONNO_TEXTDOMAIN ); ?>"></div>
		<?php if ( count( $this->fields ) ) { ?>
			<div class="texts">
				<?php foreach ( $this->fields as $field_name => $text_field ) { ?>
					<div class="text">
						<?php if ( isset($text_field['title'] ) ) { ?>
							<label><?php echo $text_field['title']; ?></label>
						<?php } ?>
						<?php if ( isset( $text_field['type'] ) && $text_field['type'] == 'textarea' ) { ?>
							<textarea data-name="_textarium[%index%][<?php echo $field_name; ?>]"></textarea>
						<?php } else { ?>
							<input type="text" data-name="_textarium[%index%][<?php echo $field_name; ?>]" />
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<a href="#" class="delete-item button-secondary"><?php _e( 'Delete', BONNO_TEXTDOMAIN ); ?></a>
	</div>
</div>
<?php
	$textarium_container_class = '';
	if ( isset( $this->fields['container-class'] ) ) {
		$textarium_container_class = $this->fields['container-class'];
	}
?>
<div class="textarium-contaner <?php echo $textarium_container_class; ?>">
	<?php if ( is_array( $meta ) && count( $meta ) ) { ?>
		<?php foreach( $meta as $index => $item ) {?>
			<div class="item">
				<div class="sorter dashicons dashicons-image-flip-vertical" title="<?php _e( 'Drag to sort items', BONNO_TEXTDOMAIN ); ?>"></div>
				<?php if ( count( $this->fields ) ) { ?>
					<div class="texts">
						<?php foreach ( $this->fields as $field_name => $text_field ) { ?>
							<div class="text">
								<?php if ( isset($text_field['title'] ) ) { ?>
									<label><?php echo $text_field['title']; ?></label>
								<?php } ?>
								<?php if ( isset( $text_field['type'] ) && $text_field['type'] == 'textarea' ) { ?>
									<textarea name="_textarium[<?php echo $index; ?>][<?php echo $field_name; ?>]"><?php echo $item[$field_name]; ?></textarea>
								<?php } else { ?>
									<input type="text" name="_textarium[<?php echo $index; ?>][<?php echo $field_name; ?>]" value="<?php echo $item[$field_name]; ?>" />
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


			$('#textarium-add-item').click(function() {
				var cloned = $('.textarium-item-template .item').clone( true );
				var index = randomInt();
				$.each(cloned.find('input, select, textarea'), function(i, element) {
					$(element).attr('name', $(element).attr('data-name').replace('%index%', index));
				});
				cloned.prependTo( ".textarium-contaner" );
				return false;
			});

			/* Media upload */
			var original_send_to_editor = window.send_to_editor;
			var currentUploadContainer = null;

			$('.textarium-contaner').on('click', '.upload-image', function (e) { 

				window.send_to_editor = function(html) {
					imgurl = $('img', html).attr('src');
					currentUploadContainer.find('input').val(imgurl);
					currentUploadContainer.addClass('file-loaded');
					currentUploadContainer.find('img').attr('src', imgurl);
					tb_remove();
					window.send_to_editor = original_send_to_editor;
				}

				currentUploadContainer = $(this).parents('.image');
				tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				return false;
			});

			$('.textarium-contaner').on('click', '.delete-item', function (e) {
				if (confirm('<?php _e( "Are you sure you want to delete this item?", BONNO_TEXTDOMAIN ); ?>')) {
					$(this).parents('.item').remove();
				}
				return false;
			})

			$('#textarium-delete-items').click(function() {
				if (confirm('<?php _e( "Are you sure you want to delete all items?", BONNO_TEXTDOMAIN ); ?>')) {
					$('.textarium-contaner').empty();
				}
				return false;
			});

			$( ".textarium-contaner" ).sortable({
				placeholder: "ui-state-highlight",
				handle: ".sorter"
			});
		})
	})(jQuery);
</script>