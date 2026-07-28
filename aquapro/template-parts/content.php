<?php
/**
 * Generic content card used in archives/blog.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'aqua-post aqua-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="aqua-post__media" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'aquapro-card', array( 'loading' => 'lazy' ) ); ?></a>
	<?php endif; ?>
	<div class="aqua-post__body">
		<p class="aqua-post__meta"><?php echo esc_html( get_the_date() ); ?><?php if ( 'post' === get_post_type() ) : ?> · <?php the_category( ', ' ); endif; ?></p>
		<h2 class="aqua-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
		<a class="aqua-post__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'aquapro' ); ?> →</a>
	</div>
</article>
