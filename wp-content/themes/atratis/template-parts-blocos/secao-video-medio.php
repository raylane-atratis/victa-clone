<?php

/**
 * Bloco: Vídeo Institucional (Suporta URL e Arquivo)
 */
include 'conf_gerais.php';

// Campos de Texto
$subtitulo    = get_sub_field('subtitulo_video');
$titulo       = get_sub_field('titulo_video');
$texto_video = get_sub_field('texto_video');

// Lógica de Fonte do Vídeo
$tipo_video    = get_sub_field('tipo_video');
$video_url     = get_sub_field('video_url');
$video_arquivo = get_sub_field('video_arquivo');
$video_final   = ($tipo_video == 'arquivo') ? $video_arquivo : $video_url;

// --- CORREÇÃO DA CAPA DESKTOP ---
$capa_desk_field = get_sub_field('capa_desktop');
// Se for array (ACF padrão), pega a ['url']. Se for string, usa ela mesma.
$capa_desktop = is_array($capa_desk_field) ? $capa_desk_field['url'] : $capa_desk_field;

// --- CORREÇÃO DA CAPA MOBILE ---
$capa_mob_field = get_sub_field('capa_mobile');
$capa_mobile = is_array($capa_mob_field) ? $capa_mob_field['url'] : $capa_mob_field;

// Fallback caso a mobile esteja vazia
if (!$capa_mobile) {
    $capa_mobile = $capa_desktop;
}

$id = 'video-inst-' . (isset($block['id']) ? $block['id'] : uniqid());
?>

<section id="<?php echo $id; ?>" class="secao-video-inst" style="<?php echo $geraisCSS; ?>">
    <div class="container">

        <div class="secao-video-inst__header">
            <?php if ($subtitulo): ?>
                <span class="secao-video-inst__subtitle"><?php echo esc_html($subtitulo); ?></span>
            <?php endif; ?>
            <?php if ($titulo): ?>
                <h2 class="secao-video-inst__title"><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </div>

        <div class="secao-video-inst__wrapper">
            <div class="secao-video__trigger secao-video-inst__card"
                data-video-url="<?php echo esc_url($video_final); ?>"
                style="--capa-desk: url('<?php echo esc_url($capa_desktop); ?>'); --capa-mob: url('<?php echo esc_url($capa_mobile); ?>');">

                <div class="secao-video-inst__overlay">
                    <button class="secao-video-inst__play-btn" aria-label="Play Video">
                        <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M31.5 0C23.1457 0 15.1335 3.31874 9.22614 9.22614C3.31874 15.1335 0 23.1457 0 31.5C0 39.8543 3.31874 47.8665 9.22614 53.7739C15.1335 59.6813 23.1457 63 31.5 63C39.8543 63 47.8665 59.6813 53.7739 53.7739C59.6813 47.8665 63 39.8543 63 31.5C63 23.1457 59.6813 15.1335 53.7739 9.22614C47.8665 3.31874 39.8543 0 31.5 0ZM49.0545 31.5L22.5 13.797V49.203L49.0545 31.5Z" fill="white" />
                        </svg>
                    </button>
                    <?php if ($texto_video): ?>
                        <p class="secao-video-inst__text"><?php echo wp_kses_post($texto_video); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</section>