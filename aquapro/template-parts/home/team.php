<?php
/**
 * Home section: Team members.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$q = AquaPro_Template::query( 'aquapro_member', 4 );
?>
<section id="aqua-team" class="aqua-section aqua-section--soft">
	<div class="aqua-wrap">
		<header class="aqua-sec-head">
			<span class="aqua-eyebrow"><?php esc_html_e( 'Our Team', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title"><?php esc_html_e( 'Meet the Experts at Your Door', 'aquapro' ); ?></h2>
		</header>
		<div class="aqua-grid aqua-grid--4">
			<?php if ( $q->have_posts() ) : ?>
				<?php
				while ( $q->have_posts() ) :
					$q->the_post();
					$role = get_post_meta( get_the_ID(), '_aqua_role', true );
					?>
					<article class="aqua-member">
						<div class="aqua-member__photo">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'aquapro-card', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) );
							} else {
								echo '<span class="aqua-member__ph" aria-hidden="true">' . esc_html( mb_substr( get_the_title(), 0, 1 ) ) . '</span>';
							}
							?>
						</div>
						<h3 class="aqua-member__name"><?php the_title(); ?></h3>
						<?php if ( $role ) : ?><p class="aqua-member__role"><?php echo esc_html( $role ); ?></p><?php endif; ?>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php
				$demo = array(
					array( 'Alex Carter', __( 'Master Plumber', 'aquapro' ) ),
					array( 'Sam Rivera', __( 'Heating Engineer', 'aquapro' ) ),
					array( 'Jordan Lee', __( 'Drainage Specialist', 'aquapro' ) ),
					array( 'Taylor Brooks', __( 'Service Manager', 'aquapro' ) ),
				);
				foreach ( $demo as $m ) :
					?>
					<article class="aqua-member">
						<div class="aqua-member__photo"><span class="aqua-member__ph" aria-hidden="true"><?php echo esc_html( mb_substr( $m[0], 0, 1 ) ); ?></span></div>
						<h3 class="aqua-member__name"><?php echo esc_html( $m[0] ); ?></h3>
						<p class="aqua-member__role"><?php echo esc_html( $m[1] ); ?></p>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
