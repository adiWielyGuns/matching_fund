<script setup>
import Main from "@/Layouts/Main.vue";
import BreezeButton from "@/Components/Button.vue";
import Modal from "@/Components/Modal.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import useVuelidate from "@vuelidate/core";
import Meja from "@/Dummy/Meja.vue";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
</script>

<template>
  <Head title="Dashboard" />
  <Main>
    <div class="py-8">
      <div class="mb-6">
        <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true">
          <Slide v-for="item in $data.promo" :key="item">
            <div class="carousel__item">
              <img :src="item.url" class="w-full rounded-lg object-contain h-56" />
            </div>
          </Slide>
          <template #addons>
            <Navigation />
          </template>
        </Carousel>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col-span-12 text-center">
          <p class="text-center text-xl font-bold mb-6">
            <b>Matching Fund<br />Minggirsari</b>
          </p>
        </div>
        <div class="col-span-12 text-center">
          <BreezeButton
            class="rounded-full text-md text-center py-4 font-bold text-white bg-purple-500 hover:bg-purple-400 md:w-3/12 w-1/2 focus:bg-purple-800 active:bg-purple-800"
            @click="showModal('order')"
            >Order Sekarang
          </BreezeButton>
        </div>
        <div class="col-span-12 text-center">
          <p class="text-center py-6 text-sm">
            Tekan order sekarang untuk melakukan pemesanan <br />
            atau lakukan reservasi dibawah ini
          </p>
        </div>
        <div class="col-span-12 text-center">
          <BreezeButton
            class="rounded-full text-md md:px-20 py-4 font-bold text-gray-700 bg-yellow-500 hover:bg-yellow-400 md:w-3/12 w-1/2 focus:bg-yellow-700 active:bg-yellow-700"
            @click="showModal('reservasi')"
            >Reservasi
          </BreezeButton>
        </div>
      </div>
    </div>
    <Modal modalSize="sm" v-show="isModalVisible" @close="closeModal">
      <template #header>
        <span class="text-white font-extrabold">Isi Data Anda</span>
      </template>
      <template #body>
        <form @submit.prevent="submit" class="grid grid-cols-12 gap-4">
          <div class="col-span-12">
            <BreezeLabel for="nama" value="Nama" class="text-white font-extrabold" />
            <BreezeInput
              id="nama"
              type="text"
              class="mt-1 block w-full rounded-3xl"
              v-model="$data.nama"
              required
              autocomplete="nama"
              placeholder="Masukan nama anda"
            />
            <div v-if="v$.nama.$error">
              <BreezeInputError message="Nama Harus Diisi"></BreezeInputError>
            </div>
          </div>
          <div class="col-span-12">
            <BreezeLabel
              for="table_id"
              value="Nomor Meja"
              class="text-white font-extrabold"
            />
            <Meja v-model="$data.table_id" class="rounded-3xl"> </Meja>
            <div v-if="v$.table_id.$error">
              <BreezeInputError message="Nomor Meja Harus Diisi"></BreezeInputError>
            </div>
          </div>
          <div class="col-span-12" v-if="jenis == 'order' ? false : true">
            <BreezeLabel
              for="tanggal"
              value="Tanggal Reservasi"
              class="text-white font-extrabold"
            />
            <Datepicker
              v-model="$data.tanggal"
              position="right"
              :autoPosition="false"
              utc="preserve"
              :minDate="new Date()"
            />
            <div v-if="v$.tanggal.$error">
              <BreezeInputError message="Tanggal Harus Diisi"></BreezeInputError>
            </div>
          </div>
          <div class="col-span-12">
            <BreezeLabel
              for="pax"
              value="Jumlah Pelanggan"
              class="text-white font-extrabold"
            />
            <BreezeInput
              id="pax"
              type="number"
              class="mt-1 block w-full rounded-3xl"
              v-model="$data.pax"
              required
              autocomplete="pax"
              placeholder="Masukan jumlah pelanggan"
            />
            <div v-if="v$.pax.$error">
              <BreezeInputError message="Jumlah Pelanggan Harus Diisi"></BreezeInputError>
            </div>
          </div>
          <div class="col-span-12">
            <BreezeLabel for="telpon" value="Telpon" class="text-white font-extrabold" />
            <BreezeInput
              id="telpon"
              type="text"
              class="mt-1 block w-full rounded-3xl"
              v-model="$data.telpon"
              required
              autocomplete="telpon"
              placeholder="Masukan telpon anda"
            />
            <div v-if="v$.telpon.$error">
              <BreezeInputError message="Telpon Harus Diisi"></BreezeInputError>
            </div>
          </div>
          <div class="col-span-12 text-center" v-if="jenis == 'order' ? true : false">
            <span class="text-white"
              >Atau masukkan kode reservasi. <br />
              jika anda melakukan reservasi sebelumnya</span
            >
          </div>
          <div class="col-span-12" v-if="jenis == 'order' ? true : false">
            <BreezeInput
              id="kode"
              type="text"
              class="mt-1 block w-full rounded-3xl"
              v-model="$data.kode"
              required
              autocomplete="kode"
              placeholder="Masukan kode reservasi anda"
            />
          </div>
        </form>
      </template>
      <template #footer>
        <div class="text-center">
          <BreezeButton
            @click="onsubmit"
            class="text-gray-700 hover:bg-yellow-300 focus:bg-yellow-700 active:bg-yellow-700 bg-yellow-500 font-extrabold"
          >
            {{ modalOpened }}</BreezeButton
          >
        </div>
      </template>
    </Modal>
  </Main>
</template>

