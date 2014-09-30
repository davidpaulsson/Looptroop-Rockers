<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Looptroop Rockers v5
 */
?>

<div id="secondary" class="widget-area" role="complementary">
  <div class="widget-area__yt">
    <?php
    error_reporting(E_ALL);
    $feedURL = 'http://gdata.youtube.com/feeds/api/users/LooptroopRockersVEVO/uploads?max-results=16';
    // $feedURL = 'http://gdata.youtube.com/feeds/api/users/funkyloffe/uploads?max-results=16';
    $sxml = simplexml_load_file($feedURL);
    $i=0;
    $len = count($sxml->entry);

    foreach ($sxml->entry as $entry) {

      $media = $entry->children('media', true);
      $watch = (string)$media->group->player->attributes()->url;
      $thumbnail = (string)$media->group->thumbnail[0]->attributes()->url;

      if ($i==0) {
        echo apply_filters('the_content', str_replace(array('<p>','</p>'), '', $watch));
      }
      ?>

        <div class="videoitem<?php if ($i==0) { ?> active<?php } ?>">
          <div class="videothumb"><a href="<?php echo $watch; ?>" class="watchvideo"><img src="<?php echo $thumbnail;?>" alt="<?php echo $media->group->title; ?>" /></a></div>
        </div>

      <?php
      $i++;

      // Continue loop, unless we're at the last
      // item and we're not at 16 videos yet.
      if ($i == $len) {
        if ($i < 16) {
          error_reporting(E_ALL);
          $videosLeft = 16 - $i;
          $feedURL = 'http://gdata.youtube.com/feeds/api/users/dvsgee/uploads?max-results=' . $videosLeft;
          $sxml = simplexml_load_file($feedURL);

          foreach ($sxml->entry as $entry) {
            $media = $entry->children('media', true);
            $watch = (string)$media->group->player->attributes()->url;
            $thumbnail = (string)$media->group->thumbnail[0]->attributes()->url;
            ?>

              <div class="videoitem">
                <div class="videothumb"><a href="<?php echo $watch; ?>" class="watchvideo"><img src="<?php echo $thumbnail;?>" alt="<?php echo $media->group->title; ?>" /></a></div>
              </div>

            <?php
          }
        }
      }
    }

    ?>
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
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
  </div>
</div><!-- #secondary -->
