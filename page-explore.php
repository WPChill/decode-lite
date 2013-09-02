<?php
/**
 *
 * Template Name: Explore Page
 *
 * The template for displaying the explore page.
 *
 * @package Decode
 */
 
__( 'Explore Page', 'decode' );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="explore-page">

			<div id="search" class="widget search">
				<?php get_search_form(); ?>
			</div>

			<div class="post-lists">
				
				<div id="recent_posts" class="widget recent-posts">
					<h1 class="widget-title"><?php _e( 'Recent Posts', 'decode' ); ?></h1>
					<ul>
						<?php
							$args = array( 'numberposts' => '5' );
							$recent_posts = wp_get_recent_posts( $args );
							foreach( $recent_posts as $recent ){
								echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
							}
						?>
					</ul>
				</div>
			
				<div id="archives" class="widget archives">
					<h1 class="widget-title"><?php _e( 'Archives', 'decode' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</div>
				
				<div id="categories" class="widget categories">
					<h1 class="widget-title"><?php _e( 'Categories', 'decode' ); ?></h1>
					<ul>
						<?php wp_list_categories( array( 'title_li' => '',  ) ); ?>
					</ul>
				</div>

			</div>
				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>