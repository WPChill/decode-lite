<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Decode
 */
?>
		<div class="widget-area" role="complementary">
		
			<nav id="sidebar-navigation" class="sidebar-navigation" role="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'sidebar-navigation',
					'container' => 'nav',
					'container_class' => 'sidebar-navigation',
					'container_id'    => 'sidebar-navigation',
					'items_wrap' => '<h2 class="menu-title">' . __( 'Navigation', 'decode' ) . '</h2><ul>%3$s</ul>'
				) ); ?>
			</nav>
		
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'decode' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- .widget-area -->