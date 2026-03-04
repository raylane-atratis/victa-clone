<?php
/**
 * Block: Seção Perguntas Frequentes
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

$titulo = get_sub_field('titulo');
$perguntas_selecionadas = get_sub_field('lista_de_perguntas_e_respostas');

?>

<section class="secao-faq <?php echo esc_attr($classe); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-12">
              
              <?php if ($titulo) : ?>
                  <div class="faq__header">
                      <h2><?php echo esc_html($titulo); ?></h2>
                  </div>
              <?php endif; ?>
              
              <?php if ($perguntas_selecionadas) : ?>
                  <div class="faq__wrapper">
                      <?php foreach ($perguntas_selecionadas as $item) : 
                          $pergunta = $item['pergunta'];
                          $resposta = $item['resposta'];
                      ?>
                          <div class="faq__item">
                              <button class="faq__question" type="button" aria-expanded="false">
                                  <span class="faq__question-text"><?php echo esc_html($pergunta); ?></span>
                                  <div class="faq__question-action">
                                      <span class="faq__question-label"></span>
                                      <span class="faq__question-icon" aria-hidden="true"></span>
                                  </div>
                              </button>
                              <div class="resposta" aria-hidden="true">
                                  <div class="resposta__inner">
                                      <?php echo wp_kses_post($resposta); ?>
                                  </div>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  </div>
              <?php endif; ?>

          </div>
      </div>
  </div>
</section>