<?php
/**
 * Block: Seção Texto e Imagem
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos Específicos
$titulo = get_sub_field('titulo');
$texto = get_sub_field('texto');
$imagem = get_sub_field('imagem');
$posicaoImagem = get_sub_field('posicao_imagem'); // 'esquerda' ou 'direita'
$btnNome = get_sub_field('nome_botao');
$btnLink = get_sub_field('link_botao');

// Classe para inverter a ordem
$orderClass = ($posicaoImagem == 'direita') ? 'flex-row-reverse' : '';
?>

<section class="secao-texto-imagem" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="row align-items-center <?php echo $orderClass; ?>">
            
            <!-- Imagem -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <?php if ($imagem) : ?>
                    <div class="wrapper-imagem" data-aos="fade-up">
                        <img src="<?php echo esc_url($imagem['url']); ?>" alt="<?php echo esc_attr($imagem['alt']); ?>" class="img-fluid rounded shadow-sm">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Conteúdo -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="wrapper-conteudo" style="<?php echo esc_attr($corFonte); ?>">
                    <?php if ($titulo) : ?>
                        <h2 class="mb-3"><?php echo $titulo; ?></h2>
                    <?php endif; ?>

                    <?php if ($texto) : ?>
                        <div class="texto-editor mb-4">
                            <?php echo $texto; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($btnNome && $btnLink) : ?>
                        <a href="<?php echo esc_url($btnLink); ?>" class="btn-primary">
                            <?php echo esc_html($btnNome); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
