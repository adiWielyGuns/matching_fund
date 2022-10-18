<script setup>
defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);
</script>
<template>
  <div class="grid grid-cols-12 gap-1">
    <div
      class="col-span-6 md:col-span-4"
      v-for="(item, index) in paymentMethod"
      :key="index"
    >
      <button
        class="w-12 h-12 items-center shadow-sm p-1 text-center border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150"
        :class="item.class"
        @click="$emit('update:modelValue', item)"
      >
        <img v-bind:src="item.image" class="w-full h-full" alt="" />
      </button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      paymentMethod: [
        {
          id: 1,
          name: "Ovo",
          image: "../assets/images/logo-ovo.png",
          class: "bg-white-500 hover:bg-gray-200 active:bg-gray-300",
          type: "cashless",
        },
        {
          id: 2,
          name: "Gopay",
          image: "../assets/images/logo-gopay.png",
          class: "bg-white-500 hover:bg-gray-200 active:bg-gray-300",
          type: "cashless",
        },
        {
          id: 3,
          name: "Link Aja",
          image: "../assets/images/logo-link-aja.png",
          class: "bg-white-500 hover:bg-gray-200 active:bg-gray-300",
          type: "cashless",
        },
        {
          id: 4,
          name: "Dana",
          image: "../assets/images/logo-dana.png",
          class: "bg-white-500 hover:bg-gray-200 active:bg-gray-300",
          type: "cashless",
        },
        {
          id: 5,
          name: "Shopee Pay",
          image: "../assets/images/logo-shopee-pay.png",
          class: "bg-white-500 hover:bg-gray-200 active:bg-gray-300",
          type: "cashless",
        },
      ],
    };
  },
};
</script>
