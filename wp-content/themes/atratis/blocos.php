<?php // Chamadas dos blocos 
?>

<?php
if (is_front_page()): // Se for chamado pela HOME ou INTERNA 
    $lugar = "option";
else:
    $lugar = "";
endif;
?>

<?php if (have_rows('blocos_home', $lugar)): ?>
    <?php while (have_rows('blocos_home', $lugar)):
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

        endif;

    ?>
    <?php endwhile; ?>
<?php endif; // Fim Blocos de Layout 
?>
