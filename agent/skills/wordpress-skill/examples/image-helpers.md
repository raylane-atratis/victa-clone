# Helpers de Imagem Otimizada

Funções PHP utilitárias para renderizar imagens de alta performance, garantindo PageSpeed 100.

## Helpers para `functions.php`

```php
/**
 * ============================================================
 * HELPERS DE IMAGEM - Performance & Core Web Vitals
 * ============================================================
 */

/**
 * Renderiza uma imagem ACF otimizada com lazy loading, width/height e srcset.
 *
 * @param array  $image    Array retornado pelo ACF (return format: Array).
 * @param string $size     Tamanho da imagem WordPress (ex: 'full', 'large', 'medium').
 * @param bool   $lazy     Se true, adiciona loading="lazy". Se false, loading="eager".
 * @param string $class    Classes CSS adicionais.
 * @param string $alt_fallback  Alt text fallback caso o campo alt esteja vazio.
 * @return void
 */
function atratis_image( $image, $size = 'full', $lazy = true, $class = '', $alt_fallback = '' ) {
    if ( empty( $image ) || empty( $image['ID'] ) ) return;

    $attrs = array(
        'class'   => $class,
        'loading' => $lazy ? 'lazy' : 'eager',
        'alt'     => !empty( $image['alt'] ) ? $image['alt'] : $alt_fallback,
    );

    // Se not lazy, adicionar fetchpriority para LCP
    if ( !$lazy ) {
        $attrs['fetchpriority'] = 'high';
    }

    echo wp_get_attachment_image( $image['ID'], $size, false, $attrs );
}

/**
 * Renderiza imagem responsiva com <picture> (desktop + mobile).
 *
 * @param array  $desktop   Array ACF da imagem desktop.
 * @param array  $mobile    Array ACF da imagem mobile.
 * @param string $size      Tamanho WordPress para desktop.
 * @param bool   $lazy      Lazy loading.
 * @param string $class     Classes CSS.
 * @return void
 */
function atratis_picture( $desktop, $mobile = null, $size = 'full', $lazy = true, $class = '' ) {
    if ( empty( $desktop ) || empty( $desktop['ID'] ) ) return;

    $attrs = array(
        'class'   => $class,
        'loading' => $lazy ? 'lazy' : 'eager',
        'alt'     => !empty( $desktop['alt'] ) ? $desktop['alt'] : '',
    );

    if ( !$lazy ) {
        $attrs['fetchpriority'] = 'high';
    }

    if ( $mobile && !empty( $mobile['url'] ) ) {
        echo '<picture>';
        echo '<source media="(max-width: 991px)" srcset="' . esc_url( $mobile['url'] ) . '">';
        echo wp_get_attachment_image( $desktop['ID'], $size, false, $attrs );
        echo '</picture>';
    } else {
        echo wp_get_attachment_image( $desktop['ID'], $size, false, $attrs );
    }
}

/**
 * Retorna URL de imagem ACF com fallback.
 *
 * @param array  $image    Array ACF da imagem.
 * @param string $fallback URL de fallback (placeholder).
 * @return string
 */
function atratis_image_url( $image, $fallback = '' ) {
    if ( !empty( $image ) && !empty( $image['url'] ) ) {
        return esc_url( $image['url'] );
    }
    return $fallback ? esc_url( $fallback ) : '';
}

/**
 * Renderiza imagem como background CSS otimizado com preload.
 *
 * @param int    $image_id   ID do attachment WordPress.
 * @param string $selector   Seletor CSS do elemento.
 * @return void
 */
function atratis_bg_image_preload( $image_id, $selector ) {
    if ( !$image_id ) return;

    $src = wp_get_attachment_image_url( $image_id, 'full' );
    $srcset = wp_get_attachment_image_srcset( $image_id, 'full' );

    if ( $src ) {
        // Preload no <head> via style inline
        echo '<style>' . esc_attr($selector) . '{background-image:url(' . esc_url($src) . ')}</style>';
    }
}
```

## Uso nos Templates

### Imagem simples com lazy loading

```php
<?php
$imagem = get_sub_field('hero_imagem');
atratis_image( $imagem, 'large', true, 'hero__image' );
?>
```

### Imagem hero (above the fold, sem lazy)

```php
<?php
$imagem = get_sub_field('hero_imagem');
atratis_image( $imagem, 'full', false, 'hero__image' );
?>
```

### Imagem responsiva (desktop + mobile)

```php
<?php
$desktop = get_sub_field('banner_desktop');
$mobile  = get_sub_field('banner_mobile');
atratis_picture( $desktop, $mobile, 'full', false, 'banner__bg' );
?>
```

### URL com fallback

```php
<div style="background-image: url('<?php echo atratis_image_url($bg, get_template_directory_uri() . '/public/images/placeholder.jpg'); ?>')">
```

## Tamanhos de Imagem Customizados

Se precisar, registre tamanhos otimizados:

```php
function atratis_image_sizes() {
    add_image_size( 'card-thumb', 400, 300, true );    // Cards
    add_image_size( 'banner-desktop', 1920, 800, true ); // Banners
    add_image_size( 'banner-mobile', 768, 600, true );   // Banner mobile
}
add_action( 'after_setup_theme', 'atratis_image_sizes' );
```

## Dicas de Performance

- **WebP**: O WP 6.x suporta upload nativo. Instrua clientes a subir imagens WebP.
- **Compressão**: Recomende que imagens JPEG tenham qualidade 75-85%.
- **Dimensões máximas**: Banners desktop ≤ 1920px de largura. Logos SVG sempre que possível.
- **`wp_get_attachment_image()`** gera automaticamente `srcset` e `sizes`, o navegador escolhe a melhor versão.
