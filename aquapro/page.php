<?php
/**
 * Single page template.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="aqua-container">
	<div class="aqua-wrap aqua-wrap--narrow aqua-single">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'aqua-article' ); ?>>
				<header class="aqua-article__head">
					<h1 class="aqua-article__title"><?php the_title(); ?></h1>
				</header>
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="aqua-article__media"><?php the_post_thumbnail( 'aquapro-wide' ); ?></figure>
				<?php endif; ?>
				<div class="aqua-article__content">
					<?php
					the_content();
					wp_link_pages( array( 'before' => '<nav class="aqua-pagelinks">', 'after' => '</nav>' ) );
					?>
				</div>
			</article>
			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
