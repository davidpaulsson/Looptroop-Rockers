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
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure quo odio eligendi, libero ducimus, doloremque, voluptate non hic voluptates accusamus facere ullam quasi accusantium. Error tempora velit suscipit id magnam.
    <?php // dynamic_sidebar( 'sidebar-1' ); ?>
  </div>
  <div class="widget-area__two">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex beatae expedita, iste magnam reiciendis laudantium ab, distinctio blanditiis illo dolor odit, natus, asperiores laboriosam labore perspiciatis neque? Perferendis, est numquam!
    <?php // dynamic_sidebar( 'sidebar-2' ); ?>
  </div>
</div><!-- #secondary -->
