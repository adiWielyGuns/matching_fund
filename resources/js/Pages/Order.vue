
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
  faPlus
} from "@fortawesome/free-solid-svg-icons";

library.add(faUserSecret, faSearch, faList, faTableCells, faTrash, faEdit, faUser, faEllipsisVertical, faMinus, faPlus, faCartShopping);
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
                <div class="col-span-12 bg-white mb-8 px-14 rounded-3xl pt-10 pb-6">
                  <div class="grid grid-cols-12">
                    <div class="col-span-12 flex justify-between">
                      <div class="flex">
                        <img class="h-7 mr-2" :src="'../assets/images/user.png'" alt="" />
                        <span class="text-gray-700 text-2xl inline-block align-middle my-auto">
                          {{ $page.props.req.nama}}
                          {{ activateDropdown }}
                        </span>
                      </div>
                      <a href="javascript:;" class="my-auto text-gray-700 hover:text-purple-700">
                        <div class="dropdown" :class="{'show':activateDropdown}">
                          <a class="nav-link" @click="activateDropdown?activateDropdown=false:activateDropdown=true"
                            data-toggle="dropdown" href="#" aria-expanded="true">
                            <font-awesome-icon class=" text-xl" icon="fa-solid fa-ellipsis-vertical" />
                          </a>
                          <div class="dropdown-menu dropdown-menu-left" :class="{'show':activateDropdown}"
                            x-placement="bottom-start"
                            style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="javascript:;" onclick="edit('12')" class="dropdown-item">
                              <i class="fas fa-edit"></i>&nbsp;&nbsp;&nbsp;Edit
                            </a>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-span-12 flex">
                      <span class="text-gray-700">Tlp : {{ $page.props.req.telpon }},
                      </span>
                      <span class="text-gray-700">&nbsp;Meja {{ $page.props.table.name }},</span>
                      <span class="text-gray-700">&nbsp; {{ $page.props.req.pax }} Cust.</span>
                    </div>
                  </div>
                </div>
                <div class="col-span-12 bg-white p-6 pt-12 mb-8 sm:rounded-3xl">
                  <div class="flex justify-between">
                    <b>Pesanan</b>
                    <b></b>
                  </div>
                  <ul class="py-4">
                    <li v-for="(item, index) in listPesanan" :key="index" class=" py-2">
                      <div class="flex">
                        <img class="rounded object-cover h-12 w-12 mr-2" v-bind:src="item.image" alt="" />
                        <div class="grid grid-cols-12 gap-2  w-full">
                          <div class="col-span-12">
                            <div class="flex justify-between">
                              <b>{{ item.name }}</b><br />
                              <div class="my-auto">
                                <a href="javascript:;" @click="openItemModal(item)">
                                  <font-awesome-icon icon="fas fa-edit" class="text-yellow-400 mr-2" />
                                </a>
                                <a href="javascript:;" @click="deleteItem(index)">
                                  <font-awesome-icon icon="fas fa-trash" class="text-red-600" />
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-span-12">

                            <div class="flex justify-between w-full">
                              <b class="text-gray-700 mr-1">
                                {{ item.jumlah }} x
                                <span class="text-gray-400">
                                  Rp. {{ accounting.formatNumber(item.price)}}
                                </span>
                              </b>
                              <span class="text-gray-700">
                                <b class="font-extrabold">Rp. {{accounting.formatNumber(item.price * item.jumlah)}}</b>
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
                      <BreezeButton @click="prosesPesanan"
                        class="rounded-full text-md text-center font-bold text-white bg-purple-700 hover:bg-purple-400  focus:bg-purple-800 active:bg-purple-800 h-8 w-full">
                        Proses Pesanan</BreezeButton>
                    </li>
                  </ul>
                </div>
                <div class="col-span-12 bg-white p-6 sm:rounded-lg">
                  <div class="flex justify-between">
                    <b>Pesanan Sudah Di Checkout</b>
                  </div>
                  <ul class="py-4">
                    <li v-for="(item, index) in listCheckout" :key="index" class="flex py-2">
                      <img class="rounded object-cover h-12 w-12 mr-2" v-bind:src="item.image" alt="" />
                      <span>
                        <b>{{ item.name }}</b><br />
                        <b class="text-gray-700 mr-1">{{ item.jumlah }} x
                          <span class="text-gray-400">{{
                          item.disc != "0" ? item.disc : item.price
                          }}</span></b>
                        <b class="text-gray-700 text-xs line-through" v-if="item.disc != '0'">Rp. {{ item.price }}</b>
                      </span>
                    </li>
                    <li v-if="listCheckout.length != 0" class="text-center w-full my-4">
                      <BreezeButton @click="modalCheckout">Bayar Sekarang</BreezeButton>
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
                <div class="col-span-12 flex justify-between">
                  <Category v-model="$data.categoryId" class="my-auto"></Category>
                  <div class="flex">
                    <div class="my-auto relative">
                      <font-awesome-icon icon="fas fa-search"
                        :class="{ 'text-gray-700': search, 'text-gray-500': !search }" class="absolute left-3 top-3" />
                      <BreezeInput type="text" v-model="$data.searchValue" @focus.native="search = true"
                        @blur.native="search = false" placeholder="Cari" class="mr-12 rounded-3xl pl-8 pt-2">
                      </BreezeInput>
                    </div>
                    <a href="javascript:;" class="my-auto">
                      <font-awesome-icon icon="fa-solid fa-table-cells" :class="{
                        'text-purple-700': mode == 'tile',
                        'text-gray-700': mode != 'tile',
                      }" class="text-3xl mr-4" v-on:click="mode = 'tile'" />
                    </a>
                    <a href="javascript:;" class="my-auto">
                      <font-awesome-icon icon="fa-solid fa-list" :class="{
                        'text-purple-700': mode == 'list',
                        'text-gray-700': mode != 'list',
                      }" class="text-3xl" v-on:click="mode = 'list'" />
                    </a>
                  </div>
                </div>
                <div class="col-span-12">
                  <div class="grid grid-cols-12 gap-4 px-2 md:p-0">
                    <Product :mode="mode" :category="categoryId" :searchValue="searchValue" @openModal="openItemModal"
                      :col="{
                        'col-span-12': mode == 'list',
                        'col-span-12 md:col-span-3 p-2': mode != 'list',
                      }">
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
              <div class="w-10 h-10 my-auto mr-4 ">
                <a class="bg-white rounded-full w-10 h-10 text-center hover:bg-purple-500 cursor-pointer hover:text-white block"
                  @click="decrement" href="javascript:;">
                  <font-awesome-icon icon="fa-solid fa-minus" class="w-5 h-10" />
                </a>
              </div>
              <div class="w-40 h-10 my-auto">
                <BreezeInput id="jumlah" type="text" readonly class="block w-full rounded-full text-center"
                  v-model="$data.jumlahItem" required autocomplete="jumlah" placeholder="Qty" />
                <div v-if="v$.jumlahItem.$error">
                  <BreezeInputError message="Jumlah Item Harus Diisi"></BreezeInputError>
                </div>
              </div>
              <div class="w-10 h-10 my-auto ml-4 ">
                <a class="bg-white rounded-full w-10 h-10 text-center hover:bg-purple-500 cursor-pointer hover:text-white block"
                  @click="increment" href="javascript:;">
                  <font-awesome-icon icon="fa-solid fa-plus" class="w-5 h-10" />
                </a>
              </div>
            </div>
          </ProductDetail>
        </form>
      </template>
      <template #footer>
        <div class="text-center">
          <BreezeButton @click="addItem"
            class="rounded-full text-md text-center font-bold text-white bg-purple-700 hover:bg-purple-400  focus:bg-purple-800 active:bg-purple-800 h-8">
            <font-awesome-icon icon="fa-solid fa-cart-shopping" class="mr-2" />Rp.&nbsp;{{ totalItemFormatMoney }}
          </BreezeButton>
        </div>
      </template>
    </Modal>

    <Modal modalSize="sm" v-show="isModalBayarVisible" @close="closeBayarModal" :allowClose="!hasCheckout">
      <template #header> Bayar Sekarang? </template>
      <template #body>
        <form @submit.prevent="submit" class="grid grid-cols-12 gap-4" v-if="!metodePembayaran">
          <div class="col-span-12 text-center text-gray-700">
            <BreezeLabel value="Total Bayar Anda" />
            <p class="text-xl">
              <!-- <b>Rp. {{ totalCheckoutFormatMoney }}</b> -->
            </p>
          </div>
          <div class="col-span-12 md:col-span-6 border border-gray-200 rounded-md">
            <div class="flex flex-col text-center h-60 align-middle justify-between">
              <div>
                <div class="p-2 text-center">
                  <b class="text-gray-700">Non Tunai</b>
                </div>
                <div class="w-12 border-b border-gray-200 mx-auto"></div>
              </div>
              <div class="align-middle p-2">
                <CashLess v-model="$data.metodePembayaran"></CashLess>
              </div>
              <div class="p-2">
                <span class="text-xs">Pembayaran dapat melaui OVO, Gopay dan ShoppePay</span>
              </div>
            </div>
          </div>
          <div class="col-span-12 md:col-span-6 border border-gray-200 rounded-md">
            <div class="flex flex-col text-center h-60 align-middle justify-between">
              <div>
                <div class="p-2 text-center">
                  <b class="text-gray-700">Cash</b>
                </div>
                <div class="w-12 border-b border-gray-200 mx-auto"></div>
              </div>
              <div class="align-middle">
                <button @click="metodePembayaran = cash"
                  class="items-center px-4 py-2 text-center bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-600 active:bg-orange-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 w-20 h-20">
                  <img class="object-cover filter invert inline" v-bind:src="'../assets/images/wallet.png'" alt="" />
                </button>
              </div>
              <div class="p-2">
                <span class="text-xs">
                  Anda dapat membayar pesanan anda langsung di kasir
                </span>
              </div>
            </div>
          </div>
        </form>
        <form @submit.prevent="submit" class="grid grid-cols-12 gap-4" v-if="metodePembayaran">
          <div class="col-span-12 text-center text-gray-700">
            <a href="javascript:;" class="float-left absolute left-4" @click="backToPaymentMethod"
              v-if="!hasCheckout">Kembali</a>
            <div>
              <BreezeLabel value="Total Bayar Anda" />
              <p class="text-xl">
                <!-- <b>Rp. {{ totalCheckoutFormatMoney }}</b> -->
              </p>
            </div>
          </div>
          <div class="col-span-12 border border-gray-200 rounded-md">
            <div class="flex flex-col text-center h-72 align-middle justify-between">
              <div>
                <div class="p-2 text-center">
                  <img v-bind:src="metodePembayaran.image" class="w-12 h-12 inline" alt="" />
                </div>
                <div class="w-12 border-b border-gray-200 mx-auto"></div>
              </div>
              <div class="align-top px-12 grid grid-cols-12 gap-2" v-if="!hasCheckout">
                <div class="col-span-12 flex justify-between mb-2">
                  <label for="" class="text-gray-800"><b>Nama Merchant</b></label>
                  <label for="" class="text-gray-800"><b>Self Order App</b></label>
                </div>
                <div class="col-span-12 flex justify-between mb-2">
                  <label for="" class="text-gray-800"><b>Invoice ID</b></label>
                  <label for="" class="text-gray-800"><b>XXXXXXXXX</b></label>
                </div>
              </div>
              <div class="align-middle px-12 py-2" v-if="hasCheckout && metodePembayaran.type == 'cashless'">
                <img class="object-cover w-20 h-20 inline" v-bind:src="'../assets/images/ok.png'" alt="" />
                <p class="my-4" style="color: #64b747">Pembayaran Anda Berhasil</p>
              </div>
              <div class="align-middle px-12" v-if="hasCheckout && metodePembayaran.type == 'cash'">
                <img class="object-cover w-24 h-24 inline" v-bind:src="'../assets/images/qr-code.png'" alt="" />
              </div>
              <div class="p-2">
                <span class="text-xs" v-if="!hasCheckout">Pastikan data anda benar lalu klik checkout</span>
                <span class="text-xs" v-if="hasCheckout">Bawa QR Code ini ke kasir untuk melakukan pembayaran</span>
              </div>
            </div>
          </div>
        </form>
      </template>
      <template #footer>
        <div class="text-center">
          <BreezeButton @click="checkout" v-if="metodePembayaran && !hasCheckout">CHECKOUT</BreezeButton>
          <BreezeButton @click="printReceipt"
            v-if="hasCheckout && metodePembayaran && metodePembayaran.type == 'cashless'">Print Receipt</BreezeButton>
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
      isModalItemVisible: false,
      isModalBayarVisible: false,
      itemSelected: null,
      search: false,
      searchValue: "",
      mode: "tile",
      jumlahItem: 0,
      categoryId: [],
      listPesanan: this.Cookies.get("pesanan") != undefined ? JSON.parse(this.Cookies.get("pesanan")) : [],
      listCheckout: [],
      listCheckout: [],
      totalPesanan: 0,
      totalCheckout: 0,
      activateDropdown: false,
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
    this.$el.addEventListener('click', this.onClick);
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
      console.log(param)
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
    prosesPesanan() {
      this.listPesanan.forEach((element) => {
        this.listCheckout.push(element);
      });
      this.listPesanan = [];
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
        onCancelToken: (cancelToken) => { },
        onCancel: () => { },
        onBefore: (visit) => { },
        onStart: (visit) => { },
        onProgress: (progress) => { },
        onSuccess: (page) => { },
        onError: (errors) => { },
        onFinish: () => { },
      });
    },
  },
};
</script>
