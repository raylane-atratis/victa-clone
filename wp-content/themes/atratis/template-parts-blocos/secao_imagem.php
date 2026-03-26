<?php
/**
 * Bloco: Banner Principal LP
 */

include 'conf_gerais.php';

// Campos ACF
$imagem = get_sub_field('imagem');

?>

<section class="secao-imagem">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="<?php echo $imagem['url']; ?>" alt="<?php echo $imagem['alt']; ?>" class="img-fluid">
            </div>
        </div>
    </div>
</section>