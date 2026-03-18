<?php
/**
 * Template part for displaying a featured post card in the carousel
 */

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
if (!$thumbnail_url) {
    // Fallback if no image is present, perhaps a default image from theme
    $thumbnail_url = get_template_directory_uri() . '/src/images/default-thumbnail.jpg'; // just a placeholder
}

$categories = get_the_category();
$categoria_nome = '';
if (!empty($categories)) {
    // Return the first category that is not "destaques" if we want to show the real category, 
    // or just the primary one.
    foreach ($categories as $cat) {
        if ($cat->slug !== 'destaques') {
            $categoria_nome = $cat->name;
            break;
        }
    }
    // Fallback if it only has "destaques"
    if (empty($categoria_nome)) {
        $categoria_nome = $categories[0]->name;
    }
}
?>

<a href="<?php the_permalink(); ?>" class="card-destaque">
    <div class="card-destaque__imagem">
        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="card-destaque__img" loading="lazy">
        <div class="card-destaque__overlay"></div>
    </div>
    
    <div class="card-destaque__content">
        <?php if ($categoria_nome) : ?>
            <span class="card-destaque__categoria">
                <?php echo esc_html($categoria_nome); ?>
            </span>
        <?php endif; ?>

        <div class="card-destaque__text-wrap">
            <h2 class="card-destaque__titulo">
                <?php the_title(); ?>
            </h2>
            
            <div class="card-destaque__meta">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    Publicado em <?php echo esc_html(get_the_date('d \d\e F \d\e Y')); ?>
                </time>
            </div>
        </div>
    </div>
</a>
