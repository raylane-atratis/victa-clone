<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<header id="masthead" class="site-header">
		<div class="container">
			<div class="header-inner">
				<div class="site-branding">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link" title="<?php bloginfo( 'name' ); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/public/images/Logo-Full.svg" alt="<?php bloginfo( 'name' ); ?>" width="213" height="100" loading="eager">
						</a>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Abrir menu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu_principal',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'menu_class'     => 'menu-list',
							'fallback_cb'    => false, // Se não tiver menu, não mostra nada (ou lista páginas se true)
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header>
