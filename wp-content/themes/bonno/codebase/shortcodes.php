<?php

/**
 * [button] shortcode
 */
function shortcode_button( $atts, $content = null ) {
	$default_type = 'solid-color';
	$types = array( 'solid-color', 'stroke-color', 'solid-black', 'stroke-black', 'solid-gray', 'stroke-gray' );
	$class_map = array(
		'solid-color' => 'hover',
		'stroke-color' => '',
		'solid-black' => 'transparent hover',
		'stroke-black' => 'transparent',
		'solid-gray' => 'free hover',
		'stroke-gray' => 'free'
	);

	$atts = shortcode_atts( array(
		'link' => '',
		'newtab' => '',
		'type' => $default_type
	), $atts );

	extract( $atts );

	if ( isset( $background ) && $background != 'gray' ) {
		$background = 'gray';
	}

	if ( !in_array( $type, $types ) ) {
		$type = $default_width;
	}

	$target = $newtab ? 'target="_blank"' : '' ;

	$markup = '<a class="button ' . $class_map[$type] . '" href="' . $link . '" ' . $target . '>' . $content . '</a>';

	return $markup;
}

add_shortcode('button', 'shortcode_button');


/**
 * [carousel] shortcode
 */
function shortcode_carousel( $atts, $content = null ) {
	$default_effect = 'crossfade';
	$effects = array( 'crossfade', 'slide', 'fade' );

	$atts = shortcode_atts( array(
		'effect' => $default_effect
	), $atts );

	if ( !in_array( $atts['effect'], $effects ) ) {
		$atts['effect'] = $default_effect;
	}

	$markup = '<div class="section slider history"><ul data-auto="false" data-fx="' . $atts['effect'] . '" data-circular="false">';
	$markup .= do_shortcode( $content );
	$markup .= '</ul><div class="navbar"><a href="#" class="arrow prev"></a><a href="#" class="arrow next"></a></div></div>';

	return $markup;
}

add_shortcode('carousel', 'shortcode_carousel');


/**
 * [client_logos] shortcode
 */
function shortcode_client_logos( $atts, $content = null ) {
	$default_effect = 'fade';
	$effects = array( 'crossfade', 'slide', 'fade' );

	$atts = shortcode_atts( array(
		'id' => '',
		'effect' => $default_effect
	), $atts );

	if ( !in_array( $atts['effect'], $effects ) ) {
		$atts['effect'] = $default_effect;
	}

	$atts['id'] = str_replace(' ', '', $atts['id']);
	$atts['id'] = explode(',', $atts['id']);
	if ( count($atts['id']) ) {
		foreach ($atts['id'] as $index => $id) {
			$atts['id'][$index] = (int)$id;
			if ( !$atts['id'][$index] ) {
				unset( $atts['id'][$index] );
			}
		}
	}

	$query_args = array(
		'post_type' => 'client',
		'posts_per_page' => -1
	);

	if ( count( $atts['id'] ) ) {
		$query_args['post__in'] = $atts['id'];
		$query_args['orderby'] = 'post__in';
		$query_args['ignore_sticky_posts'] = true;
	}

	$clients = get_posts( $query_args );
	if ( !count( $clients) ) {
		return '';
	}
	global $post;
	$markup = '<div class="section slider logos"><div class="sliderwrap"><ul data-auto="false" data-fx="' . $atts['effect'] . '">';
	foreach ( $clients as $post ) { setup_postdata( $post );
		$markup .= '<li>';
		if ( $link = get_post_meta( get_the_ID(), '_link', true ) ) {
			$markup .= '<a href="' . $link .'">';
		}
		$markup .= '<img src="' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' ) .  '" alt="' . $post->post_title . '" />';
		if ( $link ) {
			$markup .= '</a>';
		}
		$markup .= '</li>';

	}
	$markup .= '</ul></div><div class="navbar"><a href="#" class="arrow prev"></a><a href="#" class="arrow next"></a><nav class="pagination"></nav></div></div>';
	wp_reset_query();
	return $markup;
}

