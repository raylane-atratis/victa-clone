<?php
/**
 * Bloco: Seção Imagem + Lista
 * Descrição: Seção com imagem principal (com selo opcional) na esquerda e conteúdo textual com lista grid na direita.
 */

// Configurações Gerais (espaçamentos e backgrounds do ACF)
include 'conf_gerais.php';

// Campos Específicos do Bloco
$subtitulo  = get_sub_field('subtitulo');
$titulo     = get_sub_field('titulo');
$lista      = get_sub_field('lista_de_condicoes');
$btn        = get_sub_field('btn_condicao_especial');
$imagem     = get_sub_field('imagem');
$selo       = get_sub_field('selo_imagem');

$classe_extra = get_sub_field('classe');
?>

<section class="secao-imagem-lista <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="row align-items-center">

            <!-- Coluna Esquerda: Imagem -->
            <div class="col-lg-6">
                <div class="secao-imagem-lista__visual">
                    <?php if ($imagem && isset($imagem['ID'])) : ?>
                        <div class="secao-imagem-lista__imagem-principal">
                            <?php echo wp_get_attachment_image($imagem['ID'], 'large', false, [
                                'class'   => 'img-fluid',
                                'loading' => 'lazy'
                            ]); ?>
                        </div>
                    <?php elseif ($imagem) : ?>
                        <div class="secao-imagem-lista__imagem-principal">
                            <img src="<?php echo esc_url(is_array($imagem) ? $imagem['url'] : $imagem); ?>"
                                 alt="Imagem Principal"
                                 class="img-fluid"
                                 loading="lazy">
                        </div>
                    <?php endif; ?>

                    <?php if ($selo && isset($selo['ID'])) : ?>
                        <div class="secao-imagem-lista__selo">
                            <?php echo wp_get_attachment_image($selo['ID'], 'medium', false, [
                                'class'   => 'img-fluid',
                                'loading' => 'lazy'
                            ]); ?>
                        </div>
                    <?php elseif ($selo) : ?>
                        <div class="secao-imagem-lista__selo">
                            <img src="<?php echo esc_url(is_array($selo) ? $selo['url'] : $selo); ?>"
                                 alt="Selo da Imagem"
                                 class="img-fluid"
                                 loading="lazy">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Coluna Direita: Conteúdo + Lista + CTA -->
            <div class="col-lg-6">
                <div class="secao-imagem-lista__content">
                    <?php if ($subtitulo) : ?>
                        <span class="secao-imagem-lista__subtitulo"><?php echo esc_html($subtitulo); ?></span>
                    <?php endif; ?>

                    <?php if ($titulo) : ?>
                        <h2 class="secao-imagem-lista__titulo"><?php echo wp_kses_post($titulo); ?></h2>
                    <?php endif; ?>

                    <?php if ($lista) : ?>
                        <ul class="secao-imagem-lista__grid">
                            <?php foreach ($lista as $item) : ?>
                                <li class="secao-imagem-lista__item">
                                    <?php if (!empty($item['svg'])) : ?>
                                        <div class="secao-imagem-lista__icone" aria-hidden="true">
                                            <?php echo $item['svg']; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($item['titulo'])) : ?>
                                        <div class="secao-imagem-lista__item-texto">
                                            <?php echo wp_kses_post($item['titulo']); ?>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php 
                    if ($btn) : 
                        $btn_url   = is_array($btn) && !empty($btn['link']) ? $btn['link'] : (is_string($btn) ? $btn : '#');
                        $btn_title = is_array($btn) && !empty($btn['texto']) ? $btn['texto'] : 'Faça sua análise de crédito';
                        $btn_target = is_array($btn) && !empty($btn['target']) ? 'target="_blank" rel="noopener noreferrer"' : '';
                    ?>
                        <div class="secao-imagem-lista__cta">
                            <a href="<?php echo esc_url($btn_url); ?>"
                               class="btn secao-imagem-lista__btn"
                               <?php echo $btn_target; ?>>
                                <?php echo esc_html($btn_title); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" viewBox="0 0 28 14" fill="none" aria-hidden="true">
                                    <path d="M26.9763 4.66511L22.4608 0.328102C22.3523 0.224138 22.2233 0.141619 22.0811 0.0853057C21.9389 0.0289925 21.7864 0 21.6324 0C21.4784 0 21.3258 0.0289925 21.1837 0.0853057C21.0415 0.141619 20.9124 0.224138 20.804 0.328102C20.5866 0.535927 20.4647 0.817058 20.4647 1.1101C20.4647 1.40313 20.5866 1.68426 20.804 1.89209L24.9577 5.87415H1.1668C0.857342 5.87415 0.560563 5.99101 0.341746 6.19903C0.12293 6.40705 0 6.68918 0 6.98336C0 7.27754 0.12293 7.55967 0.341746 7.76769C0.560563 7.97571 0.857342 8.09257 1.1668 8.09257H25.0278L20.804 12.0968C20.6946 12.1999 20.6078 12.3226 20.5486 12.4578C20.4893 12.5929 20.4588 12.7379 20.4588 12.8844C20.4588 13.0308 20.4893 13.1758 20.5486 13.3109C20.6078 13.4461 20.6946 13.5688 20.804 13.6719C20.9124 13.7759 21.0415 13.8584 21.1837 13.9147C21.3258 13.971 21.4784 14 21.6324 14C21.7864 14 21.9389 13.971 22.0811 13.9147C22.2233 13.8584 22.3523 13.7759 22.4608 13.6719L26.9763 9.36816C27.6318 8.74423 28 7.89846 28 7.01664C28 6.13481 27.6318 5.28905 26.9763 4.66511Z" fill="#00512A"/>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
