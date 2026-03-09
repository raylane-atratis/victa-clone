<?php // Chamadas dos blocos 
?>

<?php
if (is_front_page()): // Se for chamado pela HOME ou INTERNA 
    $lugar = "option";
else:
    $lugar = "";
endif;
?>

<?php if (have_rows('campos_flexiveis', $lugar)): ?>
    <?php while (have_rows('campos_flexiveis', $lugar)):
        the_row(); ?>
        <?php

        if (get_row_layout() == 'secao_texto_imagem' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_texto_imagem');

        elseif (get_row_layout() == 'secao_texto' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_texto');

        elseif (get_row_layout() == 'secao_perguntas_frequentes' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_perguntas_frequentes');

        elseif (get_row_layout() == 'secao_fale_conosco' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_fale_conosco');

        elseif (get_row_layout() == 'secao_formulario_contato' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_formulario_contato');

        elseif (get_row_layout() == 'secao_perguntas_frequentes' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_perguntas_frequentes');

        elseif (get_row_layout() == 'secao_sobre' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_sobre');

        elseif (get_row_layout() == 'secao_depoimento' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_depoimento');

        endif;

    ?>
    <?php endwhile; ?>
<?php endif; // Fim Blocos de Layout 
?>
