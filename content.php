<?php
/**
 * @package looptroop-rockers-v4
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_format( 'image' )) { ?>
		<div class="post-format image">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ltr_v4' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				
				<?php 

				$attachment_id = get_field('image');
				$size = 'post-type-image'; // (thumbnail, medium, large, full or custom size)

				echo wp_get_attachment_image( $attachment_id, $size );

				?>

				<!-- <img src="<?php the_field('image'); ?>"> -->
			</a>
		</div>
	<?php } ?>

	<?php if ( has_post_format( 'video' )) { ?>
		<?php echo apply_filters('the_content', get_field('video') ); ?>
	<?php } ?>

	<?php if ( has_post_format( 'link' )) { ?>
		<div class="post-format link">
			<h1 class="entry-title"><a href="<?php the_field('link'); ?>" title="<?php echo esc_attr( sprintf( __( '%s', 'ltr_v4' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" target="_blank"><?php the_title(); ?></a></h1>
			<p><a href="<?php the_field('link'); ?>"><?php the_field('link'); ?></a> <a href="<?php the_permalink(); ?>">#</a></p>
			<?php the_content(); ?>
		</div>
	<?php } else { ?>
		<div class="who">
			<?php echo get_avatar( get_the_author_meta('ID'), 60 ); ?>
		</div>

		<div class="post-side">

			<header class="entry-header">
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ltr_v4' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
				<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entry-meta">
						<?php ltr_v4_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>

			</header><!-- .entry-header -->

			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php else : ?>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ltr_v4' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ltr_v4' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>

			<?php if ( ! is_single() ) { ?>
				<footer class="entry-meta">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ltr_v4' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
						<?php _e('Leave a comment', 'ltr_v4') ?>
					</a>
					<?php edit_post_link( __( 'Edit', 'ltr_v4' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			<?php } ?>
		</div><!-- .post-side -->
	<?php } // End if post format 'link' ?>
	<hr>
</article><!-- #post-## -->
