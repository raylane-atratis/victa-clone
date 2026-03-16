<?php
/**
 * Block: Seção Depoimentos (Vídeos)
 * Descrição: Carrossel de depoimentos em vídeo.
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos Específicos do Bloco
$subtitulo = get_sub_field('depoimentos_subtitulo');
$titulo    = get_sub_field('depoimentos_titulo');
$lista     = get_sub_field('depoimentos_lista'); // Repeater

$classe_extra = get_sub_field('classe');
?>

<section class="secao-depoimento <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container animate-on-scroll eff-fade-up">

        <?php if ($subtitulo) : ?>
            <span class="secao-depoimento__subtitle text-center d-block mb-2">
                <?php echo esc_html($subtitulo); ?>
            </span>
        <?php endif; ?>

        <?php if ($titulo) : ?>
            <h2 class="secao-depoimento__title text-center mx-auto mb-5">
                <?php echo wp_kses_post($titulo); ?>
            </h2>
        <?php endif; ?>

        <?php if ($lista) : ?>
            <div class="secao-depoimento__swiper-container position-relative">
                <div class="swiper swiper-depoimentos">
                    <div class="swiper-wrapper">

                        <?php foreach ($lista as $item) : 
                            $bg_img    = $item['imagem_fundo'];
                            $texto     = $item['texto'];
                            $video_url = $item['video_url'];
                            
                            $bg_url = is_array($bg_img) && isset($bg_img['url']) ? $bg_img['url'] : '';
                            $bg_alt = is_array($bg_img) && isset($bg_img['alt']) ? $bg_img['alt'] : 'Depoimento em vídeo';
                        ?>
                            <div class="swiper-slide secao-depoimento__slide" <?php if($video_url) echo 'data-video-url="' . esc_url($video_url) . '" role="button" tabindex="0" aria-label="Assistir depoimento"'; ?>>
                                
                                <?php if ($bg_url) : ?>
                                    <img src="<?php echo esc_url($bg_url); ?>" alt="<?php echo esc_attr($bg_alt); ?>" class="secao-depoimento__slide-img" loading="lazy">
                                <?php endif; ?>

                                <!-- Overlay Degradê escuro -->
                                <div class="secao-depoimento__slide-overlay"></div>

                                <!-- Botão Play Visual -->
                                <?php if ($video_url) : ?>
                                    <div class="secao-depoimento__play-btn" aria-hidden="true">
                                        <svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22 14L4 25V3L22 14Z" fill="white"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>

                                <!-- Texto Inferior -->
                                <?php if ($texto) : ?>
                                    <div class="secao-depoimento__slide-text">
                                        <?php echo wp_kses_post($texto); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <!-- Navegação / Dots -->
                <div class="swiper-pagination swiper-depoimentos-pagination mt-4"></div>

                <!-- Botões de Navegação -->
                <div class="swiper-button-prev secao-depoimento__nav secao-depoimento__nav--prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="28" viewBox="0 0 15 28" fill="none" style="transform: scaleX(-1);">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4273 15.5127C14.794 15.1183 15 14.5835 15 14.0258C15 13.4682 14.794 12.9334 14.4273 12.539L3.36277 0.642037C3.18234 0.441174 2.96652 0.280959 2.72789 0.17074C2.48926 0.0605213 2.23261 0.00250594 1.9729 7.94035e-05C1.7132 -0.00234713 1.45565 0.0508642 1.21527 0.156607C0.974899 0.262351 0.756516 0.418509 0.572871 0.61597C0.389226 0.813431 0.243994 1.04824 0.145649 1.3067C0.0473042 1.56515 -0.00218296 1.84208 7.34329e-05 2.12132C0.00233078 2.40057 0.0562868 2.67653 0.158793 2.93311C0.261301 3.18969 0.410306 3.42175 0.597115 3.61575L10.2789 14.0258L0.597115 24.4359C0.24083 24.8326 0.0436859 25.3638 0.0481424 25.9152C0.052599 26.4666 0.258299 26.9941 0.62094 27.384C0.983582 27.774 1.47415 27.9951 1.98698 27.9999C2.49981 28.0047 2.99388 27.7927 3.36277 27.4097L14.4273 15.5127Z" fill="#00512A"/>
                    </svg>
                </div>
                <div class="swiper-button-next secao-depoimento__nav secao-depoimento__nav--next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="28" viewBox="0 0 15 28" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4273 15.5127C14.794 15.1183 15 14.5835 15 14.0258C15 13.4682 14.794 12.9334 14.4273 12.539L3.36277 0.642037C3.18234 0.441174 2.96652 0.280959 2.72789 0.17074C2.48926 0.0605213 2.23261 0.00250594 1.9729 7.94035e-05C1.7132 -0.00234713 1.45565 0.0508642 1.21527 0.156607C0.974899 0.262351 0.756516 0.418509 0.572871 0.61597C0.389226 0.813431 0.243994 1.04824 0.145649 1.3067C0.0473042 1.56515 -0.00218296 1.84208 7.34329e-05 2.12132C0.00233078 2.40057 0.0562868 2.67653 0.158793 2.93311C0.261301 3.18969 0.410306 3.42175 0.597115 3.61575L10.2789 14.0258L0.597115 24.4359C0.24083 24.8326 0.0436859 25.3638 0.0481424 25.9152C0.052599 26.4666 0.258299 26.9941 0.62094 27.384C0.983582 27.774 1.47415 27.9951 1.98698 27.9999C2.49981 28.0047 2.99388 27.7927 3.36277 27.4097L14.4273 15.5127Z" fill="#00512A"/>
                    </svg>
                </div>

            </div>
        <?php endif; ?>

    </div>
</section>
