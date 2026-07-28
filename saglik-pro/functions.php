<?php
/** Saglik Pro — kurulum, özelleştirici, içerik. @package saglik-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function sp_opt( $key, $default = '' ) { return get_theme_mod( 'sp_' . $key, $default ); }
function sp_tel( $raw ) { return preg_replace( '/[^0-9+]/', '', $raw ); }

function sp_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'style', 'script', 'caption' ) );
	register_nav_menus( array( 'primary' => 'Üst menü' ) );
}
add_action( 'after_setup_theme', 'sp_setup' );
function sp_assets() { wp_enqueue_style( 'saglik-pro', get_stylesheet_uri(), array(), '1.0.0' ); }
add_action( 'wp_enqueue_scripts', 'sp_assets' );

function sp_ctrl( $wp, $sec, $key, $label, $def, $type = 'text' ) {
	$s = ( 'textarea' === $type ) ? 'sanitize_textarea_field' : 'sanitize_text_field';
	$wp->add_setting( 'sp_' . $key, array( 'default' => $def, 'sanitize_callback' => $s ) );
	$wp->add_control( 'sp_' . $key, array( 'label' => $label, 'section' => $sec, 'type' => $type ) );
}
function sp_customize( $wp ) {
	$wp->add_section( 'sp_company', array( 'title' => '1) Klinik Bilgileri', 'priority' => 20 ) );
	sp_ctrl( $wp, 'sp_company', 'name',    'Klinik adı',       'Yaşam Sağlık Merkezi' );
	sp_ctrl( $wp, 'sp_company', 'tagline', 'Slogan',           'Sağlık & Bakım' );
	sp_ctrl( $wp, 'sp_company', 'phone',   'Telefon',          '0212 000 00 00' );
	sp_ctrl( $wp, 'sp_company', 'whatsapp','WhatsApp (90...)', '905000000000' );
	sp_ctrl( $wp, 'sp_company', 'email',   'E-posta',          'info@yasamsaglik.com' );
	sp_ctrl( $wp, 'sp_company', 'address', 'Adres',            'Nişantaşı, İstanbul' );
	sp_ctrl( $wp, 'sp_company', 'maparea', 'Harita konumu',    'Nişantaşı İstanbul' );
	sp_ctrl( $wp, 'sp_company', 'hours',   'Çalışma saatleri', 'Hafta içi 09:00–19:00' );

	$wp->add_section( 'sp_hero', array( 'title' => '2) Üst Bölüm (Hero)', 'priority' => 21 ) );
	sp_ctrl( $wp, 'sp_hero', 'hero_badge', 'Rozet',      'Uzman Kadro & Modern Teknoloji' );
	sp_ctrl( $wp, 'sp_hero', 'hero_title', 'Başlık',      'Sağlığınız Güvenilir Ellerde' );
	sp_ctrl( $wp, 'sp_hero', 'hero_lead',  'Alt yazı',    'Alanında uzman doktorlarımız ve modern cihazlarımızla, size özel tedavi ve bakım hizmetleri sunuyoruz.', 'textarea' );
	sp_ctrl( $wp, 'sp_hero', 'cta_title',  'Çağrı başlığı', 'Randevu Almak İçin Arayın' );
	sp_ctrl( $wp, 'sp_hero', 'cta_text',   'Çağrı yazısı',  'Sağlığınızı erteleme. Uzman kadromuzla tanışmak için hemen randevu alın.', 'textarea' );
}
add_action( 'customize_register', 'sp_customize' );

function sp_services() {
	return array(
		array( 'icon' => '🦷', 'title' => 'Diş Sağlığı',     'desc' => 'İmplant, ortodonti, beyazlatma ve genel diş tedavileri.' ),
		array( 'icon' => '❤️', 'title' => 'Dahiliye',         'desc' => 'Genel sağlık kontrolleri, tanı ve takip hizmetleri.' ),
		array( 'icon' => '💆', 'title' => 'Fizyoterapi',      'desc' => 'Ağrı tedavisi, rehabilitasyon ve manuel terapi.' ),
		array( 'icon' => '✨', 'title' => 'Estetik & Cilt',   'desc' => 'Cilt bakımı, dermatoloji ve estetik uygulamalar.' ),
		array( 'icon' => '🔬', 'title' => 'Laboratuvar',      'desc' => 'Hızlı ve güvenilir kan ve tahlil sonuçları.' ),
		array( 'icon' => '🩺', 'title' => 'Check-up',         'desc' => 'Kapsamlı sağlık tarama paketleri ile erken teşhis.' ),
	);
}
function sp_stats() {
	return array(
		array( 'num' => '15+',   'label' => 'Yıl Deneyim' ),
		array( 'num' => '30K+',  'label' => 'Mutlu Hasta' ),
		array( 'num' => '12',    'label' => 'Uzman Doktor' ),
		array( 'num' => '%99',   'label' => 'Memnuniyet' ),
	);
}
function sp_docs() {
	return array(
		array( 'name' => 'Dr. Elif Kaya',    'role' => 'Diş Hekimi' ),
		array( 'name' => 'Dr. Murat Şahin',  'role' => 'Dahiliye Uzmanı' ),
		array( 'name' => 'Fzt. Buse Yılmaz', 'role' => 'Fizyoterapist' ),
	);
}
function sp_steps() {
	return array(
		array( 'title' => 'Randevu', 'desc' => 'Telefon veya WhatsApp ile randevu alın.' ),
		array( 'title' => 'Muayene', 'desc' => 'Uzman doktorumuz sizi değerlendirir.' ),
		array( 'title' => 'Tedavi',  'desc' => 'Size özel tedavi planı uygulanır.' ),
		array( 'title' => 'Takip',   'desc' => 'İyileşme sürecinizi birlikte izleriz.' ),
	);
}
function sp_faq() {
	return array(
		array( 'q' => 'Randevu nasıl alabilirim?', 'a' => 'Telefon veya WhatsApp üzerinden kolayca randevu alabilirsiniz. Size en uygun gün ve saati birlikte belirleriz.' ),
		array( 'q' => 'Anlaşmalı sigortalar var mı?', 'a' => 'Birçok özel sağlık sigortasıyla anlaşmamız bulunmaktadır. Detaylar için bizi arayabilirsiniz.' ),
		array( 'q' => 'İlk muayene ücretli mi?', 'a' => 'İlk değerlendirme görüşmemiz hakkında bilgi almak için bizimle iletişime geçin; size net bilgi verelim.' ),
		array( 'q' => 'Acil durumda ulaşabilir miyim?', 'a' => 'Çalışma saatleri içinde telefonla bize her zaman ulaşabilirsiniz; yönlendirme yaparız.' ),
	);
}
