---
name: wordpress-skill
description: Especializado na criação de sites WordPress de alta performance usando ACF Blocks, com foco em blocos flexíveis, arquitetura limpa e otimização completa para PageSpeed 100. Use quando precisar criar ou modificar blocos ACF, post types customizados, templates ou estruturas de sites WordPress performáticos.
---

# WordPress ACF Blocks Skill

Este skill é especializado na criação de sites WordPress altamente performáticos e customizáveis usando ACF (Advanced Custom Fields) como base para construção de blocos flexíveis. O foco está em criar arquiteturas limpas, sites rápidos e com **pontuação próxima de 100 em todas as métricas do PageSpeed Insights** (Performance, Acessibilidade, Melhores Práticas e SEO).

## When to use this skill

- Use quando precisar criar novos blocos flexíveis com ACF
- Use quando precisar criar Custom Post Types personalizados
- Use quando precisar estruturar templates de categoria para blogs
- Use quando precisar otimizar performance, SEO ou acessibilidade
- Use quando precisar criar formulários de contato ou integrações
- Use quando precisar estruturar a arquitetura de um novo site WordPress

---

## Stack de Plugins

O projeto utiliza APENAS os seguintes plugins:

- **ACF (Advanced Custom Fields)**: Base para todos os blocos flexíveis
- **Contact Form 7**: Formulários de contato
- **Yoast SEO**: Otimização de SEO

O projeto utiliza APENAS as seguintes bibliotecas:

- **Bootstrap**: Base para **apenas o grid** e NADA mais que o grid
- **SCSS**: Base para a criação de estilos
- **Swiper**: Carrosséis (importação seletiva)
- **Fancybox**: Lightbox de imagens/vídeos (importação seletiva)

**Importante**: Não utilize nenhum outro plugin/lib além desses. Para lightbox de vídeo do YouTube, preferir o componente `VideoModal` customizado (ver `examples/video-modal-component.md`).

---

## Estrutura do Projeto

```
themes/atratis/
├── assets/                         # Build output (Vite)
│   ├── css/all.css                 # CSS compilado e minificado
│   └── js/script.min.js            # JS compilado e minificado
│
├── public/
│   └── images/                     # Imagens estáticas do tema (SVG, logos)
│
├── src/                            # Código-fonte (dev)
│   ├── scss/
│   │   ├── base/
│   │   │   ├── _variables.scss     # Design tokens (cores, fontes, espaçamentos)
│   │   │   ├── _mixins.scss        # Breakpoints e mixins utilitários
│   │   │   ├── _reset.scss         # Reset global + defaults acessíveis
│   │   │   ├── _bootstrap-grid.scss# Import seletivo do grid Bootstrap
│   │   │   └── _accessibility.scss # Focus styles, skip-link, sr-only
│   │   ├── components/
│   │   │   ├── _buttons.scss       # Sistema de botões (BEM)
│   │   │   ├── _video-modal.scss   # Modal de vídeo (Vanilla JS)
│   │   │   └── _tabs.scss          # Componente de tabs
│   │   ├── layout/
│   │   │   ├── _header.scss
│   │   │   ├── _footer.scss
│   │   │   └── _banner.scss
│   │   ├── blocks/                 # Estilos dos blocos ACF
│   │   │   └── _secao_*.scss
│   │   ├── pages/                  # Estilos de páginas específicas
│   │   │   └── not-found.scss
│   │   └── style.scss              # Ponto de entrada SCSS
│   └── js/
│       ├── main.js                 # Ponto de entrada JS
│       ├── menu.js                 # Navegação mobile
│       ├── banner.js               # Slider de banners
│       └── [modulo].js             # Módulos por componente
│
├── template-parts-blocos/          # Templates PHP dos blocos ACF
│   └── secao_*.php
│
├── functions.php                   # Configuração do tema
├── header.php                      # Header global
├── footer.php                      # Footer global
├── blocos.php                      # Router dos blocos flexíveis
├── page.php                        # Template de páginas
├── single.php                      # Template de posts
├── archive.php                     # Template de arquivo/blog
├── category.php                    # Template de categorias
├── 404.php                         # Template de erro 404
├── style.css                       # Metadata do tema (obrigatório WP)
├── vite.config.js                  # Configuração do Vite
└── package.json                    # Dependências npm
```

---

## Design System

### Variáveis (`_variables.scss`)

Sempre declare design tokens centralizados. Nunca use cores ou fontes hardcoded nos blocos.

