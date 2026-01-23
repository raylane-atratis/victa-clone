<?php
/**
 * Block: Seção Facilidades
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

$titulo = get_sub_field('titulo');
$imagem = get_sub_field('imagem');
?>

<section class="sessao-facilidades-tafacil">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-sm-12 order-2 order-lg-1">
                <div class="conteudo-facilidades">
                    <?php if ($titulo): ?>
                        <h2><?php echo $titulo; ?></h2>
                    <?php endif; ?>
                    
                    <?php if (have_rows('elementos_facilidade')): ?>
                        <div class="facilidades">
                            <?php while (have_rows('elementos_facilidade')): the_row(); ?>
                                <div class="facilidade-item">
                                    <div class="icone-facilidade">
                                        <?php echo get_sub_field('svg'); ?>
                                    </div>
                                    <p><?php echo get_sub_field('descricao'); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 order-1 order-lg-2">
                <div class="imagem-facilidades">
                    <div class="imagem-container">
                        <?php if ($imagem): ?>
                            <img src="<?php echo $imagem['url']; ?>" alt="<?php echo $imagem['alt']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
