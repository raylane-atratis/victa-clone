<?php
/**
 * Atratis functions and definitions
 */

if ( ! function_exists( 'atratis_setup' ) ) :
	function atratis_setup() {
		// Adiciona suporte a títulos de página automáticos
		add_theme_support( 'title-tag' );

		// Adiciona suporte a imagens destacadas
		add_theme_support( 'post-thumbnails' );

		// Adiciona suporte a menus
		register_nav_menus( array(
			'menu_principal' => 'Menu Principal',
		) );
		
		// Suporte a HTML5
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'atratis_setup' );

/**
 * Enqueue scripts and styles.
 */
function atratis_scripts() {
	// Google Fonts (Lexend & Poppins)
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null );

	// Configuração do Vite
	$vite_server = 'http://localhost:5173';
	$vite_dev = false;

	// Verifica se o servidor Vite está rodando (apenas em ambiente local)
	if ( in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ) ) ) {
		$connection = @fsockopen( 'localhost', 5173, $errno, $errstr, 0.1 );
		if ( $connection ) {
			$vite_dev = true;
			fclose( $connection );
		}
	}

	if ( $vite_dev ) {
		// MODO DESENVOLVIMENTO (HMR Ativo)
		wp_enqueue_script( 'vite-client', $vite_server . '/@vite/client', array(), null, true );
		wp_enqueue_script( 'atratis-main', $vite_server . '/src/js/main.js', array(), null, true );

		// Injeta type="module" para os scripts do Vite
		add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
			if ( in_array( $handle, array( 'vite-client', 'atratis-main' ) ) ) {
				return '<script type="module" src="' . esc_url( $src ) . '"></script>';
			}
			return $tag;
		}, 10, 3 );

	} else {
		// MODO PRODUÇÃO (Arquivos Compilados)
		$css_file_path = get_template_directory() . '/assets/css/all.css';
		
		if ( file_exists( $css_file_path ) ) {
			wp_enqueue_style( 'atratis-main', get_template_directory_uri() . '/assets/css/all.css', array(), filemtime($css_file_path) );
			wp_enqueue_script( 'atratis-script', get_template_directory_uri() . '/assets/js/script.min.js', array(), filemtime(get_template_directory() . '/assets/js/script.min.js'), true );
		} else {
			wp_enqueue_style( 'atratis-style', get_stylesheet_uri() );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'atratis_scripts' );

/**
 * Adiciona atributo 'defer' aos scripts para melhor performance (PageSpeed).
 */
function atratis_defer_scripts( $tag, $handle ) {
    // Lista de scripts que devem receber o defer (adicione outros se necessário)
    $defer_scripts = array( 'atratis-script' );

    if ( in_array( $handle, $defer_scripts ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'atratis_defer_scripts', 10, 2 );

/**
 * Adiciona Página de Opções (ACF)
 */
if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
        'page_title' => 'Opções do Tema',
        'menu_title' => 'Opções do Tema',
        'menu_slug'  => 'tema',
        'capability' => 'edit_posts',
        'icon_url'   => 'dashicons-layout',
        'position'   => 2,
    ));

    acf_add_options_sub_page( array(
        'page_title'  => 'Opções Gerais',
        'menu_title'  => 'Opções Gerais',
        'menu_slug'   => 'configuracoes-do-tema',
        'capability'  => 'edit_posts',
        'parent_slug' => 'tema',
    ));

    acf_add_options_sub_page( array(
        'page_title'  => 'Página Inicial',
        'menu_title'  => 'Página Inicial',
        'menu_slug'   => 'pagina-inicial',
        'capability'  => 'edit_posts',
        'parent_slug' => 'tema',
    ));

}
