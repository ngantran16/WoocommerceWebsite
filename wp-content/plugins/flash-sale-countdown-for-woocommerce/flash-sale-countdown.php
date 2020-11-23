<?php
/**
* Plugin Name: Sale Countdown WooCommerce
* Description: Display flash sale with countdown timer, display sale-flash in percentage
* Plugin URI: 
* Version: 1.0.0
* Author: Tomiup
* Author URI: http://tomiup.com/
* Requires at least: 4.4
* Tested up to: 5.3.2
* License: GPLv2 or later
*
* Text Domain: flash-sale-countdown
* Domain Path: /languages/
**/

/**
 * Check if WooCommerce is active
 **/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (!is_plugin_active( 'woocommerce/woocommerce.php')){
	return;
}

if ( ! class_exists( 'flashSaleCountdown' ) ) {
	class flashSaleCountdown {

		function __construct() {

			define( 'FLASHSALECOUNTDOWN_VER', '1.0.0' );
			if ( ! defined( 'FLASHSALECOUNTDOWN_URL' ) ) {
				define( 'FLASHSALECOUNTDOWN_URL', plugin_dir_url( __FILE__ ) );
			}
			if ( ! defined( 'FLASHSALECOUNTDOWN_PATH' ) ) {
				define( 'FLASHSALECOUNTDOWN_PATH', plugin_dir_path( __FILE__ ) );
			}

			add_action( 'init', array( $this, 'load_textdomain' ) );

			// Frontend
			add_action( 'init', array( $this, 'register_assets' ) );
			add_action('woocommerce_single_product_summary' , array($this, 'single_countdown'), '10');
			add_action('woocommerce_after_shop_loop_item_title' , array($this, 'archive_countdown'), '9');
			// Show flash sale in percentge
			add_filter( 'woocommerce_sale_flash', array($this, 'sale_flash_percentage'), 11, 3 );

		}

		function register_assets() {
			wp_register_style( 'flash-sale-countdown', FLASHSALECOUNTDOWN_URL . 'assets/css/frontend.css', array(), FLASHSALECOUNTDOWN_VER );
			wp_register_script( 'flash-sale-countdown', FLASHSALECOUNTDOWN_URL . 'assets/js/frontend.js', array( 'jquery' ), FLASHSALECOUNTDOWN_VER, true );
			$translation_array = array(
				'day' => esc_attr__( 'day', 'flash-sale-countdown' ),
				'days' => esc_attr__( 'days', 'flash-sale-countdown' )
			);
			wp_localize_script( 'flash-sale-countdown', 'flashSaleCountdown', $translation_array );
		}

		/**
		 * Load text domain
		 */
		function load_textdomain() {
			load_plugin_textdomain( 'flash-sale-countdown', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		function single_countdown(){
			ob_start();
			include( FLASHSALECOUNTDOWN_PATH .'templates/single-countdown.php');
			echo ob_get_clean();
		}

		function archive_countdown(){
			ob_start();
			include( FLASHSALECOUNTDOWN_PATH .'templates/archive-countdown.php');
			echo ob_get_clean();
		}

		function sale_flash_percentage( $text, $post, $product ) {
			$discount = 0;
			if ( $product->get_type() == 'variable' ) {
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1->get_regular_price();
					$sales_price = $variable_product1->get_sale_price();
					if( $sales_price ) {
						$percentage= round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 ) ;
						if ($percentage > $maximumper) {
							$maximumper = $percentage;
						}
					}        
				}
				$text = sprintf(__( '<span class="onsale">%s%% off</span>', 'flash-sale-countdown' ), $maximumper);
			} elseif ( $product->get_type() == 'simple' ) {
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
				$text = sprintf(__( '<span class="onsale">%s%% off</span>', 'flash-sale-countdown' ), $percentage);
			}   

			return $text;
		}

	}

	new flashSaleCountdown();
}