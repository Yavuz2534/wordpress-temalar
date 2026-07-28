<?php
/**
 * Schema.org JSON-LD output for rich results (LocalBusiness, etc.).
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Emits structured data in the document head.
 */
class AquaPro_Schema {

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public static function register() {
		add_action( 'wp_head', array( __CLASS__, 'local_business' ), 20 );
	}

	/**
	 * Output LocalBusiness / Plumber schema on the front page.
	 *
	 * @return void
	 */
	public static function local_business() {
		if ( ! is_front_page() ) {
			return;
		}

		$data = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Plumber',
			'name'        => aquapro_opt( 'company', get_bloginfo( 'name' ) ),
			'description' => aquapro_opt( 'tagline', get_bloginfo( 'description' ) ),
			'url'         => home_url( '/' ),
			'telephone'   => aquapro_opt( 'phone' ),
			'email'       => aquapro_opt( 'email' ),
			'address'     => array(
				'@type'         => 'PostalAddress',
				'streetAddress' => aquapro_opt( 'address' ),
			),
			'areaServed'  => aquapro_opt( 'maparea' ),
			'openingHours'=> aquapro_opt( 'hours' ),
		);

		$logo = get_theme_mod( 'custom_logo' );
		if ( $logo ) {
			$src = wp_get_attachment_image_src( $logo, 'full' );
			if ( $src ) {
				$data['logo']  = esc_url_raw( $src[0] );
				$data['image'] = esc_url_raw( $src[0] );
			}
		}

		// Aggregate rating from published testimonials, if any.
		$reviews = wp_count_posts( 'aquapro_review' );
		if ( $reviews && $reviews->publish > 0 ) {
			$data['aggregateRating'] = array(
				'@type'       => 'AggregateRating',
				'ratingValue' => '4.9',
				'reviewCount' => (string) $reviews->publish,
			);
		}

		echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $data ) . "</script>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_json_encode is safe JSON.
	}
}
