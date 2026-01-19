/**
 * Tabs Module - Vanilla JS
 * Logic for switching tabs in the Solutions section.
 */

document.addEventListener('DOMContentLoaded', () => {
  const tabButtons = document.querySelectorAll('.nav-solucoes .nav-link');
  const tabContents = document.querySelectorAll('.content-solucoes .tab-pane');

  /* --- Logic for Desktop Tabs --- */
  if (tabButtons.length > 0) {
    tabButtons.forEach(button => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        switchTab(e.currentTarget);
      });
    });
  }

  /* --- Logic for Mobile Custom Select --- */
  const selectTrigger = document.querySelector('.custom-select-mobile .select-trigger');
  const selectDropdown = document.querySelector('.custom-select-mobile .select-dropdown');
  const selectItems = document.querySelectorAll('.custom-select-mobile .dropdown-item');
  const currentValue = document.querySelector('.custom-select-mobile .current-value');

  if (selectTrigger && selectDropdown) {
    // Toggle Dropdown
    selectTrigger.addEventListener('click', () => {
      const isHidden = selectDropdown.style.display === 'none';
      selectDropdown.style.display = isHidden ? 'block' : 'none';
      selectTrigger.classList.toggle('active', isHidden); // Add rotate class for arrow if needed
    });

    // Select Item
    selectItems.forEach(item => {
      item.addEventListener('click', (e) => {
        const targetId = item.getAttribute('data-target');
        const label = item.getAttribute('data-label');

        // 1. Update visible label
        currentValue.textContent = label;

        // 2. Hide dropdown
        selectDropdown.style.display = 'none';

        // 3. Update active state in list
        selectItems.forEach(i => i.classList.remove('selected'));
        item.classList.add('selected');

        // 4. Switch Content (Reuse logic)
        activateContent(targetId);
      });
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
      if (!selectTrigger.contains(e.target) && !selectDropdown.contains(e.target)) {
        selectDropdown.style.display = 'none';
      }
    });
  }

  // Helper functions to prevent code duplication
  function switchTab(clickedBtn) {
    // 1. Desktop Visuals
    tabButtons.forEach(btn => {
      btn.classList.remove('active');
      btn.setAttribute('aria-selected', 'false');
    });
    clickedBtn.classList.add('active');
    clickedBtn.setAttribute('aria-selected', 'true');

    // 2. Content Switching
    const targetId = clickedBtn.getAttribute('data-bs-target');
    activateContent(targetId);
  }

  function activateContent(targetId) {
    // Hide all contents
    tabContents.forEach(content => {
      content.classList.remove('show', 'active');
    });

    // Show target content
    const targetContent = document.querySelector(targetId);
    if (targetContent) {
      targetContent.className += ' show active'; // Ensure classes are added
    }
  }
});
