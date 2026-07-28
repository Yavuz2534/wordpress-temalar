<?php
/** @package kurumsal-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = kp_opt( 'phone', '0212 000 00 00' ); $tel = kp_tel( $phone );
$name = kp_opt( 'name', 'Yıldız Danışmanlık' ); $tagline = kp_opt( 'tagline', 'Hukuk & Danışmanlık' );
$email = kp_opt( 'email', 'info@yildizdanismanlik.com' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="k-topbar"><div class="k-wrap">
	<span>✉️ <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></span>
	<span>📞 <a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a></span>
</div></div>
<header class="k-header"><div class="k-wrap">
	<a class="k-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
			<span class="k-brand__mark">⚖️</span>
			<span class="k-brand__name"><?php echo esc_html( $name ); ?><small><?php echo esc_html( $tagline ); ?></small></span>
		<?php endif; ?>
	</a>
	<nav class="k-nav" id="k-nav">
		<a href="#hizmetler">Hizmetler</a>
		<a href="#surec">Süreç</a>
		<a href="#ekip">Ekip</a>
		<a href="#iletisim">İletişim</a>
	</nav>
	<a class="k-btn k-btn--primary" href="tel:<?php echo esc_attr( $tel ); ?>">Teklif Al</a>
	<button class="k-burger" aria-label="Menü" onclick="document.getElementById('k-nav').classList.toggle('open')"><span></span><span></span><span></span></button>
</div></header>
