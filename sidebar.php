<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package looptroop-rockers-v4
 */
?>

	<div class="youtube facebook sidebar">
		<?php echo do_shortcode( '[Youtube_Channel_Gallery user="dvsgee" videowidth="365" thumbwidth="112"]' ) ?>
		<a href="http://www.youtube.com/user/dvsgee">→ Follow Looptroop Rockers on YouTube</a>
		<hr>
		
		<!-- <h1 class="widget-title"><a href="https://www.facebook.com/looptrooprockers">LTR x Facebook</a></h1> -->
		<!-- <div class="fb-like" data-href="https://www.facebook.com/looptrooprockers" data-send="false" data-width="365" data-show-faces="true"></div> -->
		<!-- <hr> -->

		<div class="fb-like-box" data-href="https://www.facebook.com/looptrooprockers" data-width="365" data-show-faces="true" data-stream="true" data-header="true"></div>
		<hr>

		<div id="secondary" class="widget-area" role="complementary">
			<h1 class="widget-title">Latest news</h1>
			<?php
			$args = array(
				'category_name' => 'news',
				'posts_per_page' => 3
			);
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
			?>

				<div class="news-item">
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'news-image' ); ?>
					<?php } ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</div>
				<hr>

			<?php
			endwhile;
			endif;
			 
			// Reset Post Data
			wp_reset_postdata();

			?>

		</div><!-- #secondary -->

		<div id="tertiary" class="widget-area" role="complementary">

			<fb:activity site="http://looptrooprockers.com"></fb:activity>

			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'ltr_v4' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'ltr_v4' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #tertiary -->
	</div><!-- .youtube .facebook .sidebar -->