<script>
import { required } from "@vuelidate/validators";
import Datepicker from "@vuepic/vue-datepicker";
export default {
  data() {
    return {
      v$: useVuelidate(),
      isModalVisible: false,
      nama: null,
      pax: null,
      telpon: null,
      tanggal: null,
      table_id: null,
      kode: null,
      jenis: null,
      latitude: null,
      longitude: null,
      promo: this.$page.props.blogs,
      settings: {
        itemsToShow: 1,
        snapAlign: "center",
      },
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 3,
          snapAlign: "center",
        },
      },
    };
  },
  created() {
    this.getLocation();
    if (this.Cookies.get("order") != undefined) {
      this.$inertia.visit("/order", {
        method: "get",
        data: JSON.parse(this.Cookies.get("order")),
        replace: false,
        preserveState: true,
        preserveScroll: false,
      });
    }
  },
  computed: {
    modalOpened() {
      return this.jenis == "order" ? "Lanjutkan pemesanan" : "Reservasi sekarang";
    },
  },
  validations() {
    const localRules = {
      nama: { required },
      pax: { required },
      telpon: { required },
      table_id: { required },
    };

    if (this.jenis == "reservasi") {
      localRules.tanggal = { required };
    } else {
      localRules.tanggal = {};
    }

    return localRules;
  },
  methods: {
    showModal(param) {
      this.v$.$reset();
      this.jenis = param;
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    async onsubmit() {
      if (this.jenis == "order") {
        await this.submit();
      } else {
        await this.submitReservasi();
      }
    },
    getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this.showPosition);
      } else {
        this.location = "Geolocation is not supported by this browser.";
      }
    },
    showPosition(position) {
      this.latitude = position.coords.latitude;
      this.longitude = position.coords.longitude;
    },
    async submit() {
      var el = this;
      if (this.kode == null || this.kode == "") {
        const isFormCorrect = await this.v$.$validate();
        // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
        if (!isFormCorrect) return;

        var data = {
          nama: el.nama,
          telpon: el.telpon,
          pax: el.pax,
          table_id: el.table_id,
        };

        el.Cookies.set("order", JSON.stringify(data), { expires: 1 });

        el.$inertia.visit("/order", {
          method: "get",
          data: data,
          replace: false,
          preserveState: true,
          preserveScroll: false,
        });
      } else {
        this.v$.$reset();
      }

      axios
        .post("/check-location", {
          latitude: this.latitude,
          longitude: this.longitude,
        })
        .then(function (response) {
          // handle success
          if (response.data.status == 1) {
            if (el.kode != null && el.kode != "") {
              el.$root.$loading.loading = true;
              axios
                .post("/checkIfCodeExist", {
                  kode: el.kode,
                  latitude: el.latitude,
                  longitude: el.longitude,
                })
                .then(function (response) {
                  // handle success
                  if (response.data.status == 1) {
                    el.nama = response.data.data.nama;
                    el.telpon = response.data.data.telpon;
                    el.pax = response.data.data.pax;
                    el.table_id = response.data.data.table_id;

                    var data = {
                      nama: el.nama,
                      telpon: el.telpon,
                      pax: el.pax,
                      table_id: el.table_id,
                      reservation_id: response.data.reservation_id,
                    };

                    el.Cookies.set("order", JSON.stringify(data), { expires: 1 });

                    el.$inertia.visit("/order", {
                      method: "get",
                      data: data,
                      replace: false,
                      preserveState: true,
                      preserveScroll: false,
                    });
                  } else {
                    el.$toaster.warning(response.data.message);
                  }

                  el.$root.$loading.loading = false;
                })
                .catch(function (error) {
                  el.$root.$loading.loading = false;
                })
                .finally(function () {});
            }
          } else {
            el.$toaster.warning(response.data.message);
          }

          el.$root.$loading.loading = false;
        })
        .catch(function (error) {
          el.$root.$loading.loading = false;
        })
        .finally(function () {});
    },
    async submitReservasi() {
      const isFormCorrect = await this.v$.$validate();
      // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
      if (!isFormCorrect) return;

      var el = this;
      this.$root.$loading.loading = true;

      axios
        .post("/submit-reservasi", {
          nama: this.nama,
          telpon: this.telpon,
          pax: this.pax,
          table_id: this.table_id,
          tanggal: this.tanggal,
        })
        .then(function (response) {
          // handle success

          if (response.data.status == 1) {
            el.$inertia.visit("/receipt", {
              method: "get",
              data: {
                id: response.data.id,
              },
              replace: false,
              preserveState: true,
              preserveScroll: false,
            });
          } else {
            el.$toaster.warning(response.data.message);
          }

          el.$root.$loading.loading = false;
        })
        .catch(function (error) {
          // handle error
          el.$root.$loading.loading = false;
        })
        .finally(function () {
          // always executed
        });
    },
  },
};
</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}

.carousel__viewport {
  perspective: 2000px;
}

.carousel__track {
  transform-style: preserve-3d;
}

.carousel__slide--sliding {
  transition: 0.5s;
}

.carousel__slide {
  opacity: 0.9;
  transform: rotateY(-20deg) scale(0.9);
}

.carousel__slide--active ~ .carousel__slide {
  transform: rotateY(20deg) scale(0.9);
}

.carousel__slide--prev {
  opacity: 1;
  transform: rotateY(-20deg) scale(0.9);
}

.carousel__slide--next {
  opacity: 1;
  transform: rotateY(10deg) scale(0.95);
}

.carousel__slide--active {
  opacity: 1;
  transform: rotateY(0) scale(1.1);
}
</style>
