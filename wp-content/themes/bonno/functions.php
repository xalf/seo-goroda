<?php
/**
 * Bonno functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package Aisconverse
 * @subpackage Bonno
 * @since Bonno 1.0
 */

/**
 * Defines theme constants
 */
define('BONNO_TEXTDOMAIN', 'bonno' );
define('IMAGES', get_stylesheet_directory_uri() . '/assets/images');
define('CODEBASE_PATH', get_template_directory() . '/codebase');
define('CODEBASE_URI', get_template_directory_uri() . '/codebase');

/**
 * Set up the content width value based on the theme's design.
 *
 * @since Bonno 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

/**
 * Bonno only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require CODEBASE_PATH. '/back-compat.php';
}

add_filter( 'locale', 'my_theme_localized' );
function my_theme_localized( $locale )
{

	if ( isset( $_GET['l'] ) )
	{
		return esc_attr( $_GET['l'] );
	}

	return $locale;
}


if ( ! function_exists( 'bonno_setup' ) ) {
	/**
	 * Bonno setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 *
	 * @since Bonno 1.0
	 */
	function bonno_setup() {

		/*
		 * Make Bonno available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Bonno, use a find and
		 * replace to change BONNO_TEXTDOMAIN to the name of your theme in all
		 * template files.
		 */
		$r = load_theme_textdomain( BONNO_TEXTDOMAIN, get_template_directory() . '/languages' );



		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'assets/css/editor-style.css', bonno_font_url() ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for custom header
		add_theme_support( 'custom-header' );

		// Enable support for custom background
		add_theme_support( 'custom-background' );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails', array( 'post', 'client', 'member', 'work') );

		// Enable support fot post formats
		add_theme_support( 'post-formats', array(
				'aside',
				'gallery',
				'link',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat'
			)
		);
		add_post_type_support( 'post', 'post-formats' );

		set_post_thumbnail_size();

		add_filter('image_size_names_choose', 'bonno_image_sizes');

		function bonno_image_sizes($sizes) {
			return array(
				"full" => $sizes['full']
			);
		}

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary'   => __( 'Top primary menu', BONNO_TEXTDOMAIN )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list',
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );
	}

	// Remove default customization page menu item
	function bonno_remove_menus(){
		remove_submenu_page( 'themes.php', 'customize.php' );
	}

	add_action( 'admin_menu', 'bonno_remove_menus' );
}

add_action( 'after_setup_theme', 'bonno_setup' );

/**
 * Register Bonno widget areas.
 *
 * @since Bonno 1.0
 *
 * @return void
 */
