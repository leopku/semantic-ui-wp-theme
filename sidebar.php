<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package semantic-ui-wp-theme
 */
?>
	<div id="secondary" class="ui five wide column computer only" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<div class="ui segment">
				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'semantic-ui-wp-theme' ); ?></h1>
					<ul aria>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'semantic-ui-wp-theme' ); ?></h1>
					<!-- <ul> -->
						<div class="item"><i class="right triangle icon"></i><?php wp_register(); ?></div>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					<!-- </ul> -->
				</aside>
			</div>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
