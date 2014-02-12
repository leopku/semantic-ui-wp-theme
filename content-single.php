<?php
/**
 * @package semantic-ui-wp-theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php semantic_ui_wp_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="ui segment">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'semantic-ui-wp-theme' ),
				'after'  => '</div>',
			) );
		?>
	<!-- </div> --><!-- .entry-content -->

	<div class="ui bottom attached label">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_my_category_list( __( ' ', 'semantic-ui-wp-theme' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_my_tag_list( '', __( ' ', 'semantic-ui-wp-theme' ) );

			if ( ! semantic_ui_wp_theme_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'semantic-ui-wp-theme' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'semantic-ui-wp-theme' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					#$meta_text = '<i class="icon sitemap"></i>' . __( ' %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'semantic-ui-wp-theme' );
					$meta_text = __( '<i class="icon open folder outline"></i> %1$s <i class="icon tags"></i> %2$s <i class="icon empty bookmark"></i> <a href="%3$s" rel="bookmark">permalink</a>.', 'semantic-ui-wp-theme' );
				} else {
					$meta_text = __( '<i class="icon open folder outline"></i> %1$s | <i class="icon bookmark empty"></i> <a href="%3$s" rel="bookmark">permalink</a>', 'semantic-ui-wp-theme' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'semantic-ui-wp-theme' ), ' | <i class="icon edit"></i> <span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
	</div>
</article><!-- #post-## -->
