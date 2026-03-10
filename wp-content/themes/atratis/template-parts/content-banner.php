<?php
/**
 * Template part for displaying banners using Swiper.
 */

// Queries
$desktopArgs = array(
	'post_type' => 'banners',
	'order'     => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'posicoes_banner',
			'field'    => 'slug',
			'terms'    => 'desktop',
		),
	),
);
$desktopQuery = new WP_Query($desktopArgs);

$mobileArgs = array(
	'post_type' => 'banners',
	'order'     => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'posicoes_banner',
			'field'    => 'slug',
			'terms'    => 'mobile',
		),
	),
);
$mobileQuery = new WP_Query($mobileArgs);
?>

<?php if ($desktopQuery->have_posts()) : ?>
	<section class="banner-section banner-desktop d-none d-lg-block">
		<div class="swiper swiper-banner-principal">
			<div class="swiper-wrapper">
				<?php while ($desktopQuery->have_posts()) : $desktopQuery->the_post();
					// Imagem otimizada (fallback para full se tamanho registrado não existir)
					$img_url = get_the_post_thumbnail_url(get_the_ID(), 'banner-desktop') ?: get_the_post_thumbnail_url(get_the_ID(), 'full');
					$tamanho_imagem = 'cover'; // ou contain, auto. Poderia ser um campo ACF.

					// Campos ACF (Sanitizados com wp_kses_post para segurança)
					$titulo = wp_kses_post(get_field('banner_titulo_html'));
					$subtitulo = wp_kses_post(get_field('subtitulo_html'));
					$conteudo = wp_kses_post(get_field('banner_descricao'));
					$btnNome = get_field('nome_btn');
					$btnLink = get_field('link_btn');
					$novaAba = get_field('nova_aba');
					$target = $novaAba ? '_blank' : '_self';

					$classe = get_field('classe_banner');

					// Layout e Estilo
					$posicaoConteudo = get_field('posicao_descricao'); // 1: Esq, 2: Dir, 3: Centro
					$classePosicao = '';
					if ($posicaoConteudo == 2) $classePosicao = 'content-right';
					if ($posicaoConteudo == 3) $classePosicao = 'content-center';

					$corCamada = get_field('camada_cor_banner');
					$transparencia = get_field('tansparencia_cor'); // Ex: 5 para 0.5
					$overlayStyle = '';
					if ($corCamada) {
						$opacity = $transparencia ? "0.$transparencia" : '0.5';
						$overlayStyle = "background-color: $corCamada; opacity: $opacity;";
					}

					// Parallax (Se for implementado via JS, adicionar data-attributes)
					$parallax = get_field('parallax');
					$parallaxAttr = $parallax ? 'data-swiper-parallax="50%"' : '';
					// LCP Condicional para Desktop
					$is_first = ($desktopQuery->current_post === 0);
					$loading_attr = $is_first ? 'eager' : 'lazy';
					$priority_attr = $is_first ? 'fetchpriority="high"' : '';
				?>
					<div class="swiper-slide banner-item" style="position: relative; overflow: hidden;">
						
						<!-- Imagem base para Otimização de LCP e Native Lazy Load -->
						<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" 
							 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: <?php echo $tamanho_imagem ?: 'cover'; ?>; z-index: 0;"
							 loading="<?php echo $loading_attr; ?>" <?php echo $priority_attr; ?>>

						<div class="banner-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; <?php echo $overlayStyle; ?>"></div>

						<div class="container" style="position: relative; z-index: 2;">
							<div class="row align-items-center">
								<div class="col-12">
									<div class="banner-content <?php echo $classe; ?> <?php echo $classePosicao; ?>" <?php echo $parallaxAttr; ?>>
										<?php if ($subtitulo) : ?>
											<h3 class="banner-subtitle"><?php echo $subtitulo; ?></h3>
										<?php endif; ?>
										
										<?php if ($titulo) : ?>
											<h1 class="banner-title"><?php echo $titulo; ?></h1>
										<?php endif; ?>

										<?php if ($conteudo) : ?>
											<div class="banner-description">
												<?php echo $conteudo; ?>
											</div>
										<?php endif; ?>

										<?php if ($btnNome && $btnLink) : ?>
											<a href="<?php echo esc_url($btnLink); ?>" class="btn" target="<?php echo esc_attr($target); ?>" title="<?php echo esc_attr($btnNome); ?>">
												<?php echo esc_html($btnNome); ?>
												<div class="svg-icon" aria-hidden="true">
													<svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4783 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4783 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28904 26.9763 4.66511Z" fill="#00512A"/>
													</svg>
												</div>
											</a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<!-- Paginação e Navegação -->
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</section>
<?php endif; ?>

<?php if ($mobileQuery->have_posts()) : ?>
	<section class="banner-section banner-mobile d-block d-lg-none">
		<div class="swiper swiper-banner-mobile">
			<div class="swiper-wrapper">
				<?php while ($mobileQuery->have_posts()) : $mobileQuery->the_post();
					// Imagem otimizada (fallback para full)
					$img_url = get_the_post_thumbnail_url(get_the_ID(), 'banner-mobile') ?: get_the_post_thumbnail_url(get_the_ID(), 'full');

					// LCP condicional: primeiro slide = eager, demais = lazy
					$is_first = ($mobileQuery->current_post === 0);
					$loading_attr = $is_first ? 'eager' : 'lazy';
					$priority_attr = $is_first ? 'fetchpriority="high"' : '';

					$btnLink = get_field('link_btn');
					$novaAba = get_field('nova_aba');
					$target = $novaAba ? '_blank' : '_self';
				?>
					<div class="swiper-slide">
						<?php if ($btnLink) : ?>
							<a href="<?php echo esc_url($btnLink); ?>" target="<?php echo esc_attr($target); ?>" class="d-block w-100 h-100">
								<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-auto" loading="<?php echo $loading_attr; ?>" <?php echo $priority_attr; ?>>
							</a>
						<?php else : ?>
							<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-auto" loading="<?php echo $loading_attr; ?>" <?php echo $priority_attr; ?>>
						<?php endif; ?>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</section>
<?php endif; ?>
