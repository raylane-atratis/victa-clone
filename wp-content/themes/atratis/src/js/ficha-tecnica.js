export function initFichaTecnica() {
  const cards = document.querySelectorAll(".js-ficha-toggle");

  cards.forEach(card => {
    const titleEl = card.querySelector(".ficha-tecnica__card-title");
    
    card.addEventListener("click", function () {
      this.classList.toggle("is-active");

      if (titleEl) {
        const textOpen = titleEl.getAttribute("data-text-open");
        const textClosed = titleEl.getAttribute("data-text-closed");

        titleEl.textContent = this.classList.contains("is-active") ? textOpen : textClosed;
      }
    });
  });
}