```scss
// Cores
$primary-color: #5b2580;
$secondary-color: #e75012;
$tertiary-color: #931c80;
$background-color: #fff;
$text-color: #606060;
$text-color-link-menu: #1a1a1a;

// Tipografia
$font-primary: "Poppins", sans-serif;
$font-heading: "Lexend", sans-serif;
$font-size-base: 16px;

// Espaçamento
$gutter: 1rem;
```

**Regras:**

- ✅ Sempre use variáveis: `color: $primary-color;`
- ❌ Nunca hardcode: `color: #5B2580;`
- ✅ Use o mixin de breakpoint: `@include mobile { ... }`
- ❌ Nunca escreva media queries raw: `@media (max-width: 767px)`

### Mixins (`_mixins.scss`)

```scss
@mixin mobile {
  @media (max-width: 767px) {
    @content;
  }
}
@mixin tablet {
  @media (min-width: 768px) {
    @content;
  }
}
@mixin desktop {
  @media (min-width: 1024px) {
    @content;
  }
}
@mixin flex-center {
  display: flex;
  align-items: center;
  justify-content: center;
}
```

### Convenção CSS: BEM

Use BEM para componentes: `.bloco__elemento--modificador`

```scss
.card {
  &__image { ... }
  &__title { ... }
  &--highlighted { ... }
}
```

---

## Padrão de Nomenclatura ACF

Para manter a organização e evitar conflitos de variáveis, utilizamos o padrão de **"Prefixo de Contexto"**.

### 1. Opções do Tema (Global Options)

Campos acessados via `get_field('...', 'option')`.

- **Padrão:** `opt_[secao]_[campo]`
- **Exemplos:**
  - `opt_geral_whatsapp`
  - `opt_header_logo`
  - `opt_footer_copy`

### 2. Blocos Flexíveis (Flexible Content)

Campos que pertencem a um bloco específico. O nome do campo deve sempre iniciar com o nome do bloco.

- **Layout Name (Nome do Bloco):** `[nome_do_bloco]` (ex: `hero`, `depoimentos`)
- **Campos do Bloco:** `[nome_do_bloco]_[campo]`
- **Exemplos (Bloco Hero):**
  - `hero_titulo`
  - `hero_imagem`
  - `hero_link`

### Tabela de Resumo

| Contexto            | Padrão               | Exemplo             | Uso no PHP                                 |
| :------------------ | :------------------- | :------------------ | :----------------------------------------- |
| **Geral / Header**  | `opt_header_[nome]`  | `opt_header_logo`   | `get_field('opt_header_logo', 'option')`   |
| **Geral / Contato** | `opt_contato_[nome]` | `opt_contato_email` | `get_field('opt_contato_email', 'option')` |
| **Bloco Hero**      | `hero_[nome]`        | `hero_titulo`       | `get_sub_field('hero_titulo')`             |

---

## 🚀 Regras de Performance (PageSpeed 100)

### Critical Rendering Path

1.  **Google Fonts**: Sempre usar `preconnect` antes do enqueue:

    ```php
    // Em functions.php, prioridade 1
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    ```

2.  **Defer JS**: Todo JavaScript deve ter `defer` ou `type="module"`:

    ```php
    function atratis_defer_scripts( $tag, $handle ) {
        $defer_scripts = array( 'atratis-script' );
        if ( in_array( $handle, $defer_scripts ) ) {
            return str_replace( ' src', ' defer src', $tag );
        }
        return $tag;
    }
    ```

3.  **CSS Minificado**: O Vite gera `assets/css/all.css` já minificado. Nunca enfileire CSS adicional inline sem necessidade.

4.  **Versionamento por filemtime**: Sempre use `filemtime()` para cache busting:
    ```php
    wp_enqueue_style( 'atratis-main', $uri . '/assets/css/all.css', array(), filemtime($path) );
    ```

### Imagens (LCP & CLS)

5.  **Sempre declare `width` e `height`** em todas as `<img>` para evitar CLS:

    ```html
    <img src="logo.svg" alt="Logo" width="213" height="100" />
    ```

6.  **`loading="eager"`** apenas para imagens above-the-fold (logo, banner hero). Todas as outras: `loading="lazy"`.

    ```php
    // Banner/Logo (above the fold)
    <img src="..." loading="eager" fetchpriority="high" alt="...">
    // Restante (below the fold)
    <img src="..." loading="lazy" alt="...">
    ```

7.  **Use `<picture>` para imagens responsivas** com versão mobile:

    ```php
    <picture>
        <source media="(max-width: 991px)" srcset="<?php echo esc_url($img_mobile); ?>">
        <?php echo wp_get_attachment_image($id, 'full', false, ['loading' => 'eager']); ?>
    </picture>
    ```

