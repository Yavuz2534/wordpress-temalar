<?php
/**
 * Restoran Pro — kurulum, özelleştirici ve içerik.
 * @package restoran-pro
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function rp_opt( $key, $default = '' ) { return get_theme_mod( 'rp_' . $key, $default ); }
function rp_tel( $raw ) { return preg_replace( '/[^0-9+]/', '', $raw ); }

function rp_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'style', 'script', 'caption' ) );
	register_nav_menus( array( 'primary' => 'Üst menü' ) );
}
add_action( 'after_setup_theme', 'rp_setup' );

function rp_assets() { wp_enqueue_style( 'restoran-pro', get_stylesheet_uri(), array(), '1.0.0' ); }
add_action( 'wp_enqueue_scripts', 'rp_assets' );

/* Özelleştirici */
function rp_ctrl( $wp, $sec, $key, $label, $def, $type = 'text' ) {
	$s = ( 'textarea' === $type ) ? 'sanitize_textarea_field' : 'sanitize_text_field';
	$wp->add_setting( 'rp_' . $key, array( 'default' => $def, 'sanitize_callback' => $s ) );
	$wp->add_control( 'rp_' . $key, array( 'label' => $label, 'section' => $sec, 'type' => $type ) );
}
function rp_customize( $wp ) {
	$wp->add_section( 'rp_company', array( 'title' => '1) İşletme Bilgileri', 'priority' => 20 ) );
	rp_ctrl( $wp, 'rp_company', 'name',    'İşletme adı',      'Lezzet Durağı' );
	rp_ctrl( $wp, 'rp_company', 'tagline', 'Slogan',           'Restoran & Kafe' );
	rp_ctrl( $wp, 'rp_company', 'phone',   'Telefon',          '0212 000 00 00' );
	rp_ctrl( $wp, 'rp_company', 'whatsapp','WhatsApp (90...)', '905000000000' );
	rp_ctrl( $wp, 'rp_company', 'address', 'Adres',            'Bağdat Cad. No:1, İstanbul' );
	rp_ctrl( $wp, 'rp_company', 'maparea', 'Harita konumu',    'İstanbul' );
	rp_ctrl( $wp, 'rp_company', 'email',   'E-posta',          'info@lezzetduragi.com' );

	$wp->add_section( 'rp_hero', array( 'title' => '2) Üst Bölüm (Hero)', 'priority' => 21 ) );
	rp_ctrl( $wp, 'rp_hero', 'hero_eyebrow', 'Üst etiket',  'Hoş Geldiniz' );
	rp_ctrl( $wp, 'rp_hero', 'hero_title',   'Başlık',       'Taze Lezzetler, Sıcak Bir Atmosfer' );
	rp_ctrl( $wp, 'rp_hero', 'hero_lead',    'Alt yazı',     'Usta şeflerimizin elinden çıkan mevsimlik tabaklar, özenle seçilmiş malzemeler ve unutulmaz bir yemek deneyimi sizi bekliyor.', 'textarea' );
	rp_ctrl( $wp, 'rp_hero', 'res_title',    'Çağrı başlığı','Masanızı Şimdi Ayırtın' );
	rp_ctrl( $wp, 'rp_hero', 'res_text',     'Çağrı yazısı', 'Akşam yemeği için yer sınırlı. Rezervasyon için hemen arayın.', 'textarea' );
}
add_action( 'customize_register', 'rp_customize' );

/* İçerik */
function rp_strip() {
	return array(
		array( 'b' => 'Taze & Mevsimlik', 's' => 'Günlük taze malzeme' ),
		array( 'b' => 'Usta Şefler',      's' => '20+ yıl deneyim' ),
		array( 'b' => 'Sıcak Atmosfer',   's' => 'Aile & arkadaş ortamı' ),
		array( 'b' => 'Vale & Otopark',   's' => 'Konforlu ulaşım' ),
	);
}
function rp_features() {
	return array(
		array( 'icon' => '👨‍🍳', 'title' => 'Usta Mutfağı', 'desc' => 'Deneyimli şeflerimizin özenle hazırladığı, taptaze tabaklar.' ),
		array( 'icon' => '🌿', 'title' => 'Taze Malzeme',  'desc' => 'Her gün seçilen mevsimlik ve yerel ürünlerle.' ),
		array( 'icon' => '🍷', 'title' => 'Özel Sunum',    'desc' => 'Şık sunum, zengin içecek menüsü ve sıcak servis.' ),
	);
}
function rp_menu() {
	return array(
		array( 'name' => 'Mevsim Salatası',     'desc' => 'Taze yeşillikler, ceviz, nar ekşisi',        'price' => '₺120' ),
		array( 'name' => 'Mantı',               'desc' => 'El açması, yoğurt ve tereyağlı sos',          'price' => '₺180' ),
		array( 'name' => 'Izgara Köfte',        'desc' => 'Közlenmiş sebze ve pilav eşliğinde',          'price' => '₺220' ),
		array( 'name' => 'Fırın Levrek',        'desc' => 'Mevsim sebzeleri ve limon sosu',              'price' => '₺320' ),
		array( 'name' => 'Künefe',              'desc' => 'Antep fıstığı ve kaymak ile',                 'price' => '₺140' ),
		array( 'name' => 'Türk Kahvesi',        'desc' => 'Geleneksel, lokum eşliğinde',                 'price' => '₺60' ),
	);
}
function rp_hours() {
	return array(
		array( 'd' => 'Pazartesi – Cuma', 'h' => '11:00 – 23:00' ),
		array( 'd' => 'Cumartesi',        'h' => '10:00 – 24:00' ),
		array( 'd' => 'Pazar',            'h' => '10:00 – 23:00' ),
	);
}
