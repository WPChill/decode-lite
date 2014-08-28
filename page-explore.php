<?php
/**
 *
 * Template Name: Explore Page
 *
 * Description: The template for displaying the Explore page, which displays search, recent posts, categories, and archives.
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
					<?php $recent_posts = wp_get_archives( array(
						'type' => 'postbypost',
						'limit' => 5,
						'format' => 'html',
					) ); ?>
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
					<?php wp_list_categories( array(
						'title_li' => '',
					) ); ?>
				</ul>
			</div>

		</div>
			
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>