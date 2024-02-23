/*******************************************************************************
 * Scrolly buttons
 */

if (document.getElementById('scroll-trigger')) {
  document.getElementById('scroll-trigger').addEventListener('click', () => {
    window.scroll({
      top: document.getElementById('scroll-target').offsetTop,
      left: 0,
      behavior: 'smooth',
    });
  });
}

/*******************************************************************************
 * Natural Intelligence widget track events
 */

window.addEventListener('DOMContentLoaded', function () {
  if (window.niLoader) {
    console.log('niLoader ready');
    window.niLoader.addEventListener((UiEvent) => {
      // console.log({ UiEvent, WidgetKey });
      window.dataLayer = window.dataLayer || [];
      const { eventAction, eventCategory, eventLabel } = UiEvent;
      if (eventAction === 'impression' && eventCategory === 'publisher widget loaded') {
        window.dataLayer.push({
          event: "NI: Table CTA Viewed",
          eventCategory: "Natural Intelligence",
          eventLabel: window.location.pathname,
        });
      } else if (eventAction === 'click' && eventCategory === 'answer') {
        window.dataLayer.push({
          event: "NI: Table CTA Engaged",
          eventCategory: "Natural Intelligence",
          eventLabel,
        });
      } else if (eventAction === 'click' && eventCategory === 'product') {
        window.dataLayer.push({
          event: "NI: Table CTA Clicked",
          eventCategory: "Natural Intelligence",
          eventLabel,
        });
      }
    });
  }
});
