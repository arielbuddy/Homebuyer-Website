/*******************************************************************************
 * Throttle utility function
 */

const throttle = (callback, delay) => {
  let timeoutHandler = null;
  return function () {
    if (timeoutHandler == null) {
      timeoutHandler = setTimeout(function () {
        callback();
        timeoutHandler = null;
      }, delay);
    }
  }
};

window.throttle = throttle;

/*******************************************************************************
 * Animate.css helper
 */

const animateCSS = (node, animation) => (
  new Promise((resolve) => {
    const animationName = `animate__${animation}`;
    node.classList.add('animate__animated', animationName);

    // When the animation ends, we clean the classes and resolve the Promise
    function handleAnimationEnd(event) {
      event.stopPropagation();
      node.classList.remove('animate__animated', animationName);
      resolve('Animation ended');
    }

    node.addEventListener('animationend', handleAnimationEnd, { once: true });
  })
);

window.animateCSS = animateCSS;
