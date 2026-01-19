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
					$img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
					$tamanho_imagem = 'cover'; // ou contain, auto. Poderia ser um campo ACF.

					// Campos ACF
					$titulo = get_field('banner_titulo_html');
					$subtitulo = get_field('subtitulo_html');
					$conteudo = get_field('banner_descricao');
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
				?>
					<div class="swiper-slide banner-item" style="background-image: url('<?php echo esc_url($img_url); ?>'); background-size: <?php echo $tamanho_imagem; ?>;">
						
						<div class="banner-overlay" style="<?php echo $overlayStyle; ?>"></div>

						<div class="container">
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
											<a href="<?php echo esc_url($btnLink); ?>" class="btn-primary banner-btn" target="<?php echo $target; ?>">
												<?php echo esc_html($btnNome); ?>
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
					$img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
					$btnLink = get_field('link_btn');
					$novaAba = get_field('nova_aba');
					$target = $novaAba ? '_blank' : '_self';
				?>
					<div class="swiper-slide">
						<?php if ($btnLink) : ?>
							<a href="<?php echo esc_url($btnLink); ?>" target="<?php echo $target; ?>" class="d-block w-100 h-100">
								<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-auto" loading="lazy">
							</a>
						<?php else : ?>
							<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-auto" loading="lazy">
						<?php endif; ?>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</section>
<?php endif; ?>
