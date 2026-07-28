<?php
/**
 * Main blog / fallback template.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="aqua-container">
	<div class="aqua-wrap aqua-layout">
		<div class="aqua-layout__main">
			<?php if ( have_posts() ) : ?>
				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header class="aqua-archive-head"><h1 class="aqua-sec-title aqua-sec-title--left"><?php single_post_title(); ?></h1></header>
				<?php endif; ?>
				<div class="aqua-grid aqua-grid--2">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					?>
				</div>
				<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => esc_html__( 'Previous', 'aquapro' ), 'next_text' => esc_html__( 'Next', 'aquapro' ) ) ); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main>
<?php
get_footer();
