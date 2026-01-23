export function initFAQ() {
  const faqItems = document.querySelectorAll('.faq__item');

  if (faqItems.length === 0) return;

  faqItems.forEach(item => {
    const question = item.querySelector('.faq__question');
    const answer = item.querySelector('.resposta');

    question.addEventListener('click', () => {
      const isActive = item.classList.contains('active');

      // Fechar todos os outros itens (opcional, mas comum em acordeões)
      faqItems.forEach(otherItem => {
        if (otherItem !== item) {
          otherItem.classList.remove('active');
          const otherAnswer = otherItem.querySelector('.resposta');
          if (otherAnswer) {
              otherAnswer.style.maxHeight = null;
          }
        }
      });

      // Alternar item atual
      if (isActive) {
        item.classList.remove('active');
        answer.style.maxHeight = null;
      } else {
        item.classList.add('active');
        // Usar scrollHeight para animação suave de max-height
        answer.style.maxHeight = answer.scrollHeight + 'px';
      }
    });
  });
}
