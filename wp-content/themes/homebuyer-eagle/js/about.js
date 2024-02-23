/*******************************************************************************
 * Expand/collapse Press section
 */
(function() {
  if (document.getElementById('toggle-press')) {
    const toggle = document.getElementById('toggle-press');
    toggle.addEventListener('click', function(e) {
      e.preventDefault();

      const links = document.querySelectorAll('[data-press] a');
      for (let i = 0; i < links.length; i++) {
        if (i >= 9) {
          const link = links[i];
          if (link.style.display !== 'flex') {
            link.style.display = 'flex';
          } else {
            link.style.display = 'none';
          }
        }
      }

      const arrow = toggle.querySelector('span');
      if (arrow.classList.contains('mdi-arrow-up')) {
        arrow.classList.remove('mdi-arrow-up');
        arrow.classList.add('mdi-arrow-down');
        window.scroll({
          top: toggle.offsetTop,
          left: 0,
          behavior: 'instant',
        });
        toggle.innerHTML = toggle.innerHTML.replace('Less', 'More');
      } else {
        arrow.classList.remove('mdi-arrow-down');
        arrow.classList.add('mdi-arrow-up');
        toggle.innerHTML = toggle.innerHTML.replace('More', 'Less');
      }
    });
  }
})();
