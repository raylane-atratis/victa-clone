<?php
/**
 * Block: Seção Cards Flexíveis
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

$titulo = get_sub_field('titulo');
$descricao = get_sub_field('descricao');
$texto_pequeno = get_sub_field('texto_pequeno');
$imagem = get_sub_field('imagem');

?>

<section class="sessao-clube-vantagens">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                <div class="conteudo-clube" >
                    <?php if ($titulo): ?>
                        <h2><?php echo $titulo; ?></h2>
                    <?php endif; ?>

                    <?php if ($descricao): ?>
                        <p class="descricao-clube"><?php echo $descricao; ?></p>
                    <?php endif; ?>

                    <?php if ($texto_pequeno): ?>
                        <p class="texto-pequeno"><?php echo $texto_pequeno; ?></p>
                    <?php endif; ?>

                    <?php if (have_rows('cards_beneficios')): ?>
                        <div class="cards-beneficios">
                            <?php while (have_rows('cards_beneficios')):
                                the_row(); ?>
                                <div class="card-beneficio">
                                    <?php $icone = get_sub_field('icone_svg'); ?>
                                    <?php if ($icone): ?>
                                        <div class="icone-beneficio">
                                            <?php echo $icone; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="texto-beneficio">
                                        <?php $titulo_card = get_sub_field('titulo_card'); ?>
                                        <?php if ($titulo_card): ?>
                                            <h4><?php echo $titulo_card; ?></h4>
                                        <?php endif; ?>

                                        <?php $descricao_card = get_sub_field('descricao_card'); ?>
                                        <?php if ($descricao_card): ?>
                                            <p><?php echo $descricao_card; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                <div class="imagem-clube">
                    <div class="imagem-container-clube">
                        <?php if ($imagem): ?>
                            <img src="<?php echo $imagem['url']; ?>" alt="<?php echo $imagem['alt']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>