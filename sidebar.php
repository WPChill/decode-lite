<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Decode
 */
?>
		<?php if ( has_nav_menu( 'sidebar-menu' ) ) { ?>
			<?php wp_nav_menu( array(
				'theme_location' => 'sidebar-menu',
				'container'      => false,
				'menu_class'     => 'menu vertical-menu sidebar-menu',
				'menu_id'        => 'sidebar-menu',
				'fallback_cb'    => false,
				'items_wrap'     => '<nav id="%1$s" class="%2$s" role="navigation"><h2 class="menu-title">' . __( 'Navigation', 'decode' ) . '</h2><ul>%3$s</ul></nav><!-- #sidebar-menu -->'
			) ); 
		} ?>
		
		<?php tha_sidebars_before(); ?>
		<div class="widget-area" role="complementary">
		
			<?php tha_sidebar_top(); ?>
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
			<?php tha_sidebar_bottom(); ?>
		</div><!-- .widget-area -->
		<?php tha_sidebars_after(); ?>