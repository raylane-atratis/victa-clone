<?php

/**
 * Bloco: Newsletter de Empreendimentos
 */
include 'conf_gerais.php';

$texto_acima    = get_sub_field('texto_acima');
$titulo         = get_sub_field('titulo');
$subtitulo      = get_sub_field('subtitulo');
$descricao      = get_sub_field('descricao');
$shortcode_form = get_sub_field('shortcode_form');
$classe_geral   = get_sub_field('classe_geral');

$logo = get_field('logo_image', 'option');
?>

<section class="secao-newsletter-empreendimentos <?= esc_attr($classe_geral) ?>">
    <div class="container">
        <?php if ($texto_acima): ?>
            <div class="row">
                <div class="col-12">
                    <span class="secao-newsletter-empreendimentos__texto-acima"><?php echo $texto_acima ?></span>
                </div>
            </div>
        <?php endif; ?>

        <div class="card-newsletter-empreendimentos">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="secao-newsletter-empreendimentos__header">
                        <?php if ($subtitulo): ?>
                            <p class="secao-newsletter-empreendimentos__subtitulo"><?= esc_html($subtitulo) ?></p>
                        <?php endif; ?>

                        <?php if ($titulo): ?>
                            <h2 class="secao-newsletter-empreendimentos__titulo"><?= wp_kses_post($titulo) ?></h2>
                        <?php endif; ?>

                        <?php if ($descricao): ?>
                            <p class="secao-newsletter-empreendimentos__descricao"><?= wp_kses_post($descricao) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="secao-newsletter-empreendimentos__footer">
                        <?php if ($logo): ?>
                            <img src="<?= esc_url($logo['url']) ?>" alt="<?= esc_attr($logo['alt']) ?>" class="secao-newsletter-empreendimentos__logo">
                        <?php endif; ?>
                        <div class="secao-newsletter-empreendimentos__separator"></div>
                        <p class="secao-newsletter-empreendimentos__texto-abaixo">Um empreendimento com a qualidade Victa</p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="secao-newsletter-empreendimentos__form-wrapper">
                        <?= do_shortcode($shortcode_form) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>