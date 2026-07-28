<?php
/** Yedek şablon. @package restoran-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="r-section"><div class="r-wrap" style="max-width:800px;">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="r-card" style="text-align:left; margin-bottom:24px;"><h1 class="r-h2"><?php the_title(); ?></h1><div><?php the_content(); ?></div></article>
	<?php endwhile; else : ?>
		<p class="r-lead">İçerik bulunamadı.</p>
	<?php endif; ?>
</div></section>
<?php get_footer();
