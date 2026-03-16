<?php

//Removendo barra administrativa quando logado, no front-end
function my_function_admin_bar()
{
	return false;
}
add_filter('show_admin_bar', 'my_function_admin_bar');

/**
 * Atratis functions and definitions
 */

if (!function_exists('atratis_setup')):
	function atratis_setup()
	{
		// Adiciona suporte a títulos de página automáticos
		add_theme_support('title-tag');

		// Adiciona suporte a imagens destacadas
		add_theme_support('post-thumbnails');

		// Adiciona suporte a menus
		register_nav_menus(array(
			'menu_principal' => 'Menu Principal',
			'footer_sobre' => 'Footer - Sobre a Victa',
			'footer_conteudo' => 'Footer - Conteúdo',
			'footer_contatos' => 'Footer - Contatos',
			'footer_cliente' => 'Footer - Cliente',
			'footer_transparencia' => 'Footer - Transparência',
			'footer_encontre' => 'Footer - Encontre seu apê',
		));

		// Suporte a HTML5
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		));

		// Tamanhos de imagem customizados
		add_image_size('card-thumb', 400, 300, true);
		add_image_size('banner-desktop', 1920, 800, true);
		add_image_size('banner-mobile', 768, 600, true);
	}
endif;
add_action('after_setup_theme', 'atratis_setup');

/**
 * ============================================================
 * LIMPEZA DO <head> - Remove bloat do WordPress (Performance)
 * ============================================================
 */
