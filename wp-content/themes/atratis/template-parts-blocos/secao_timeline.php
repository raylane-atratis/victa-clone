<?php

/**
 * Bloco: Linha do Tempo (Timeline Swiper)
 */
include 'conf_gerais.php';
$id_sessao_timeline = (isset($id_sessao) && !empty($id_sessao)) ? $id_sessao : 'timeline-' . uniqid();
$subtitulo = get_sub_field('subtitulo');
$titulo    = get_sub_field('titulo');
$bg_image  = get_sub_field('background_image');
$timeline  = get_sub_field('linha_do_tempo');
$classe    = get_sub_field('classe');
$bg_url    = is_array($bg_image) ? $bg_image['url'] : $bg_image;
$total     = is_array($timeline) ? count($timeline) : 0;
?>
<section class="secao-timeline <?php echo esc_attr($classe); ?>"
    id="<?php echo esc_attr($id_sessao_timeline); ?>"
    style="--bg-timeline: url('<?php echo esc_url($bg_url); ?>'); <?php echo $geraisCSS; ?>">
    <div class="container">
        <div class="secao-timeline__header">
            <?php if ($subtitulo) : ?>
                <span class="secao-timeline__sub"><?php echo esc_html($subtitulo); ?></span>
            <?php endif; ?>
            <?php if ($titulo) : ?>
                <h2 class="secao-timeline__titulo-principal"><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </div>

        <?php if ($timeline) : ?>
            <div class="secao-timeline__slider-wrapper">
                <div class="swiper js-swiper-timeline">
                    <div class="swiper-wrapper">
                        <?php foreach ($timeline as $index => $item) :
                            $ano      = $item['ano'];
                            $tit_card = $item['titulo_card'];
                            $desc     = $item['descricao'];
                            $is_first = $index === 0;
                            $is_last  = $index === $total - 1;
                        ?>
                            <div class="swiper-slide">
                                <div class="secao-timeline__node">
                                    <span class="secao-timeline__ano"><?php echo esc_html($ano); ?></span>
                                </div>

                                <div class="secao-timeline__card-wrapper">
                                </div>

                                <div class="secao-timeline__card-wrapper">
                                    <div class="secao-timeline__dot">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                            <circle cx="14" cy="14" r="13.5" fill="white" stroke="#E4E4E4" />
                                            <circle cx="14.0002" cy="14" r="8.66667" fill="#42CE02" />
                                        </svg>
                                    </div>
                                    <div class="secao-timeline__card">
                                        <h3 class="secao-timeline__card-title"><?php echo esc_html($tit_card); ?></h3>
                                        <div class="secao-timeline__card-text">
                                            <?php echo wp_kses_post($desc); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="timeline-pagination"></div>
            </div>
        <?php endif; ?>
    </div>
</section>