<?php

/**
 * Bloco: Carrossel de Imagens em Tela Cheia
 */
include 'conf_gerais.php';

$subtitulo   = get_sub_field('subtitulo');
$titulo      = get_sub_field('tituo');
$descricao   = get_sub_field('descricao');
$btn_nome    = get_sub_field('btn_nome');
$btn_link    = get_sub_field('btn_link');

$class       = get_sub_field('classe');
?>

<section class="carrossel-full <?php echo esc_attr($class); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="carrossel-full__content">
            <div class="carrossel-full__first-row">
                <?php if ($subtitulo): ?>
                    <div class="carrossel-full__subtitulo">
                        <span><?php echo esc_html($subtitulo); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($titulo): ?>
                    <h2 class="carrossel-full__titulo"><?php echo esc_html($titulo); ?></h2>
                <?php endif; ?>
            </div>

            <div class="carrossel-full__second-row">
                <?php if ($descricao): ?>
                    <p class="carrossel-full__descricao"><?php echo wp_kses_post($descricao); ?></p>
                <?php endif; ?>
            </div>

            <?php if ($btn_nome && $btn_link): ?>
                <div class="carrossel-full__btn">
                    <a href="<?php echo esc_url($btn_link); ?>" class="btn-carrossel-full">
                        <span>
                            <?php echo esc_html($btn_nome); ?>
                        </span>
                        <div class="icon">
                            <svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4783 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4783 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28904 26.9763 4.66511Z" fill="#00512A" />
                            </svg>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="swiper swiper-full-carrossel">
        <div class="swiper-wrapper">
            <?php if (have_rows('carrossel_de_imagens')) : ?>
                <?php while (have_rows('carrossel_de_imagens')) : the_row(); ?>
                    <?php $imagem = get_sub_field('imagem'); ?>
                    <?php if ($imagem) : ?>
                        <div class="swiper-slide">
                            <div class="carrossel-full__slide">
                                <img src="<?php echo esc_url($imagem['url'] ?? $imagem); ?>"
                                    alt="<?php echo esc_attr($imagem['alt'] ?? ''); ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div class="swiper-full-carrossel-pagination"></div>
    </div>
</section>