add_shortcode('client_logos', 'shortcode_client_logos');


/**
 * Contact Form 7 shortcode fallback
 */
if ( !shortcode_exists( 'contact-form-7' ) ) {
	add_shortcode('contact-form-7', 'bonno_contact_form_7_notice' );
}

function bonno_contact_form_7_notice() {
	return '<p>' . __( 'Please, install "Contact Form 7" plugin to use this feedback form.', BONNO_TEXTDOMAIN ) . '</p>';
}


/**
 * [divider] shortcode
 */
function shortcode_divider( $atts, $content = null ) {

	if ( is_array($atts) && in_array( 'empty', $atts ))
		return '<div class="heading section"></div>';

	$atts = shortcode_atts( array(
		'title' => '',
		'subtitle' => '',
		'button' => '',
		'link' => '',
		'style' => '',
	), $atts );

	extract( $atts );
	$class = '';
	if ( !$title && !$subtitle ) {
		$class = ' no-titles';
	}

	if ( $title && !$subtitle ) {
		$class .= ' no-subtitle';
	}

	if ( !$title && $subtitle ) {
		$class .= ' no-title';
	}

	if ( $button && $link ) {
		$class .= ' with-button';
	}

	$markup = '<div class="heading section' . $class . '">';

	if ( $title || $subtitle ) {
		$markup .= '<div class="title">';
	}
	if ( $title ) {
		$markup .= '<h3>' . $title . '</h3>';
	}

	if ( $subtitle ) {
		$markup .= '<h6>' . $subtitle . '</h6>';
	}
	if ( $title || $subtitle ) {
		$markup .= '</div>';
	}

    $button_class = '';
    if ( 'solid' === $style ) {
        $button_class = 'hover';
    }

	if ( $button && $link ) {
		$markup .= '<div class="button-wrapper"><div><a class="button ' . $button_class . '" href="' . $link . '">'. $button . '</a></div></div>';
	}

	$markup .= '<hr style="width: 100%; left: 0px;"></div>';

	return $markup;
}

add_shortcode('divider', 'shortcode_divider');


/**
 * [extra_text] shortcode
 */
function shortcode_extra_text( $atts, $content = null ) {
	global $post;
	$textarium = meta( '_textarium', false );
	$markup = '';
	if ( is_array( $textarium ) && !empty( $textarium ) ) {
		$markup = '<table class="extra-text">';
		foreach ( $textarium as $textarium_item ) {
			$markup .= '<tr>';
			if ( !empty( $textarium_item['title'] ) ) {
				$markup .= '<th>' . $textarium_item['title'] .'</th>';
			}
			$markup .= '<td>';
			if ( !empty( $textarium_item['text'] ) ) {
				$markup .= '<nav>' . nl2span( do_shortcode( $textarium_item['text'] ) ) . '</nav>';
			}
			$markup .=  '</td></tr>';
		}
		$markup .= '</table>';
	}

	return $markup;
}

add_shortcode('extra_text', 'shortcode_extra_text');


/**
 * [gallery] shortcode
 */
