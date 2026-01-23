<?php
/**
 * Block: Seção Carrosel Passo a Passo (Sincronizado)
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos do Bloco
$titulo = get_sub_field('titulo');
$descricao = get_sub_field('descricao'); // Campo padrão de descrição
$passos = get_sub_field('passos'); // Repetidor
$botao_cta = get_sub_field('botao_cta'); // Campo de link para o botão CTA

$total_passos = $passos ? count($passos) : 0;

?>

<section class="secao-passo-a-passo" style="<?php echo esc_attr($geraisCSS); ?>" data-total-passos="<?php echo $total_passos; ?>">
    <div class="container">

        <?php if($passos): ?>
        <div class="row align-items-center">
            
            <!-- Coluna Imagem (Esquerda) -->
            <div class="col-lg-5 mb-5 mb-lg-0 relative-holder">

                <div class="swiper swiper-passo-img">
                    <div class="swiper-wrapper">
                        <?php foreach($passos as $passo): 
                            $img = $passo['imagem'];
                            if($img):
                        ?>
                        <div class="swiper-slide">
                            <div class="img-frame">
                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="img-fluid" loading="lazy">
                            </div>
                        </div>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Coluna Texto (Direita) -->
            <div class="col-lg-6 offset-lg-1" style="margin-top: auto; margin-bottom: auto;"> 

                <!-- Cabeçalho da Seção -->
                <?php if($titulo || $descricao): ?>
                <div class="cabecalho-passo-a-passo">
                    <?php if ($titulo) : ?>
                        <h2 class="titulo-secao"><?php echo $titulo; ?></h2>
                    <?php endif; ?>
                    <?php if ($descricao) : ?>
                        <div class="texto-desc"><?php echo $descricao; ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="swiper swiper-passo-txt">
                    <div class="swiper-wrapper">

                        <?php 
                        $i = 1;
                        foreach($passos as $passo): 
                            $titulo_passo = $passo['titulo'];
                            $texto_passo = $passo['texto'];
                        ?>
                        <div class="swiper-slide">
                            <div class="passo-content">
                                <!-- Número do Passo -->
                                <div class="passo-num-col">
                                    <div class="passo-num">
                                        <span><?php echo $i; ?></span>
                                    </div>
                                </div>
                                
                                <!-- Texto do Passo -->
                                <div class="passo-texto-col">
                                    <h3 class="passo-titulo"><?php echo $passo['titulo']; ?></h3>
                                    <div class="passo-texto">
                                        <?php echo $passo['texto']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $i++;
                        endforeach; 
                        ?>
                    </div>

                    <!-- Navegação -->
                    <div class="passo-nav mt-4">
                        <div class="swiper-button-prev-custom">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="11.5" stroke="#E0E0E0"/>
                                <path d="M14 8L10 12L14 16" stroke="#BDBDBD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="swiper-button-next-custom">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="19.5" stroke="#5B2580"/>
                                <path d="M18 14L24 20L18 26" stroke="#5B2580" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        
                        <?php 
                        $texto_botao = $botao_cta['texto_do_botao'] ?? '';
                        $link_botao = $botao_cta['link_do_botao'] ?? '';
                        if($texto_botao && $link_botao): 
                        ?>
                        <a href="<?php echo esc_url($link_botao); ?>" 
                           class="btn-cta-passo">
                            <?php echo esc_html($texto_botao); ?>
                        </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

        </div>
        <?php endif; ?>

    </div>
</section>
