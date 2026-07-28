<?php
/**
 * Home section: Service areas with an embedded map.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$q       = AquaPro_Template::query( 'aquapro_area', 12 );
$maparea = aquapro_opt( 'maparea', 'Your City' );
?>
<section id="aqua-areas" class="aqua-section">
	<div class="aqua-wrap aqua-areas">
		<div class="aqua-areas__info">
			<span class="aqua-eyebrow"><?php esc_html_e( 'Service Areas', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title aqua-sec-title--left"><?php esc_html_e( 'Proudly Serving Your Neighborhood', 'aquapro' ); ?></h2>
			<p class="aqua-lead"><?php esc_html_e( 'Fast local response across the region. Not sure if we cover your area? Just call us.', 'aquapro' ); ?></p>
			<ul class="aqua-areas__list">
				<?php if ( $q->have_posts() ) : ?>
					<?php
					while ( $q->have_posts() ) :
						$q->the_post();
						?>
						<li><?php aquapro_icon( 'pin', 16 ); ?> <?php the_title(); ?></li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<?php foreach ( array( 'Downtown', 'North Side', 'Westend', 'Riverside', 'Hill District', 'Old Town' ) as $a ) : ?>
						<li><?php aquapro_icon( 'pin', 16 ); ?> <?php echo esc_html( $a ); ?></li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
		<div class="aqua-areas__map">
			<iframe title="<?php esc_attr_e( 'Service area map', 'aquapro' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=<?php echo esc_attr( rawurlencode( $maparea ) ); ?>&output=embed"></iframe>
		</div>
	</div>
</section>
