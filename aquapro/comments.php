<?php
/**
 * Comments template.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="aqua-comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="aqua-comments__title">
			<?php
			$count = get_comments_number();
			/* translators: %s: comment count */
			printf( esc_html( _n( '%s Comment', '%s Comments', $count, 'aquapro' ) ), esc_html( number_format_i18n( $count ) ) );
			?>
		</h2>
		<ol class="aqua-comments__list">
			<?php wp_list_comments( array( 'style' => 'ol', 'avatar_size' => 48 ) ); ?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_submit' => 'aqua-btn aqua-btn--accent',
			'title_reply'  => esc_html__( 'Leave a comment', 'aquapro' ),
		)
	);
	?>
</section>
