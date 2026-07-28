<?php
/**
 * Front page: composes the homepage from modular section parts.
 *
 * Each section is a separate template part so it can be reordered, removed,
 * or overridden by a child theme without touching this file.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="aqua-home">
	<?php
	/**
	 * Allow child themes / plugins to filter the section order.
	 *
	 * @param array $sections Ordered list of home section slugs.
	 */
	$sections = apply_filters(
		'aquapro_home_sections',
		array( 'hero', 'services', 'before-after', 'areas', 'team', 'reviews', 'pricing', 'faq', 'blog', 'contact' )
	);

	foreach ( $sections as $section ) {
		get_template_part( 'template-parts/home/' . $section );
	}
	?>
</main>
<?php
get_footer();
