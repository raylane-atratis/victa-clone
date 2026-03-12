---
name: figma-to-code
description: Especializado em interpretar capturas de tela do Figma e traduzir fielmente em código PHP, SCSS e JS, respeitando todas as convenções da wordpress-skill. Use sempre que receber uma screenshot do Figma para criar ou ajustar seções do site.
---

# Figma-to-Code Skill

Esta skill transforma capturas de tela do Figma em código de produção (PHP + SCSS + JS) com alta fidelidade visual, sempre seguindo as regras definidas na `wordpress-skill`.

## When to use this skill

- Quando o usuário envia uma **captura de tela ou imagem do Figma**
- Quando o usuário pede para **replicar um layout** baseado em referência visual
- Quando o usuário pede para **ajustar um bloco** para ficar igual ao Figma

> **Dependência obrigatória**: Antes de usar esta skill, sempre leia a `wordpress-skill/SKILL.md` para garantir que o código gerado respeita 100% as práticas do projeto.

---

## Workflow Completo

### Fase 1: Análise Visual da Screenshot

Ao receber uma captura de tela do Figma, siga esta ordem de análise:

#### 1.1 Estrutura e Layout

- Identifique as **seções** visíveis (cada bloco horizontal distinto)
- Identifique o **grid**: quantas colunas? Full-width ou container?
- Mapeie para o grid Bootstrap já usado no projeto (`col-lg-*`, `col-md-*`, `col-12`)
- Identifique se há **sobreposição de elementos** (position absolute/relative)
- Identifique **alinhamentos**: flex, centralizado, space-between, etc.

#### 1.2 Cores

Extraia cada cor visível e mapeie para as variáveis existentes em `_variables.scss`:

