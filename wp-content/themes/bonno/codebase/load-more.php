<?php

add_action('wp_ajax_load_more', 'lm_query_posts' );
add_action('wp_ajax_nopriv_load_more', 'lm_query_posts' );


/**
*  lm_query_posts
*  Ajax Load More Public Query
*
*  @since 2.0.0
*/

function lm_query_posts() {
	$postType = (isset($_GET['postType'])) ? $_GET['postType'] : 'post';
	$category = (isset($_GET['category'])) ? $_GET['category'] : '';
	$author_id = (isset($_GET['author'])) ? $_GET['author'] : '';
	$taxonomy = (isset($_GET['taxonomy'])) ? $_GET['taxonomy'] : '';
	$tag = (isset($_GET['tag'])) ? $_GET['tag'] : '';
	$s = (isset($_GET['search'])) ? $_GET['search'] : '';
	$exclude = (isset($_GET['exclude'])) ? $_GET['exclude'] : '';
	$numPosts = (isset($_GET['limit'])) ? $_GET['limit'] : 4;
	$page = (isset($_GET['page'])) ? (int)$_GET['page']  : 0;
	$offset = (isset($_GET['offset'])) ? $_GET['offset'] : 0;


	// Set up initial args

	$args = array(
		'post_type' => $postType,
		'posts_per_page' => $numPosts,
		'offset' => $offset + ( $numPosts * $page ),
		'orderby' => 'date',
		'order' => 'DESC',
		'post_status' => 'publish',
		'ignore_sticky_posts' => true
	);


	if ( $category ) {
		$category = get_category( $category );
		$args['category_name'] = $category->name;
	}

	if ( $author_id ) {
		$args['author'] = $author_id;
	}
	if ( $s ) {
		$args['s'] = $s;
	}


	// Query by Taxonomy/Tag - Taxonomy is deprecated for now

	if( empty( $taxonomy ) ) {
		if ( $tag  ) {
			$args['tag'] = $tag;
		}
	} else {
		$args[$taxonomy] = $tag;
	}


	// Query by $args

	$lm_query = new WP_Query( $args );

	$markup = '';
	// the WP loop
	if ($lm_query->have_posts()) {
		global $post;
		ob_start();
		while ( $lm_query->have_posts() ) {
			$lm_query->the_post();
			 ?>
				<div class="col span_3_of_12">
					<?php 
						$post_image = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), array( 220, 220 ) ); 
						if ( $post_image ) {
					?>
						<a href="<?php the_permalink(); ?>" class="img">
							<figure class="circle"><?php echo $post_image; ?></figure>
							<div>
								<ul>
									<?php echo bonno_get_format_icon(); ?>
									<li class="date"><?php the_time( get_option( 'date_format' ) ); ?></li>
									<?php $comments = bonno_comments( false ); 
										if ($comments) { ?>
											<li class="comms"><?php echo $comments; ?></li>
									<?php } ?>
								</ul>
							</div>
						</a>
					<?php } ?>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<p><?php echo $post->post_excerpt; ?></p>
				</div>
			<?php 
		}
		$markup .= ob_get_clean();
	}
	$result = array(
		'page' => (int)$page + 1,
		'markup' => $markup
	);
	$args['offset'] = $offset + ( $numPosts * ($page + 1 ) );
	$lm_query = new WP_Query( $args );

	if (!$lm_query->have_posts()) {
		$result['hide'] = true;
	}
	wp_reset_query();



	echo json_encode( $result );
	exit;
}
