<?php
/**
 * Template Name: Empreendimentos Archive
 * Template Post Type: empreendimentos
 */
get_header();

// Valores customizados para a listagem principal
$subtitulo = 'IMÓVEIS';
$titulo    = 'Nossos Empreendimentos';

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

<main id="main-content" role="main">
    <?php
    // Usamos a mesma estrutura do bloco ACf, mas passando variáveis contextuais
    set_query_var('is_archive_view', true);
    get_template_part('template-parts-blocos/secao_empreendimentos');
    ?>
</main>

<?php get_footer(); ?>