function filter_gallery( $value = '', $atts ) {

	extract( shortcode_atts( array(
		'ids' => '',
		'order'      => 'ASC',
		'orderby'    => 'post__in',
		'columns'    => 3,
	), $atts ) );

	$markup = ' ';

	if ( !$ids ) {
		global $post;
		if ( !( $post instanceof WP_Post ) ) {
			return $markup;
		}
		$attachments = get_children( array(
			'post_parent' => $post->ID,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image'
			)
		);
		$ids = array_keys( $attachments );
		if ( !$ids ) {
			return $markup;
		}
	} else {
		$ids = explode( ',', $ids );
	}

	if ( 'RAND' == $order )
		$orderby = 'none';

	$images = get_posts( array(
			'post__in' => $ids,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'posts_per_page' => -1,
			'order' => $order,
			'orderby' => $orderby
		)
	);
	if ( $images && is_array($images) ) {
		$markup = '<div class="gallery gallery-columns-' . $columns . '">';
		foreach ( $images as $image ) {
			$title = ( $title = wptexturize( $image->post_excerpt ) ) ? $title : '' ;
			$src = wp_get_attachment_metadata($image->ID, true );

			$markup .= '<dl class="gallery-item" style="background-image: url(' . $image->guid . '); ">';
			$markup .= '<dt>';
			$markup .= '<span class="mask' . ( !$title ? ' no-caption': '' ) . '" >';
			$markup .= '<a href="' . $image->guid . '" title="' . $title . '">' . $title . '</a>';
			$markup .= '</span>';
			$markup .= '</dt>';
			$markup .= '</dl>';
		}
		$markup .= '</div>';
	}

	return $markup;
}

add_filter('post_gallery', 'filter_gallery', 10, 2);


/**
 * [row] shortcode
 */
function shortcode_row( $atts, $content = null ) {
	return '<div class="section">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('row', 'shortcode_row');


/**
 * [column] shortcode
 */
function shortcode_column( $atts, $content = null ) {

	$default_width = '1';
	$widths = array( '1/2', '1/3', '2/3', '1/4', '3/4', '1/6', '1/12', '2/12', '3/12', '4/12', '5/12', '6/12', '7/12', '8/12', '9/12', '10/12', '11/12', '12/12' );

	$default_align = '';
	$aligns = array( 'left', 'center', 'right' );

	$atts = shortcode_atts( array(
		'width' => $default_width,
		'align' => $default_align
	), $atts );

	if ( !in_array( $atts['width'], $widths ) ) {
		$atts['width'] = $default_width;
	}

	if ($atts['width'] == '1') {
		$column_class = ' span_12_of_12';
	} else {
		$width_parts = explode( '/', $atts['width'] );
		$column_class = ' span_' . ( $width_parts[0] * 12 / $width_parts[1] ) . '_of_12';
	}

	if ( !in_array( $atts['align'], $aligns ) ) {
		$atts['align'] = '';
	}

	$markup = '<div class="col' . $column_class . ( $atts['align'] ? ' aligned ' . $atts['align'] : '' ) . '">' . do_shortcode( $content ) . '</div>';

	return $markup;
}

add_shortcode('column', 'shortcode_column');


/**
 * [map] shortcode
 */
function shortcode_map( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'lat' => '',
		'long' => '',
		'zoom' => '',
		'height' => ''
	), $atts );

	extract( $atts );

	if ( !$lat || !$long ) {
		return '';
	}

	$zoom = (int)$zoom;
	if (!$zoom || $zoom < 1) {
		$zoom = 13;
	}
	if ($zoom > 26 ) {
		$zoom = 26;
	}

	$height = (int)$height;
	if (!$height ) {
		$style = '';
	} else {
		$style = 'style="height:' . $height . 'px;"';
	}

	return '<div class="section map" id="map" ' . $style . ' data-lat="' . $lat . '" data-long="' . $long . '" data-zoom="' . $zoom . '"></div>';
}

add_shortcode('map', 'shortcode_map');


/**
 * [increment] shortcode
 */
function shortcode_increment( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'num' => 0,
		'inc' => 1
	), $atts );

	$atts['num'] = (int)$atts['num'];
	$atts['inc'] = (int)$atts['inc'];

	if ( !$atts['num'] ) {
		return $atts['num'] = 0;
	}

	if ( !$atts['inc'] < 0 ) {
		$atts['inc'] = 1;
	}

	return '<div class="increment"><div data-num="' . $atts['num'] . '" data-increment="' . $atts['inc'] . '" class="num">0</div></div>';
}

add_shortcode('increment', 'shortcode_increment');


/**
 * [heading] shortcode
 */
