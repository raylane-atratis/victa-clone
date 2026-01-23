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

        elseif (get_row_layout() == 'secao_solucoes' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_solucoes');

        elseif (get_row_layout() == 'secao_onde_estamos' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_onde_estamos');

        elseif (get_row_layout() == 'secao_depoimentos' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_depoimentos');

        elseif (get_row_layout() == 'secao_video_full' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_video_full');

        elseif (get_row_layout() == 'secao_newsletter' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_newsletter');

        elseif (get_row_layout() == 'secao_texto' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_texto');

        elseif (get_row_layout() == 'secao_carrosel_logos' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_carrosel_logos');

        elseif (get_row_layout() == 'secao_carrosel_passo_a_passo' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_carrosel_passo_a_passo');

        elseif (get_row_layout() == 'secao_perguntas_frequentes' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_perguntas_frequentes');

        elseif (get_row_layout() == 'secao_facilidades_tafacil' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_facilidades_tafacil');

        elseif (get_row_layout() == 'secao_canais_de_atendimento' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_canais_de_atendimento');

        elseif (get_row_layout() == 'secao_nossos_parceiros' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_nossos_parceiros');

        elseif (get_row_layout() == 'secao_cards_flexiveis' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_cards_flexiveis');

        elseif (get_row_layout() == 'secao_clube_vantagens' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_clube_vantagens');

        endif;

    ?>
    <?php endwhile; ?>
<?php endif; // Fim Blocos de Layout 
?>
