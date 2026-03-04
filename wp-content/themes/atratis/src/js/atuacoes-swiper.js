import Swiper from "swiper";
import { Pagination } from "swiper/modules";
import "swiper/css/pagination";

export function initAtuacoesSwiper() {
  const el = document.querySelector(".swiper-atuacoes");
  if (!el) return;

  new Swiper(el, {
    modules: [Pagination],
    slidesPerView: 1,
    spaceBetween: 16,
    pagination: {
      el: ".swiper-atuacoes-pagination",
      type: "progressbar",
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
        spaceBetween: 24,
      },
    },
  });
}