function atratis_cleanup_head()
{
	// Remove emoji scripts/styles
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('admin_print_styles', 'print_emoji_styles');

	// Remove wp-embed
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');

	// Remove RSD link
	remove_action('wp_head', 'rsd_link');

	// Remove wlwmanifest
	remove_action('wp_head', 'wlwmanifest_link');

	// Remove WP version (segurança)
	remove_action('wp_head', 'wp_generator');

	// Remove REST API link
	remove_action('wp_head', 'rest_output_link_wp_head', 10);

	// Remove shortlink
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

	// Remove feed links (não usamos RSS)
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('after_setup_theme', 'atratis_cleanup_head');

/**
 * Remove Gutenberg Block CSS nas páginas que não usam editor de blocos.
 * Mantém os estilos em posts do blog (single) que utilizam Gutenberg.
 */
function atratis_remove_block_css()
{
	// Preserva estilos do Gutenberg em posts do blog
	if (is_singular('post')) {
		return;
	}

	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-blocks-style');
	wp_dequeue_style('global-styles');
	wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'atratis_remove_block_css', 100);

/**
 * Remove jQuery no frontend (não utilizamos)
 */
function atratis_remove_jquery()
{
	if (!is_admin()) {
		wp_deregister_script('jquery');
	}
}
add_action('wp_enqueue_scripts', 'atratis_remove_jquery');

/**
 * ============================================================
 * HELPERS DE IMAGEM - Performance & Core Web Vitals
 * ============================================================
 */

/**
 * Renderiza uma imagem ACF otimizada com lazy loading, width/height e srcset.
 */
function atratis_image($image, $size = 'full', $lazy = true, $class = '', $alt_fallback = '')
{
	if (empty($image) || empty($image['ID']))
		return;

	$attrs = array(
		'class' => $class,
		'loading' => $lazy ? 'lazy' : 'eager',
		'alt' => !empty($image['alt']) ? $image['alt'] : $alt_fallback,
	);

	if (!$lazy) {
		$attrs['fetchpriority'] = 'high';
	}

	echo wp_get_attachment_image($image['ID'], $size, false, $attrs);
}

/**
 * Renderiza imagem responsiva com <picture> (desktop + mobile).
 */
function atratis_picture($desktop, $mobile = null, $size = 'full', $lazy = true, $class = '')
{
	if (empty($desktop) || empty($desktop['ID']))
		return;

	$attrs = array(
		'class' => $class,
		'loading' => $lazy ? 'lazy' : 'eager',
		'alt' => !empty($desktop['alt']) ? $desktop['alt'] : '',
	);

	if (!$lazy) {
		$attrs['fetchpriority'] = 'high';
	}

	if ($mobile && !empty($mobile['url'])) {
		echo '<picture>';
		echo '<source media="(max-width: 991px)" srcset="' . esc_url($mobile['url']) . '">';
		echo wp_get_attachment_image($desktop['ID'], $size, false, $attrs);
		echo '</picture>';
	}
	else {
		echo wp_get_attachment_image($desktop['ID'], $size, false, $attrs);
	}
}

/**
 * Retorna URL de imagem ACF com fallback.
 */
function atratis_image_url($image, $fallback = '')
{
	if (!empty($image) && !empty($image['url'])) {
		return esc_url($image['url']);
	}
	return $fallback ? esc_url($fallback) : '';
}

/**
 * ============================================================
 * SCHEMA.ORG JSON-LD - Dados Estruturados para SEO
 * ============================================================
 */
function atratis_schema_organization()
{
	$logo = get_field('logo_image', 'option');
	$email = get_field('email', 'option');
	$redes = get_field('lista_de_redes', 'option');

	$schema = array(
		'@context' => 'https://schema.org',
		'@type' => 'Organization',
		'name' => get_bloginfo('name'),
		'description' => get_bloginfo('description'),
		'url' => home_url('/'),
	);

	if ($logo && !empty($logo['url'])) {
		$schema['logo'] = esc_url($logo['url']);
	}

	if ($email) {
		$schema['email'] = sanitize_email($email);
	}

	if ($redes && is_array($redes)) {
		$social_urls = array();
		foreach ($redes as $rede) {
			if (!empty($rede['link'])) {
				$social_urls[] = esc_url($rede['link']);
			}
		}
		if (!empty($social_urls)) {
			$schema['sameAs'] = $social_urls;
		}
	}

	echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_footer', 'atratis_schema_organization', 99);

/**
 * Adiciona resource hints (preconnect) para Google Fonts - Melhora LCP
 */
function atratis_resource_hints()
{
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

	// Preload da fonte local principal (Articulat CF Demi Bold) para evitar FOIT/FOUT em títulos
	echo '<link rel="preload" href="' . get_template_directory_uri() . '/public/fonts/fonnts.com-Articulat_CF_Demi_Bold.otf" as="font" type="font/otf" crossorigin>' . "\n";
}
add_action('wp_head', 'atratis_resource_hints', 1);

/**
 * Enqueue scripts and styles.
 */
function atratis_scripts()
{
	// Google Fonts (Sora) - com preconnect prévio para melhor performance
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap', array(), null);

	// Configuração do Vite
	$vite_server = 'http://localhost:5173';
	$vite_dev = false;

	// Verifica se o servidor Vite está rodando (apenas em ambiente local)
	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
		$connection = @fsockopen('localhost', 5173, $errno, $errstr, 0.1);
		if ($connection) {
			$vite_dev = true;
			fclose($connection);
		}
	}

	if ($vite_dev) {
		// MODO DESENVOLVIMENTO (HMR Ativo)
		wp_enqueue_script('vite-client', $vite_server . '/@vite/client', array(), null, true);
		wp_enqueue_script('atratis-main', $vite_server . '/src/js/main.js', array(), null, true);

		// Injeta type="module" para os scripts do Vite
		add_filter('script_loader_tag', function ($tag, $handle, $src) {
			if (in_array($handle, array('vite-client', 'atratis-main'))) {
				return '<script type="module" src="' . esc_url($src) . '"></script>';
			}
			return $tag;
		}, 10, 3);

	}
	else {
		// MODO PRODUÇÃO (Arquivos Compilados)
		$css_file_path = get_template_directory() . '/assets/css/all.css';

		if (file_exists($css_file_path)) {
			wp_enqueue_style('atratis-main', get_template_directory_uri() . '/assets/css/all.css', array(), filemtime($css_file_path));
			wp_enqueue_script('atratis-script', get_template_directory_uri() . '/assets/js/script.min.js', array(), filemtime(get_template_directory() . '/assets/js/script.min.js'), true);
		}
		else {
			wp_enqueue_style('atratis-style', get_stylesheet_uri());
		}
	}
}
add_action('wp_enqueue_scripts', 'atratis_scripts');

/**
 * Adiciona atributo 'defer' aos scripts para melhor performance (PageSpeed).
 */
function atratis_defer_scripts($tag, $handle)
{
	// Lista de scripts que devem receber o defer (adicione outros se necessário)
	$defer_scripts = array('atratis-script');

	if (in_array($handle, $defer_scripts)) {
		return str_replace(' src', ' defer src', $tag);
	}

	return $tag;
}
add_filter('script_loader_tag', 'atratis_defer_scripts', 10, 2);

/**
 * Adiciona Página de Opções (ACF)
 */
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Opções do Tema',
		'menu_title' => 'Opções do Tema',
		'menu_slug' => 'tema',
		'capability' => 'edit_posts',
		'icon_url' => 'dashicons-layout',
		'position' => 2,
	));

	acf_add_options_sub_page(array(
		'page_title' => 'Opções Gerais',
		'menu_title' => 'Opções Gerais',
		'menu_slug' => 'configuracoes-do-tema',
		'capability' => 'edit_posts',
		'parent_slug' => 'tema',
	));

	acf_add_options_sub_page(array(
		'page_title' => 'Página Inicial',
		'menu_title' => 'Página Inicial',
		'menu_slug' => 'pagina-inicial',
		'capability' => 'edit_posts',
		'parent_slug' => 'tema',
	));

}

