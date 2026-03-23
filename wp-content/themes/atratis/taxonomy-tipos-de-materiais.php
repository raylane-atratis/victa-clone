<?php
/**
 * Taxonomia: Tipos de Materiais
 * Descrição: Listagem de materiais gratuitos filtrados por termo da taxonomia.
 */
get_header();

$current_term = get_queried_object();
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
                <h1><?php echo esc_html($current_term->name); ?></h1>
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