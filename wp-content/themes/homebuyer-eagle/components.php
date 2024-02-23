<?php
require_once('components/comparison-table.php');
require_once('components/affordability-form.php');
require_once('components/select-input.php');
require_once('components/modal.php');
?>
<script type="module">
  import { createApp } from 'https://unpkg.com/petite-vue@0.4.1/dist/petite-vue.es.js';

  document.querySelectorAll('[data-is-vue]').forEach(el => {
    el.innerHTML = '';
  });

  createApp({
    ComparisonTable,
    AffordabilityForm,
    SelectInput,
    Modal,
  }).mount();
</script>
