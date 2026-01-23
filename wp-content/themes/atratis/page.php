<?php
/**
 * The template for displaying all pages
 */

get_header();

// Start the Loop.
while (have_posts()) :
    the_post();

    // --- Banner Setup ---
    // Background image handled via the_post_thumbnail in HTML

    
    // ACF Fields
    $banner_titulo = get_field('banner_titulo_html');
    // REMOVIDO: Fallback para título da página
    
    $banner_subtitulo = get_field('subtitulo_html');
    $banner_descricao = get_field('banner_descricao');
    $banner_mobile = get_field('imagem_banner_mobile');
    
    // Layout & Style
    $posicao_conteudo = get_field('posicao_descricao'); // 1: Left, 2: Right, 3: Center
    $classe_posicao = '';
    if ($posicao_conteudo == 2) $classe_posicao = 'content-right';
    if ($posicao_conteudo == 3) $classe_posicao = 'content-center';

    // Buttons Repeater
    $lista_botoes = get_field('lista_de_botoes');

    // Overlay (Optional - Using default if not customizable per page yet, or could add fields)
    // Assuming default dark overlay for readability
    $overlay_style = 'background-color: #000; opacity: 0.5;'; 
?>

    <!-- Page Banner Section (Reusing banner-section styles) -->
    <!-- Added 'page-banner' class for specific overrides if needed -->
    <section class="banner-section page-banner">
        <div class="banner-item">
            <?php  
            if (has_post_thumbnail()) {
                $desktop_thumb_id = get_post_thumbnail_id();
                
                if ($banner_mobile && isset($banner_mobile['url'])) {
                    echo '<picture>';
                    echo '<source media="(max-width: 991px)" srcset="' . esc_url($banner_mobile['url']) . '">';
                    echo wp_get_attachment_image($desktop_thumb_id, 'full', false, ['class' => 'banner-bg-img', 'loading' => 'eager', 'alt' => get_the_title()]);
                    echo '</picture>';
                } else {
                    the_post_thumbnail('full', ['class' => 'banner-bg-img', 'loading' => 'eager', 'alt' => get_the_title()]);
                }
            }
            ?>
            
            <div class="banner-overlay" style="<?php echo esc_attr($overlay_style); ?>"></div>

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="banner-content <?php echo esc_attr($classe_posicao); ?>">
                            
                            <?php if ($banner_subtitulo) : ?>
                                <h3 class="banner-subtitle"><?php echo wp_kses_post($banner_subtitulo); ?></h3>
                            <?php endif; ?>
                            
                            <?php if ($banner_titulo) : ?>
                                <h1 class="banner-title"><?php echo wp_kses_post($banner_titulo); ?></h1>
                            <?php endif; ?>

                            <?php if ($banner_descricao) : ?>
                                <div class="banner-description">
                                    <?php echo wp_kses_post($banner_descricao); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($lista_botoes) : ?>
                                <div class="banner-buttons mt-4">
                                    <?php foreach ($lista_botoes as $botao) : 
                                        $label = $botao['nome_btn'];
                                        $link = $botao['link_btn'];
                                        $nova_aba = $botao['nova_aba'];
                                        $target = $nova_aba ? '_blank' : '_self';
                                        
                                        if ($label && $link) :
                                    ?>
                                        <a href="<?php echo esc_url($link); ?>" class="btn-primary banner-btn me-2" target="<?php echo esc_attr($target); ?>">
                                            <?php echo esc_html($label); ?>
                                        </a>
                                    <?php 
                                        endif;
                                    endforeach; ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Page Content -->
    <div class="page-content py-5">
        <div class="container">
            <div class="content-wrapper">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

<?php 
endwhile;

// Include Blocks Template (Flexible Content)
// This enables "Seção Onde Estamos" and others to appear below content if configured
get_template_part('blocos');

get_footer();
