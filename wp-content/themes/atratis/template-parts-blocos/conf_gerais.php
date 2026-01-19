<!-- Arquivo de configurações gerais dos blocos ACF -->

<?php // [EXTRA] OPÇÕES GERAIS

// [ESPAÇAMENTOS]
$margintop = get_sub_field('margin-top');
$marginbottom = get_sub_field('margin-bottom');
$paddingtop = get_sub_field('padding-top');
$paddingbottom = get_sub_field('padding-bottom');

if($margintop): $margintop = "margin-top: " . $margintop . "px;"; else: $margintop = ""; endif;
if($marginbottom): $marginbottom = "margin-bottom: " . $marginbottom . "px;"; else: $marginbottom = ""; endif;
if($paddingtop): $paddingtop = "padding-top: " . $paddingtop . "px;"; else: $paddingtop = ""; endif;
if($paddingbottom): $paddingbottom = "padding-bottom: " . $paddingbottom . "px;"; else: $paddingbottom = ""; endif;

// [BACKGROUND]
$escolhaBG = get_sub_field('escolha_background');
$corBG = get_sub_field('cor_bg');
$imagemBG = get_sub_field('imagem_bg');

if ($escolhaBG == 0 && $corBG):
    $BG = "background-color: " . $corBG . ";";
elseif ($escolhaBG == 1 && $imagemBG):
    $BG = "background-image:url('" . $imagemBG . "'); background-repeat: no-repeat; background-size: cover; background-position: center;";
else:
    $BG = "";
endif;

// [COR FONTE]
$corFonte = get_sub_field('cor_fonte');
if ($corFonte) :
    $corFonte = "color: " . $corFonte . ";";
else :
    $corFonte = "";
endif; 
    
                    
$geraisCSS = $corFonte . $margintop . $marginbottom . $paddingtop . $paddingbottom . $BG;

// [UTILIZAR VARIÁVEIS]
// Variáveis: $geraisCSS, $corFonte

?>