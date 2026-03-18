<?php
/**
 * O template para exibir a barra lateral (Sidebar) do Blog
 * Refatorado seguindo as boas práticas do SKILL.md (BEM, Escaping, Acessibilidade)
 */
?>

<aside class="sidebar">
    
    <!-- 1. Pesquisa -->
    <div class="sidebar__section sidebar__search">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="search-form__wrapper">
                <input 
                    type="search" 
                    id="s" 
                    name="s" 
                    class="search-form__input" 
                    placeholder="<?php echo esc_attr_x('Pesquisar...', 'placeholder', 'atratis'); ?>" 
                    value="<?php echo get_search_query(); ?>" 
                    aria-label="<?php esc_attr_e('Pesquisar por:', 'atratis'); ?>"
                    required
                />
                <button type="submit" class="search-form__submit" aria-label="<?php esc_attr_e('Ir', 'atratis'); ?>">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M17.8535 19.6523L14.7701 16.5625C13.7657 15.556 12.1651 15.5139 10.827 15.9949C10.0063 16.29 9.133 16.4375 8.20707 16.4375C5.9133 16.4375 3.97222 15.6422 2.38384 14.0515C0.794613 12.46 0 10.5158 0 8.21874C0 5.92171 0.794613 3.97745 2.38384 2.38597C3.97222 0.795322 5.9133 0 8.20707 0C10.5008 0 12.4423 0.795322 14.0316 2.38597C15.6199 3.97745 16.4141 5.92171 16.4141 8.21874C16.4141 9.14599 16.2668 10.0205 15.9722 10.8424C15.4916 12.1831 15.5331 13.7855 16.5391 14.7936L19.6528 17.9137C19.8843 18.1455 20 18.43 20 18.7672C20 19.1044 19.8737 19.3994 19.6212 19.6523C19.3897 19.8841 19.0951 20 18.7374 20C18.3796 20 18.085 19.8841 17.8535 19.6523ZM8.20707 13.9086C9.78535 13.9086 11.1271 13.3557 12.2323 12.2497C13.3367 11.1429 13.8889 9.79927 13.8889 8.21874C13.8889 6.63822 13.3367 5.29456 12.2323 4.18777C11.1271 3.08182 9.78535 2.52884 8.20707 2.52884C6.62879 2.52884 5.28704 3.08182 4.18182 4.18777C3.07744 5.29456 2.52525 6.63822 2.52525 8.21874C2.52525 9.79927 3.07744 11.1429 4.18182 12.2497C5.28704 13.3557 6.62879 13.9086 8.20707 13.9086Z" fill="currentColor" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- 2. Navegação Categoria -->
    <?php
    // Usando get_term_by ao invés de get_cat_ID para garantir versatilidade
    $blog_category = get_term_by('name', 'Blog', 'category');

    if ($blog_category) {
        $args = array(
            'child_of' => $blog_category->term_id,
            'hide_empty' => true, // Boa prática: não exibir abas vazias onde o loop irá falhar
        );
        $subcategories = get_categories($args);

        if (!empty($subcategories)): ?>
                    <div class="sidebar__section sidebar__nav">
                        <h3 class="sidebar__title"><?php esc_html_e('Navegue por:', 'atratis'); ?></h3>
                        <ul class="sidebar__list">
                            <?php foreach ($subcategories as $subcategory):
                                $is_current_category = is_category($subcategory->term_id);
                                // Atribuição condicional de modificador BEM (--active)
                                $item_class = 'sidebar__item' . ($is_current_category ? ' sidebar__item--active' : '');
                                ?>
                                    <li class="<?php echo esc_attr($item_class); ?>">
                                        <a href="<?php echo esc_url(get_category_link($subcategory->term_id)); ?>" class="sidebar__link">
                                            <?php echo esc_html($subcategory->name); ?>
                                        </a>
                                    </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
            <?php endif;
    } ?>

    <!-- 3. Newsletter Custom Form -->
    <div class="sidebar__section sidebar__newsletter">
        <h3 class="sidebar__title"><?php esc_html_e('Cadastre-se e receba novidades', 'atratis'); ?></h3>
        <p class="sidebar__text"><?php esc_html_e('Fique por dentro das novidades', 'atratis'); ?></p>

        <div class="sidebar__form">
            <?php echo do_shortcode('[contact-form-7 id="8d0aa93" title="Formulário de Newsletter Blog"]'); ?>
        </div>
    </div>

</aside>
