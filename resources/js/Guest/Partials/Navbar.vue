<script setup>
import { ref, onMounted, onUnmounted, reactive } from 'vue';
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

const form  = reactive({
    footerData:{},
    categories:[],
})

onMounted(() => {
    getFooterData();
    getcategoriesData();
    document.addEventListener('click', clickHandler);
    // document.addEventListener('click', clickHandlerMobile);
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
// let clickHandlerMobile = (event) => {
//   if (!event.target.closest('.mobile')) {
//     isVisible.value = false;
//   }
// };

function toggleshowMoreMenu() {
  showMore.value = !showMore.value
}

function getFooterData(){
  axios.get('/footer-data')
    .then(response => {
      // console.log(response.data)
      footerData.value = response.data
      isLoading.value = false;
    })
    .catch(error => {
      console.error(error)
      notification(error, 'error');
    })
}
function getcategoriesData(){
    axios.get('/post-categories').then(response => {
        form.categories = response.data;
        isLoading.value = false;
    }).catch((error) => {
        isLoading.value = false;
    })
}
onUnmounted(() => {
  // Clean up resources, remove event listeners, etc.
  document.removeEventListener('click', clickHandler);
  // document.removeEventListener('click', clickHandlerMobile);
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
          <Link :href="route('home')" class="text-base font-medium text-gray-400 hover:text-gray-200">Home</Link>

          <div class="relative" >

            <!-- Item active: "text-gray-200", Item inactive: "text-gray-400" -->
            <button @click="toggleArticleMenu"  type="button"
              class="show-articles text-gray-400 group inline-flex items-center rounded-md bg-gray-900 text-base font-medium hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              aria-expanded="false">
              <span>Articles</span>
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
                  <Link v-for="category in form.categories.categories" :key="category.uuid"  :href="'/browse/'+category.title.replace(/ /g,'-').toLowerCase()" 
                  class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-800">
                    <div v-html="category.svg"></div>
                    <div class="ml-4">
                      <p class="text-base font-medium text-gray-200">{{category.title}}</p>
                      <p class="mt-1 text-sm text-gray-400">{{category.description}}</p>
                    </div>
                  </Link>
                 
                </div>

              </div>
            </div>
          </div>

          <Link :href="route('about-us')" class="text-base font-medium text-gray-400 hover:text-gray-200">About</Link>
          <Link :href="route('contact-us')" class="text-base font-medium text-gray-400 hover:text-gray-200">Contact</Link>

          <div class="relative">
            <!-- Item active: "text-gray-200", Item inactive: "text-gray-400" -->
            <button  @click="toggleshowMoreMenu"  type="button"
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
            <div v-show="showMore" 
              class="absolute z-10 -ml-4 mt-3 w-screen max-w-md transform px-2 sm:px-0 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2">
              <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                <div class="relative grid gap-6 bg-gray-900 px-5 py-6 sm:gap-8 sm:p-8">
                  <Link  href="#"
                  class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-800">
                  <svg class="h-10 w-10 flex-shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                    <path  d="M 10 50 Q 30 20 50 50 Q 70 80 90 50" stroke="#000" stroke-width="5" fill="none" />
                  </svg>
                    <div class="ml-4">
                      <p class="text-base font-medium text-gray-200">My Journey</p>
                      <p class="mt-1 text-sm text-gray-400">Comming soon...</p>
                    </div>
                  </Link>
                 
                </div>

              </div>
            </div>

          </div>
        </nav>
       
        <div v-if="$page.props.auth.user" class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
          <Link :href="route('login')" class="whitespace-nowrap text-base font-medium text-gray-400 hover:text-gray-200">{{$page.props.auth.user.name }}</Link>
          
        </div>
        <div v-else class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
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
              <Link v-for="category in form.categories.categories" :key="category.uuid"  :href="'/browse/'+category.title.replace(/ /g,'-').toLowerCase()" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-800">
                <div v-html="category.svg"></div>
                <span class="ml-3 text-base font-medium text-gray-200">{{category.title}}</span>
              </Link>
            </nav>
          </div>
        </div>
        <div class="space-y-6 py-6 px-5">
          <div class="grid grid-cols-2 gap-y-4 gap-x-8">
            <Link :href="route('home')" class="text-base font-medium text-gray-200 hover:text-gray-700">Home</Link>

            <Link :href="route('about-us')" class="text-base font-medium text-gray-200 hover:text-gray-700">About</Link>
            <Link :href="route('contact-us')" class="text-base font-medium text-gray-200 hover:text-gray-700">Contact</Link>
            <a href="#" class="text-base font-medium text-gray-200 hover:text-gray-700">More</a>

          </div>
          <div>
            <Link :href="route('register')"
              class="flex w-full items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700">Sign
              up</Link>
            <p class="mt-6 text-center text-base font-medium text-gray-400">
              Existing user?
              <Link :href="route('login')" class="text-blue-600 hover:text-blue-700">Sign in</Link>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

