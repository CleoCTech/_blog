<script setup>
import Navbar from '@/Admin/Partials/Navbar.vue'
import AdminSidebar from '@/Admin/Partials/Sidebar.vue'
import { usePage } from '@inertiajs/inertia-vue3'
import DefaultFooter from '@/System/Partials/Footer.vue'
import { ref, onMounted } from 'vue'
import {useNotify} from "@/Composables/useNotify";

let {notification} = useNotify();

defineProps({
    isCrud: { default: true },
    setup: { default: () => Object },
    selected: { default: () => [] },
    active: { default: false },
});

const page = usePage();

let isSidebar = ref(true);
let isLoading = ref(false);
let fullPage = ref(true);
let authUser = page.props.value.auth.user;
let config = page.props.value.config;


onMounted(() => {
    // notification({
    //     text: "You have been logged in!",
    //     type: "info",
    // });
    if(page.props.value.flash.error != null){
        notification(page.props.value.flash.error, 'error');
    }
    else if(page.props.value.flash.info != null){
        notification(page.props.value.flash.info, 'info');
    }
})

</script>

<template>
    <div id="app">
        <div>
            <notifications />
            <loading v-model:active ="isLoading"
                 :can-cancel="false"
                 :is-full-page="fullPage"/>
            <!--navbar-->
            <header class="z-50">
                <navbar :title="setup.pageTitle"/>
            </header>
            <div class="relative sm:flex">
                <!--sidebar-->
                <section id="sidebar" class="w-60 sm:w-50 hidden sm:block absolute sm:relative sm:mt-12">
                    <admin-sidebar v-if="$page.props.auth.user.user_category == 100"/>
                </section>
                <!--main-->
                <main class="font-sans text-gray-900 antialiased whitespacex-pre-line container mt-12" id="mainSection">
                    <div class="pl-1 pt-0 pr-1">
                        <div class="min-h-screen overflow-hidden">
                            <div class="block sm:hidden w-full justify-center items-center pb-2 mt-16">
                                <h5 class="ml-3 text-sm sm:text-md md:text-lg font-semibold underline text-center">{{setup.pageTitle}}</h5>
                            </div>
                            <slot></slot>
                        </div>
                        <!--footer-->
                        <default-footer/>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

