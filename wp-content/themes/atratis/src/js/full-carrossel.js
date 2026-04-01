import Swiper from "swiper";
import { Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";

export function initFullCarrossel() {
  const el = document.querySelector(".swiper-full-carrossel");
  if (!el) return;

  new Swiper(el, {
    modules: [Pagination],
    slidesPerView: 1.2,
    spaceBetween: 16,
    watchSlidesProgress: true, // 👈 rastreia progresso de cada slide
    centeredSlidesBounds: true, // 👈 impede corte nas bordas
    pagination: {
      el: ".swiper-full-carrossel-pagination",
      clickable: true,
      type: "bullets",
    },
    breakpoints: {
      1200: {
        slidesPerView: 3,
        spaceBetween: 24,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 16,
      },
      450: {
        slidesPerView: 1.2,
        spaceBetween: 16,
      },
    },
  });
}
