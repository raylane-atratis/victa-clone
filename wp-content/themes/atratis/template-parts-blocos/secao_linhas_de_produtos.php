<?php
/**
 * Bloco: Linhas de Produtos
 */
include 'conf_gerais.php';

$id_sessao_prod = (isset($id_sessao) && !empty($id_sessao)) ? $id_sessao : 'produtos-' . uniqid();
$titulo         = get_sub_field('titulo_secao');
$descricao      = get_sub_field('descricao_secao');
$linhas         = get_sub_field('linhas_repetidor');
$classe         = get_sub_field('classe');

// Lógica para mostrar controles apenas se houver mais de 3 itens
$total_itens = is_array($linhas) ? count($linhas) : 0;
$mostrar_controles = ($total_itens > 3);
?>

<section class="linhas-produtos <?php echo esc_attr($classe); ?>" 
         id="<?php echo esc_attr($id_sessao_prod); ?>" 
         style="<?php echo $geraisCSS; ?>">
    
    <div class="container">
        <div class="linhas-produtos__header text-center mb-5">
            <?php if ($titulo) : ?>
                <h2 class="linhas-produtos__titulo"><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
            <?php if ($descricao) : ?>
                <div class="linhas-produtos__desc mx-auto">
                    <?php echo wp_kses_post($descricao); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($linhas) : ?>
            <div class="linhas-produtos__slider-wrapper position-relative">
                <div class="swiper js-swiper-produtos">
                    <div class="swiper-wrapper">
                        <?php foreach ($linhas as $item) : 
                            $img   = $item['imagem'];
                            $nome  = $item['titulo_linha'];
                            $faixa = $item['badge'];
                            $txt   = $item['descricao'];
                        ?>
                            <div class="swiper-slide">
                                <div class="linhas-produtos__card">
                                    <div class="linhas-produtos__img-box">
                                        <?php if ($img) : ?>
                                            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($nome); ?>">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="linhas-produtos__content mt-4">
                                        <h3 class="linhas-produtos__card-title h5 fw-bold mb-2">
                                            <?php echo esc_html($nome); ?>
                                        </h3>
                                        
                                        <?php if ($faixa) : ?>
                                            <span class="linhas-produtos__badge mb-3">
                                                <?php echo esc_html($faixa); ?>
                                            </span>
                                        <?php endif; ?>

                                        <div class="linhas-produtos__card-text mt-2">
                                            <?php echo wp_kses_post($txt); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($mostrar_controles) : ?>
                    <div class="produtos-pagination swiper-pagination"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>