function bonno_widgets_init() {
	require CODEBASE_PATH . '/widgets.php';
	register_widget( 'Bonno_Post_Widget' );

	register_sidebar( array(
		'name'          => __( 'Posts Sidebar', BONNO_TEXTDOMAIN ),
		'id'            => 'post-sidebar',
		'description'   => __( 'Sidebar that appears on post page.', BONNO_TEXTDOMAIN ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
}

add_action( 'widgets_init', 'bonno_widgets_init' );


/**
 * Register Lato Google font for Bonno.
 *
 * @since Bonno 1.0
 *
 * @return string
 */
function bonno_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Roboto, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', BONNO_TEXTDOMAIN ) ) {
		//$font_url = add_query_arg( 'family', 'Roboto%20Slab%3A400%2C300%2C700%26subset%3Dlatin%2Ccyrillic-ext', "//fonts.googleapis.com/css" );
		// $font_url = 'http://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&subset=latin,cyrillic';
		$font_url = add_query_arg(
			array(
				'family' => 'Roboto+Slab:300,400,700',
				'subset' => 'latin,latin-ext'
			),
			'//fonts.googleapis.com/css'
		);

	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Bonno 1.0
 *
 * @return void
 */
function bonno_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'bonno-roboto', bonno_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '4.3.0' );

	// Load our main stylesheet.
	wp_enqueue_style( 'bonno-style', get_stylesheet_uri(), array( 'fontawesome' ), '7' );
	wp_enqueue_style( 'dev-style', get_template_directory_uri() . '/assets/css/dev.css', array( 'bonno-style' ), '3' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-2.1.1.min.js', null, '20140107', true );
	wp_enqueue_script( 'jquery.plugins', get_template_directory_uri() . '/assets/js/jquery.plugins.js', array( 'jquery' ), '20140107', true );
	wp_enqueue_script( 'google.maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array( 'jquery' ), '20140107', true );
	wp_enqueue_script( 'bonno-script', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery', 'jquery.plugins', 'google.maps' ), '5', true );
	// wp_enqueue_script( 'bonno-script', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery', 'jquery.plugins' ), '5', true );

	if ( is_admin() ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}
}

add_action( 'wp_enqueue_scripts', 'bonno_scripts' );


/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Bonno 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function bonno_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', BONNO_TEXTDOMAIN ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'bonno_wp_title', 10, 2 );

/* Body Class */
add_filter('body_class', 'bonno_body_classes');

function bonno_body_classes($classes) {
	$hide_preloader = get_option( 'bonno_hide_preloader', 0 );

	if ( !$hide_preloader ) {
		$classes[] = 'loading';
	}
	if ( get_option( 'bonno_header_fix_menu', 0 ) ) {
		$classes[] = 'fixed_menu';
	}
	return $classes;
}

/* Send to editor improvement */
function bonno_send_to_editor( $html, $id, $caption, $title, $align, $url ) {
	$html = str_replace("<img", '<img data-attachment-id="' .$id . '"', $html );
	return $html;
}

add_filter( 'image_send_to_editor', 'bonno_send_to_editor', 10, 6 );

/* Usefull functions */
function bonno_heading( $header_text = '', $header_icon = '') {
	if ( !$header_text && !$header_icon ) {
		global $post;
		$header_text = meta( '_header_text', false );
		$header_icon = meta( '_header_icon', false );
	}

	echo do_shortcode( '[heading text="' . $header_text . '" icon="' . $header_icon . '"]' );
}

function bonno_work_heading( $header_text = '', $header_icon = '') {
	if ( !$header_text && !$header_icon ) {
		global $post;
		$header_text = meta( '_header_text', false );
		$header_icon = meta( '_header_icon', false );
	}
	if ( !$header_text && !$header_icon ) {
		$header_text = get_option( 'bonno_works_title' );
		$header_icon = get_option( 'bonno_works_icon' );
	}
	echo do_shortcode( '[heading text="' . $header_text . '" icon="' . $header_icon . '"]' );
}

function bonno_favicon() {
	$favicon = get_option( 'bonno_favicon' );

	if ( $favicon )
		echo '<link href="' . $favicon . '" rel="shortcut icon" type="image/x-icon">';
	else
		echo '<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">';
}

function bonno_work_categories() {
	global $post;
	return implode( ' ', wp_get_post_terms( $post->ID, 'workcategory', array( "fields" => "names" ) ) );
}

function bonno_work_categories_slugs() {
	global $post;
	return implode( ' ', wp_get_post_terms( $post->ID, 'workcategory', array( "fields" => "slugs" ) ) );
}

function bonno_get_format_icon( $post_id = null ) {

	if ( !$post_id ) {
		global $post;
		if ( !$post ) {
			return;
		}
		$post_id = $post->ID;
	}

	$post_format = get_post_format( $post_id );

	if ( !$post_format || $post_format == 'standart') {
		return;
	}

	$post_format_icon_src = get_option( 'bonno_post_format_icon_' . $post_format );

	if ( !$post_format_icon_src ) {
		return;
	}

	return '<li><img src="' . $post_format_icon_src . '" /></li>';

}

function bonno_get_blog_page_url() {
	$posts_page_id = get_option( 'page_for_posts');
	if ( !$posts_page_id )
		return '/';
	$posts_page = get_page( $posts_page_id);
	$posts_page_url = get_page_uri($posts_page_id  );

	return '/' . $posts_page_url;
}

function bonno_ajust_subfolder_icon_path( $icon = '' ) {
	if ( !$icon ) {
		return '';
	}
	if ( strrpos($icon, 'http') !== 0 ) {
		return site_url($icon);
	}
	return $icon;
}
/**
 * Echoes or return single meta value inside the Loop
 * @param  string  $key  Meta key
 * @param  boolean $echo Echo or return
 * @return string or void
 */
function meta( $key, $echo = true) {
	global $post;
	if (!$echo) {
		return get_post_meta( get_the_ID(), $key, true );
	}

	echo get_post_meta( get_the_ID(), $key, true );
}

/**
 * Wrap every new line in span tag
 * @param  string $str string to proceed
 * @return string
 */
function nl2span( $str = '' ) {
	if ( !$str )
		return '';
	return '<span>' . implode( '</span><span>', explode( "\r\n", $str ) ) . '</span>';
}

/**
 * Returns current post comments count with or without link
 * @param  boolean $show_links Use link on comment line
 * @param  boolean $permalink  Use permalinks in link href
 * @return string  HTML-markup
 */
function bonno_comments( $show_links = true, $permalink = false ) {
	global $post;
	$comments_number = get_comments_number();
	$markup = '';
	if ((int)$comments_number ) {
		if ( $show_links ) {
			$permalink = $permalink ? get_permalink() : '' ;
			$markup .= '<a class="a-comments internal" href="' . $permalink . '#comments">';
		}
		$markup .= sprintf( _n( 'One comment', '%1$s Comments', get_comments_number(), BONNO_TEXTDOMAIN ), number_format_i18n( $comments_number ) );
		if ( $show_links ) {
			$markup .= '</a>';
		}
	}
	return $markup;
}

/* Comments thread markup */
function bonno_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $post;
	$author_link = get_comment_author_url( get_comment_ID() );

	$reply_link_defaults = array(
		'add_below'  => 'comment',
		'respond_id' => 'respond',
		'reply_text' => __('Reply', BONNO_TEXTDOMAIN ),
		'login_text' => __('Log in to Reply', BONNO_TEXTDOMAIN ),
		'depth'      => 1,
		'before'     => '',
		'after'      => '',
		'max_depth'  => get_option('thread_comments_depth')
	);
	?>

	<div class="comment" id="comment-<?php echo get_comment_ID(); ?>">
		<a class="ava" <?php if ( $author_link ) { ?>href="<?php echo $author_link ; ?>"<?php } ?>>
			<?php echo get_avatar( get_comment_author_email(), '68' ); ?>
		</a>
		<div class="block">
			<div class="info">
				<?php
					comment_author_link();
					$author_ID = get_the_author_meta( 'ID' );
					$author_URL = get_author_posts_url( $author_ID );
					if ( $author_URL && $comment->user_id == $author_ID ) { ?>
						<a href="<?php echo $author_URL; ?>"><?php _e( '(post author)', BONNO_TEXTDOMAIN ); ?></a>
						<?php
					} ?>, <span class="date"><?php comment_date(); ?></span> <?php echo comment_reply_link( $reply_link_defaults, get_comment_ID(), get_the_ID() ); ?>
			</div>
			<?php if ($comment->comment_approved == '0') { ?>
				<em><?php _e( 'Your comment is awaiting moderation.', BONNO_TEXTDOMAIN ) ?></em>
			<?php } ?>
			<p><?php comment_text(); ?> </p>
		</div> <?php
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 */
function bonno_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', BONNO_TEXTDOMAIN ),
		'next_text' => __( 'Next &rarr;', BONNO_TEXTDOMAIN ),
	) );

	if ( $links ) { ?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="loop-pagination">
				<?php echo $links; ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
	<?php }
}

/* Add get_terms an ability to be ordered by include list */
add_filter( 'get_terms_orderby', 'bonno_get_terms_orderby', 10, 2 );
/**
 * Modifies the get_terms_orderby argument if orderby == include
 *
 * @param  string $orderby Default orderby SQL string.
 * @param  array  $args    get_terms( $taxonomy, $args ) arg.
 * @return string $orderby Modified orderby SQL string.
 */
function bonno_get_terms_orderby( $orderby, $args ) {
	if ( isset( $args['orderby'] ) && 'include' == $args['orderby'] ) {
		$include = implode(',', array_map( 'absint', $args['include'] ));
		$orderby = "FIELD( t.term_id, $include )";
	}
	return $orderby;
}

/* Register Custom Post Types */
require 'codebase/custom-post-types/photo-slider.php';
require 'codebase/custom-post-types/photo-gallery.php';
require 'codebase/custom-post-types/client.php';
require 'codebase/custom-post-types/member.php';
require 'codebase/custom-post-types/work.php';

if (is_admin()) {
	require 'codebase/options.php';
	/* Extensions */
	require 'codebase/extensions/post.php';
	require 'codebase/extensions/heading.php';
	/* Editor shortcodes */
	require 'codebase/shortcodes-builder/editor-shortcodes.php';
	/* Editor font-size */
	require 'codebase/editor-fontsize.php';

	/* Imaginarium */
	require 'codebase/imaginarium/imaginarium.php';

	new imaginarium('page', array(
			'images' => array(
				'preview' => array(
					'title' => 'Preview'
				),
				'image' => array(
					'title' => 'Photo'
				)
			),
			'texts' => array(
				'text' => array(
					'title' => 'Text'
				)
			)
		),
		__( 'Photos', BONNO_TEXTDOMAIN )
	);

	new imaginarium('photo_slider', array(
			'images' => array(
				'image' => array(
					'title' => 'Slide'
				)
			),
			'texts' => array(
				'text' => array(
					'title' => 'Text',
					'type' => 'textarea'
				),
				'link' => array(
					'title' => 'Link'
				),
				'color' => array(
					'title' => 'Color',
					'default' => '#fff',
					'type' => 'color'
				)
			)
		),
		__( 'Slides', BONNO_TEXTDOMAIN )
	);

	new imaginarium('photo_gallery', array(
			'images' => array(
				'preview' => array(
					'title' => 'Preview'
				),
				'image' => array(
					'title' => 'Photo'
				)
			),
			'texts' => array(
				'text' => array(
					'title' => 'Text'
				)
			)

		),
		__( 'Photos', BONNO_TEXTDOMAIN )
	);

	new imaginarium('work', array(
			'images' => array(
				'image' => array()
			),
			'container-class' => 'images-only'
		),
		__( 'Images', BONNO_TEXTDOMAIN )
	);

	/* Textarium */
	require 'codebase/textarium/textarium.php';

	new textarium('work', array(
			'title' => array(
				'title' => 'Title'
			),
			'text' => array(
				'title' => 'Text',
				'type' => 'textarea'
			)
		),
		__( 'Extra text data', BONNO_TEXTDOMAIN )
	);

}


add_action( 'wp_head', 'print_settings_styles' );

function print_settings_styles() {
	$main_color = get_option( 'bonno_main_color', '#e7543d' );
	$background_color = get_background_color(); ?>
		<style>
			<?php if ( strtolower( $main_color ) != '#e7543d' ) { ?>
				.border{ border-top-color: <?php echo $main_color; ?> }
				.color,
				a,
				.button,
				.logo:hover,
				.pricing .pagination.lined a.selected,
				.pricing .pagination.lined a:hover,
				.mainmenu ul li a:hover,
				.slicknav_nav ul .current-menu-item a,
				.nav-portfolio li a.active, .nav-portfolio li a:hover,
				.nav-blog li a.active, .nav-blog li a:hover,
				.expandteam .social li a:hover i,
				.pricing .pagination.lined a:hover,
				.footer .social li a:hover i,
				textarea.invalid,
				.blogbar h5 a:hover,
				.blogroll a:hover,
				a.back:hover,
				.nav-blog li a:hover,
				.comment .info a:hover,
				.mainmenu li.active a,
				.mainmenu > li:hover > a,
				.mainmenu li.active a,
				.mainmenu li.current-menu-item > a,
				textarea.wpcf7-not-valid,
				.comment .info .comment-reply-link:hover,
				.comment-form #submit,
				a [class^="fa-"]:hover,
				a [class*=" fa-"]:hover,
				.comment-form label.ivalid {
					color:<?php echo $main_color; ?>
				}

				.button:hover,
				.button.hover:hover,
				.button.hover,
				.content ul li:before,
				.mask,
				.nav-portfolio li a ins,
				.nav-blog li a.active ins,
				.img figure:before,
				.img .circle:before,
				.comment-form #submit:hover {
					background-color: <?php echo $main_color; ?>
				}

				.button.hover:hover {
					border-color: <?php echo $main_color ;?>;
					opacity: .5;
				}

				.button,
				.comment-form #submit {
					border-color: <?php echo $main_color; ?>
				}

				blockquote{ border-left-color: <?php echo $main_color; ?>}
				.pagination a:hover,
				.pagination a.selected,
				.pagination a:hover {
					border-top-color: <?php echo $main_color; ?>
				}
				<?php }
				if ( $background_color ) { ?>
					html, .heading h1, .heading h2, .heading h3, .heading h4, .heading h5, .heading h6  { background-color: #<?php echo $background_color; ?>}
				<?php } ?>
		</style>
	<?php
	if ( $bonno_preloader = get_option( 'bonno_preloader' ) ) { ?>
		<style>
			#status { background-image: url(<?php echo $bonno_preloader; ?>); }
		</style>
	<?php } else {?>
		<style>
			#preloader, #status {display: none;}
			body.loading { overflow: visible !important; }
		</style>
	<?php }
}

