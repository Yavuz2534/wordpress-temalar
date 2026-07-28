<?php
/**
 * AJAX endpoints: lead-generation contact form + instant search.
 *
 * Both are nonce-protected, sanitized and rate-limited via a transient.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles front-end AJAX requests securely.
 */
class AquaPro_Ajax {

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'wp_ajax_aquapro_contact', array( __CLASS__, 'contact' ) );
		add_action( 'wp_ajax_nopriv_aquapro_contact', array( __CLASS__, 'contact' ) );
		add_action( 'wp_ajax_aquapro_search', array( __CLASS__, 'search' ) );
		add_action( 'wp_ajax_nopriv_aquapro_search', array( __CLASS__, 'search' ) );
	}

	/**
	 * Process a contact / call-back request and email the site admin.
	 *
	 * @return void
	 */
	public static function contact() {
		check_ajax_referer( 'aquapro_contact', 'nonce' );

		// Basic rate limit: 1 submission / 20s per IP.
		$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
		$key = 'aquapro_rl_' . md5( $ip );
		if ( get_transient( $key ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Please wait a moment before sending again.', 'aquapro' ) ), 429 );
		}
		set_transient( $key, 1, 20 );

		// Honeypot.
		if ( ! empty( $_POST['website'] ) ) {
			wp_send_json_success(); // Silently accept bots.
		}

		$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
		$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
		$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

		if ( '' === $name || ( '' === $phone && '' === $email ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Please enter your name and a phone or email.', 'aquapro' ) ), 400 );
		}

		$to      = get_option( 'admin_email' );
		$subject = sprintf( /* translators: %s: site name */ esc_html__( 'New lead from %s', 'aquapro' ), get_bloginfo( 'name' ) );
		$body    = sprintf(
			"Name: %s\nPhone: %s\nEmail: %s\n\n%s",
			$name,
			$phone,
			$email,
			$message
		);
		$headers = array();
		if ( $email ) {
			$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
		}

		$sent = wp_mail( $to, $subject, $body, $headers );

		if ( $sent ) {
			wp_send_json_success( array( 'message' => esc_html__( 'Thank you! We will contact you shortly.', 'aquapro' ) ) );
		}
		wp_send_json_error( array( 'message' => esc_html__( 'Could not send right now. Please call us instead.', 'aquapro' ) ), 500 );
	}

	/**
	 * Lightweight AJAX search across posts and AquaPro CPTs.
	 *
	 * @return void
	 */
	public static function search() {
		check_ajax_referer( 'aquapro_search', 'nonce' );

		$term = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
		if ( strlen( $term ) < 2 ) {
			wp_send_json_success( array( 'results' => array() ) );
		}

		$query = new WP_Query(
			array(
				's'                   => $term,
				'post_type'           => array( 'post', 'page', 'aquapro_service', 'aquapro_project' ),
				'posts_per_page'      => 6,
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			)
		);

		$results = array();
		while ( $query->have_posts() ) {
			$query->the_post();
			$results[] = array(
				'title' => get_the_title(),
				'url'   => get_permalink(),
				'type'  => get_post_type(),
			);
		}
		wp_reset_postdata();

		wp_send_json_success( array( 'results' => $results ) );
	}
}
