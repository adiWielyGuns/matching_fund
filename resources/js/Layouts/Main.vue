<script setup>
import { ref } from "vue";
import Loading from "@/Components/Loading.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faUserSecret,
  faSearch,
  faList,
  faTableCells,
  faTrash,
  faEdit,
  faSpinner,
  faEllipsisVertical,
} from "@fortawesome/free-solid-svg-icons";

library.add(
  faUserSecret,
  faSearch,
  faList,
  faTableCells,
  faTrash,
  faEdit,
  faSpinner,
  faEllipsisVertical
);
const showingNavigationDropdown = ref(false);
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <!-- Page Heading -->
      <header class="bg-white shadow fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <img src="/assets/images/Logo.png" class="h-6" alt="" />
          </h2>
        </div>
      </header>
      <!-- Page Content -->
      <main>
        <div class="pt-20">
          <slot />
        </div>
      </main>
      <Loading v-if="$root.$loading.loading">
        <font-awesome-icon icon="fas fa-spinner" spin class="text-white mr-2 text-5xl" />
      </Loading>
    </div>
  </div>
</template>

<script>
export default {
  setup() {
    const loading = inject("$loading");
  },
  mounted() {
    this.$el.addEventListener("click", this.dropdownListener);
  },
  methods: {
    dropdownListener(event) {
      if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains("show")) {
            openDropdown.classList.remove("show");
          }
        }
      }
    },
  },
  data() {
    return {
      load: this.$loading,
    };
  },
  destroyed() {
    this.$el.removeEventListener("click", this.dropdownListener);
  },
};
</script>
