<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Decode
 */
?>
		<?php if ( has_nav_menu( 'sidebar-menu' ) ) { ?>
			<?php wp_nav_menu( array(
				'theme_location'  => 'sidebar-menu',
				'container'       => false,
				'menu_class' => 'menu vertical-menu sidebar-menu',
				'menu_id'    => 'sidebar-menu',
				'items_wrap'      => '<nav id="%1$s" class="%2$s" role="navigation"><h2 class="menu-title">' . __( 'Navigation', 'decode' ) . '</h2><ul>%3$s</ul></nav><!-- #sidebar-menu -->',
				'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				'walker'            => new wp_bootstrap_navwalker()
			) ); 
		} ?>

		<div class="widget-area" role="complementary">
		
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