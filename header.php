<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Decode
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
	
		<?php if (get_theme_mod( 'show_sidebar', true ) == true ) : ?>
		<div id="sidebar_link" class="SidebarLink <?php echo get_theme_mod( 'sidebar_button_position', 'left' );?>">
			<svg width="240px" height="200px" viewBox="0 0 240 200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
			    <title>Menu</title>
			    <g id="Page 1" class="SidebarMenuTrigger" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			        <g >
			            <path d="M0,160 L0,200 L240,200 L240,160 L0,160 Z M0,160" id="Rectangle 3"></path>
			            <path d="M0,80 L0,120 L240,120 L240,80 L0,80 Z M0,80" id="Rectangle 2"></path>
			            <path d="M0,0 L0,40 L240,40 L240,0 L0,0 Z M0,0" id="Rectangle 1"></path>
			        </g>
			    </g>
			</svg>
		</div>
		<?php endif; ?>
		
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			
			<?php if (get_theme_mod( 'html_description', '' ) !== '' ) : ?>
			<h2 class="site-description"><?php echo get_theme_mod( 'html_description' ); ?></h2>
			<?php elseif (get_theme_mod( 'html_description', '' ) == '' ) : ?>
			<h2 class="site-description"><?php echo get_bloginfo ( 'description' );?></h2>
			<?php endif; ?>
			
		</div>
		<?php if (get_theme_mod( 'show_social_icons', false ) == true ) : ?>
		<div class="sociallinks">
			<ul>
				<?php if (get_theme_mod( 'twitter_username', '' ) !== '' ) : ?>
				<a class="sociallink TwitterLink" href="https://twitter.com/<?php echo get_theme_mod( 'twitter_username' );?>">
				<svg width="1001px" height="1002px" viewBox="0 0 1001 1002" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
					<title>Twitter</title>
					<g id="Page 1" fill-rule="evenodd">
					<path class="SocialIconFill" d="M500,0.5 C223.86,0.5 0,224.36 0,500.5 C0,776.64 223.86,1000.5 500,1000.5 C776.14,1000.5 1000,776.64 1000,500.5 C1000,224.36 776.14,0.5 500,0.5 L500,0.5 L500,0.5 Z M645.62,226.76 C652.2,226.92 658.58,228.02 665,229.26 C690.54,234.2 721.8,248.4 735.62,261.76 L746.86,272.38 L768.74,266.76 C780.96,263.6 799.66,257.22 810.62,252.38 C821.58,247.54 831.58,243.96 832.5,244.88 C836.32,248.7 814.22,279.8 795,297.38 L774.38,316.14 L792.5,313.64 C802.64,312.3 820.26,308.04 831.26,304.26 C843.18,300.16 851.26,298.9 851.26,301.14 C851.26,303.2 836.76,318.96 819.38,336.14 L788.14,367.38 L785.64,403 C777.92,512.9 737.92,602.96 663.76,678 C605.5,736.96 538.3,772.8 458.14,788 C421.72,794.92 355.62,797.2 324.38,793 C286.1,787.86 238.54,773.5 199.38,754.88 L164.38,738 L201.26,735.5 C245.22,732.74 275.56,725.44 310.64,709.26 C336.56,697.3 370.82,676.32 368.14,673.64 C367.34,672.84 357.26,670.14 345.64,668.02 C304.04,660.4 265.24,632.68 245.64,595.52 L236.26,577.4 L265.02,575.52 C293.86,573.72 304.26,570.48 291.9,566.76 C254.54,555.56 216.96,524.54 200.02,491.14 C193.2,477.68 183.14,441.34 183.14,429.9 C183.14,429.22 186.6,430.86 190.64,433.02 C198.46,437.2 244.92,447.48 246.9,445.52 C247.54,444.88 238.84,435.22 228.14,424.28 C217.46,413.34 204.36,395.06 198.76,383.66 C189.56,364.88 188.78,359.48 188.76,325.54 C188.74,296.72 190.28,284.04 195.64,270.54 L202.52,253.04 L216.9,269.28 C282.52,342.86 378.38,390.82 483.14,402.4 L503.14,404.28 L501.9,376.16 C500.5,341.9 506.96,317.44 524.4,291.16 C551.04,250.96 599.52,225.7 645.62,226.76 L645.62,226.76 L645.62,226.76 Z M645.62,226.76" id="Twitter" fill="#444444"></path>
					</g>
				</svg>
				</a>
				<?php endif; ?>

				<?php if (get_theme_mod( 'adn_username', '' ) !== '' ) : ?>
				<a class="sociallink ADNLink" href="https://alpha.app.net/<?php echo get_theme_mod( 'adn_username' );?>">
				<svg width="200px" height="200px" viewBox="0 0 200 200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
					<title>ADN</title>
					<g id="Page 1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<path class="SocialIconFill" d="M99,60.1993229 L131.265301,109.305975 L66.7346989,109.305975 Z M200,100 C200,155.23 155.228,200 100,200 C44.77,200 0,155.23 0,100 C0,44.772 44.77,0 100,0 C155.228,0 200,44.772 200,100 Z M25.196212,146.296875 L40.2937047,146.296875 L57.0810493,121.636275 L140.921421,121.636275 L157.698884,146.296875 L172.803788,146.296875 L98.9962942,35.3192437 Z M25.196212,146.296875" id="App.net" fill="#444444"></path>
					</g>
				</svg>
				</a>
				<?php endif; ?>

				<?php if (get_theme_mod( 'facebook_username', '' ) !== '' ) : ?>
				<a class="sociallink FacebookLink" href="https://facebook.com/<?php echo get_theme_mod( 'facebook_username' );?>">
				<svg width="1001px" height="1002px" viewBox="0 0 1001 1002" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
					<title>Facebook</title>
					<g id="Page 1" fill-rule="evenodd">
					<path class="SocialIconFill" d="M500,0.5 C223.857,0.5 0,224.357 0,500.5 C0,776.643 223.857,1000.5 500,1000.5 C776.143,1000.5 1000,776.643 1000,500.5 C1000,224.357 776.143,0.5 500,0.5 L500,0.5 L500,0.5 Z M595,124.25 C629.651,124.351 669.609,126.984 671.875,129.25 C672.364,129.739 672.041,155.691 671.25,187.375 L670,245.5 L626.25,245.5 C565.087,245.558 552.423,248.722 543.125,266.125 C538.737,274.338 538.718,276.905 538.125,333.625 L537.5,392.375 L605,392.375 L672.5,392.375 L671.875,408.625 C671.763,417.763 670.647,446.276 669.375,471.75 L667.5,518 L602.5,518.625 L537.5,519.25 L537.5,693.625 L537.5,867.375 L471.25,867.375 C434.885,867.375 404.536,866.911 403.75,866.125 C402.964,865.339 402.971,786.768 403.75,691.75 L405,519.25 L358.75,519.25 L311.875,519.25 L311.875,455.5 L311.875,392.375 L358.125,392.375 L404.375,392.375 L405,321.125 C405.71,256.086 406.154,249.016 410,236.75 C425.699,186.677 458.001,152.874 506.875,135.5 C531.869,126.615 552.77,124.127 595,124.25 L595,124.25 L595,124.25 Z M595,124.25" id="Facebook" fill="#444444"></path>
					</g>
				</svg>
				</a>
				<?php endif; ?>

				<?php if (get_theme_mod( 'google_plus_username', '' ) !== '' ) : ?>
				<a class="sociallink GooglePlusLink" href="https://plus.google.com/u/0/<?php echo get_theme_mod( 'google_plus_username' );?>">
				<svg width="200px" height="200px" viewBox="0 0 200 200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
					<title>Google Plus</title>
					<g id="Page 1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<path class="SocialIconFill" d="M100,0 C63.7562,0 32.0386,19.2602 14.5,48.125 C19.9712,44.2438 25.7332,41.6286 31.625,40.375 C38.8012,38.88 45.3704,38.125 51.5,38.125 L97.75,38.125 L83.375,46.25 L69.5,46.25 C70.8456,47.2966 72.3308,48.706 74.125,50.5 C75.919,52.1446 77.7304,54.2084 79.375,56.75 C81.0196,59.1422 82.429,61.961 83.625,65.25 C84.8208,68.5392 85.375,72.314 85.375,76.5 C85.375,80.6862 84.9214,84.3606 83.875,87.5 C82.8284,90.6396 81.294,93.4584 79.5,96 C77.7058,98.3922 75.7424,100.657 73.5,102.75 C71.2574,104.6936 68.892,106.581 66.5,108.375 C65.0048,109.8702 63.5956,111.3554 62.25,113 C60.9044,114.6446 60.25,116.7084 60.25,119.25 C60.25,121.7916 60.9044,123.88 62.25,125.375 C63.5956,126.7206 64.929,127.9536 66.125,129 L74.125,135.25 C76.517,137.343 78.8824,139.407 81.125,141.5 C83.517,143.593 85.4802,145.858 87.125,148.25 C88.919,150.642 90.4534,153.26 91.5,156.25 C92.5464,159.24 92.9998,162.7378 93,166.625 C92.9998,171.8576 91.7914,177.0418 89.25,182.125 C86.7084,187.208 82.9336,191.6128 78,195.5 C77.3304,196.0478 76.5914,196.6074 75.875,197.125 C83.5996,199.0378 91.684,200 100,200 C155.2286,200 200,155.2286 200,100 C200,93.4976 199.4352,87.1564 198.25,81 L161.25,81 L161.25,123.625 L147.875,123.625 L147.875,81 L105.25,81 L105.25,67.5 L147.875,67.5 L147.875,25.625 L161.25,25.625 L161.25,67.5 L194.5,67.5 C181.0038,28.2374 143.843,0 100,0 L100,0 L100,0 Z M37.375,45.5 C34.3848,45.5 31.4656,46.1546 28.625,47.5 C25.7844,48.8456 23.544,50.6326 21.75,52.875 C19.8064,55.2672 18.3724,57.9094 17.625,60.75 C17.027,63.5906 16.75,66.51 16.75,69.5 C16.75,73.2376 17.3284,77.4904 18.375,82.125 C19.571,86.7598 21.2574,91.0884 23.5,95.125 C25.892,99.1618 28.8114,102.5344 32.25,105.375 C35.838,108.066 39.9658,109.375 44.75,109.375 C47.5906,109.375 50.4338,108.821 53.125,107.625 C55.9656,106.429 58.2058,104.9192 60,103.125 C62.5414,100.5834 64.152,97.7646 64.75,94.625 C65.3478,91.4856 65.625,88.8432 65.625,86.75 C65.625,82.7134 65.0708,78.2842 63.875,73.5 C62.679,68.716 60.892,64.3112 58.5,60.125 C56.108,55.939 53.088,52.4412 49.5,49.75 C46.0614,46.9096 42.0096,45.5002 37.375,45.5 L37.375,45.5 L37.375,45.5 Z M0.125,94.875 C0.0386,96.5796 0,98.274 0,100 C0,116.4566 4.0826,131.9332 11.125,145.625 C12.1098,145.2224 13.1096,144.7264 14.125,144.375 C18.1616,143.179 22.1128,142.2474 26,141.5 C29.8872,140.7526 33.5614,140.174 37,139.875 C40.4386,139.576 43.3334,139.3996 45.875,139.25 C44.2304,137.157 42.745,134.9926 41.25,132.75 C39.9044,130.358 39.25,127.4386 39.25,124 C39.25,122.0564 39.4264,120.446 39.875,119.25 C40.3234,117.9044 40.777,116.5956 41.375,115.25 L37.875,115.75 L34.25,115.75 C28.2698,115.75 23.0096,114.6936 18.375,112.75 C13.7404,110.657 9.7646,108.039 6.625,104.75 C3.8326,101.8246 1.7348,98.51 0.125,94.875 L0.125,94.875 L0.125,94.875 Z M45.25,145.5 C43.6054,145.6494 41.6174,145.8504 39.375,146 C37.1324,146.299 34.7916,146.6766 32.25,147.125 C29.7084,147.723 27.267,148.3776 24.875,149.125 C23.679,149.5734 21.8674,150.228 19.625,151.125 C18.2918,151.7916 16.9582,152.6552 15.625,153.625 C27.589,172.416 45.6224,186.9028 67,194.375 C67.861,193.8246 68.7382,193.2632 69.5,192.625 C75.181,188.1398 78,182.4016 78,175.375 C78,172.5344 77.4214,169.892 76.375,167.5 C75.478,165.2574 74.0686,162.9926 72.125,160.75 C70.1814,158.5074 67.6394,156.267 64.5,153.875 C61.3604,151.483 57.686,148.74 53.5,145.75 C52.603,145.6004 51.8724,145.5 51.125,145.5 L48.375,145.5 L45.25,145.5 L45.25,145.5 Z M45.25,145.5" id="Google+" fill="#444444"></path>
					</g>
				</svg>
				</a>
				<?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'decode' ); ?>"><?php _e( 'Skip to content', 'decode' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php if (get_theme_mod( 'show_sidebar', true ) == true ) : ?>
	<div id="sidebar" class="sidebar <?php echo get_theme_mod( 'sidebar_position', 'left' );?>">
		<div id="sidebar_top" class="SidebarTop">
			<div id="sidebar_close" class="SidebarClose">
				<svg width="200px" height="200px" viewBox="0 0 200 200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				<title>Cross</title>
				<g id="Page 1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<path class="SocialIconFill" d="M0,172.881356 L72.8813559,100 L1.0658141e-14,27.1186441 L27.1186441,-2.84217094e-14 L100,72.8813559 L172.881356,0 L200,27.1186441 L127.118644,100 L200,172.881356 L172.881356,200 L100,127.118644 L27.1186441,200 Z M0,172.881356" fill="#444444"></path>
				</g>
				</svg>
			</div>
		</div>
		<div class="SidebarContent">
			<?php get_sidebar(); ?>
		</div>
	</div>
	<?php endif; ?>

	<div id="content" class="site-content">
