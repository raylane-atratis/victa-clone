<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Skip Link para Acessibilidade -->
	<a class="skip-link sr-only" href="#main-content">Pular para o conteúdo</a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="header-inner">
						<div class="site-branding">
							<?php 
							$logo_principal = get_field('logo_image', 'option');
							$logo_svg = get_field('logo_svg', 'option');

							$home_url = esc_url( home_url( '/' ) );
							$site_title = get_bloginfo( 'name' );

							if ( $logo_svg ) : ?>
								<a href="<?php echo $home_url; ?>" rel="home" class="logo-link" title="<?php echo esc_attr($site_title); ?>">
									<?php echo $logo_svg; ?>
								</a>
							<?php elseif ( $logo_principal ) : ?>
								<a href="<?php echo $home_url; ?>" rel="home" class="logo-link" title="<?php echo esc_attr($site_title); ?>">
									<img src="<?php echo esc_url( $logo_principal['url'] ); ?>" alt="<?php echo esc_attr( $logo_principal['alt'] ?: $site_title ); ?>" width="213" height="auto" loading="eager" fetchpriority="high">
								</a>
							<?php else : ?>
								<a href="<?php echo $home_url; ?>" rel="home" class="logo-link" title="<?php echo esc_attr($site_title); ?>">
									<img src="<?php echo get_template_directory_uri(); ?>/public/images/Logo-Full.svg" alt="<?php echo esc_attr($site_title); ?>" width="213" height="auto" loading="eager" fetchpriority="high">
								</a>
							<?php endif; ?>
						</div><!-- .site-branding -->

						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Menu principal">
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

							<?php
							// Campos do ACF para o Menu Mobile
							$logo_secundaria = get_field('logo_secundaria', 'option');
							$lista_de_redes = get_field('lista_de_redes', 'option');
							?>

							<div class="mobile-menu-footer">
								<div class="mobile-branding">
									<?php if ( $logo_secundaria ) : ?>
										<img src="<?php echo esc_url( $logo_secundaria['url'] ); ?>" alt="<?php echo esc_attr( $logo_secundaria['alt'] ); ?>" class="logo-somapay" width="150" height="auto" loading="lazy">
									<?php endif; ?>
								</div>

								<?php if ( $lista_de_redes ) : ?>
									<ul class="mobile-social">
										<?php foreach ( $lista_de_redes as $rede ) : ?>
											<li>
												<a href="<?php echo esc_url( $rede['link'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $rede['descricao'] ?? '' ); ?>">
													<?php echo $rede['svg']; ?>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
						</nav><!-- #site-navigation -->

						<div class="header-group">

						<div class="header-actions d-none d-lg-flex">

							<?php
							// Botões e Ações Globais do Header
							$botao_area_do_cliente = get_field('botao_area_do_cliente', 'option');
							$link_area_do_cliente = get_field('link_area_do_cliente', 'option');
							
							if ($botao_area_do_cliente && $link_area_do_cliente) : ?>
								<a href="<?php echo esc_url($link_area_do_cliente); ?>" class="btn btn-header btn-area-cliente">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M7.058 4.962C7.897 4.962 8.653 5.308 9.197 5.863C7.872 6.763 6.999 8.282 6.999 10.001C6.999 10.329 7.035 10.648 7.096 10.959C7.083 10.959 7.071 10.963 7.058 10.963C5.401 10.963 4.058 9.62 4.058 7.963C4.058 6.306 5.401 4.962 7.058 4.962ZM17 5C16.159 5 15.401 5.349 14.856 5.906C16.149 6.811 17 8.305 17 10C17 10.339 16.965 10.67 16.9 10.99C16.934 10.991 16.966 11 17 11C18.657 11 20 9.657 20 8C20 6.343 18.657 5 17 5ZM12 13C13.657 13 15 11.657 15 10C15 8.343 13.657 7 12 7C10.343 7 9 8.343 9 10C9 11.657 10.343 13 12 13ZM12 15C10.246 15 8.665 16.063 8.065 17.646C7.869 18.163 8.129 18.74 8.646 18.936C9.161 19.131 9.74 18.872 9.936 18.355C10.243 17.544 11.073 17.001 12.001 17.001C12.929 17.001 13.759 17.545 14.066 18.355C14.217 18.754 14.598 19.001 15.001 19.001C15.119 19.001 15.239 18.98 15.355 18.937C15.871 18.741 16.131 18.164 15.936 17.647C15.336 16.065 13.755 15.001 12.001 15.001L12 15ZM15.7 13.197C15.173 13.363 14.88 13.924 15.046 14.451C15.212 14.977 15.775 15.269 16.3 15.105C16.523 15.035 16.758 15 17 15C17.928 15 18.758 15.544 19.065 16.354C19.216 16.753 19.597 17 20 17C20.118 17 20.238 16.979 20.354 16.936C20.87 16.74 21.13 16.163 20.935 15.646C20.335 14.064 18.754 13 17 13C16.554 13 16.117 13.066 15.7 13.197ZM7 13C5.246 13 3.665 14.063 3.065 15.646C2.869 16.163 3.129 16.74 3.646 16.936C3.763 16.98 3.882 17 4 17C4.403 17 4.784 16.754 4.935 16.354C5.242 15.543 6.072 15 7 15C7.242 15 7.478 15.035 7.7 15.105C8.225 15.269 8.788 14.977 8.954 14.451C9.12 13.924 8.827 13.363 8.3 13.197C7.883 13.066 7.446 13 7 13ZM7 22H5C3.346 22 2 20.654 2 19V17C2 16.447 1.552 16 1 16C0.448 16 0 16.447 0 17V19C0 21.757 2.243 24 5 24H7C7.552 24 8 23.553 8 23C8 22.447 7.552 22 7 22ZM23 16C22.448 16 22 16.447 22 17V19C22 20.654 20.654 22 19 22H17C16.448 22 16 22.447 16 23C16 23.553 16.448 24 17 24H19C21.757 24 24 21.757 24 19V17C24 16.447 23.552 16 23 16ZM19 0H17C16.448 0 16 0.447 16 1C16 1.553 16.448 2 17 2H19C20.654 2 22 3.346 22 5V7C22 7.553 22.448 8 23 8C23.552 8 24 7.553 24 7V5C24 2.243 21.757 0 19 0ZM1 8C1.552 8 2 7.553 2 7V5C2 3.346 3.346 2 5 2H7C7.552 2 8 1.553 8 1C8 0.447 7.552 0 7 0H5C2.243 0 0 2.243 0 5V7C0 7.553 0.448 8 1 8Z" fill="white"/>
										</svg>
										<?php echo esc_html($botao_area_do_cliente); ?>
								</a>
							<?php endif; ?>


							<?php
							// Botões e Ações Globais do Header
							$btnCtaTopo = get_field('btn-cta-topo', 'option');
							$linkBtnCtaTopo = get_field('link-btn-cta-topo', 'option');
							
							if ($btnCtaTopo && $linkBtnCtaTopo) : ?>
								<a href="<?php echo esc_url($linkBtnCtaTopo); ?>" class="btn btn-header">
									<?php echo esc_html($btnCtaTopo); ?>
								</a>
							<?php endif; ?>

							<button class="search-toggle-btn" aria-label="Abrir pesquisa">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true" focusable="false">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.49928 1.91687e-08C7.14387 0.000115492 5.80814 0.324364 4.60353 0.945694C3.39893 1.56702 2.36037 2.46742 1.57451 3.57175C0.788656 4.67609 0.278287 5.95235 0.0859852 7.29404C-0.106316 8.63574 0.0250263 10.004 0.469055 11.2846C0.913084 12.5652 1.65692 13.7211 2.63851 14.6557C3.6201 15.5904 4.81098 16.2768 6.11179 16.6576C7.4126 17.0384 8.78562 17.1026 10.1163 16.8449C11.447 16.5872 12.6967 16.015 13.7613 15.176L17.4133 18.828C17.6019 19.0102 17.8545 19.111 18.1167 19.1087C18.3789 19.1064 18.6297 19.0012 18.8151 18.8158C19.0005 18.6304 19.1057 18.3796 19.108 18.1174C19.1102 17.8552 19.0094 17.6026 18.8273 17.414L15.1753 13.762C16.1633 12.5086 16.7784 11.0024 16.9504 9.41573C17.1223 7.82905 16.8441 6.22602 16.1475 4.79009C15.4509 3.35417 14.3642 2.14336 13.0116 1.29623C11.659 0.449106 10.0952 -0.000107143 8.49928 1.91687e-08ZM1.99928 8.5C1.99928 6.77609 2.6841 5.12279 3.90308 3.90381C5.12207 2.68482 6.77537 2 8.49928 2C10.2232 2 11.8765 2.68482 13.0955 3.90381C14.3145 5.12279 14.9993 6.77609 14.9993 8.5C14.9993 10.2239 14.3145 11.8772 13.0955 13.0962C11.8765 14.3152 10.2232 15 8.49928 15C6.77537 15 5.12207 14.3152 3.90308 13.0962C2.6841 11.8772 1.99928 10.2239 1.99928 8.5Z" fill="#fff"/>
								</svg>
							</button>

						</div><!-- .header-actions -->
						
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Abrir menu">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						</div><!-- .header-group -->
					</div>
				</div>
			</div>
			
		</div>
	</header>

	<!-- Modal de Pesquisa -->
	<div id="search-modal" class="search-modal" role="dialog" aria-modal="true" aria-label="Pesquisar no site">
		<div class="search-modal__backdrop"></div>
		<div class="search-modal__container">
			<button class="search-modal__close" aria-label="Fechar pesquisa">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</button>

			<span class="search-modal__label">O que você procura?</span>

			<form class="search-modal__form" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
				<div class="search-modal__icon" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 0C6.51 0 4.6 0.79 3.17 2.17C1.79 3.6 1 5.51 1 7.5C1 11.09 3.91 14 7.5 14C9.11 14 10.59 13.42 11.76 12.47L16.41 17.12C16.79 17.5 17.42 17.5 17.8 17.12C18.18 16.74 18.18 16.11 17.8 15.73L13.15 11.08C14.1 9.91 14.68 8.43 14.68 6.82C14.68 3.05 11.63 0 7.86 0H8.5ZM3 7.5C3 5.01 5.01 3 7.5 3C9.99 3 12 5.01 12 7.5C12 9.99 9.99 12 7.5 12C5.01 12 3 9.99 3 7.5Z"/>
					</svg>
				</div>
				<input type="search" class="search-modal__input" name="s" placeholder="Digite sua busca..." autocomplete="off" required>
				<button type="submit" class="search-modal__submit">Buscar</button>
			</form>
		</div>
	</div>

	<main id="main-content" role="main">
