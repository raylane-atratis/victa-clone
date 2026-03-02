<?php
$logo_rodape = get_field('logo_rodape', 'option');
$lista_contatos = get_field('lista_contatos', 'option');
$email = get_field('email', 'option');
$enderecos = get_field('enderecos', 'option');


$lista_de_redes = get_field('lista_de_redes', 'option');
?>

</main><!-- #main-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">
		<div class="row footer-top">
			<div class="col-lg-3 col-md-6 footer-col">
				<div class="footer-logo">
					<?php if ($logo_rodape) : ?>
						<img src="<?php echo esc_url($logo_rodape['url']); ?>" alt="<?php echo esc_attr($logo_rodape['alt'] ?: get_bloginfo('name')); ?>">
					<?php else: ?>
						<img src="<?php echo get_template_directory_uri(); ?>/public/images/logo-branca.svg" alt="<?php bloginfo('name'); ?>">
					<?php endif; ?>
				</div>
                <div class="footer-social">
					<?php if ($lista_de_redes) : ?>
						<ul>
							<?php foreach ($lista_de_redes as $rede) : ?>
								<li>
									<a href="<?php echo esc_url($rede['link']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($rede['titulo']); ?>">
										<?php echo $rede['svg']; ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-6 footer-col">
				<strong class="footer-title">Endereço</strong>
				<div class="footer-address">
                    <span class="icon">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.949 2.04983C17.626 0.728 15.8678 0 14 0C12.1322 0 10.3717 0.728 9.051 2.04983C7.728 3.37167 7 5.12983 7 7C7 8.87017 7.728 10.6283 9.065 11.963L14 16.7907L18.949 11.9502C20.272 10.6283 21 8.87017 21 7C21 5.12983 20.272 3.37167 18.949 2.04983ZM14 9.33333C12.7108 9.33333 11.6667 8.28917 11.6667 7C11.6667 5.71083 12.7108 4.66667 14 4.66667C15.2892 4.66667 16.3333 5.71083 16.3333 7C16.3333 8.28917 15.2892 9.33333 14 9.33333ZM28 18.3178V19.6L14 28L0 19.6V18.3178L7.57633 13.7713L10.1628 16.3018L5.73417 18.9583L13.9988 23.9167L22.2635 18.9583L17.8348 16.3018L20.4213 13.7725L27.9977 18.3178H28Z" fill="#157FFF"/>
                        </svg>
                    </span>
					<div class="text">
						<?php 
						if ($enderecos) {
							echo wp_kses_post($enderecos[0]['endereco'] ?? 'Rua Osvaldo Cruz, 2292 -<br>Dionisio Torres, Fortaleza/CE,<br>60.125-151');
						} else {
							echo 'Rua Osvaldo Cruz, 2292 -<br>Dionisio Torres, Fortaleza/CE,<br>60.125-151';
						}
						?>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-6 footer-col">
				<strong class="footer-title">Contatos</strong>
				<ul class="footer-contacts">
            <?php if ( $lista_contatos ) : ?>
                <?php foreach ( $lista_contatos as $contato ) : ?>
                    <li>
                        <a href="<?php echo esc_url($contato['link']); ?>" class="contact-link border-btn" target="_blank" rel="noopener noreferrer">
                            <?php if (!empty($contato['svg'])) : ?>
                                <span class="icon">
                                    <?php echo $contato['svg']; ?>
                                </span>
                            <?php endif; ?>
                            <span class="text"><?php echo wp_kses_post($contato['titulo']); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
				</ul>

            <div class="footer-email">
            <a href="mailto:<?php echo esc_url($email); ?>">
                <div class="icon">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.2971 18.5485L22.7491 11.096V4.33351C22.7491 1.94358 20.8056 4.52698e-07 18.4159 4.52698e-07H7.58302C5.19328 -0.00108293 3.24986 1.9425 3.24986 4.33243V11.096L10.7007 18.5485C11.9292 19.776 14.0697 19.776 15.2971 18.5485ZM7.92859 9.24772C7.49094 8.84037 7.46494 8.15459 7.87226 7.71691C8.28065 7.27814 8.96746 7.25539 9.40294 7.66057L11.4081 9.52506C11.6995 9.81541 12.1296 9.81649 12.395 9.55107L16.5797 5.51656C17.0109 5.10055 17.6966 5.11463 18.1115 5.54365C18.5275 5.97375 18.5145 6.66061 18.0844 7.07555L13.9127 11.097C13.3667 11.6431 12.6441 11.9161 11.9205 11.9161C11.1915 11.9161 10.4602 11.6387 9.9045 11.084L7.92859 9.24772ZM25.9989 13.7665V20.5831C25.9989 23.57 23.5691 26 20.5825 26H5.41644C2.42982 26 0 23.57 0 20.5831V13.7665C0 12.9583 0.199325 12.1718 0.541644 11.4513L9.17003 20.0815C10.1937 21.1042 11.5533 21.6676 13.0005 21.6676C14.4478 21.6676 15.8073 21.1042 16.83 20.0815L25.4584 11.4513C25.8007 12.1718 25.9989 12.9594 25.9989 13.7665Z" fill="#157FFF"/>
                </svg>
                </div>
                <?php echo esc_html($email); ?>
            </a>
            </div>
			</div>
			
			<div class="col-lg-3 col-md-6 footer-col">
				<strong class="footer-title">LGPD</strong>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu_lgpd',
						'menu_id'        => 'lgpd-menu',
						'container'      => false,
						'menu_class'     => 'footer-links',
						'fallback_cb'    => false,
					)
				);
				?>

        
			</div>
		</div>
	</div>

    <div class="footer-final">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-bottom">
                    <div class="footer-bottom-left">
                        <p>
                        Marcelo Mota Advocacia
                        </p>
                    </div>
                    <div class="footer-bottom-center">
                        <div class="icon-logo">
                        <svg width="37" height="32" viewBox="0 0 37 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_8054_86)">
                            <path d="M11.3781 0L8.76637 7.8446L6.03419 0H3.17175V1.0591L7.47762 11.7805H10.0543L14.3602 1.0591V0H11.3781Z" fill="#157FFF"/>
                            <path d="M0.309326 0V16.0623H3.17176V7.11487V0H0.309326Z" fill="#157FFF"/>
                            <path d="M14.3602 0V16.0623H17.2235V7.11487V0H14.3602Z" fill="#157FFF"/>
                            <path d="M37 6.58008H14.3602V9.48249H23.0656H37V6.58008Z" fill="#157FFF"/>
                            <path d="M25.9305 15.9377L28.543 23.7823L31.2743 15.9377H34.1368V16.9968L29.8309 27.7183H27.2542L22.9484 16.9968V15.9377H25.9305Z" fill="#157FFF"/>
                            <path d="M37 15.9377V32.0001H34.1367V23.0526V15.9377H37Z" fill="#157FFF"/>
                            <path d="M22.9484 15.9377V32.0001H20.0859V23.0526V15.9377H22.9484Z" fill="#157FFF"/>
                            <path d="M0 22.5176H22.9483V25.42H14.1241H0V22.5176Z" fill="#157FFF"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_8054_86">
                            <rect width="37" height="32" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        </div>
                    </div>
                    <div class="footer-bottom-right">
                       <div class="assinatura">
                            <h2>
                                <a href="http://www.atratis.com.br" target="_blank" class="ir"
                                    style="--bg-image: url('<?php echo get_template_directory_uri(); ?>/public/images/atratis.png');"
                                    title="Site criado pela agência Atratis Digital de Fortaleza - Ceará. Inbound Marketing, Criação de Sites, Mídias Sociais e mais.">Site
                                    criado por Atratis, uma agência de comunicação digital de Fortaleza - Ceará</a>
                            </h2>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>

</body>

</html>