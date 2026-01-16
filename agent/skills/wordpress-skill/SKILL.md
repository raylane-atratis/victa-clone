---
name: wordpress-skill
description: Especializado na criação de sites WordPress de alta performance usando ACF Blocks, com foco em blocos flexíveis, arquitetura limpa e otimização completa. Use quando precisar criar ou modificar blocos ACF, post types customizados, templates ou estruturas de sites WordPress performáticos.
---

# WordPress ACF Blocks Skill

Este skill é especializado na criação de sites WordPress altamente performáticos e customizáveis usando ACF (Advanced Custom Fields) como base para construção de blocos flexíveis. O foco está em criar arquiteturas limpas, sites rápidos e com excelente pontuação no PageSpeed Insights.

## When to use this skill

- Use quando precisar criar novos blocos flexíveis com ACF
- Use quando precisar criar Custom Post Types personalizados
- Use quando precisar estruturar templates de categoria para blogs
- Use quando precisar otimizar performance, SEO ou acessibilidade
- Use quando precisar criar formulários de contato ou integrações
- Use quando precisar estruturar a arquitetura de um novo site WordPress

## Stack de Plugins

O projeto utiliza APENAS os seguintes plugins:
- **ACF (Advanced Custom Fields)**: Base para todos os blocos flexíveis
- **Contact Form 7**: Formulários de contato
- **Yoast SEO**: Otimização de SEO

O projeto utiliza APENAS os seguintes bibliotecas:
- **Bootstrap**: Base para apenas o grid e NADA Mais que o grid
- **Scss**: Base para a criação de estilos


**Importante**: Não utilize nenhum outro plugin além desses três.

## Estrutura do Projeto

themes/
├── atratis/
│   ├── assets/
│   │   ├── css/
│   │   │   ├──── all.css
│   │   └── js/
│   │   │   ├──── script.min.js
│   ├── src/
│   │   ├── scss/
│   │   │   ├──── base/
│   │   │   │   ├──── _variables.scss
│   │   │   │   ├──── _mixins.scss
│   │   │   │   ├──── _reset.scss
│   │   │   ├──── components/
│   │   │   │   ├──── _buttons.scss
│   │   │   │   ├──── _cards.scss
│   │   │   │   ├──── _forms.scss
│   │   │   ├──── layout/
│   │   │   │   ├──── _header.scss
│   │   │   │   ├──── _footer.scss
│   │   │   │   ├──── _sidebar.scss
│   │   │   ├───│ blocks/
│   │   │   │   ├──── block-hero.scss
│   │   │   │   ├──── block-content.scss
│   │   │   │   ├──── block-testimonials.scss
│   │   ├── js/
│   │   │   ├──── main.js
│   ├── template-parts-blocks/
│   │   ├──── block-hero.php
│   │   ├──── block-content.php
│   │   ├──── block-testimonials.php
│   ├── functions.php
│   ├── index.php
│   ├── style.css
│   └── header.php
│   └── footer.php
│   └── sidebar.php
│   └── single.php
│   └── page.php
│   └── archive.php
│   └── search.php
│   └── 404.php
│   └── functions.php
│   

## Modelos de Referências


## Padrão de Nomenclatura ACF

Para manter a organização e evitar conflitos de variáveis, utilizamos o padrão de **"Prefixo de Contexto"**.

### 1. Opções do Tema (Global Options)

Campos acessados via `get_field('...', 'option')`.
*   **Padrão:** `opt_[secao]_[campo]`
*   **Exemplos:**
    *   `opt_geral_whatsapp`
    *   `opt_header_logo`
    *   `opt_footer_copy`

### 2. Blocos Flexíveis (Flexible Content)

Campos que pertencem a um bloco específico. O nome do campo deve sempre iniciar com o nome do bloco.
*   **Layout Name (Nome do Bloco):** `[nome_do_bloco]` (ex: `hero`, `depoimentos`)
*   **Campos do Bloco:** `[nome_do_bloco]_[campo]`
*   **Exemplos (Bloco Hero):**
    *   `hero_titulo`
    *   `hero_imagem`
    *   `hero_link`

### Tabela de Resumo

| Contexto | Padrão | Exemplo | Uso no PHP |
| :--- | :--- | :--- | :--- |
| **Geral / Header** | `opt_header_[nome]` | `opt_header_logo` | `get_field('opt_header_logo', 'option')` |
| **Geral / Contato** | `opt_contato_[nome]` | `opt_contato_email` | `get_field('opt_contato_email', 'option')` |
| **Bloco Hero** | `hero_[nome]` | `hero_titulo` | `get_sub_field('hero_titulo')` |


