<?php
/** Yedek şablon. @package kurumsal-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="k-section"><div class="k-wrap" style="max-width:800px;">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="k-card" style="margin-bottom:24px;"><h1 class="k-h2"><?php the_title(); ?></h1><div><?php the_content(); ?></div></article>
	<?php endwhile; else : ?>
		<p class="k-lead">İçerik bulunamadı.</p>
	<?php endif; ?>
</div></section>
<?php get_footer();
