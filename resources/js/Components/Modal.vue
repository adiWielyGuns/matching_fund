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
.modal-backdrop {
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

.modal {
  background-color: rgba(255, 255, 255, .40);
  backdrop-filter: blur(30px);
  /* overflow-x: auto; */
  display: flex;
  flex-direction: column;
  border-radius: 60px;
}

.modal-lg {
  width: 80%;
}

.modal-md {
  width: 80%;
}

.modal-sm {
  width: 80%;
}

@media (min-width: 640px) {
  .modal-lg {
    width: 80%;
  }

  .modal-md {
    width: 60%;
  }

  .modal-sm {
    width: 60%;
  }
}

@media (min-width: 1024px) {
  .modal-lg {
    width: 100%;
  }

  .modal-md {
    width: 50%;
  }

  .modal-sm {
    width: 30%;
  }
}

.modal-header,
.modal-footer {
  padding: 15px 40px;
  display: flex;
}

.modal-header {
  position: relative;
  border-bottom: 1px solid #eeeeee;
  color: #1f2937;
  font-weight: bold;
  justify-content: space-between;
}

.modal-footer {
  border-top: 1px solid #eeeeee;
  flex-direction: column;
  justify-content: flex-end;
}

.modal-body {
  position: relative;
}

.btn-close {
  position: absolute;
  top: 0;
  right: 1.25rem;
  border: none;
  font-size: 20px;
  padding: 10px;
  padding-right: 1rem;
  cursor: pointer;
  font-weight: bold;
  color: #1f2937;
  background: transparent;
}

.btn-green {
  color: white;
  background: #4aae9b;
  border: 1px solid #4aae9b;
  border-radius: 2px;
}

.modal-fade-enter,
.modal-fade-leave-to {
  opacity: 0;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.5s ease;
}
</style>
<template>
  <transition name="modal-fade">
    <div class="modal-backdrop">
      <div class="modal rounded" :class="[sizeClass]" role="dialog" aria-labelledby="modalTitle"
        aria-describedby="modalDescription">
        <header class="modal-header" id="modalTitle">
          <slot name="header"> This is the default title! </slot>
          <button type="button" class="btn-close " @click="close" aria-label="Close modal" v-if="allowClose">
            <span class="text-white">x</span>
          </button>
        </header>

        <section class="modal-body p-4" id="modalDescription">
          <slot name="body"> This is the default body! </slot>
        </section>

        <footer class="modal-footer">
          <slot name="footer"> This is the default footer! </slot>
        </footer>
      </div>
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
