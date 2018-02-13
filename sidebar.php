<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Looptroop Rockers v5
 */
?>

<div id="secondary" class="widget-area" role="complementary">
  <div class="widget-area__yt">
    <?php /* hacky solution to get the latest video(s) on top, for now,
    need to redo this video solution some day... */ ?>

    <p>
      <iframe width="390" height="219" src="https://www.youtube.com/embed/4VHQ1V-9zHk" frameborder="0" allowfullscreen ></iframe>
    </p>

    <div class="videoitem active">
      <div class="videothumb">
        <a href="https://www.youtube.com/embed/ofU4HPSFDpA" class="watchvideo">
          <img src="https://i4.ytimg.com/vi/4VHQ1V-9zHk/hqdefault.jpg" alt="Looptroop Rockers - Loose After Midnight feat. Timbuktu (Official Video)">
        </a>
      </div>
    </div>

    <div class="videoitem">
      <div class="videothumb">
        <a href="https://www.youtube.com/embed/ofU4HPSFDpA" class="watchvideo">
          <img src="https://i4.ytimg.com/vi/ofU4HPSFDpA/hqdefault.jpg" alt="The Casual Brothers - Guarantees feat. Ayla Shatz (Official Video)">
        </a>
      </div>
    </div>

    <?php
    /* start looping the videos properly now... */
    error_reporting(E_ALL);
    $feedURL = 'https://www.youtube.com/feeds/videos.xml?user=LooptroopRockersVEVO';
    $sxml = simplexml_load_file($feedURL);
    $i=1;
    $len = count($sxml->entry);

    foreach ($sxml->entry as $entry) {

      $media = $entry->children('media', true);
      $watch = (string)$media->group->content->attributes()->url;
      $watch2 = str_replace('/v/', '/embed/', $watch);
      $watch3 = str_replace('?version=3', '', $watch2);

      $thumbnail = (string)$media->group->thumbnail[0]->attributes()->url;

      if ($i==0) {
        echo apply_filters('the_content', '<iframe width="390" height="219" src="' . $watch3 . '" frameborder="0" allowfullscreen ></iframe>');
      }
      ?>

        <div class="videoitem<?php if ($i==0) { ?> active<?php } ?>">
          <div class="videothumb"><a href="<?php echo $watch3; ?>" class="watchvideo"><img src="<?php echo $thumbnail;?>" alt="<?php echo $media->group->title; ?>" /></a></div>
        </div>

      <?php
      $i++;

      // Continue loop, unless we're at the last
      // item and we're not at 16 videos yet.
      if ($i == $len) {
        if ($i < 14) {
          error_reporting(E_ALL);
          $videosLeft = 16 - $i;
          $feedURL = 'https://www.youtube.com/feeds/videos.xml?user=dvsgee';
          $sxml = simplexml_load_file($feedURL);

          foreach ($sxml->entry as $entry) {
            $media = $entry->children('media', true);
            $watch = (string)$media->group->content->attributes()->url;
            $watch2 = str_replace('/v/', '/embed/', $watch);
            $watch3 = str_replace('?version=3', '', $watch2);

            $thumbnail = (string)$media->group->thumbnail[0]->attributes()->url;

            if ($i < 14) {
              ?>

                <div class="videoitem">
                  <div class="videothumb"><a href="<?php echo $watch3; ?>" class="watchvideo"><img src="<?php echo $thumbnail;?>" alt="<?php echo $media->group->title; ?>" /></a></div>
                </div>

              <?php
              }
            $i++;
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
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?>
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
