<script setup>
import { onMounted, ref } from "vue";

defineProps(["modelValue", "placeholder"]);

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});
</script>
<style>
.form-control {
  --tw-border-opacity: 1;
  --tw-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
  border-color: rgb(var(--color-slate-200) / var(--tw-border-opacity));
  border-radius: 0.375rem;
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000),
    var(--tw-shadow);
  font-size: 0.875rem;
  line-height: 1.25rem;
  transition-duration: 0.2s;
  transition-property: color, background-color, border-color, fill, stroke, opacity,
    box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
  transition-property: color, background-color, border-color, text-decoration-color, fill,
    stroke, opacity, box-shadow, transform, filter, backdrop-filter;
  transition-property: color, background-color, border-color, text-decoration-color, fill,
    stroke, opacity, box-shadow, transform, filter, backdrop-filter,
    -webkit-text-decoration-color, -webkit-backdrop-filter;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  width: 100%;
  padding: 0.5rem 0.75rem;
  border-color: #6b7280;
}
</style>
<template>
  <input :placeholder="placeholder"
    class="border-white focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm py-1.5"
    :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" />
</template>
