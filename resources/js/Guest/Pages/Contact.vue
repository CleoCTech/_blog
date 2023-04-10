<template>
    <div>
      <Head :title="pageTitle" />
      <div v-if="loading.value">
        
      </div>
      
       <!-- Hero -->
       <div class="relative overflow-hidden">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24">
            <div class="text-center">
                <h1 class="text-4xl sm:text-6xl font-bold text-gray-800 dark:text-gray-200">
                Insights
                </h1>

                <x-swiper :slidesPerView="1">
                <swiper-slide v-for="(qoute,index) in qoutes" :key="index">
                    
                    <!-- <p class="mt-3 text-gray-600 dark:text-gray-400" >
                    <svg class="absolute top-0 left-0 transform -translate-x-6 -translate-y-8 h-16 w-16 text-gray-100 dark:text-gray-700" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z" fill="currentColor"/>
                    </svg>
                    {{qoute.quote}}
                    </p>
                    <p class="mt-3 text-gray-600 dark:text-gray-400" >~ {{ qoute.author }}</p> -->

                    <blockquote class="relative">
                    <svg class="absolute top-0 left-0 transform -translate-x-6 -translate-y-8 h-16 w-16 text-gray-100 dark:text-gray-700" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z" fill="currentColor"/>
                    </svg>

                    <div class="relative z-10 mt-3">
                        <p class="text-gray-800 sm:text-xl dark:text-white">
                        <em>
                            {{qoute.quote}}</em>
                        </p>
                        <p class="text-gray-800 sm:text-xl dark:text-white">
                        <em>
                            ~ {{ qoute.author }}</em>
                        </p>
                    </div>
                    </blockquote>
                </swiper-slide>
                </x-swiper>
                

                <div class="mt-7 sm:mt-12 mx-auto max-w-xl relative">
                <!-- Form -->
                <form>
                    <div class="relative z-10 flex space-x-3 p-3 bg-white border rounded-lg shadow-lg shadow-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:shadow-gray-900/[.2]">
                    <div class="flex-[1_0_0%]">
                        <label for="hs-search-article-1" class="block text-sm text-gray-700 font-medium dark:text-white"><span class="sr-only">Search article</span></label>
                        <input type="email" name="hs-search-article-1" id="hs-search-article-1" class="p-3 block w-full border-transparent rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-400" placeholder="Search article">
                    </div>
                    <div class="flex-[0_0_auto]">
                        <a class="p-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        </a>
                    </div>
                    </div>
                </form>
                <!-- End Form -->

                <!-- SVG Element -->
                <div class="hidden md:block absolute top-0 right-0 -translate-y-12 translate-x-20">
                    <svg class="w-16 h-auto text-orange-500" width="121" height="135" viewBox="0 0 121 135" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 16.4754C11.7688 27.4499 21.2452 57.3224 5 89.0164" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
                    <path d="M33.6761 112.104C44.6984 98.1239 74.2618 57.6776 83.4821 5" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
                    <path d="M50.5525 130C68.2064 127.495 110.731 117.541 116 78.0874" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
                    </svg>
                </div>
                <!-- End SVG Element -->

                <!-- SVG Element -->
                <div class="hidden md:block absolute bottom-0 left-0 translate-y-10 -translate-x-32">
                    <svg class="w-40 h-auto text-cyan-500" width="347" height="188" viewBox="0 0 347 188" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 82.4591C54.7956 92.8751 30.9771 162.782 68.2065 181.385C112.642 203.59 127.943 78.57 122.161 25.5053C120.504 2.2376 93.4028 -8.11128 89.7468 25.5053C85.8633 61.2125 130.186 199.678 180.982 146.248L214.898 107.02C224.322 95.4118 242.9 79.2851 258.6 107.02C274.299 134.754 299.315 125.589 309.861 117.539L343 93.4426" stroke="currentColor" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <!-- End SVG Element -->
                </div>

                
            </div>
            </div>
        </div>
        <!-- End Hero -->
       
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="mt-8 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6 mr-2 bg-gray-800 text-gray-300 sm:rounded-lg pb-3 mb-3">
                        <h1 class="text-4xl sm:text-5xl text-blue  font-extrabold tracking-tight">
                            Get in touch
                        </h1>
                        <p class="text-normal text-lg sm:text-2xl font-medium text-blue mt-2">
                            Fill in the form to start a conversation
                        </p>

                        <div class="flex items-center mt-8 text-gray-600 dark:text-gray-400">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div class="ml-4 text-md tracking-wide font-semibold w-40">
                                {{ companyInfo.address }}
                            </div>
                        </div>

                        <div class="flex items-center mt-4 text-gray-600 dark:text-gray-400">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div class="ml-4 text-md tracking-wide font-semibold w-40">
                                {{ companyInfo.phone_numbers }}
                            </div>
                        </div>

                        <div class="flex items-center mt-2 text-navy dark:text-navy">
                            <svg fill="none" stroke="navy" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div class="ml-4 text-md tracking-wide font-semibold w-40">
                                {{ companyInfo.emails }}
                            </div>
                        </div>
                    </div>

                    <form @submit.prevent="submit" class="form bg-gray-800 text-gray-300 p-6 my-10 relative justify-center">
                    
                    <div class="icon bg-blue text-white w-6 h-6 absolute flex items-center justify-center p-5" style="left:-40px"><i class="fal fa-phone-volume fa-fw text-2xl transform -rotate-45"></i></div>
                    <h3 class="text-2xl text-gray-300 font-semibold">Let us chat!</h3>
                    <p class="text-gray-400"> To help each other grow</p>
                    <div class="flex space-x-5 mt-3">
                        <input type="text" v-model="form.name" id="" placeholder="Your Name" class="border p-2  w-1/2 border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                        <div v-if="form.errors.name" v-text="form.errors.name" style="color:red"></div>
                        <input type="tel" v-model="form.phone" id="" placeholder="Your Number" class="border p-2 w-1/2 border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                        <div v-if="form.errors.phone" v-text="form.errors.phone" style="color:red"></div>
                    </div>
                    <input type="email" v-model="form.email" id="" placeholder="Your Email" class="border p-2 w-full mt-3 border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                    <div v-if="form.errors.email" v-text="form.errors.email" style="color:red"></div>
                    <textarea v-model="form.message" id="" cols="10" rows="3" placeholder="Tell us about desired property" class="border p-2 mt-3 w-full border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"></textarea>
                    <div v-if="form.errors.message" v-text="form.errors.message" style="color:red"></div>
                    <!--<p class="font-bold text-sm mt-3">GDPR Agreement *</p>
                    <div class="flex items-baseline space-x-2 mt-2">
                        <input type="checkbox" name="" id="" class="inline-block">
                        <p class="text-gray-600 text-sm">I consent to having this website store my submitted information so they can respond to my inquiry.</p>
                    </div> -->
                    <!-- <input type="submit" value="Submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-500 text-white font-semibold p-3"> -->
                    <div class="col-12 text-center">
                        <div v-if="form.processing" class="spinner-border text-blue-800" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <button type="submit" class="w-full mt-6 bg-blue-600 rounded-lg shadow-md hover:bg-blue-500 text-white font-semibold p-3" :data-loading-text="form.processing? 'Loading...' : ''" :class="form.processing? 'not-allowed hidden' : ''"  :disabled="form.processing">Send</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
  </template>
  
<script setup>
import {onMounted} from 'vue'
// import GuestNavbar from '@/Guest/Partials/Navbar.vue'
import {useForm, usePage} from '@inertiajs/inertia-vue3'
import { ref, watch } from 'vue';
import { SwiperSlide } from 'swiper/vue';
import xSwiper from '@/Components/Swiper.vue'

const loading = ref(true);
const props = defineProps({
companyInfo: Object,
pageTitle: String,
socialMedias: Object,
qoutes: Object,
});

let form = useForm({
    name: '',
    email: '',
    phone: '',
    message: '',
});
let submit = () => {
    form.post('/customer-inquiry', {
        preserveScroll: true,
        onSuccess: (response) => {
            console.log(response);
            usePage().props.value.flash.success = 'Success !!!'
            form.reset();
        },

    }, {
        resetOnSuccess: false
    })

}
watch(() => loading.value, () => {
// Set the loading state to false once the main content has finished loading
    loading.value = false;
});
onMounted(() => {

})
</script>
<style scoped>
.icon::after{
    content: '';
    display: block;
    position: absolute;
    border-top: 23px solid transparent;
    border-bottom: 17px solid transparent;
    border-left: 12px solid #3182ce;
    left: 100%;
    top: 0;
}
</style>