<?php
/** @package restoran-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = rp_opt( 'phone', '0212 000 00 00' ); $tel = rp_tel( $phone );
$name = rp_opt( 'name', 'Lezzet Durağı' ); $tagline = rp_opt( 'tagline', 'Restoran & Kafe' );
$address = rp_opt( 'address', 'Bağdat Cad. No:1, İstanbul' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="r-topbar"><div class="r-wrap">
	<span>📍 <?php echo esc_html( $address ); ?></span>
	<span>📞 <a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a></span>
</div></div>
<header class="r-header"><div class="r-wrap">
	<a class="r-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
			<span class="r-brand__mark">🍽️</span>
			<span class="r-brand__name"><?php echo esc_html( $name ); ?><small><?php echo esc_html( $tagline ); ?></small></span>
		<?php endif; ?>
	</a>
	<nav class="r-nav" id="r-nav">
		<a href="#hakkinda">Hakkımızda</a>
		<a href="#menu">Menü</a>
		<a href="#neden">Neden Biz</a>
		<a href="#saatler">Saatler</a>
		<a href="#iletisim">İletişim</a>
	</nav>
	<a class="r-btn r-btn--gold" href="tel:<?php echo esc_attr( $tel ); ?>">Rezervasyon</a>
	<button class="r-burger" aria-label="Menü" onclick="document.getElementById('r-nav').classList.toggle('open')"><span></span><span></span><span></span></button>
</div></header>
