<?php
/**
 * Block: Seção Canais de Atendimento
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

$titulo = get_sub_field('titulo');
$descricao = get_sub_field('conteudo');
$svg = get_sub_field('svg');

?>

<section class="canais-atendimento">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="canais-atendimento__header">
                    <div class="canais-atendimento__header__icon">
                        <?php echo $svg; ?>
                    </div>
                    <h2><?php echo $titulo; ?></h2>
                    <p><?php echo $descricao; ?></p>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="canais-atendimento__canais">
                    <?php if (have_rows('canais')): ?>
                        <?php while (have_rows('canais')):
                            the_row(); ?>
                            <div class="canais-atendimento__canais__item">
                                <a href="<?php echo get_sub_field('link'); ?>" target="_blank">
                                    <div class="d-flex justify-content-center">
                                        <?php echo get_sub_field('icone'); ?>
                                    </div>
                                    <div class="canais-atendimento__canais__content">
                                        <p><?php echo get_sub_field('nome'); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>