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
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        var apps = createApp({ render: () => h(app, props) });
        apps.config.globalProperties.$toaster = useToast();
        apps.config.globalProperties.$loading = reactive({
            loading: false,
        });

        return apps
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(useVuelidate)
            .use(Toast)
            .use(Datepicker)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
