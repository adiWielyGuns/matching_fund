<script setup>
import { computed, onMounted, onUnmounted, ref } from "vue";
const props = defineProps({
  modalSize: {
    default: "lg",
  },
  allowClose: {
    default: true,
  },
});

const sizeClass = computed(() => {
  if (props.modalSize == "lg") {
    return "modal-lg";
  } else if (props.modalSize == "md") {
    return "modal-md";
  } else if (props.modalSize == "sm") {
    return "modal-sm";
  }
});
</script>
<style>
.loading-backdrop {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.61);
  display: flex;
  justify-content: center;
  align-items: center;
  overflow-y: auto;
  z-index: 21;
}
</style>
<template>
  <transition name="modal-fade">
    <div class="loading-backdrop">
      <slot></slot>
    </div>
  </transition>
</template>
<script>
export default {
  name: "Modal",
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>
