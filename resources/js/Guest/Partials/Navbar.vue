<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/inertia-vue3'
import {useNotify} from "@/Composables/useNotify";
// import { useToggle } from '../../Composables/useToggle';

const {notification} = useNotify();
// const {toggle} = useToggle();

const isVisible  = ref(false)
const showArticles  = ref(false)
const showMore  = ref(false)

const footerData = ref({});
const isLoading = ref(true);

onMounted(() => {
    getFooterData();
    document.addEventListener('click', clickHandler);
});

function toggleMenu() {
    isVisible.value = !isVisible.value
}
function toggleArticleMenu() {
  showArticles.value = !showArticles.value
}
let clickHandler = (event) => {
  if (!event.target.closest('.show-articles')) {
    showArticles.value = false;
  }
};

function toggleshowMoreMenu() {
  showMore.value = !showMore.value
}

function getFooterData(){
  axios.get('/footer-data')
    .then(response => {
      console.log(response.data)
      footerData.value = response.data
      isLoading.value = false;
    })
    .catch(error => {
      console.error(error)
      notification(error, 'error');
    })
}

onUnmounted(() => {
  // Clean up resources, remove event listeners, etc.
  document.removeEventListener('click', clickHandler);
});

</script>
<template>
<div>
  <div v-if="isLoading" class="max-w-sm mx-auto"> <span class="text-2xl font-bold text-blue-600">Loading...</span> </div>
  <div v-else class="relative bg-gray-900 sticky top-0 z-50 shadow-lg">
    <div class="mx-auto max-w-7xl px-6">
      <div class="flex items-center justify-between py-6 md:justify-start md:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <Link :href="route('home')">
            <span class="sr-only">{{footerData.companyInfo.company_name}}™</span>
            <img class="h-8 w-auto sm:h-10" :src="'/storage/companyInfo/images/' + footerData.companyInfo.logo"
            :alt="footerData.companyInfo.short_name">
          </Link>
        </div>
        <div class="-my-2 -mr-4 md:hidden">
          <button type="button" id="open-menu" @click="toggleMenu"
            class="inline-flex items-center justify-center rounded-md 
            bg-gray-800 border-2 border-gray-900 p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            aria-expanded="false">
            <span class="sr-only">Open menu</span>
            <!-- Heroicon name: outline/bars-3 -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="#0284c7" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <!--So overall it tells that, the element will be hidden on all screen sizes, 
            but when screen size is 'md' or above it will be displayed as flex layout and there will be an horizontal spacing of 10px around the element.-->
        <nav class="hidden space-x-10 md:flex " >
          <Link :href="route('home')" class="text-base font-medium text-gray-400 hover:text-gray-200">Home</LInk>

          <div class="relative" >

            <!-- Item active: "text-gray-200", Item inactive: "text-gray-400" -->
            <button @click="toggleArticleMenu"  type="button"
              class="show-articles text-gray-400 group inline-flex items-center rounded-md bg-gray-900 text-base font-medium hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              aria-expanded="false">
              <span>Articles</span>
              <!--
                  Heroicon name: mini/chevron-down
    
                  Item active: "text-gray-600", Item inactive: "text-gray-400"
                -->
              <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20" fill="#0284c7" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                  clip-rule="evenodd" />
              </svg>
            </button>

            <div v-show="showArticles" 
              class="absolute z-10 -ml-4 mt-3 w-screen max-w-md transform px-2 sm:px-0 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2">
              <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                <div class="relative grid gap-6 bg-gray-900 px-5 py-6 sm:gap-8 sm:p-8">
                  <a href="#" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-800">
                    <!-- Heroicon name: outline/chart-bar -->
                    <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                    <div class="ml-4">
                      <p class="text-base font-medium text-gray-200">Tech</p>
                      <p class="mt-1 text-sm text-gray-400">Get a better understanding of where your traffic is coming
                        from.</p>
                    </div>
                  </a>

                  <a href="#" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-800">
                    <!-- Heroicon name: outline/cursor-arrow-rays -->
                    <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                    </svg>
                    <div class="ml-4">
                      <p class="text-base font-medium text-gray-200">Productivity</p>
                      <p class="mt-1 text-sm text-gray-400">Speak directly to your customers in a more meaningful way.
                      </p>
                    </div>
                  </a>

                  <a href="#" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-800">
                    <!-- Heroicon name: outline/shield-check -->
                    <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    <div class="ml-4">
                      <p class="text-base font-medium text-gray-200">Security</p>
                      <p class="mt-1 text-sm text-gray-400">Your customers&#039; data will be safe and secure.</p>
                    </div>
                  </a>

                  <a href="#" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-800">
                    <!-- Heroicon name: outline/squares-2x2 -->
                    <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    <div class="ml-4">
                      <p class="text-base font-medium text-gray-200">Poetry</p>
                      <p class="mt-1 text-sm text-gray-400">Connect with third-party tools that you&#039;re already
                        using.</p>
                    </div>
                  </a>

                  <a href="#" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-800">
                    <!-- Heroicon name: outline/arrow-path -->
                    <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 12c0-1.232.046-2.453.138-3.662a4.006 4.006 0 013.7-3.7 48.678 48.678 0 017.324 0 4.006 4.006 0 013.7 3.7c.017.22.032.441.046.662M4.5 12l-3-3m3 3l3-3m12 3c0 1.232-.046 2.453-.138 3.662a4.006 4.006 0 01-3.7 3.7 48.657 48.657 0 01-7.324 0 4.006 4.006 0 01-3.7-3.7c-.017-.22-.032-.441-.046-.662M19.5 12l-3 3m3-3l3 3" />
                    </svg>
                    <div class="ml-4">
                      <p class="text-base font-medium text-gray-200">Random</p>
                      <p class="mt-1 text-sm text-gray-400">Build strategic funnels that will drive your customers to
                        convert</p>
                    </div>
                  </a>
                </div>

              </div>
            </div>
          </div>

          <a href="#" class="text-base font-medium text-gray-400 hover:text-gray-200">About</a>
          <a href="#" class="text-base font-medium text-gray-400 hover:text-gray-200">Contact</a>

          <div class="relative">
            <!-- Item active: "text-gray-200", Item inactive: "text-gray-400" -->
            <button type="button"
              class="text-gray-400 group inline-flex items-center rounded-md bg-gray-900 text-base font-medium hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              aria-expanded="false">
              <span>More</span>
              <!--
                  Heroicon name: mini/chevron-down
    
                  Item active: "text-gray-600", Item inactive: "text-gray-400"
                -->
              <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20" fill="#0284c7" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                  clip-rule="evenodd" />
              </svg>
            </button>

          </div>
        </nav>
        <div class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
          <Link :href="route('login')" class="whitespace-nowrap text-base font-medium text-gray-400 hover:text-gray-200">Sign in</Link>
          <Link :href="route('register')"
            class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700">Sign
            up</Link>
        </div>
      </div>
    </div>

    <!--
        Mobile menu, show/hide based on mobile menu state.
    
        Entering: "duration-200 ease-out"
          From: "opacity-0 scale-95"
          To: "opacity-100 scale-100"
        Leaving: "duration-100 ease-in"
          From: "opacity-100 scale-100"
          To: "opacity-0 scale-95"
      -->
    <div v-show="isVisible" class="absolute inset-x-0 top-0 origin-top-right transform p-2 transition md:hidden" id="mobile-menu">
      <div class="divide-y-2 divide-gray-50 rounded-lg bg-gray-900 shadow-lg ring-1 ring-black ring-opacity-5">
        <div class="px-5 pt-5 pb-6">
          <div class="flex items-center justify-between">
            <div>
              <img class="h-8 w-auto" :src="'/storage/companyInfo/images/' + footerData.companyInfo.logo"
              :alt="footerData.companyInfo.company_name +'™'">
            </div>
            <div class="-mr-2">
              <button id="close-menu" type="button" @click="toggleMenu"
                class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Close menu</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
          <div class="mt-6">
            <nav class="grid gap-y-8">
              <Link href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-800">
                <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>
                <span class="ml-3 text-base font-medium text-gray-200">Tech</span>
              </Link>

              <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-800">
                <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                </svg>
                <span class="ml-3 text-base font-medium text-gray-200">Productivity</span>
              </a>

              <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-800">
                <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
                <span class="ml-3 text-base font-medium text-gray-200">Security</span>
              </a>

              <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-800">
                <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="ml-3 text-base font-medium text-gray-200">Poetry</span>
              </a>

              <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-800">
                <svg class="h-6 w-6 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke-width="1.5" stroke="#0284c7" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.5 12c0-1.232.046-2.453.138-3.662a4.006 4.006 0 013.7-3.7 48.678 48.678 0 017.324 0 4.006 4.006 0 013.7 3.7c.017.22.032.441.046.662M4.5 12l-3-3m3 3l3-3m12 3c0 1.232-.046 2.453-.138 3.662a4.006 4.006 0 01-3.7 3.7 48.657 48.657 0 01-7.324 0 4.006 4.006 0 01-3.7-3.7c-.017-.22-.032-.441-.046-.662M19.5 12l-3 3m3-3l3 3" />
                </svg>
                <span class="ml-3 text-base font-medium text-gray-200">Random</span>
              </a>
            </nav>
          </div>
        </div>
        <div class="space-y-6 py-6 px-5">
          <div class="grid grid-cols-2 gap-y-4 gap-x-8">
            <Link :href="route('home')" class="text-base font-medium text-gray-200 hover:text-gray-700">Home</Link>

            <a href="#" class="text-base font-medium text-gray-200 hover:text-gray-700">About</a>

            <a href="#" class="text-base font-medium text-gray-200 hover:text-gray-700">Contact</a>
            <a href="#" class="text-base font-medium text-gray-200 hover:text-gray-700">More</a>

          </div>
          <div>
            <Link :href="route('register')"
              class="flex w-full items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700">Sign
              up</Link>
            <p class="mt-6 text-center text-base font-medium text-gray-400">
              Existing customer?
              <Link :href="route('login')" class="text-blue-600 hover:text-blue-700">Sign in</Link>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

