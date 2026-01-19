<?php
/**
 * Block: Seção Soluções (Com Abas)
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos do Bloco (Topo)
$titulo = get_sub_field('titulo_solucoes');
$descricao = get_sub_field('descricao_solucoes');

// 3. Dados Simulados (Posteriormente virão do ACF Repeater)
$solucoes_tabs = [
    'servidor' => [
        'label' => 'Servidor Público',
        'title' => 'Crédito com taxa mais baixa e pagamento direto na folha',
        'subtitle' => 'Cartão Benefício Consignado que cuida do servidor além do crédito',
        'cta_text' => 'Simular agora no WhatsApp',
        'cta_link' => '#',
        'items' => [
            ['icon' => 'bi-credit-card-2-front', 'text' => 'Cartão Benefício com vantagens reais'],
            ['icon' => 'bi-stopwatch', 'text' => 'Análise em 3 minutos'],
            ['icon' => 'bi-star', 'text' => 'Fatura mais previsível com desconto automático em folha'],
            ['icon' => 'bi-cash-coin', 'text' => 'Dinheiro na conta em até 2 horas via pix'],
            ['icon' => 'bi-calculator', 'text' => 'Parcelas em até 96x'],
            ['icon' => 'bi-percent', 'text' => 'Taxas mais baixas do que crédito pessoal'],
        ]
    ],
    'convenios' => [
        'label' => 'Convênios',
        'title' => 'Valorização do servidor sem custo para o órgão',
        'subtitle' => 'Operação segura, estável e dentro das normas.',
        'cta_text' => 'Fale com a gente agora',
        'cta_link' => '#',
        'items' => [
            ['icon' => 'bi-credit-card', 'text' => 'Cartão com vantagens e descontos reais'],
            ['icon' => 'bi-building', 'text' => 'Somos parte do Grupo Somapay, instituição regulamentada pelo Banco Central.'],
            ['icon' => 'bi-headset', 'text' => 'Time de suporte direto para gestão'],
            ['icon' => 'bi-shield-check', 'text' => 'Atuação em conformidade com as regras e exigências de cada convênio.'],
        ]
    ],
    'clt' => [
        'label' => 'CLT',
        'title' => 'Crédito pensado para o salário do CLT',
        'subtitle' => 'Dinheiro rápido para resolver o que importa',
        'cta_text' => 'Simular agora no WhatsApp',
        'cta_link' => '#',
        'items' => [
            ['icon' => 'bi-pie-chart', 'text' => 'Parcela que respeita seu salário'],
            ['icon' => 'bi-calendar-check', 'text' => 'Parcelas em até 48x'],
            ['icon' => 'bi-cash', 'text' => 'Dinheiro direto na sua conta por pix'],
            ['icon' => 'bi-clock-history', 'text' => 'Análise em 3 minutos'],
            ['icon' => 'bi-percent', 'text' => 'Taxas mais baixas do que crédito pessoal'],
            ['icon' => 'bi-phone', 'text' => 'Processo 100% digital'],
        ]
    ]
];
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
                    foreach ($solucoes_tabs as $key => $tab) : 
                        $active = ($count === 0) ? 'active' : '';
                    ?>
                        <button class="nav-link <?php echo $active; ?>" id="pills-<?php echo $key; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $key; ?>" type="button" role="tab" aria-controls="pills-<?php echo $key; ?>" aria-selected="<?php echo ($count === 0) ? 'true' : 'false'; ?>">
                            <?php echo $tab['label']; ?>
                        </button>
                    <?php 
                        $count++;
                    endforeach; 
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
                    foreach ($solucoes_tabs as $key => $tab) : 
                        $active = ($count === 0) ? 'show active' : '';
                    ?>
                        <div class="tab-pane fade <?php echo $active; ?>" id="pills-<?php echo $key; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $key; ?>-tab">
                            <div class="card-aba bg-white p-5 rounded-4 shadow-sm">
                                <span class="badge-aba mb-3"><?php echo $tab['label']; ?></span>
                                <strong class="mb-2"><?php echo $tab['title']; ?></strong>
                                <p class="text-muted mb-5"><?php echo $tab['subtitle']; ?></p>

                                <div class="row g-4 mb-5">
                                    <?php foreach ($tab['items'] as $item) : ?>
                                        <div class="col-md-6">
                                            <div class="item-beneficio">
                                                <div class="icon-box text-primary">
                                                    <!-- Usando icones do Bootstrap para exemplo, pode substituir por SVG/Img -->
                                                    <i class="bi <?php echo $item['icon']; ?> fs-4"></i> 
                                                </div>
                                                <div>
                                                    <p class="mb-0 fw-medium"><?php echo $item['text']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="text-center content-cta">
                                    <a href="<?php echo $tab['cta_link']; ?>" class="btn btn-primary btn-lg rounded-pill px-5 text-white fw-bold">
                                        <?php echo $tab['cta_text']; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php 
                        $count++;
                    endforeach; 
                    ?>
                </div>
            </div>
        </div>

    </div>
</section>
