<?php
/**
 * Customizer: color presets, unlimited colors, typography, dark mode,
 * header & footer options. Also generates the dynamic CSS token block.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The theme options framework, built on the native WordPress Customizer.
 */
class AquaPro_Customizer {

	/**
	 * Built-in color presets. Implementers/users can pick one, then fine-tune.
	 *
	 * @return array
	 */
	public static function presets() {
		return array(
			'aqua'   => array( 'label' => 'Aqua Blue', 'accent' => '#1d6fe0', 'accent2' => '#06b6d4' ),
			'navy'   => array( 'label' => 'Deep Navy', 'accent' => '#1e3a8a', 'accent2' => '#3b82f6' ),
			'teal'   => array( 'label' => 'Teal', 'accent' => '#0d9488', 'accent2' => '#14b8a6' ),
			'sunset' => array( 'label' => 'Sunset', 'accent' => '#ea580c', 'accent2' => '#f59e0b' ),
			'forest' => array( 'label' => 'Forest', 'accent' => '#15803d', 'accent2' => '#65a30d' ),
		);
	}

	/**
	 * Settings map: key => [default, sanitize, transport].
	 *
	 * @return array
	 */
	public static function settings() {
		return array(
			// Brand / contact.
			'company'        => array( 'AquaPro Tesisat', 'sanitize_text_field', 'refresh' ),
			'tagline'        => array( 'Acil Su Tesisatı Servisi', 'sanitize_text_field', 'refresh' ),
			'phone'          => array( '0850 000 00 00', 'sanitize_text_field', 'refresh' ),
			'whatsapp'       => array( '905000000000', 'sanitize_text_field', 'refresh' ),
			'email'          => array( 'info@aquapro.example', 'sanitize_email', 'refresh' ),
			'address'        => array( 'Merkez Mah., İstanbul', 'sanitize_text_field', 'refresh' ),
			'maparea'        => array( 'İstanbul', 'sanitize_text_field', 'refresh' ),
			'hours'          => array( '7/24 Açık · Acil Servis', 'sanitize_text_field', 'refresh' ),
			// Appearance.
			'preset'         => array( 'aqua', array( __CLASS__, 'sanitize_preset' ), 'postMessage' ),
			'accent'         => array( '', 'sanitize_hex_color', 'postMessage' ),  // overrides preset if set.
			'accent2'        => array( '', 'sanitize_hex_color', 'postMessage' ),
			'dark_mode'      => array( 'auto', array( __CLASS__, 'sanitize_dark' ), 'refresh' ), // auto|toggle|off
			'radius'         => array( '14', 'absint', 'postMessage' ),
			'font_heading'   => array( 'Poppins', 'sanitize_text_field', 'refresh' ),
			'font_body'      => array( 'Inter', 'sanitize_text_field', 'refresh' ),
			'font_scale'     => array( '100', 'absint', 'postMessage' ),
			// Layout.
			'sticky_header'  => array( true, 'wp_validate_boolean', 'refresh' ),
			'topbar'         => array( true, 'wp_validate_boolean', 'refresh' ),
			'footer_credit'  => array( '', 'wp_kses_post', 'refresh' ),
			// Hero.
			'hero_badge'     => array( '7/24 Acil Su Tesisatı Servisi', 'sanitize_text_field', 'refresh' ),
			'hero_title'     => array( 'Güvenebileceğiniz Hızlı ve Profesyonel Tesisat', 'sanitize_text_field', 'refresh' ),
			'hero_sub'       => array( 'Lisanslı ustalar, şeffaf fiyat ve garantili işçilik — 30 dakikada kapınızdayız.', 'sanitize_textarea_field', 'refresh' ),
		);
	}

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'customize_register', array( __CLASS__, 'controls' ) );
		add_action( 'customize_preview_init', array( __CLASS__, 'preview_js' ) );
	}

	/**
	 * Register all panels, sections, settings and controls.
	 *
	 * @param WP_Customize_Manager $wp Customize manager.
	 * @return void
	 */
	public static function controls( $wp ) {
		// Panel.
		$wp->add_panel(
			'aquapro_panel',
			array(
				'title'    => esc_html__( 'AquaPro Options', 'aquapro' ),
				'priority' => 10,
			)
		);

		$sections = array(
			'aquapro_brand'      => esc_html__( 'Brand & Contact', 'aquapro' ),
			'aquapro_colors'     => esc_html__( 'Colors & Dark Mode', 'aquapro' ),
			'aquapro_typography' => esc_html__( 'Typography', 'aquapro' ),
			'aquapro_layout'     => esc_html__( 'Header & Footer', 'aquapro' ),
			'aquapro_hero'       => esc_html__( 'Homepage Hero', 'aquapro' ),
		);
		foreach ( $sections as $id => $title ) {
			$wp->add_section( $id, array( 'title' => $title, 'panel' => 'aquapro_panel' ) );
		}

		// Register settings.
		foreach ( self::settings() as $key => $def ) {
			list( $default, $sanitize, $transport ) = $def;
			$wp->add_setting(
				'aquapro_' . $key,
				array(
					'default'           => $default,
					'sanitize_callback' => $sanitize,
					'transport'         => $transport,
				)
			);
		}

		// --- Brand & Contact ---
		self::text( $wp, 'company', esc_html__( 'Company name', 'aquapro' ), 'aquapro_brand' );
		self::text( $wp, 'tagline', esc_html__( 'Tagline', 'aquapro' ), 'aquapro_brand' );
		self::text( $wp, 'phone', esc_html__( 'Phone', 'aquapro' ), 'aquapro_brand' );
		self::text( $wp, 'whatsapp', esc_html__( 'WhatsApp number', 'aquapro' ), 'aquapro_brand' );
		self::text( $wp, 'email', esc_html__( 'Email', 'aquapro' ), 'aquapro_brand' );
		self::text( $wp, 'address', esc_html__( 'Address', 'aquapro' ), 'aquapro_brand' );
		self::text( $wp, 'maparea', esc_html__( 'Map search location', 'aquapro' ), 'aquapro_brand' );
		self::text( $wp, 'hours', esc_html__( 'Working hours', 'aquapro' ), 'aquapro_brand' );

		// --- Colors & Dark Mode ---
		$choices = array();
		foreach ( self::presets() as $slug => $p ) {
			$choices[ $slug ] = $p['label'];
		}
		$wp->add_control( 'aquapro_preset', array( 'label' => esc_html__( 'Color preset', 'aquapro' ), 'section' => 'aquapro_colors', 'type' => 'select', 'choices' => $choices ) );
		$wp->add_control( new WP_Customize_Color_Control( $wp, 'aquapro_accent', array( 'label' => esc_html__( 'Accent color (overrides preset)', 'aquapro' ), 'section' => 'aquapro_colors' ) ) );
		$wp->add_control( new WP_Customize_Color_Control( $wp, 'aquapro_accent2', array( 'label' => esc_html__( 'Secondary accent', 'aquapro' ), 'section' => 'aquapro_colors' ) ) );
		$wp->add_control( 'aquapro_dark_mode', array( 'label' => esc_html__( 'Dark mode', 'aquapro' ), 'section' => 'aquapro_colors', 'type' => 'select', 'choices' => array(
			'auto'   => esc_html__( 'Auto (follow system)', 'aquapro' ),
			'toggle' => esc_html__( 'Show toggle in header', 'aquapro' ),
			'off'    => esc_html__( 'Light only', 'aquapro' ),
		) ) );
		$wp->add_control( 'aquapro_radius', array( 'label' => esc_html__( 'Corner radius (px)', 'aquapro' ), 'section' => 'aquapro_colors', 'type' => 'number', 'input_attrs' => array( 'min' => 0, 'max' => 28 ) ) );

		// --- Typography ---
		self::text( $wp, 'font_heading', esc_html__( 'Heading font family', 'aquapro' ), 'aquapro_typography' );
		self::text( $wp, 'font_body', esc_html__( 'Body font family', 'aquapro' ), 'aquapro_typography' );
		$wp->add_control( 'aquapro_font_scale', array( 'label' => esc_html__( 'Base font scale (%)', 'aquapro' ), 'section' => 'aquapro_typography', 'type' => 'number', 'input_attrs' => array( 'min' => 85, 'max' => 120 ) ) );

		// --- Header & Footer ---
		$wp->add_control( 'aquapro_sticky_header', array( 'label' => esc_html__( 'Sticky header', 'aquapro' ), 'section' => 'aquapro_layout', 'type' => 'checkbox' ) );
		$wp->add_control( 'aquapro_topbar', array( 'label' => esc_html__( 'Show top bar', 'aquapro' ), 'section' => 'aquapro_layout', 'type' => 'checkbox' ) );
		$wp->add_control( 'aquapro_footer_credit', array( 'label' => esc_html__( 'Footer credit (HTML allowed)', 'aquapro' ), 'section' => 'aquapro_layout', 'type' => 'textarea' ) );

		// --- Hero ---
		self::text( $wp, 'hero_badge', esc_html__( 'Hero badge', 'aquapro' ), 'aquapro_hero' );
		self::text( $wp, 'hero_title', esc_html__( 'Hero title', 'aquapro' ), 'aquapro_hero' );
		$wp->add_control( 'aquapro_hero_sub', array( 'label' => esc_html__( 'Hero subtitle', 'aquapro' ), 'section' => 'aquapro_hero', 'type' => 'textarea' ) );

		// Selective refresh for instant hero edits.
		if ( isset( $wp->selective_refresh ) ) {
			$wp->selective_refresh->add_partial( 'aquapro_hero_title', array( 'selector' => '.aqua-hero__title', 'render_callback' => function () { return esc_html( aquapro_opt( 'hero_title' ) ); } ) );
		}
	}

	/**
	 * Helper to register a simple text control.
	 *
	 * @param WP_Customize_Manager $wp      Manager.
	 * @param string               $key     Setting key.
	 * @param string               $label   Label.
	 * @param string               $section Section id.
	 * @return void
	 */
	private static function text( $wp, $key, $label, $section ) {
		$wp->add_control( 'aquapro_' . $key, array( 'label' => $label, 'section' => $section, 'type' => 'text' ) );
	}

	/**
	 * Resolve the active accent colors (custom override beats preset).
	 *
	 * @return array{accent:string,accent2:string}
	 */
	public static function resolve_colors() {
		$presets = self::presets();
		$slug    = aquapro_opt( 'preset', 'aqua' );
		$preset  = isset( $presets[ $slug ] ) ? $presets[ $slug ] : $presets['aqua'];

		$accent  = aquapro_opt( 'accent' );
		$accent2 = aquapro_opt( 'accent2' );

		return array(
			'accent'  => $accent ? $accent : $preset['accent'],
			'accent2' => $accent2 ? $accent2 : $preset['accent2'],
		);
	}

	/**
	 * Build the dynamic CSS custom-property block from Customizer values.
	 *
	 * @return string
	 */
	public static function dynamic_css() {
		$c       = self::resolve_colors();
		$radius  = absint( aquapro_opt( 'radius', 14 ) );
		$scale   = max( 85, min( 120, absint( aquapro_opt( 'font_scale', 100 ) ) ) );
		$heading = aquapro_opt( 'font_heading', 'Poppins' );
		$body    = aquapro_opt( 'font_body', 'Inter' );

		$accent  = sanitize_hex_color( $c['accent'] );
		$accent2 = sanitize_hex_color( $c['accent2'] );

		$css  = ':root{';
		$css .= '--aqua-accent:' . esc_attr( $accent ) . ';';
		$css .= '--aqua-accent-2:' . esc_attr( $accent2 ) . ';';
		$css .= '--aqua-radius:' . $radius . 'px;';
		$css .= '--aqua-font-heading:"' . esc_attr( $heading ) . '",system-ui,sans-serif;';
		$css .= '--aqua-font-body:"' . esc_attr( $body ) . '",system-ui,sans-serif;';
		$css .= '--aqua-font-scale:' . ( $scale / 100 ) . ';';
		$css .= '}';

		return $css;
	}

	/**
	 * Palette exposed to the Gutenberg editor.
	 *
	 * @return array
	 */
	public static function editor_palette() {
		$c = self::resolve_colors();
		return array(
			array( 'name' => esc_html__( 'Accent', 'aquapro' ), 'slug' => 'accent', 'color' => $c['accent'] ),
			array( 'name' => esc_html__( 'Accent 2', 'aquapro' ), 'slug' => 'accent-2', 'color' => $c['accent2'] ),
			array( 'name' => esc_html__( 'Ink', 'aquapro' ), 'slug' => 'ink', 'color' => '#0f1b2d' ),
			array( 'name' => esc_html__( 'Muted', 'aquapro' ), 'slug' => 'muted', 'color' => '#5b6b7e' ),
			array( 'name' => esc_html__( 'Surface', 'aquapro' ), 'slug' => 'surface', 'color' => '#f4f8fc' ),
			array( 'name' => esc_html__( 'White', 'aquapro' ), 'slug' => 'white', 'color' => '#ffffff' ),
		);
	}

	/**
	 * Enqueue the live-preview script for postMessage transports.
	 *
	 * @return void
	 */
	public static function preview_js() {
		wp_enqueue_script( 'aquapro-customize-preview', AQUAPRO_URI . 'assets/js/customize-preview.js', array( 'customize-preview' ), AQUAPRO_VERSION, true );
	}

	/**
	 * Sanitize the preset slug against the known list.
	 *
	 * @param string $value Raw value.
	 * @return string
	 */
	public static function sanitize_preset( $value ) {
		$presets = self::presets();
		return array_key_exists( $value, $presets ) ? $value : 'aqua';
	}

	/**
	 * Sanitize the dark-mode mode.
	 *
	 * @param string $value Raw value.
	 * @return string
	 */
	public static function sanitize_dark( $value ) {
		return in_array( $value, array( 'auto', 'toggle', 'off' ), true ) ? $value : 'auto';
	}
}
