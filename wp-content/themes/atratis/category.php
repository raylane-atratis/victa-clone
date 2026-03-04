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
                                    <a href="<?php the_permalink(); ?>" class="card-blog__link" aria-label="Acessar o artigo: <?php echo esc_attr(get_the_title()); ?>">
                                        
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="card-blog__imagem-bg">
                                                <!-- Puxa a imagem original de forma cobridora -->
                                                <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                                            </div>
                                        <?php endif; ?>

                                        <!-- Gradiente de leiturabilidade -->
                                        <div class="card-blog__overlay"></div>

                                        <div class="card-blog__conteudo">
                                            <h3 class="card-blog__titulo"><?php the_title(); ?></h3>
                                            <div class="card-blog__resumo">
                                                <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                            </div>
                                            
                                            <span class="btn btn-saiba-mais">
                                                Saiba mais
                                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.85292 0H4.11754V1.37649H8.65033L0 10.0268L0.973179 11L9.62351 2.34967V6.88246H11V1.14708C11 0.514808 10.4857 0 9.85292 0Z" fill="white"/>
                                                </svg>
                                            </span>
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