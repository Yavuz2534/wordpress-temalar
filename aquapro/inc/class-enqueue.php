<?php
/**
 * Asset loading: split CSS architecture + JS modules.
 *
 * Stylesheets are split so the browser only pays for what a page needs and the
 * critical tokens load first. Scripts are loaded as ES modules, deferred.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers and enqueues front-end and editor assets.
 */
class AquaPro_Enqueue {

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'front' ) );
		add_action( 'wp_head', array( __CLASS__, 'inline_tokens' ), 5 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'preload' ), 1 );
		add_filter( 'script_loader_tag', array( __CLASS__, 'as_module' ), 10, 3 );
	}

	/**
	 * Enqueue the split stylesheet layers and JS modules.
	 *
	 * @return void
	 */
	public static function front() {
		$v = AQUAPRO_VERSION;

		// The theme header stylesheet (fallback only) — required by WP.
		wp_enqueue_style( 'aquapro-style', get_stylesheet_uri(), array(), $v );

		// Split CSS architecture (loaded in cascade order).
		wp_enqueue_style( 'aquapro-variables', AQUAPRO_URI . 'assets/css/variables.css', array(), $v );
		wp_enqueue_style( 'aquapro-presets', AQUAPRO_URI . 'assets/css/presets.css', array( 'aquapro-variables' ), $v );
		wp_enqueue_style( 'aquapro-main', AQUAPRO_URI . 'assets/css/main.css', array( 'aquapro-presets' ), $v );

		if ( is_rtl() ) {
			wp_enqueue_style( 'aquapro-rtl', AQUAPRO_URI . 'assets/css/rtl.css', array( 'aquapro-main' ), $v );
		}

		// JS modules (deferred, native ESM).
		wp_enqueue_script( 'aquapro-main', AQUAPRO_URI . 'assets/js/main.js', array(), $v, true );

		// Expose config + nonces to the front end for AJAX modules.
		wp_localize_script(
			'aquapro-main',
			'AquaProData',
			array(
				'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
				'restUrl'     => esc_url_raw( rest_url() ),
				'contactNonce'=> wp_create_nonce( 'aquapro_contact' ),
				'searchNonce' => wp_create_nonce( 'aquapro_search' ),
				'i18n'        => array(
					'sending' => esc_html__( 'Sending…', 'aquapro' ),
					'sent'    => esc_html__( 'Thank you! We will call you back shortly.', 'aquapro' ),
					'error'   => esc_html__( 'Something went wrong. Please try again.', 'aquapro' ),
					'searching' => esc_html__( 'Searching…', 'aquapro' ),
				),
			)
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Preload the primary font + critical CSS for better LCP.
	 *
	 * @return void
	 */
	public static function preload() {
		// Fonts are self-hosted (see /assets/fonts) to avoid third-party calls
		// and to stay GDPR-friendly; preload hints improve Core Web Vitals.
		// Implementers drop woff2 files in assets/fonts and adjust paths here.
	}

	/**
	 * Print the live design tokens chosen in the Customizer as inline CSS.
	 *
	 * This is what makes "unlimited color customization" instant without a
	 * build step: the Customizer values override the static tokens.
	 *
	 * @return void
	 */
	public static function inline_tokens() {
		$css = AquaPro_Customizer::dynamic_css();
		if ( $css ) {
			printf( "<style id=\"aquapro-tokens\">%s</style>\n", $css ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CSS built from sanitized values.
		}
	}

	/**
	 * Load main.js as an ES module so we can use imports.
	 *
	 * @param string $tag    Script tag HTML.
	 * @param string $handle Script handle.
	 * @param string $src    Script source URL.
	 * @return string
	 */
	public static function as_module( $tag, $handle, $src ) {
		if ( 'aquapro-main' === $handle ) {
			$tag = '<script type="module" src="' . esc_url( $src ) . '" id="aquapro-main-js"></script>' . "\n";
		}
		return $tag;
	}
}
