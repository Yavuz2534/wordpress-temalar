<?php
/** Yedek şablon. @package saglik-pro */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="s-section"><div class="s-wrap" style="max-width:800px;">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="s-card" style="margin-bottom:24px;"><h1 class="s-h2"><?php the_title(); ?></h1><div><?php the_content(); ?></div></article>
	<?php endwhile; else : ?>
		<p class="s-lead">İçerik bulunamadı.</p>
	<?php endif; ?>
</div></section>
<?php get_footer();
