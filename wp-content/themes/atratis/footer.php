<?php
$logo_principal = get_field('logo_image', 'option');
$logo_secundaria = get_field('logo_secundaria', 'option');
$lista_contatos = get_field('lista_contatos', 'option');
$email = get_field('email', 'option');
$horario_de_atendimento = get_field('horario_de_atendimento', 'option');
$enderecos = get_field('enderecos', 'option');
$cnpj = get_field('cnpj', 'option');
$razao_social = get_field('razao_social', 'option');


$lista_de_redes = get_field('lista_de_redes', 'option');
?>

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
							'menu_id' => 'footer-menu',
							'container' => false,
							'menu_class' => 'footer-links',
							'fallback_cb' => false,
						)
					);
					?>
				</div>

				<!-- Coluna 2: Contatos -->
				<div class="col-lg-3 col-md-6">
					<h4 class="footer-title">Contatos</h4>
					<ul class="footer-contact">
						<?php
						$contatos = get_field('lista_contatos', 'option');
						if ($contatos):
							$total_contatos = count($contatos);

							// Se houver 2 ou mais contatos, agrupa os dois últimos
							if ($total_contatos >= 2) {
								// Exibe todos exceto os 2 últimos
								for ($i = 0; $i < $total_contatos - 2; $i++) {
									$contato = $contatos[$i];
									?>
									<li>
										<?php echo $contato['svg']; ?>
										<a href="<?php echo esc_url($contato['link']); ?>" target="_blank">
											<?php echo esc_html($contato['texto']); ?>
										</a>
									</li>
									<?php
								}

								// Pega e agrupa os dois últimos
								$penultimo = $contatos[$total_contatos - 2];
								$ultimo = $contatos[$total_contatos - 1];
								?>
								<li>
									<?php echo $penultimo['svg']; ?>
									<span>
										<a href="<?php echo esc_url($penultimo['link']); ?>" target="_blank">
											<?php echo esc_html($penultimo['texto']); ?>
										</a>
										/
										<a href="<?php echo esc_url($ultimo['link']); ?>" target="_blank">
											<?php echo esc_html($ultimo['texto']); ?>
										</a>
									</span>
								</li>
								<?php
							} else {
								// Caso tenha menos de 2 itens, exibe um por um normalmente
								foreach ($contatos as $contato):
									?>
									<li>
										<?php echo $contato['svg']; ?>
										<a href="<?php echo esc_url($contato['link']); ?>" target="_blank">
											<?php echo esc_html($contato['texto']); ?>
										</a>
									</li>
									<?php
								endforeach;
							}
						else: ?>
							<li>
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/Phone.svg"
									alt="Telefone" class="footer-icon">
								<a href="tel:08006650101" target="_blank">0800 665 0101 (Clientes)</a>
							</li>
							<li>
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/WhatsappLogoFooter.svg"
									alt="Whatsapp" class="footer-icon">
								<a href="tel:08000002435" target="_blank">0800 000 2435 (Parceiros)</a>
							</li>
							<li>
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/Phone.svg"
									alt="Telefone" class="footer-icon">
								<span>
									<a href="tel:8540002985" target="_blank">(85) 4000 2985</a> /
									<a href="tel:08006650101" target="_blank">0800 665 0101</a>
								</span>
							</li>
						<?php endif; ?>
					</ul>
					<h4 class="footer-subtitle">E-mail</h4>
					<?php if ($email): ?>
						<a href="mailto:<?php echo esc_attr($email); ?>" target="_blank" rel="noopener noreferrer"
							class="footer-email">
							<?php echo esc_html($email); ?>
						</a>
					<?php else: ?>
						<a href="mailto:contato@tafacilconsignados.com.br" target="_blank" rel="noopener noreferrer"
							class="footer-email">
							contato@tafacilconsignados.com.br
						</a>
					<?php endif; ?>
				</div>

				<!-- Coluna 3: Horário e Endereço -->
				<div class="col-lg-3 col-md-6">
					<div class="row">
						<!-- Horário -->
						<div class="col-lg-12">
							<h4 class="footer-title">Horário de atendimento</h4>
							<?php if ($horario_de_atendimento): ?>
								<p class="footer-text"><?php echo esc_html($horario_de_atendimento); ?></p>
							<?php else: ?>
								<p class="footer-text">Atendimento para clientes e parceiros de segunda a sexta, das 08h às
									18h</p>
							<?php endif; ?>
						</div>
						<!-- Endereço -->
						<div class="col-lg-12">
							<h4 class="footer-subtitle">Endereço</h4>
							<address class="footer-address">
								<?php if ($enderecos): ?>
									<?php foreach ($enderecos as $endereco): ?>
										<p>
											<?php if (!empty($endereco['link'])): ?>
												<a href="<?php echo esc_url($endereco['link']); ?>" target="_blank">
													<?php echo $endereco['texto']; ?>
												</a>
											<?php else: ?>
												<?php echo $endereco['texto']; ?>
											<?php endif; ?>
										</p>
									<?php endforeach; ?>
								<?php else: ?>
									<p>Av. Washington Soares, 4335,<br>Sapiranga, Fortaleza - CE</p>
									<p>Rua Gomes de Carvalho, 1765,<br>Vila Olímpia, São Paulo - SP</p>
								<?php endif; ?>
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
						<a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
							<?php if ($logo_principal): ?>
								<img src="<?php echo esc_url($logo_principal['url']); ?>"
									alt="<?php echo esc_attr($logo_principal['alt']); ?>" width="150">
							<?php else: ?>
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/Logo-Full.svg"
									alt="<?php bloginfo('name'); ?>" width="150">
							<?php endif; ?>
						</a>

						<?php if ($logo_secundaria): ?>
							<img src="<?php echo esc_url($logo_secundaria['url']); ?>"
								alt="<?php echo esc_attr($logo_secundaria['alt']); ?>" class="footer-somapay" width="150">
						<?php else: ?>
							<img src="<?php echo get_template_directory_uri(); ?>/public/images/somapay.svg" alt="Somapay"
								class="footer-somapay" width="150">
						<?php endif; ?>
					</div>
				</div>

				<!-- Redes Sociais -->
				<div class="col-lg-6 col-md-12 col-personalizada">
					<div class="razao-footer">
						<p>
							<?php echo $cnpj?>
						</p>
						<p>
							<?php echo $razao_social?>
						</p>
					</div>
					<div class="footer-social">
						<span class="social-label">Nossas redes sociais</span>
						<ul class="social-icons">
							<?php if ($lista_de_redes): ?>
								<?php foreach ($lista_de_redes as $rede): ?>
									<li>
										<a href="<?php echo esc_url($rede['link']); ?>" target="_blank"
											aria-label="<?php echo esc_attr($rede['descricao']); ?>">
											<?php echo $rede['svg']; ?>
										</a>
									</li>
								<?php endforeach; ?>
							<?php else: ?>
								<li><a href="#" target="_blank" aria-label="Instagram"><img
											src="<?php echo get_template_directory_uri(); ?>/public/images/InstagramLogo.svg"
											alt="Instagram"></a></li>
								<li><a href="#" target="_blank" aria-label="WhatsApp"><img
											src="<?php echo get_template_directory_uri(); ?>/public/images/WhatsappLogo.svg"
											alt="WhatsApp"></a></li>
								<li><a href="#" target="_blank" aria-label="Facebook"><img
											src="<?php echo get_template_directory_uri(); ?>/public/images/FacebookLogo.svg"
											alt="Facebook"></a></li>
								<li><a href="#" target="_blank" aria-label="LinkedIn"><img
											src="<?php echo get_template_directory_uri(); ?>/public/images/LinkedinLogo.svg"
											alt="LinkedIn"></a></li>
								<li><a href="#" target="_blank" aria-label="TikTok"><img
											src="<?php echo get_template_directory_uri(); ?>/public/images/TiktokLogo.svg"
											alt="TikTok"></a></li>
							<?php endif; ?>
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