function shortcode_heading( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'icon' => null,
		'text' => ''
	), $atts );

	extract( $atts );

	if ( !$text && !$icon) {
		return '';
	}

	$markup = '<div class="heading section"><h1>';
	if ($icon) {
		$markup .='<img src="' . bonno_ajust_subfolder_icon_path( $icon ) . '">';
	}
	$markup .= $text . '</h1><hr></div>';
	return $markup;
}

add_shortcode('heading', 'shortcode_heading');


/**
 * [profile] shortcode
 */
function shortcode_profile( $atts, $content = null ) {
	return '<div class="profile">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('profile', 'shortcode_profile');


/**
 * [group] shortcode
 */
function shortcode_group( $atts, $content = null ) {
	return '<div class="group">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('group', 'shortcode_group');


/**
 * [testimonials] shortcode
 */
function shortcode_testimonials( $atts, $content = null ) {
	return '<div class="testimonials">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('testimonials', 'shortcode_testimonials');


/**
 * [icon] shortcode
 */
function shortcode_icon( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'icon' => null,
		'link' => '',
		'size' => ''
	), $atts );
	extract( $atts );
	$markup = '';
	if ( $link ) {
		$markup .= '<a href="' . $link . '">';
	}
	if ( (int)$size )
		$size = 'style="font-size:' . (int)$size . 'px;" ';
	if ( $icon ) {
		$markup .= '<i class="' . $icon . '" ' . $size . '></i>';
	}
	if ( $link ) {
		$markup .= '</a>';
	}


	return $markup . do_shortcode( $content );
}

add_shortcode('icon', 'shortcode_icon');


/**
 * [item] shortcode
 */
function shortcode_item( $atts, $content = null ) {
	return '<li>' . do_shortcode( $content ) . '</li>';
}

add_shortcode('item', 'shortcode_item');


/**
 * [link] shortcode
 */
function shortcode_link( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'href' => '',
		'id' => ''
	), $atts );
	extract( $atts );
	$id = (int)$id;
	if ($id) {
		$href = get_permalink( $id );
	}
	if ( $href ) {
		return '<a href="' . $href . '">' . $content . '</a>';
	}
	return '';
}

add_shortcode('link', 'shortcode_link');


/**
 * [photo_gallery] shortcode
 */
function shortcode_photo_gallery( $atts, $content = null ) {
	global $post;

	$default_effect = 'crossfade';
	$effects = array( 'crossfade', 'slide', 'fade' );

	$atts = shortcode_atts( array(
		'id' => 0,
		'effect' => $default_effect,
		'height' => (int)get_option( 'bonno_gallery_preview_height', 500 )
	), $atts );

	$atts['id'] = (int)$atts['id'];

	if ( !$atts['id'] ) {
		$atts['id'] = $post->ID;
	}

	$slides = get_post_meta( $atts['id'], '_imaginarium', 1);

	if ( !is_array( $slides) || !count( $slides ) ) {
		return '';
	}

	if ( (int)$atts['height'] < 1) {
		$atts['height'] = 500;
	}

	if ( !in_array( $atts['effect'], $effects ) ) {
		$atts['effect'] = $default_effect;
	}

	$markup = '<div class="section slider popupslider"><ul data-auto="false" data-fx="' . $atts['effect'] . '">';
	foreach ( $slides as $slide ) {
		if ( !$slide['text'] ) {
			$slide['text'] = '&nbsp;';
		}
		$markup .= '<li>';
		$markup .= '<img src="' . get_image_src_size( wp_get_attachment_url( $slide['preview'], 'full' ), 400, $atts['height']) .  '" />';
		$markup .= '<div class="mask"><a href="' . wp_get_attachment_url( $slide['image'], 'full' ) . '" title="' . $slide['text'] . '">' . $slide['text'] . '</a></div></li>';
	}
	$markup .= ' </ul><div class="navbar"><nav class="pagination"></nav></div></div>';
	return $markup;
}

add_shortcode('photo_gallery', 'shortcode_photo_gallery');


