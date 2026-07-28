<?php
/** Kurumsal Pro — kurulum, özelleştirici, içerik. @package kurumsal-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function kp_opt( $key, $default = '' ) { return get_theme_mod( 'kp_' . $key, $default ); }
function kp_tel( $raw ) { return preg_replace( '/[^0-9+]/', '', $raw ); }

function kp_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'style', 'script', 'caption' ) );
	register_nav_menus( array( 'primary' => 'Üst menü' ) );
}
add_action( 'after_setup_theme', 'kp_setup' );
function kp_assets() { wp_enqueue_style( 'kurumsal-pro', get_stylesheet_uri(), array(), '1.0.0' ); }
add_action( 'wp_enqueue_scripts', 'kp_assets' );

function kp_ctrl( $wp, $sec, $key, $label, $def, $type = 'text' ) {
	$s = ( 'textarea' === $type ) ? 'sanitize_textarea_field' : 'sanitize_text_field';
	$wp->add_setting( 'kp_' . $key, array( 'default' => $def, 'sanitize_callback' => $s ) );
	$wp->add_control( 'kp_' . $key, array( 'label' => $label, 'section' => $sec, 'type' => $type ) );
}
function kp_customize( $wp ) {
	$wp->add_section( 'kp_company', array( 'title' => '1) Firma Bilgileri', 'priority' => 20 ) );
	kp_ctrl( $wp, 'kp_company', 'name',    'Firma adı',        'Yıldız Danışmanlık' );
	kp_ctrl( $wp, 'kp_company', 'tagline', 'Slogan',           'Hukuk & Danışmanlık' );
	kp_ctrl( $wp, 'kp_company', 'phone',   'Telefon',          '0212 000 00 00' );
	kp_ctrl( $wp, 'kp_company', 'whatsapp','WhatsApp (90...)', '905000000000' );
	kp_ctrl( $wp, 'kp_company', 'email',   'E-posta',          'info@yildizdanismanlik.com' );
	kp_ctrl( $wp, 'kp_company', 'address', 'Adres',            'Levent, İstanbul' );
	kp_ctrl( $wp, 'kp_company', 'maparea', 'Harita konumu',    'Levent İstanbul' );

	$wp->add_section( 'kp_hero', array( 'title' => '2) Üst Bölüm (Hero)', 'priority' => 21 ) );
	kp_ctrl( $wp, 'kp_hero', 'hero_badge', 'Rozet',     'Güvenilir Çözüm Ortağınız' );
	kp_ctrl( $wp, 'kp_hero', 'hero_title', 'Başlık',     'İşinizi Büyütmenin Güvenilir Yolu' );
	kp_ctrl( $wp, 'kp_hero', 'hero_lead',  'Alt yazı',   'Uzman kadromuzla hukuki, mali ve stratejik danışmanlık hizmetleri sunuyoruz. Doğru kararlar, güçlü sonuçlar.', 'textarea' );
	kp_ctrl( $wp, 'kp_hero', 'cta_title',  'Çağrı başlığı', 'Ücretsiz Ön Görüşme' );
	kp_ctrl( $wp, 'kp_hero', 'cta_text',   'Çağrı yazısı',  'Durumunuzu değerlendirelim, size en uygun çözümü birlikte belirleyelim.', 'textarea' );
}
add_action( 'customize_register', 'kp_customize' );

function kp_services() {
	return array(
		array( 'icon' => '⚖️', 'title' => 'Hukuki Danışmanlık', 'desc' => 'Sözleşme, dava ve uyuşmazlık süreçlerinde uzman hukuki destek.' ),
		array( 'icon' => '📊', 'title' => 'Mali Müşavirlik',     'desc' => 'Muhasebe, vergi planlaması ve denetim hizmetleri.' ),
		array( 'icon' => '📈', 'title' => 'Strateji & Yönetim',  'desc' => 'İş geliştirme, süreç yönetimi ve büyüme stratejileri.' ),
		array( 'icon' => '🏢', 'title' => 'Şirket Kuruluşu',     'desc' => 'Kuruluş, birleşme ve yapılandırma işlemlerinde uçtan uca destek.' ),
		array( 'icon' => '🤝', 'title' => 'İnsan Kaynakları',    'desc' => 'İşe alım, bordro ve İK süreçlerinin profesyonel yönetimi.' ),
		array( 'icon' => '🛡️', 'title' => 'Risk & Uyum',         'desc' => 'Yasal uyum, KVKK ve kurumsal risk yönetimi danışmanlığı.' ),
	);
}
function kp_stats() {
	return array(
		array( 'num' => '20+',  'label' => 'Yıl Deneyim' ),
		array( 'num' => '500+', 'label' => 'Mutlu Müşteri' ),
		array( 'num' => '%98',  'label' => 'Başarı Oranı' ),
		array( 'num' => '24/7', 'label' => 'Destek' ),
	);
}
function kp_steps() {
	return array(
		array( 'title' => 'Görüşme',     'desc' => 'İhtiyacınızı dinler, durumu analiz ederiz.' ),
		array( 'title' => 'Plan',        'desc' => 'Size özel bir çözüm yol haritası sunarız.' ),
		array( 'title' => 'Uygulama',    'desc' => 'Süreci profesyonelce yürütürüz.' ),
		array( 'title' => 'Takip',       'desc' => 'Sonuçları izler, sürekli destek veririz.' ),
	);
}
function kp_team() {
	return array(
		array( 'name' => 'Av. Selin Yıldız', 'role' => 'Kurucu Ortak' ),
		array( 'name' => 'SMMM Kaan Demir',  'role' => 'Mali Müşavir' ),
		array( 'name' => 'Dr. Ece Aydın',    'role' => 'Strateji Danışmanı' ),
	);
}
