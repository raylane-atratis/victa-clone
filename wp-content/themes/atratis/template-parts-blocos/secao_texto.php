<?php
/**
 * Block: Seção Texto e Imagem
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos Específicos
$titulo = get_sub_field('titulo');
$texto = get_sub_field('texto');

?>

<section class="secao-texto" style="<?php echo esc_attr($geraisCSS); ?>">
   <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="titulo-secao"><?php echo $titulo; ?></h1>
        <div class="texto-editor"><?php echo $texto; ?></div>
      </div>
    </div>
   </div>
</section>
