<?php
/**
 * Home section: Pricing packages.
 *
 * Pricing is editable via the `aquapro_pricing` filter so a child theme or
 * site owner can replace it without editing the template.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tel = aquapro_tel( aquapro_opt( 'phone' ) );

$plans = apply_filters(
	'aquapro_pricing',
	array(
		array(
			'name'     => __( 'Call-Out', 'aquapro' ),
			'price'    => '$49',
			'period'   => __( '/ visit', 'aquapro' ),
			'popular'  => false,
			'features' => array( __( 'Diagnosis & inspection', 'aquapro' ), __( 'Written quote', 'aquapro' ), __( 'No obligation', 'aquapro' ) ),
		),
		array(
			'name'     => __( 'Standard Repair', 'aquapro' ),
			'price'    => '$120',
			'period'   => __( '/ from', 'aquapro' ),
			'popular'  => true,
			'features' => array( __( 'Most common repairs', 'aquapro' ), __( 'Parts & labor', 'aquapro' ), __( '12-month guarantee', 'aquapro' ), __( 'Same-day service', 'aquapro' ) ),
		),
		array(
			'name'     => __( 'Maintenance Plan', 'aquapro' ),
			'price'    => '$29',
			'period'   => __( '/ month', 'aquapro' ),
			'popular'  => false,
			'features' => array( __( 'Annual service', 'aquapro' ), __( 'Priority booking', 'aquapro' ), __( '10% off repairs', 'aquapro' ), __( 'Cancel anytime', 'aquapro' ) ),
		),
	)
);
?>
<section id="aqua-pricing" class="aqua-section aqua-section--soft">
	<div class="aqua-wrap">
		<header class="aqua-sec-head">
			<span class="aqua-eyebrow"><?php esc_html_e( 'Pricing', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title"><?php esc_html_e( 'Simple, Honest Pricing', 'aquapro' ); ?></h2>
			<p class="aqua-lead aqua-lead--center"><?php esc_html_e( 'No hidden fees. Know the cost before we start.', 'aquapro' ); ?></p>
		</header>
		<div class="aqua-grid aqua-grid--3 aqua-pricing">
			<?php foreach ( $plans as $p ) : ?>
				<div class="aqua-plan<?php echo ! empty( $p['popular'] ) ? ' aqua-plan--popular' : ''; ?>">
					<?php if ( ! empty( $p['popular'] ) ) : ?><span class="aqua-plan__badge"><?php esc_html_e( 'Most popular', 'aquapro' ); ?></span><?php endif; ?>
					<h3 class="aqua-plan__name"><?php echo esc_html( $p['name'] ); ?></h3>
					<p class="aqua-plan__price"><span><?php echo esc_html( $p['price'] ); ?></span> <?php echo esc_html( $p['period'] ); ?></p>
					<ul class="aqua-plan__features">
						<?php foreach ( $p['features'] as $f ) : ?>
							<li><?php aquapro_icon( 'check', 16 ); ?> <?php echo esc_html( $f ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="aqua-btn <?php echo ! empty( $p['popular'] ) ? 'aqua-btn--accent' : 'aqua-btn--outline'; ?> aqua-btn--block" href="tel:<?php echo esc_attr( $tel ); ?>"><?php esc_html_e( 'Book Now', 'aquapro' ); ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
