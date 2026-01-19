
document.addEventListener('DOMContentLoaded', () => {
  // ELEMENTS
  const menuToggle = document.querySelector('.menu-toggle');
  const siteHeader = document.querySelector('.site-header');
  const body = document.body;

  // --- 1. MOBILE MENU TOGGLE ---
  if (menuToggle) {
    menuToggle.addEventListener('click', () => {
      const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', !isExpanded);
      siteHeader.classList.toggle('menu-open');
      body.classList.toggle('no-scroll');
    });
  }

  // --- 2. MOBILE ACCORDION ---
  const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');
  menuItemsWithChildren.forEach(item => {
    const link = item.querySelector(':scope > a');
    const submenu = item.querySelector(':scope > ul.sub-menu');

    if (link && submenu) {
      link.addEventListener('click', (e) => {
        if (window.innerWidth < 1024) {
          e.preventDefault();
          item.classList.toggle('submenu-open');
        }
      });
    }
  });

  // --- 3. SMART SCROLL (Hide/Show on Scroll) ---
  let didScroll;
  let lastScrollTop = 0;
  const delta = 5;
  const navbarHeight = siteHeader ? siteHeader.offsetHeight : 0;

  window.addEventListener('scroll', () => {
    didScroll = true;
  });

  setInterval(() => {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250);

  function hasScrolled() {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;

    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - scrollTop) <= delta) return;

    // If they scrolled down and are past the navbar, add class .header-hidden.
    // This is necessary so you never see what is "behind" the navbar.
    if (scrollTop > lastScrollTop && scrollTop > navbarHeight) {
      // Scroll Down
      siteHeader.classList.remove('header-visible');
      siteHeader.classList.add('header-hidden');
    } else {
      // Scroll Up
      if (scrollTop + window.innerHeight < document.body.offsetHeight) {
        siteHeader.classList.remove('header-hidden');
        siteHeader.classList.add('header-visible');
      }
    }

    // Top of page logic
    if (scrollTop <= 0) {
      siteHeader.classList.remove('header-visible', 'header-hidden');
    }

    lastScrollTop = scrollTop;
  }
});
