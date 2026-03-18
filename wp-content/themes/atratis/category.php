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

<div class="page-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                $args_destaques = array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => 'destaques', // Slug da categoria filha
                            // Opcional: Garante que só pegue os posts dessa categoria exata, e não das "netas"
                            'include_children' => false
                        )
                    )
                );
                $query_destaques = new WP_Query($args_destaques);

                if ($query_destaques->have_posts()):
                    ?>
                            <div class="destaques-carousel">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <?php
                                        while ($query_destaques->have_posts()):
                                            $query_destaques->the_post();
                                            ?>
                                                    <div class="swiper-slide">
                                                        <?php get_template_part('template-parts/content-card-destaque'); ?>
                                                    </div>
                                                <?php
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                    </div>
                                </div>
                                <!-- Navigation -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        <?php
                endif; ?>
            </div>
        </div>

        <div class="row">
            
            <!-- Coluna Principal: Listagem dos Posts -->
            <div class="col-lg-8">
                <?php if (have_posts()): ?>
                            <div class="row">
                                <?php while (have_posts()):
                                    the_post(); ?>
                                            <div class="col-md-6 mb-4">
                                                <?php get_template_part('template-parts/content-card-blog'); ?>
                                            </div>
                                        <?php
                                endwhile; ?>
                            </div>

                            <!-- Paginação (Usando função nativa e mais segura do WP 4.1+) -->
                            <div class="row mt-4">
                                <div class="col-12 content-paginacao">
                                    <?php
                                    the_posts_pagination(array(
                                        'mid_size' => 2,
                                        'prev_text' => __('&laquo; Anterior', 'textdomain'),
                                        'next_text' => __('Próximo &raquo;', 'textdomain'),
                                    ));
                                    ?>
                                </div>
                            </div>

                        <?php
                else: ?>
                            <div class="alert alert-warning" role="alert">
                                Ainda não há postagens vinculadas a esta categoria.
                            </div>
                        <?php
                endif; ?>
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