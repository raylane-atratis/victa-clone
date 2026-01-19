<?php
/**
 * Block: Seção Newsletter
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// 2. Campos do Bloco (Topo)
$titulo = get_sub_field('titulo_newsletter');
$descricao = get_sub_field('descricao_newsletter');
$shortcode = get_sub_field('shortcode_newsletter');
?>

<section class="secao-newsletter" style="<?php echo esc_attr($geraisCSS); ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-5">
        <div class="header-newsletter">
          <div class="text">
            <h2><?php echo $titulo; ?></h2>
            <p><?php echo $descricao; ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-2 placeholder-separator" ></div>
      <div class="col-lg-5">
        <?php echo do_shortcode($shortcode); ?>
      </div>
    </div>
  </div>
</section>