8.  **Prefira SVG inline** para ícones (evita request HTTP adicional). Use `wp_kses_post()` para sanitizar SVG do ACF.

9.  **Formatos modernos**: O WordPress 6.x já suporta WebP nativo. Instrua clientes a enviar WebP ou use plugin de otimização.

### Limpeza do `<head>`

10. **Remover bloat do WordPress** no `functions.php`:

    ```php
    // Remove emoji scripts/styles
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    // Remove wp-embed
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    // Remove wlwmanifest
    remove_action('wp_head', 'wlwmanifest_link');
    // Remove WP version
    remove_action('wp_head', 'wp_generator');
    // Remove REST API link
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    // Remove feed links
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    ```

11. **Desabilitar Gutenberg CSS** nas páginas que não usam blocos (manter nos posts do blog):

    ```php
    function atratis_remove_block_css() {
        // Preserva estilos do Gutenberg em posts do blog
        if ( is_singular('post') ) return;

        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');
    }
    add_action('wp_enqueue_scripts', 'atratis_remove_block_css', 100);
    ```

12. **Desabilitar jQuery** se não for necessário:
    ```php
    function atratis_remove_jquery() {
        if (!is_admin()) {
            wp_deregister_script('jquery');
        }
    }
    add_action('wp_enqueue_scripts', 'atratis_remove_jquery');
    ```

### Swiper & Fancybox

13. **Import seletivo** — apenas o necessário:

    ```js
    import Swiper from "swiper"; // Core apenas (sem módulos extras)
    import "swiper/css"; // Apenas CSS base
    ```

14. **Considerar CSS-only para carrosséis simples**: Se o carrossel é simples (logos infinito), considere usar `@keyframes` em vez de Swiper.

---

## ♿ Regras de Acessibilidade (Score 100)

### Estrutura Semântica

1.  **Um único `<h1>` por página**: No template `page.php`, `single.php`, etc., garanta que apenas o título principal tenha `<h1>`. Subtítulos devem seguir hierarquia (`<h2>`, `<h3>`, etc.).

2.  **Landmarks semânticos**: `<header>`, `<nav>`, `<main>`, `<section>`, `<footer>`. Sempre use `<main>` para o conteúdo principal:

    ```php
    <main id="main-content" role="main">
        <?php the_content(); ?>
    </main>
    ```

3.  **Skip Link**: Primeiro elemento do `<body>`:
    ```php
    <a class="skip-link screen-reader-text" href="#main-content">
        Pular para o conteúdo
    </a>
    ```

### ARIA e Interação

4.  **Botão de menu mobile**: Sempre com `aria-controls`, `aria-expanded` e `aria-label`:

    ```html
    <button
      class="menu-toggle"
      aria-controls="primary-menu"
      aria-expanded="false"
      aria-label="Abrir menu"
    ></button>
    ```

5.  **Links externos**: Sempre com `target="_blank" rel="noopener noreferrer"` e `aria-label` descritivo.

6.  **Imagens**: Toda `<img>` deve ter `alt` descritivo. Ícones decorativos: `alt=""` ou `aria-hidden="true"`.

7.  **Links de redes sociais**: Sempre com `aria-label` (o ícone SVG sozinho não é acessível):
    ```html
    <a href="..." aria-label="Siga no Instagram">
      <svg aria-hidden="true">...</svg>
    </a>
    ```

### Foco e Navegação por Teclado

8.  **Focus visible**: Nunca remova `outline` sem substituir por um estilo alternativo:

    ```scss
    // _accessibility.scss
    :focus-visible {
      outline: 3px solid $primary-color;
      outline-offset: 2px;
    }
    ```

9.  **Screen Reader Only** (classe utilitária):
    ```scss
    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }
    ```

### Contraste e Legibilidade

10. **Ratio mínimo**: Texto normal ≥ 4.5:1, texto grande ≥ 3:1 (WCAG AA).
11. **Tamanho mínimo de toque**: Botões e links interativos ≥ 44x44px em mobile.

---

## 🔍 Regras de SEO (Score 100)

### Meta Tags

1.  **`title-tag`**: Já suportado via `add_theme_support('title-tag')`. O Yoast SEO gerencia.

2.  **Viewport**: Sempre presente no `<head>`:

    ```html
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    ```

3.  **Charset**: `<meta charset="UTF-8">` como primeiro elemento do `<head>`.

4.  **Canonical**: Gerenciado pelo Yoast SEO automaticamente.

### Dados Estruturados (Schema.org)

