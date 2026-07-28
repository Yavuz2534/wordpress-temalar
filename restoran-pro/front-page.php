<?php
/** Ana sayfa — Restoran. @package restoran-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = rp_opt( 'phone', '0212 000 00 00' ); $tel = rp_tel( $phone );
$wa = rp_tel( rp_opt( 'whatsapp', '905000000000' ) );
$maparea = rp_opt( 'maparea', 'İstanbul' );
get_header();
?>
<section class="r-hero"><div class="r-wrap">
	<span class="r-hero__eyebrow"><?php echo esc_html( rp_opt( 'hero_eyebrow', 'Hoş Geldiniz' ) ); ?></span>
	<h1><?php echo esc_html( rp_opt( 'hero_title', 'Taze Lezzetler, Sıcak Bir Atmosfer' ) ); ?></h1>
	<p class="r-hero__lead"><?php echo esc_html( rp_opt( 'hero_lead', 'Usta şeflerimizin elinden çıkan mevsimlik tabaklar, özenle seçilmiş malzemeler ve unutulmaz bir yemek deneyimi sizi bekliyor.' ) ); ?></p>
	<div class="r-hero__actions">
		<a class="r-btn r-btn--gold r-btn--lg" href="tel:<?php echo esc_attr( $tel ); ?>">📞 Rezervasyon: <?php echo esc_html( $phone ); ?></a>
		<a class="r-btn r-btn--ghost r-btn--lg" href="#menu">Menüyü Gör</a>
	</div>
</div></section>

<div class="r-strip"><div class="r-wrap">
	<?php foreach ( rp_strip() as $s ) : ?>
		<div class="r-strip__item"><b><?php echo esc_html( $s['b'] ); ?></b><span><?php echo esc_html( $s['s'] ); ?></span></div>
	<?php endforeach; ?>
</div></div>

<section class="r-section" id="hakkinda"><div class="r-wrap">
	<div class="r-about">
		<div>
			<span class="r-eyebrow">Hakkımızda</span>
			<h2 class="r-h2">Lezzetin ve Misafirperverliğin Buluştuğu Yer</h2>
			<p class="r-lead" style="margin-bottom:18px;">Yıllardır aynı tutkuyla, taze malzemeler ve geleneksel tariflerle yemek pişiriyoruz. Her tabak, sizi özel hissettirmek için özenle hazırlanır.</p>
			<a class="r-btn r-btn--call" href="#menu">Menüyü İncele</a>
		</div>
		<div class="r-about__img">🍲</div>
	</div>
</div></section>

<section class="r-section r-section--soft" id="neden"><div class="r-wrap">
	<div class="r-center" style="margin-bottom:46px;"><span class="r-eyebrow">Neden Biz</span><h2 class="r-h2">Bizi Özel Kılan</h2></div>
	<div class="r-grid3">
		<?php foreach ( rp_features() as $f ) : ?>
			<div class="r-card"><div class="r-card__ico"><?php echo esc_html( $f['icon'] ); ?></div><h3><?php echo esc_html( $f['title'] ); ?></h3><p><?php echo esc_html( $f['desc'] ); ?></p></div>
		<?php endforeach; ?>
	</div>
</div></section>

<section class="r-section" id="menu"><div class="r-wrap">
	<div class="r-center" style="margin-bottom:46px;"><span class="r-eyebrow">Menümüz</span><h2 class="r-h2">Öne Çıkan Lezzetler</h2></div>
	<div class="r-menu-grid">
		<?php foreach ( rp_menu() as $m ) : ?>
			<div class="r-menu-item"><div><h4><?php echo esc_html( $m['name'] ); ?></h4><p><?php echo esc_html( $m['desc'] ); ?></p></div><span class="r-menu-item__price"><?php echo esc_html( $m['price'] ); ?></span></div>
		<?php endforeach; ?>
	</div>
</div></section>

<section class="r-section r-section--soft"><div class="r-wrap">
	<div class="r-cta">
		<h2><?php echo esc_html( rp_opt( 'res_title', 'Masanızı Şimdi Ayırtın' ) ); ?></h2>
		<p><?php echo esc_html( rp_opt( 'res_text', 'Akşam yemeği için yer sınırlı. Rezervasyon için hemen arayın.' ) ); ?></p>
		<div class="r-hero__actions" style="justify-content:center;">
			<a class="r-btn r-btn--gold r-btn--lg" href="tel:<?php echo esc_attr( $tel ); ?>">📞 <?php echo esc_html( $phone ); ?></a>
			<a class="r-btn r-btn--ghost r-btn--lg" href="https://wa.me/<?php echo esc_attr( $wa ); ?>" target="_blank" rel="noopener">💬 WhatsApp</a>
		</div>
	</div>
</div></section>

<section class="r-section" id="saatler"><div class="r-wrap">
	<div class="r-info">
		<div>
			<span class="r-eyebrow">Çalışma Saatleri</span>
			<h2 class="r-h2">Sizi Bekliyoruz</h2>
			<ul class="r-hours">
				<?php foreach ( rp_hours() as $h ) : ?>
					<li><b><?php echo esc_html( $h['d'] ); ?></b><span><?php echo esc_html( $h['h'] ); ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="r-map"><iframe loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=<?php echo esc_attr( rawurlencode( $maparea ) ); ?>&output=embed"></iframe></div>
	</div>
</div></section>

<?php get_footer(); ?>
