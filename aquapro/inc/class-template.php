<?php
/**
 * Template tags & helper functions used by the theme templates.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Reusable presentation helpers. Kept stateless and escape-safe.
 */
class AquaPro_Template {

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		add_filter( 'body_class', array( __CLASS__, 'body_class' ) );
		add_filter( 'excerpt_more', array( __CLASS__, 'excerpt_more' ) );
		add_filter( 'nav_menu_link_attributes', array( __CLASS__, 'mega_menu_attrs' ), 10, 3 );
	}

	/**
	 * Add helpful body classes (dark-mode mode, sticky header, etc.).
	 *
	 * @param array $classes Body classes.
	 * @return array
	 */
	public static function body_class( $classes ) {
		$classes[] = 'aqua-dark-' . esc_attr( aquapro_opt( 'dark_mode', 'auto' ) );
		if ( aquapro_opt( 'sticky_header', true ) ) {
			$classes[] = 'aqua-sticky';
		}
		return $classes;
	}

	/**
	 * Cleaner excerpt ellipsis.
	 *
	 * @return string
	 */
	public static function excerpt_more() {
		return '…';
	}

	/**
	 * Allow top-level menu items flagged with the "mega" class to open a panel.
	 *
	 * @param array    $atts Link attributes.
	 * @param WP_Post  $item Menu item.
	 * @param stdClass $args Menu args.
	 * @return array
	 */
	public static function mega_menu_attrs( $atts, $item, $args ) {
		if ( in_array( 'mega', (array) $item->classes, true ) ) {
			$atts['aria-haspopup'] = 'true';
			$atts['data-mega']     = '1';
		}
		return $atts;
	}

	/**
	 * Render an inline SVG icon from the icon set.
	 *
	 * @param string $name Icon slug.
	 * @param int    $size Pixel size.
	 * @return string Sanitized SVG markup.
	 */
	public static function icon( $name, $size = 28 ) {
		$file = AQUAPRO_DIR . 'assets/icons/' . sanitize_file_name( $name ) . '.svg';
		if ( ! is_readable( $file ) ) {
			return '';
		}
		$svg = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local theme asset.
		$svg = str_replace( '<svg', '<svg width="' . absint( $size ) . '" height="' . absint( $size ) . '" aria-hidden="true" focusable="false"', $svg );
		return wp_kses( $svg, self::svg_allowed() );
	}

	/**
	 * Query helper for CPT loops on the homepage.
	 *
	 * @param string $type  Post type.
	 * @param int    $count Number of posts.
	 * @return WP_Query
	 */
	public static function query( $type, $count = 6 ) {
		return new WP_Query(
			array(
				'post_type'           => $type,
				'posts_per_page'      => absint( $count ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				'orderby'             => 'menu_order date',
				'order'               => 'ASC',
			)
		);
	}

	/**
	 * Allowed tags/attributes for inline SVG (kses).
	 *
	 * @return array
	 */
	private static function svg_allowed() {
		$attr = array(
			'class' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true,
			'stroke-linecap' => true, 'stroke-linejoin' => true, 'd' => true, 'cx' => true,
			'cy' => true, 'r' => true, 'x' => true, 'y' => true, 'width' => true, 'height' => true,
			'viewbox' => true, 'xmlns' => true, 'points' => true, 'rx' => true, 'ry' => true,
			'aria-hidden' => true, 'focusable' => true, 'transform' => true,
		);
		return array(
			'svg'     => $attr,
			'path'    => $attr,
			'g'       => $attr,
			'circle'  => $attr,
			'rect'    => $attr,
			'line'    => $attr,
			'polyline'=> $attr,
			'polygon' => $attr,
		);
	}
}

/**
 * Procedural wrappers (template-tag style) for use inside theme files.
 */

/**
 * Echo an inline icon.
 *
 * @param string $name Icon slug.
 * @param int    $size Size.
 * @return void
 */
function aquapro_icon( $name, $size = 28 ) {
	echo AquaPro_Template::icon( $name, $size ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped via wp_kses in icon().
}
