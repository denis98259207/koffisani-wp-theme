<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package koffisani
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'koffisani' ); ?></a>


                    <header id="header" class="clearfix" role="banner">
						<div class="clearfix" id="logo-bar">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 text-center">
										<div class="site-logo" id="logo">
											<div class="screen-reader-text">
												<?php printf(esc_html__("Aller à l'accueil de %1$s", 'koffisani'), bloginfo( 'name' )) ; ?>
											</div>
											<div class="col-xs-4"></div>
											<div class="site-firstletter col-xs-4" aria-hidden="true">
												<?php if ( has_custom_logo() ) {
													the_custom_logo();
												} else { ?>
												<h1><?= substr(get_bloginfo( 'name' ), 0, 1) ?></h1>
												<?php } ?>
											</div>
											<div class="col-xs-4"></div>
											<?php
											if ( is_front_page() && is_home() ) : ?>
												<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
											<?php else : ?>
												<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
											<?php
											endif;

											$description = get_bloginfo( 'description', 'display' );
											if ( $description || is_customize_preview() ) : ?>
												<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
											<?php
											endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- .site-branding -->
					    <div class="navbar navbar-default navbar-static-top" role="navigation">
	            			<div class="container">
	                			<div class="row">

									<div class="navbar-header">
										<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="primary-menu" aria-expanded="false"><?php //esc_html_e( 'Primary Menu', 'koffisani' ); ?>
											<span class="sr-only">Basculer la navigation</span>
				                            <span class="icon-bar"></span>
				                            <span class="icon-bar"></span>
				                            <span class="icon-bar"></span>
										</button>

									</div>
									<div class="navbar-collapse collapse">
										<?php wp_nav_menu( array( 
										'theme_location' => 'menu-1', 
										'menu_id' => 'primary-menu',
										'menu_class' => 'nav navbar-nav' 
										) ); ?>
									</div>
								</div><!-- #site-navigation -->
								
							</div>
						</div>
					</header><!-- #masthead -->
				

	<div id="content" class="site-content content">
		<div class="container">
                <div class="row">
