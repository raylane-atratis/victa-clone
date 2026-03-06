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
							if ( $logo_principal ) : ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link" title="<?php bloginfo( 'name' ); ?>">
									<img src="<?php echo esc_url( $logo_principal['url'] ); ?>" alt="<?php echo esc_attr( $logo_principal['alt'] ?: get_bloginfo( 'name' ) ); ?>" width="213" height="auto" loading="eager" fetchpriority="high">
								</a>
							<?php else : ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link" title="<?php bloginfo( 'name' ); ?>">
									<img src="<?php echo get_template_directory_uri(); ?>/public/images/Logo-Full.svg" alt="<?php bloginfo( 'name' ); ?>" width="213" height="100" loading="eager" fetchpriority="high">
								</a>
							<?php endif; ?>
						</div><!-- .site-branding -->

						<div class="header-group">
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

						<div class="header-actions d-none d-lg-flex">
							<?php
							// Botões e Ações Globais do Header
							$btnCtaTopo = get_field('btn-cta-topo', 'option');
							$linkBtnCtaTopo = get_field('link-btn-cta-topo', 'option');
							
							if ($btnCtaTopo && $linkBtnCtaTopo) : ?>
								<a href="<?php echo esc_url($linkBtnCtaTopo); ?>" class="btn btn-header">
									<?php echo esc_html($btnCtaTopo); ?>
									<div class="svg-icon" aria-hidden="true" focusable="false">
										<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none" aria-hidden="true" focusable="false">
											<path d="M9.85292 0H4.11754V1.37649H8.65033L0 10.0268L0.973179 11L9.62351 2.34967V6.88246H11V1.14708C11 0.514808 10.4857 0 9.85292 0Z" fill="white"/>
										</svg>
									</div>
								</a>
							<?php endif; ?>

							<span class="header-separator"></span>

							<?php if ( $lista_de_redes ) : ?>
								<ul class="header-social">
									<?php foreach ( $lista_de_redes as $rede ) : ?>
										<li>
											<a href="<?php echo esc_url( $rede['link'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $rede['titulo'] ?? '' ); ?>">
												<?php echo $rede['svg']; ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>

							<span class="header-separator"></span>

							<button class="search-toggle-btn" aria-label="Abrir pesquisa">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true" focusable="false">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.49928 1.91687e-08C7.14387 0.000115492 5.80814 0.324364 4.60353 0.945694C3.39893 1.56702 2.36037 2.46742 1.57451 3.57175C0.788656 4.67609 0.278287 5.95235 0.0859852 7.29404C-0.106316 8.63574 0.0250263 10.004 0.469055 11.2846C0.913084 12.5652 1.65692 13.7211 2.63851 14.6557C3.6201 15.5904 4.81098 16.2768 6.11179 16.6576C7.4126 17.0384 8.78562 17.1026 10.1163 16.8449C11.447 16.5872 12.6967 16.015 13.7613 15.176L17.4133 18.828C17.6019 19.0102 17.8545 19.111 18.1167 19.1087C18.3789 19.1064 18.6297 19.0012 18.8151 18.8158C19.0005 18.6304 19.1057 18.3796 19.108 18.1174C19.1102 17.8552 19.0094 17.6026 18.8273 17.414L15.1753 13.762C16.1633 12.5086 16.7784 11.0024 16.9504 9.41573C17.1223 7.82905 16.8441 6.22602 16.1475 4.79009C15.4509 3.35417 14.3642 2.14336 13.0116 1.29623C11.659 0.449106 10.0952 -0.000107143 8.49928 1.91687e-08ZM1.99928 8.5C1.99928 6.77609 2.6841 5.12279 3.90308 3.90381C5.12207 2.68482 6.77537 2 8.49928 2C10.2232 2 11.8765 2.68482 13.0955 3.90381C14.3145 5.12279 14.9993 6.77609 14.9993 8.5C14.9993 10.2239 14.3145 11.8772 13.0955 13.0962C11.8765 14.3152 10.2232 15 8.49928 15C6.77537 15 5.12207 14.3152 3.90308 13.0962C2.6841 11.8772 1.99928 10.2239 1.99928 8.5Z" fill="#157FFF"/>
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
