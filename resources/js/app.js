import './bootstrap';
import '../css/app.css';

import { createApp, h, reactive } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import useVuelidate from "@vuelidate/core";
import Toast, { useToast } from "vue-toastification";
import Datepicker from '@vuepic/vue-datepicker';
import Cookies from 'js-cookie'
import VueSweetalert2 from 'vue-sweetalert2';
import VueQrcode from 'vue-qrcode'
let accounting = document.createElement("script");
accounting.setAttribute("src", "../assets/js/accounting/accounting.js");
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
document.head.appendChild(accounting);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        var apps = createApp({ render: () => h(app, props) });
        apps.config.globalProperties.$toaster = useToast();
        apps.config.globalProperties.Cookies = Cookies;
        apps.config.globalProperties.$loading = reactive({
            loading: false,
        });

        return apps
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(useVuelidate)
            .use(Toast)
            .use(Datepicker)
            .use(Cookies)
            .use(VueSweetalert2)
            .use(VueQrcode)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
