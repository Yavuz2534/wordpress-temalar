<?php
/**
 * Home section: Before & After project showcase (interactive slider).
 *
 * Reads the first Project that has both _aqua_before and _aqua_after image IDs;
 * otherwise renders a styled placeholder so the section never looks broken.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$before = '';
$after  = '';
$title  = __( 'See the Difference We Make', 'aquapro' );

$q = AquaPro_Template::query( 'aquapro_project', 1 );
if ( $q->have_posts() ) {
	$q->the_post();
	$bid = get_post_meta( get_the_ID(), '_aqua_before', true );
	$aid = get_post_meta( get_the_ID(), '_aqua_after', true );
	if ( $bid ) {
		$before = wp_get_attachment_image_url( $bid, 'aquapro-wide' );
	}
	if ( $aid ) {
		$after = wp_get_attachment_image_url( $aid, 'aquapro-wide' );
	}
	$title = get_the_title();
	wp_reset_postdata();
}
?>
<section id="aqua-before-after" class="aqua-section aqua-section--soft">
	<div class="aqua-wrap">
		<header class="aqua-sec-head">
			<span class="aqua-eyebrow"><?php esc_html_e( 'Before & After', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title"><?php echo esc_html( $title ); ?></h2>
		</header>

		<div class="aqua-ba" data-aqua-ba>
			<div class="aqua-ba__img aqua-ba__after"<?php echo $after ? ' style="background-image:url(' . esc_url( $after ) . ')"' : ''; ?>>
				<span class="aqua-ba__label"><?php esc_html_e( 'After', 'aquapro' ); ?></span>
			</div>
			<div class="aqua-ba__img aqua-ba__before" data-aqua-ba-before<?php echo $before ? ' style="background-image:url(' . esc_url( $before ) . ')"' : ''; ?>>
				<span class="aqua-ba__label"><?php esc_html_e( 'Before', 'aquapro' ); ?></span>
			</div>
			<input class="aqua-ba__range" type="range" min="0" max="100" value="50" aria-label="<?php esc_attr_e( 'Reveal before / after', 'aquapro' ); ?>" data-aqua-ba-range>
			<span class="aqua-ba__handle" aria-hidden="true" data-aqua-ba-handle></span>
		</div>
	</div>
</section>
