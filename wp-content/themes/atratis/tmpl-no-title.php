<?php
/*
Template Name: Página sem Título
*/

get_header();

?>

<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php get_breadcrumb(); ?>
            </div>
        </div>
    </div>
</div>




<?php

// Start the Loop.
while (have_posts()) :
    the_post();
?>
    <!-- Main Page Content -->
    <?php if ( trim( get_the_content() ) ) : ?>
        <div class="page-content py-5">
            <div class="container">
                <div class="content-wrapper">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php 
endwhile;

// Include Blocks Template (Flexible Content)
// This enables "Seção Onde Estamos" and others to appear below content if configured
get_template_part('blocos');

if ( is_page('quem-somos-2') || is_page('esg') ) : 
    get_template_part('template-parts/share'); 
endif; 

get_footer();
