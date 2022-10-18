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
      :opsi="table"
      :async="false"
      :maximumSelectionLength="2"
      :tags="false"
      :multiple="false"
      :placeholder="'Pilih Nomor Meja'"
      @input="(e) => $emit('update:modelValue', e)"
    ></select2>
  </div>
</template>
<script>
export default {
  data() {
    return {
      table: [
        {
          id: 1,
          text: "Meja 1",
          kursi: 2,
          lokasi: "indoor",
        },
        {
          id: 2,
          text: "Meja 2",
          kursi: 2,
          lokasi: "indoor",
        },
        {
          id: 3,
          text: "Meja 3",
          kursi: 4,
          lokasi: "indoor",
        },
        {
          id: 4,
          text: "Meja 4",
          kursi: 4,
          lokasi: "indoor",
        },
        {
          id: 5,
          text: "Meja 5",
          kursi: 4,
          lokasi: "indoor",
        },
        {
          id: 6,
          text: "Meja 6",
          kursi: 6,
          lokasi: "teras",
        },
        {
          id: 7,
          text: "Meja 7",
          kursi: 12,
          lokasi: "outdoor",
        },
        {
          id: 8,
          text: "Meja 8",
          kursi: 12,
          lokasi: "outdoor",
        },
      ],
    };
  },
};
</script>
