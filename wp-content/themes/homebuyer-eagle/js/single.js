/*******************************************************************************
 * Open modals
 */

if (document.getElementById('author-link')) {
  document.getElementById('author-link').addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('author-dialog').showModal();
  });
}

if (document.getElementById('make-money-link')) {
  document.getElementById('make-money-link').addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('make-money-dialog').showModal();
  });
}

if (document.getElementById('certified-link')) {
  document.getElementById('certified-link').addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('certified-dialog').showModal();
  });
}

/*******************************************************************************
 * If the URL has query string with `quiz=email` and `answer=` a modal will display.
 */

document.addEventListener('DOMContentLoaded', function() {
  const params = new URLSearchParams(window.location.search);
  const quiz = params.get('quiz');
  const answer = params.get('answer');
  const dialog = document.getElementById('quiz-dialog');

  // Check that both 'quiz' and 'answer' parameters are present
  if (quiz === 'email' && answer !== null && dialog) {
    dialog.querySelector('p:first-child').textContent = answer === '1' ? 'You got it correct! Excellent job.' : 'Better luck next time! The correct answer is:';
    dialog.showModal();
  }
});

/*******************************************************************************
 * "Read More" content
 */

document.querySelectorAll('[data-read-more-link] a').forEach(function (link) {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const id = e.target.getAttribute('data-id');
    const contents = document.getElementById(id);
    if (contents.style['-webkit-line-clamp'] === 'initial') {
      if (window.innerWidth <= 960) {
        contents.style['-webkit-line-clamp'] = 10;
      } else {
        contents.style['-webkit-line-clamp'] = 2;
      }
      link.innerHTML = 'Read More…';
    } else {
      contents.style['-webkit-line-clamp'] = 'initial';
      link.innerHTML = 'Read Less';
    }
  });
});

/*******************************************************************************
 * Track floating CTA clicks
 */

document.querySelectorAll('[data-floating-cta-option]').forEach(function (opt) {
  opt.addEventListener('click', (e) => {
    e.preventDefault();
    const timeframe = opt.getAttribute('data-floating-cta-option');
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
      event: 'Click',
      eventCategory: 'Pre-approval',
      eventLabel: 'article-floating-cta',
      eventValue: timeframe,
    });
    const params = new URLSearchParams({ timeframe });
    window.open('https://app.homebuyer.com/?' + params, '_blank');
  });
});

/*******************************************************************************
 * Table of Contents: show or hide
 */

const toggleToc = (function() {
  if (window.innerWidth <= 960) {
    return () => {};
  }
  const container = document.querySelector('[data-content]');
  const toc = document.querySelector('[data-toc]');
  if (!toc) {
    return () => {};
  }
  return () => {
    const rect = container.getBoundingClientRect();
    if (rect.top < 100) {
      // Top of container is scrolling out of top of viewport - show
      if (toc.style.display !== 'flex') {
        toc.style.display = 'flex';
        window.animateCSS(toc, 'fadeIn');
      }
    } else if (toc.style.display === 'flex') {
      // Near top of page - hide
      window.animateCSS(toc, 'fadeOut').then(() => {
        toc.style.display = 'none';
      });
    }
  };
})();

/*******************************************************************************
 * Table of Contents: track H2s' scroll positions to set TOC selected item
 */

const trackTocItems = (function() {
  if (window.innerWidth <= 960) {
    return () => {};
  }
  const container = document.querySelector('[data-content]');
  if (!container) {
    return () => {};
  }
  const h2s = container.querySelectorAll('h2');
  const toc = document.querySelector('[data-toc]');
  if (!toc) {
    return () => {};
  }
  const tocItems = toc.querySelectorAll('[data-toc-item]');
  const cta = document.querySelector('[data-bottom-cta]');
  return () => {
    const offscreen = [];
    h2s.forEach((h2) => {
      const rect = h2.getBoundingClientRect();
      if (rect.top < 40) {
        // H2 is scrolling out of view
        offscreen.push(h2);
      }
    });
    let selected;
    const rect = cta.getBoundingClientRect();
    if (rect.top < window.innerHeight / 2) {
      // Select bottom CTA TOC item
      selected = h2s.length;
    } else {
      // Last offscreen H2 is selected
      selected = offscreen.length ? offscreen.length - 1 : 0;
    }
    tocItems.forEach((tocItem, i) => {
      if (i === selected) {
        tocItem.classList.add('toc-selected');
      } else {
        tocItem.classList.remove('toc-selected');
      }
    });
  };
})();

/*******************************************************************************
 * This page has a lot of scrolling logic. Use a singular scroll event listener here.
 */

window.addEventListener('scroll', window.throttle(() => {
  toggleToc();
  trackTocItems();
}, 350));
