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
                
                <!-- Desktop: Nav Tabs Padrão -->
                <div class="nav nav-pills justify-content-center nav-solucoes" id="pills-tab" role="tablist">
                    <?php 
                    $count = 0;
                    if($solucoes_tabs):
                        foreach ($solucoes_tabs as $key => $tab) : 
                            $active = ($count === 0) ? 'active' : '';
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

                <!-- Mobile: Custom Select Dropdown -->
                <div class="custom-select-mobile position-relative">
                    <?php if($solucoes_tabs): 
                        $first_tab = $solucoes_tabs[0];
                    ?>
                        <div class="select-trigger">
                            <span class="current-value"><?php echo $first_tab['label_aba']; ?></span>
                            <svg class="select-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 6L8 11L3 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        
                        <div class="select-dropdown position-absolute w-100 bg-white shadow-sm rounded-4 mt-2" style="display: none; z-index: 10;">
                            <ul class="list-unstyled mb-0 p-2">
                                <?php 
                                $count = 0;
                                foreach ($solucoes_tabs as $key => $tab) : 
                                    $active = ($count === 0) ? 'selected' : '';
                                    $tab_id = 'pills-' . $key; 
                                ?>
                                    <li class="dropdown-item py-2 px-3 rounded-3 <?php echo $active; ?>" data-target="#<?php echo $tab_id; ?>" data-label="<?php echo $tab['label_aba']; ?>">
                                        <?php echo $tab['label_aba']; ?>
                                    </li>
                                <?php 
                                    $count++;
                                endforeach; 
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
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
