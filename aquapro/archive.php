<?php
/**
 * Archive template (categories, CPT archives, dates).
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
			<?php the_archive_title( '<h1 class="aqua-sec-title aqua-sec-title--left">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="aqua-lead">', '</div>' ); ?>
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
			<?php the_posts_pagination( array( 'prev_text' => esc_html__( 'Previous', 'aquapro' ), 'next_text' => esc_html__( 'Next', 'aquapro' ) ) ); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
