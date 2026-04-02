<?php
/**
 * Bloco: Plantas (Carrossel)
 */
include 'conf_gerais.php';

$id = 'secao-plantas-' . (isset($block['id']) ? $block['id'] : uniqid());
$classe_projeto = 'secao-plantas';

$subtitulo = get_sub_field('subtitulo_plantas');
$titulo    = get_sub_field('titulo_plantas');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classe_projeto); ?>" style="<?php echo isset($geraisCSS) ? $geraisCSS : ''; ?>">
    <div class="container">
        <div class="secao-plantas__header">
            <?php if($subtitulo): ?>
                <span class="secao-plantas__subtitle"><?php echo esc_html($subtitulo); ?></span>
            <?php endif; ?>

            <?php if($titulo): ?>
                <h2 class="secao-plantas__title"><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </div>
    </div>

    <div class="secao-plantas__slider-wrapper">
        <div class="swiper swiper-plantas">
            <div class="swiper-wrapper">
                <?php if (have_rows('carrossel_plantas')) : ?>
                    <?php while (have_rows('carrossel_plantas')) : the_row(); 
                        $imagem   = get_sub_field('imagem_planta');
                        $tipo     = get_sub_field('titulo_tipo');
                        $metragem = get_sub_field('metragem');
                    ?>
                        <div class="swiper-slide">
                            <div class="planta-card">
                                <?php if ($imagem) : ?>
                                    <div class="planta-card__image">
                                        <img src="<?php echo esc_url($imagem['url']); ?>" alt="<?php echo esc_attr($tipo ? $tipo : 'Planta do empreendimento'); ?>">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="planta-card__content">
                                    <?php if ($tipo) : ?>
                                        <h4 class="planta-card__title"><?php echo esc_html($tipo); ?></h4>
                                    <?php endif; ?>
                                    
                                    <?php if ($metragem) : ?>
                                        <div class="planta-card__info">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#00512A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 17L12 22L22 17" stroke="#00512A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 12L12 17L22 12" stroke="#00512A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            <span><?php echo esc_html($metragem); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>