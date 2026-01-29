import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import { VideoModal } from './video-modal.js';

export function initDepoimentos() {
  console.log('Iniciando Depoimentos');

  const sliderSelector = '.swiper-depoimentos';

  // Verifica se o elemento existe
  if (!document.querySelector(sliderSelector)) return;

  // Inicializa o Swiper
  const swiper = new Swiper(sliderSelector, {
    modules: [Navigation, Pagination],
    slidesPerView: 1,
    spaceBetween: 20,
    loop: false,
    navigation: {
      nextEl: '.swiper-depoimentos-next',
      prevEl: '.swiper-depoimentos-prev',
    },
    pagination: {
      el: '.swiper-depoimentos-pagination',
      clickable: true,
    },
    watchOverflow: true,
    breakpoints: {
      // quando a largura da janela for >= 768px
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      // quando a largura da janela for >= 1024px
      1024: {
        slidesPerView: 3,
        spaceBetween: 32,
      }
    }
  });

  // Inicializa o Video Modal para os botões das seções
  VideoModal.init('.secao-depoimentos [data-video-url], .secao-video-full [data-video-url]');
}
