<?php
/**
 * Componente: Card Materiais Gratuitos
 * Descrição: Card reutilizável de post do materiais gratuitos com imagem, badge de categoria,
 *            data, título e botão CTA. Usado na seção materiais gratuitos (ACF) e archive-materiais-gratuitos.php.
 *
 * Requer estar dentro de um loop WP (the_post() já chamado).
 */

$post_id = get_the_ID();
$categories = get_the_category();
$cat_name = !empty($categories) ? $categories[0]->name : '';
$title = get_the_title();
$post_slug = $post->post_name;
$permalink = get_field('link_do_botao', $post_id);
$date = get_the_date('d, F, Y');
$thumb_id = get_post_thumbnail_id($post_id);
?>

<article <?php post_class('card-material'); ?>>
    <a href="<?php echo esc_url($permalink); ?>" class="card-material__link" aria-label="<?php echo esc_attr(sprintf('Ver material: %s', $title)); ?>" target="_blank">

        <div class="card-material__imagem">
            <?php if ($cat_name): ?>
                    <span class="card-material__categoria"><?php echo esc_html($cat_name); ?></span>
            <?php endif; ?>

            <?php if ($thumb_id): ?>
                    <?php echo wp_get_attachment_image($thumb_id, 'medium_large', false, [
                        'class' => 'card-material__img',
                        'loading' => 'lazy',
                    ]); ?>
            <?php endif; ?>
        </div>

        <strong class="card-material__titulo"><?php echo esc_html($title); ?></strong>

        <?php if (has_excerpt() && !is_front_page()): ?>
                <div class="card-material__descricao">
                    <?php echo wp_kses_post(get_the_excerpt()); ?>
                </div>
        <?php endif; ?>

        <span class="btn card-material__btn">
            <?php echo get_field('texto_do_botao', $post_id); ?>
            <svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4784 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4784 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28905 26.9763 4.66511Z" fill="#00512A"/>
            </svg>
        </span>

    </a>
</article>
