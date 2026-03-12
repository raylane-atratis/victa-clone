<?php
/**
 * Footer Template — Victa
 */

$logo_rodape    = get_field('logo_rodape', 'option');
$lista_de_redes = get_field('lista_de_redes', 'option');
?>

</main><!-- #main-content -->

<footer id="colophon" class="site-footer" role="contentinfo">

	<!-- ===== Área de Links ===== -->
	<div class="footer-links-area">
		<div class="container">

			<!-- Linha 1: Sobre | Conteúdo | Contatos -->
			<div class="row footer-row">
				<div class="col-lg-3 col-md-4 col-12 footer-col">
					<strong class="footer-title">Sobre a Victa</strong>
					<?php 
					wp_nav_menu( array( 
						'theme_location' => 'footer_sobre', 
						'container' => false, 
						'menu_class' => 'footer-links',
						'fallback_cb' => false
					) ); 
					?>
				</div>

				<div class="col-lg-3 col-md-4 col-12 footer-col">
					<strong class="footer-title">Conteúdo</strong>
					<?php 
					wp_nav_menu( array( 
						'theme_location' => 'footer_conteudo', 
						'container' => false, 
						'menu_class' => 'footer-links',
						'fallback_cb' => false
					) ); 
					?>
				</div>

				<div class="col-lg-3 col-md-4 col-12 footer-col">
					<strong class="footer-title">Contatos</strong>
					<?php 
					wp_nav_menu( array( 
						'theme_location' => 'footer_contatos', 
						'container' => false, 
						'menu_class' => 'footer-links',
						'fallback_cb' => false
					) ); 
					?>
				</div>
			</div>

			<!-- Linha 2: Cliente | Transparência | Encontre seu apê -->
			<div class="row footer-row">
				<div class="col-lg-3 col-md-4 col-12 footer-col">
					<strong class="footer-title">Cliente</strong>
					<?php 
					wp_nav_menu( array( 
						'theme_location' => 'footer_cliente', 
						'container' => false, 
						'menu_class' => 'footer-links',
						'fallback_cb' => false
					) ); 
					?>
				</div>

				<div class="col-lg-3 col-md-4 col-12 footer-col">
					<strong class="footer-title">Transparência</strong>
					<?php 
					wp_nav_menu( array( 
						'theme_location' => 'footer_transparencia', 
						'container' => false, 
						'menu_class' => 'footer-links',
						'fallback_cb' => false
					) ); 
					?>
				</div>

				<div class="col-lg-3 col-md-4 col-12 footer-col">
					<strong class="footer-title">Encontre seu apê</strong>
					<?php 
					wp_nav_menu( array( 
						'theme_location' => 'footer_encontre', 
						'container' => false, 
						'menu_class' => 'footer-links',
						'fallback_cb' => false
					) ); 
					?>
				</div>
			</div>

		</div>

		<!-- Decoração SVG -->
		<div class="footer-decoration" aria-hidden="true">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/public/images/svg-footer.svg" alt="" loading="lazy" width="685" height="636">
		</div>
	</div>

	<!-- ===== Barra Inferior ===== -->
	<div class="footer-bottom-bar">
		<div class="container">
			<div class="footer-bottom-inner">

				<!-- Grupo: Logo + Redes Sociais + CNPJ -->
				<div class="footer-info-group">
					<div class="footer-logo">
						<?php if ($logo_rodape) : ?>
							<img src="<?php echo esc_url($logo_rodape['url']); ?>" alt="<?php echo esc_attr($logo_rodape['alt'] ?: get_bloginfo('name')); ?>" width="<?php echo esc_attr($logo_rodape['width'] ?? 120); ?>" height="<?php echo esc_attr($logo_rodape['height'] ?? 30); ?>" loading="lazy">
						<?php else : ?>
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/public/images/logo.webp" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" width="120" height="30" loading="lazy">
						<?php endif; ?>
					</div>

					<div class="footer-separator"></div>

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

					<div class="footer-separator"></div>

					<div class="footer-cnpj">
						<p>CNPJ: 24.486.951/0001-80</p>
					</div>
				</div>

				<!-- Assinatura Atratis -->
				<div class="footer-bottom-right">
                    <div class="assinatura">
                        <h2>
                            <a href="https://www.atratis.com.br" target="_blank" rel="noopener noreferrer" class="ir"
                                style="--bg-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/public/images/atratis.png');"
                                title="Site criado pela agência Atratis Digital de Fortaleza - Ceará. Inbound Marketing, Criação de Sites, Mídias Sociais e mais.">Site
                                criado por Atratis, uma agência de comunicação digital de Fortaleza - Ceará</a>
                        </h2>
                    </div>
				</div>

			</div>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>

</body>

</html>