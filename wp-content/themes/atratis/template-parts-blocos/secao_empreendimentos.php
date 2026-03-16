<?php
/**
 * Block: Seção Empreendimentos
 * Descrição: Grid de imóveis de alta performance com filtros no client-side (JSON API local).
 */

// Configurações Gerais (espaçamentos e backgrounds do ACF)
include 'conf_gerais.php';

// Campos Específicos do Bloco
$subtitulo = get_sub_field('empreendimentos_subtitulo') ?: 'IMÓVEIS';
$titulo = get_sub_field('empreendimentos_titulo') ?: 'Empreendimentos';

$classe_extra = get_sub_field('classe');

// Busca termos para preencher os selects dinamicamente
$estados = get_terms(array('taxonomy' => 'estado', 'hide_empty' => true));
$cidades = get_terms(array('taxonomy' => 'cidade', 'hide_empty' => true));
$bairros = get_terms(array('taxonomy' => 'bairro', 'hide_empty' => true));
$estagios = get_terms(array('taxonomy' => 'estagio_obra', 'hide_empty' => true));
?>

<section class="secao-empreendimentos <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container secao-empreendimentos__container">
        
        <header class="secao-empreendimentos__header">
            <?php if ($subtitulo): ?>
                <span class="secao-empreendimentos__subtitulo"><?php echo esc_html($subtitulo); ?></span>
            <?php
endif; ?>
            
            <?php if ($titulo): ?>
                <h2 class="secao-empreendimentos__titulo"><?php echo wp_kses_post($titulo); ?></h2>
            <?php
endif; ?>
        </header>

        <div class="secao-empreendimentos__filtros">
            <span class="secao-empreendimentos__filtros-label">Filtro:</span>
            
            <div class="secao-empreendimentos__filtros-grupo">
                
                <!-- Select: Estado -->
                <div class="custom-select-wrapper">
                    <select id="filtro-estado" class="custom-select" aria-label="Filtrar por Estado">
                        <option value="todos">Estado</option>
                        <?php foreach ($estados as $term): ?>
                            <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php
endforeach; ?>
                    </select>
                    <!-- Ícone Chevron nativo customizado no CSS -->
                </div>

                <!-- Select: Cidade -->
                <div class="custom-select-wrapper">
                    <select id="filtro-cidade" class="custom-select" aria-label="Filtrar por Cidade">
                        <option value="todos">Cidade</option>
                        <?php foreach ($cidades as $term): ?>
                            <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php
endforeach; ?>
                    </select>
                </div>

                <!-- Select: Bairro -->
                <div class="custom-select-wrapper">
                    <select id="filtro-bairro" class="custom-select" aria-label="Filtrar por Bairro">
                        <option value="todos">Bairro</option>
                        <?php foreach ($bairros as $term): ?>
                            <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php
endforeach; ?>
                    </select>
                </div>

                <!-- Select: Estágio da Obra -->
                <div class="custom-select-wrapper">
                    <select id="filtro-estagio" class="custom-select" aria-label="Filtrar por Estágio da obra">
                        <option value="todos">Estágio da obra</option>
                        <?php foreach ($estagios as $term): ?>
                            <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php
endforeach; ?>
                    </select>
                </div>

                <button id="btn-filtrar" class="btn">Filtrar</button>

            </div>
        </div>

        <!-- Grid Container (Populada via JS) -->
        <div class="secao-empreendimentos__swiper-container position-relative">
            <div class="swiper swiper-empreendimentos">
                <div id="grid-imoveis" class="swiper-wrapper secao-empreendimentos__grid">
                    <!-- Cards gerados pelo `empreendimentos.js` entram aqui (como .swiper-slide) -->
                    
                    <!-- Skeleton/Loading state inicial (opcional) -->
                    <div class="swiper-slide secao-empreendimentos__loading">
                        <p>Carregando empreendimentos...</p>
                    </div>
                </div>
            </div>

            <!-- Navegação / Dots -->
            <div class="swiper-pagination swiper-empreendimentos-pagination mt-4"></div>

            <!-- Botões de Navegação -->
            <div class="swiper-button-prev secao-empreendimentos__nav secao-empreendimentos__nav--prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="28" viewBox="0 0 15 28" fill="none" style="transform: scaleX(-1);">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4273 15.5127C14.794 15.1183 15 14.5835 15 14.0258C15 13.4682 14.794 12.9334 14.4273 12.539L3.36277 0.642037C3.18234 0.441174 2.96652 0.280959 2.72789 0.17074C2.48926 0.0605213 2.23261 0.00250594 1.9729 7.94035e-05C1.7132 -0.00234713 1.45565 0.0508642 1.21527 0.156607C0.974899 0.262351 0.756516 0.418509 0.572871 0.61597C0.389226 0.813431 0.243994 1.04824 0.145649 1.3067C0.0473042 1.56515 -0.00218296 1.84208 7.34329e-05 2.12132C0.00233078 2.40057 0.0562868 2.67653 0.158793 2.93311C0.261301 3.18969 0.410306 3.42175 0.597115 3.61575L10.2789 14.0258L0.597115 24.4359C0.24083 24.8326 0.0436859 25.3638 0.0481424 25.9152C0.052599 26.4666 0.258299 26.9941 0.62094 27.384C0.983582 27.774 1.47415 27.9951 1.98698 27.9999C2.49981 28.0047 2.99388 27.7927 3.36277 27.4097L14.4273 15.5127Z" fill="#00512A"/>
                </svg>
            </div>
            <div class="swiper-button-next secao-empreendimentos__nav secao-empreendimentos__nav--next">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="28" viewBox="0 0 15 28" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4273 15.5127C14.794 15.1183 15 14.5835 15 14.0258C15 13.4682 14.794 12.9334 14.4273 12.539L3.36277 0.642037C3.18234 0.441174 2.96652 0.280959 2.72789 0.17074C2.48926 0.0605213 2.23261 0.00250594 1.9729 7.94035e-05C1.7132 -0.00234713 1.45565 0.0508642 1.21527 0.156607C0.974899 0.262351 0.756516 0.418509 0.572871 0.61597C0.389226 0.813431 0.243994 1.04824 0.145649 1.3067C0.0473042 1.56515 -0.00218296 1.84208 7.34329e-05 2.12132C0.00233078 2.40057 0.0562868 2.67653 0.158793 2.93311C0.261301 3.18969 0.410306 3.42175 0.597115 3.61575L10.2789 14.0258L0.597115 24.4359C0.24083 24.8326 0.0436859 25.3638 0.0481424 25.9152C0.052599 26.4666 0.258299 26.9941 0.62094 27.384C0.983582 27.774 1.47415 27.9951 1.98698 27.9999C2.49981 28.0047 2.99388 27.7927 3.36277 27.4097L14.4273 15.5127Z" fill="#00512A"/>
                </svg>
            </div>
        </div>

    </div>
</section>
