<?php
/**
 * Bloco: Seção Quem Somos
 * Descrição: Seção institucional com foto de fundo, bloco diagonal sobreposto, selo e acionador de vídeo modal.
 */

// Configurações Gerais (espaçamentos e backgrounds do ACF)
include 'conf_gerais.php';

// Campos Específicos do Bloco
$subtitulo        = get_sub_field('subtitulo');
$titulo           = get_sub_field('titulo');
$texto            = get_sub_field('texto');
$btn_conheca      = get_sub_field('btn_conheca_mais');
$imagem_premio    = get_sub_field('imagem_premio');
$texto_premio     = get_sub_field('texto_premio');
$video_url        = get_sub_field('video_url');
$texto_video      = get_sub_field('texto_video');
$imagem_fundo     = get_sub_field('imagem_fundo');

$classe_extra = get_sub_field('classe');

// Garantindo que teremos um ID de imagem ou URL limpa
$imagem_fundo_id = is_array($imagem_fundo) ? ($imagem_fundo['ID'] ?? null) : null;
$imagem_fundo_url = is_array($imagem_fundo) ? ($imagem_fundo['url'] ?? '') : (is_string($imagem_fundo) ? $imagem_fundo : '');
?>

<section class="secao-quem-somos <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    
    <!-- Camada 1: Backgrounds Absolutos / Relativos no Mobile -->
    <div class="secao-quem-somos__bg-wrapper" aria-hidden="true">
        <!-- Fundo Verde Claro (#42CE02) -->
        <div class="secao-quem-somos__bg-clara"></div>

        <!-- Fundo Verde Escuro (Diagonal) -->
        <div class="secao-quem-somos__bg-cor"></div>
        
        <!-- Detalhe Decorativo Verde Claro (Movido para fora do clip-path) -->
        <div class="secao-quem-somos__bg-decorativo"></div>
        
        <!-- Imagem Fotográfica -->
        <div class="secao-quem-somos__bg-imagem">
            <?php if ($imagem_fundo_id) : ?>
                <?php echo wp_get_attachment_image($imagem_fundo_id, 'full', false, [
                    'class' => 'img-fluid',
                    'loading' => 'lazy',
                    'alt' => 'Imagem de fundo Quem Somos'
                ]); ?>
            <?php elseif ($imagem_fundo_url) : ?>
                <img src="<?php echo esc_url($imagem_fundo_url); ?>" class="img-fluid" loading="lazy" alt="Imagem de fundo Quem Somos">
            <?php endif; ?>
        </div>
    </div>

    <!-- Camada 2: Conteúdo -->
    <div class="container secao-quem-somos__container">
        <div class="row align-items-center secao-quem-somos__wrap">
            
            <!-- Coluna Esquerda (Textos e CTA) -->
            <div class="col-lg-6 col-12">
                <div class="secao-quem-somos__content">
                    <?php if ($subtitulo) : ?>
                        <span class="secao-quem-somos__subtitulo"><?php echo esc_html($subtitulo); ?></span>
                    <?php endif; ?>

                    <?php if ($titulo) : ?>
                        <h2 class="secao-quem-somos__titulo"><?php echo wp_kses_post($titulo); ?></h2>
                    <?php endif; ?>

                    <?php if ($texto) : ?>
                        <div class="secao-quem-somos__texto">
                            <?php echo wp_kses_post($texto); ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                    if ($btn_conheca) : 
                        $btn_url   = is_array($btn_conheca) && !empty($btn_conheca['url']) ? $btn_conheca['url'] : (is_string($btn_conheca) ? $btn_conheca : '#');
                        $btn_title = is_array($btn_conheca) ? ($btn_conheca['title'] ?? ($btn_conheca['texto'] ?? 'Conheça mais sobre a Victa')) : 'Conheça mais sobre a Victa';
                        $btn_target = is_array($btn_conheca) && !empty($btn_conheca['target']) ? 'target="_blank" rel="noopener noreferrer"' : '';
                    ?>
                        <a href="<?php echo esc_url($btn_url); ?>" class="btn btn--verde-claro secao-quem-somos__btn" <?php echo $btn_target; ?>>
                            <?php echo esc_html($btn_title); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" viewBox="0 0 28 14" fill="none" class="icon-seta" aria-hidden="true">
                              <path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4784 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4784 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28905 26.9763 4.66511Z" fill="currentColor"/>
                            </svg>
                        </a>
                    <?php endif; ?>

                    <?php if ($imagem_premio) : 
                        $premio_id = is_array($imagem_premio) ? ($imagem_premio['ID'] ?? null) : null;
                        $premio_url = is_array($imagem_premio) ? ($imagem_premio['url'] ?? '') : (is_string($imagem_premio) ? $imagem_premio : '');
                        $premio_texto = $texto_premio ?: 'Prêmio de construtora do ano: 2025';
                    ?>
                        <div class="secao-quem-somos__premio">
                            <?php if ($premio_id) : ?>
                                <?php echo wp_get_attachment_image($premio_id, 'medium', false, [
                                    'class' => 'img-fluid',
                                    'loading' => 'lazy',
                                    'alt' => esc_attr($premio_texto)
                                ]); ?>
                            <?php elseif ($premio_url) : ?>
                                <img src="<?php echo esc_url($premio_url); ?>" alt="<?php echo esc_attr($premio_texto); ?>" class="img-fluid" loading="lazy">
                            <?php endif; ?>

                            <span class="secao-quem-somos__premio-divider"></span>
                            <span class="secao-quem-somos__premio-texto"><?php echo esc_html($premio_texto); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Coluna Direita: Desktop (Botão Modal de Vídeo flutuante sobre a imagem) -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                <?php if ($video_url) : ?>
                    <div class="secao-quem-somos__acao-video">
                        <button class="secao-quem-somos__paly-btn" data-video-url="<?php echo esc_url($video_url); ?>" aria-label="Abrir vídeo de Quem Somos">
                            <span class="paly-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                  <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                </svg>
                            </span>
                        </button>
                        
                        <?php if ($texto_video) : ?>
                            <span class="secao-quem-somos__texto-video"><?php echo esc_html($texto_video); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Mobile: Video Thumbnail (Imagem da família como card com play centralizado) -->
        <?php if ($video_url) : ?>
            <div class="secao-quem-somos__video-thumb d-lg-none">
                <div class="secao-quem-somos__video-thumb-img">
                    <?php if ($imagem_fundo_id) : ?>
                        <?php echo wp_get_attachment_image($imagem_fundo_id, 'large', false, [
                            'class' => 'img-fluid',
                            'loading' => 'lazy',
                            'alt' => 'Vídeo Institucional'
                        ]); ?>
                    <?php elseif ($imagem_fundo_url) : ?>
                        <img src="<?php echo esc_url($imagem_fundo_url); ?>" class="img-fluid" loading="lazy" alt="Vídeo Institucional">
                    <?php endif; ?>
                </div>
                
                <button class="secao-quem-somos__paly-btn" data-video-url="<?php echo esc_url($video_url); ?>" aria-label="Abrir vídeo de Quem Somos">
                    <span class="paly-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                          <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                        </svg>
                    </span>
                </button>

                <?php if ($texto_video) : ?>
                    <span class="secao-quem-somos__texto-video"><?php echo esc_html($texto_video); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

