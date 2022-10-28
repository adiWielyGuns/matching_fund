<script setup>
import Main from "@/Layouts/Main.vue";
import BreezeButton from "@/Components/Button.vue";
import Modal from "@/Components/Modal.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInputError from "@/Components/InputError.vue";
import CashLess from "@/Components/CashLess.vue";
import Product from "@/Dummy/Products.vue";
import ProductDetail from "@/Components/ProductDetail.vue";
import Category from "@/Dummy/Categories.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import BreezeInput from "@/Components/Input.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faUser,
  faUserSecret,
  faSearch,
  faList,
  faTableCells,
  faTrash,
  faEdit,
  faEllipsisVertical,
  faMinus,
  faCartShopping,
  faPlus,
} from "@fortawesome/free-solid-svg-icons";

library.add(
  faUserSecret,
  faSearch,
  faList,
  faTableCells,
  faTrash,
  faEdit,
  faUser,
  faEllipsisVertical,
  faMinus,
  faPlus,
  faCartShopping
);
</script>

<template>
  <Head title="Order" />
  <Main>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm">
          <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-4 sm:rounded-lg">
              <div class="grid grid-cols-12">
                <div
                  class="col-span-12 bg-white mb-8 px-14 rounded-3xl pt-10 pb-6 mx-2 md:mx-0"
                >
                  <div class="grid grid-cols-12">
                    <div class="col-span-12 flex justify-between">
                      <div class="flex">
                        <img
                          class="h-7 mr-2 my-auto"
                          :src="'../assets/images/user.png'"
                          alt=""
                        />
                        <span
                          class="text-gray-700 text-2xl inline-block align-middle my-auto"
                        >
                          {{ $page.props.req.nama }}
                        </span>
                      </div>
                      <a
                        href="javascript:;"
                        class="my-auto text-gray-700 hover:text-purple-700"
                      >
                        <div class="dropdown">
                          <a
                            class="nav-link dropbtn"
                            @click="openDropdown"
                            data-toggle="dropdown"
                            href="#"
                            aria-expanded="true"
                          >
                            <font-awesome-icon
                              class="text-xl"
                              icon="fa-solid fa-ellipsis-vertical"
                            />
                          </a>
                          <div id="myDropdown" class="dropdown-content">
                            <a
                              href="javascript:;"
                              v-if="listMenungguPembayaran.length == 0"
                              @click="orderBaru"
                              >Order Baru</a
                            >
                            <a
                              href="javascript:;"
                              v-if="listMenungguPembayaran.length != 0"
                              @click="cancelOrder"
                              >Cancel Order</a
                            >
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-span-12 flex">
                      <span class="text-gray-700"
                        >Tlp : {{ $page.props.req.telpon }},
                      </span>
                      <span class="text-gray-700"
                        >&nbsp;Meja {{ $page.props.table.name }},</span
                      >
                      <span class="text-gray-700"
                        >&nbsp; {{ $page.props.req.pax }} Cust.</span
                      >
                    </div>
                  </div>
                </div>
                <div
                  class="col-span-12 bg-white p-6 pt-12 mb-8 sm:rounded-3xl mx-2 md:mx-0"
                >
                  <div class="flex justify-between">
                    <b>Pesanan</b>
                    <b></b>
                  </div>
                  <ul class="py-4">
                    <li v-for="(item, index) in listPesanan" :key="index" class="py-2">
                      <div class="flex">
                        <img
                          class="rounded object-cover h-12 w-12 mr-2"
                          v-bind:src="item.image"
                          alt=""
                        />
                        <div class="grid grid-cols-12 gap-2 w-full">
                          <div class="col-span-12">
                            <div class="flex justify-between">
                              <b>{{ item.name }}</b
                              ><br />
                              <div class="my-auto">
                                <a href="javascript:;" @click="openItemModal(item)">
                                  <font-awesome-icon
                                    icon="fas fa-edit"
                                    class="text-yellow-400 mr-2"
                                  />
                                </a>
                                <a href="javascript:;" @click="deleteItem(index)">
                                  <font-awesome-icon
                                    icon="fas fa-trash"
                                    class="text-red-600"
                                  />
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-span-12">
                            <div class="flex justify-between w-full">
                              <b class="text-gray-700 mr-1">
                                {{ item.jumlah }} x
                                <span class="text-gray-400">
                                  Rp. {{ accounting.formatNumber(item.price) }}
                                </span>
                              </b>
                              <span class="text-gray-700">
                                <b class="font-extrabold"
                                  >Rp.
                                  {{
                                    accounting.formatNumber(item.price * item.jumlah)
                                  }}</b
                                >
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="pt-6 pb-8">
                      <div class="border-dashed border-b border-black"></div>
                    </li>
                    <li class="flex justify-between">
                      <b class="text-xl">Total</b>
                      <b class="text-xl">Rp. {{ totalPesananFormatMoney }}</b>
                    </li>
                    <li v-if="listPesanan.length != 0" class="text-center w-full my-4">
                      <BreezeButton
                        @click="prosesPesanan"
                        class="rounded-full text-md text-center font-bold text-white bg-purple-700 hover:bg-purple-400 focus:bg-purple-800 active:bg-purple-800 h-8 w-full"
                      >
                        Proses Pesanan</BreezeButton
                      >
                    </li>
                  </ul>
                </div>
                <!-- Menunggu pembayaran -->
                <div
                  class="col-span-12 bg-white p-6 pt-12 mb-8 sm:rounded-3xl mx-2 md:mx-0"
                  v-if="listMenungguPembayaran.length != 0"
                >
                  <div class="flex justify-between">
                    <b>Pesanan</b>
                    <b class="bg-purple-700 px-4 py-1 text-white rounded-full"
                      >Menunggu Pembayaran</b
                    >
                  </div>
                  <ul class="py-4">
                    <li
                      v-for="(item, index) in listMenungguPembayaran"
                      :key="index"
                      class="py-2"
                    >
                      <div class="flex">
                        <img
                          class="rounded object-cover h-12 w-12 mr-2"
                          v-bind:src="item.master_menu.image"
                          alt=""
                        />
                        <div class="grid grid-cols-12 gap-2 w-full">
                          <div class="col-span-12">
                            <div class="flex justify-between">
                              <b>{{ item.master_menu.name }}</b
                              ><br />
                            </div>
                          </div>
                          <div class="col-span-12">
                            <div class="flex justify-between w-full">
                              <b class="text-gray-700 mr-1">
                                {{ item.qty }} x
                                <span class="text-gray-400">
                                  Rp. {{ accounting.formatNumber(item.price) }}
                                </span>
                              </b>
                              <span class="text-gray-700">
                                <b class="font-extrabold"
                                  >Rp. {{ accounting.formatNumber(item.sub_total) }}</b
                                >
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="pt-6 pb-8">
                      <div class="border-dashed border-b border-black"></div>
                    </li>
                    <li class="flex justify-between">
                      <b class="text-xl">Total</b>
                      <b class="text-xl"
                        >Rp. {{ accounting.formatNumber(totalMenungguPembayaran) }}</b
                      >
                    </li>
                    <li v-if="listPesanan.length != 0" class="text-center w-full my-4">
                      <BreezeButton
                        @click="prosesPesanan"
                        class="rounded-full text-md text-center font-bold text-white bg-purple-700 hover:bg-purple-400 focus:bg-purple-800 active:bg-purple-800 h-8 w-full"
                      >
                        Proses Pesanan</BreezeButton
                      >
                    </li>
                  </ul>
                </div>
                <!-- Sudah pembayaran -->
                <div
                  class="col-span-12 bg-white p-6 pt-12 mb-8 sm:rounded-3xl mx-2 md:mx-0"
                  v-if="listSelesai.length != 0"
                >
                  <div class="flex justify-between">
                    <b>Pesanan</b>
                    <b class="bg-green-500 px-4 py-1 text-white rounded-full">Terbayar</b>
                  </div>
                  <ul class="py-4">
                    <li v-for="(item, index) in listSelesai" :key="index" class="py-2">
                      <div class="flex">
                        <img
                          class="rounded object-cover h-12 w-12 mr-2"
                          v-bind:src="item.master_menu.image"
                          alt=""
                        />
                        <div class="grid grid-cols-12 gap-2 w-full">
                          <div class="col-span-12">
                            <div class="flex justify-between">
                              <b>{{ item.master_menu.name }}</b
                              ><br />
                              <img
                                :src="
                                  item.status == 'Sedang Disiapkan'
                                    ? '../assets/images/sedang_disiapkan.png'
                                    : '../assets/images/selesai.png'
                                "
                                class="w-6 my-auto"
                                :title="item.status"
                              />
                            </div>
                          </div>
                          <div class="col-span-12">
                            <div class="flex justify-between w-full">
                              <b class="text-gray-700 mr-1">
                                {{ item.qty }} x
                                <span class="text-gray-400">
                                  Rp. {{ accounting.formatNumber(item.price) }}
                                </span>
                              </b>
                              <span class="text-gray-700">
                                <b class="font-extrabold"
                                  >Rp. {{ accounting.formatNumber(item.sub_total) }}</b
                                >
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="pt-6 pb-8">
                      <div class="border-dashed border-b border-black"></div>
                    </li>
                    <li class="flex justify-between">
                      <b class="text-xl">Total</b>
                      <b class="text-xl"
                        >Rp. {{ accounting.formatNumber(totalSelesai) }}</b
                      >
                    </li>
                    <li v-if="listPesanan.length != 0" class="text-center w-full my-4">
                      <BreezeButton
                        @click="prosesPesanan"
                        class="rounded-full text-md text-center font-bold text-white bg-purple-700 hover:bg-purple-400 focus:bg-purple-800 active:bg-purple-800 h-8 w-full"
                      >
                        Proses Pesanan</BreezeButton
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-span-12 md:col-span-8 sm:rounded-lg">
              <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 align-middle hidden md:block">
                  <b class="text-2xl font-extrabold">List Menu</b>
                </div>
                <div class="col-span-12 justify-between mx-2 md:mx-0 hidden md:flex">
                  <div class="flex">
                    <Category v-model="$data.categoryId" class="my-auto mr-2"></Category>
                    <BreezeButton
                      @click="($data.categoryId = null), ($data.searchValue = '')"
                      class="rounded-full text-md text-center my-auto font-bold text-white bg-purple-700 hover:bg-purple-400 focus:bg-purple-800 active:bg-purple-800 h-8"
                    >
                      Reset
                    </BreezeButton>
                  </div>
                  <div class="flex">
                    <div class="my-auto relative">
                      <font-awesome-icon
                        icon="fas fa-search"
                        :class="{ 'text-gray-700': search, 'text-gray-500': !search }"
                        class="absolute left-3 top-3"
                      />
                      <BreezeInput
                        type="text"
                        v-model="$data.searchValue"
                        @focus.native="search = true"
                        @blur.native="search = false"
                        placeholder="Cari"
                        class="mr-12 rounded-3xl pl-8 pt-2"
                      >
                      </BreezeInput>
                    </div>
                    <a href="javascript:;" class="my-auto">
                      <font-awesome-icon
                        icon="fa-solid fa-table-cells"
                        :class="{
                          'text-purple-700': mode == 'tile',
                          'text-gray-700': mode != 'tile',
                        }"
                        class="text-3xl mr-4"
                        v-on:click="mode = 'tile'"
                      />
                    </a>
                    <a href="javascript:;" class="my-auto">
                      <font-awesome-icon
                        icon="fa-solid fa-list"
                        :class="{
                          'text-purple-700': mode == 'list',
                          'text-gray-700': mode != 'list',
                        }"
                        class="text-3xl"
                        v-on:click="mode = 'list'"
                      />
                    </a>
                  </div>
                </div>

                <div class="col-span-12 justify-between mx-2 md:mx-0 md:hidden">
                  <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-12 flex justify-between mb-2">
                      <Category
                        v-model="$data.categoryId"
                        class="my-auto mr-2"
                      ></Category>
                      <BreezeButton
                        @click="($data.categoryId = null), ($data.searchValue = '')"
                        class="rounded-full text-md text-center my-auto font-bold text-white bg-purple-700 hover:bg-purple-400 focus:bg-purple-800 active:bg-purple-800 h-8"
                      >
                        Reset
                      </BreezeButton>
                    </div>
                    <div class="col-span-12 flex justify-between">
                      <div class="my-auto relative">
                        <font-awesome-icon
                          icon="fas fa-search"
                          :class="{ 'text-gray-700': search, 'text-gray-500': !search }"
                          class="absolute left-3 top-3"
                        />
                        <BreezeInput
                          type="text"
                          v-model="$data.searchValue"
                          @focus.native="search = true"
                          @blur.native="search = false"
                          placeholder="Cari"
                          class="mr-12 rounded-3xl pl-8 pt-2"
                        >
                        </BreezeInput>
                      </div>
                      <div>
                        <a href="javascript:;" class="my-auto">
                          <font-awesome-icon
                            icon="fa-solid fa-table-cells"
                            :class="{
                              'text-purple-700': mode == 'tile',
                              'text-gray-700': mode != 'tile',
                            }"
                            class="text-3xl mr-4"
                            v-on:click="mode = 'tile'"
                          />
                        </a>
                        <a href="javascript:;" class="my-auto">
                          <font-awesome-icon
                            icon="fa-solid fa-list"
                            :class="{
                              'text-purple-700': mode == 'list',
                              'text-gray-700': mode != 'list',
                            }"
                            class="text-3xl"
                            v-on:click="mode = 'list'"
                          />
                        </a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-span-12">
                  <div class="grid grid-cols-12 gap-4 px-2 md:p-0">
                    <Product
                      :mode="mode"
                      :products="products"
                      :category="categoryId"
                      :searchValue="searchValue"
                      @openModal="openItemModal"
                      :col="{
                        'col-span-12': mode == 'list',
                        'col-span-12 md:col-span-3 p-2': mode != 'list',
                      }"
                    >
                    </Product>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Modal modalSize="sm" v-show="isModalItemVisible" @close="closeItemModal">
      <template #header> <b class="text-white">Ingin Berapa Item?</b> </template>
      <template #body>
        <form @submit.prevent="submit" class="grid grid-cols-12 gap-4">
          <ProductDetail :item="itemSelected">
            <div class="flex justify-center col-span-12">
              <div class="w-10 h-10 my-auto mr-4">
                <a
                  class="bg-white rounded-full w-10 h-10 text-center hover:bg-purple-500 cursor-pointer hover:text-white block"
                  @click="decrement"
                  href="javascript:;"
                >
                  <font-awesome-icon icon="fa-solid fa-minus" class="w-5 h-10" />
                </a>
              </div>
              <div class="w-40 h-10 my-auto">
                <BreezeInput
                  id="jumlah"
                  type="text"
                  readonly
                  class="block w-full rounded-full text-center"
                  v-model="$data.jumlahItem"
                  required
                  autocomplete="jumlah"
                  placeholder="Qty"
                />
                <div v-if="v$.jumlahItem.$error">
                  <BreezeInputError message="Jumlah Item Harus Diisi"></BreezeInputError>
                </div>
              </div>
              <div class="w-10 h-10 my-auto ml-4">
                <a
                  class="bg-white rounded-full w-10 h-10 text-center hover:bg-purple-500 cursor-pointer hover:text-white block"
                  @click="increment"
                  href="javascript:;"
                >
                  <font-awesome-icon icon="fa-solid fa-plus" class="w-5 h-10" />
                </a>
              </div>
            </div>
          </ProductDetail>
        </form>
      </template>
      <template #footer>
        <div class="text-center">
          <BreezeButton
            @click="addItem"
            class="rounded-full text-md text-center font-bold text-white bg-purple-700 hover:bg-purple-400 focus:bg-purple-800 active:bg-purple-800 h-8"
          >
            <font-awesome-icon icon="fa-solid fa-cart-shopping" class="mr-2" />Rp.&nbsp;{{
              totalItemFormatMoney
            }}
          </BreezeButton>
        </div>
      </template>
    </Modal>
  </Main>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
