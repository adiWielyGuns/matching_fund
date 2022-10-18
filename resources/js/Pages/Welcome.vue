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
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
</script>

<template>

    <Head title="Dashboard" />
    <Main>
        <div class="py-8">
            <div class="mb-6">
                <Carousel :settings="settings" :breakpoints="breakpoints" :wrap-around="true">
                    <Slide v-for="(item) in $data.promo" :key="item">
                        <div class="carousel__item">
                            <img :src="item.url" class="w-full rounded-lg object-contain h-56">
                        </div>
                    </Slide>
                    <template #addons>
                        <Navigation />
                    </template>
                </Carousel>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="col-span-12 text-center">
                    <p class="text-center text-xl font-bold mb-6"><b>Matching Fund<br>Minggirsari</b></p>
                </div>
                <div class="col-span-12 text-center">
                    <BreezeButton
                        class="rounded-full text-md text-center py-4 font-bold text-white bg-purple-500 hover:bg-purple-400 w-3/12 focus:bg-purple-800 active:bg-purple-800"
                        @click="showModal">Order Sekarang
                    </BreezeButton>
                </div>
                <div class="col-span-12 text-center">
                    <p class="text-center py-6 text-sm">Tekan order sekarang untuk melakukan pemesanan <br>
                        atau lakukan reservasi dibawah ini</p>
                </div>
                <div class="col-span-12 text-center">
                    <BreezeButton
                        class="rounded-full text-md px-20 py-4 font-bold text-gray-700 bg-yellow-500 hover:bg-yellow-400 w-3/12 focus:bg-yellow-700 active:bg-yellow-700"
                        @click="showModal">Reservasi
                    </BreezeButton>
                </div>
            </div>
        </div>
        <Modal modalSize="sm" v-show="isModalVisible" @close="closeModal">
            <template #header> Isi Data Anda </template>
            <template #body>
                <form @submit.prevent="submit" class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <BreezeLabel for="nama" value="Nama" />
                        <BreezeInput id="nama" type="text" class="mt-1 block w-full" v-model="$data.nama" required
                            autocomplete="nama" placeholder="Masukan nama anda" />
                        <div v-if="v$.nama.$error">
                            <BreezeInputError message="Nama Harus Diisi"></BreezeInputError>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <BreezeLabel for="jumlah" value="Jumlah Orang" />
                        <BreezeInput id="jumlah" type="number" class="mt-1 block w-full" v-model="$data.jumlah" required
                            autocomplete="jumlah" placeholder="Masukan jumlah pengunjung" />
                        <div v-if="v$.jumlah.$error">
                            <BreezeInputError message="Jumlah Orang Harus Diisi"></BreezeInputError>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <BreezeLabel for="jumlah" value="Jumlah Meja" />
                        <Meja v-model="$data.mejaId"> </Meja>
                        <div v-if="v$.mejaId.$error">
                            <BreezeInputError message="Nomor Meja Harus Diisi"></BreezeInputError>
                        </div>
                    </div>
                </form>
            </template>
            <template #footer>
                <div class="text-center">
                    <BreezeButton @click="submit" class="text-white">Lanjutkan Ke Pemesanan</BreezeButton>
                </div>
            </template>
        </Modal>
    </Main>
</template>

<script>
import { required } from "@vuelidate/validators";


export default {
    data() {
        return {
            v$: useVuelidate(),
            isModalVisible: false,
            nama: "",
            jumlah: "",
            mejaId: null,
            promo: [
                {
                    id: 1,
                    url: "../assets/images/promo.png",
                    title: "Promo 1",
                },
                {
                    id: 2,
                    url: "../assets/images/promo.png",
                    title: "Promo 2",
                },
                {
                    id: 1,
                    url: "../assets/images/promo.png",
                    title: "Promo 1",
                },
                {
                    id: 2,
                    url: "../assets/images/promo.png",
                    title: "Promo 2",
                },
                {
                    id: 1,
                    url: "../assets/images/promo.png",
                    title: "Promo 1",
                },
                {
                    id: 2,
                    url: "../assets/images/promo.png",
                    title: "Promo 2",
                },
                {
                    id: 1,
                    url: "../assets/images/promo.png",
                    title: "Promo 1",
                },
                {
                    id: 2,
                    url: "../assets/images/promo.png",
                    title: "Promo 2",
                },
            ],
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
            },
            breakpoints: {
                // 700px and up
                700: {
                    itemsToShow: 3,
                    snapAlign: 'center',
                },

            },
        };
    },
    validations() {
        return {
            nama: { required },
            jumlah: { required },
            mejaId: { required },
        };
    },
    methods: {
        showModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        },
        async submit() {
            const isFormCorrect = await this.v$.$validate();

            // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
            if (!isFormCorrect) return;

            this.$inertia.visit("/order", {
                method: "get",
                data: {
                    nama: this.nama,
                    jumlah: this.jumlah,
                    mejaId: this.mejaId,
                },
                replace: false,
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

.carousel__slide--active~.carousel__slide {
    transform: rotateY(20deg) scale(0.9);
}

.carousel__slide--prev {
    opacity: 1;
    transform: rotateY(-20deg) scale(0.90);
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