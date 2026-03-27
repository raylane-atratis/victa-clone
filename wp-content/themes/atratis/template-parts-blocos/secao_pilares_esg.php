<?php

/**
 * Bloco: Pilares ESG com Grupo Modal
 */
include 'conf_gerais.php';

$subtitulo = get_sub_field('subtitulo');
$titulo    = get_sub_field('titulo');
$cards     = get_sub_field('cards_esg');

$classe_geral = get_sub_field('classe_geral');
?>

<section class="secao-esg <?php echo esc_attr($classe_geral); ?>" style="<?php echo $geraisCSS; ?>">
    <div class="container">

        <div class="secao-esg__header">
            <?php if ($subtitulo) : ?><span><?php echo esc_html($subtitulo); ?></span><?php endif; ?>
            <?php if ($titulo) : ?><h2><?php echo wp_kses_post($titulo); ?></h2><?php endif; ?>
        </div>

        <?php if ($cards) : ?>
            <div class="secao-esg__slider-wrapper">
                <div class="swiper js-swiper-esg">
                    <div class="swiper-wrapper">
                        <?php foreach ($cards as $key => $card) : ?>
                            <div class="swiper-slide">
                                <div class="esg-card">
                                    <div class="esg-card__image">
                                        <?php if ($card['imagem_capa']) : ?>
                                            <img src="<?php echo esc_url($card['imagem_capa']['url']); ?>" alt="<?php echo esc_attr($card['titulo_card']); ?>">
                                        <?php endif; ?>
                                    </div>

                                    <div class="esg-card__icon-box">
                                        <?php echo $card['svg_icone']; ?>
                                    </div>

                                    <div class="esg-card__content">
                                        <h3><?php echo esc_html($card['titulo_card']); ?></h3>
                                        <div class="esg-card__text">
                                            <?php echo $card['descricao_curta']; ?>
                                        </div>
                                        <button class="js-open-modal-esg btn-esg-modal" data-modal="modal-esg-<?php echo $key; ?>">
                                            Saiba mais
                                            <svg width="20" height="10" viewBox="0 0 20 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 0L10 10L20 0H0Z" fill="currentColor" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="esg-pagination"></div>
            </div>

            <?php foreach ($cards as $key => $card) :
                // Atalho para facilitar a leitura dos campos do grupo
                $modal = $card['grupo_modal'];
            ?>
                <div class="esg-modal js-modal-esg" id="modal-esg-<?php echo $key; ?>">
                    <div class="esg-modal__overlay"></div>

                    <div class="esg-modal__container">
                        <button class="esg-modal__close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M20 3.00524L16.9948 0L10 6.99618L3.00524 0L0 3.00524L6.99618 10L0 16.9948L3.00524 20L10 13.0038L16.9948 20L20 16.9948L13.0038 10L20 3.00524Z" fill="currentColor" />
                            </svg>
                        </button>

                        <div class="esg-modal__header">
                            <span><?php echo esc_html($modal['modal_subtitulo']); ?></span>
                            <h2><?php echo esc_html($modal['modal_titulo']); ?></h2>
                        </div>

                        <div class="esg-modal__body">
                            <div class="esg-modal__gallery">
                                <div class="swiper js-swiper-modal-esg">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $galeria = $modal['modal_galeria']; // Puxa o campo Galeria de dentro do grupo_modal

                                        if ($galeria) :
                                            foreach ($galeria as $img) :
                                                // No campo Galeria, cada $img já é o array da imagem (com url, alt, etc)
                                        ?>
                                                <div class="swiper-slide">
                                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                                                </div>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                    <div class="modal-pagination"></div>
                                </div>
                            </div>

                            <div class="esg-modal__info">
                                <div class="esg-modal__text">
                                    <?php echo $modal['modal_texto_completo']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</section>