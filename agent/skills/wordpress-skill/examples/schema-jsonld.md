# Schema.org JSON-LD Dinâmico

Implementação de dados estruturados Schema.org para melhorar SEO e Rich Snippets no Google.

## Código no `functions.php`

```php
/**
 * ============================================================
 * SCHEMA.ORG JSON-LD - Dados Estruturados para SEO
 * ============================================================
 */

/**
 * Gera Schema.org Organization (todas as páginas).
 */
function atratis_schema_organization() {
    // Campos ACF das opções do tema
    $logo     = get_field('logo_image', 'option');
    $telefone = get_field('lista_contatos', 'option');
    $email    = get_field('email', 'option');
    $redes    = get_field('lista_de_redes', 'option');

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Organization',
        'name'        => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'url'         => home_url('/'),
    );

    // Logo
    if ($logo && !empty($logo['url'])) {
        $schema['logo'] = esc_url($logo['url']);
    }

    // Telefones
    if ($telefone && is_array($telefone)) {
        $phones = array();
        foreach ($telefone as $contato) {
            if (!empty($contato['texto'])) {
                $phones[] = $contato['texto'];
            }
        }
        if (!empty($phones)) {
            $schema['telephone'] = $phones;
        }
    }

    // Email
    if ($email) {
        $schema['email'] = sanitize_email($email);
    }

    // Redes sociais
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
 * Gera Schema.org WebPage para páginas.
 */
function atratis_schema_webpage() {
    if (!is_singular()) return;

    $schema = array(
        '@context'      => 'https://schema.org',
        '@type'         => 'WebPage',
        'name'          => get_the_title(),
        'url'           => get_permalink(),
        'datePublished' => get_the_date('c'),
        'dateModified'  => get_the_modified_date('c'),
        'isPartOf'      => array(
            '@type' => 'WebSite',
            'name'  => get_bloginfo('name'),
            'url'   => home_url('/'),
        ),
    );

    // Descrição
    if (has_excerpt()) {
        $schema['description'] = wp_strip_all_tags(get_the_excerpt());
    }

    // Imagem destacada
    if (has_post_thumbnail()) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        if ($thumb) {
            $schema['primaryImageOfPage'] = array(
                '@type'  => 'ImageObject',
                'url'    => esc_url($thumb[0]),
                'width'  => $thumb[1],
                'height' => $thumb[2],
            );
        }
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_footer', 'atratis_schema_webpage', 99);

/**
 * Gera Schema.org BreadcrumbList.
 * Nota: Se usar Yoast, ele já gera breadcrumbs. Use apenas um.
 */
function atratis_schema_breadcrumb() {
    if (is_front_page()) return;

    $items = array();
    $position = 1;

    // Home
    $items[] = array(
        '@type'    => 'ListItem',
        'position' => $position++,
        'name'     => 'Home',
        'item'     => home_url('/'),
    );

    // Página atual
    if (is_singular()) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    }

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_footer', 'atratis_schema_breadcrumb', 99);
```

## Schemas por Tipo de Negócio

### LocalBusiness (para clientes com endereço físico)

```php
function atratis_schema_local_business() {
    if (!is_front_page()) return;

    $enderecos = get_field('enderecos', 'option');

    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'LocalBusiness', // ou: Dentist, Restaurant, etc.
        'name'     => get_bloginfo('name'),
        'url'      => home_url('/'),
    );

    if ($enderecos && !empty($enderecos[0])) {
        $schema['address'] = array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $enderecos[0]['texto'] ?? '',
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
```

### FAQ (para blocos de Perguntas Frequentes)

```php
/**
 * Chamar dentro do template do bloco secao_perguntas_frequentes.php
 */
function atratis_schema_faq($perguntas) {
    if (empty($perguntas)) return;

    $faq_items = array();
    foreach ($perguntas as $p) {
        $faq_items[] = array(
            '@type'          => 'Question',
            'name'           => wp_strip_all_tags($p['pergunta']),
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => wp_strip_all_tags($p['resposta']),
            ),
        );
    }

    $schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faq_items,
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
}
```

## Validação

Após implementar, valide os dados estruturados em:

- **Google Rich Results Test**: https://search.google.com/test/rich-results
- **Schema Markup Validator**: https://validator.schema.org/

## Tipos de Schema Comuns

| Tipo de Site        | Schema Type                    |
| ------------------- | ------------------------------ |
| Empresa/Agência     | `Organization`                 |
| Clínica/Consultório | `MedicalBusiness` ou `Dentist` |
| Restaurante         | `Restaurant`                   |
| Loja Virtual        | `Store`                        |
| Blog/Notícias       | `Article` + `NewsArticle`      |
| Serviços            | `ProfessionalService`          |
| Pessoa/Profissional | `Person`                       |
