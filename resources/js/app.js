import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { useNotification } from "@kyvg/vue3-notification";
import { createPinia } from 'pinia';

import Notifications from '@kyvg/vue3-notification'
// import { notify } from "@kyvg/vue3-notification";
import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

import GuestLayout from '@/Guest/Layouts/Default.vue'
import SystemLayout from '@/System/Layouts/AppLayout.vue'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    // resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    resolve: (name) => require(`./${name}.vue`),
    resolve: (name) => {
        if(name.startsWith('Guest/')){
            var page = resolvePageComponent(
                `./${name}.vue`,
                import.meta.glob("./**/*.vue")
            );
            page.then((module) => {
                module.default.layout =  GuestLayout;
            });
        }
        if(name.startsWith('Admin/')){
            var page = resolvePageComponent(
                `./${name}.vue`,
                import.meta.glob("./**/*.vue")
            );
            page.then((module) => {
                module.default.layout =  SystemLayout;
            });
        }
        if(name.startsWith('System/')){
            var page = resolvePageComponent(
                `./${name}.vue`,
                import.meta.glob("./**/*.vue")
            );
            page.then((module) => {
                module.default.layout =  SystemLayout;
            });
        }
        return page;
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Notifications)
            .use(VueLoading)
            .component('loading',VueLoading)
            .component('Head',Head)
            .component('Link',Link)
            .use(ZiggyVue, Ziggy)
            .use(createPinia())
            .mount(el);
    },
});

InertiaProgress.init({ color: '#2563eb', showSpinner: true, });