| Cor no Figma         | Variável SCSS              |
| :------------------- | :------------------------- |
| Verde claro (#42ce02)| `$primary-color`           |
| Verde escuro (#00512a)| `$secondary-color`        |
| Verde lima (#c4d663) | `$tertiary-color`          |
| Branco (#fff)        | `$background-color`        |
| Cinza texto (#484d51)| `$text-color`              |
| Escuro (#1a1a1a)     | `$text-color-link-menu`    |
| Verde escuro (#00512a)| `$text-color-dark`        |

**Regra**: Se a cor não corresponde a nenhuma variável existente:
1. Verifique se é uma tonalidade próxima (pode ser a mesma variável)
2. Se for realmente uma cor nova usada em múltiplos lugares, sugira ao usuário adicioná-la em `_variables.scss`
3. Se for usada apenas em um lugar, use a cor diretamente com um comentário `// Cor específica do Figma`

#### 1.3 Tipografia

Identifique para cada texto:

- **Font-family**: Mapear para `$font-primary` (Sora) ou `$font-heading` (Articulat CF)
- **Font-weight**: 100 (Thin), 300 (Light), 400 (Regular), 700 (Demi Bold), 800 (Extra Bold)
- **Font-size**: Anotar em `px`, converter se necessário
- **Line-height**: Anotar a proporção
- **Cor do texto**: Mapear para variáveis
- **text-transform**: uppercase, capitalize, etc.

**Regra geral do projeto**:
- Títulos de seção (`<h2>`) → `$font-heading` (Articulat CF)
- Corpo de texto, botões, labels → `$font-primary` (Sora)

#### 1.4 Espaçamentos

Mapeie distâncias visuais para os tokens de espaçamento:

| Distância aprox. | Token SCSS       |
| :--------------- | :--------------- |
| ~4px             | `$spacing-xs`    |
| ~8px             | `$spacing-sm`    |
| ~16px            | `$spacing-md`    |
| ~24px            | `$spacing-lg`    |
| ~40px            | `$spacing-xl`    |
| ~60px            | `$spacing-2xl`   |
| ~80px            | `$spacing-3xl`   |

**Regra**: Para paddings de seção, use o mixin `@include section-padding` quando o padrão for ~60px desktop / ~40px mobile.

#### 1.5 Componentes e Estados

- Identifique **botões** e seu estilo (primário, secundário, outline)
- Identifique **cards** e sua estrutura interna
- Identifique **imagens**: decorativas (lazy) ou hero (eager)
- Identifique **ícones SVG**: inline ou imagem?
- Identifique **estados de hover** se indicados visualmente
- Identifique **animações de scroll** se houver indicações

#### 1.6 Responsividade

Se a screenshot mostra apenas desktop:
- Planeje a versão mobile aplicando **mobile-first** mentality
- Colunas de grid empilham verticalmente em mobile
- Fontes reduzem ~20-25% em mobile
- Espaçamentos reduzem um nível (ex: `$spacing-2xl` → `$spacing-xl`)
- Elementos decorativos podem ser escondidos em mobile (`d-none d-lg-block`)

Se o usuário fornecer screenshots de desktop E mobile, analise ambas.

---

### Fase 2: Geração de Código

#### 2.1 Template PHP

Caminho: `template-parts-blocos/secao_[nome].php`

```php
<?php
/**
 * Block: [Nome do Bloco] 
 * Descrição: [O que a seção faz, baseado no Figma]
 */

// 1. Configurações Gerais (espaçamentos e backgrounds do ACF)
include 'conf_gerais.php';

// 2. Campos Específicos do Bloco
$titulo    = get_sub_field('[nome]_titulo');
$descricao = get_sub_field('[nome]_descricao');
// ... demais campos

$classe_extra = get_sub_field('classe');
?>

<section class="secao-[nome] <?php echo esc_attr($classe_extra); ?>" style="<?php echo esc_attr($geraisCSS); ?>">
    <div class="container">
        <!-- Estrutura baseada no layout do Figma -->
    </div>
</section>
```

**Regras obrigatórias do PHP**:
- ✅ Sempre incluir `conf_gerais.php` no topo
- ✅ Aplicar `$geraisCSS` no style da `<section>`
- ✅ Aplicar `$classe_extra` nas classes da `<section>`
- ✅ Escapar TUDO: `esc_html()`, `esc_url()`, `esc_attr()`, `wp_kses_post()`
- ✅ Verificar existência com `if ($campo) :` antes de renderizar
- ✅ `<h2>` para títulos de seção, `<h3>` para sub-itens
- ✅ `loading="lazy"` em imagens below-the-fold
- ✅ `width` e `height` em todas as `<img>`
- ✅ `alt` descritivo em todas as `<img>`
- ✅ Usar `<section>` com classe BEM `.secao-[nome]`
- ✅ Grid Bootstrap para layout: `row`, `col-lg-*`, `col-md-*`, `col-12`

#### 2.2 SCSS

Caminho: `src/scss/blocks/_secao_[nome].scss`

```scss
@use "../base/variables" as *;
@use "../base/mixins" as *;

.secao-[nome] {
  @include section-padding;

  &__titulo {
    font-family: $font-heading;
    font-size: 2rem;
    font-weight: 700;
    color: $text-color-dark;
    margin-bottom: $spacing-lg;

    @include mobile {
      font-size: 1.5rem;
    }
  }

  // ... demais elementos BEM
}
```

**Regras obrigatórias do SCSS**:
- ✅ `@use "../base/variables" as *;` e `@use "../base/mixins" as *;` no topo
- ✅ Usar APENAS variáveis — nunca hardcodar cores, fontes ou espaçamentos
- ✅ BEM: `.secao-[nome]__elemento--modificador`
- ✅ Mobile-first: estilos base + `@include tablet`/`@include desktop`
- ✅ Usar mixins de breakpoint: `@include mobile { }`, `@include desktop { }`
- ✅ Nunca escrever media queries raw
- ✅ Usar tokens de espaçamento: `$spacing-md`, `$spacing-lg`, etc.
- ✅ Usar tokens de border-radius: `$radius-sm`, `$radius-lg`, etc.
- ✅ Usar tokens de shadow: `$shadow-sm`, `$shadow-md`, `$shadow-lg`
- ✅ Usar tokens de transition: `$transition-fast`, `$transition-base`

#### 2.3 JavaScript (quando necessário)

Caminho: `src/js/[nome].js`

Somente criar JS se o bloco precisar de:
- Carrossel (Swiper)
- Modal de vídeo
- Tabs interativas
- Accordion customizado
- Animações complexas (além de `animate-on-scroll`)

```js
// src/js/[nome].js
export function init[Nome]() {
  const element = document.querySelector('.secao-[nome]');
  if (!element) return;

  // Lógica aqui
}
```

E registrar no `main.js`:
```js
import { init[Nome] } from './[nome].js';
init[Nome]();
```

#### 2.4 Integração

Após gerar os arquivos, **sempre** completar a integração:

1. **`blocos.php`** — Adicionar o `elseif`:
```php
elseif (get_row_layout() == 'secao_[nome]' && get_sub_field('exibir')):
    get_template_part('template-parts-blocos/secao_[nome]');
```

2. **`src/scss/style.scss`** — Adicionar o import:
```scss
@use "blocks/secao_[nome]";
```

3. **Campos ACF** — Listar os campos necessários para o usuário criar no admin:

| Campo        | Tipo          | Nome ACF           |
| :----------- | :------------ | :----------------- |
| Exibir       | True/False    | `exibir`           |
| Classe Extra | Text          | `classe`           |
| Título       | Text          | `[nome]_titulo`    |
| ...          | ...           | `[nome]_[campo]`   |

---

### Fase 3: Checklist de Fidelidade

Antes de entregar o código, verificar:

#### Visual
- [ ] As cores correspondem ao Figma (via variáveis)?
- [ ] A tipografia está correta (family, weight, size)?
- [ ] Os espaçamentos estão proporcionais ao Figma?
- [ ] O layout de grid está correto (colunas, gaps)?
- [ ] Os border-radius estão corretos?
- [ ] As sombras estão corretas?

#### Código
- [ ] PHP segue o boilerplate (`conf_gerais.php`, escaping, ACF)?
- [ ] SCSS usa apenas variáveis e mixins do design system?
- [ ] BEM está consistente?
- [ ] Responsividade foi planejada?
- [ ] Registrado em `blocos.php`?
- [ ] Import adicionado em `style.scss`?

#### Performance & Acessibilidade
- [ ] Imagens têm `width`, `height`, `alt`?
- [ ] `loading="lazy"` em imagens below-the-fold?
- [ ] Heading hierarchy correta (`<h2>` → `<h3>`)?
- [ ] Links com `aria-label` quando apenas ícone?
- [ ] SVGs decorativos com `aria-hidden="true"`?

---

## Padrões Comuns do Figma → Código

### Seção com título + grid de cards

```
Figma: Título centralizado + 3 cards lado a lado
→ PHP: container > h2 + row > col-lg-4 * 3 > cards
→ SCSS: section-padding + BEM cards + hover-lift
```

### Seção com imagem + texto lado a lado

```
Figma: Imagem à esquerda, texto à direita (50/50)
→ PHP: container > row > col-lg-6 (img) + col-lg-6 (texto)
→ SCSS: section-padding + align-items-center no row
→ Mobile: colunas empilham (col-12)
```

### Seção com background escuro

```
Figma: Fundo verde escuro com texto branco
→ PHP: section style="$geraisCSS" (via conf_gerais.php) ou classe --dark
→ SCSS: background via variável + color: #fff nos filhos
```

### Seção com carrossel

```
Figma: Múltiplos itens com setas de navegação
→ PHP: div.swiper > div.swiper-wrapper > div.swiper-slide * N
→ JS: import Swiper + inicializar com breakpoints
→ SCSS: dimensões dos slides + estilos dos controles
```

### Background degradê partido (metade/metade)

```
Figma: Metade superior branca, metade inferior cinza
→ SCSS: background: linear-gradient(180deg, #fff 50%, #f5f5f5 50%);
```

---

## Referência Cruzada

| Tópico                  | Arquivo de Referência                                     |
| :---------------------- | :-------------------------------------------------------- |
| Convenções de código    | `agent/skills/wordpress-skill/SKILL.md`                   |
| Boilerplate de bloco    | `agent/skills/wordpress-skill/examples/block-boilerplate.md` |
| Design tokens (cores)   | `src/scss/base/_variables.scss`                           |
| Mixins (breakpoints)    | `src/scss/base/_mixins.scss`                              |
| Configuração geral ACF  | `template-parts-blocos/conf_gerais.php`                   |
| Router de blocos        | `blocos.php`                                              |
