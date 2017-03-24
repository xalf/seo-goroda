<?php $posts_list_navigation = get_option( 'bonno_posts_list_navigation', 'pagination'); ?>
<div class="posts-list">
	<?php if ( have_posts() ) { ?>
		<div class="blogroll">
			<?php while ( have_posts() ) { the_post(); ?>
				<div class="col span_3_of_12">
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>" class="img">
							<figure class="circle">
								<?php the_post_thumbnail( array( 220, 220 ) ); ?>
							</figure>
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
					
						<p><?php the_excerpt(); ?></p>
					
				</div>
			<?php } ?>
		</div>
		<?php if ( 'pagination' == $posts_list_navigation ) { ?>
			<div class="section">
				<div class="col span_12_of_12">
					<?php bonno_paging_nav(); ?>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<?php if( 'ajax' == $posts_list_navigation && get_next_posts_link()) { 
	$posts_per_page = (int)get_option( 'posts_per_page' ); ?> 
	<div class="loadmore aligned center cf">
		<a id="load-posts" data-category="<?php echo $cat; ?>" data-author="0" data-tag="0" data-limit="<?php echo $posts_per_page; ?>" data-offset="<?php echo $posts_per_page; ?>" data-page="0" href="#" class="button"><?php _e( 'Load More', BONNO_TEXTDOMAIN ); ?></a>
	</div>
<?php } ?>
