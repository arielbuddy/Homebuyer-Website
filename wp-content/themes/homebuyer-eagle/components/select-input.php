<script>
  const SelectInput = (props) => ({
    $template: '#select-input-template',
    props,
    onChange(e, el) {
      el.dispatchEvent(
        new CustomEvent('update', { bubbles: true, detail: e.target.value })
      );
    },
  });
</script>

<template id="select-input-template">
  <div class="select-container">
    <select class="text-input w-full" @change="onChange(event, $el)">
      <template v-for="option in props.options">
        <option :value="option.value" :selected="option.selected" >{{ option.title }}</option>
      </template>
    </select>
  </div>
</template>
