<?php

/**
 * Bloco: Localização com Mapa e Checklist
 */
include 'conf_gerais.php';

$mapa_img    = get_sub_field('mapa_imagem');
$subtitulo   = get_sub_field('subtitulo_local');
$titulo      = get_sub_field('titulo_local');
$descricao   = get_sub_field('descricao_local');

$id = 'localizacao-' . (isset($block['id']) ? $block['id'] : uniqid());
?>

<section id="<?php echo $id; ?>" class="secao-localizacao" style="<?php echo $geraisCSS; ?>">
    <div class="container">

        <div class="secao-localizacao__card">
            <div class="secao-localizacao__map">
                <?php if ($mapa_img): ?>
                    <img src="<?php echo esc_url($mapa_img['url'] ?? $mapa_img); ?>" alt="Mapa de Localização">
                <?php endif; ?>
            </div>

            <div class="secao-localizacao__content">
                <div class="secao-localizacao__header">
                    <?php if ($subtitulo): ?>
                        <div class="secao-localizacao__address">
                            <svg width="23" height="29" viewBox="0 0 23 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.9166 11.4583C21.9166 19.302 11.4583 27.1457 11.4583 27.1457C11.4583 27.1457 1 19.302 1 11.4583C1 8.68459 2.10185 6.02448 4.06316 4.06316C6.02448 2.10185 8.68459 1 11.4583 1C14.232 1 16.8921 2.10185 18.8534 4.06316C20.8147 6.02448 21.9166 8.68459 21.9166 11.4583Z" stroke="#42CE02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.4583 15.3803C13.6243 15.3803 15.3802 13.6245 15.3802 11.4585C15.3802 9.2925 13.6243 7.53662 11.4583 7.53662C9.29232 7.53662 7.53644 9.2925 7.53644 11.4585C7.53644 13.6245 9.29232 15.3803 11.4583 15.3803Z" stroke="#42CE02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span><?php echo esc_html($subtitulo); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($titulo): ?>
                        <h2 class="secao-localizacao__title"><?php echo wp_kses_post($titulo); ?></h2>
                    <?php endif; ?>

                    <?php if ($descricao): ?>
                        <p class="secao-localizacao__desc"><?php echo wp_kses_post($descricao); ?></p>
                    <?php endif; ?>
                </div>

                <div class="secao-localizacao__grid">
                    <?php if (have_rows('itens_proximidade')) : ?>
                        <?php while (have_rows('itens_proximidade')) : the_row(); ?>
                            <div class="secao-localizacao__item">
                                <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.8792 0L4.2553 6.71446L2.107 4.5368L0 6.67258L2.1483 8.85025L4.26906 11L6.37607 8.8642L13 2.14976L10.8792 0Z" fill="#42CE02" />
                                </svg>
                                <span><?php the_sub_field('texto_item'); ?></span>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</section>