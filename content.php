<?php
/**
 * @package semantic-ui-wp-theme
 */
?>
<div class="ui segment">
<!-- <article id="-<?php the_ID(); ?>" <?php post_class(); ?>> -->
				<!-- <div class="ui orange ribbon label"><?php echo '<b>' . date('n', strtotime(get_the_date( 'c' ))) . '月</b>' ; ?></div> -->
	<header class="entry-header">
		<h1 class="ui dividing header"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?#php if ( 'post' == get_post_type() ) : ?>
		<!-- <div class="entry-meta">
			<?php semantic_ui_wp_theme_posted_on(); ?>
		</div> --><!-- .entry-meta -->
		<?#php endif; ?>
	</header><!-- .entry-header -->

	<!-- <div class="ui top right attached label orange"><i class="icon orange comment"></i><?php comments_popup_link( __( '0', 'semantic-ui-wp-theme' ), __( '1', 'semantic-ui-wp-theme' ), __( '%', 'semantic-ui-wp-theme' ) ); ?></div> -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content222">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'semantic-ui-wp-theme' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'semantic-ui-wp-theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<div class="ui bottom attached label">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				#$categories_list = get_the_category_list( __( ' ', 'semantic-ui-wp-theme' ) );
				$categories_list = '<i class="folder open outline icon"></i>' . get_my_category_list( __( ' ', 'semantic-ui-wp-theme' ) );
				if ( $categories_list && semantic_ui_wp_theme_categorized_blog() ) :
			?>

			<?php printf( __( '%1$s', 'semantic-ui-wp-theme' ), $categories_list ); ?>

			<?php endif; // End if categories ?>

			| <?php echo sprintf( '<i class="icon orange user"></i><a class="url fn n" href="%1$s">%2$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
			); ?> | <?php printf( semantic_ui_wp_theme_posted_on() ); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		| <i class="icon orange outline comment"></i> <?php comments_popup_link( __( '(0)', 'semantic-ui-wp-theme' ), __( '(1)', 'semantic-ui-wp-theme' ), __( '(%)', 'semantic-ui-wp-theme' ) ); ?>
		<?php endif ?>		

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = '<i class="tags icon"></i>' . get_my_tag_list( '', __( '', 'semantic-ui-wp-theme' ) ); ?>
			<?php if ( $tags_list ) : ?>
				| <?php printf( __( '%1$s', 'semantic-ui-wp-theme' ), $tags_list ); ?>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

	</div>
	
<!-- </article> --><!-- #post-## -->
</div>
