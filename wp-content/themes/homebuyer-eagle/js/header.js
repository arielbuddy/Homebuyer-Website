/*******************************************************************************
 * Slide header in/out
 */

(function() {
  let lastScrollTop = 0;
  const header = document.getElementById('header');
  window.addEventListener('scroll', window.throttle(() => {
    const scrollTop = window.scrollY;
    if (scrollTop > 66 && scrollTop > lastScrollTop) {
      // Scroll down - hide header
      if (!header.classList.contains('-translate-y-full')) {
        header.classList.add('-translate-y-full');
      }
    } else {
      // Scroll up - show header
      if (header.classList.contains('-translate-y-full')) {
        header.classList.remove('-translate-y-full');
      }
    }
    lastScrollTop = scrollTop;
  }, 350));
})();

/*******************************************************************************
 * Desktop fly-out menu w/ take-over overlay
 */

(function() {
  const body = document.querySelector('body');
  const menus = document.querySelectorAll('[data-desktop-nav-menu] > div > a');
  const overlay = document.getElementById('overlay');
  const header = document.getElementById('header');

  const closeFlyout = () => {
    header.classList.add('bg-white');
    header.classList.remove('bg-brand-white');
    body.classList.remove('touch-none', 'overflow-hidden')
    const submenus = document.querySelectorAll('[data-desktop-nav-submenu]');
    submenus.forEach(submenu => submenu.style.display = 'none');
    overlay.style.display = 'none';
  };

  menus.forEach(menu => {
    menu.addEventListener('click', (e) => {
      let parent = e.target;
      while (!parent.hasAttribute('data-desktop-nav-menu')) {
        parent = parent.parentNode;
      }
      const submenu = parent.querySelector('[data-desktop-nav-submenu]');
      if (submenu) {
        e.preventDefault();
        e.stopPropagation();
        if (submenu.style.display !== 'grid') {
          closeFlyout();

          requestAnimationFrame(() => {
            header.classList.remove('bg-white');
            header.classList.add('bg-brand-white');
            body.classList.add('touch-none', 'overflow-hidden')

            submenu.style.display = 'grid';
            overlay.style.display = 'flex';
          });
        } else {
          closeFlyout();
        }
      }
    });
  });

  header.addEventListener('click', (e) => {
    if (!e.target.closest('[data-desktop-nav-submenu]')) {
      const submenus = document.querySelectorAll('[data-desktop-nav-submenu]');
      if ([...submenus].find(submenu => submenu.style.display !== 'none')) {
        closeFlyout();
      }
    }
  });

  overlay.addEventListener('click', () => {
    closeFlyout();
  });
})();

/*******************************************************************************
 * Mobile slide-out menu
 */

(function() {
  const body = document.querySelector('body');
  const mobileMenuButton = document.querySelector('#mobile-menu-button');
  const mobileMenu = document.querySelector('#mobile-menu');

  mobileMenuButton.addEventListener('click', () => {
    if (mobileMenu.style.display === 'flex') {
      mobileMenuButton.classList.add('mdi-menu');
      mobileMenuButton.classList.remove('mdi-close');
      window.animateCSS(mobileMenu, 'fadeOut').then(() => {
        mobileMenu.style.display = 'none';
        body.style.overflow = 'auto';
      });
    } else {
      mobileMenu.style.display = 'flex';
      mobileMenuButton.classList.remove('mdi-menu');
      mobileMenuButton.classList.add('mdi-close');
      window.animateCSS(mobileMenu, 'fadeIn').then(() => {
        body.style.overflow = 'hidden';
      });
    }
  });

  const mobileMenus = document.querySelectorAll('[data-mobile-nav-menu] > a');

  mobileMenus.forEach(menu => {
    menu.addEventListener('click', (e) => {
      e.stopPropagation();
      let parent = e.target;
      while (!parent.hasAttribute('data-mobile-nav-menu')) {
        parent = parent.parentNode;
      }
      const mainmenu = mobileMenu.querySelector('div');
      const submenu = parent.querySelector('[data-mobile-nav-submenu]');
      if (submenu) {
        submenu.style.display = 'flex';
        window.animateCSS(mainmenu, 'slideOutLeft').then(() => {
          mainmenu.style.transform = 'translateX(-100%)';
        });

        const backButton = parent.querySelector('[data-back-button]');
        backButton.addEventListener('click', () => {
          window.animateCSS(mainmenu, 'slideInLeft').then(() => {
            submenu.style.display = 'none';
            mainmenu.style.transform = 'translateX(0)';
          });
        }, { once: true });
      }
    });
  });
})();
