/**
 * Onde Estamos - Tabs Logic
 */
export function initOndeEstamos() {
  const section = document.querySelector('.secao-onde-estamos');
  if (!section) return;

  const buttons = section.querySelectorAll('.map-tab-btn');
  const panes = section.querySelectorAll('.map-pane');

  if (!buttons.length) return;

  function switchTab(targetId) {
    // Remove active from all contents
    panes.forEach(pane => pane.classList.remove('active'));

    // Add active to target content
    const targetPane = section.querySelector(targetId);
    if (targetPane) {
      targetPane.classList.add('active');
    }

    // Update buttons state
    buttons.forEach(btn => {
      if (btn.dataset.target === targetId) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });
  }

  buttons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const target = btn.dataset.target;
      switchTab(target);
    });
  });
}
