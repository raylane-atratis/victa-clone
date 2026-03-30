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

        elseif (get_row_layout() == 'secao_blog' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_blog');

        elseif (get_row_layout() == 'secao_condicoes_especiais' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_condicoes_especiais');

        elseif (get_row_layout() == 'secao_imagem_lista' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_imagem_lista');

        elseif (get_row_layout() == 'secao_quem_somos' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_quem_somos');

        elseif (get_row_layout() == 'secao_empreendimentos' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_empreendimentos');

        elseif (get_row_layout() == 'banner' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/banner');

        elseif (get_row_layout() == 'secao_imagem' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_imagem');

        elseif (get_row_layout() == 'secao-proposito' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao-proposito');

        elseif (get_row_layout() == 'secao_conquistas' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_conquistas');

        elseif (get_row_layout() == 'secao_video_total' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_video_total');

        elseif (get_row_layout() == 'secao_timeline' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_timeline');

        elseif (get_row_layout() == 'secao_linhas_de_produtos' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_linhas_de_produtos');

        elseif (get_row_layout() == 'secao_certificados' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_certificados');

        elseif (get_row_layout() == 'secao_ods' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_ods');

        elseif (get_row_layout() == 'secao_pilares_esg' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_pilares_esg');

        elseif (get_row_layout() == 'secao-oferta' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao-oferta');

        elseif (get_row_layout() == 'secao_diferenciais' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao_diferenciais');

        elseif (get_row_layout() == 'secao-video-medio' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao-video-medio');

        elseif (get_row_layout() == 'secao-localizacao' && get_sub_field('exibir')):
            get_template_part('template-parts-blocos/secao-localizacao');

        endif;
?>

    <?php
    endwhile; ?>
<?php
endif; // Fim Blocos de Layout 
?>
