<?php
/**
 * Block: Seção Soluções (Com Abas)
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos do Bloco (Topo)
$titulo = get_sub_field('titulo_solucoes');
$descricao = get_sub_field('descricao_solucoes');
$solucoes_tabs = get_sub_field('solucoes_repeater');

?>

<section class="secao-solucoes" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        
        <!-- Header da Seção -->
        <?php if ($titulo || $descricao) : ?>
            <div class="row mb-5">
                <div class="col-lg-8 text-center header-solucoes" style="<?php echo esc_attr($corFonte); ?>">
                    <?php if ($titulo) : ?>
                        <h2 class="titulo-secao mb-3"><?php echo $titulo; ?></h2>
                    <?php endif; ?>
                    
                    <?php if ($descricao) : ?>
                        <div class="descricao-secao">
                            <?php echo $descricao; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Navegação das Abas -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-12">
                <div class="nav nav-pills justify-content-center nav-solucoes" id="pills-tab" role="tablist">
                    <?php 
                    $count = 0;
                    if($solucoes_tabs):
                        foreach ($solucoes_tabs as $key => $tab) : 
                            $active = ($count === 0) ? 'active' : '';
                            // Como o repeater retorna array numérico, usamos o índice como ID único
                            $tab_id = 'pills-' . $key; 
                        ?>
                            <button class="nav-link <?php echo $active; ?>" id="<?php echo $tab_id; ?>-tab" data-bs-toggle="pill" data-bs-target="#<?php echo $tab_id; ?>" type="button" role="tab" aria-controls="<?php echo $tab_id; ?>" aria-selected="<?php echo ($count === 0) ? 'true' : 'false'; ?>">
                                <?php echo $tab['label_aba']; ?>
                            </button>
                        <?php 
                            $count++;
                        endforeach; 
                    endif;
                    ?>
                </div>
            </div>
        </div>

        <!-- Conteúdo das Abas -->
        <div class="row container-content-solucoes">
            <div class="col-lg-8">
                <div class="tab-content content-solucoes" id="pills-tabContent">
                    <?php 
                    $count = 0;
                    if($solucoes_tabs):
                        foreach ($solucoes_tabs as $key => $tab) : 
                            $active = ($count === 0) ? 'show active' : '';
                            $tab_id = 'pills-' . $key; 
                        ?>
                            <div class="tab-pane fade <?php echo $active; ?>" id="<?php echo $tab_id; ?>" role="tabpanel" aria-labelledby="<?php echo $tab_id; ?>-tab">
                                <div class="card-aba bg-white p-5 rounded-4 shadow-sm">
                                    <span class="badge-aba mb-3"><?php echo $tab['label_aba']; ?></span>
                                    <strong class="mb-2"><?php echo $tab['titulo_card']; ?></strong>
                                    <p class="text-muted mb-5"><?php echo $tab['subtitulo_card']; ?></p>

                                    <div class="row g-4 mb-5">
                                        <?php 
                                        if($tab['itens_beneficio']):
                                            foreach ($tab['itens_beneficio'] as $item) : ?>
                                                <div class="col-md-6">
                                                    <div class="item-beneficio">
                                                        <div class="icon-box text-primary">
                                                            <?php echo $item['icone']; ?>
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 fw-medium"><?php echo $item['texto_item']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; 
                                        endif; ?>
                                    </div>

                                    <div class="text-center content-cta">
                                        <a href="<?php echo $tab['cta_link']; ?>" class="btn btn-primary btn-lg rounded-pill px-5 text-white fw-bold">
                                            <?php echo $tab['cta_texto']; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            $count++;
                        endforeach; 
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </div>
</section>
