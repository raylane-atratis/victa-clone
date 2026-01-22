<?php
/**
 * Block: Seção Onde Estamos
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos do ACF
$titulo = get_sub_field('titulo') ?: 'Onde estamos?';
$texto = get_sub_field('texto') ?: 'Hoje, a Tafácil Consignados já impacta mais de 10 milhões de servidores públicos em todo o país.<br><br>Seguimos crescendo com responsabilidade: são mais 50 convênios ativos funcionando no dia a dia.<br><br>Não é só expansão, é presença construída com confiança, processo bem-feito e um produto que realmente facilita a vida de quem usa.';

// Imagens Mockadas (caminho relativo ao tema)
/* $theme_url = get_template_directory_uri();
$img_municipal = $theme_url . '/public/images/regioes-brasil-_1_.webp';
$img_estadual = $theme_url . '/public/images/regioes-brasil-2-_1_.webp';
 */
// Processar Cidades (Repeater -> Array Simples)
$img_municipal = get_sub_field('img_municipal');
$img_estadual = get_sub_field('img_estadual');

$cidades_repeater = get_sub_field('lista_cidades');
$cidades_data = [];
if ($cidades_repeater) {
    foreach ($cidades_repeater as $item) {
        if (!empty($item['cidade_nome'])) {
            $cidades_data[] = $item['cidade_nome'];
        }
    }
}

// Processar Estados (Repeater -> Array Simples)
$estados_repeater = get_sub_field('lista_estados');
$estados_data = [];
if ($estados_repeater) {
    foreach ($estados_repeater as $item) {
        if (!empty($item['estado_nome'])) {
            $estados_data[] = $item['estado_nome'];
        }
    }
}
?>

<section class="secao-onde-estamos" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="row align-items-center">
            <!-- Coluna Texto -->
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="secao-onde-estamos__content">
                    <?php if ($titulo) : ?>
                        <h2 class="secao-onde-estamos__titulo"><?php echo esc_html($titulo); ?></h2>
                    <?php endif; ?>
                    
                    <div class="secao-onde-estamos__texto">
                        <?php echo wp_kses_post($texto); ?>
                    </div>
                </div>
            </div>

            <!-- Coluna Mapa + Tabs -->
            <div class="col-lg-6 offset-lg-1">
                <div class="secao-onde-estamos__map-container">
                    
                    <!-- Navegação das Tabs -->
                    <div class="map-tabs">
                        <button class="map-tab-btn active" data-target="#map-municipal">
                            Servidor Municipal
                        </button>
                        <button class="map-tab-btn" data-target="#map-estadual">
                            Servidor Estadual
                        </button>
                    </div>

                    <!-- Conteúdo das Tabs -->
                    <div class="map-content-wrapper">
                        
                        <!-- Tab 1: Municipal -->
                        <div id="map-municipal" class="map-pane active">
                            <div class="map-image-wrapper">
                                <img src="<?php echo esc_url($img_municipal['url']); ?>" alt="Mapa Servidor Municipal" class="img-fluid" width="600" height="500" loading="lazy" decoding="async">
                            </div>
                            
                            <div class="map-search mt-4">
                                <div class="input-group">
                                    <span class="input-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#888888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21 21L16.65 16.65" stroke="#888888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <div class="input-wrapper">
                                        <input type="text" class="form-control" id="busca-cidade" autocomplete="off" placeholder="Buscar minha cidade">
                                        <label class="input-label" for="busca-cidade">Buscar minha cidade</label>
                                    </div>
                                    <div class="search-results custom-scrollbar" id="results-cidade" data-items='<?php echo json_encode($cidades_data); ?>'></div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Estadual -->
                        <div id="map-estadual" class="map-pane">
                            <div class="map-image-wrapper">
                                <img src="<?php echo esc_url($img_estadual['url']); ?>" alt="Mapa Servidor Estadual" class="img-fluid" width="600" height="500" loading="lazy" decoding="async">
                            </div>
                            
                            <div class="map-search mt-4">
                                <div class="input-group">
                                    <span class="input-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#888888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21 21L16.65 16.65" stroke="#888888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <div class="input-wrapper">
                                        <input type="text" class="form-control" id="busca-estado" autocomplete="off" placeholder="Buscar meu estado">
                                        <label class="input-label" for="busca-estado">Buscar meu estado</label>
                                    </div>
                                    <div class="search-results custom-scrollbar" id="results-estado" data-items='<?php echo json_encode($estados_data); ?>'></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sugestão (Hidden by default) -->
    <div id="modal-sugestao" class="modal-overlay">
        <div class="modal-content-wrapper">
            <button class="modal-close" aria-label="Fechar Modal">&times;</button>
            
            <!-- Bitrix Form Container -->
            <div id="bitrix-form-container">
                <!-- Script will be injected here via JS -->
                 <div class="loading-spinner">Carregando formulário...</div>
            </div>
        </div>
    </div>
</section>