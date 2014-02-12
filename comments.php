<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to semantic_ui_wp_theme_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package semantic-ui-wp-theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div class="ui piled orange segment">
	<!-- <div class="ui attached message"> -->
		<div class="ui header">
			<i class="icon inverted circular orange comment"></i><?php _e('Comments', 'semantic-ui-wp-theme'); ?>
		</div>
	<!-- </div> -->
	<div id="comments" class="ui threaded comments">

		<?php // You can start editing here -- including this comment! ?>

		<?php if ( have_comments() ) : ?>
			<!-- <h4 class="ui dividing header">
				<?#php
					printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'semantic-ui-wp-theme' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h4> -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'semantic-ui-wp-theme' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'semantic-ui-wp-theme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'semantic-ui-wp-theme' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
			<?php endif; // check for comment navigation ?>

			<!-- <ol class="comment-list"> -->
			<div class="comment">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use semantic_ui_wp_theme_comment() to format the comments.
					 * If you want to override this in a child theme, then you can
					 * define semantic_ui_wp_theme_comment() and that will be used instead.
					 * See semantic_ui_wp_theme_comment() in inc/template-tags.php for more.
					 */
					wp_list_comments( array( 'callback' => 'semantic_ui_wp_theme_comment' ) );
				?>
			</div>
			<!-- </ol> --><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'semantic-ui-wp-theme' ); ?></h1>
				<div class="ui right floated segment"><?php previous_comments_link( __( '&larr; Older Comments', 'semantic-ui-wp-theme' ) ); ?></div>
				<div class="ui left floated segment"><?php next_comments_link( __( 'Newer Comments &rarr;', 'semantic-ui-wp-theme' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
			<?php endif; // check for comment navigation ?>

		<?php endif; // have_comments() ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'semantic-ui-wp-theme' ); ?></p>
		<?php endif; ?>

		<?php my_comment_form(); ?>

	</div><!-- #comments -->
</div>