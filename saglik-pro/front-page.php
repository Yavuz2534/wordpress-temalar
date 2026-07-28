<?php
/** Ana sayfa — Sağlık/Klinik. @package saglik-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = sp_opt( 'phone', '0212 000 00 00' ); $tel = sp_tel( $phone );
$wa = sp_tel( sp_opt( 'whatsapp', '905000000000' ) );
$maparea = sp_opt( 'maparea', 'Nişantaşı İstanbul' );
get_header();
?>
<section class="s-hero"><div class="s-wrap">
	<div>
		<span class="s-hero__badge">✚ <?php echo esc_html( sp_opt( 'hero_badge', 'Uzman Kadro & Modern Teknoloji' ) ); ?></span>
		<h1><?php echo esc_html( sp_opt( 'hero_title', 'Sağlığınız Güvenilir Ellerde' ) ); ?></h1>
		<p class="s-hero__lead"><?php echo esc_html( sp_opt( 'hero_lead', 'Alanında uzman doktorlarımız ve modern cihazlarımızla, size özel tedavi ve bakım hizmetleri sunuyoruz.' ) ); ?></p>
		<div class="s-hero__actions">
			<a class="s-btn s-btn--primary s-btn--lg" href="tel:<?php echo esc_attr( $tel ); ?>">📞 Randevu: <?php echo esc_html( $phone ); ?></a>
			<a class="s-btn s-btn--ghost s-btn--lg" href="#hizmetler">Hizmetlerimiz</a>
		</div>
	</div>
	<div class="s-hero__card">
		<h3>Hızlı Randevu</h3>
		<p>İhtiyacınız olan bölümü seçin, sizi arayalım.</p>
		<ul class="s-hero__list">
			<?php foreach ( array_slice( sp_services(), 0, 4 ) as $s ) : ?>
				<li><span class="s-hero__chk"><?php echo esc_html( $s['icon'] ); ?></span> <?php echo esc_html( $s['title'] ); ?></li>
			<?php endforeach; ?>
		</ul>
		<a class="s-btn s-btn--primary" style="width:100%; justify-content:center; margin-top:18px;" href="tel:<?php echo esc_attr( $tel ); ?>">Hemen Randevu Al</a>
	</div>
</div></section>

<section class="s-stats"><div class="s-wrap">
	<div class="s-stats__grid">
		<?php foreach ( sp_stats() as $s ) : ?><div class="s-stat"><div class="s-stat__num"><?php echo esc_html( $s['num'] ); ?></div><div class="s-stat__label"><?php echo esc_html( $s['label'] ); ?></div></div><?php endforeach; ?>
	</div>
</div></section>

<section class="s-section" id="hizmetler"><div class="s-wrap">
	<div class="s-center" style="margin-bottom:48px;"><span class="s-eyebrow">Hizmetlerimiz</span><h2 class="s-h2">Kapsamlı Sağlık Hizmetleri</h2><p class="s-lead">Tek bir merkezde, tüm sağlık ihtiyaçlarınız için uzman ekip.</p></div>
	<div class="s-marquee" aria-label="Hizmetlerimiz">
		<div class="s-marquee__track">
			<?php
			$sp_serv = sp_services();
			foreach ( array( 1, 2 ) as $sp_pass ) :
				foreach ( $sp_serv as $s ) : ?>
					<div class="s-card"<?php echo 2 === $sp_pass ? ' aria-hidden="true"' : ''; ?>><div class="s-card__ico"><?php echo esc_html( $s['icon'] ); ?></div><h3><?php echo esc_html( $s['title'] ); ?></h3><p><?php echo esc_html( $s['desc'] ); ?></p></div>
				<?php endforeach;
			endforeach; ?>
		</div>
	</div>
</div></section>

<section class="s-section s-section--soft" id="doktorlar"><div class="s-wrap">
	<div class="s-center" style="margin-bottom:48px;"><span class="s-eyebrow">Doktorlarımız</span><h2 class="s-h2">Uzman Kadromuz</h2></div>
	<div class="s-team">
		<?php foreach ( sp_docs() as $d ) : ?>
			<div class="s-doc"><div class="s-doc__av">👨‍⚕️</div><h4><?php echo esc_html( $d['name'] ); ?></h4><span><?php echo esc_html( $d['role'] ); ?></span></div>
		<?php endforeach; ?>
	</div>
</div></section>

<section class="s-section" id="surec"><div class="s-wrap">
	<div class="s-center" style="margin-bottom:48px;"><span class="s-eyebrow">Nasıl Çalışır</span><h2 class="s-h2">4 Adımda Tedavi</h2></div>
	<div class="s-steps">
		<?php $i=1; foreach ( sp_steps() as $st ) : ?>
			<div class="s-step"><div class="s-step__num"><?php echo esc_html( $i++ ); ?></div><h4><?php echo esc_html( $st['title'] ); ?></h4><p><?php echo esc_html( $st['desc'] ); ?></p></div>
		<?php endforeach; ?>
	</div>
</div></section>

<section class="s-section s-section--soft"><div class="s-wrap">
	<div class="s-cta">
		<h2><?php echo esc_html( sp_opt( 'cta_title', 'Randevu Almak İçin Arayın' ) ); ?></h2>
		<p><?php echo esc_html( sp_opt( 'cta_text', 'Sağlığınızı erteleme. Uzman kadromuzla tanışmak için hemen randevu alın.' ) ); ?></p>
		<div class="s-cta__actions">
			<a class="s-btn s-btn--primary s-btn--lg" href="tel:<?php echo esc_attr( $tel ); ?>">📞 <?php echo esc_html( $phone ); ?></a>
			<a class="s-btn s-btn--light s-btn--lg" href="https://wa.me/<?php echo esc_attr( $wa ); ?>" target="_blank" rel="noopener">💬 WhatsApp</a>
		</div>
	</div>
</div></section>

<section class="s-section" id="sss"><div class="s-wrap">
	<div class="s-center" style="margin-bottom:48px;"><span class="s-eyebrow">S.S.S.</span><h2 class="s-h2">Sık Sorulan Sorular</h2></div>
	<div class="s-faq">
		<?php foreach ( sp_faq() as $f ) : ?>
			<details><summary><?php echo esc_html( $f['q'] ); ?></summary><p><?php echo esc_html( $f['a'] ); ?></p></details>
		<?php endforeach; ?>
	</div>
</div></section>

<section class="s-section s-section--soft"><div class="s-wrap">
	<div class="s-center" style="margin-bottom:48px;"><span class="s-eyebrow">İletişim</span><h2 class="s-h2">Bize Ulaşın</h2></div>
	<div class="s-contact">
		<div>
			<div class="s-citem"><div class="s-citem__ico">📞</div><div><strong>Telefon</strong><a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a></div></div>
			<div class="s-citem"><div class="s-citem__ico">✉️</div><div><strong>E-posta</strong><a href="mailto:<?php echo esc_attr( sp_opt('email','info@yasamsaglik.com') ); ?>"><?php echo esc_html( sp_opt('email','info@yasamsaglik.com') ); ?></a></div></div>
			<div class="s-citem"><div class="s-citem__ico">📍</div><div><strong>Adres</strong><span><?php echo esc_html( sp_opt('address','Nişantaşı, İstanbul') ); ?></span></div></div>
			<div class="s-citem"><div class="s-citem__ico">🕐</div><div><strong>Çalışma Saatleri</strong><span><?php echo esc_html( sp_opt('hours','Hafta içi 09:00–19:00') ); ?></span></div></div>
		</div>
		<div class="s-map"><iframe loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=<?php echo esc_attr( rawurlencode( $maparea ) ); ?>&output=embed"></iframe></div>
	</div>
</div></section>

<?php get_footer(); ?>
