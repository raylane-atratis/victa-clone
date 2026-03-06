export function initAnimations() {
  // 1. Configuramos o observador
  const observerOptions = {
    root: null, // Observa em relação à janela (viewport) principal
    rootMargin: "0px", // Margem da área
    threshold: 0.15, // Dispara quando 15% do bloco aparece na tela (pode ajustar)
  };

  // 2. Criamos o observador
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      // Se o elemento estiver visível na tela
      if (entry.isIntersecting) {
        // Adiciona a classe que dispara a animação CSS
        entry.target.classList.add("is-visible");

        // Para de observar o elemento após a animação acontecer 1 vez
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // 3. Capturamos todos os elementos que queremos animar e passamos para o observador
  const animatedElements = document.querySelectorAll(".animate-on-scroll");

  animatedElements.forEach((el) => {
    observer.observe(el);
  });
}
