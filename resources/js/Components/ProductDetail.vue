<script setup>
defineProps({
  item: {
    default: null,
  },
});
</script>
<template>
  <div href="javascript:;" class="flex flex-col col-span-12" v-if="item">
    <img
      class="w-full rounded-t-md object-cover md:h-40"
      v-bind:src="item.image"
      alt=""
    />
    <div class="p-2 flex flex-col justify-between h-24">
      <p>
        <b>{{ item.name }}</b>
      </p>
      <div class="grid grid-cols-12">
        <div class="col-span-6">
          <b class="text-orange-500 mr-1"
            >Rp. {{ item.disc != "0" ? item.disc : item.price }}</b
          >
          <b class="text-orange-500 text-xs line-through" v-if="item.disc != '0'"
            >Rp. {{ item.price }}</b
          >
        </div>
        <div class="col-span-6">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
