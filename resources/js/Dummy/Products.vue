<script setup>
const props = defineProps({
  col: {
    default: "col-span-12 md:col-span-3",
  },
  mode: {
    default: "tile",
  },
  category: {
    type: Array,
    default: [],
  },
  searchValue: {
    type: String,
    default: "",
  },
});

const emits = defineEmits(["openModal"]);
</script>

<template>
  <div
    v-for="(item, index) in items"
    :key="index"
    :class="col"
    class="bg-white rounded-3xl"
  >
    <a
      href="javascript:;"
      class="flex flex-col bg-white rounded-md cursor-pointer"
      v-if="mode == 'tile'"
      @click="$emit('openModal', item)"
    >
      <img
        class="w-full rounded-3xl object-cover md:h-36"
        v-bind:src="item.image"
        alt=""
      />

      <img
        v-if="item.sold > 80 && item.favoriteList"
        class="rounded-t-md object-cover w-12 h-12 absolute mb-2"
        v-bind:src="'../assets/images/fav.png'"
        alt=""
      />
      <div class="p-2">
        <p>
          <b class="font-extrabold">{{ item.name }}</b>
        </p>
        <p class="h-13 text-sm ellipsis text-gray-400 mb-5">
          {{ item.description }}
        </p>
        <div class="text-right">
          <b class="text-gray-700 mr-1 text-xl"
            >Rp. {{ accounting.formatNumber(item.price) }}
          </b>
          <!-- <b class="text-orange-500 text-xs line-through" v-if="item.disc != '0'"
            >Rp. {{ item.price }}
          </b> -->
        </div>
      </div>
    </a>

    <a
      href="javascript:;"
      class="flex bg-white rounded-3xl cursor-pointer"
      v-if="mode == 'list'"
      @click="$emit('openModal', item)"
    >
      <img
        class="w-24 rounded-tl-3xl rounded-bl-3xl object-cover md:h-28 mr-2"
        v-bind:src="item.image"
        alt=""
      />

      <img
        v-if="item.sold > 80 && item.favoriteList"
        class="rounded-t-md object-cover w-12 h-12 absolute"
        v-bind:src="'../assets/images/fav.png'"
        alt=""
      />
      <div class="p-2 flex flex-col justify-between">
        <p>
          <b>{{ item.name }}</b>
        </p>
        <p class="text-sm ellipsis text-gray-400">
          {{ item.description }}
        </p>
        <div class="flex">
          <b class="text-gray-700 mr-1">Rp. {{ accounting.formatNumber(item.price) }}</b>
          <!-- <b class="text-orange-500 text-xs line-through" v-if="item.disc != '0'"
            >Rp. {{ accounting.formatNumber(item.price) }}</b
          > -->
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: this.$page.props.menu,
      accounting: accounting,
    };
  },
  methods: {
    compare(strA, strB) {
      for (var result = 0, i = strA.length; i--; ) {
        if (typeof strB[i] == "undefined" || strA[i] == strB[i]);
        else if (strA[i].toLowerCase() == strB[i].toLowerCase()) result++;
        else result += 4;
      }
      return (
        1 -
        (result + 4 * Math.abs(strA.length - strB.length)) /
          (2 * (strA.length + strB.length))
      );
    },
  },
  computed: {
    items: function () {
      return this.products.filter((e) => {
        var temp = true;
        var category = true;
        if (this.category.length != 0)
          category = this.category.includes(e.category_id);
        var similarity = 1;
        if (this.searchValue != "") {
          var similarity = e.name.toLowerCase().includes(this.searchValue.toLowerCase());
        }

        if (category && similarity) {
          temp = true;
        } else {
          temp = false;
        }

        return temp;
      });
    },
  },
  //   mounted() {},
};
</script>
