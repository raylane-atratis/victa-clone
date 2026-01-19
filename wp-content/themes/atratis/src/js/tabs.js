/**
 * Tabs Module - Vanilla JS
 * Logic for switching tabs in the Solutions section.
 */

document.addEventListener('DOMContentLoaded', () => {
  const tabButtons = document.querySelectorAll('.nav-solucoes .nav-link');
  const tabContents = document.querySelectorAll('.content-solucoes .tab-pane');

  if (tabButtons.length === 0) return;

  tabButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();

      // 1. Remove active class from all buttons and badges
      tabButtons.forEach(btn => {
        btn.classList.remove('active');
        btn.setAttribute('aria-selected', 'false');
      });

      // 2. Hide all contents
      tabContents.forEach(content => {
        content.classList.remove('show', 'active');
      });

      // 3. Activate clicked button
      const clickedBtn = e.currentTarget;
      clickedBtn.classList.add('active');
      clickedBtn.setAttribute('aria-selected', 'true');

      // 4. Show corresponding content
      const targetId = clickedBtn.getAttribute('data-bs-target'); // Using BS data attribute for compatibility
      const targetContent = document.querySelector(targetId);

      if (targetContent) {
        // Small delay to allow fade out if we were doing generic transition, 
        // but standard BS fade works by adding class.
        targetContent.classList.add('show', 'active');
      }
    });
  });
});
