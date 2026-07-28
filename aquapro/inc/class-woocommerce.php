<?php
/**
 * Optional WooCommerce support. Loads only when WooCommerce is active so the
 * theme has zero hard dependency on the plugin.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Declares WooCommerce support and light styling hooks.
 */
class AquaPro_Woocommerce {

	/**
	 * Hook into WordPress (guarded by WC availability).
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'after_setup_theme', array( __CLASS__, 'support' ) );

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		// Wrap WooCommerce content in the theme container.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', array( __CLASS__, 'wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content', array( __CLASS__, 'wrapper_end' ), 10 );
	}

	/**
	 * Declare theme support for WooCommerce features.
	 *
	 * @return void
	 */
	public static function support() {
		add_theme_support(
			'woocommerce',
			array(
				'thumbnail_image_width' => 400,
				'single_image_width'    => 800,
				'product_grid'          => array(
					'default_rows'    => 3,
					'default_columns' => 3,
				),
			)
		);
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	/**
	 * Open the theme container around shop content.
	 *
	 * @return void
	 */
	public static function wrapper_start() {
		echo '<main id="primary" class="aqua-container aqua-shop"><div class="aqua-wrap">';
	}

	/**
	 * Close the theme container.
	 *
	 * @return void
	 */
	public static function wrapper_end() {
		echo '</div></main>';
	}
}
