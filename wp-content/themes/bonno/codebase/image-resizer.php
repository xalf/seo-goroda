<?php

/* Image resizer */

function get_image_src_size($image_name, $width, $height) {
	return pathinfo( $image_name, PATHINFO_DIRNAME ) . '/' . pathinfo( $image_name, PATHINFO_FILENAME ) . '-' . $width . 'x' . $height . 'c.' . pathinfo($image_name, PATHINFO_EXTENSION );
}

if ( !is_multisite() ) {
	add_filter('image_downsize', 'filter_image_downsize', 99, 3);
	
	// do the dynamic resizing of the image when the 404 handler is invoked and it's for a non-existant image
	add_action('template_redirect', 'bonno_dynamic_image_404_handler');

	// prevent WP from generating resized images on upload
	add_filter('intermediate_image_sizes_advanced','dynimg_image_sizes_advanced');

	// trick WP into thinking images were generated anyway
	add_filter('wp_generate_attachment_metadata','dynimg_generate_metadata');
}

function bonno_dynamic_image_404_handler() {
	if ( !is_404() ) {
		return;
	}
	
	if ( preg_match('/(.*)-([0-9]+)x([0-9]+)(c)?\.(jpg|png|gif)/i', $_SERVER['REQUEST_URI'], $matches ) ) {
		$filename = $matches[1].'.'.$matches[5];
		$width = $matches[2];
		$height = $matches[3];
		$crop = !empty($matches[4]);
		$crop = 1;

		$uploads_dir = wp_upload_dir();
		$temp = parse_url($uploads_dir['baseurl']);
		$upload_path = $temp['path'];
		$findfile = str_replace($upload_path, '', $filename);

		$basefile = $uploads_dir['basedir'].$findfile;

		$suffix = $width.'x'.$height;
		if ($crop) {
			$suffix .='c';
		}

		if ( file_exists($basefile) ) {
			$image = wp_get_image_editor( $basefile );
			$original_sizes = getimagesize($basefile);
			if ( ! is_wp_error( $image ) ) {
				if ( !( $original_sizes[0] < $width && $original_sizes[1] < $height ) ) {
					$image->set_quality( 100 );
					$image->resize( $width, $height, $crop );
					$filename = $image->generate_filename( $suffix );
					//$image->save( $filename );
					$image->save();
				}
				status_header( 200 );
				$image->stream();
			}
			exit;
		}
	}
}


function dynimg_image_sizes_advanced($sizes) {
	global $dynimg_image_sizes;

	// save the sizes to a global, because the next function needs them to lie to WP about what sizes were generated
	$dynimg_image_sizes = $sizes;

	// force WP to not make sizes by telling it there's no sizes to make
	return array();
}

function dynimg_generate_metadata($meta) {
	global $dynimg_image_sizes;

	foreach ($dynimg_image_sizes as $sizename => $size) {
		// figure out what size WP would make this:
		$newsize = image_resize_dimensions($meta['width'], $meta['height'], $size['width'], $size['height'], $size['crop']);

		if ($newsize) {
			$info = pathinfo($meta['file']);
			$ext = $info['extension'];
			$name = wp_basename($meta['file'], ".$ext");

			$suffix = "{$newsize[4]}x{$newsize[5]}";
			if ($size['crop']) {
				$suffix .='c';
			}

			// build the fake meta entry for the size in question
			$resized = array(
				'file' => "{$name}-{$suffix}.{$ext}",
				'width' => $newsize[4],
				'height' => $newsize[5],
			);

			$meta['sizes'][$sizename] = $resized;
		}
	}

	return $meta;
}

function filter_image_downsize($ignore = false, $attachment_id = 0, $size = 'thumbnail') {
	global $_wp_additional_image_sizes;

	$attachment_id = (int) $attachment_id;
	$meta = wp_get_attachment_metadata($attachment_id);
	if ( !$meta ) {
		return;
	}
	$upload_dir = wp_upload_dir();
	$upload_dir['baseurl'];
	if ( is_array( $size ) ) {
		return array(
			$upload_dir['baseurl'] . '/' . pathinfo( $meta['file'], PATHINFO_DIRNAME ) . '/' . pathinfo( $meta['file'], PATHINFO_FILENAME ) . '-' . $size[0]. 'x' . $size[1] . '.' . pathinfo( $meta['file'], PATHINFO_EXTENSION ),
			$size[0],
			$size[1],
			true
		);
	} else {
		if ( empty( $meta['file'] ) || empty( $meta['width'] ) || empty( $meta['height'] ) ) {
			return array();
		}

		return array(
			$upload_dir['baseurl'] . '/' . $meta['file'],
			$meta['width'],
			$meta['height'],
			true
		);
	}
}