/**
 * Register Custom Post Type: Banners
 */
function atratis_register_banner_cpt()
{
	$labels = array(
		'name' => 'Banners',
		'singular_name' => 'Banner',
		'menu_name' => 'Banners',
		'name_admin_bar' => 'Banner',
		'add_new' => 'Adicionar Novo',
		'add_new_item' => 'Adicionar Novo Banner',
		'new_item' => 'Novo Banner',
		'edit_item' => 'Editar Banner',
		'view_item' => 'Ver Banner',
		'all_items' => 'Todos os Banners',
		'search_items' => 'Pesquisar Banners',
		'not_found' => 'Nenhum banner encontrado.',
		'not_found_in_trash' => 'Nenhum banner encontrado na lixeira.',
	);

	$args = array(
		'labels' => $labels,
		'public' => false, // Não precisa ser público no front (acesso direto URL)
		'publicly_queryable' => true, // Mas precisa ser consultável via WP_Query
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'banner'),
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => array('title', 'thumbnail'), // 'editor' removido pois usa ACF
	);

	register_post_type('banners', $args);
}
add_action('init', 'atratis_register_banner_cpt');

/**
 * Register Taxonomy: Posições do Banner
 */
function atratis_register_banner_taxonomy()
{
	$labels = array(
		'name' => 'Posições',
		'singular_name' => 'Posição',
		'search_items' => 'Pesquisar Posições',
		'all_items' => 'Todas as Posições',
		'edit_item' => 'Editar Posição',
		'update_item' => 'Atualizar Posição',
		'add_new_item' => 'Adicionar Nova Posição',
		'new_item_name' => 'Nova Posição',
		'menu_name' => 'Posições',
	);

	$args = array(
		'hierarchical' => true, // Tipo Categoria (checkbox)
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'posicoes_banner'),
	);

	register_taxonomy('posicoes_banner', array('banners'), $args);
}
add_action('init', 'atratis_register_banner_taxonomy');

/**
 * Função de Breadcrumb Limpa e Genérica
 */
