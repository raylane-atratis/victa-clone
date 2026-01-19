	<footer id="colophon" class="site-footer">
		<!-- Seção Superior (Links, Contatos, Endereço) -->
		<div class="footer-top">
			<div class="container">
				<div class="row row-personalizada">
					<!-- Coluna 1: Links Rápidos -->
					<div class="col-lg-3 col-md-6">
						<h4 class="footer-title">Links rápidos</h4>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu_footer',
								'menu_id'        => 'footer-menu',
								'container'      => false,
								'menu_class'     => 'footer-links',
								'fallback_cb'    => false,
							)
						);
						?>
					</div>

					<!-- Coluna 2: Contatos -->
					<div class="col-lg-3 col-md-6">
						<h4 class="footer-title">Contatos</h4>
						<ul class="footer-contact">
							<li>
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/Phone.svg" alt="Telefone" class="footer-icon">
								<a href="tel:08006650101">0800 665 0101 (Clientes)</a>
							</li>
							<li>
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/WhatsappLogoFooter.svg" alt="Telefone" class="footer-icon">
								<a href="tel:08000002435">0800 000 2435 (Parceiros)</a>
							</li>
							<li>
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/Phone.svg" alt="Telefone" class="footer-icon">
								<span>
									<a href="tel:8540002985">(85) 4000 2985</a> / <a href="tel:08006650101">0800 665 0101</a>
								</span>
							</li>
						</ul>
						<h4 class="footer-subtitle">E-mail</h4>
						<a href="mailto:contato@tafacilconsignados.com.br" class="footer-email">contato@tafacilconsignados.com.br</a>
					</div>

					<!-- Coluna 3: Horário e Endereço -->
					<div class="col-lg-3 col-md-6">
						<div class="row">
							<!-- Horário -->
							<div class="col-lg-12">
								<h4 class="footer-title">Horário de atendimento</h4>
								<p class="footer-text">Atendimento para clientes e parceiros de segunda a sexta, das 08h às 18h</p>
							</div>
							<!-- Endereço -->
							<div class="col-lg-12">
								<h4 class="footer-subtitle">Endereço</h4>
								<address class="footer-address">
									<p>Av. Washington Soares, 4335,<br>Sapiranga, Fortaleza - CE</p>
									<p>Rua Gomes de Carvalho, 1765,<br>Vila Olímpia, São Paulo - SP</p>
								</address>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção Inferior (Logo e Redes Sociais) -->
		<div class="footer-bottom">
			<div class="container">
				<div class="row align-items-center">
					<!-- Logo e "Uma empresa do" -->
					<div class="col-lg-6 col-md-12">
						<div class="footer-branding">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/Logo-Full.svg" alt="<?php bloginfo( 'name' ); ?>" width="150">
							</a>
							<img src="<?php echo get_template_directory_uri(); ?>/public/images/somapay.svg" alt="Somapay" class="footer-somapay" width="150">
						</div>
					</div>

					<!-- Redes Sociais -->
					<div class="col-lg-6 col-md-12 col-personalizada">
						<div class="footer-social">
							<span class="social-label">Nossas redes sociais</span>
							<ul class="social-icons">
								<li><a href="#" target="_blank" aria-label="Instagram"><img src="<?php echo get_template_directory_uri(); ?>/public/images/InstagramLogo.svg" alt="Instagram"></a></li>
								<li><a href="#" target="_blank" aria-label="WhatsApp"><img src="<?php echo get_template_directory_uri(); ?>/public/images/WhatsappLogo.svg" alt="WhatsApp"></a></li>
								<li><a href="#" target="_blank" aria-label="Facebook"><img src="<?php echo get_template_directory_uri(); ?>/public/images/FacebookLogo.svg" alt="Facebook"></a></li>
								<li><a href="#" target="_blank" aria-label="LinkedIn"><img src="<?php echo get_template_directory_uri(); ?>/public/images/LinkedinLogo.svg" alt="LinkedIn"></a></li>
								<li><a href="#" target="_blank" aria-label="TikTok"><img src="<?php echo get_template_directory_uri(); ?>/public/images/TiktokLogo.svg" alt="TikTok"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>


<?php wp_footer(); ?>

</body>
</html>
