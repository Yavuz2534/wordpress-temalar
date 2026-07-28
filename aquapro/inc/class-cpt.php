<?php
/**
 * Custom post types & taxonomies.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers AquaPro content types used across the theme templates.
 */
class AquaPro_Cpt {

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'init', array( __CLASS__, 'post_types' ) );
		add_action( 'init', array( __CLASS__, 'taxonomies' ) );
	}

	/**
	 * Register all post types from a single declarative map.
	 *
	 * @return void
	 */
	public static function post_types() {
		$types = array(
			'aquapro_service'    => array( 'Service', 'Services', 'dashicons-admin-tools', 'services', array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ) ),
			'aquapro_project'    => array( 'Project', 'Projects', 'dashicons-portfolio', 'projects', array( 'title', 'editor', 'thumbnail', 'excerpt' ) ),
			'aquapro_review'     => array( 'Testimonial', 'Testimonials', 'dashicons-format-quote', 'testimonials', array( 'title', 'editor', 'thumbnail' ) ),
			'aquapro_member'     => array( 'Team Member', 'Team', 'dashicons-groups', 'team', array( 'title', 'editor', 'thumbnail' ) ),
			'aquapro_area'       => array( 'Service Area', 'Service Areas', 'dashicons-location-alt', 'service-areas', array( 'title', 'editor', 'thumbnail' ) ),
		);

		foreach ( $types as $key => $def ) {
			list( $single, $plural, $icon, $slug, $supports ) = $def;
			register_post_type(
				$key,
				array(
					'labels'             => self::labels( $single, $plural ),
					'public'             => true,
					'has_archive'        => true,
					'show_in_rest'       => true, // Gutenberg-first.
					'menu_icon'          => $icon,
					'rewrite'            => array( 'slug' => $slug, 'with_front' => false ),
					'supports'           => $supports,
					'capability_type'    => 'post',
				)
			);
		}
	}

	/**
	 * Register taxonomies (service categories, project categories).
	 *
	 * @return void
	 */
	public static function taxonomies() {
		register_taxonomy(
			'aquapro_service_cat',
			'aquapro_service',
			array(
				'labels'       => self::labels( 'Service Category', 'Service Categories' ),
				'hierarchical' => true,
				'show_in_rest' => true,
				'rewrite'      => array( 'slug' => 'service-category' ),
			)
		);

		register_taxonomy(
			'aquapro_project_cat',
			'aquapro_project',
			array(
				'labels'       => self::labels( 'Project Category', 'Project Categories' ),
				'hierarchical' => true,
				'show_in_rest' => true,
				'rewrite'      => array( 'slug' => 'project-category' ),
			)
		);
	}

	/**
	 * Build a standard labels array.
	 *
	 * @param string $single Singular name.
	 * @param string $plural Plural name.
	 * @return array
	 */
	private static function labels( $single, $plural ) {
		/* translators: %s: post type name */
		return array(
			'name'               => $plural,
			'singular_name'      => $single,
			'add_new'            => esc_html__( 'Add New', 'aquapro' ),
			'add_new_item'       => sprintf( esc_html__( 'Add New %s', 'aquapro' ), $single ),
			'edit_item'          => sprintf( esc_html__( 'Edit %s', 'aquapro' ), $single ),
			'new_item'           => sprintf( esc_html__( 'New %s', 'aquapro' ), $single ),
			'view_item'          => sprintf( esc_html__( 'View %s', 'aquapro' ), $single ),
			'search_items'       => sprintf( esc_html__( 'Search %s', 'aquapro' ), $plural ),
			'not_found'          => esc_html__( 'Nothing found', 'aquapro' ),
			'all_items'          => $plural,
			'menu_name'          => $plural,
		);
	}
}
