import Swiper from "swiper";
import { Pagination, Navigation } from "swiper/modules";

export function initEsgSwiper() {
  const container = document.querySelector(".js-swiper-esg");
  if (!container) return;

  const wrapper = container.closest(".secao-esg__slider-wrapper");

  // 1. Inicializa o Carrossel Principal de Cards
  new Swiper(container, {
    modules: [Pagination, Navigation],
    grabCursor: true,
    watchOverflow: true,
    spaceBetween: 30,
    slidesPerView: 1,
    
    pagination: {
      el: wrapper.querySelector(".esg-pagination"),
      clickable: true,
    },

    breakpoints: {
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
  });

  // 2. Lógica de Abrir/Fechar Modal e Galeria Interna
  const openButtons = document.querySelectorAll(".js-open-modal-esg");
  const modals = document.querySelectorAll(".js-modal-esg");

  openButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const modalId = btn.getAttribute("data-modal");
      const targetModal = document.getElementById(modalId);

      if (targetModal) {
        targetModal.classList.add("is-active");
        document.body.style.overflow = "hidden"; // Trava o scroll do site ao abrir

        // Inicializa o Swiper da galeria dentro do modal apenas se ainda não existir
        const modalSwiperContainer = targetModal.querySelector(".js-swiper-modal-esg");
        if (modalSwiperContainer && !modalSwiperContainer.swiper) {
          new Swiper(modalSwiperContainer, {
            modules: [Pagination],
            nested: true,
            pagination: {
              el: targetModal.querySelector(".modal-pagination"),
              clickable: true,
            },
          });
        }
      }
    });
  });

  // Fechar Modal (No X ou no Overlay escuro)
  modals.forEach((modal) => {
    const closeElements = modal.querySelectorAll(".esg-modal__close, .esg-modal__overlay");
    
    closeElements.forEach((el) => {
      el.addEventListener("click", () => {
        modal.classList.remove("is-active");
        document.body.style.overflow = ""; // Devolve o scroll ao site
      });
    });
  });
}