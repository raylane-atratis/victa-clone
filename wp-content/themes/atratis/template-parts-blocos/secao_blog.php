<?php
/**
 * Bloco: Seção Blog
 * Descrição: Seção com título centralizado e grid de últimos posts do blog.
 *            Usa o componente reutilizável content-card-blog.php.
 */

// Configurações Gerais (espaçamentos e backgrounds do ACF)
include 'conf_gerais.php';

// Campos Específicos do Bloco
$subtitulo = get_sub_field('subtitulo');
$titulo = get_sub_field('titulo');
$link = get_sub_field('link');

$classe_extra = get_sub_field('classe');


// Query dinâmica dos últimos posts
$args = [
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
];

$blog_query = new WP_Query($args);
?>

<section class="secao-blog <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">

        <?php if ($subtitulo || $titulo): ?>
                <div class="secao-blog__header">
                    <?php if ($subtitulo): ?>
                            <span class="secao-blog__subtitulo"><?php echo esc_html($subtitulo); ?></span>
                    <?php endif; ?>

                    <?php if ($titulo): ?>
                            <h2 class="secao-blog__titulo"><?php echo wp_kses_post($titulo); ?></h2>
                    <?php endif; ?>
                </div>
        <?php endif; ?>

        <?php if ($blog_query->have_posts()): ?>
                <div class="row secao-blog__grid">
                    <?php while ($blog_query->have_posts()):
                        $blog_query->the_post(); ?>
                            <div class="col-lg-4 col-md-6">
                                <?php get_template_part('template-parts/content-card-blog'); ?>
                            </div>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <?php
        // Usa link do ACF se houver, ou a página da categoria "conteudo" / fallback
        $cat_conteudo = get_category_by_slug('blog');
        $url_todas = $link ? $link['url'] : ($cat_conteudo ? get_category_link($cat_conteudo->term_id) : home_url('/conteudo/'));
        $titulo_todas = $link ? $link['title'] : 'Ver todas as novidades';
        $target_todas = ($link && !empty($link['target'])) ? 'target="_blank" rel="noopener noreferrer"' : '';
        ?>
        <div class="secao-blog__cta">
            <a href="<?php echo esc_url($url_todas); ?>"
               class="btn btn--outline"
               <?php echo $target_todas; ?>>
                <?php echo esc_html($titulo_todas); ?>
                <svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4784 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4784 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28905 26.9763 4.66511Z" fill="#00512A"/>
                </svg>
            </a>
        </div>

    </div>
</section>
