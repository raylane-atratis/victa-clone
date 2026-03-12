# Guia de Mapeamento Visual — Figma → Design System

Este guia mostra como elementos visuais comuns no Figma se traduzem para o design system do projeto.

---

## Cores

### Mapeamento Direto

| Elemento no Figma                   | Variável SCSS              | Hex       |
| :---------------------------------- | :------------------------- | :-------- |
| Botão principal / destaque          | `$primary-color`           | `#42ce02` |
| Fundo de header / títulos escuros   | `$secondary-color`         | `#00512a` |
| Detalhes / badges                   | `$tertiary-color`          | `#c4d663` |
| Fundo claro de seção                | `$background-color`        | `#fff`    |
| Fundo alternativo (sutil)           | `$background-alt`          | `rgba(#00512a, 0.1)` |
| Superfície escura (footer, overlay) | `$surface-dark`            | `#1a1a1a` |
| Fundo do header                     | `$background-header`       | `#003f21` |
| Texto parágrafo                     | `$text-color`              | `#484d51` |
| Texto secundário / labels           | `$text-color-light`        | `#999`    |
| Títulos / headings                  | `$text-color-dark`         | `#00512a` |
| Links do menu                       | `$text-color-link-menu`    | `#1a1a1a` |

### Dica: Fundos Bicolor (Split Background)

Se o Figma mostra uma seção com metade branca e metade cinza:
```scss
background: linear-gradient(180deg, #ffffff 50%, #f5f5f5 50%);
```

---

## Tipografia

### Font Families

| Uso no Figma                     | Variável SCSS     | Fonte             |
| :------------------------------- | :---------------- | :---------------- |
| Títulos, headings grandes        | `$font-heading`   | Articulat CF      |
| Corpo, botões, labels, parágrafos| `$font-primary`   | Sora              |

### Font Weights (Articulat CF)

| Aparência no Figma | Weight | Arquivo OTF                   |
| :------------------ | :----- | :---------------------------- |
| Ultra fino          | 100    | Articulat_CF_Thin.otf         |
| Fino / leve         | 300    | Articulat_CF_Light.otf        |
| Normal              | 400    | Articulat_CF_Regular.otf      |
| Semi-negrito        | 700    | Articulat_CF_Demi_Bold.otf    |
| Extra negrito       | 800    | Articulat_CF_Extra_Bold.otf   |

### Escala Tipográfica Típica

| Elemento                  | Desktop    | Mobile     |
| :------------------------ | :--------- | :--------- |
| Título de seção (`<h2>`)  | 32–40px    | 24–28px    |
| Subtítulo (`<h3>`)        | 20–24px    | 18–20px    |
| Body / parágrafo          | 16px       | 14–16px    |
| Label / tag               | 12–14px    | 12px       |
| Botão                     | 14–16px    | 14px       |

---

## Espaçamentos

### Tokens vs Distância Visual

| Distância no Figma | Token                | Valor  |
| :------------------ | :------------------- | :----- |
| Muito pequeno       | `$spacing-xs`        | 4px    |
| Pequeno             | `$spacing-sm`        | 8px    |
| Médio               | `$spacing-md`        | 16px   |
| Confortável         | `$spacing-lg`        | 24px   |
| Grande              | `$spacing-xl`        | 40px   |
| Muito grande        | `$spacing-2xl`       | 60px   |
| Enorme              | `$spacing-3xl`       | 80px   |

### Padrão de Seção

Para paddings de seção (topo/base), use o mixin:
```scss
@include section-padding; // 60px desktop, 40px mobile
```

---

## Border Radius

| Aparência no Figma     | Token          | Valor  |
| :---------------------- | :------------- | :----- |
| Leve arredondamento     | `$radius-sm`   | 4px    |
| Arredondamento padrão   | `$radius-md`   | 8px    |
| Card arredondado        | `$radius-lg`   | 12px   |
| Card bem arredondado    | `$radius-xl`   | 20px   |
| Pílula / badge          | `$radius-pill` | 1000px |

---

## Sombras

| Aparência no Figma          | Token        |
| :--------------------------- | :----------- |
| Sombra sutil (inputs, tags)  | `$shadow-sm` |
| Sombra média (cards)         | `$shadow-md` |
| Sombra forte (cards elevados)| `$shadow-lg` |

---

## Grid — Figma Colunas → Bootstrap

| Layout no Figma                    | Classes Bootstrap                              |
| :--------------------------------- | :--------------------------------------------- |
| 1 coluna (full-width content)      | `col-12`                                       |
| 2 colunas iguais                   | `col-lg-6 col-12`                              |
| 2 colunas (1/3 + 2/3)             | `col-lg-4 col-12` + `col-lg-8 col-12`          |
| 3 colunas iguais                   | `col-lg-4 col-md-6 col-12`                     |
| 4 colunas iguais                   | `col-lg-3 col-md-6 col-12`                     |
| Sidebar (esquerda estreita)        | `col-lg-3 col-12` + `col-lg-9 col-12`          |

**Regra**: Sempre adicione `col-12` como fallback mobile.
