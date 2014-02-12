<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package semantic-ui-wp-theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site ui grid">
	<?php do_action( 'before' ); ?>
    <div class="one wide column">&nbsp;</div>
    <div class="fourteen wide column">
	<header id="masthead" class="site-header ui segment" role="banner">
		<!-- <div class="site-branding ui block"> -->
			<!-- <h1 class="site-title ui inverted header floated left"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h5 class="site-description ui disabled header floated right"><?php bloginfo( 'description' ); ?></h5> -->
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<!-- <div class="ui fitted divider"></div> -->
			<h5 class="ui disabled header"><?php bloginfo( 'description' ); ?></h5>
		<!-- </div> -->

		<!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="ui stackable grid">
