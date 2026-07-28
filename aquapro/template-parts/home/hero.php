<?php
/**
 * Home section: Hero with emergency CTA.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tel = aquapro_tel( aquapro_opt( 'phone' ) );
$wa  = aquapro_tel( aquapro_opt( 'whatsapp' ) );
?>
<section class="aqua-hero" aria-labelledby="aqua-hero-title">
	<div class="aqua-hero__bg" aria-hidden="true"></div>
	<div class="aqua-wrap aqua-hero__inner">
		<div class="aqua-hero__content">
			<?php if ( aquapro_opt( 'hero_badge' ) ) : ?>
				<span class="aqua-hero__badge"><span class="aqua-pulse" aria-hidden="true"></span> <?php echo esc_html( aquapro_opt( 'hero_badge' ) ); ?></span>
			<?php endif; ?>
			<h1 id="aqua-hero-title" class="aqua-hero__title"><?php echo esc_html( aquapro_opt( 'hero_title' ) ); ?></h1>
			<p class="aqua-hero__sub"><?php echo esc_html( aquapro_opt( 'hero_sub' ) ); ?></p>
			<div class="aqua-hero__actions">
				<?php if ( $tel ) : ?>
					<a class="aqua-btn aqua-btn--accent aqua-btn--lg" href="tel:<?php echo esc_attr( $tel ); ?>"><?php aquapro_icon( 'phone', 20 ); ?> <?php echo esc_html( aquapro_opt( 'phone' ) ); ?></a>
				<?php endif; ?>
				<a class="aqua-btn aqua-btn--ghost aqua-btn--lg" href="#aqua-contact"><?php esc_html_e( 'Get a Free Quote', 'aquapro' ); ?></a>
			</div>
			<ul class="aqua-hero__trust">
				<li><?php aquapro_icon( 'check', 18 ); ?> <?php esc_html_e( 'Licensed & insured', 'aquapro' ); ?></li>
				<li><?php aquapro_icon( 'check', 18 ); ?> <?php esc_html_e( 'Upfront pricing', 'aquapro' ); ?></li>
				<li><?php aquapro_icon( 'check', 18 ); ?> <?php esc_html_e( 'Workmanship guarantee', 'aquapro' ); ?></li>
			</ul>
		</div>
		<div class="aqua-hero__card">
			<h2 class="aqua-hero__card-title"><?php esc_html_e( 'Request a Callback', 'aquapro' ); ?></h2>
			<p class="aqua-hero__card-sub"><?php esc_html_e( 'Tell us the issue — we will call you back fast.', 'aquapro' ); ?></p>
			<?php get_template_part( 'template-parts/home/contact', 'form' ); ?>
		</div>
	</div>
</section>
