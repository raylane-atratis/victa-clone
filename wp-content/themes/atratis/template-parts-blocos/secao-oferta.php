<?php
/**
 * Bloco: Oferta e Crédito
 */
include 'conf_gerais.php';

$id = 'secao-oferta-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$classe_projeto = 'secao-oferta';
if (!empty($block['className'])) {
    $classe_projeto .= ' ' . $block['className'];
}

// Campos ACF
$subtitulo = get_field('subtitulo_oferta');
$titulo    = get_field('titulo_oferta');
$valor_ap  = get_field('valor_apartamento');
$renda     = get_field('renda_familiar');
$texto_btn = get_field('texto_botao') ?: 'Faça sua análise de crédito';
$link_btn  = get_field('link_botao');

// SVGs Padrões (Fallbacks)
$svg_area_default = '<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="52" height="52" rx="4" fill="#F0F5CD"/><path d="M41 23.6458V26.5651L26 35.5783L11 26.5651V23.6458L26 32.659L41 23.6458ZM11 29.0675V31.9868L26 41L41 31.9868V29.0675L26 38.0807L11 29.0675ZM26 29.9413L11.07 20.9706L26 12L40.93 20.9706L26 29.9413ZM26 27.022L29.8475 24.7099L26.0538 22.4303L22.2063 24.7412L26 27.022ZM36.07 20.9706L32.2762 18.6911L28.4825 20.9706L32.2762 23.2502L36.07 20.9706ZM26 14.9193L22.2063 17.1989L26.0538 19.5098L29.8475 17.2302L26 14.9193ZM15.93 20.9706L19.7762 23.2815L23.6237 20.9706L19.7762 18.6598L15.93 20.9706Z" fill="#42CE02"/></svg>';

$svg_data_default = '<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="52" height="52" rx="4" fill="#F0F5CD"/><g transform="translate(11, 11)"><path d="M23.75 2.5H22.5V1.25C22.5 0.56 21.9412 0 21.25 0C20.5588 0 20 0.56 20 1.25V2.5H10V1.25C10 0.56 9.44125 0 8.75 0C8.05875 0 7.5 0.56 7.5 1.25V2.5H6.25C2.80375 2.5 0 5.30375 0 8.75V23.75C0 27.1963 2.80375 30 6.25 30H23.75C27.1963 30 30 27.1963 30 23.75V8.75C30 5.30375 27.1963 2.5 23.75 2.5ZM6.25 5H23.75C25.8175 5 27.5 6.6825 27.5 8.75V10H2.5V8.75C2.5 6.6825 4.1825 5 6.25 5ZM23.75 27.5H6.25C4.1825 27.5 2.5 25.8175 2.5 23.75V12.5H27.5V23.75C27.5 25.8175 25.8175 27.5 23.75 27.5ZM23.75 17.5C23.75 18.19 23.1912 18.75 22.5 18.75H7.5C6.80875 18.75 6.25 18.19 6.25 17.5C6.25 16.81 6.80875 16.25 7.5 16.25H22.5C23.1912 16.25 23.75 16.81 23.75 17.5ZM15 22.5C15 23.19 14.4412 23.75 13.75 23.75H7.5C6.80875 23.75 6.25 23.19 6.25 22.5C6.25 21.81 6.80875 21.25 7.5 21.25H13.75C14.4412 21.25 15 21.81 15 22.5Z" fill="#42CE02"/></g></svg>';
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classe_projeto); ?>" style="<?php echo $geraisCSS; ?>">
    <div class="container">
        <div class="secao-oferta__grid">
            
            <div class="secao-oferta__content">
                <?php if($subtitulo): ?>
                    <span class="secao-oferta__subtitle"><?php echo esc_html($subtitulo); ?></span>
                <?php endif; ?>

                <?php if($titulo): ?>
                    <h2 class="secao-oferta__title"><?php echo wp_kses_post($titulo); ?></h2>
                <?php endif; ?>

                <div class="secao-oferta__features">
                    <?php if (have_rows('caracteristicas')) : ?>
                        <?php while (have_rows('caracteristicas')) : the_row(); 
                            $tipo = get_sub_field('tipo_item'); // Select: 'area' ou 'data'
                            $custom_svg = get_sub_field('svg_custom');
                            $item_titulo = get_sub_field('titulo');
                            $item_desc = get_sub_field('descricao');

                            // Lógica da Condicional de SVG
                            if ($custom_svg) {
                                $display_svg = $custom_svg;
                            } else {
                                $display_svg = ($tipo == 'area') ? $svg_area_default : $svg_data_default;
                            }
                        ?>
                            <div class="secao-oferta__item">
                                <div class="secao-oferta__icon">
                                    <?php echo $display_svg; ?>
                                </div>
                                <div class="secao-oferta__text">
                                    <h4><?php echo esc_html($item_titulo); ?></h4>
                                    <p><?php echo esc_html($item_desc); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="secao-oferta__card-area">
                <div class="offer-card">
                    <div class="offer-card__group">
                        <p>Apartamentos a partir de:</p>
                        <h3 class="price-main"><?php echo esc_html($valor_ap); ?>*</h3>
                    </div>

                    <div class="offer-card__divider"></div>

                    <div class="offer-card__group">
                        <p>Renda familiar</p>
                        <h3 class="price-sub"><?php echo esc_html($renda); ?>*</h3>
                    </div>

                    <a href="<?php echo esc_url($link_btn); ?>" class="offer-card__btn">
                        <?php echo esc_html($texto_btn); ?>
                        <svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4784 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4784 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28905 26.9763 4.66511Z" fill="#00512A"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>