<?php
/**
 * The template for displaying all pages
 */

get_header();

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

<?php
// ==========================================
// Configurações da Query Customizada
// Aqui você pode alterar a ordem, limites, etc.
// ==========================================
$args = array(
    'post_type'      => 'areas-de-atuacao',
    'posts_per_page' => 12,       // Ajuste a quantidade aqui (-1 para mostrar todos)
    'orderby'        => 'date',   // Ordenação: 'title', 'date', 'menu_order', 'rand'...
    'order'          => 'DESC',   // 'ASC' para crescente ou 'DESC' para decrescente
);

$query_areas = new WP_Query($args);
?>

<div class="page-content py-5">
    <div class="container">
        <div class="row">
            
            <?php if ($query_areas->have_posts()) : ?>
                <?php while ($query_areas->have_posts()) : $query_areas->the_post(); ?>
                    
                    <div class="col-lg-6 col-md-6 mb-4">
                        <!-- Componente: Card Atuacao (Lincado ao seu _cards_atuacoes.scss) -->
                        <a href="<?php the_permalink(); ?>" class="card-atuacao" aria-label="Acessar conteúdo de <?php echo esc_attr(get_the_title()); ?>">
                            
                            <div class="card-atuacao__imagem-bg" aria-hidden="true">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', ['loading' => 'lazy', 'alt' => ""]); ?>
                                <?php endif; ?>
                                <div class="card-atuacao__overlay"></div>
                            </div>

                            <div class="card-atuacao__conteudo">
                                <h3 class="card-atuacao__titulo">
                                    <?php the_title(); ?>
                                </h3>
                                
                                <div class="card-atuacao__resumo">
                                    <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?>
                                </div>
                            </div>

                        </a>
                    </div>

                <?php endwhile; ?>
                <?php wp_reset_postdata(); // Restaura dados globais da página principal ?>
                
            <?php else : ?>
                
                <div class="col-12 text-center">
                    <p>Nenhuma área de atuação encontrada no momento.</p>
                </div>
                
            <?php endif; ?>

        </div>
    </div>
</div>

<?php
get_footer();
