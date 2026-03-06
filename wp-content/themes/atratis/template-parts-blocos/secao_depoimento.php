<?php
/**
 * Block: Seção Depoimento
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos Específicos
$imagem_mapa = get_sub_field('imagem_mapa');
$titulo_card = get_sub_field('titulo_card');
$imagem_card = get_sub_field('imagem_card'); // Imagem do Martelo

$depoimento = get_sub_field('depoimento');
$foto_autor = $depoimento['foto_autor'] ?? null;
$descricao  = $depoimento['descricao'] ?? '';
$cargo      = $depoimento['cargo'] ?? '';
$nome       = $depoimento['nome'] ?? '';

$classe_extra = get_sub_field('classe');

// Lógica de URL para Imagens
$img_mapa_url = is_array($imagem_mapa) && isset($imagem_mapa['url']) ? $imagem_mapa['url'] : (is_string($imagem_mapa) ? $imagem_mapa : '');
$img_mapa_alt = is_array($imagem_mapa) && isset($imagem_mapa['alt']) ? $imagem_mapa['alt'] : 'Mapa global';

$img_card_url = is_array($imagem_card) && isset($imagem_card['url']) ? $imagem_card['url'] : (is_string($imagem_card) ? $imagem_card : '');
$img_card_alt = is_array($imagem_card) && isset($imagem_card['alt']) ? $imagem_card['alt'] : 'Martelo de direito';

$foto_autor_url = is_array($foto_autor) && isset($foto_autor['url']) ? $foto_autor['url'] : (is_string($foto_autor) ? $foto_autor : '');
$foto_autor_alt = is_array($foto_autor) && isset($foto_autor['alt']) ? $foto_autor['alt'] : 'Autor do depoimento';

?>

<section class="secao-depoimento <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    
    <!-- MAIN CONTAINER -->
    <div class="container px-3 px-xl-5">
        <div class="row align-items-stretch justify-content-between g-4">
            
            <!-- COl 1: MAPA (Não sobreposto) -->
            <div class="col-lg-4 d-none d-lg-flex align-items-center">
                <div class="secao-depoimento__mapa-wrapper position-relative w-100 animate-on-scroll eff-fade-in">
                    <?php if ($img_mapa_url) : ?>
                        <img src="<?php echo esc_url($img_mapa_url); ?>" 
                             alt="<?php echo esc_attr($img_mapa_alt); ?>" 
                             loading="lazy" 
                             class="secao-depoimento__mapa-img img-fluid">
                    <?php endif; ?>
                </div>
            </div>

            <!-- COL 2: CARD 3 COLUNAS -->
            <div class="col-lg-8">
                <div class="secao-depoimento__card h-100">
                    
                    <!-- LADO 1: Título e Link (Cinza Claro) -->
                    <div class="secao-depoimento__card-col secao-depoimento__card-col--info animate-on-scroll eff-fade-up">
                        <div class="secao-depoimento__icon">
                            <svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.3445 2.47709L12.0353 0.0593056C11.796 -0.0197685 11.5373 -0.0197685 11.298 0.0593056L3.98884 2.47709C2.82672 2.86005 1.81582 3.59659 1.09975 4.58205C0.383686 5.56751 -0.00112195 6.75178 2.45714e-06 7.96659V13.889C2.45714e-06 22.6423 10.7333 27.4767 11.193 27.6781C11.3421 27.7438 11.5035 27.7778 11.6667 27.7778C11.8298 27.7778 11.9912 27.7438 12.1403 27.6781C12.6 27.4767 23.3333 22.6423 23.3333 13.889V7.96659C23.3345 6.75178 22.9496 5.56751 22.2336 4.58205C21.5175 3.59659 20.5066 2.86005 19.3445 2.47709ZM17.171 11.2466L12.187 16.191C11.983 16.3947 11.7403 16.5562 11.473 16.666C11.2056 16.7759 10.9189 16.832 10.6295 16.831H10.591C10.2957 16.8266 10.0044 16.7627 9.73469 16.6433C9.46498 16.524 9.22247 16.3516 9.02183 16.1366L6.3315 13.3589C6.21499 13.2516 6.12179 13.1219 6.05763 12.9776C5.99347 12.8334 5.95969 12.6777 5.95838 12.52C5.95707 12.3623 5.98824 12.206 6.04999 12.0608C6.11174 11.9155 6.20276 11.7842 6.31747 11.6751C6.43218 11.566 6.56815 11.4812 6.71706 11.4261C6.86596 11.371 7.02465 11.3466 7.18339 11.3545C7.34213 11.3624 7.49756 11.4024 7.64017 11.472C7.78277 11.5416 7.90953 11.6394 8.01267 11.7594L10.6307 14.4676L15.5167 9.60661C15.7367 9.39579 16.0314 9.27913 16.3373 9.28176C16.6432 9.2844 16.9358 9.40612 17.1521 9.62071C17.3684 9.8353 17.4911 10.1256 17.4938 10.4291C17.4964 10.7325 17.3789 11.0249 17.1663 11.2432L17.171 11.2466Z" fill="white"/>
                            </svg>
                        </div>
                        <?php if ($titulo_card) : ?>
                            <h2 class="secao-depoimento__card-titulo">
                                <?php echo wp_kses_post($titulo_card); ?>
                            </h2>
                        <?php endif; ?>
                        
                        <a href="<?php echo esc_url(home_url('/fale-conosco')); ?>" class="secao-depoimento__link-fale">
                            Fale conosco
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <!-- LADO 2: Imagem Martelo (Centro) -->
                    <div class="secao-depoimento__card-col secao-depoimento__card-col--image animate-on-scroll eff-scale-up delay-200">
                        <?php if ($img_card_url) : ?>
                            <img src="<?php echo esc_url($img_card_url); ?>" 
                                 alt="<?php echo esc_attr($img_card_alt); ?>" 
                                 loading="lazy" 
                                 class="secao-depoimento__martelo-img">
                        <?php endif; ?>
                    </div>

                    <!-- LADO 3: Citação e Autor (Azul Escuro) -->
                    <div class="secao-depoimento__card-col secao-depoimento__card-col--quote animate-on-scroll eff-fade-up delay-300">
                        <div class="secao-depoimento__citacao-wrapper">
                            <div class="secao-depoimento__autor-header">
                                <?php if ($foto_autor_url) : ?>
                                    <img src="<?php echo esc_url($foto_autor_url); ?>" 
                                         alt="<?php echo esc_attr($foto_autor_alt); ?>" 
                                         loading="lazy" 
                                         class="secao-depoimento__autor-foto">
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($descricao) : ?>
                                <div class="secao-depoimento__citacao">
                                    <?php echo esc_html($descricao); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="secao-depoimento__autor-info">
                                <?php if ($cargo) : ?>
                                    <span class="secao-depoimento__autor-cargo"><?php echo esc_html($cargo); ?></span>
                                <?php endif; ?>
                                <?php if ($nome) : ?>
                                    <span class="secao-depoimento__autor-nome"><?php echo esc_html($nome); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</section>
