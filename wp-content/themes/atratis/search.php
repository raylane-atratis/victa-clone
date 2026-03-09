<?php
/**
 * O template estruturado para exibir resultados de busca.
 * Refatorado com base nas diretrizes do SKILL.md.
 */

get_header();

?>

<!-- Breadcrumbs usando a convenção de classes do tema novo -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php get_breadcrumb(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Header da Página -->
<div class="titulo-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><?php esc_html_e('Buscas', 'atratis'); ?></h1>
            </div>
        </div>
    </div>
</div>

<!-- Conteúdo Dinâmico -->
<div class="page-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            
            <!-- Centralizei ligeiramente a listagem para melhorar leitura em telas ultra-wide -->
            <div class="col-lg-8">
                <div class="search-results-container">
                    
                    <?php 
                    // Se estiver em branco
                    if (!get_search_query()) : ?>
                        <h2 class="search-results-container__title search-results-container__title--muted">
                            <?php esc_html_e('Você não digitou nada no campo de busca. Preencha o que procura ou navegue pelos nossos menus.', 'atratis'); ?>
                        </h2>
                    <?php else : ?>
                        <!-- Título dinâmico escapado visualizando o termo -->
                        <h2 class="search-results-container__title">
                            <?php 
                            /* translators: %s: termo da pesquisa */
                            printf(
                                esc_html__('Resultados da busca por: "%s"', 'atratis'),
                                '<span class="text-primary">' . esc_html(get_search_query()) . '</span>'
                            ); 
                            ?>
                        </h2>
                    <?php endif; ?>

                    <!-- LOOP DAS POSTAGENS -->
                    <?php if (have_posts() && get_search_query()) : ?>
                        <div class="search-results-container__list">
                            <?php while (have_posts()) : the_post(); ?>
                                
                                <article <?php post_class('search-item'); ?>>
                                    <!-- Escape e acessibilidade no link nativo -->
                                    <a href="<?php the_permalink(); ?>">
                                        <h3 class="search-item__title">
                                            <?php the_title(); ?>
                                        </h3>
                                        <div class="search-item__resume">
                                            <!-- Sub-strings limitadores de quebra e trim moderno -->
                                            <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                                        </div>
                                    </a>
                                </article>

                            <?php endwhile; ?>
                        </div>

                        <!-- Paginação Nativa e Segura -->
                        <div class="row mt-5">
                            <div class="col-12 content-paginacao">
                                <?php
                                the_posts_pagination(array(
                                    'mid_size'  => 2,
                                    'prev_text' => __('&laquo; Anterior', 'atratis'),
                                    'next_text' => __('Próximo &raquo;', 'atratis'),
                                ));
                                ?>
                            </div>
                        </div>

                    <?php else : ?>

                        <!-- Layout Alternativo para 0 Resultados (Apenas se a busca não for nula) -->
                        <?php if (get_search_query()) : ?>
                            <div class="alert alert-warning d-flex" role="alert">
                                <!-- Ícone de Warning Modernizado (SVG) sem FontAwesome -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-3 flex-shrink-0" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div>
                                    <?php 
                                    // Dinamicamente resgata a página de blog ao invés de hardcode ID 5
                                    $blog_page_id = get_option('page_for_posts');
                                    // Se o WordPress não tiver id marcado, força a home
                                    $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/');
                                    
                                    printf(
                                        wp_kses_post(__('Não há postagens relacionadas à sua busca por enquanto! Volte a navegar no nosso <a href="%s" class="alert-link font-weight-bold">blog principal</a>.', 'atratis')),
                                        esc_url($blog_url)
                                    ); 
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
