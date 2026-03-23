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
                <h1><?php echo post_type_archive_title( '', false ); ?></h1>
            </div>
        </div>
    </div>
</div>


<section class="secao-materiais-gratuitos secao-materiais-gratuitos__archive">
    <div class="container secao-materiais-gratuitos__container">
        <div class="row">
            <div class="col-lg-8">
                <?php if (have_posts()): ?>
                  <div class="row">
                    <?php while (have_posts()): the_post(); ?>
                      <div class="col-md-6">
                        <?php get_template_part('template-parts/content-card-materiais-gratuitos'); ?>
                      </div>
                    <?php endwhile; ?>
                  </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <?php get_sidebar('materiais-gratuitos'); ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>