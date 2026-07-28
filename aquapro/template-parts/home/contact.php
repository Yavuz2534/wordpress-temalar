<?php
/**
 * Home section: Contact + lead generation.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tel = aquapro_tel( aquapro_opt( 'phone' ) );
$wa  = aquapro_tel( aquapro_opt( 'whatsapp' ) );
?>
<section id="aqua-contact" class="aqua-section">
	<div class="aqua-wrap aqua-contact">
		<div class="aqua-contact__info">
			<span class="aqua-eyebrow"><?php esc_html_e( 'Contact', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title aqua-sec-title--left"><?php esc_html_e( 'Get In Touch', 'aquapro' ); ?></h2>
			<p class="aqua-lead"><?php esc_html_e( 'Open 24/7. Call, message on WhatsApp or send the form — we respond fast.', 'aquapro' ); ?></p>

			<ul class="aqua-contact__list">
				<?php if ( $tel ) : ?>
					<li><span class="aqua-contact__ico"><?php aquapro_icon( 'phone', 20 ); ?></span><span><strong><?php esc_html_e( 'Phone', 'aquapro' ); ?></strong><a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( aquapro_opt( 'phone' ) ); ?></a></span></li>
				<?php endif; ?>
				<?php if ( aquapro_opt( 'email' ) ) : ?>
					<li><span class="aqua-contact__ico"><?php aquapro_icon( 'mail', 20 ); ?></span><span><strong><?php esc_html_e( 'Email', 'aquapro' ); ?></strong><a href="mailto:<?php echo esc_attr( aquapro_opt( 'email' ) ); ?>"><?php echo esc_html( aquapro_opt( 'email' ) ); ?></a></span></li>
				<?php endif; ?>
				<?php if ( aquapro_opt( 'address' ) ) : ?>
					<li><span class="aqua-contact__ico"><?php aquapro_icon( 'pin', 20 ); ?></span><span><strong><?php esc_html_e( 'Address', 'aquapro' ); ?></strong><?php echo esc_html( aquapro_opt( 'address' ) ); ?></span></li>
				<?php endif; ?>
				<li><span class="aqua-contact__ico"><?php aquapro_icon( 'clock', 20 ); ?></span><span><strong><?php esc_html_e( 'Hours', 'aquapro' ); ?></strong><?php echo esc_html( aquapro_opt( 'hours' ) ); ?></span></li>
			</ul>
		</div>
		<div class="aqua-contact__form aqua-card">
			<h3><?php esc_html_e( 'Send us a message', 'aquapro' ); ?></h3>
			<?php get_template_part( 'template-parts/home/contact', 'form' ); ?>
		</div>
	</div>
</section>
