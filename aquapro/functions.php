<?php
/**
 * AquaPro theme bootstrap.
 *
 * Loads the autoloaded module classes and boots the theme. All real logic lives
 * in /inc/ as small, single-responsibility classes following the WordPress
 * Coding Standards and an object-oriented, modular architecture.
 *
 * @package AquaPro
 * @author  Yavuz Aykac
 * @license GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

/**
 * Theme constants.
 */
define( 'AQUAPRO_VERSION', '1.0.0' );
define( 'AQUAPRO_DIR', trailingslashit( get_template_directory() ) );
define( 'AQUAPRO_URI', trailingslashit( get_template_directory_uri() ) );
define( 'AQUAPRO_INC', AQUAPRO_DIR . 'inc/' );

/**
 * Lightweight PSR-ish loader for the theme's module classes.
 *
 * Files are named class-{slug}.php and contain a class AquaPro_{Studly}.
 *
 * @param string $slug Module slug (e.g. 'setup', 'customizer').
 * @return void
 */
function aquapro_load_module( $slug ) {
	$file = AQUAPRO_INC . 'class-' . $slug . '.php';
	if ( is_readable( $file ) ) {
		require_once $file;
	}
}

/**
 * Boot the theme.
 *
 * Each module exposes a static register() method that hooks itself into
 * WordPress. Order matters only where noted.
 *
 * @return void
 */
function aquapro_boot() {
	$modules = array(
		'security',   // Harden output & headers first.
		'setup',      // add_theme_support, menus, image sizes, i18n.
		'enqueue',    // Styles & scripts (split CSS architecture).
		'cpt',        // Custom post types + taxonomies.
		'meta',       // CPT meta boxes (icon, role, before/after).
		'customizer', // Color presets, typography, dark mode, header/footer.
		'template',   // Template tags & helper functions.
		'schema',     // Schema.org JSON-LD output.
		'ajax',       // AJAX contact form + AJAX search.
		'woocommerce',// Optional WooCommerce hooks (loads only if WC active).
	);

	foreach ( $modules as $slug ) {
		aquapro_load_module( $slug );
		$class = 'AquaPro_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $slug ) ) );
		if ( class_exists( $class ) && method_exists( $class, 'register' ) ) {
			call_user_func( array( $class, 'register' ) );
		}
	}
}
add_action( 'after_setup_theme', 'aquapro_boot', 5 );

/**
 * Convenience accessor for Customizer values with sane defaults.
 *
 * @param string $key     Setting key without the `aquapro_` prefix.
 * @param mixed  $default Default value.
 * @return mixed
 */
function aquapro_opt( $key, $default = '' ) {
	return get_theme_mod( 'aquapro_' . $key, $default );
}

/**
 * Escape + sanitize a phone number into a tel: friendly string.
 *
 * @param string $raw Raw phone string.
 * @return string
 */
function aquapro_tel( $raw ) {
	return preg_replace( '/[^0-9+]/', '', (string) $raw );
}
