<?php
/**
 * Block: Seção Canais de Atendimento
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

$titulo = get_sub_field('titulo');

?>

<section class="sessao-parceiros">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?php echo $titulo; ?></h2>
            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <div class="card-item">
                    <?php if (have_rows('parceiros_cards')): ?>
                        <?php while (have_rows('parceiros_cards')):
                            the_row(); ?>
                            <div class="card">
                                <div class="icone">
                                    <?php echo get_sub_field('icone'); ?>
                                </div>
                                <h3><?php echo get_sub_field('titulo'); ?></h3>
                                <p><?php echo get_sub_field('conteudo'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>