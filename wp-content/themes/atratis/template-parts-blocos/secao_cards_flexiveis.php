<?php
/**
 * Block: Seção Cards Flexíveis
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

$titulo = get_sub_field("titulo");

// Contando quantos cards existem
$cards_acesso = get_sub_field('cards_acesso');
$contagem_cards = is_array($cards_acesso) ? count($cards_acesso) : 0;

// Definindo a classe do grid baseado na quantidade
$classe_grid = '';
switch($contagem_cards) {
    case 1:
        $classe_grid = 'grid-1-card';
        break;
    case 2:
        $classe_grid = 'grid-2-cards';
        break;
    case 3:
        $classe_grid = 'grid-3-cards';
        break;
    case 4:
        $classe_grid = 'grid-4-cards';
        break;
    default:
        $classe_grid = 'grid-multiplos-cards';
}
?>

<div class="sessao-parceiros-acesso">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="titulo-sessao">
                    <h2><?php echo $titulo ?></h2>
                </div>
            </div>
        </div>
        <div class="cards-container <?php echo $classe_grid; ?>">
            <?php if (have_rows('cards_acesso')): ?>
                <?php while (have_rows('cards_acesso')): the_row(); ?>
                    
                    <div class="card-wrapper">
                        <div class="card-acesso-item">
                            <div class="icon-svg">
                                <?php echo get_sub_field("svg") ?>
                            </div>
                            <div class="conteudo-card">
                                <h3><?php echo get_sub_field("titulo") ?></h3>
                                <p><?php echo get_sub_field("descricao") ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>