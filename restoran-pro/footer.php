<?php
/** @package restoran-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = rp_opt( 'phone', '0212 000 00 00' ); $tel = rp_tel( $phone );
$wa = rp_tel( rp_opt( 'whatsapp', '905000000000' ) );
$name = rp_opt( 'name', 'Lezzet Durağı' ); $email = rp_opt( 'email', 'info@lezzetduragi.com' );
$address = rp_opt( 'address', 'Bağdat Cad. No:1, İstanbul' );
?>
<footer class="r-footer" id="iletisim"><div class="r-wrap">
	<div class="r-footer__grid">
		<div>
			<h4><?php echo esc_html( $name ); ?></h4>
			<p>Taze lezzetler ve sıcak bir atmosferle sizi ağırlamaktan mutluluk duyarız.</p>
		</div>
		<div>
			<h4>Bağlantılar</h4>
			<ul>
				<li><a href="#menu">Menü</a></li>
				<li><a href="#hakkinda">Hakkımızda</a></li>
				<li><a href="#saatler">Çalışma Saatleri</a></li>
			</ul>
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
	<div class="r-footer__bottom">© <?php echo esc_html( date_i18n( 'Y' ) . ' ' . $name ); ?> · Tüm hakları saklıdır.<br><small>Tasarım &amp; Kod © Yavuz Selim Aykaç</small></div>
</div></footer>
<div class="r-mobilebar">
	<a class="m-call" href="tel:<?php echo esc_attr( $tel ); ?>">📞 Ara</a>
	<a class="m-res" href="tel:<?php echo esc_attr( $tel ); ?>">🍽️ Rezervasyon</a>
</div>
<?php wp_footer(); ?>
</body></html>
