<?php
/**
 * Bloco: ODS - Compromisso com a Legalidade
 */
include 'conf_gerais.php';

// Header Superior
$titulo_secao    = get_sub_field('titulo_secao');
$descricao_secao = get_sub_field('descricao_secao');

// Coluna Esquerda
$texto_esquerda  = get_sub_field('texto_esquerda');
$grid_ods        = get_sub_field('grid_ods');

// Coluna Direita (Caixa Verde)
$titulo_caixa    = get_sub_field('titulo_caixa');
$lista_ods       = get_sub_field('lista_ods');

$classe_geral    = get_sub_field('classe_geral');
?>

<section class="secao-ods <?php echo esc_attr($classe_geral); ?>" style="<?php echo $geraisCSS; ?>">
    <div class="container">
        
        <div class="secao-ods__header">
            <?php if ($titulo_secao) : ?>
                <h2 class="secao-ods__main-title"><?php echo esc_html($titulo_secao); ?></h2>
            <?php endif; ?>
            <?php if ($descricao_secao) : ?>
                <div class="secao-ods__main-desc"><?php echo wp_kses_post($descricao_secao); ?></div>
            <?php endif; ?>
        </div>

        <div class="secao-ods__content">
            <div class="secao-ods__col-left">
                <?php if ($texto_esquerda) : ?>
                    <div class="secao-ods__editor">
                        <?php echo $texto_esquerda; ?>
                    </div>
                <?php endif; ?>

                <?php if ($grid_ods) : ?>
                    <div class="secao-ods__grid">
                        <?php foreach ($grid_ods as $item) : 
                            $img = $item['imagem_ods']; 
                        ?>
                            <div class="secao-ods__grid-item">
                                <?php if ($img) : ?>
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="ODS">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="secao-ods__col-right">
                <div class="secao-ods__box">
                    <?php if ($titulo_caixa) : ?>
                        <h3 class="secao-ods__box-title"><?php echo esc_html($titulo_caixa); ?></h3>
                    <?php endif; ?>

                    <?php if ($lista_ods) : ?>
                        <div class="secao-ods__list">
                            <?php foreach ($lista_ods as $row) : ?>
                                <div class="secao-ods__list-item">
                                    <?php echo wp_kses_post($row['texto_item']); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</section>