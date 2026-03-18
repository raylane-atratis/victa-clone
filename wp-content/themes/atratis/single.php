<?php
/**
 * The template for displaying all pages
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
while (have_posts()):
    the_post();
    ?>
                    <!-- Main Page Content -->
                    <div class="page-content py-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="content-wrapper">
                                        <div class="content-wrapper__header">
                                            <h1 class="content-wrapper__title"><?php the_title(); ?></h1>
                                            <div class="content-wrapper__description">
                                                <?php the_excerpt(); ?>
                                            </div>
                                            <div class="content-wrapper__meta">

                                                <div class="content-wrapper__author">
                                                    <span class="content-wrapper__author-name">Por: <strong><?php the_author(); ?></strong></span>
                                                </div>

                                                <div class="content-wrapper__time">
                                                    <span class="content-wrapper__time-icon">
                                                        <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.8132 2C13.7878 1.99389 15.7243 2.50678 17.3999 3.47973C19.0754 4.45267 20.4222 5.84616 21.2852 7.5C19.5132 10.87 15.8941 13 11.8132 13C7.73226 13 4.11313 10.87 2.34116 7.5C3.20418 5.84616 4.5509 4.45267 6.22649 3.47973C7.90207 2.50678 9.83851 1.99389 11.8132 2ZM11.8132 0C6.44355 0 1.85789 3.11 0 7.5C1.85789 11.89 6.44355 15 11.8132 15C17.1828 15 21.7685 11.89 23.6263 7.5C21.7685 3.11 17.1828 0 11.8132 0ZM11.8132 5C12.5252 5 13.2081 5.26339 13.7116 5.73223C14.2151 6.20107 14.498 6.83696 14.498 7.5C14.498 8.16304 14.2151 8.79893 13.7116 9.26777C13.2081 9.73661 12.5252 10 11.8132 10C11.1011 10 10.4182 9.73661 9.91472 9.26777C9.41122 8.79893 9.12836 8.16304 9.12836 7.5C9.12836 6.83696 9.41122 6.20107 9.91472 5.73223C10.4182 5.26339 11.1011 5 11.8132 5ZM11.8132 3C9.14984 3 6.98051 5.02 6.98051 7.5C6.98051 9.98 9.14984 12 11.8132 12C14.4765 12 16.6458 9.98 16.6458 7.5C16.6458 5.02 14.4765 3 11.8132 3Z" fill="#42CE02"/>
                                                        </svg>  
                                                    </span>
                                                    <!-- Tempo de leitura -->
                                                    <?php
                                                    $content = get_the_content();
                                                    $word_count = str_word_count(strip_tags($content));
                                                    $reading_time = ceil($word_count / 200);
                                                    echo '<strong>' . $reading_time . ' min</strong> de leitura';
                                                    ?>
                                                </div>

                                                <div class="content-wrapper__date">
                                                    <span class="content-wrapper__date-icon">
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17.1828 2H16.1089V0H13.961V2H5.36962V0H3.22177V2H2.14785C0.955793 2 0.0107392 2.9 0.0107392 4L0 18C0 18.5304 0.226291 19.0391 0.62909 19.4142C1.03189 19.7893 1.5782 20 2.14785 20H17.1828C18.3641 20 19.3306 19.1 19.3306 18V4C19.3306 2.9 18.3641 2 17.1828 2ZM17.1828 18H2.14785V8H17.1828V18ZM17.1828 6H2.14785V4H17.1828V6ZM6.44355 12H4.2957V10H6.44355V12ZM10.7392 12H8.5914V10H10.7392V12ZM15.0349 12H12.8871V10H15.0349V12ZM6.44355 16H4.2957V14H6.44355V16ZM10.7392 16H8.5914V14H10.7392V16ZM15.0349 16H12.8871V14H15.0349V16Z" fill="#42CE02"/>
                                                        </svg>
                                                    </span>
                                                    <span class="content-wrapper__date">
                                                        Publicado em: <strong><?php echo get_the_date(); ?></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- Thumbnail -->
                                            <div class="content-wrapper__thumbnail">
                                                <?php the_post_thumbnail(); ?>
                                            </div>
                                        </div>

                                        <?php the_content(); ?>

                                        <!-- Newsletter Horizontal -->
                                        <div class="row justify-content-center mt-5">
                                            <div class="col-lg-12">
                                                <?php get_sidebar('blog', ['layout' => 'horizontal', 'only_newsletter' => true]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row share-post justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Share Template -->
                                    <?php get_template_part('template-parts/share'); ?>
                                </div>
                            </div>

                   
                        </div>
                    </div>

                    <?php
endwhile;

// Include Blocks Template (Flexible Content)
// This enables "Seção Onde Estamos" and others to appear below content if configured
get_template_part('blocos');

get_footer();
