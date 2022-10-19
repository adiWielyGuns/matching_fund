<script setup>
import Select2 from "@/plugin/select2/Select2.vue";
defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);
</script>
<template>
  <div>
    <select2 ref="resi" :value="modelValue" :opsi="table" :async="false" :maximumSelectionLength="2" :tags="false"
      :multiple="false" :placeholder="'Pilih Nomor Meja'" @input="(e) => $emit('update:modelValue', e)"></select2>
  </div>
</template>
<script>
export default {
  data() {
    return {
      table: this.$page.props.table,
    };
  },
};
</script>
