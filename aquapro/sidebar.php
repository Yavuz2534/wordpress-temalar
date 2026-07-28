<?php
/**
 * Blog sidebar.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="aqua-layout__side widget-area" aria-label="<?php esc_attr_e( 'Sidebar', 'aquapro' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
