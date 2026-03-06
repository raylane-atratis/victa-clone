/**
 * Search Modal - Toggle de abertura/fechamento e foco automático
 */
export function initSearch() {
  const toggleBtn = document.querySelector(".search-toggle-btn");
  const modal = document.getElementById("search-modal");

  if (!toggleBtn || !modal) return;

  const closeBtn = modal.querySelector(".search-modal__close");
  const backdrop = modal.querySelector(".search-modal__backdrop");
  const input = modal.querySelector(".search-modal__input");

  function openModal() {
    modal.classList.add("is-open");
    document.body.style.overflow = "hidden";

    // Auto-focus no input com pequeno delay para a animação
    setTimeout(() => {
      if (input) input.focus();
    }, 100);
  }

  function closeModal() {
    modal.classList.remove("is-open");
    document.body.style.overflow = "";

    if (input) input.value = "";
  }

  // Eventos
  toggleBtn.addEventListener("click", openModal);

  if (closeBtn) {
    closeBtn.addEventListener("click", closeModal);
  }

  if (backdrop) {
    backdrop.addEventListener("click", closeModal);
  }

  // Fechar com Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal.classList.contains("is-open")) {
      closeModal();
    }
  });
}
