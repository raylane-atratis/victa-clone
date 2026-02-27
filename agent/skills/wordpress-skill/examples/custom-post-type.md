# Custom Post Type com Taxonomia

Modelo padrão para criar CPTs com taxonomia hierárquica no tema Atratis.

## Registro no `functions.php`

```php
/**
 * Register Custom Post Type: [NomePlural]
 */
function atratis_register_[slug]_cpt() {
    $labels = array(
        'name'               => '[NomePlural]',
        'singular_name'      => '[NomeSingular]',
        'menu_name'          => '[NomePlural]',
        'name_admin_bar'     => '[NomeSingular]',
        'add_new'            => 'Adicionar Novo',
        'add_new_item'       => 'Adicionar Novo [NomeSingular]',
        'new_item'           => 'Novo [NomeSingular]',
        'edit_item'          => 'Editar [NomeSingular]',
        'view_item'          => 'Ver [NomeSingular]',
        'all_items'          => 'Todos os [NomePlural]',
        'search_items'       => 'Pesquisar [NomePlural]',
        'not_found'          => 'Nenhum [nome] encontrado.',
        'not_found_in_trash' => 'Nenhum [nome] encontrado na lixeira.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,         // Página própria no front
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,         // Habilita Gutenberg e REST API
        'query_var'          => true,
        'rewrite'            => array( 'slug' => '[slug]', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,         // true se quiser /[slug]/ como listagem
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio', // Ver: developer.wordpress.org/resource/dashicons/
        'supports'           => array( 'title', 'thumbnail' ), // Sem 'editor' pois usa ACF
    );

    register_post_type( '[slug]', $args );
}
add_action( 'init', 'atratis_register_[slug]_cpt' );
```

## Registro de Taxonomia

```php
/**
 * Register Taxonomy: Categorias de [NomePlural]
 */
function atratis_register_[slug]_taxonomy() {
    $labels = array(
        'name'              => 'Categorias',
        'singular_name'     => 'Categoria',
        'search_items'      => 'Pesquisar Categorias',
        'all_items'         => 'Todas as Categorias',
        'parent_item'       => 'Categoria Pai',
        'parent_item_colon' => 'Categoria Pai:',
        'edit_item'         => 'Editar Categoria',
        'update_item'       => 'Atualizar Categoria',
        'add_new_item'      => 'Adicionar Nova Categoria',
        'new_item_name'     => 'Nova Categoria',
        'menu_name'         => 'Categorias',
    );

    $args = array(
        'hierarchical'      => true, // true = Categoria (checkbox), false = Tag (text input)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categoria-[slug]' ),
    );

    register_taxonomy( 'categoria_[slug]', array( '[slug]' ), $args );
}
add_action( 'init', 'atratis_register_[slug]_taxonomy' );
```

## WP_Query para Listar CPT

```php
<?php
$args = array(
    'post_type'      => '[slug]',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
    // Filtro por taxonomia (opcional):
    // 'tax_query' => array(
    //     array(
    //         'taxonomy' => 'categoria_[slug]',
    //         'field'    => 'slug',
    //         'terms'    => 'destaque',
    //     ),
    // ),
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        $imagem  = get_field('[slug]_imagem');
        $resumo  = get_field('[slug]_resumo');
?>
    <article class="card-[slug]">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium', [
                'loading' => 'lazy',
                'class'   => 'card-[slug]__image',
                'alt'     => get_the_title()
            ]); ?>
        <?php endif; ?>
        <h3 class="card-[slug]__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <?php if ($resumo) : ?>
            <p class="card-[slug]__text"><?php echo esc_html($resumo); ?></p>
        <?php endif; ?>
    </article>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
```

## Dashicons Comuns

| Ícone       | Dashicon                   |
| ----------- | -------------------------- |
| Portfólio   | `dashicons-portfolio`      |
| Imagens     | `dashicons-images-alt2`    |
| Localização | `dashicons-location-alt`   |
| Pessoas     | `dashicons-groups`         |
| Estrela     | `dashicons-star-filled`    |
| Megafone    | `dashicons-megaphone`      |
| Calendário  | `dashicons-calendar-alt`   |
| Documento   | `dashicons-media-document` |

**Lembrete:** Após registrar um CPT, vá em **Configurações > Links Permanentes** e clique em "Salvar" para limpar o cache de rewrite rules.
