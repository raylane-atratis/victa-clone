<?php
/**
 * Bloco: Diferenciais
 */
include 'conf_gerais.php';

$id = 'diferenciais-' . (isset($block['id']) ? $block['id'] : uniqid());
$classe_projeto = 'secao-diferenciais';

$subtitulo = get_sub_field('subtitulo_dif');
$titulo    = get_sub_field('titulo_dif');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classe_projeto); ?>" style="<?php echo isset($geraisCSS) ? $geraisCSS : ''; ?>">
    <div class="container">
        
        <div class="secao-diferenciais__header">
            <?php if($subtitulo): ?>
                <span class="secao-diferenciais__subtitle"><?php echo esc_html($subtitulo); ?></span>
            <?php endif; ?>

            <?php if($titulo): ?>
                <h2 class="secao-diferenciais__title"><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </div>

        <div class="secao-diferenciais__grid">
            <?php if (have_rows('itens_diferenciais')) : ?>
                <?php while (have_rows('itens_diferenciais')) : the_row(); 
                    $svg = get_sub_field('svg_icon');
                    $texto = get_sub_field('texto_item');
                ?>
                    <div class="secao-diferenciais__item">
                        <div class="secao-diferenciais__icon">
                            <?php echo $svg; ?>
                        </div>
                        <span class="secao-diferenciais__text"><?php echo esc_html($texto); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

    </div>
</section>