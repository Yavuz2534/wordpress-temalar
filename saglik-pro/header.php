<?php
/** @package saglik-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = sp_opt( 'phone', '0212 000 00 00' ); $tel = sp_tel( $phone );
$name = sp_opt( 'name', 'Yaşam Sağlık Merkezi' ); $tagline = sp_opt( 'tagline', 'Sağlık & Bakım' );
$hours = sp_opt( 'hours', 'Hafta içi 09:00–19:00' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="s-topbar"><div class="s-wrap">
	<span>🕐 <?php echo esc_html( $hours ); ?></span>
	<span>📞 <a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a></span>
</div></div>
<header class="s-header"><div class="s-wrap">
	<a class="s-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
			<span class="s-brand__mark">🩺</span>
			<span class="s-brand__name"><?php echo esc_html( $name ); ?><small><?php echo esc_html( $tagline ); ?></small></span>
		<?php endif; ?>
	</a>
	<nav class="s-nav" id="s-nav">
		<a href="#hizmetler">Hizmetler</a>
		<a href="#doktorlar">Doktorlar</a>
		<a href="#surec">Süreç</a>
		<a href="#sss">S.S.S.</a>
		<a href="#iletisim">İletişim</a>
	</nav>
	<a class="s-btn s-btn--primary" href="tel:<?php echo esc_attr( $tel ); ?>">Randevu Al</a>
	<button class="s-burger" aria-label="Menü" onclick="document.getElementById('s-nav').classList.toggle('open')"><span></span><span></span><span></span></button>
</div></header>
