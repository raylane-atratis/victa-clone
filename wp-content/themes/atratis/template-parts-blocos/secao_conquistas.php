<?php
/**
 * Bloco: Nossas Conquistas
 */
include 'conf_gerais.php';

$titulo_secao = get_sub_field('titulo_secao') ?: 'Nossas conquistas';
$conquistas   = get_sub_field('conquistas'); // Repetidor
$classe_extra = get_sub_field('classe');
?>

<section class="secao-conquistas <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="secao-conquistas__wrapper">
            
            <?php if ($titulo_secao) : ?>
                <h2 class="secao-conquistas__titulo-principal">
                    <?php 
                        // Lógica simples para colorir a última palavra de verde se desejar
                        echo wp_kses_post($titulo_secao); 
                    ?>
                </h2>
            <?php endif; ?>

            <?php if ($conquistas) : ?>
                <div class="secao-conquistas__grid">
                    <?php foreach ($conquistas as $item) : 
                        $img = $item['imagem'];
                        $tit = $item['titulo'];
                        $desc = $item['descricao'];
                    ?>
                        <div class="secao-conquistas__item">
                            <div class="secao-conquistas__imagem-box">
                                <?php if ($img) : ?>
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                                <?php endif; ?>
                            </div>
                            
                            <div class="secao-conquistas__content">
                                <h3 class="secao-conquistas__titulo-item"><?php echo esc_html($tit); ?></h3>
                                <div class="secao-conquistas__texto">
                                    <?php echo wp_kses_post($desc); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>