import Swiper from "swiper";
import { Pagination, Navigation } from "swiper/modules";

export function initProdutosSwiper() {
  const container = document.querySelector(".js-swiper-produtos");
  if (!container) return;

  const wrapper = container.closest(".linhas-produtos__slider-wrapper");

  new Swiper(container, {
    modules: [Pagination, Navigation],
    grabCursor: true,
    watchOverflow: true,
    spaceBetween: 30, // Espaço entre os cards
    slidesPerView: 1, // Padrão mobile
    
    pagination: {
      el: wrapper.querySelector(".produtos-pagination"),
      clickable: true,
    },

    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3, // Força 3 cards no desktop
      },
    },
  });
}