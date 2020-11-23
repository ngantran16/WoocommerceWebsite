<?php
/**
 * New Shop specific woocommerce functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package new-shop
 */

remove_action( 'woocommerce_sidebar',	'woocommerce_get_sidebar',	10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',     10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );


//check woocommerce is active
if ( ! function_exists( 'new_shop_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function new_shop_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}


// Change number or products per row to 3
add_filter('loop_shop_columns', 'new_shop_loop_columns');
if (!function_exists('new_shop_loop_columns')) {
	function new_shop_loop_columns() {
		return 3; // 3 products per row
	}
}

// Change number or products per page to 12
add_filter( 'loop_shop_per_page', 'new_shop_shop_per_page', 20 );
function new_shop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 12;
  return $cols;
}

// Change number or related products on product page
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'new_shop_related_products_args' );
  function new_shop_related_products_args( $args ) {

	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

//Before content
if ( ! function_exists( 'new_shop_before_content' ) ) {
	/**
	 * Before Content
	 * Wraps all WooCommerce content in wrappers which match the theme markup
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function new_shop_before_content() {
		?>
		<div class="content area container">
			<div class="row">
				<div class="col-md-9">
		<?php
	}
}

//Remove title on shop
if ( ! function_exists ( 'new_shop_remove_shop_title' ) ) {
	/**
	 * Remove shop title from shop page
	 */
	function new_shop_remove_shop_title() {

		return false;

	}
	
	add_filter('woocommerce_show_page_title', 'new_shop_remove_shop_title');
}

//After content
if ( ! function_exists( 'new_shop_after_content' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function new_shop_after_content() {
		?>		
				</div>
				<?php do_action( 'new_shop_shop_sidebar' ); ?>
			</div>
		</div>
		<?php 
		
	}
}

if ( ! function_exists( 'new_shop_shop_sidebar' ) ) {

	function new_shop_shop_sidebar() {
		
		get_sidebar('shop');

	}
}

/**
 * Add Cart icon and count to header if WC is active
 */
function new_shop_wc_cart_count() {
 
    if ( new_shop_is_woocommerce_activated() ) { 
        $count = WC()->cart->cart_contents_count; ?>
        <div class="header-cart-link">
	        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart','new-shop' ); ?>">
		        <i class="fa fa-shopping-cart" aria-hidden="true"></i>        
	            <p><?php echo esc_html( $count ); ?> <?php echo _e('Items','new-shop'); ?></p>
	            <span><?php echo esc_html(wc_cart_totals_order_total_html()); ?></span>
			</a>
		</div>
		<?php
    }
 
}

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function new_shop_header_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?>
    <div class="header-cart-link">
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart','new-shop' ); ?>">
	        <i class="fa fa-shopping-cart" aria-hidden="true"></i>        
            <p><?php echo esc_html( $count ); ?> <?php echo _e('Items','new-shop'); ?></p>
            <span><?php echo esc_html(wc_cart_totals_order_total_html()); ?></span>
		</a>
	</div>

        <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}

if ( ! function_exists( 'new_shop_product_search' ) ) {
	/**
	 * Display Product Search
	 *
	 * @since  1.0.0
	 * @uses  new_shop_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function new_shop_product_search() {
		if ( new_shop_is_woocommerce_activated() ) { ?>
			<div class="site-search">
				<?php get_product_search_form(); ?>
			</div>
		<?php
		}
	}
}

add_filter( 'get_product_search_form' , 'new_shop_product_searchform' );
/**
 * Filter WooCommerce  Search Field
 *
 */
function new_shop_product_searchform( $form ) {
	
	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
                        <div>
                                <label class="screen-reader-text" for="s">' . __( 'Search for:', 'new-shop' ) . '</label>
                                  
                                <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search products...', 'new-shop' ) . '" />
                                <button type="submit" id="searchsubmit" />
                                        <span class="icon"><i class="fa fa-search"></i></span>   
                                </button>
                                 <input type="hidden" name="post_type" value="product" />
                        </div>
                </form>';
return $form;
}


add_action( 'woocommerce_before_main_content',	'new_shop_before_content',	10 );
add_action( 'woocommerce_after_main_content',	'new_shop_after_content',	10 );
add_action( 'new_shop_shop_sidebar',			'new_shop_shop_sidebar',	10 );
add_action( 'new_shop_theme_header_top', 'new_shop_wc_cart_count' );
add_action( 'new_shop_product_search', 'new_shop_product_search' );
add_filter( 'woocommerce_add_to_cart_fragments', 'new_shop_header_add_to_cart_fragment' );
