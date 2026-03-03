<?php
/**
 * The template for Blogs
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
                <h1><?php single_cat_title(); ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="page-content py-5">
    <div class="container">
        <div class="row">
            
            <!-- Coluna Principal: Listagem dos Posts -->
            <div class="col-lg-8">
                <?php if (have_posts()) : ?>
                    <div class="row">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="col-md-6 mb-4">
                                <!-- Adaptei os nomes das classes para o padrão do tema novo, mantendo a estrutura base -->
                                <article <?php post_class('card-blog'); ?>>
                                    <a href="<?php the_permalink(); ?>" class="card-blog__link text-decoration-none text-dark">
                                        
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="card-blog__imagem mb-3">
                                                <!-- Usando 'medium_large' para performance e tag lazy -->
                                                <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="img-fluid rounded" loading="lazy" style="width: 100%; height: 200px; object-fit: cover;">
                                            </div>
                                        <?php endif; ?>

                                        <div class="card-blog__conteudo">
                                            <h3 class="card-blog__titulo fs-5 fw-bold mb-2"><?php the_title(); ?></h3>
                                            <div class="card-blog__resumo text-muted mb-2">
                                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                            </div>
                                            <small class="card-blog__ler-mais text-primary fw-bold">
                                                Saiba mais
                                            </small>
                                        </div>
                                    </a>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Paginação (Usando função nativa e mais segura do WP 4.1+) -->
                    <div class="row mt-4">
                        <div class="col-12 content-paginacao">
                            <?php
                            the_posts_pagination(array(
                                'mid_size'  => 2,
                                'prev_text' => __('&laquo; Anterior', 'textdomain'),
                                'next_text' => __('Próximo &raquo;', 'textdomain'),
                            ));
                            ?>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        Ainda não há postagens vinculadas a esta categoria.
                    </div>
                <?php endif; ?>
            </div>

            <!-- Coluna Lateral: Sidebar -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <aside class="sidebar-wrapper">
                    <?php get_sidebar(); ?>
                </aside>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>