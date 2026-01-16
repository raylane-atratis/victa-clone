
document.addEventListener('DOMContentLoaded', () => {
  // Mobile Menu Toggle (Hamburger)
  const menuToggle = document.querySelector('.menu-toggle');
  const siteHeader = document.querySelector('.site-header');
  const body = document.body;

  if (menuToggle) {
    menuToggle.addEventListener('click', () => {
      const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', !isExpanded);
      siteHeader.classList.toggle('menu-open');
      body.classList.toggle('no-scroll');
    });
  }

  // Mobile Submenu Accordion
  const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');

  menuItemsWithChildren.forEach(item => {
    const link = item.querySelector(':scope > a'); // Link direto do item
    const submenu = item.querySelector(':scope > ul.sub-menu');

    if (link && submenu) {
      link.addEventListener('click', (e) => {
        // Só aplica accordion em telas mobile (verifica se o menu toggle está visível)
        if (window.innerWidth < 1024) {
          e.preventDefault(); // Impede a navegação no mobile
          item.classList.toggle('submenu-open');
        }
        // No desktop, deixa o comportamento padrão (hover funciona via CSS)
      });
    }
  });
});
