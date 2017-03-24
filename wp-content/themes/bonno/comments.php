<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>
<div class="comments" id="comments">
	<?php if ( have_comments() ) { ?>
		<h4><?php echo bonno_comments( false ); ?></h4>
		<?php if (1 ||  get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', BONNO_TEXTDOMAIN ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', BONNO_TEXTDOMAIN ) ); ?></div>
			</nav><!-- #comment-nav-above -->
		<?php }
		wp_list_comments( array(
			'style'      => 'div',
			'short_ping' => true,
			'avatar_size'=> 68,
			'callback' => 'bonno_comment'
		) );
		 if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', BONNO_TEXTDOMAIN ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', BONNO_TEXTDOMAIN ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php } // Check for comment navigation. ?>

		<?php if ( ! comments_open() ) { ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', BONNO_TEXTDOMAIN ); ?></p>
		<?php } ?>
	<?php } // have_comments() ?>
	<div class="leaveacomment <?php echo is_user_logged_in() ? 'user-logged-in': '' ; ?>" id="commentform">
		<?php $comemnt_form_defaults = array(
			'comment_notes_after' => ''
		); ?>
		<?php comment_form( $comemnt_form_defaults ); ?>
	</div>
</div><!-- #comments -->
