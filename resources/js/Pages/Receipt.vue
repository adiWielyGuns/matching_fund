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
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-12 gap-2">
        <div class="col-span-12" id="element-to-convert">
          <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12 text-center">
              <p class="text-center text-xl font-bold mb-2 text-gray-800">
                <b>Reservasi Meja Pelanggan</b>
              </p>
            </div>
            <div class="col-span-12 text-center">
              <p class="text-center text-xl font-bold mb-2 text-gray-800">
                <span class="text-gray-500 text-3xl mr-8">Ref</span>
                <span class="text-gray-800 text-3xl font-extrabold"
                  >#{{ $page.props.data.kode }}</span
                >
              </p>
            </div>
            <div class="col-span-12 flex justify-center">
              <div>
                <vue-qrcode
                  :value="$page.props.data.kode"
                  :scale="8"
                  :margin="2"
                  class="mr-8"
                />
              </div>
              <div>
                <div class="grid grid-cols-12 gap-3">
                  <div class="col-span-12">
                    <BreezeLabel value="Nama" class="text-gray-500" />
                    <p class="font-extrabold">{{ $page.props.data.nama }}</p>
                  </div>
                  <div class="col-span-12">
                    <BreezeLabel value="No Tlp" class="text-gray-500" />
                    <p class="font-extrabold">{{ $page.props.data.telpon }}</p>
                  </div>
                  <div class="col-span-12">
                    <BreezeLabel value="Tanggal & Jam" class="text-gray-500" />
                    <p class="font-extrabold">{{ $page.props.date }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-span-12 text-center">
          <span class="w-1/2 text-center text-gray-800">
            untuk melakukan pembayaran & upload bukti pembayaran<br />sebagai tanda jadi
            sebesar 100k melalui whatsapp dengan<br />menekan tombol dibawah ini.
          </span>
        </div>
        <div class="col-span-12 text-center">
          <BreezeButton
            class="rounded-full text-md text-center py-3 mb-2 font-bold text-white bg-purple-500 hover:bg-purple-400 md:w-3/12 w-1/2 focus:bg-purple-800 active:bg-purple-800"
            @click="redirectWa()"
            >Whatsapp
          </BreezeButton>
        </div>
        <div class="col-span-12 text-center mb-2">
          <span class="w-1/2 text-center text-gray-800 font-semibold">
            Atau download booking reservasi dibawah ini
          </span>
        </div>
        <div class="col-span-12 text-center">
          <BreezeButton
            class="rounded-full text-md md:px-20 py-3 font-bold text-gray-700 bg-yellow-500 hover:bg-yellow-400 md:w-3/12 w-1/2 focus:bg-yellow-700 active:bg-yellow-700"
            @click="exportToPDF"
            >Download
          </BreezeButton>
        </div>
      </div>
    </div>
  </Main>
</template>

<script>
import { required } from "@vuelidate/validators";
import VueQrcode from "vue-qrcode";
import html2pdf from "html2pdf.js";
export default {
  components: {
    VueQrcode,
  },
  data() {
    return {
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
  methods: {
    redirectWa() {
      var text =
        "Hi, ingin melakukan reservasi atas kode reservasi " + this.$page.props.data.kode;
      var telpon = this.$page.props.telpon;
      window.open("https://api.whatsapp.com/send?phone=" + telpon + "&text=" + text);
    },
    generateReceipt() {
      this.$refs.html2Pdf.generatePdf();
    },
    exportToPDF() {
      var filename = this.$page.props.data.kode + ".pdf";

      html2pdf(document.getElementById("element-to-convert"), {
        margin: 2,
        filename: filename,
        html2canvas: { scale: 2 },
        image: { type: "jpeg", quality: 5 },
        jsPDF: { unit: "in", format: "letter", orientation: "landscape" },
      });
    },
  },
};
</script>
