<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Looptroop Rockers v5
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
  <div class="widget-area__yt">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore et, omnis, voluptate iste, pariatur officiis sunt, nam doloribus fuga corporis quia debitis dolores. Omnis quis labore tenetur tempore, provident dignissimos.
  </div>
  <div class="widget-area__one">
    <aside class="widget">
      <h3 class="widget-title">Latest News</h3>

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
          <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <?php the_excerpt(); ?>
        </div>
        <hr>

      <?php
      endwhile;
      endif;

      // Reset Post Data
      wp_reset_postdata();

      ?>

    </aside>
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </div>
  <div class="widget-area__two">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex beatae expedita, iste magnam reiciendis laudantium ab, distinctio blanditiis illo dolor odit, natus, asperiores laboriosam labore perspiciatis neque? Perferendis, est numquam!
    <?php // dynamic_sidebar( 'sidebar-2' ); ?>
  </div>
</div><!-- #secondary -->
