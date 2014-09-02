<?php
/**
 * The sidebar containing the main widget areas.
 *
 * @package Decode
 */
?>

<div id="sidebar" class="sidebar <?php echo get_theme_mod( 'sidebar_position', 'left' );?>">
	<div id="sidebar-top" class="sidebar-top SidebarTop">
		<button id="sidebar-close" class="sidebar-close SidebarClose" title="<?php _e( 'Hide sidebar', 'decode' )?>">
			<svg width="100%" height="100%" viewBox="0 0 200 200" version="1.1" xmlns="http://www.w3.org/2000/svg">
			<path class="close-icon" d="M0,172.881356 L72.8813559,100 L1.0658141e-14,27.1186441 L27.1186441,-2.84217094e-14 L100,72.8813559 L172.881356,0 L200,27.1186441 L127.118644,100 L200,172.881356 L172.881356,200 L100,127.118644 L27.1186441,200 Z M0,172.881356" fill="#444444"></path>
			</svg>
		</button>
	</div>
	<div class="sidebar-content">

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
	
	</div>
</div>