/**
 * [tabs] shortcode
 */
function shortcode_tabs( $atts, $content = null ) {
	return '<div class="section oneslider pricing"><ul>' . do_shortcode( $content ) . '</ul><div class="navbar"><nav class="pagination lined"></nav></div></div>';
}

add_shortcode('tabs', 'shortcode_tabs');


/**
 * [tab] shortcode
 */
function shortcode_tab( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'name' => ''
	), $atts );


	return '<li class="aligned center" data-period="' . $atts['name'] . '"><div class="equal">' . do_shortcode( $content ) . '</div></li>';
}

add_shortcode('tab', 'shortcode_tab');


/**
 * [plan] shortcode
 */
function shortcode_plan( $atts, $content = null ) {

	$default_width = false;
	$widths = array( '1/2', '1/3', '2/3', '1/4', '3/4', '1/6', '1/12' );

	$atts = shortcode_atts( array(
		'background' => '',
		'currency' => '',
		'currency_title' => '',
		'name' => '',
		'cost' => '',
		'title' => '',
		'width' => $default_width
	), $atts );

	extract( $atts );

	if ( $background && $background != 'gray' )
		$background = 'gray';

	if ( !in_array( $width, $widths ) )
		$width = $default_width;

	if ($width) {
		$width_parts = explode( '/', $width );
		$column_class = 'span_' . ( $width_parts[0] * 12 / $width_parts[1] ) . '_of_12';
	} else {
		$column_class = 'eq';
	}

	$markup = '<div data-class="' . $column_class . '" data-title="' . $title . '" class="pricing col ' . $column_class . ' ' . ( $background ? ' highlight' : '' ) . ( $background && $title ? ' border' : '' ) . '"><h3>' . $name . '</h3><div class="num"><sup>' . $currency . '</sup><ins>' . $cost . '</ins></div><h6>' . $currency_title . '</h6>' . do_shortcode( $content ) . '</div>';

	return $markup;
}

add_shortcode('plan', 'shortcode_plan');


/**
 * [slider_photo] shortcode
 */
function shortcode_slider_photo( $atts, $content = null ) {
	$default_effect = 'fade';
	$effects = array( 'crossfade', 'slide', 'fade' );

	$default_navs = 'none';
	$navs = array( 'pagination', 'arrows', 'none' );

	$default_height = (int)get_option( 'bonno_slide_height', 500 );

	if ( !$default_height ) {
		$default_height = 500;
	}

	$atts = shortcode_atts( array(
		'id' => '',
		'effect' => $default_effect,
		'navs' => $default_navs,
		'height' => $default_height
	), $atts );

	global $post;

	if ( !$atts['id'] ) {
		$atts['id'] = $post->ID;
	}

	$slides = get_post_meta( $atts['id'], '_imaginarium', 1);

	if ( !is_array( $slides) || !count( $slides ) ) {
		return '';
	}

	if ( (int)$atts['height'] < 1) {
		$atts['height'] = $default_height;
	}

	$atts['id'] = (int)$atts['id'];

	if ( !in_array( $atts['effect'], $effects ) ) {
		$atts['effect'] = $default_effect;
	}

	$atts['navs'] = str_replace( ' ', '', $atts['navs'] );
	$atts['navs'] = explode(',', $atts['navs']);

	$markup = '<div class="section oneslider"><ul data-auto="true" data-fx="' . $atts['effect'] . '">';
	foreach ( $slides as $slide ) {
		$markup .= '<li>';

		if ( !empty( $slide['link'] ) ) {
			$markup .= '<a href="' . $slide['link'] . '">';
		}
		$image_name = wp_get_attachment_url( $slide['image'], 'full' );
		$markup .= '<img src="' . get_image_src_size( $image_name, 1200, $atts['height']) .  '" />';
		if ( !empty( $slide['text'] ) ) {
			if ( empty($slide['color']) ) {
				$slide['color'] = '#fff';
			}
			$markup .= '<span class="title" style="color: ' . $slide['color'] . '">' . $slide['text'] . '</span>';
		}
		if ( !empty( $slide['link'] )  ) {
			$markup .= '</a>';
		}
		$markup .= '</li>';
	}
	$markup .= ' </ul>';

	if ( !in_array( 'none', $atts['navs'] ) ) {
		$markup .= '<div class="navbar">';
		if ( in_array( 'arrows', $atts['navs'] ) ) {
			$markup .= '<a href="#" class="arrow prev"></a><a href="#" class="arrow next"></a>';
		}
		if ( in_array( 'pagination', $atts['navs'] ) ) {
			$markup .= '<div class="pagination"></div>';
		}
		$markup .= '</div>';
	}

	$markup .= '</div>';

	return $markup;
}

