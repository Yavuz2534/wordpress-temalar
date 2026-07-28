<?php
/** @package saglik-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$phone = sp_opt( 'phone', '0212 000 00 00' ); $tel = sp_tel( $phone );
$wa = sp_tel( sp_opt( 'whatsapp', '905000000000' ) );
$name = sp_opt( 'name', 'Yaşam Sağlık Merkezi' ); $email = sp_opt( 'email', 'info@yasamsaglik.com' );
$address = sp_opt( 'address', 'Nişantaşı, İstanbul' );
?>
<footer class="s-footer" id="iletisim"><div class="s-wrap">
	<div class="s-footer__grid">
		<div>
			<h4><?php echo esc_html( $name ); ?></h4>
			<p>Uzman kadromuz ve modern teknolojimizle sağlığınız için buradayız.</p>
		</div>
		<div>
			<h4>Hizmetler</h4>
			<ul><?php foreach ( array_slice( sp_services(), 0, 5 ) as $s ) : ?><li><a href="#hizmetler"><?php echo esc_html( $s['title'] ); ?></a></li><?php endforeach; ?></ul>
		</div>
		<div>
			<h4>Klinik</h4>
			<ul><li><a href="#doktorlar">Doktorlar</a></li><li><a href="#surec">Süreç</a></li><li><a href="#sss">S.S.S.</a></li></ul>
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
	<div class="s-footer__bottom">© <?php echo esc_html( date_i18n( 'Y' ) . ' ' . $name ); ?> · Tüm hakları saklıdır.<br><small>Tasarım &amp; Kod © Yavuz Selim Aykaç</small></div>
</div></footer>
<div class="s-mobilebar">
	<a class="m-call" href="tel:<?php echo esc_attr( $tel ); ?>">📞 Ara</a>
	<a class="m-appt" href="https://wa.me/<?php echo esc_attr( $wa ); ?>" target="_blank" rel="noopener">📅 Randevu</a>
</div>
<?php wp_footer(); ?>
</body></html>
