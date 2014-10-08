<?php
/**
 * The biography template file.
 *
 * @package Looptroop Rockers v5
 */

get_header(); ?>

	<div id="primary" class="content-area--full-width biography">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
