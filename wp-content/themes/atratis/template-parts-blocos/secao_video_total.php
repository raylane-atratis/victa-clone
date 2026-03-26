<?php

/**
 * Bloco: Vídeo com Modal (Lógica Externa)
 */
include 'conf_gerais.php';

$video_url     = get_sub_field('video_url'); // URL do YouTube
$capa_desktop  = get_sub_field('capa_desktop');
$capa_mobile   = get_sub_field('capa_mobile') ?: $capa_desktop;
$classe_extra  = get_sub_field('classe');
?>

<section class="secao-video <?php echo esc_attr($classe_extra); ?>"
    style="--capa-desk: url('<?php echo $capa_desktop; ?>'); --capa-mob: url('<?php echo $capa_mobile; ?>'); <?php echo $geraisCSS; ?>">

    <div class="container-video p-0">
        <div class="secao-video__trigger" data-video-url="<?php echo esc_url($video_url); ?>">
            <div class="secao-video__overlay">
                <button class="secao-video__play-btn" aria-label="Play Video">
                    <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M31.5 0C23.1457 0 15.1335 3.31874 9.22614 9.22614C3.31874 15.1335 0 23.1457 0 31.5C0 39.8543 3.31874 47.8665 9.22614 53.7739C15.1335 59.6813 23.1457 63 31.5 63C39.8543 63 47.8665 59.6813 53.7739 53.7739C59.6813 47.8665 63 39.8543 63 31.5C63 23.1457 59.6813 15.1335 53.7739 9.22614C47.8665 3.31874 39.8543 0 31.5 0ZM49.0545 31.5L22.5 13.797V49.203L49.0545 31.5Z" fill="white" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>