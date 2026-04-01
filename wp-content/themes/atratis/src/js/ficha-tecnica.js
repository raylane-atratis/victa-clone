export function initFichaTecnica() {
  const toggle = document.querySelector(".js-ficha-toggle");
  const section = document.querySelector(".ficha-tecnica");
  const titleEl = document.querySelector(".ficha-tecnica__main-title");

  // Verificação de segurança para não dar erro em páginas que não têm a ficha
  if (!toggle || !section || !titleEl) return;

  toggle.addEventListener("click", function () {
    // 1. Alterna a classe de abertura
    section.classList.toggle("is-active");

    // 2. Pega os textos que definimos no PHP via data-attributes
    const textOpen = titleEl.getAttribute("data-text-open");
    const textClosed = titleEl.getAttribute("data-text-closed");

    // 3. Troca o texto baseado no estado atual
    if (section.classList.contains("is-active")) {
      titleEl.textContent = textOpen;
    } else {
      titleEl.textContent = textClosed;
    }
  });
}