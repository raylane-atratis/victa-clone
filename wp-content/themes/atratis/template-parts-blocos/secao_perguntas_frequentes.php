<?php
/**
 * Block: Seção Newsletter
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

$subtitulo = get_sub_field('subtitulo');
$perguntas_selecionadas = get_sub_field('selecionar_perguntas');

?>

<section class="faq-session">
  <div class="container">
      <div class="row">
          <div class="col-lg-5 col-md-6 col-sm-12">
              <div class="faq__header">
                  <h2>Perguntas Frequentes</h2>
                  <?php if ($subtitulo): ?>
                      <p><?php echo $subtitulo; ?></p>
                  <?php endif; ?>
              </div>
          </div>
          <div class="col-lg-7 col-md-6 col-sm-12">
              <div class="faq__wrapper">
                  <?php foreach ($perguntas_selecionadas as $post):
                      setup_postdata($post); ?>
                      <div class="faq__item">
                          <div class="faq__question">
                              <span class="titulo"><?php the_title(); ?></span>
                              <span class="seta">
                                  <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M1 8.5L8.5 1L16 8.5" stroke="#606060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  </svg>
                              </span>
                          </div>
                          <div class="resposta">
                              <div class="resposta__inner">
                                  <?php the_content(); ?>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>
      </div>
  </div>
</section>
<?php wp_reset_postdata(); ?>