function get_breadcrumb()
{
	echo '<a href="' . home_url() . '" rel="nofollow">Inicial</a>';

	if (is_tax() || is_category() || is_tag()) {
		$current_term = get_queried_object();
		$ancestors = get_ancestors($current_term->term_id, $current_term->taxonomy);
		$ancestors = array_reverse($ancestors); // Inverte a ordem dos ancestrais

		foreach ($ancestors as $ancestor) {
			$ancestor_term = get_term($ancestor, $current_term->taxonomy);
			echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
			echo '<a href="' . esc_url(get_term_link($ancestor_term->term_id, $current_term->taxonomy)) . '">' . esc_html($ancestor_term->name) . '</a>';
		}
		echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
		echo esc_html($current_term->name);

	}
	elseif (is_single()) {
		$post_type = get_post_type();

		if ($post_type != 'post') { // CPT Genérico
			$post_type_obj = get_post_type_object($post_type);
			$label = ($post_type === 'empreendimentos') ? 'Imóveis' : $post_type_obj->labels->name;
			echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
			echo '<a href="' . esc_url(get_post_type_archive_link($post_type)) . '">' . esc_html($label) . '</a>';
		}
		else { // Posts normais (verificando categorias)
			$categories = get_the_category();
			if ($categories) {
				$category = $categories[0]; // Pega a primeira
				$parent = $category->category_parent;

				if ($parent) {
					$parent_category = get_category($parent);
					echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
					echo '<a href="' . esc_url(get_category_link($parent_category->term_id)) . '">' . esc_html($parent_category->name) . '</a>';
				}

				echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
				echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
			}
		}

		echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
		the_title();

	}
	elseif (is_page()) {
		echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
		echo get_the_title();

	}
	elseif (is_search()) {
		echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; Resultados da Pesquisa para... ";
		echo '"<em>' . get_search_query() . '</em>"';

	}
	elseif (is_post_type_archive()) {
		$post_type = get_post_type();
		$post_type_obj = get_post_type_object($post_type);
		$label = ($post_type === 'empreendimentos') ? 'Imóveis' : $post_type_obj->labels->name;
		echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
		echo esc_html($label);

	}
	elseif (is_archive()) {
		echo " &nbsp;&nbsp;&raquo;&nbsp;&nbsp; ";
		the_archive_title();
	}
}

// Função para carregar os dados dos imóveis no rodapé da página
add_action('wp_footer', 'injetar_dados_empreendimentos_json');

function injetar_dados_empreendimentos_json()
{

	$args = array(
		'post_type' => 'empreendimentos',
		'posts_per_page' => -1, // Pega todos os ativos
		'post_status' => 'publish',
	);

	$query = new WP_Query($args);
	$imoveis = array();

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			// Pega as taxonomias (Filtros)
			$estado = wp_get_post_terms(get_the_ID(), 'estado', array('fields' => 'slugs'));
			$cidade = wp_get_post_terms(get_the_ID(), 'cidade', array('fields' => 'slugs'));
			$bairro = wp_get_post_terms(get_the_ID(), 'bairro', array('fields' => 'slugs'));
			$estagio_terms = wp_get_post_terms(get_the_ID(), 'estagio_obra');
			$estagio_slug = !empty($estagio_terms) ? $estagio_terms[0]->slug : '';
			$estagio_svg = '';
			if (!empty($estagio_terms)) {
				$estagio_svg = get_field('svg', $estagio_terms[0]);
			}

			// Monta o Array Limpo
			$imoveis[] = array(
				'id' => get_the_ID(),
				'titulo' => get_the_title(),
				'link' => get_permalink(),
				// Use a URL da imagem otimizada (ex: tamanho 'medium_large')
				'imagem' => get_the_post_thumbnail_url(get_the_ID(), 'medium_large'),
				'local' => get_field('local_texto'), // Ex: "Praia do Futuro | Fortaleza-CE"
				'area' => get_field('area_texto'), // Ex: "49,65m² a 100,02m²"
				'quartos' => get_field('quartos'), // Ex: "2 Quartos"
				'badge' => get_field('badge_texto'), // Ex: "100% vendido" (vazio se não tiver)

				// Filtros (Slugs para comparação no JS)
				'estado' => !empty($estado) ? $estado[0] : '',
				'cidade' => !empty($cidade) ? $cidade[0] : '',
				'bairro' => !empty($bairro) ? $bairro[0] : '',
				'estagio' => $estagio_slug,
				'estagio_svg' => $estagio_svg ?: '',
			);
		}
		wp_reset_postdata();
	}

	// A MÁGICA: Converte o PHP em um JSON nativo no JavaScript
	echo '<script type="text/javascript">';
	echo 'const imoveisData = ' . json_encode($imoveis) . ';';
	echo '</script>';
}