add_shortcode('slider_photo', 'shortcode_slider_photo');


/**
 * [team] shortcode
 */
function shortcode_team( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'id' => ''
	), $atts );

	$atts['id'] = str_replace(' ', '', $atts['id']);
	$atts['id'] = explode(',', $atts['id']);
	if ( count($atts['id']) ) {
		foreach ($atts['id'] as $index => $id) {
			$atts['id'][$index] = (int)$id;
			if ( !$atts['id'][$index] )
				unset( $atts['id'][$index] );
		}
	}

	$query_args = array(
		'post_type' => 'member',
		'posts_per_page' => -1
	);

	if ( count( $atts['id'] ) ) {
		$query_args['post__in'] = $atts['id'];
		$query_args['orderby'] = 'post__in';
		$query_args['ignore_sticky_posts'] = true;
	}

	$members = get_posts( $query_args );
	if ( !count( $members) )
		return '';
	global $post;
	$markup = '<div class="section team aligned center">';
	foreach ( $members as $index => $post ) { setup_postdata( $post );
		$content = trim( get_the_content() );
		if ( $content ) {
			$no_content = false;
			$content = '<div class="expandteam"><ins class="corner"></ins><div class="section"><a href="#" class="close"></a></div><div class="inner">' . do_shortcode( $content ) . '</div></div>';
		} else {
			$no_content = true;
		}

		if ( $index == 0 || ( $index + 1 ) % 4 == 1)
			$markup .= '<div class="group">';
		$markup .= '<div class="col span_3_of_12 profile ' . ( $no_content ? 'no_content' : '' ) . '"><a class="img" href="#"><span class="circle">' . wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), array( 220, 220 ) ) . '</span></a><h4>' . get_the_title() . '</h4><h6>' . get_post_meta( get_the_ID(), '_position', true ) . '</h6>' . $content . '</div>';
		if ( $index != 0 && ( $index + 1 ) % 4 == 0 )
			$markup .= '</div>';
	}
	$markup .= '</div>';
	wp_reset_query();
	return $markup;
}

add_shortcode('team', 'shortcode_team');


/**
 * [work_title] shortcode
 */
function shortcode_work_title( $atts, $content = null ) {
	global $post;
	return '<h3 class="color">' . $post->post_title . '</h3>';
}

add_shortcode('work_title', 'shortcode_work_title');


/**
 * [work_category] shortcode
 */
function shortcode_work_category( $atts, $content = null ) {
	global $post;
	return '<h6>' . implode( ', ', wp_get_post_terms( $post->ID, 'workcategory', array( "fields" => "names" ) ) ) . '</h6>';
}

add_shortcode('work_category', 'shortcode_work_category');


/**
 * [works_filter] shortcode
 */
