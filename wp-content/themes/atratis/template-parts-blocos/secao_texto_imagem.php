<?php
/**
 * Block: Seção Texto e Imagem (Canivete Suíço)
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos Específicos
$titulo = get_sub_field('titulo');
$subtitulo = get_sub_field('subtitulo'); // Label/Tag acima do título
$texto = get_sub_field('texto');
$imagem = get_sub_field('imagem_secao');
$posicaoImagem = get_sub_field('posicao_imagem'); // 'esquerda' (padrão) ou 'direita'
$estiloVisual = get_sub_field('estilo_visual'); // 'default', 'shape_roxo', 'fundo_cinza'

// Botão (Grupo)
$btn = get_sub_field('botao'); 
$btnNome = $btn['texto'] ?? '';
$btnLink = $btn['link'] ?? '';

// Lógica de Classes
// Lógica de Classes
$rowClass = 'align-items-center'; // Padrão
$tamanhoColunas = get_sub_field('tamanho_colunas'); // Opções: '6_6', '5_7', '7_5', '4_8', '8_4'

// Definir colunas com base na escolha (Imagem _ Texto)
switch ($tamanhoColunas) {
    case '4_8': // Imagem menor, Texto maior
        $colImgClass = 'col-lg-4';
        $colTextClass = 'col-lg-8';
        break;
    case '5_7':
        $colImgClass = 'col-lg-5';
        $colTextClass = 'col-lg-7';
        break;
    case '7_5': // Imagem maior, Texto menor
        $colImgClass = 'col-lg-7';
        $colTextClass = 'col-lg-5';
        break;
    case '8_4':
        $colImgClass = 'col-lg-8';
        $colTextClass = 'col-lg-4';
        break;
    default: // '6_6' ou vazio
        $colImgClass = 'col-lg-6';
        $colTextClass = 'col-lg-6';
}

// Normalizar valor do campo (caso venha 'Direita' ou 'direita')
$posicao = strtolower((string)$posicaoImagem);

// Define classe base primeiro
$sectionClasses = 'secao-texto-imagem';

// Se imagem deve ficar na DIREITA
if ($posicao == 'direita') {
    $sectionClasses .= ' imagem-direita';
}

$class = get_sub_field('classe');

?>

<section class="<?php echo esc_attr($sectionClasses); ?> <?php echo esc_attr($class); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    
    <div class="container">
        <div class="row <?php echo esc_attr($rowClass); ?>">
            
            <!-- Coluna Imagem -->
            <div class="<?php echo esc_attr($colImgClass); ?> mb-4 mb-lg-0">
                <?php if ($imagem) : ?>
                    <div class="wrapper-imagem" data-aos="fade-up">
                        <img src="<?php echo esc_url($imagem['url']); ?>" alt="<?php echo esc_attr($imagem['alt']); ?>" class="img-fluid" loading="lazy">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Coluna Conteúdo -->
            <div class="<?php echo esc_attr($colTextClass); ?>" data-aos="fade-up" data-aos-delay="200">
                <div class="wrapper-conteudo">
                    
                    <?php if ($subtitulo) : ?>
                        <span class="subtitulo-tag"><?php echo esc_html($subtitulo); ?></span>
                    <?php endif; ?>

                    <?php if ($titulo) : ?>
                        <h2 class="titulo-bloco"><?php echo $titulo; ?></h2>
                    <?php endif; ?>

                    <?php if ($texto) : ?>
                        <div class="texto-editor mb-4">
                            <?php echo $texto; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($btnNome && $btnLink) : ?>
                        <a href="<?php echo esc_url($btnLink); ?>" class="btn-primary">
                            <?php echo esc_html($btnNome); ?>
                        </a>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</section>
