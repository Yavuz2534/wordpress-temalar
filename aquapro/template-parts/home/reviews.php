<?php
/**
 * Home section: Customer reviews carousel.
 *
 * @package AquaPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$q = AquaPro_Template::query( 'aquapro_review', 9 );

$items = array();
if ( $q->have_posts() ) {
	while ( $q->have_posts() ) {
		$q->the_post();
		$items[] = array(
			'text' => wp_strip_all_tags( get_the_content() ),
			'name' => get_the_title(),
			'meta' => get_post_meta( get_the_ID(), '_aqua_role', true ),
		);
	}
	wp_reset_postdata();
} else {
	$items = array(
		array( 'text' => __( 'They found a hidden leak at midnight without tearing up the walls. Incredible service.', 'aquapro' ), 'name' => 'Michael K.', 'meta' => 'Downtown' ),
		array( 'text' => __( 'Cleared a blocked drain in under an hour and the price was clear up front.', 'aquapro' ), 'name' => 'Ayşe Y.', 'meta' => 'Westend' ),
		array( 'text' => __( 'Professional, tidy and on time. Highly recommend for boiler work.', 'aquapro' ), 'name' => 'David R.', 'meta' => 'Riverside' ),
	);
}
?>
<section id="aqua-reviews" class="aqua-section">
	<div class="aqua-wrap">
		<header class="aqua-sec-head">
			<span class="aqua-eyebrow"><?php esc_html_e( 'Reviews', 'aquapro' ); ?></span>
			<h2 class="aqua-sec-title"><?php esc_html_e( 'What Our Customers Say', 'aquapro' ); ?></h2>
		</header>

		<div class="aqua-carousel" data-aqua-carousel>
			<div class="aqua-carousel__track" data-aqua-track>
				<?php foreach ( $items as $r ) : ?>
					<figure class="aqua-review">
						<div class="aqua-review__stars" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'aquapro' ); ?>">★★★★★</div>
						<blockquote><?php echo esc_html( $r['text'] ); ?></blockquote>
						<figcaption>
							<span class="aqua-review__av" aria-hidden="true"><?php echo esc_html( mb_substr( $r['name'], 0, 1 ) ); ?></span>
							<span><strong><?php echo esc_html( $r['name'] ); ?></strong><?php echo $r['meta'] ? '<small>' . esc_html( $r['meta'] ) . '</small>' : ''; ?></span>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
			<div class="aqua-carousel__nav">
				<button type="button" class="aqua-carousel__btn" data-aqua-prev aria-label="<?php esc_attr_e( 'Previous', 'aquapro' ); ?>"><?php aquapro_icon( 'arrow-left', 20 ); ?></button>
				<button type="button" class="aqua-carousel__btn" data-aqua-next aria-label="<?php esc_attr_e( 'Next', 'aquapro' ); ?>"><?php aquapro_icon( 'arrow-right', 20 ); ?></button>
			</div>
		</div>
	</div>
</section>
