<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ltr_v4_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package looptroop-rockers-v4
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<hr>

	<div id="comments" class="comments-area">
		<h3><?php _e('Leave a comment', 'ltr_v4') ?></h3>
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="576" data-num-posts="10"></div>
	</div><!-- #comments -->
