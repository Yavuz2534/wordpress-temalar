<?php
/**
 * Home section: Blog preview (latest posts). Hidden if there are no posts.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$q = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
	)
);

if ( ! $q->have_posts() ) {
	return;
}
?>
<section id="aqua-blog" class="aqua-section aqua-section--soft">
	<div class="aqua-wrap">
		<header class="aqua-sec-head">
			<span class="aqua-eyebrow"><?php esc_html_e( 'From the Blog', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title"><?php esc_html_e( 'Tips & News', 'aquapro' ); ?></h2>
		</header>
		<div class="aqua-grid aqua-grid--3">
			<?php
			while ( $q->have_posts() ) :
				$q->the_post();
				?>
				<article <?php post_class( 'aqua-post' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="aqua-post__media" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'aquapro-card', array( 'loading' => 'lazy' ) ); ?></a>
					<?php endif; ?>
					<div class="aqua-post__body">
						<p class="aqua-post__meta"><?php echo esc_html( get_the_date() ); ?></p>
						<h3 class="aqua-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
					</div>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>
