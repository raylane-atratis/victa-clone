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
									<div class="banner-content <?php echo $classePosicao; ?>" <?php echo $parallaxAttr; ?>>
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
													<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none" aria-hidden="true" focusable="false">
														<path d="M9.85292 0H4.11754V1.37649H8.65033L0 10.0268L0.973179 11L9.62351 2.34967V6.88246H11V1.14708C11 0.514808 10.4857 0 9.85292 0Z" fill="white"/>
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