5.  **JSON-LD no footer**: Para cada tipo de site, adicione Schema.org dinâmico:
    ```php
    function atratis_schema_organization() {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => get_bloginfo('name'),
            'url'      => home_url('/'),
            'logo'     => get_template_directory_uri() . '/public/images/Logo-Full.svg',
        );
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
    add_action('wp_footer', 'atratis_schema_organization');
    ```

### Heading Hierarchy

6.  **Nunca pule níveis**: `<h1>` → `<h2>` → `<h3>`. Nunca `<h1>` → `<h4>`.
7.  **Blocos ACF**: Use `<h2>` para títulos de seção e `<h3>` para sub-itens dentro do bloco.

### Links e Navegação

8.  **Links descritivos**: Nunca use "Clique aqui". Use texto que descreva o destino.
9.  **Breadcrumbs**: Use `yoast_breadcrumb()` em páginas internas para melhorar a navegação e SEO.

---

## ✅ Melhores Práticas (Score 100)

### Segurança no PHP

1.  **Escaping de output**: Sempre escape dados dinâmicos:
    - URLs: `esc_url()`
    - Atributos HTML: `esc_attr()`
    - Texto: `esc_html()`
    - HTML permitido: `wp_kses_post()`
    - JSON: `wp_json_encode()`

2.  **Sanitização de SVG do ACF**: Ao exibir SVGs de campos ACF (ex: redes sociais), use:

    ```php
    <?php echo wp_kses($rede['svg'], array(
        'svg'  => array('*' => true),
        'path' => array('*' => true),
        'g'    => array('*' => true),
    )); ?>
    ```

3.  **Nonces**: Para formulários e AJAX, sempre use `wp_nonce_field()` e `wp_verify_nonce()`.

### HTTPS e Segurança

4.  **Todas as URLs externas devem ser HTTPS**: Google Fonts, CDNs, etc.
5.  **Links externos**: `rel="noopener noreferrer"` em todos os `target="_blank"`.

### Console Limpo

6.  **Nenhum `console.log` em produção**: Remova antes do deploy.
7.  **Nenhum erro JS no console**: Teste todos os módulos.

---

## 📋 Checklist para Criar um Novo Bloco ACF

Ao criar qualquer bloco flexível novo, siga este checklist:

### 1. PHP Template (`template-parts-blocos/secao_[nome].php`)

- [ ] Usar `get_sub_field()` para campos do bloco
- [ ] Verificar existência com `if ($campo):` antes de renderizar
- [ ] Escapar todos os outputs (`esc_html`, `esc_url`, `esc_attr`, `wp_kses_post`)
- [ ] Hierarquia de headings correta (`<h2>` para título da seção)
- [ ] `loading="lazy"` em imagens below-the-fold
- [ ] `width` e `height` em todas as `<img>`
- [ ] `alt` descritivo em todas as `<img>`
- [ ] Usar tag semântica `<section>` com classe descritiva

### 2. SCSS (`src/scss/blocks/_secao_[nome].scss`)

- [ ] Importar `variables` e `mixins` no topo
- [ ] Usar variáveis para cores e fontes
- [ ] Usar mixins para breakpoints (`@include mobile`, `@include desktop`)
- [ ] Mobile-first: base styles + `@include tablet`/`@include desktop`
- [ ] Classe raiz: `.secao-[nome]`

### 3. JS (se necessário: `src/js/[nome].js`)

- [ ] Export function `init[Nome]()`
- [ ] Guard clause: `if (!element) return;` no topo
- [ ] Import e init no `main.js`
- [ ] Sem dependências externas quando possível (Vanilla JS)

### 4. Registro (`blocos.php`)

- [ ] Adicionar `elseif` com `get_row_layout()` e `get_sub_field('exibir')`
- [ ] Import do SCSS em `style.scss`

### 5. ACF Fields

- [ ] Campo `exibir` (True/False) para toggle de visibilidade
- [ ] Nomenclatura: `[nome_bloco]_[campo]`
- [ ] Grupo organizado dentro do Flexible Content `campos_flexiveis`

---

## Modelos de Referências

Consultar os exemplos em `agent/skills/wordpress-skill/examples/`:

- `custom-search-filter.md` — Filtro de busca customizado com autocomplete
- `video-modal-component.md` — Modal de vídeo com lazy loading (zero load impact)
- `block-boilerplate.md` — Template padrão para criar novos blocos ACF
- `custom-post-type.md` — Criação de CPT com taxonomia
- `image-helpers.md` — Helpers PHP para imagens otimizadas (WebP, srcset, lazy)
- `schema-jsonld.md` — Schema.org JSON-LD dinâmico por tipo de página
