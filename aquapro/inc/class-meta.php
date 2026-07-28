<?php
/**
 * Meta boxes for the custom post types (icon, role, before/after images).
 *
 * Kept intentionally lightweight (no plugin dependency). All fields are
 * nonce-protected and sanitized on save.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers and saves the CPT meta fields used by the templates.
 */
class AquaPro_Meta {

	/**
	 * Field map: post_type => [ meta_key => [label, type] ].
	 *
	 * @return array
	 */
	private static function fields() {
		return array(
			'aquapro_service' => array(
				'_aqua_icon' => array( __( 'Icon slug (e.g. wrench, leak, drain)', 'aquapro' ), 'text' ),
			),
			'aquapro_member'  => array(
				'_aqua_role' => array( __( 'Role / title', 'aquapro' ), 'text' ),
			),
			'aquapro_review'  => array(
				'_aqua_role' => array( __( 'Location / context', 'aquapro' ), 'text' ),
			),
			'aquapro_project' => array(
				'_aqua_before' => array( __( 'Before image (attachment ID)', 'aquapro' ), 'image' ),
				'_aqua_after'  => array( __( 'After image (attachment ID)', 'aquapro' ), 'image' ),
			),
		);
	}

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'add_meta_boxes', array( __CLASS__, 'add' ) );
		add_action( 'save_post', array( __CLASS__, 'save' ), 10, 2 );
	}

	/**
	 * Add the meta box to each relevant CPT.
	 *
	 * @return void
	 */
	public static function add() {
		foreach ( array_keys( self::fields() ) as $type ) {
			add_meta_box( 'aquapro_meta', __( 'AquaPro Details', 'aquapro' ), array( __CLASS__, 'render' ), $type, 'side', 'default' );
		}
	}

	/**
	 * Render the meta box fields.
	 *
	 * @param WP_Post $post Current post.
	 * @return void
	 */
	public static function render( $post ) {
		$fields = self::fields();
		if ( empty( $fields[ $post->post_type ] ) ) {
			return;
		}
		wp_nonce_field( 'aquapro_meta_save', 'aquapro_meta_nonce' );
		foreach ( $fields[ $post->post_type ] as $key => $def ) {
			$value = get_post_meta( $post->ID, $key, true );
			printf( '<p><label for="%1$s"><strong>%2$s</strong></label><br>', esc_attr( $key ), esc_html( $def[0] ) );
			printf( '<input type="text" id="%1$s" name="%1$s" value="%2$s" style="width:100%%;"></p>', esc_attr( $key ), esc_attr( $value ) );
		}
		echo '<p style="color:#777;font-size:12px;">' . esc_html__( 'Tip: upload images to the Media Library and paste their ID for before/after.', 'aquapro' ) . '</p>';
	}

	/**
	 * Persist field values securely.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post object.
	 * @return void
	 */
	public static function save( $post_id, $post ) {
		if ( ! isset( $_POST['aquapro_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['aquapro_meta_nonce'] ) ), 'aquapro_meta_save' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$fields = self::fields();
		if ( empty( $fields[ $post->post_type ] ) ) {
			return;
		}
		foreach ( $fields[ $post->post_type ] as $key => $def ) {
			if ( ! isset( $_POST[ $key ] ) ) {
				continue;
			}
			$raw = sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
			$val = ( 'image' === $def[1] ) ? absint( $raw ) : $raw;
			update_post_meta( $post_id, $key, $val );
		}
	}
}