function shortcode_works_filter( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'id' => ''
	), $atts );

	$atts['id'] = str_replace(' ', '', $atts['id']);
	$atts['id'] = explode(',', $atts['id']);
	if ( count($atts['id']) ) {
		foreach ($atts['id'] as $index => $id) {
			$atts['id'][$index] = (int)$id;
			if ( !$atts['id'][$index] ) {
				unset( $atts['id'][$index] );
			}
		}
	}

	$args = array();

	if ( count( $atts['id'] ) ) {
		$args['include'] = $atts['id'];
		$args['orderby'] = 'include';
	}

	$categories = get_terms( 'workcategory', $args );

	if ( !count( $categories ) ) {
		return '';
	}

	$all_works_filter_label = get_option( 'bonno_works_filter_all_label', 'All works' );
	if ( !trim( $all_works_filter_label ) ) {
		$all_works_filter_label = 'All Works';
	}
	$markup = '<div class="section"><ul class="nav-portfolio"><li><a href="#all" class="filter" data-filter="all">' . $all_works_filter_label . '<ins>&nbsp;</ins></a></li>';

	foreach ($categories as $category) {
		$markup .= '<li><a href="#' . $category->slug .'" class="filter" data-filter=".' . $category->slug . '">' . $category->name .'<ins>&nbsp;</ins></a></li>';
	}

	$markup .= '</ul></div>';

	return $markup;
}

add_shortcode('works_filter', 'shortcode_works_filter');


/**
 * [works] shortcode
 */
function shortcode_works( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'id' => '',
		'work_id' => ''
	), $atts );

	$atts['id'] = str_replace(' ', '', $atts['id']);
	$atts['id'] = explode(',', $atts['id']);
	if ( count($atts['id']) ) {
		foreach ($atts['id'] as $index => $category) {
			$atts['id'][$index] = (int)$category;
			if ( !$atts['id'][$index] ) {
				unset( $atts['id'][$index] );
			}
		}
	}

	$atts['work_id'] = str_replace(' ', '', $atts['work_id']);
	$atts['work_id'] = explode(',', $atts['work_id']);
	if ( count($atts['work_id']) ) {
		foreach ($atts['work_id'] as $index => $id) {
			$atts['work_id'][$index] = (int)$id;
			if ( !$atts['work_id'][$index] ) {
				unset( $atts['work_id'][$index] );
			}
		}
	}

	$args = array(
		'post_type' => 'work',
		'posts_per_page' => -1
	);

	if ( count( $atts['work_id'] ) ) {
		$args['post__in'] = $atts['work_id'];
		$args['orderby'] = 'post__in';
	}

	if ( count( $atts['id'] ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'workcategory',
				'field' => 'term_id',
				'terms' => $atts['id']
			)
		);
		$args['ignore_sticky_posts'] = true;
	}

	$works = get_posts( $args );
	if ( !count( $works) ) {
		return '';
	}
	global $post;
	$markup = '<div class="section portfolio works-container">';
	foreach ( $works as $post ) { setup_postdata( $post );
		$markup .= '<div class="work mix ' . bonno_work_categories_slugs() .'">' . wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), apply_filters( 'bonno_works_thumbnail_size', array( 300, 200 ) ) ) . '<div class="mask"><a href="' . get_permalink() .'">' . get_the_title() . '</a></div></div>';
	}
	$markup .= '</div>';
	wp_reset_query();
	return $markup;
}

add_shortcode('works', 'shortcode_works');


/**
 * [featured_works] shortcode
 */
function shortcode_featured_works( $atts, $content = null ) {
	$featured_works = get_posts( array(
		'posts_per_page' => -1,
		'meta_key' => '_featured',
		'meta_value' => 1,
		'post_type' => 'work'
	) );
	if ( !count( $featured_works) ) {
		return '';
	}
	global $post;
	$markup = '<div class="section portfolio works-container">';
	foreach ( $featured_works as $post ) { setup_postdata( $post );
		$markup .= '<div class="work mix ' . bonno_work_categories_slugs() .'"><img src="' . get_image_src_size( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' ), 300, 200 ) .  '" /><div class="mask"><a href="' . get_permalink() .'">' . get_the_title() . '</a></div></div>';
	}
	$markup .= '</div>';
	wp_reset_query();
	return $markup;
}

add_shortcode('featured_works', 'shortcode_featured_works');
