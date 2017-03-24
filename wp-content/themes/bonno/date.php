<?php
/**
 * Yemplate for author pages
 * 
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

$day = get_query_var( 'day' );
$month = get_query_var( 'monthnum' );
$year = get_query_var( 'year' );

if (is_day()) {
	$page_header = __( 'Daily Archive', BONNO_TEXTDOMAIN );
	$archive_date = date_i18n( get_option( 'date_format' ), strtotime( $month . '/' . $day . '-' . $year ) ); 
} elseif (is_month()) {
	$page_header = __( 'Monthly Archive', BONNO_TEXTDOMAIN );
	$archive_date = date_i18n( 'F Y', strtotime( $month . '/1-' . $year ) ); 
} else {
	$page_header = __( 'Yearly Archive', BONNO_TEXTDOMAIN );
	$archive_date = $year;
}

get_header(); ?>
<div class="content">
	<?php echo shortcode_heading(array( 
			'text' => get_option( 'bonno_blog_post_header_text' ), 
			'icon' => get_option( 'bonno_blog_post_header_icon' ) 
		) 
	); ?>
	<header class="page-header">
		<h1 class="page-title"><?php echo $page_header; ?> <a href="#"><?php echo $archive_date; ?></a></h1>
	</header>
	<!-- CONTENT -->
	<div class="content section">
		<?php get_template_part( 'posts', 'list' ); ?>
	</div>
	<!-- /.content -->
</div>
<?php get_footer(); ?>
