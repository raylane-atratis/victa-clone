<?php
/**
 * Block Name: Seção Depoimentos
 *
 * This is the template that displays the Seção Depoimentos block.
 */

// 1. Configurações Gerais
include 'conf_gerais.php';

// Simulando campos do ACF para desenvolvimento sem painel
$titulo = get_sub_field('titulo') ?: 'Histórias que começam aqui';
$subtitulo = get_sub_field('descricao') ?: 'O que nossos clientes dizem sobre a Tafácil.';

$depoimentos = get_sub_field('depoimentos');

if (!$depoimentos) {
    // Dados 'fake' para visualização durante desenvolvimento se não houver cadastro prévio
    $depoimentos = [
        [
            'foto' => 'https://randomuser.me/api/portraits/women/65.jpg', // Placeholder
            'nome' => 'Rute Maria',
            'cargo' => 'Servidora pública',
            'depoimento' => '“Fiz pelo celular, em um instante. Foi rápido demais! E eu indicaria muitas vezes.”',
            'video_url' => 'https://www.youtube.com/watch?v=D0UnqGm_miA' // Exemplo
        ],
        [
            'foto' => 'https://randomuser.me/api/portraits/women/44.jpg',
            'nome' => 'Regina Lúcia',
            'cargo' => 'Servidora pública',
            'depoimento' => '“Me indicaram e chegou no momento certo, na hora certa!”',
            'video_url' => 'https://www.youtube.com/watch?v=D0UnqGm_miA'
        ],
        [
            'foto' => 'https://randomuser.me/api/portraits/men/32.jpg',
            'nome' => 'Alessandro',
            'cargo' => 'Servidor público',
            'depoimento' => '“Além de ter sido muito bem atendido, não fiquei com dúvida alguma e a agilidade foi muito grande.”',
            'video_url' => 'https://www.youtube.com/watch?v=D0UnqGm_miA'
        ],
        [
            'foto' => 'https://randomuser.me/api/portraits/women/65.jpg', 
            'nome' => 'Rute Maria',
            'cargo' => 'Servidora pública',
            'depoimento' => '“Fiz pelo celular, em um instante. Foi rápido demais! E eu indicaria muitas vezes.”',
            'video_url' => 'https://www.youtube.com/watch?v=D0UnqGm_miA' 
        ],
    ];
}
?>

<section class="secao-depoimentos" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
              <div class="title">
                <?php if ($titulo) : ?>
                    <h2 class="secao-depoimentos__titulo"><?php echo esc_html($titulo); ?></h2>
                <?php endif; ?>
                <?php if ($subtitulo) : ?>
                    <p class="secao-depoimentos__subtitulo"><?php echo esc_html($subtitulo); ?></p>
                <?php endif; ?>
              </div>
            </div>
        </div>

        <div class="secao-depoimentos__wrapper position-relative">
            <!-- Swiper -->
            <div class="swiper swiper-depoimentos">
                <div class="swiper-wrapper">
                    <?php foreach ($depoimentos as $item) : 
                        $foto = is_array($item['foto']) ? $item['foto']['url'] : $item['foto'];
                    ?>
                        <div class="swiper-slide">
                            <div class="card-depoimento">
                                <div class="card-depoimento__header d-flex align-items-center mb-3">
                                    <div class="card-depoimento__avatar me-3">
                                        <img src="<?php echo esc_url($foto); ?>" alt="<?php echo esc_attr($item['nome']); ?>" width="64" height="64" loading="lazy" decoding="async">
                                    </div>
                                    <div class="card-depoimento__info">
                                        <h3 class="card-depoimento__nome mb-0"><?php echo esc_html($item['nome']); ?></h3>
                                        <p class="card-depoimento__cargo mb-0"><?php echo esc_html($item['cargo']); ?></p>
                                    </div>
                                </div>
                                <div class="card-depoimento__body mb-4">
                                    <p><?php echo esc_html($item['depoimento']); ?></p>
                                </div>
                                <div class="card-depoimento__footer mt-auto">
                                    <?php if (!empty($item['video_url'])) : ?>
                                        <button type="button" class="btn-assistir" data-video-url="<?php echo esc_url($item['video_url']); ?>">
                                            <span class="btn-assistir__icon me-2">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 3.25C13.4783 3.25 11.0132 3.99777 8.91648 5.39876C6.81976 6.79975 5.18556 8.79103 4.22054 11.1208C3.25552 13.4505 3.00303 16.0141 3.49499 18.4874C3.98696 20.9607 5.20127 23.2325 6.98439 25.0156C8.76751 26.7987 11.0393 28.0131 13.5126 28.505C15.9859 28.997 18.5495 28.7445 20.8792 27.7795C23.209 26.8144 25.2003 25.1802 26.6012 23.0835C28.0022 20.9868 28.75 18.5217 28.75 16C28.746 12.6197 27.4015 9.379 25.0112 6.98877C22.621 4.59854 19.3803 3.25397 16 3.25ZM16 27.25C13.775 27.25 11.5999 26.5902 9.74984 25.354C7.89979 24.1179 6.45785 22.3609 5.60636 20.3052C4.75488 18.2495 4.53209 15.9875 4.96617 13.8052C5.40025 11.6229 6.47171 9.61839 8.04505 8.04505C9.6184 6.47171 11.623 5.40025 13.8052 4.96617C15.9875 4.53208 18.2495 4.75487 20.3052 5.60636C22.3609 6.45784 24.1179 7.89978 25.354 9.74984C26.5902 11.5999 27.25 13.775 27.25 16C27.2467 18.9827 26.0604 21.8422 23.9513 23.9513C21.8422 26.0604 18.9827 27.2467 16 27.25ZM21.8975 15.3638L13.8975 10.3638C13.784 10.2928 13.6535 10.2535 13.5196 10.25C13.3858 10.2465 13.2534 10.2789 13.1363 10.3438C13.0192 10.4088 12.9216 10.5039 12.8537 10.6192C12.7858 10.7346 12.75 10.8661 12.75 11V21C12.75 21.1339 12.7858 21.2654 12.8537 21.3808C12.9216 21.4961 13.0192 21.5912 13.1363 21.6562C13.2534 21.7211 13.3858 21.7535 13.5196 21.75C13.6535 21.7465 13.784 21.7072 13.8975 21.6362L21.8975 16.6362C22.0055 16.5689 22.0945 16.4751 22.1563 16.3638C22.218 16.2525 22.2504 16.1273 22.2504 16C22.2504 15.8727 22.218 15.7475 22.1563 15.6362C22.0945 15.5249 22.0055 15.4311 21.8975 15.3638ZM14.25 19.6462V12.3538L20.085 16L14.25 19.6462Z" fill="#5B2580"/>
                                                </svg>
                                            </span>
                                            Assistir vídeo
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination (dots) para mobile -->
                <div class="swiper-pagination swiper-depoimentos-pagination"></div>
            </div>
            
            <!-- Navigation buttons outside swiper container but within wrapper -->
            <div class="swiper-button-prev swiper-depoimentos-prev">
                <svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 26L1.5 13.5L14 1" stroke="#606060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="swiper-button-next swiper-depoimentos-next">
                <svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L13.5 13.5L1 26" stroke="#606060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>
</section>
