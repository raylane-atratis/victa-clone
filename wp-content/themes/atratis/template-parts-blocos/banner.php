<?php
/**
 * Bloco: Banner Principal LP
 */

include 'conf_gerais.php';

// Campos ACF
$banner_desktop = get_sub_field('banner_desktop');
$banner_mobile  = get_sub_field('banner_mobile');
$titulo         = get_sub_field('titulo');
$subtitulo      = get_sub_field('subtitulo');

$cor_titulo     = get_sub_field('cor_titulo') ?: 'branco';    // branco | verde
$cor_subtitulo  = get_sub_field('cor_subtitulo') ?: 'verde';   // branco | verde

$btn            = get_sub_field('btn_banner');
$classe_extra   = get_sub_field('classe');

// Lógica de Classes Dinâmicas
$classe_cor_titulo = 'secao-banner__titulo--' . $cor_titulo;
$estilo_btn        = ($btn && !empty($btn['estilo'])) ? $btn['estilo'] : 'escuro';

// Lógica Complexa do Subtítulo:
// Criamos uma classe que identifica a cor dele e, se for branco, qual a cor do título junto
$classe_cor_sub = 'secao-banner__subtitulo--' . $cor_subtitulo;
if ($cor_subtitulo === 'branco') {
    $classe_cor_sub .= '-on-' . $cor_titulo;
}
?>

<section class="secao-banner secao-banner--desktop <?php echo esc_attr($classe_extra); ?>" 
         style="<?php echo esc_attr($geraisCSS); ?> <?php echo $banner_desktop ? "background-image: url('{$banner_desktop['url']}');" : ""; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="secao-banner__content">
                    <?php if ($titulo) : ?>
                        <h1 class="secao-banner__titulo <?php echo $classe_cor_titulo; ?>">
                            <?php echo wp_kses_post($titulo); ?>
                        </h1>
                    <?php endif; ?>

                    <?php if ($subtitulo) : ?>
                        <p class="secao-banner__subtitulo <?php echo $classe_cor_sub; ?>">
                            <?php echo esc_html($subtitulo); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($btn && !empty($btn['texto'])) : ?>
                        <a href="<?php echo esc_url($btn['link']); ?>" 
                           class="secao-banner__btn secao-banner__btn--<?php echo $estilo_btn; ?>"
                           <?php echo !empty($btn['target']) ? 'target="_blank"' : ''; ?>>
                            <span><?php echo esc_html($btn['texto']); ?></span>
                            <svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4784 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4784 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28905 26.9763 4.66511Z" fill="currentColor"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="secao-banner secao-banner--mobile <?php echo esc_attr($classe_extra); ?>" 
         style="<?php echo esc_attr($geraisCSS); ?> <?php echo $banner_mobile ? "background-image: url('{$banner_mobile['url']}');" : ""; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="secao-banner__content">
                    <?php if ($titulo) : ?>
                        <h1 class="secao-banner__titulo <?php echo $classe_cor_titulo; ?>">
                            <?php echo wp_kses_post($titulo); ?>
                        </h1>
                    <?php endif; ?>

                    <?php if ($subtitulo) : ?>
                        <p class="secao-banner__subtitulo <?php echo $classe_cor_sub; ?>">
                            <?php echo esc_html($subtitulo); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($btn && !empty($btn['texto'])) : ?>
                        <a href="<?php echo esc_url($btn['link']); ?>" 
                           class="secao-banner__btn secao-banner__btn--<?php echo $estilo_btn; ?>">
                            <span><?php echo esc_html($btn['texto']); ?></span>
                            <svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4784 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4784 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28905 26.9763 4.66511Z" fill="currentColor"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>