/**
 * Video Modal Component
 * 
 * Componente reutilizável para modal de vídeo com lazy loading.
 * O iframe só é carregado quando o modal abre.
 * 
 * Uso:
 * import { VideoModal } from './video-modal.js';
 * 
 * // Inicializa para todos os elementos com data-video-url
 * VideoModal.init();
 * 
 * // Ou abre programaticamente
 * VideoModal.open('https://www.youtube.com/watch?v=VIDEO_ID');
 */

let modalInstance = null;

/**
 * Cria a estrutura HTML do modal
 */
function createModal() {
  const modal = document.createElement('div');
  modal.className = 'video-modal';
  modal.id = 'video-modal';
  modal.innerHTML = `
    <div class="video-modal__overlay"></div>
    <div class="video-modal__content">
      <button type="button" class="video-modal__close" aria-label="Fechar modal">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
      <div class="video-modal__video">
        <div class="video-modal__loader"></div>
      </div>
    </div>
  `;
  return modal;
}

/**
 * Extrai o ID do vídeo de uma URL do YouTube
 */
function getYouTubeId(url) {
  const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
  const match = url.match(regExp);
  return (match && match[2].length === 11) ? match[2] : null;
}

/**
 * Garante que o modal existe no DOM
 */
function ensureModal() {
  if (!modalInstance) {
    modalInstance = createModal();
    document.body.appendChild(modalInstance);

    // Event listeners para fechar
    modalInstance.querySelector('.video-modal__overlay').addEventListener('click', close);
    modalInstance.querySelector('.video-modal__close').addEventListener('click', close);

    // Fechar com ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modalInstance.classList.contains('is-active')) {
        close();
      }
    });
  }
  return modalInstance;
}

/**
 * Abre o modal e carrega o iframe (lazy loading)
 */
function open(videoUrl) {
  const modal = ensureModal();
  const videoContainer = modal.querySelector('.video-modal__video');
  const videoId = getYouTubeId(videoUrl);

  if (!videoId) {
    console.error('VideoModal: ID do vídeo não encontrado:', videoUrl);
    return;
  }

  // Remove iframe anterior se existir
  const existingIframe = videoContainer.querySelector('iframe');
  if (existingIframe) {
    existingIframe.remove();
  }

  // Reset loader state
  modal.classList.remove('is-loaded');

  // Mostra o modal
  modal.classList.add('is-active');
  document.body.style.overflow = 'hidden';

  // Lazy load: cria o iframe apenas agora
  const iframe = document.createElement('iframe');
  iframe.className = 'video-modal__iframe';
  iframe.src = `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&rel=0`;
  iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
  iframe.allowFullscreen = true;
  iframe.loading = 'lazy';

  // Quando o iframe carregar, esconde o loader
  iframe.addEventListener('load', () => {
    modal.classList.add('is-loaded');
  });

  videoContainer.appendChild(iframe);
}

/**
 * Fecha o modal e remove o iframe (para parar o vídeo)
 */
function close() {
  if (!modalInstance) return;

  modalInstance.classList.remove('is-active');
  document.body.style.overflow = '';

  // Remove o iframe para parar o vídeo e liberar recursos
  setTimeout(() => {
    const iframe = modalInstance.querySelector('iframe');
    if (iframe) {
      iframe.remove();
    }
  }, 300); // Aguarda a animação de fechamento
}

/**
 * Inicializa event listeners para elementos com data-video-url
 */
function init(selector = '[data-video-url]') {
  const videoButtons = document.querySelectorAll(selector);

  if (!videoButtons.length) return;

  videoButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const videoUrl = btn.dataset.videoUrl;
      open(videoUrl);
    });
  });

  console.log(`VideoModal: Inicializado para ${videoButtons.length} elemento(s)`);
}

// Exporta como objeto para uso modular
export const VideoModal = {
  init,
  open,
  close
};

// Export default para compatibilidade
export default VideoModal;
