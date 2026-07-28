<?php
/** Ana sayfa — Kurumsal. @package kurumsal-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = kp_opt( 'phone', '0212 000 00 00' ); $tel = kp_tel( $phone );
$wa = kp_tel( kp_opt( 'whatsapp', '905000000000' ) );
$maparea = kp_opt( 'maparea', 'Levent İstanbul' );
get_header();
?>
<section class="k-hero"><div class="k-wrap">
	<div>
		<span class="k-hero__badge">✦ <?php echo esc_html( kp_opt( 'hero_badge', 'Güvenilir Çözüm Ortağınız' ) ); ?></span>
		<h1><?php echo esc_html( kp_opt( 'hero_title', 'İşinizi Büyütmenin Güvenilir Yolu' ) ); ?></h1>
		<p class="k-hero__lead"><?php echo esc_html( kp_opt( 'hero_lead', 'Uzman kadromuzla hukuki, mali ve stratejik danışmanlık hizmetleri sunuyoruz. Doğru kararlar, güçlü sonuçlar.' ) ); ?></p>
		<div class="k-hero__actions">
			<a class="k-btn k-btn--primary k-btn--lg" href="tel:<?php echo esc_attr( $tel ); ?>">📞 Hemen Ara</a>
			<a class="k-btn k-btn--ghost k-btn--lg" href="#hizmetler">Hizmetlerimiz</a>
		</div>
	</div>
	<div class="k-hero__card">
		<h3>Neden Bizi Seçmelisiniz?</h3>
		<ul class="k-hero__list">
			<li><span class="k-hero__chk">✓</span> 20+ yıl sektör deneyimi</li>
			<li><span class="k-hero__chk">✓</span> Uzman ve sertifikalı kadro</li>
			<li><span class="k-hero__chk">✓</span> Şeffaf ve net fiyatlandırma</li>
			<li><span class="k-hero__chk">✓</span> Size özel çözüm yaklaşımı</li>
		</ul>
		<a class="k-btn k-btn--primary" style="width:100%; justify-content:center; margin-top:18px;" href="tel:<?php echo esc_attr( $tel ); ?>">Ücretsiz Ön Görüşme</a>
	</div>
</div></section>

<section class="k-stats"><div class="k-wrap">
	<div class="k-stats__grid">
		<?php foreach ( kp_stats() as $s ) : ?><div class="k-stat"><div class="k-stat__num"><?php echo esc_html( $s['num'] ); ?></div><div class="k-stat__label"><?php echo esc_html( $s['label'] ); ?></div></div><?php endforeach; ?>
	</div>
</div></section>

<section class="k-section" id="hizmetler"><div class="k-wrap">
	<div class="k-center" style="margin-bottom:48px;"><span class="k-eyebrow">Hizmetlerimiz</span><h2 class="k-h2">Size Özel Profesyonel Çözümler</h2><p class="k-lead">İşinizin her alanında, uzman ekibimizle yanınızdayız.</p></div>
	<div class="k-grid k-grid--3">
		<?php foreach ( kp_services() as $s ) : ?>
			<div class="k-card"><div class="k-card__ico"><?php echo esc_html( $s['icon'] ); ?></div><h3><?php echo esc_html( $s['title'] ); ?></h3><p><?php echo esc_html( $s['desc'] ); ?></p></div>
		<?php endforeach; ?>
	</div>
</div></section>

<section class="k-section k-section--soft" id="surec"><div class="k-wrap">
	<div class="k-center" style="margin-bottom:48px;"><span class="k-eyebrow">Nasıl Çalışırız</span><h2 class="k-h2">4 Adımda Sonuç</h2></div>
	<div class="k-steps">
		<?php $i=1; foreach ( kp_steps() as $st ) : ?>
			<div class="k-step"><div class="k-step__num"><?php echo esc_html( $i++ ); ?></div><h4><?php echo esc_html( $st['title'] ); ?></h4><p><?php echo esc_html( $st['desc'] ); ?></p></div>
		<?php endforeach; ?>
	</div>
</div></section>

<section class="k-section" id="ekip"><div class="k-wrap">
	<div class="k-center" style="margin-bottom:48px;"><span class="k-eyebrow">Ekibimiz</span><h2 class="k-h2">Uzman Kadromuz</h2></div>
	<div class="k-team">
		<?php foreach ( kp_team() as $m ) : ?>
			<div class="k-member"><div class="k-member__av"><?php echo esc_html( mb_substr( $m['name'], 0, 1 ) ); ?></div><h4><?php echo esc_html( $m['name'] ); ?></h4><span><?php echo esc_html( $m['role'] ); ?></span></div>
		<?php endforeach; ?>
	</div>
</div></section>

<section class="k-section k-section--soft"><div class="k-wrap">
	<div class="k-cta">
		<h2><?php echo esc_html( kp_opt( 'cta_title', 'Ücretsiz Ön Görüşme' ) ); ?></h2>
		<p><?php echo esc_html( kp_opt( 'cta_text', 'Durumunuzu değerlendirelim, size en uygun çözümü birlikte belirleyelim.' ) ); ?></p>
		<div class="k-cta__actions">
			<a class="k-btn k-btn--primary k-btn--lg" href="tel:<?php echo esc_attr( $tel ); ?>">📞 <?php echo esc_html( $phone ); ?></a>
			<a class="k-btn k-btn--light k-btn--lg" href="https://wa.me/<?php echo esc_attr( $wa ); ?>" target="_blank" rel="noopener">💬 WhatsApp</a>
		</div>
	</div>
</div></section>

<section class="k-section"><div class="k-wrap">
	<div class="k-center" style="margin-bottom:48px;"><span class="k-eyebrow">İletişim</span><h2 class="k-h2">Bize Ulaşın</h2></div>
	<div class="k-contact">
		<div>
			<div class="k-citem"><div class="k-citem__ico">📞</div><div><strong>Telefon</strong><a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a></div></div>
			<div class="k-citem"><div class="k-citem__ico">✉️</div><div><strong>E-posta</strong><a href="mailto:<?php echo esc_attr( kp_opt('email','info@yildizdanismanlik.com') ); ?>"><?php echo esc_html( kp_opt('email','info@yildizdanismanlik.com') ); ?></a></div></div>
			<div class="k-citem"><div class="k-citem__ico">📍</div><div><strong>Adres</strong><span><?php echo esc_html( kp_opt('address','Levent, İstanbul') ); ?></span></div></div>
		</div>
		<div class="k-map"><iframe loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=<?php echo esc_attr( rawurlencode( $maparea ) ); ?>&output=embed"></iframe></div>
	</div>
</div></section>

<?php get_footer(); ?>
