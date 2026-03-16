<?php
/**
 * Archive: Empreendimentos
 * Descrição: Listagem de imóveis em grid 3 colunas com filtros client-side e paginação.
 *            Reutiliza o mesmo JSON (imoveisData) e cards da seção ACF.
 */
get_header();

// Busca termos para preencher os selects dinamicamente
$estados = get_terms(array('taxonomy' => 'estado', 'hide_empty' => true));
$cidades = get_terms(array('taxonomy' => 'cidade', 'hide_empty' => true));
$bairros = get_terms(array('taxonomy' => 'bairro', 'hide_empty' => true));
$estagios = get_terms(array('taxonomy' => 'estagio_obra', 'hide_empty' => true));
?>

<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php get_breadcrumb(); ?>
            </div>
        </div>
    </div>
</div>

<div class="titulo-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Imóveis</h1>
            </div>
        </div>
    </div>
</div>


    <section class="secao-empreendimentos secao-empreendimentos--archive">
        <div class="container secao-empreendimentos__container">

            <!-- Filtros (idênticos à seção) -->
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

            <!-- Grid de Cards (sem Swiper — populada via JS) -->
            <div id="grid-imoveis" class="secao-empreendimentos__grid-archive">
                <!-- Cards gerados pelo empreendimentos.js entram aqui (sem .swiper-slide) -->
                <div class="secao-empreendimentos__loading">
                    <p>Carregando empreendimentos...</p>
                </div>
            </div>

            <!-- Paginação JS -->
            <nav class="secao-empreendimentos__paginacao" id="paginacao-empreendimentos" aria-label="Paginação de empreendimentos"></nav>

        </div>
    </section>


<?php get_footer(); ?>