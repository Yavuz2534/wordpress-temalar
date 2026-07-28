<?php
/**
 * 404 template.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$tel = aquapro_tel( aquapro_opt( 'phone' ) );
?>
<main id="primary" class="aqua-container">
	<div class="aqua-wrap aqua-wrap--narrow aqua-404">
		<p class="aqua-404__code">404</p>
		<h1 class="aqua-sec-title"><?php esc_html_e( 'Page not found', 'aquapro' ); ?></h1>
		<p class="aqua-lead aqua-lead--center"><?php esc_html_e( 'The page you are looking for has moved or no longer exists.', 'aquapro' ); ?></p>
		<div class="aqua-404__actions">
			<a class="aqua-btn aqua-btn--accent" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'aquapro' ); ?></a>
			<?php if ( $tel ) : ?><a class="aqua-btn aqua-btn--outline" href="tel:<?php echo esc_attr( $tel ); ?>"><?php esc_html_e( 'Call Us', 'aquapro' ); ?></a><?php endif; ?>
		</div>
		<div class="aqua-404__search"><?php get_search_form(); ?></div>
	</div>
</main>
<?php
get_footer();
