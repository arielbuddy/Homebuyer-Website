<script>
  const Modal = (props) => ({
    $template: '#modal-template',
    props,
    slot: null,
    mounted(el) {
      this.slot = el.querySelector('slot').innerHTML;

      const dialog = el.querySelector('dialog');
      const body = document.querySelector('body');

      const observer = new MutationObserver((events) => {
        if (events[0].attributeName === 'open') {
          body.style.overflow = 'hidden';
          el.dispatchEvent(new CustomEvent('open', { bubbles: true }));
        } else if (events[0].attributeName === 'close') {
          onClose();
        }
      });
      observer.observe(dialog, { attributes: true });

      const onClose = (e) => {
        e && e.preventDefault();
        dialog.classList.add('hide');
        dialog.addEventListener('animationend', () => {
          body.style.overflow = 'auto';
          dialog.classList.remove('hide');
          dialog.removeAttribute('close');
          dialog.close();
          el.dispatchEvent(new CustomEvent('close', { bubbles: true }));
        }, { once: true });
      };

      dialog.addEventListener('cancel', (e) => {
        if (this.props.persistent) {
          e.preventDefault();
        } else {
          onClose(e);
        }
      });

      dialog.addEventListener('click', (e) => {
        if (this.props.persistent) {
          e.preventDefault();
        } else if (event.target === dialog) {
          onClose(e);
        }
      });

      if (dialog.querySelector('[data-close]')) {
        dialog.querySelector('[data-close]').addEventListener('click', onClose);
      }
    },
  });
</script>

<template id="modal-template">
  <dialog :id="props.id" class="dialog">
    <div class="mx-4 mt-4 text-right">
      <span v-if="!props.persistent" data-close class="cursor-pointer text-2xl mdi mdi-close"></span>
    </div>
    <div class="p-6 pt-4 pb-8 overflow-y-auto" v-html="slot"></div>
  </dialog>
</template>
