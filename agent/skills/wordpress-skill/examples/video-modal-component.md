# Componente Video Modal (Lazy Loading)

## Visão Geral
Este componente implementa um modal de vídeo focado em performance e Core Web Vitals. Diferente de bibliotecas comuns como Fancybox ou Lightbox, este componente **não carrega nenhum recurso do YouTube (iframe, scripts)** até que o usuário solicite explicitamente a abertura do vídeo.

### Características Principais
*   **Zero Load Impact**: O iframe só é injetado no DOM ao abrir o modal.
*   **Privacy-First**: Utiliza `youtube-nocookie.com`.
*   **Auto-Cleanup**: O iframe é removido do DOM ao fechar o modal, parando o vídeo instantaneamente e liberando memória.
*   **Design Moderno**: Efeito glassmorphism e animações suaves.
*   **Sem Dependências**: Vanilla JS puro (não requer jQuery ou plugins externos).

## Estrutura de Arquivos

*   **JS**: `src/js/video-modal.js`
*   **SCSS**: `src/scss/components/_video-modal.scss`

## Instalação

### 1. Importar Estilos (SCSS)
Adicione ao seu arquivo principal `style.scss`:

```scss
@use 'components/video-modal';
```

### 2. Importar Script (JS)
No seu arquivo de entrada ou módulo específico:

```javascript
import { VideoModal } from './video-modal.js';

// Opção A: Inicialização Automática (Recomendado)
// Busca todos os elementos com data-video-url e adiciona click listeners
document.addEventListener('DOMContentLoaded', () => {
    VideoModal.init(); 
});
```

## Como Usar (HTML)

Basta adicionar o atributo `data-video-url` a qualquer botão ou link. O componente extrai automaticamente o ID do vídeo do YouTube.

```html
<!-- Exemplo Básico -->
<button type="button" data-video-url="https://www.youtube.com/watch?v=D0UnqGm_miA">
    Assistir Vídeo
</button>

<!-- Exemplo com Estilização -->
<button class="btn-play" data-video-url="https://youtu.be/D0UnqGm_miA">
    <svg>...</svg>
    Ver Depoimento
</button>
```

Formatos de URL Suportados:
*   `https://www.youtube.com/watch?v=ID`
*   `https://youtu.be/ID`
*   `https://www.youtube.com/embed/ID`

## API JavaScript

O componente também expõe métodos para controle programático:

```javascript
import { VideoModal } from './video-modal.js';

// Inicializa seletores customizados
VideoModal.init('.minha-classe-customizada'); 

// Abre um vídeo manualmente
VideoModal.open('https://www.youtube.com/watch?v=VIDEO_ID');

// Fecha o modal
VideoModal.close();
```

## Hooks de CSS

O modal utiliza a classe `.is-active` para controlar a visibilidade e `.is-loaded` para controlar o spinner de carregamento.

```scss
// Personalização básica (exemplo)
.video-modal {
    &__overlay {
        background: rgba(0,0,0, 0.9); // Alterar opacidade do fundo
    }
    
    &__content {
        border-radius: 8px; // Alterar bordas
    }
}
```
