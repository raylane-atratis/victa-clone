<?php
/**
 * Bloco: Seção Propósito
 */
include 'conf_gerais.php'; // Certifique-se que este arquivo existe no mesmo diretório

// Captura de Campos ACF
$subtitulo      = get_sub_field('subtitulo');
$titulo         = get_sub_field('titulo');
$layout_grid    = get_sub_field('layout_grid') ?: '3'; 
$itens_grid     = get_sub_field('itens_grid'); // Repetidor
$itens_destaque = get_sub_field('itens_destaque'); // Repetidor

// DEFINIÇÃO DA VARIÁVEL QUE ESTAVA FALTANDO
$classe_extra   = get_sub_field('classe'); 

// Classe da grid
$grid_class = "secao-proposito__grid--" . $layout_grid;
?>

<section class="secao-proposito <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        
        <header class="secao-proposito__header">
            <?php if ($subtitulo) : ?>
                <span class="secao-proposito__subtitulo"><?php echo esc_html($subtitulo); ?></span>
            <?php endif; ?>
            
            <?php if ($titulo) : ?>
                <h2 class="secao-proposito__titulo"><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </header>

        <?php if ($itens_grid) : ?>
            <div class="secao-proposito__grid <?php echo $grid_class; ?>">
                <?php foreach ($itens_grid as $item) : ?>
                    <div class="secao-proposito__item">
                        <h3 class="secao-proposito__item-titulo"><?php echo esc_html($item['item_titulo']); ?></h3>
                        <p class="secao-proposito__item-texto"><?php echo esc_html($item['item_descricao']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($itens_destaque) : ?>
            <div class="secao-proposito__destaque-wrapper">
                <?php foreach ($itens_destaque as $destaque) : ?>
                    <div class="secao-proposito__card">
                        <h3 class="secao-proposito__card-titulo"><?php echo esc_html($destaque['destaque_titulo']); ?></h3>
                        <div class="secao-proposito__card-texto">
                            <?php echo wp_kses_post($destaque['destaque_descricao']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>