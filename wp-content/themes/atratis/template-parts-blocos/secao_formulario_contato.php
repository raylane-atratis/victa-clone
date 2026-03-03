<?php
/**
 * Template Part: Seção Formulário de Contato
 * Contexto: Flexible blocks runner
 */

// 1. Configurações Gerais (caso tenha no seu tema, como foi visto antes)

include 'conf_gerais.php';


// 2. Campos Específicos do Bloco
$titulo    = get_sub_field('titulo');
$descricao = get_sub_field('descricao');
$shortcode = get_sub_field('shortcode');

// 3. Campos Globais de Contato (Seguindo o SKILL.md: opt_contato_*)
$lista_contatos = get_field('lista_contatos', 'option');
$telefone_texto = $lista_contatos[0]['titulo'];
$telefone_link = $lista_contatos[0]['link'];

$endereco = get_field('enderecos', 'option');

if (empty($titulo) && empty($shortcode)) {
    return;
}
?>

<section class="secao-formulario-contato <?php echo esc_attr($classe); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Coluna Esquerda: Textos e Infos -->
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="secao-formulario-contato__conteudo">
                    
                    <?php if ($titulo) : ?>
                        <h2 class="secao-formulario-contato__titulo">
                            <?php echo wp_kses_post($titulo); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($descricao) : ?>
                        <div class="secao-formulario-contato__descricao">
                            <?php echo wp_kses_post($descricao); ?>
                        </div>
                    <?php endif; ?>

                    <div class="secao-formulario-contato__infos">
                        
                        <?php if ($telefone_texto) : 
                            // Usa o link limpo do ACF caso exista, se não, faz fallback extraindo digitos do título
                            $tel_href = $telefone_link ? $telefone_link : 'tel:' . preg_replace('/[^0-9]/', '', $telefone_texto);
                        ?>
                            <div class="info-item">
                                <div class="info-item__icone" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="27" viewBox="0 0 18 27" fill="none">
                                        <path d="M13.05 0L12.2557 1.58976C12.0656 1.97171 11.6753 2.21282 11.2489 2.21282H6.74887C6.3225 2.21282 5.93325 1.97171 5.742 1.58976L4.95 0C2.16562 0.334627 0 2.71532 0 5.59289V21.3666C0 24.4728 2.52338 27 5.625 27H12.375C15.4766 27 18 24.4728 18 21.3666V5.59289C18 2.71532 15.8344 0.335754 13.05 0ZM10.125 23.6199H7.875C7.254 23.6199 6.75 23.1152 6.75 22.4932C6.75 21.8713 7.254 21.3666 7.875 21.3666H10.125C10.746 21.3666 11.25 21.8713 11.25 22.4932C11.25 23.1152 10.746 23.6199 10.125 23.6199Z" fill="#157FFF"/>
                                    </svg>
                                </div>
                                <a href="<?php echo esc_url($tel_href); ?>" class="info-item__texto" aria-label="Ligar para <?php echo esc_attr($telefone_texto); ?>">
                                    <?php echo wp_kses_post($telefone_texto); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($endereco) : ?>
                            <div class="info-item">
                                <div class="info-item__icone" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <path d="M18.949 2.04983C17.626 0.728 15.8678 0 14 0C12.1322 0 10.3717 0.728 9.051 2.04983C7.728 3.37167 7 5.12983 7 7C7 8.87017 7.728 10.6283 9.065 11.963L14 16.7907L18.949 11.9502C20.272 10.6283 21 8.87017 21 7C21 5.12983 20.272 3.37167 18.949 2.04983ZM14 9.33333C12.7108 9.33333 11.6667 8.28917 11.6667 7C11.6667 5.71083 12.7108 4.66667 14 4.66667C15.2892 4.66667 16.3333 5.71083 16.3333 7C16.3333 8.28917 15.2892 9.33333 14 9.33333ZM28 18.3178V19.6L14 28L0 19.6V18.3178L7.57633 13.7713L10.1628 16.3018L5.73417 18.9583L13.9988 23.9167L22.2635 18.9583L17.8348 16.3018L20.4213 13.7725L27.9977 18.3178H28Z" fill="#157FFF"/>
                                    </svg>
                                </div>
                                <span class="info-item__texto">
                                    <?php echo wp_kses_post($endereco); ?>
                                </span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- Coluna Direita: Formulário -->
            <div class="col-lg-7">
                <div class="secao-formulario-contato__form-wrapper">
                    <?php 
                    if ($shortcode) {
                        echo do_shortcode($shortcode);
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>
