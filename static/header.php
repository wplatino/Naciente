<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 */
			global $page, $paged;
			wp_title( '|', true, 'right' );
			// Add the blog name.
			bloginfo( 'name' );
			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			$post_title = get_the_title();
			if( $post_title && ( is_page() || is_single() ) )
				echo " | $post_title";
			?>
	</title>
	<meta name="author" content="L'Elite de Jose SAYAGO" />
	<?php
		$description = get_the_excerpt();
		if( empty( $description ) )
			$description = $site_description;
	?>
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="icon" type="image/x-icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style-min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/styles/kraken/kraken.css" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="site-container">
		<div class="site-surface">
			<div class="site-content">
				<header>
					<div class="site-header">
						<p class="text-center site-name">
							<a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>: <?php echo $site_description; ?>"><?php bloginfo('name'); ?></a>
						</p>
					</div>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-primary', 'walker' => new naciente_walker() ) ); ?>
					<div class="bcolor"></div>
				</header>
				<div class="content">