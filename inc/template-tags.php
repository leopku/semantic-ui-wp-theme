<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package semantic-ui-wp-theme
 */

if ( ! function_exists( 'semantic_ui_wp_theme_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function semantic_ui_wp_theme_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<!-- <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'semantic-ui-wp-theme' ); ?></h1> -->

	<?php if ( is_single() ) : // navigation links for single posts ?>
<br>
		<?php previous_post_link( '<div class="nav-previous ui menu compact floated left orange inverted small"><div class="item">%link</div></div>', '<i class="icon left arrow"></i>' . _x( '', 'Previous post link', 'semantic-ui-wp-theme' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next ui menu compact floated right orange inverted small"><div class="item">%link</div></div>', '%title <i class="icon right arrow"></i>' . _x( '', 'Next post link', 'semantic-ui-wp-theme' ) . '</span>' ); ?>
<br><br>
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="ui compact menu floated left orange inverted small">
			<div class="nav-previous ui item"><?php next_posts_link( __( '<i class="left basic icon"></i> Older posts', 'semantic-ui-wp-theme' ) ); ?></div>		
		</div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="ui compact menu floated right orange inverted">
			<div class="nav-next ui item"><?php previous_posts_link( __( 'Newer posts <i class="right basic icon"></i>', 'semantic-ui-wp-theme' ) ); ?></div>
		</div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // semantic_ui_wp_theme_content_nav

if ( ! function_exists( 'semantic_ui_wp_theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function semantic_ui_wp_theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<div id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'semantic-ui-wp-theme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'semantic-ui-wp-theme' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<!-- <li id="comment-<?#php comment_ID(); ?>" <?#php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>> -->
	<div id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'comments' : 'comment' ); ?>>
		<div class="avatar">
			<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
		<div class="content">
			<?#php printf( __( '%s <span class="says">says:</span>', 'semantic-ui-wp-theme' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			<?php printf(get_comment_author_link()); ?>
			<div class="metadata">
				<span class="date">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'semantic-ui-wp-theme' ), get_comment_date(), get_comment_time() ); ?>
					
				</span>
			</div>
			<div class="text">
				<?php comment_text(); ?>
			</div>
		</div>
	<?php
	endif;
}
endif; // ends check for semantic_ui_wp_theme_comment()

if ( ! function_exists( 'semantic_ui_wp_theme_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function semantic_ui_wp_theme_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'semantic_ui_wp_theme_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'semantic_ui_wp_theme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function semantic_ui_wp_theme_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	// if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
	// 	$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

	// $time_string = sprintf( $time_string,
	// 	esc_attr( get_the_date( 'c' ) ),
	// 	esc_html( get_the_date() ),
	// 	esc_attr( get_the_modified_date( 'c' ) ),
	// 	esc_html( get_the_modified_date() )
	// );

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	printf( __( '<i class="icon calendar"></i>%1$s', 'semantic-ui-wp-theme' ), $time_string);

	// printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'semantic-ui-wp-theme' ),
	// 	sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
	// 		esc_url( get_permalink() ),
	// 		$time_string
	// 	),
	// 	sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
	// 		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	// 		esc_html( get_the_author() )
	// 	)
	// );
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function semantic_ui_wp_theme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so semantic_ui_wp_theme_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so semantic_ui_wp_theme_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in semantic_ui_wp_theme_categorized_blog
 */
function semantic_ui_wp_theme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'semantic_ui_wp_theme_category_transient_flusher' );
add_action( 'save_post',     'semantic_ui_wp_theme_category_transient_flusher' );
