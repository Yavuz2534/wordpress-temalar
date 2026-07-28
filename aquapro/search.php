<?php
/**
 * Search results template.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="aqua-container">
	<div class="aqua-wrap">
		<header class="aqua-archive-head">
			<h1 class="aqua-sec-title aqua-sec-title--left">
				<?php
				/* translators: %s: search query */
				printf( esc_html__( 'Search results for: %s', 'aquapro' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
				?>
			</h1>
		</header>
		<?php if ( have_posts() ) : ?>
			<div class="aqua-grid aqua-grid--3">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
