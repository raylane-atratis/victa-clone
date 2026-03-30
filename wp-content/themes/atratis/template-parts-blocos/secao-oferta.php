<?php
/**
 * Bloco: Oferta e Crédito
 */
include 'conf_gerais.php';

// CORREÇÃO: Verifica se $block existe (Gutenberg), senão gera um ID único
$id = 'secao-oferta-' . (isset($block['id']) ? $block['id'] : uniqid());
if (isset($block['anchor']) && !empty($block['anchor'])) {
    $id = $block['anchor'];
}

// CORREÇÃO: Verifica a classe customizada do bloco
$classe_projeto = 'secao-oferta';
if (isset($block['className']) && !empty($block['className'])) {
    $classe_projeto .= ' ' . $block['className'];
}

/**
 * IMPORTANTE: Se você estiver usando Layout Flexível (Flexible Content),
 * use get_sub_field. Se for Bloco fixo, use get_field.
 * Vou usar get_sub_field pois seu log indica um loop de blocos.
 */
$subtitulo = get_sub_field('subtitulo_oferta');
$titulo    = get_sub_field('titulo_oferta');
$valor_ap  = get_sub_field('valor_apartamento');
$renda     = get_sub_field('renda_familiar');
$texto_btn = get_sub_field('texto_botao') ?: 'Faça sua análise de crédito';
$link_btn  = get_sub_field('link_botao');

// SVGs Padrões (Fallbacks)
$svg_area_default = '<svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30 11.6458V14.5651L15 23.5783L0 14.5651V11.6458L15 20.659L30 11.6458ZM0 17.0675V19.9868L15 29L30 19.9868V17.0675L15 26.0807L0 17.0675ZM15 17.9413L0.07 8.97065L15 0L29.93 8.97065L15 17.9413ZM15 15.022L18.8475 12.7099L15.0538 10.4303L11.2063 12.7412L15 15.022ZM25.07 8.97065L21.2762 6.69106L17.4825 8.97065L21.2762 11.2502L25.07 8.97065ZM15 2.91928L11.2063 5.19887L15.0538 7.50976L18.8475 5.23016L15 2.91928ZM4.93 8.97065L8.77625 11.2815L12.6237 8.97065L8.77625 6.65976L4.93 8.97065Z" fill="#42CE02"/></svg>';

$svg_data_default = '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.75 2.5H22.5V1.25C22.5 0.56 21.9412 0 21.25 0C20.5588 0 20 0.56 20 1.25V2.5H10V1.25C10 0.56 9.44125 0 8.75 0C8.05875 0 7.5 0.56 7.5 1.25V2.5H6.25C2.80375 2.5 0 5.30375 0 8.75V23.75C0 27.1963 2.80375 30 6.25 30H23.75C27.1963 30 30 27.1963 30 23.75V8.75C30 5.30375 27.1963 2.5 23.75 2.5ZM6.25 5H23.75C25.8175 5 27.5 6.6825 27.5 8.75V10H2.5V8.75C2.5 6.6825 4.1825 5 6.25 5ZM23.75 27.5H6.25C4.1825 27.5 2.5 25.8175 2.5 23.75V12.5H27.5V23.75C27.5 25.8175 25.8175 27.5 23.75 27.5ZM23.75 17.5C23.75 18.19 23.1912 18.75 22.5 18.75H7.5C6.80875 18.75 6.25 18.19 6.25 17.5C6.25 16.81 6.80875 16.25 7.5 16.25H22.5C23.1912 16.25 23.75 16.81 23.75 17.5ZM15 22.5C15 23.19 14.4412 23.75 13.75 23.75H7.5C6.80875 23.75 6.25 23.19 6.25 22.5C6.25 21.81 6.80875 21.25 7.5 21.25H13.75C14.4412 21.25 15 21.81 15 22.5Z" fill="#42CE02"/></svg>';
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classe_projeto); ?>" style="<?php echo isset($geraisCSS) ? $geraisCSS : ''; ?>">
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
                            $tipo = get_sub_field('tipo_item'); 
                            $custom_svg = get_sub_field('svg_custom');
                            $item_titulo = get_sub_field('titulo');
                            $item_desc = get_sub_field('descricao');

                            if ($custom_svg) {
                                $display_svg = $custom_svg;
                            } else {
                                $display_svg = ($tipo == 'area') ? $svg_area_default : $svg_data_default;
                            }
                        ?>
                            <div class="secao-oferta__item">
    <div class="secao-oferta__icon-box">
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

                    <a href="<?php echo esc_url($link_btn); ?>" class="offer-card__btn" target="_blank">
                        <?php echo esc_html($texto_btn); ?>
                        <svg width="28" height="14" viewBox="0 0 28 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4784 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4784 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28905 26.9763 4.66511Z" fill="#00512A"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>