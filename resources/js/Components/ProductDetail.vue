<script setup>
defineProps({
  item: {
    default: null,
  },
});
</script>
<template>
  <div href="javascript:;" class="col-span-12" v-if="item">
    <div class="relative">
      <img class="w-full rounded-3xl object-cover md:h-48" v-bind:src="item.image" alt="" />
      <div class="absolute bottom-3 right-3  px-3 py-1 rounded-full backdrop-blur-md bg-white/30">
        <b class="text-white mr-1">Rp. {{ accounting.formatNumber( item.price ) }}</b>
      </div>
    </div>
    <div class="p-2">
      <p class="text-white mb-5 text-xl">
        {{ item.name }}
      </p>
      <p class="text-white mb-5">
        {{ item.description }}
      </p>
      <div class="grid grid-cols-12">
        <slot />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      accounting: accounting,
    };
  },
};
</script>
