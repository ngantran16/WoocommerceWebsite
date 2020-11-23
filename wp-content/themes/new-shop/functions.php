<?php
/**
 * Functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package new-shop
 */


/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function new_shop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'new_shop_content_width', 850 );
}
add_action( 'after_setup_theme', 'new_shop_content_width', 0 );


if ( ! function_exists( 'new_shop_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function new_shop_setup() {
	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/**
	* Add default support for add feed on head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	* Add default support for thumbnails 
	*/
	add_theme_support('post-thumbnails');

	/**
	* Add image size
	*/
	add_image_size('new-shop-index', 848, 450, true);

	/**
	* Enable navigational menu 
	* new_shop theme use one navigation menu
	* @link https://codex.wordpress.org/Function_Reference/register_nav_menus
	*/
	register_nav_menus(array('pagenav' => __('Top Menu', 'new-shop'), 'catnav' => __('Category menu', 'new-shop'), 'secondnav' => __('Secondary Menu', 'new-shop')));

	/*
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array('height'=> 70,'width'=> 250,'flex-height' => true,'header-text' => array( 'site-title', 'site-description' ),
));

	
	/*
	 * Enable support for custom background.
	 */
	add_theme_support( 'custom-background', array('default-color' => '#f4f4f4','default-repeat' => 'no-repeat','default-attachment' => 'fixed',) );

	// Declare WooCommerce support.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}
endif;
add_action( 'after_setup_theme', 'new_shop_setup' );



/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists ( 'new_shop_enqueues' ) ) {
	function new_shop_enqueues() {			
		// styles
		wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array());				
		wp_enqueue_style( 'font-awesome', get_template_directory_uri(). '/css/font-awesome.min.css', array());
		wp_enqueue_style( 'slicknav', get_template_directory_uri(). '/css/slicknav.css', array());
		wp_enqueue_style( 'new-shop-Montserrat', '//fonts.googleapis.com/css?family=Montserrat', array());
		wp_enqueue_style( 'new-shop-style', get_stylesheet_uri());

		wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri(). '/js/jquery.slicknav.min.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.5', true );
		wp_enqueue_script( 'new-shop-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	}
}
add_action( 'wp_enqueue_scripts', 'new_shop_enqueues' );


/**
* Adjust excerpt length
* Default WordPress excerpt length doesn't look good with theme
* Hense adjusting upon our need
*/
function new_shop_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 40;
}
add_filter( 'excerpt_length', 'new_shop_excerpt_length', 999 );



/**
* Adjust excerpt 
* Remove read more link
*/
function new_shop_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '';														
}
add_filter('excerpt_more', 'new_shop_excerpt_more');

/**
 * Register sidebar
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function new_shop_sidebar() {
register_sidebar (array (
	'name' => __( 'Sidebar widgets', 'new-shop' ),
	'id' => 'general-sidebar',
	'description' => __( 'Place your sidebar widgets here.', 'new-shop' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="wi-title clearfix"><h3 class="w-title">',
	'after_title' => '</h3></div>',
));
register_sidebar (array (
	'name' => __( 'Shop Sidebar widgets', 'new-shop' ),
	'id' => 'shop-sidebar',
	'description' => __( 'This side will be visible on shop only', 'new-shop' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="wi-title clearfix"><h3 class="w-title">',
	'after_title' => '</h3></div>',
));
}
add_action( 'widgets_init', 'new_shop_sidebar' );


/**
 * Comment settings
 */
function new_shop_comment($comment, $args, $depth) {	
	
	if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>
	
	<?php elseif (get_comment_type() == 'comment') :?>
		<li id="comment-<?php comment_ID();?>">
			<div <?php comment_class('comment-post'); ?>>
				<div class="comment-author">
					<?php echo get_avatar($comment, 70);?>
				</div>
				<div class="comment-content">
					<div class="comment-meta">
						<?php echo get_comment_author_link();?>						
						<p><?php comment_date();?></p>
					</div>
					<div class="comment-text">
						<?php comment_text(); ?>
					</div>
					<span class="bg-color" >
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					</span>
					<hr/>
				</div>				
			</div>				
		</li>
	<?php endif;
}

function new_shop_pro_upgrade_notice(){
    echo '<div class="notice notice-success is-dismissible">
       <p style="line-height: 40px;"><b>Premium theme version available with improved features. Smart slider 3 pro, custom made beautiful elementor templates, additional designs and features included. and get 24/7 dedicated support, for just $40 (code: 10PERCENTOFF for 10% Off Today)  <a target="_blank" style="background: #0085ba;border-color: #0073aa #006799 #006799;box-shadow: 0 1px 0 #006799;color: #fff;text-decoration: none;text-shadow: 0 -1px 1px #006799, 1px 0 1px #006799, 0 1px 1px #006799, -1px 0 1px #006799;padding: 7px;border-radius: 3px;" href="http://www.ammuthemes.com/downloads/new-shop-pro/">Upgrade to PRO today</a>.</b></p>
    </div>';
}
add_action('admin_notices', 'new_shop_pro_upgrade_notice');

/**
* Customizer additions.
*/
require_once( get_template_directory() . '/inc/template-tags.php' );
require_once( get_template_directory() . '/inc/newshop-woocommerce-functions.php' );
require_once( trailingslashit( get_template_directory() ) . '/inc/upgrade/class-customize.php' );

?>