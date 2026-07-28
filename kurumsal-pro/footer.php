<?php
/** @package kurumsal-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = kp_opt( 'phone', '0212 000 00 00' ); $tel = kp_tel( $phone );
$wa = kp_tel( kp_opt( 'whatsapp', '905000000000' ) );
$name = kp_opt( 'name', 'Yıldız Danışmanlık' ); $email = kp_opt( 'email', 'info@yildizdanismanlik.com' );
$address = kp_opt( 'address', 'Levent, İstanbul' );
?>
<footer class="k-footer" id="iletisim"><div class="k-wrap">
	<div class="k-footer__grid">
		<div>
			<h4><?php echo esc_html( $name ); ?></h4>
			<p>Hukuki, mali ve stratejik danışmanlıkta güvenilir çözüm ortağınız.</p>
		</div>
		<div>
			<h4>Hizmetler</h4>
			<ul><?php foreach ( array_slice( kp_services(), 0, 5 ) as $s ) : ?><li><a href="#hizmetler"><?php echo esc_html( $s['title'] ); ?></a></li><?php endforeach; ?></ul>
		</div>
		<div>
			<h4>Kurumsal</h4>
			<ul><li><a href="#surec">Süreç</a></li><li><a href="#ekip">Ekip</a></li><li><a href="#hizmetler">Hizmetler</a></li></ul>
		</div>
		<div>
			<h4>İletişim</h4>
			<ul>
				<li>📞 <a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a></li>
				<li>💬 <a href="https://wa.me/<?php echo esc_attr( $wa ); ?>" target="_blank" rel="noopener">WhatsApp</a></li>
				<li>✉️ <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
				<li>📍 <?php echo esc_html( $address ); ?></li>
			</ul>
		</div>
	</div>
	<div class="k-footer__bottom">© <?php echo esc_html( date_i18n( 'Y' ) . ' ' . $name ); ?> · Tüm hakları saklıdır.</div>
</div></footer>
<div class="k-mobilebar">
	<a class="m-call" href="tel:<?php echo esc_attr( $tel ); ?>">📞 Ara</a>
	<a class="m-offer" href="https://wa.me/<?php echo esc_attr( $wa ); ?>" target="_blank" rel="noopener">💬 Teklif Al</a>
</div>
<?php wp_footer(); ?>
</body></html>
