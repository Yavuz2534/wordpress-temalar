<?php
/**
 * Site header: top bar, sticky header, primary + mega menu, dark-mode toggle.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$aqua_phone = aquapro_opt( 'phone' );
$aqua_tel   = aquapro_tel( $aqua_phone );
$aqua_dark  = aquapro_opt( 'dark_mode', 'auto' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'aquapro' ); ?></a>

<?php if ( aquapro_opt( 'topbar', true ) ) : ?>
<div class="aqua-topbar">
	<div class="aqua-wrap aqua-topbar__inner">
		<p class="aqua-topbar__hours"><?php echo esc_html( aquapro_opt( 'hours' ) ); ?></p>
		<div class="aqua-topbar__contact">
			<?php if ( aquapro_opt( 'email' ) ) : ?>
				<a href="mailto:<?php echo esc_attr( aquapro_opt( 'email' ) ); ?>"><?php echo esc_html( aquapro_opt( 'email' ) ); ?></a>
			<?php endif; ?>
			<?php if ( $aqua_phone ) : ?>
				<a href="tel:<?php echo esc_attr( $aqua_tel ); ?>"><strong><?php echo esc_html( $aqua_phone ); ?></strong></a>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<header id="masthead" class="aqua-header" data-sticky="<?php echo aquapro_opt( 'sticky_header', true ) ? '1' : '0'; ?>">
	<div class="aqua-wrap aqua-header__inner">
		<div class="aqua-brand">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				printf(
					'<a class="aqua-brand__text" href="%1$s"><span class="aqua-brand__mark" aria-hidden="true">%2$s</span><span class="aqua-brand__name">%3$s<small>%4$s</small></span></a>',
					esc_url( home_url( '/' ) ),
					AquaPro_Template::icon( 'drop', 24 ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in icon().
					esc_html( aquapro_opt( 'company', get_bloginfo( 'name' ) ) ),
					esc_html( aquapro_opt( 'tagline' ) )
				);
			}
			?>
		</div>

		<nav class="aqua-nav" aria-label="<?php esc_attr_e( 'Primary', 'aquapro' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'aqua-menu',
					'fallback_cb'    => false,
					'depth'          => 3,
				)
			);
			?>
		</nav>

		<div class="aqua-header__actions">
			<?php if ( 'toggle' === $aqua_dark ) : ?>
				<button class="aqua-darktoggle" type="button" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'aquapro' ); ?>" data-aqua-darktoggle>
					<?php aquapro_icon( 'moon', 20 ); ?>
				</button>
			<?php endif; ?>

			<button class="aqua-search-trigger" type="button" aria-label="<?php esc_attr_e( 'Search', 'aquapro' ); ?>" data-aqua-search-open>
				<?php aquapro_icon( 'search', 20 ); ?>
			</button>

			<?php if ( $aqua_phone ) : ?>
				<a class="aqua-btn aqua-btn--accent aqua-header__cta" href="tel:<?php echo esc_attr( $aqua_tel ); ?>">
					<?php aquapro_icon( 'phone', 18 ); ?> <?php echo esc_html( $aqua_phone ); ?>
				</a>
			<?php endif; ?>

			<button class="aqua-burger" type="button" aria-expanded="false" aria-controls="aqua-mobile" aria-label="<?php esc_attr_e( 'Menu', 'aquapro' ); ?>" data-aqua-burger>
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>

	<div id="aqua-mobile" class="aqua-mobile" hidden>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => has_nav_menu( 'mobile' ) ? 'mobile' : 'primary',
				'container'      => false,
				'menu_class'     => 'aqua-mobile__menu',
				'fallback_cb'    => false,
			)
		);
		?>
	</div>
</header>

<div class="aqua-searchbar" hidden data-aqua-search>
	<div class="aqua-wrap">
		<label class="screen-reader-text" for="aqua-search-input"><?php esc_html_e( 'Search', 'aquapro' ); ?></label>
		<input id="aqua-search-input" type="search" placeholder="<?php esc_attr_e( 'Search services, projects…', 'aquapro' ); ?>" autocomplete="off" data-aqua-search-input>
		<ul class="aqua-search-results" data-aqua-search-results></ul>
	</div>
</div>
