<?php ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="keywords" name="keywords" content="healing, divine healing, ministry, spiritual healing, spiritual healing books, spiritual healing prayers, healing prayers, spiritual healing courses, healing techniques, soul healing, emotional healing, healing school, prayer, prayer request, online prayer request, prayer requests, christian prayer requests, prayer ministry, prayer requests online, prayer requests healing, healing prayer, prayer request websites, prayer warriors, online prayer, free prayer request"> 
<meta http-equiv="description" name="description" content="We are a ministry equipped to heal the sick.  Book an appointment today!"> 
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
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/print.css" type="text/css" media="print">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--[if lt IE 8]><link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/ie.css" type="text/css" media="screen, projection"><![endif]-->
<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/ie-pie.css" type="text/css" media="screen, projection"><![endif]-->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>


</head>

<body>
<!--begin container-->
<div class="container">

<!--begin header-->
<div id="header">

<!--begin logo-->
<div id="logo">
<a href="<?php echo home_url( '/' ); ?>" title="Home"><img src="<?php bloginfo( 'template_directory' ); ?>/images/AHR_logo.png" width="374" height="161" alt="Logo" /></a>
<h3 class="description">The International Association of Healing Rooms</h3>
<h3 class="description"><?php bloginfo( 'description' ); ?></h3>
</div>
<!--end logo-->

<!--begin menu-->

<div id="access" role="navigation">
<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
</div>


</div><!--end header-->


