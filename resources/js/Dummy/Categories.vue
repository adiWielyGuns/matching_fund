<script setup>
import Select2 from "@/plugin/select2/Select2.vue";
defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);
</script>
<template>
  <div>
    <select2
      ref="resi"
      :value="modelValue"
      :opsi="category"
      :async="false"
      :maximumSelectionLength="10"
      :tags="false"
      :multiple="true"
      :placeholder="'Pilih Kategori'"
      @input="(e) => $emit('update:modelValue', e)"
    ></select2>
  </div>
</template>
<script>
export default {
  data() {
    return {
      category: [
        {
          id: 1,
          text: "Mie",
        },
        {
          id: 2,
          text: "Nasi",
        },
        {
          id: 3,
          text: "Steak",
        },
        {
          id: 4,
          text: "Minuman",
        },
      ],
    };
  },
};
</script>
