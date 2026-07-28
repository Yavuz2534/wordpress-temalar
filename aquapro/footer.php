<?php
/**
 * Site footer: widget columns, footer menu, credit, mobile call bar.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$aqua_phone = aquapro_opt( 'phone' );
$aqua_tel   = aquapro_tel( $aqua_phone );
$aqua_wa    = aquapro_tel( aquapro_opt( 'whatsapp' ) );
$aqua_year  = date_i18n( 'Y' );
$aqua_name  = aquapro_opt( 'company', get_bloginfo( 'name' ) );
?>
<footer id="colophon" class="aqua-footer">
	<div class="aqua-wrap">
		<div class="aqua-footer__grid">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
					<div class="aqua-footer__col"><?php dynamic_sidebar( 'footer-' . $i ); ?></div>
				<?php elseif ( 1 === $i ) : ?>
					<div class="aqua-footer__col">
						<h2 class="widget-title"><?php echo esc_html( $aqua_name ); ?></h2>
						<p><?php echo esc_html( aquapro_opt( 'tagline' ) ); ?></p>
						<p>
							<?php if ( $aqua_phone ) : ?><a href="tel:<?php echo esc_attr( $aqua_tel ); ?>"><?php echo esc_html( $aqua_phone ); ?></a><br><?php endif; ?>
							<?php if ( aquapro_opt( 'email' ) ) : ?><a href="mailto:<?php echo esc_attr( aquapro_opt( 'email' ) ); ?>"><?php echo esc_html( aquapro_opt( 'email' ) ); ?></a><?php endif; ?>
						</p>
					</div>
				<?php endif; ?>
			<?php endfor; ?>
		</div>

		<div class="aqua-footer__bottom">
			<p class="aqua-footer__credit">
				<?php
				$credit = aquapro_opt( 'footer_credit' );
				if ( $credit ) {
					echo wp_kses_post( $credit );
				} else {
					/* translators: 1: year, 2: company */
					printf( esc_html__( '© %1$s %2$s. All rights reserved.', 'aquapro' ), esc_html( $aqua_year ), esc_html( $aqua_name ) );
				}
				?>
			</p>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => 'nav',
						'menu_class'     => 'aqua-footer__menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
			}
			?>
		</div>
	</div>
</footer>

<div class="aqua-callbar">
	<?php if ( $aqua_phone ) : ?>
		<a class="aqua-callbar__call" href="tel:<?php echo esc_attr( $aqua_tel ); ?>"><?php aquapro_icon( 'phone', 18 ); ?> <?php esc_html_e( 'Call Now', 'aquapro' ); ?></a>
	<?php endif; ?>
	<?php if ( $aqua_wa ) : ?>
		<a class="aqua-callbar__wa" href="https://wa.me/<?php echo esc_attr( $aqua_wa ); ?>" target="_blank" rel="noopener"><?php aquapro_icon( 'chat', 18 ); ?> <?php esc_html_e( 'WhatsApp', 'aquapro' ); ?></a>
	<?php endif; ?>
</div>

<?php wp_footer(); ?>
</body>
</html>
