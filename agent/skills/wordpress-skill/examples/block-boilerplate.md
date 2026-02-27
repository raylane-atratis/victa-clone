# Boilerplate de Bloco ACF (Template Padrão)

Use este template como ponto de partida para criar qualquer novo bloco flexível.

## 1. Template PHP

`template-parts-blocos/secao_[nome].php`

```php
<?php
/**
 * Bloco: [Nome do Bloco]
 * Descrição: [Breve descrição do que o bloco faz]
 */

// Campos ACF
$titulo     = get_sub_field('[nome]_titulo');
$subtitulo  = get_sub_field('[nome]_subtitulo');
$descricao  = get_sub_field('[nome]_descricao');
$imagem     = get_sub_field('[nome]_imagem');
$lista      = get_sub_field('[nome]_lista'); // Repeater
$link       = get_sub_field('[nome]_link');

// Classes CSS condicionais
$classe_bg  = get_sub_field('[nome]_fundo_escuro') ? 'secao-[nome]--dark' : '';
?>

<section class="secao-[nome] <?php echo esc_attr($classe_bg); ?>">
    <div class="container">
        <?php if ($subtitulo) : ?>
            <span class="secao-[nome]__subtitle"><?php echo esc_html($subtitulo); ?></span>
        <?php endif; ?>

        <?php if ($titulo) : ?>
            <h2 class="secao-[nome]__title"><?php echo wp_kses_post($titulo); ?></h2>
        <?php endif; ?>

        <?php if ($descricao) : ?>
            <div class="secao-[nome]__desc"><?php echo wp_kses_post($descricao); ?></div>
        <?php endif; ?>

        <?php if ($imagem) : ?>
            <img
                src="<?php echo esc_url($imagem['url']); ?>"
                alt="<?php echo esc_attr($imagem['alt']); ?>"
                width="<?php echo esc_attr($imagem['width']); ?>"
                height="<?php echo esc_attr($imagem['height']); ?>"
                loading="lazy"
            >
        <?php endif; ?>

        <?php if ($lista) : ?>
            <div class="secao-[nome]__grid row">
                <?php foreach ($lista as $item) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="secao-[nome]__card">
                            <?php if (!empty($item['icone'])) : ?>
                                <div class="secao-[nome]__card-icon" aria-hidden="true">
                                    <?php echo wp_kses_post($item['icone']); ?>
                                </div>
                            <?php endif; ?>
                            <h3 class="secao-[nome]__card-title">
                                <?php echo esc_html($item['titulo']); ?>
                            </h3>
                            <p class="secao-[nome]__card-text">
                                <?php echo esc_html($item['texto']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($link) : ?>
            <div class="secao-[nome]__cta">
                <a href="<?php echo esc_url($link['url']); ?>"
                   class="btn btn--primary"
                   <?php echo $link['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                    <?php echo esc_html($link['title']); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
```

## 2. SCSS

`src/scss/blocks/_secao_[nome].scss`

```scss
@use "../base/variables" as *;
@use "../base/mixins" as *;

.secao-[nome] {
  padding: 60px 0;

  @include mobile {
    padding: 40px 0;
  }

  // Variante escura
  &--dark {
    background-color: $primary-color;
    color: #fff;
  }

  &__subtitle {
    display: block;
    font-family: $font-primary;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: $secondary-color;
    margin-bottom: 8px;
  }

  &__title {
    font-family: $font-heading;
    font-size: 2rem;
    font-weight: 700;
    color: $text-color-link-menu;
    margin-bottom: 16px;

    @include mobile {
      font-size: 1.5rem;
    }
  }

  &__desc {
    font-size: 1rem;
    line-height: 1.6;
    max-width: 660px;
    margin-bottom: 40px;
  }

  &__grid {
    gap: 24px 0;
  }

  &__card {
    padding: 24px;
    border-radius: 12px;
    background: #f8f8f8;
    height: 100%;
    transition: transform 0.3s ease;

    &:hover {
      transform: translateY(-4px);
    }
  }

  &__card-icon {
    width: 48px;
    height: 48px;
    margin-bottom: 16px;

    svg {
      width: 100%;
      height: 100%;
    }
  }

  &__card-title {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 8px;
  }

  &__card-text {
    font-size: 0.9375rem;
    line-height: 1.5;
  }

  &__cta {
    margin-top: 40px;
    text-align: center;
  }
}
```

## 3. Registro no `blocos.php`

```php
elseif (get_row_layout() == 'secao_[nome]' && get_sub_field('exibir')):
    get_template_part('template-parts-blocos/secao_[nome]');
```

## 4. Import no `style.scss`

```scss
@use "blocks/secao_[nome]";
```

## 5. Campos ACF

| Campo        | Tipo                 | Nome do Campo         |
| ------------ | -------------------- | --------------------- |
| Exibir       | True/False           | `exibir`              |
| Título       | Text                 | `[nome]_titulo`       |
| Subtítulo    | Text                 | `[nome]_subtitulo`    |
| Descrição    | WYSIWYG              | `[nome]_descricao`    |
| Imagem       | Image (return array) | `[nome]_imagem`       |
| Lista        | Repeater             | `[nome]_lista`        |
| ↳ Ícone      | Textarea (SVG)       | `icone`               |
| ↳ Título     | Text                 | `titulo`              |
| ↳ Texto      | Textarea             | `texto`               |
| Fundo Escuro | True/False           | `[nome]_fundo_escuro` |
| Link/CTA     | Link                 | `[nome]_link`         |