/* Load more posts functioanality */
require 'codebase/load-more.php';

/* Shortcodes */
require 'codebase/shortcodes.php';

/* Image resizer */
require 'codebase/image-resizer.php';

/* Fix autop for shortcodes */
add_filter('the_content', 'shortcode_empty_paragraph_fix');

function shortcode_empty_paragraph_fix($content) {
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr( $content, $array );

	return $content;
}

/* Remove pages from search */
function search_filter($query) {
	if ($query->is_search) {
	$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','search_filter');


/**
 * Shows post navigation
 */
add_filter( 'the_content', 'bonno_post_nav' );

function bonno_post_nav( $content ) {
	$queried_object = get_queried_object();

	if ( is_a($queried_object, 'WP_Post') && $queried_object->post_type == 'work' ) {
		global $post;
		$_use_global_navigation_settings = get_post_meta( $post->ID, '_use_global_navigation_settings', true );
		if ( $_use_global_navigation_settings ) {
			if ( !get_option( 'bonno_works_autonavigation', 0 ) ) {
				return  $content;
			}
			$reverse_navgiation = get_option( 'bonno_works_reverse_autonavigation', 0 );
		} else {
			if ( !get_post_meta( $post->ID, '_autonavigation', true ) ) {
				return $content;
			}
			$reverse_navgiation = get_post_meta( $post->ID, '_reverse-autonavigation', true );
		}
		ob_start();
		?>
		<div class="section post-navs">
			<div class="prev-post">
				<?php echo $reverse_navgiation ? next_post_link( '%link' ) : previous_post_link( '%link' ) ?>
			</div>
			<div class="next-post">
				<?php echo $reverse_navgiation ? previous_post_link( '%link' ) : next_post_link( '%link' ) ?>
			</div>
			<div class="clear"></div>
		</div>


	<?php
	$content .= ob_get_clean();
	return $content;
	}

	return $content;

}


add_action( 'admin_enqueue_scripts', 'enqueue_media_scripts' );

function enqueue_media_scripts() {
    wp_enqueue_media();
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
}
