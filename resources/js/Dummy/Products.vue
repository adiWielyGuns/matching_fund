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
  <div v-for="(item, index) in items" :key="index" :class="col">
    <a
      href="javascript:;"
      class="flex flex-col bg-white shadow-md rounded-md cursor-pointer"
      v-if="mode == 'tile'"
      @click="$emit('openModal', item)"
    >
      <img
        class="w-full rounded-t-md object-cover md:h-24"
        v-bind:src="item.image"
        alt=""
      />

      <img
        v-if="item.sold > 80 && item.favoriteList"
        class="rounded-t-md object-cover w-12 h-12 absolute"
        v-bind:src="'../assets/images/fav.png'"
        alt=""
      />
      <div class="p-2 flex flex-col justify-between h-24">
        <p>
          <b>{{ item.name }}</b>
        </p>
        <div class="flex">
          <b class="text-orange-500 mr-1"
            >Rp. {{ item.disc != "0" ? item.disc : item.price }}</b
          >
          <b class="text-orange-500 text-xs line-through" v-if="item.disc != '0'"
            >Rp. {{ item.price }}</b
          >
        </div>
      </div>
    </a>

    <a
      href="javascript:;"
      class="flex bg-white shadow-md rounded-md cursor-pointer"
      v-if="mode == 'list'"
      @click="$emit('openModal', item)"
    >
      <img
        class="w-24 rounded-tl-md rounded-bl-md object-cover md:h-24 mr-4"
        v-bind:src="item.image"
        alt=""
      />

      <img
        v-if="item.sold > 80 && item.favoriteList"
        class="rounded-t-md object-cover w-12 h-12 absolute"
        v-bind:src="'../assets/images/fav.png'"
        alt=""
      />
      <div class="p-2 flex flex-col justify-between h-24">
        <p>
          <b>{{ item.name }}</b>
        </p>
        <div class="flex">
          <b class="text-orange-500 mr-1"
            >Rp. {{ item.disc != "0" ? item.disc : item.price }}</b
          >
          <b class="text-orange-500 text-xs line-through" v-if="item.disc != '0'"
            >Rp. {{ item.price }}</b
          >
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [
        {
          id: 1,
          name: "Mie Iblis ",
          category: 1,
          image: "../assets/images/mie-1.jpg",
          sold: 100,
          price: "10,500",
          disc: "8,000",
          favoriteList: true,
        },
        {
          id: 2,
          name: "Mie Setan",
          category: 1,
          image: "../assets/images/mie-1.jpg",
          sold: 90,
          price: "10,900",
          disc: "0",
          favoriteList: true,
        },
        {
          id: 3,
          name: "Mie Angel",
          category: 1,
          image: "../assets/images/food-beverage-1.jpg",
          sold: 80,
          price: "9,500",
          disc: "0",
          favoriteList: true,
        },
        {
          id: 4,
          name: "Nasi Goreng Hitler",
          category: 2,
          image: "../assets/images/food-beverage-2.jpg",
          sold: 60,
          price: "12,000",
          disc: "0",
          favoriteList: true,
        },
        {
          id: 5,
          name: "Nasi Goreng Bucin",
          category: 2,
          image: "../assets/images/food-beverage-3.jpg",
          sold: 50,
          price: "14,000",
          disc: "0",
          favoriteList: true,
        },
        {
          id: 6,
          name: "Steak Murmer",
          category: 3,
          image: "../assets/images/food-beverage-4.jpg",
          sold: 100,
          price: "18,000",
          disc: "0",
          favoriteList: true,
        },
        {
          id: 7,
          name: "Steak Tenderloin",
          category: 3,
          image: "../assets/images/food-beverage-5.jpg",
          sold: 40,
          price: "32,000",
          disc: "0",
          favoriteList: true,
        },
        {
          id: 8,
          name: "Steak Sirloin",
          category: 3,
          image: "../assets/images/food-beverage-6.jpg",
          sold: 30,
          price: "30,000",
          disc: "0",
          favoriteList: true,
        },
        {
          id: 9,
          name: "Es Teh",
          category: 4,
          image: "../assets/images/promo-1.jpg",
          price: "5,000",
          sold: 100,
          disc: "0",
          favoriteList: false,
        },
        {
          id: 9,
          name: "Air Putih",
          category: 4,
          image: "../assets/images/mineral-water.jpg",
          price: "3,000",
          sold: 100,
          disc: "0",
          favoriteList: false,
        },
      ],
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
          category = this.category.includes(e.category.toString());

        var similarity = 1;
        if (this.searchValue != "") {
          var similarity = this.compare(
            this.searchValue.toLowerCase(),
            e.name.toLowerCase()
          );
        }

        similarity > 0.8 ? (similarity = true) : (similarity = false);

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
