<?php
/**
 * Single post / CPT template.
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
					<?php if ( 'post' === get_post_type() ) : ?>
						<p class="aqua-article__meta"><?php echo esc_html( get_the_date() ); ?> · <?php the_category( ', ' ); ?></p>
					<?php endif; ?>
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
				<footer class="aqua-article__foot"><?php the_tags( '<span class="aqua-tags">', ', ', '</span>' ); ?></footer>
			</article>
			<?php
			the_post_navigation( array( 'prev_text' => '← %title', 'next_text' => '%title →' ) );
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
