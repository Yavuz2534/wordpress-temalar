<?php
/**
 * Security hardening.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Applies sensible, non-destructive security defaults.
 */
class AquaPro_Security {

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		// Remove version fingerprinting.
		remove_action( 'wp_head', 'wp_generator' );
		add_filter( 'the_generator', '__return_empty_string' );

		// Disable XML-RPC pingback header (common abuse vector).
		add_filter( 'wp_headers', array( __CLASS__, 'remove_pingback_header' ) );

		// Send conservative security headers on the front end.
		add_action( 'send_headers', array( __CLASS__, 'security_headers' ) );

		// Strip detailed login errors.
		add_filter( 'login_errors', array( __CLASS__, 'generic_login_error' ) );
	}

	/**
	 * Remove the X-Pingback header.
	 *
	 * @param array $headers Response headers.
	 * @return array
	 */
	public static function remove_pingback_header( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}

	/**
	 * Add front-end security headers.
	 *
	 * @return void
	 */
	public static function security_headers() {
		if ( is_admin() ) {
			return;
		}
		header( 'X-Content-Type-Options: nosniff' );
		header( 'X-Frame-Options: SAMEORIGIN' );
		header( 'Referrer-Policy: strict-origin-when-cross-origin' );
		header( 'Permissions-Policy: geolocation=(self), microphone=(), camera=()' );
	}

	/**
	 * Replace login error text to avoid user enumeration.
	 *
	 * @return string
	 */
	public static function generic_login_error() {
		return esc_html__( 'Login failed. Please check your credentials and try again.', 'aquapro' );
	}
}
