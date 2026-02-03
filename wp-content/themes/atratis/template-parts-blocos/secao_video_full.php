<?php
/**
 * Block Name: Seção Vídeo Full
 *
 * This is the template that displays the Seção Vídeo Full block.
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// URL base do tema para assets padrão
$theme_url = get_template_directory_uri();

// Simulando campos do ACF
$imagem_capa = get_sub_field('imagem_capa');
$titulo = get_sub_field('titulo_video_full') ?: 'Conheça a Tafácil Consignados';
$texto_botao = get_sub_field('texto_botao') ?: 'Assistir ao vídeo';
$video_url = get_sub_field('video_url') ?: 'https://www.youtube.com/watch?v=D0UnqGm_miA';

// Fallback para imagem se não houver cadastro
if (!$imagem_capa) {
    $imagem_capa = $theme_url . '/public/images/video-full.webp';
} else {
    // Se for array do ACF
    $imagem_capa = is_array($imagem_capa) ? $imagem_capa['url'] : $imagem_capa;
}
?>

<section class="secao-video-full" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <?php if ($titulo): ?>
            <h2 class="secao-video-full__titulo"><?php echo esc_html($titulo); ?></h2>
        <?php endif; ?>
        <div class="secao-video-full__wrapper" style="background-image: url('<?php echo esc_url($imagem_capa); ?>');"
            data-video-url="<?php echo esc_url($video_url); ?>">
            <div class="secao-video-full__overlay"></div>

            <div class="secao-video-full__content">
                <div class="btn-video-full">
                    <img src="<?php echo esc_url($theme_url . '/public/images/player-video-full.svg'); ?>" alt="Play"
                        class="btn-video-full__icon">
                    <span class="btn-video-full__text"><?php echo esc_html($texto_botao); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>