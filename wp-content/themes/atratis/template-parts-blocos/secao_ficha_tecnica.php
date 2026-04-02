<?php
include 'conf_gerais.php';

$subtitulo    = get_sub_field('subtitulo'); // "FICHA TÉCNICA"
$titulo       = get_sub_field('titulo');    // "Dados do Empreendimento"
$card_titulo  = get_sub_field('card_titulo'); // "Exibir ficha técnica completa"
?>

<section class="ficha-tecnica" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="ficha-tecnica__header-section">
            <?php if ($subtitulo): ?>
                <span class="ficha-tecnica__sub"><?php echo esc_html($subtitulo); ?></span>
            <?php endif; ?>
            <?php if ($titulo): ?>
                <h2 class="ficha-tecnica__title"><?php echo esc_html($titulo); ?></h2>
            <?php endif; ?>
        </div>

        <div class="ficha-tecnica__card js-ficha-toggle">
            <div class="ficha-tecnica__card-header">
                <h3 class="ficha-tecnica__card-title"
                    data-text-closed="<?php echo esc_attr($card_titulo); ?>"
                    data-text-open="Fechar ficha técnica">
                    <?php echo esc_html($card_titulo); ?>
                </h3>
                <div class="ficha-tecnica__icon">
                    <svg width="20" height="12" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0L12 15L24 0H0Z" fill="#00512A" />
                    </svg>
                </div>
            </div>

            <div class="ficha-tecnica__content">
                <div class="ficha-tecnica__inner">
                    <hr class="ficha-tecnica__divider">
                    <div class="ficha-tecnica__grid">
                        <?php if (have_rows('ficha_colunas')) : ?>
                            <?php while (have_rows('ficha_colunas')) : the_row(); ?>
                                <div class="ficha-tecnica__col">
                                    <h4 class="ficha-tecnica__col-title"><?php the_sub_field('titulo_coluna'); ?></h4>

                                    <?php if (have_rows('conteudo_coluna')) : ?>
                                        <?php while (have_rows('conteudo_coluna')) : the_row(); ?>
                                            <div class="ficha-tecnica__item">
                                                <?php if ($label = get_sub_field('item_subtitulo')): ?>
                                                    <h5 class="ficha-tecnica__item-label"><?php echo esc_html($label); ?></h5>
                                                <?php endif; ?>
                                                <div class="ficha-tecnica__list">
                                                    <?php
                                                    $texto_lista = get_sub_field('item_lista');
                                                    if ($texto_lista) :
                                                        // Transforma quebras de linha em itens de array e remove espaços vazios
                                                        $linhas = explode("\n", str_replace("\r", "", strip_tags($texto_lista, '<a><strong><b>')));
                                                        echo '<ul>';
                                                        foreach ($linhas as $linha) {
                                                            if (trim($linha) != '') {
                                                                echo '<li>' . trim($linha) . '</li>';
                                                            }
                                                        }
                                                        echo '</ul>';
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>