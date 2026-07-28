<?php
/**
 * "No results" partial.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="aqua-card aqua-noresults">
	<h2><?php esc_html_e( 'Nothing found', 'aquapro' ); ?></h2>
	<p><?php esc_html_e( 'Try a different search, or get in touch and we will help.', 'aquapro' ); ?></p>
	<?php get_search_form(); ?>
</div>
