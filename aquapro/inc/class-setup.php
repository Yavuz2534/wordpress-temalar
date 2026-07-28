<?php
/**
 * Theme setup: supports, menus, image sizes, i18n, content width.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers core theme supports and assets metadata.
 */
class AquaPro_Setup {

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'after_setup_theme', array( __CLASS__, 'setup' ) );
		add_action( 'after_setup_theme', array( __CLASS__, 'content_width' ), 0 );
		add_action( 'widgets_init', array( __CLASS__, 'widgets' ) );
	}

	/**
	 * Declare theme supports.
	 *
	 * @return void
	 */
	public static function setup() {
		load_theme_textdomain( 'aquapro', AQUAPRO_DIR . 'languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor.css' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 64,
				'width'       => 220,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
		);

		add_theme_support(
			'custom-background',
			array( 'default-color' => 'ffffff' )
		);

		// Gutenberg-first: expose the theme palette to the block editor.
		add_theme_support( 'editor-color-palette', AquaPro_Customizer::editor_palette() );
		add_theme_support( 'editor-font-sizes', self::editor_font_sizes() );

		// Custom image sizes used by templates.
		add_image_size( 'aquapro-card', 640, 440, true );
		add_image_size( 'aquapro-wide', 1280, 720, true );
		add_image_size( 'aquapro-project', 800, 600, true );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'aquapro' ),
				'footer'  => esc_html__( 'Footer Menu', 'aquapro' ),
				'mobile'  => esc_html__( 'Mobile Menu', 'aquapro' ),
			)
		);
	}

	/**
	 * Set the global content width.
	 *
	 * @return void
	 */
	public static function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'aquapro_content_width', 1200 );
	}

	/**
	 * Register widget areas (footer columns + sidebar).
	 *
	 * @return void
	 */
	public static function widgets() {
		$areas = array(
			'sidebar-1'     => esc_html__( 'Blog Sidebar', 'aquapro' ),
			'footer-1'      => esc_html__( 'Footer Column 1', 'aquapro' ),
			'footer-2'      => esc_html__( 'Footer Column 2', 'aquapro' ),
			'footer-3'      => esc_html__( 'Footer Column 3', 'aquapro' ),
			'footer-4'      => esc_html__( 'Footer Column 4', 'aquapro' ),
		);
		foreach ( $areas as $id => $name ) {
			register_sidebar(
				array(
					'name'          => $name,
					'id'            => $id,
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		}
	}

	/**
	 * Editor font sizes mirrored from the CSS type scale.
	 *
	 * @return array
	 */
	public static function editor_font_sizes() {
		return array(
			array(
				'name' => esc_html__( 'Small', 'aquapro' ),
				'size' => 14,
				'slug' => 'small',
			),
			array(
				'name' => esc_html__( 'Normal', 'aquapro' ),
				'size' => 17,
				'slug' => 'normal',
			),
			array(
				'name' => esc_html__( 'Large', 'aquapro' ),
				'size' => 26,
				'slug' => 'large',
			),
			array(
				'name' => esc_html__( 'Huge', 'aquapro' ),
				'size' => 44,
				'slug' => 'huge',
			),
		);
	}
}
