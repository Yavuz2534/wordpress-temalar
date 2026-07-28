<?php
/**
 * Home section: FAQ accordion (native <details>, no JS required) + FAQ schema.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faqs = apply_filters(
	'aquapro_faqs',
	array(
		array( __( 'How fast can you arrive in an emergency?', 'aquapro' ), __( 'We dispatch the nearest technician and typically arrive within 30 minutes, 24/7.', 'aquapro' ) ),
		array( __( 'Do you find leaks without breaking walls?', 'aquapro' ), __( 'Yes. We use thermal cameras and acoustic equipment to pinpoint leaks precisely.', 'aquapro' ) ),
		array( __( 'Will I know the price before work starts?', 'aquapro' ), __( 'Always. We provide a clear written quote and never start without your approval.', 'aquapro' ) ),
		array( __( 'Is your work guaranteed?', 'aquapro' ), __( 'All workmanship is guaranteed. If the same fault returns, we fix it free.', 'aquapro' ) ),
	)
);

// FAQPage schema.
$schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array(),
);
foreach ( $faqs as $f ) {
	$schema['mainEntity'][] = array(
		'@type'          => 'Question',
		'name'           => $f[0],
		'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f[1] ),
	);
}
?>
<section id="aqua-faq" class="aqua-section">
	<div class="aqua-wrap aqua-wrap--narrow">
		<header class="aqua-sec-head">
			<span class="aqua-eyebrow"><?php esc_html_e( 'FAQ', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title"><?php esc_html_e( 'Frequently Asked Questions', 'aquapro' ); ?></h2>
		</header>
		<div class="aqua-faq">
			<?php foreach ( $faqs as $f ) : ?>
				<details class="aqua-faq__item">
					<summary><?php echo esc_html( $f[0] ); ?></summary>
					<div class="aqua-faq__a"><p><?php echo esc_html( $f[1] ); ?></p></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
	<script type="application/ld+json"><?php echo wp_json_encode( $schema ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></script>
</section>
