import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';

export function initCarroselLogos() {
  const swiperEl = document.querySelector('.swiper-logos');

  if (!swiperEl) return;

  // Verificar quantidade de slides
  const slides = swiperEl.querySelectorAll('.swiper-slide').length;
  // Ativa dots apenas se houver mais de 6 slides (conforme pedido)
  // No mobile, talvez faça sentido sempre ter dots se tiver mais que o view.
  // Mas vou seguir a regra: "se tiver mais de 6 logos ative o dots".
  const hasPagination = slides > 6;

  const swiper = new Swiper(swiperEl, {
    modules: [Pagination, Autoplay],
    slidesPerView: 2,
    spaceBetween: 20,
    loop: slides > 6, // Loop só faz sentido se tiver itens suficientes
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: hasPagination ? {
      el: '.swiper-pagination',
      clickable: true,
    } : false,
    breakpoints: {
      // Mobile landscape
      576: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      // Tablet
      768: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      // Desktop
      992: {
        slidesPerView: 5, // 5 ou 6 dependendo do design
        spaceBetween: 50,
      },
      1200: {
        slidesPerView: 6,
        spaceBetween: 50,
      }
    }
  });
}