export default {
  data() {
    return {
      cash: {
        id: 1,
        name: "Cash",
        image: "../assets/images/wallet.png",
        class: "filter invert",
        type: "cash",
      },
      v$: useVuelidate(),
      accounting: accounting,
      products: this.$page.props.menu,
      reservationId: this.$page.props.reservation_id,
      isModalItemVisible: false,
      isModalBayarVisible: false,
      itemSelected: null,
      search: false,
      searchValue: "",
      mode: "tile",
      jumlahItem: 0,
      orderId: null,
      telpon: this.$page.props.req.telpon,
      name: this.$page.props.req.nama,
      pax: this.$page.props.req.pax,
      tableId: this.$page.props.req.table_id,
      categoryId: null,
      listPesanan:
        this.Cookies.get("pesanan") != undefined
          ? JSON.parse(this.Cookies.get("pesanan"))
          : [],
      listSelesai: [],
      listMenungguPembayaran: [],
      totalPesanan: 0,
      totalMenungguPembayaran: 0,
      metodePembayaran: null,
      sendData: null,
      hasCheckout: false,
    };
  },
  validations() {
    return {
      jumlahItem: { required },
    };
  },
  mounted() {
    this.orderId = this.Cookies.get("order_id");
    this.callApiMenu(this.orderId);
    this.$el.addEventListener("click", this.onClick);
    this.checkTransaction();
  },
  watch: {
    orderId(param) {
      Echo.channel(`orders.${this.orderId}`).listen(`.order`, (message) => {
        this.callApiMenu(message.id);
      });
    },
  },
  computed: {
    totalItemFormatMoney() {
      if (this.itemSelected) {
        var total = this.itemSelected.price * this.jumlahItem;
        return accounting.formatNumber(total);
      }
      return 0;
    },
    totalPesananFormatMoney() {
      var temp = 0;
      this.listPesanan.forEach((val) => {
        temp += val.price * val.jumlah;
      });
      return accounting.formatNumber(temp);
    },
  },
  methods: {
    increment() {
      this.jumlahItem++;
    },
    decrement() {
      if (this.jumlahItem > 0) {
        this.jumlahItem--;
      }
    },
    onClick(param) {
      console.log(param);
    },
    orderBaru() {
      this.Cookies.remove("pesanan");
      this.Cookies.remove("order_id");
      this.Cookies.remove("order");
      this.$inertia.visit("/", {
        method: "get",
        replace: true,
        preserveState: false,
        preserveScroll: false,
      });
    },
    cancelOrder() {
      var el = this;
      this.$swal
        .fire({
          title: "Menghapus order yang belum terbayar?",
          text: "Aksi ini tidak bisa dikembalikan!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, hapus!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.$root.$loading.loading = true;
            axios
              .post("/cancel-order", {
                order_id: el.orderId,
              })
              .then(function (response) {
                // handle success
                if (response.data.status == 1) {
                  el.callApiMenu(el.orderId);
                } else {
                  el.$toaster.warning(response.data.message);
                }

                el.$root.$loading.loading = false;
              })
              .catch(function (error) {
                el.$root.$loading.loading = false;
              })
              .finally(function () {
                el.orderNotifier();
              });
          }
        });
    },
    openItemModal(value, edit) {
      this.isModalItemVisible = true;
      this.itemSelected = value;
      if (this.itemSelected.jumlah) {
        this.jumlahItem = this.itemSelected.jumlah;
      } else {
        this.jumlahItem = 0;
      }
    },
    closeItemModal() {
      this.isModalItemVisible = false;
    },
    closeBayarModal() {
      this.isModalBayarVisible = false;
    },
    async addItem() {
      const isFormCorrect = await this.v$.$validate();
      // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
      if (!isFormCorrect) return;
      this.itemSelected.jumlah = this.jumlahItem;

      var check = false;
      this.listPesanan.forEach((e) => {
        if (e.id == this.itemSelected.id) {
          check = true;
          e.jumlah = this.jumlahItem;
        }
      });

      if (!check) {
        this.listPesanan.push(this.itemSelected);
      }
      //   return false;

      this.Cookies.set("pesanan", JSON.stringify(this.listPesanan), { expires: 1 });
      this.closeItemModal();
      this.itemSelected = null;
      this.jumlahItem = 0;
      this.v$.$reset();
    },
    deleteItem(index) {
      this.listPesanan.splice(index, 1);
      this.Cookies.set("pesanan", JSON.stringify(this.listPesanan), { expires: 1 });
    },
    async callApiMenu(id) {
      var el = this;
      axios
        .post("/progress-menu", {
          order_id: id,
        })
        .then(function (response) {
          // handle success
          if (response.data.status == 1) {
            el.generateOrder(response.data.data);
          }
        })
        .catch(function (error) {});
    },
    async checkTransaction() {
      this.$root.$loading.loading = true;
      var el = this;

      if (this.Cookies.get("order") == undefined) {
        el.$inertia.visit("/", {
          method: "get",
          replace: true,
          preserveState: false,
          preserveScroll: false,
        });
      }

      axios
        .post("/check-transaction", {
          order_id: el.orderId,
        })
        .then(function (response) {
          // handle success
          if (response.data.status == 1) {
            el.Cookies.remove("pesanan");
            el.Cookies.remove("order_id");
            el.Cookies.remove("order");
            el.$inertia.visit("/", {
              method: "get",
              replace: true,
              preserveState: false,
              preserveScroll: false,
            });
          }
          el.$root.$loading.loading = false;
        })
        .catch(function (error) {
          el.$root.$loading.loading = false;
        })
        .finally(function () {});
    },
    async orderNotifier() {
      axios.post("/order-notifier", {
        order_id: this.orderId,
      });
    },
    generateOrder(param) {
      this.listMenungguPembayaran = [];
      this.listSelesai = [];
      this.totalMenungguPembayaran = 0;
      this.totalSelesai = 0;
      param.forEach((element) => {
        if (element.status == "Menunggu Pembayaran") {
          this.listMenungguPembayaran.push(element);
          this.totalMenungguPembayaran += element.sub_total;
        }

        if (element.status == "Sedang Disiapkan" || element.status == "Selesai") {
          this.listSelesai.push(element);
          this.totalSelesai += element.sub_total;
        }
      });
    },
    async prosesPesanan() {
      var el = this;
      this.$swal
        .fire({
          title: "Memesan makanan?",
          text: "Aksi ini tidak bisa dikembalikan!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, pesan sekarang!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.$root.$loading.loading = true;
            axios
              .post("/process-order", {
                telpon: el.telpon,
                name: el.name,
                pax: el.pax,
                item: el.listPesanan,
                table_id: el.tableId,
                order_id: el.orderId,
                reservation_id: el.reservationId,
              })
              .then(function (response) {
                // handle success
                if (response.data.status == 1) {
                  el.$swal.fire("Berhasil!", response.data.message, "success");
                  el.orderId = response.data.order_id;
                  el.Cookies.set("order_id", response.data.order_id, { expires: 1 });

                  el.Cookies.remove("pesanan");
                  el.products.forEach((element) => {
                    element.jumlah = 0;
                  });

                  el.listPesanan.splice(0);
                } else {
                  el.$toaster.warning(response.data.message);
                }

                el.$root.$loading.loading = false;
              })
              .catch(function (error) {
                el.$root.$loading.loading = false;
              })
              .finally(function () {
                el.orderNotifier();
              });
          }
        });

      //   this.listPesanan.forEach((element) => {
      //     this.listCheckout.push(element);
      //   });
      //   this.listPesanan = [];
    },
    modalCheckout() {
      this.isModalBayarVisible = true;
    },
    checkout() {
      this.hasCheckout = true;
    },
    backToPaymentMethod() {
      this.metodePembayaran = null;
    },
    openDropdown() {
      document.getElementById("myDropdown").classList.toggle("show");
    },
    printReceipt() {
      this.$inertia.visit("/", {
        method: "get",
        data: {
          nama: this.nama,
          jumlah: this.jumlah,
          mejaId: this.mejaId,
        },
        replace: true,
        preserveState: true,
        preserveScroll: false,
        only: [],
        headers: {},
        errorBag: null,
        onCancelToken: (cancelToken) => {},
        onCancel: () => {},
        onBefore: (visit) => {},
        onStart: (visit) => {},
        onProgress: (progress) => {},
        onSuccess: (page) => {},
        onError: (errors) => {},
        onFinish: () => {},
      });
    },
  },
};
</script>
