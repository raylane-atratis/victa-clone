<?php

/**
 * Bloco: Seção Ficha Tecnica
 */

// Configurações Gerais (espaçamentos e backgrounds do ACF)
include 'conf_gerais.php';

$subtitulo = get_sub_field('subtitulo');
$titulo    = get_sub_field('titulo');
$card_titulo = get_sub_field('card_titulo'); // "Exibir ficha técnica completa"
?>

<section class="ficha-tecnica" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="ficha-tecnica__container-box">
            <div class="ficha-tecnica__header js-ficha-toggle">
                <div class="ficha-tecnica__titles">
                    <?php if ($subtitulo): ?>
                        <span class="ficha-tecnica__sub"><?php echo esc_html($subtitulo); ?></span>
                    <?php endif; ?>

                    <h2 class="ficha-tecnica__main-title"
                        data-text-closed="<?php echo esc_attr($card_titulo); ?>"
                        data-text-open="Fechar exibição completa">
                        <?php echo esc_html($card_titulo); ?>
                    </h2>
                </div>

                <div class="ficha-tecnica__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="15" viewBox="0 0 24 15" fill="none">
                        <path d="M0 0L12 15L24 0H0Z" fill="#00512A" />
                    </svg>
                </div>
            </div>

            <div class="ficha-tecnica__content">
                <div class="ficha-tecnica__inner-content">
                    <div class="ficha-tecnica__card">
                        <hr class="ficha-tecnica__divider">

                        <div class="ficha-tecnica__grid">
                            <?php if (have_rows('ficha_colunas')) : ?>
                                <?php while (have_rows('ficha_colunas')) : the_row(); ?>
                                    <div class="ficha-tecnica__col">
                                        <h4 class="ficha-tecnica__col-title"><?php the_sub_field('titulo_coluna'); ?></h4>
                                        <?php if (have_rows('conteudo_coluna')) : ?>
                                            <div class="ficha-tecnica__col-body">
                                                <?php while (have_rows('conteudo_coluna')) : the_row(); ?>
                                                    <div class="ficha-tecnica__item">
                                                        <?php if ($sub = get_sub_field('item_subtitulo')): ?>
                                                            <h5 class="ficha-tecnica__item-label"><?php echo esc_html($sub); ?></h5>
                                                        <?php endif; ?>
                                                        <div class="ficha-tecnica__list">
                                                            <?php echo get_sub_field('item_lista'); ?>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>