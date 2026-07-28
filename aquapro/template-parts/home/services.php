<?php
/**
 * Home section: Services grid (pulls from the Service CPT, with fallbacks).
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$q = AquaPro_Template::query( 'aquapro_service', 6 );

// Fallback demo data shown until the user adds real Services.
$fallback = array(
	array( 'leak', __( 'Leak Detection', 'aquapro' ), __( 'Pinpoint hidden leaks with cameras and acoustic tools — no needless demolition.', 'aquapro' ) ),
	array( 'drain', __( 'Drain Cleaning', 'aquapro' ), __( 'Clear blocked sinks, toilets and main lines with high-pressure jetting.', 'aquapro' ) ),
	array( 'camera', __( 'Camera Inspection', 'aquapro' ), __( 'Robotic camera surveys to find the exact source of the fault.', 'aquapro' ) ),
	array( 'boiler', __( 'Boiler & Heating', 'aquapro' ), __( 'Boiler service, radiator flushing and heating system repairs.', 'aquapro' ) ),
	array( 'tap', __( 'Taps & Fixtures', 'aquapro' ), __( 'Faucet, valve and fixture installation with a workmanship guarantee.', 'aquapro' ) ),
	array( 'wrench', __( 'General Plumbing', 'aquapro' ), __( 'Bathroom and kitchen renovations, pipe replacement and more.', 'aquapro' ) ),
);
?>
<section id="aqua-services" class="aqua-section">
	<div class="aqua-wrap">
		<header class="aqua-sec-head">
			<span class="aqua-eyebrow"><?php esc_html_e( 'Our Services', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title"><?php esc_html_e( 'Every Plumbing Problem, One Trusted Team', 'aquapro' ); ?></h2>
		</header>
		<div class="aqua-grid aqua-grid--3">
			<?php if ( $q->have_posts() ) : ?>
				<?php
				while ( $q->have_posts() ) :
					$q->the_post();
					$icon = get_post_meta( get_the_ID(), '_aqua_icon', true );
					?>
					<article class="aqua-card aqua-service">
						<div class="aqua-card__ico"><?php echo $icon ? AquaPro_Template::icon( $icon, 30 ) : AquaPro_Template::icon( 'wrench', 30 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<h3 class="aqua-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( $fallback as $f ) : ?>
					<article class="aqua-card aqua-service">
						<div class="aqua-card__ico"><?php echo AquaPro_Template::icon( $f[0], 30 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<h3 class="aqua-card__title"><?php echo esc_html( $f[1] ); ?></h3>
						<p><?php echo esc_html( $f[2] ); ?></p>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
