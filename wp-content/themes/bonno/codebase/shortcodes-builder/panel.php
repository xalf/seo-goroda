<?php
	global $post;
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Shortcodes</title>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo CODEBASE_URI . '/shortcodes-builder/assets/css/style.css'; ?>">
</head>
<body>
	<div class="menu show-on-load">
		<a href="#" data-group="markup"><?php _e( 'Markup', BONNO_TEXTDOMAIN ); ?></a>
		<a href="#" data-group="clients"><?php _e( 'Clients', BONNO_TEXTDOMAIN ); ?></a>
		<a href="#" data-group="team"><?php _e( 'Team', BONNO_TEXTDOMAIN ); ?></a>
		<a href="#" data-group="elements"><?php _e( 'Elements', BONNO_TEXTDOMAIN ); ?></a>
		<a href="#" data-group="iconset"><?php _e( 'Icons', BONNO_TEXTDOMAIN ); ?></a>
		<a href="#" data-group="containers"><?php _e( 'Containers', BONNO_TEXTDOMAIN ); ?></a>
		<a href="#" data-group="pricing"><?php _e( 'Pricing', BONNO_TEXTDOMAIN ); ?></a>
		<a href="#" data-group="works"><?php _e( 'Works', BONNO_TEXTDOMAIN ); ?></a>
	</div>
	<div id="bonno-shortcodes-container" class="wrap show-on-load">
		<table>
			<tr data-group="markup">
				<th class="label"><?php _e( 'Row', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="row" data-shortcode-enclosing="true"><?php _e( 'Insert [row] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="markup">
				<th class="label"><?php _e( 'Column', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="radio">
						<h4><?php _e( 'Width', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="column-width-1-2">
							<input checked="checked" type="radio" id="column-width-1-2" name="column_width" data-key="width "value="1/2"> <?php _e( '1/2 of row', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="column-width-1-3">
							<input type="radio" id="column-width-1-3" name="column_width" data-key="width "value="1/3"> <?php _e( '1/3 of row', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="column-width-1-4">
							<input type="radio" id="column-width-1-4" name="column_width" data-key="width "value="1/4"> <?php _e( '1/4 of row', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="column-width-3-4">
							<input type="radio" id="column-width-3-4" name="column_width" data-key="width "value="3/4"> <?php _e( '3/4 of row', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<div class="param" data-type="radio">
						<h4><?php _e( 'Text align', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="column-align-auto">
							<input checked="checked" type="radio" id="column-align-auto" name="column_align" data-key="align" data-skip="true"> <?php _e( 'Auto', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="column-align-left">
							<input type="radio" id="column-align-left" name="column_align" data-key="align "value="left"> <?php _e( 'Left', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="column-align-center">
							<input type="radio" id="column-align-center" name="column_align" data-key="align "value="center"> <?php _e( 'Center', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="column-align-right">
							<input type="radio" id="column-align-right" name="column_align" data-key="align " value="right"> <?php _e( 'Right', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="column" data-shortcode-enclosing="true"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[column width ="1/2"][/column]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="markup">
				<th class="label"><?php _e( 'Divider', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="text">
						<h4><?php _e( 'Title', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" name="divider-title" data-may-be-empty="true" data-key="title" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Subtitle', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" name="divider-subtitle" data-may-be-empty="true" data-key="subtitle" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Button text', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" name="divider-button" data-may-be-empty="true" data-key="button" />
					</div>
                    <div class="param" data-type="radio">
						<h4><?php _e( 'Button Style', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="divider-button-style-border">
							<input checked="checked" type="radio" id="divider-button-style-border" name="style" data-key="style" data-skip="true"> <?php _e( 'Border', BONNO_TEXTDOMAIN ); ?>
						</label>
                        <label for="divider-button-style-solid">
							<input type="radio" id="divider-button-style-solid" name="style" data-key="style" value="solid"> <?php _e( 'Solid', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Link', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" name="divider-link" data-may-be-empty="true" data-key="link" />
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="divider"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[divider]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="elements">
				<th class="label"><?php _e( 'Button', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="content">
						<h4><?php _e( 'Text', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" name="button-content" data-may-be-empty="true" value="" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Link', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" name="button-link" data-key="link" data-may-be-empty="true" value="" />
					</div>
					<div class="param" data-type="radio">
						<h4><?php _e( 'Type', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="button-type-solid-color">
							<input checked="checked" type="radio" id="button-type-solid-color" name="button-type" data-key="type" value="solid-color"> <?php _e( 'Solid color', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="button-type-stroke-color">
							<input type="radio" id="button-type-stroke-color" name="button-type" data-key="type" value="stroke-color"> <?php _e( 'Stroke color', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="button-type-solid-black">
							<input type="radio" id="button-type-solid-black" name="button-type" data-key="type" value="solid-black"> <?php _e( 'Solid black', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="button-type-stroke-black">
							<input type="radio" id="button-type-stroke-black" name="button-type" data-key="type" value="stroke-black"> <?php _e( 'Stroke black', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="button-type-solid-gray">
							<input type="radio" id="button-type-solid-gray" name="button-type" data-key="type" value="solid-gray"> <?php _e( 'Solid gray', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="button-type-stroke-gray">
							<input type="radio" id="button-type-stroke-gray" name="button-type" data-key="type" value="stroke-gray"> <?php _e( 'Stroke gray', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<div class="param" data-type="check">
						<h4><?php _e( 'Open in new window/tab', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="button-target-blank">
							<input type="checkbox" id="button-target-blank" data-may-be-empty="true" data-key="newtab" value="yes" /> <?php _e( 'Yes', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="button" data-shortcode-enclosing="true"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[button type="solid-color"][/button]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="elements">
				<th class="label"><?php _e( 'Photo gallery', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="radio">
						<h4><?php _e( 'Effect', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="photo-gallery-effect-fade">
							<input checked="checked" type="radio" id="photo-gallery-effect-fade" name="photo-gallery-effect" data-key="effect" value="fade"> <?php _e( 'Fade', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="photo-gallery-effect-slide">
							<input type="radio" id="photo-gallery-effect-slide" name="photo-gallery-effect" data-key="effect" value="slide"> <?php _e( 'Slide', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="photo-gallery-effect-crossfade">
							<input type="radio" id="photo-gallery-effect-crossfade" name="photo-gallery-effect" data-key="effect" value="crossfade"> <?php _e( 'Crossfade', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Height', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-may-be-empty="true" data-key="height" />
					</div>
					<?php if ( count($photogalleries) ) { ?>
						<div class="param list" data-type="radio">
							<h4><?php _e( 'Photo galleries', BONNO_TEXTDOMAIN ); ?></h4>
							<label for="photo-gallery-0">
								<input checked="checked" type="radio" id="photo-gallery-0" name="photo-gallery-id" data-skip="true">
								<?php _e( 'Use current page/post/etc photogallery if available', BONNO_TEXTDOMAIN ); ?>
							</label>
							<?php foreach ($photogalleries as $post) { setup_postdata( $post ); ?>
								<label for="photo-gallery-<?php echo get_the_ID(); ?>">
									<input type="radio" id="photo-gallery-<?php echo get_the_ID(); ?>" name="photo-gallery-id" data-key="id" value="<?php echo get_the_ID(); ?>">
									<?php the_title(); ?>. <a class="edit-link" href="<?php echo get_edit_post_link( get_the_ID(), '' ); ?>" target="_blank"><?php _e( 'Open edit page in new tab', BONNO_TEXTDOMAIN ); ?></a>
								</label>
							<?php } ?>
						</div>
					<?php } ?>
					<a class="button buildshortcode" href="#" data-shortcode="photo_gallery"><?php _e( 'Insert', BONNO_TEXTDOMAIN ); echo ' <span>[photo_gallery effect="fade"]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="elements">
				<th class="label"><?php _e( 'Photo slider', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="radio">
						<h4><?php _e( 'Effect', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="photo-slider-effect-fade">
							<input checked="checked" type="radio" id="photo-slider-effect-fade" name="photo-slider-effect" data-key="effect" value="fade"> <?php _e( 'Fade', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="photo-slider-effect-slide">
							<input type="radio" id="photo-slider-effect-slide" name="photo-slider-effect" data-key="effect" value="slide"> <?php _e( 'Slide', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="photo-slider-effect-crossfade">
							<input type="radio" id="photo-slider-effect-crossfade" name="photo-slider-effect" data-key="effect" value="crossfade"> <?php _e( 'Crossfade', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Height', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-may-be-empty="true" data-key="height" />
					</div>
					<div class="param" data-type="check">
						<h4><?php _e( 'Navigations', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="photo-slider-navigations-pagination">
							<input checked="checked" type="checkbox" id="photo-slider-navigations-pagination" name="photo-slider-navigations" data-key="navs" value="pagination"> <?php _e( 'Pagination', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="photo-slider-navigations-arrows">
							<input checked="checked" type="checkbox" id="photo-slider-navigations-arrows" name="photo-slider-navigations" data-key="navs" value="arrows"> <?php _e( 'Arrows', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<div class="param list" data-type="radio">
						<h4><?php _e( 'Photo sliders', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="photo-slider-0">
							<input checked="checked" type="radio" id="photo-slider-0" name="photo-slider-id" data-skip="true">
							<?php _e( 'Use current page/post/etc photo slider if available', BONNO_TEXTDOMAIN ); ?>
						</label>
						<?php if ( count( $photosliders ) ) { ?>
							<?php foreach ($photosliders as $index => $post) { setup_postdata( $post ); ?>
								<label for="photo-slider-<?php echo get_the_ID(); ?>">
									<input type="radio" id="photo-slider-<?php echo get_the_ID(); ?>" name="photo-slider-id" data-key="id" value="<?php echo get_the_ID(); ?>">
									<?php the_title(); ?>. <a class="edit-link" href="<?php echo get_edit_post_link( get_the_ID(), '' ); ?>" target="_blank"><?php _e( 'Open edit page in new tab', BONNO_TEXTDOMAIN ); ?></a>
								</label>
							<?php } ?>
						<?php } ?>
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="slider_photo"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[slider_photo effect="fade"]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="elements">
				<th class="label"><?php _e( 'Carousel', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="radio">
						<h4><?php _e( 'Effect', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="carousel-effect-fade">
							<input checked="checked" type="radio" id="carousel-effect-fade" name="carousel-effect" data-key="effect" value="fade"> <?php _e( 'Fade', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="carousel-effect-slide">
							<input type="radio" id="carousel-effect-slide" name="carousel-effect" data-key="effect" value="slide"> <?php _e( 'Slide', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="carousel-effect-crossfade">
							<input type="radio" id="carousel-effect-crossfade" name="carousel-effect" data-key="effect" value="crossfade"> <?php _e( 'Crossfade', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="carousel" data-shortcode-enclosing="true"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[carousel effect="fade"][/carousel]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="elements">
				<th class="label"><?php _e( 'Extra text', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="extra_text"><?php _e( 'Insert [extra_text] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="elements">
				<th class="label"><?php _e( 'Increment', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="text">
						<h4><?php _e( 'Number', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-key="num" value="10" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Increment', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-key="inc" data-may-be-empty="true" value="1" />
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="increment"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[increment num="10" inc="1"]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="elements">
				<th class="label"><?php _e( 'Map', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="text">
						<h4><?php _e( 'Latitude', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-key="lat" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Longitude', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-key="long" />
						<div class="info"><?php _e( 'To get your coordinates visit', BONNO_TEXTDOMAIN ); ?> <a href="http://itouchmap.com/latlong.html" target="_blank">this page</a></a></div>
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Map height in pixels (default: 400)', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-key="height" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Zoom', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" name="map-zoom" data-may-be-empty="true" data-key="zoom" />
						<div class="info"><?php _e( 'Use values from 1 to 26', BONNO_TEXTDOMAIN ); ?></div>
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="map"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[map lat="" long=""]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="iconset">
				<th class="label"><?php _e( 'Icon', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="text">
						<h4><?php _e( 'Link', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-key="link" data-may-be-empty="true" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Icon', BONNO_TEXTDOMAIN ); ?></h4>
						<input id="icon-fa-name" type="text" data-key="icon" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Size in pixels', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-key="size" data-may-be-empty="true" />
					</div>
					<div class="default-icons fa-icons" data-target="icon-fa-name">
						<h4><?php _e( 'FontAwesome icons', BONNO_TEXTDOMAIN ); ?></h4>
						<div class="icons full">
							<?php foreach ($fontawesome_icons as $icon) {  ?>
								<label for="font-awesome-<?php echo $icon; ?>">
									<input type="radio" id="font-awesome-<?php echo $icon; ?>" name="icon-fa" value="<?php echo $icon; ?>">
									<span class="bonno-fa-wrapper"><span class="image <?php echo $icon; ?>"></span> <?php echo $icon; ?></span>
								</label>
							<?php } ?>
						</div>
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="icon"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[icon icon=""]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="clients">
				<th class="label"><?php _e( 'Clients Logos', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="radio">
						<h4><?php _e( 'Effect', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="cleints-logos-effect-fade">
							<input checked="checked" type="radio" id="cleints-logos-effect-fade" name="cleints-logos-effect" data-key="effect" value="fade"> <?php _e( 'Fade', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="cleints-logos-effect-slide">
							<input type="radio" id="cleints-logos-effect-slide" name="cleints-logos-effect" data-key="effect" value="slide"> <?php _e( 'Slide', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="cleints-logos-effect-crossfade">
							<input type="radio" id="cleints-logos-effect-crossfade" name="cleints-logos-effect" data-key="effect" value="crossfade"> <?php _e( 'Crossfade', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<?php if ( count($clients) ) { ?>
						<div class="param icons middle" data-type="check">
							<h4><?php _e( 'Clients', BONNO_TEXTDOMAIN ); ?></h4>
							<div class="sortable-contaner">
								<?php foreach ($clients as $post) { setup_postdata( $post ); ?>
									<label for="cleints-logos-<?php echo get_the_ID(); ?>">
										<input type="checkbox" id="cleints-logos-<?php echo get_the_ID(); ?>" name="cleints-logos-ids" data-key="id" value="<?php echo get_the_ID(); ?>">
										<span class="image"><?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?></span>
									</label>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<a class="button buildshortcode" href="#" data-shortcode="client_logos"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[client_logos effect="fade"]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="team">
				<th class="label"><?php _e( 'Teamers', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<?php if ( count($members) ) { ?>
						<div class="param icons middle" data-type="check">
							<div class="sortable-contaner">
								<?php foreach ($members as $post) { setup_postdata( $post ); ?>
									<label for="members-<?php echo get_the_ID(); ?>">
										<input type="checkbox" id="members-<?php echo get_the_ID(); ?>" name="members-ids" data-key="id" value="<?php echo get_the_ID(); ?>">
										<span class="image"><?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?></span>
									</label>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<a class="button buildshortcode" href="#" data-shortcode="team"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[team]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="containers">
				<th class="label"><?php _e( 'Profile', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="profile" data-shortcode-enclosing="true"><?php _e( 'Insert [profile] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="containers">
				<th class="label"><?php _e( 'Group', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="group" data-shortcode-enclosing="true"><?php _e( 'Insert [group] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="containers">
				<th class="label"><?php _e( 'Item', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="item" data-shortcode-enclosing="true"><?php _e( 'Insert [item] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="pricing">
				<th class="label"><?php _e( 'Tabs', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="tabs" data-shortcode-enclosing="true"><?php _e( 'Insert [tabs][/tabs] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="pricing">
				<th class="label"><?php _e( 'Tab', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="text">
						<h4><?php _e( 'Name', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-may-be-empty="true" data-key="name" />
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="tab" data-shortcode-enclosing="true"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[tab][/tab]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="pricing">
				<th class="label"><?php _e( 'Plan', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<div class="param" data-type="check">
						<h4><?php _e( 'Background', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="plan-background">
							<input type="checkbox" id="plan-background" data-may-be-empty="true" data-key="background" value="gray" /> <?php _e( 'Background value may be only "gray"', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Currency', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-may-be-empty="true" data-key="currency" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Currency title', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-may-be-empty="true" data-key="currency_title" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Name', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-may-be-empty="true" data-key="name" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Cost', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-may-be-empty="true" data-key="cost" />
					</div>
					<div class="param" data-type="text">
						<h4><?php _e( 'Title', BONNO_TEXTDOMAIN ); ?></h4>
						<input type="text" data-may-be-empty="true" data-key="title" />
					</div>
					<div class="param" data-type="radio">
						<h4><?php _e( 'Width', BONNO_TEXTDOMAIN ); ?></h4>
						<label for="plan-width-equal">
							<input checked="checked" type="radio" id="plan-width-equal" name="plan-width" data-key="width" data-skip="true"> <?php _e( 'Equal (for tabs)', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="plan-width-1-2">
							<input type="radio" id="plan-width-1-2" name="plan-width" data-key="width" value="1/2"> <?php _e( '1/2 of row', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="plan-width-1-3">
							<input type="radio" id="plan-width-1-3" name="plan-width" data-key="width" value="1/3"> <?php _e( '1/3 of row', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="plan-width-1-4">
							<input type="radio" id="plan-width-1-4" name="plan-width" data-key="width" value="1/4"> <?php _e( '1/4 of row', BONNO_TEXTDOMAIN ); ?>
						</label>
						<label for="plan-width-3-4">
							<input type="radio" id="plan-width-3-4" name="plan-width" data-key="width" value="3/4"> <?php _e( '3/4 of row', BONNO_TEXTDOMAIN ); ?>
						</label>
					</div>
					<a class="button buildshortcode" href="#" data-shortcode="plan" data-shortcode-enclosing="true"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[plan][/plan]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="works">
				<th class="label"><?php _e( 'Work title', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="work_title"><?php _e( 'Insert [work_title] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="works">
				<th class="label"><?php _e( 'Work category', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="work_category"><?php _e( 'Insert [work_category] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="works">
				<th class="label"><?php _e( 'Works filter', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<?php if ( count($workscategories) ) { ?>
						<div class="param list" data-type="check">
							<h4><?php _e( 'Categories', BONNO_TEXTDOMAIN ); ?></h4>
							<div class="sortable-contaner">
								<?php foreach ( $workscategories as $workscategory ) { ?>
									<label for="workscategory-<?php echo $workscategory->term_id; ?>">
										<input type="checkbox" id="workscategory-<?php echo $workscategory->term_id; ?>" name="works-category" data-key="id" value="<?php echo $workscategory->term_id; ?>">
										<?php echo $workscategory->name; ?>
										&nbsp;<a class="edit-link" href="<?php echo admin_url( 'edit-tags.php?action=edit&taxonomy=workcategory&tag_ID=' . $workscategory->term_id . '&post_type=work' ); ?>" target="_blank"><?php _e( 'Open edit page in new tab', BONNO_TEXTDOMAIN ); ?></a>
									</label>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<a class="button buildshortcode" href="#" data-shortcode="works_filter"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[works_filter]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="works">
				<th class="label"><?php _e( 'Works', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<?php if ( count($workscategories) ) { ?>
						<div class="param list" data-type="check">
							<h4><?php _e( 'Categories', BONNO_TEXTDOMAIN ); ?></h4>
							<div>
								<?php foreach ( $workscategories as $workscategory ) { ?>
									<label for="work-workscategory-<?php echo $workscategory->term_id; ?>">
										<input type="checkbox" id="work-workscategory-<?php echo $workscategory->term_id; ?>" name="work-works-category" data-key="id" value="<?php echo $workscategory->term_id; ?>">
										<?php echo $workscategory->name; ?>
										&nbsp;<a class="edit-link" href="<?php echo admin_url( 'edit-tags.php?action=edit&taxonomy=workcategory&tag_ID=' . $workscategory->term_id . '&post_type=work' ); ?>" target="_blank"><?php _e( 'Open edit page in new tab', BONNO_TEXTDOMAIN ); ?></a>
									</label>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<?php
						$works = get_posts( array(
							'post_type' => 'work',
							'posts_per_page' => -1
						) );
						if ( count($works) ) { ?>
							<div class="param list" data-type="check">
								<h4><?php _e( 'Works', BONNO_TEXTDOMAIN ); ?></h4>
								<div class="sortable-contaner">
									<?php foreach ( $works as $work ) { ?>
										<label for="works-<?php echo $work->ID; ?>">
											<input type="checkbox" id="works-<?php echo $work->ID; ?>" name="work_is" data-key="work_id" value="<?php echo $work->ID; ?>">
											<?php echo $work->post_title; ?>
											&nbsp;<a class="edit-link" href="<?php echo admin_url( 'post.php?post=' . $work->ID . '&action=edit' ); ?>" target="_blank"><?php _e( 'Open edit page in new tab', BONNO_TEXTDOMAIN ); ?></a>
										</label>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					<a class="button buildshortcode" href="#" data-shortcode="works"><?php _e( 'Insert', BONNO_TEXTDOMAIN); echo ' <span>[works]</span> '; _e( 'shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
			<tr data-group="works">
				<th class="label"><?php _e( 'Featured works', BONNO_TEXTDOMAIN); ?></th>
				<td>
					<a class="button buildshortcode" href="#" data-shortcode="featured_works"><?php _e( 'Insert [featured_works] shortcode', BONNO_TEXTDOMAIN ); ?></a>
				</td>
			</tr>
		</table>
		<div id="shortcode_output" data-shortcode="" data-shortcode-end="" data-params=""></div>
	</div>
	<!-- Preloader -->
	<div class="preloader"></div>
	<!-- Scripts -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo includes_url('/js/tinymce/tiny_mce_popup.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo CODEBASE_URI . '/shortcodes-builder/assets/js/script.js' ?>"></script>
</body>
</html>
