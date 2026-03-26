<?php
/**
 * Bloco: Certificados e Premiações
 */
include 'conf_gerais.php';

$subtitulo    = get_sub_field('subtitulo');
$titulo       = get_sub_field('titulo');
$cols         = get_sub_field('colunas_desktop') ?: '2';
$certificados = get_sub_field('certificados');
$classe_geral = get_sub_field('classe_geral');

// Lógica de layout: >= 4 colunas vira vertical
$layout_class = ((int)$cols >= 4) ? 'is-vertical' : 'is-horizontal';
$layout_class = ((int)$cols >= 3) ? 'is-vertical' : 'is-horizontal';
$grid_class   = "secao-certificados__grid--cols-{$cols}";
?>

<section class="secao-certificados <?php echo esc_attr($classe_geral); ?>" 
         style="<?php echo $geraisCSS; ?>">
    <div class="container">
        
        <div class="secao-certificados__header">
            <?php if ($subtitulo) : ?>
                <span class="secao-certificados__sub"><?php echo esc_html($subtitulo); ?></span>
            <?php endif; ?>
            <?php if ($titulo) : ?>
                <h2 class="secao-certificados__titulo-principal"><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </div>

        <?php if ($certificados) : ?>
            <div class="secao-certificados__grid <?php echo $grid_class; ?> <?php echo $layout_class; ?>">
                <?php foreach ($certificados as $item) : 
                    $icone = $item['icone'];
                    $tit   = $item['titulo_card'];
                    $desc  = $item['descricao'];
                ?>
                    <div class="secao-certificados__card">
                        <div class="secao-certificados__card-icone">
                            <?php if ($icone) : ?>
                                <img src="<?php echo esc_url($icone['url']); ?>" alt="<?php echo esc_attr($tit); ?>">
                            <?php endif; ?>
                        </div>

                        <div class="secao-certificados__card-content">
                            <h3 class="secao-certificados__card-title"><?php echo esc_html($tit); ?></h3>
                            <div class="secao-certificados__card-text">
                                <?php echo wp_kses_post($desc); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>