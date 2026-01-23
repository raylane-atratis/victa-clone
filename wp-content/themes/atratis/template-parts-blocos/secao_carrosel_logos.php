<?php
/**
 * Block: Seção Carrossel de Logos
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos do Bloco (Topo)
$titulo = get_sub_field('titulo');
$descricao = get_sub_field('texto');

/* Repetidor */
$logos = get_sub_field('repetidor_logos');

?>

<section class="secao-carrosel-logos" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="titulo-secao"><?php echo $titulo; ?></h2>
                <div class="texto-editor"><?php echo $descricao; ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="swiper swiper-logos">
                    <div class="swiper-wrapper">
                        <?php 
                        if ($logos) :
                            foreach ($logos as $logo_item) :
                                // Extrair dados da imagem do subcampo 'imagem_logo'
                                $img_array = $logo_item['imagem_logo']; 
                                
                                $img_url = '';
                                $img_alt = '';

                                if ($img_array && isset($img_array['url'])) {
                                     $img_url = $img_array['url'];
                                     $img_alt = $img_array['alt'];
                                }

                                if ($img_url) :
                        ?>
                            <div class="swiper-slide banner-item-logo">
                                <div class="logo-wrapper">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" loading="lazy" width="150" height="auto">
                                </div>
                            </div>
                        <?php 
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </div>
                    
                    <!-- Paginação (Dots) -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>