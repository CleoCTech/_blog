<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref, onMounted } from 'vue';

import {useNotify} from "@/Composables/useNotify";

const {notification} = useNotify();

const footerData = ref({});
const isLoading = ref(true);
onMounted(() => {
    getFooterData();
});

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
</script>
<template>
<div>
  <div v-if="isLoading" class="max-w-sm mx-auto"> <span class="text-2xl font-bold text-blue-600">Loading...</span> </div>
  <div v-else class="mx-auto">
    <footer class="p-4 bg-white sm:p-6 dark:bg-gray-900">
      <div class="md:flex md:justify-between">
        <div class="mb-6 md:mb-0">
          <Link :href="route('home')" target="_blank" class="flex items-center">
            <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="mr-4 h-10" alt="Be-Informed Logo"> -->
            <img :src="'/storage/companyInfo/images/' + footerData.companyInfo.logo"  class="mr-4 h-10" :alt="footerData.companyInfo.short_name">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{footerData.companyInfo.company_name}}™</span>
          </Link>
        </div>
        <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
          <div>
            <h3 class="mb-6 text-sm font-semibold text-gray-200 uppercase dark:text-white">Resources</h3>
            <ul>
              <li class="mb-4">
                <a href="#" target="_blank" class="text-gray-600 hover:underline dark:text-gray-400">Flowbite</a>
              </li>
              <li>
                <a href="#" target="_blank" rel="nofollow"
                  class="text-gray-600 hover:underline dark:text-gray-400">Tailwind CSS</a>
              </li>
            </ul>
          </div>
          <div>
            <h3 class="mb-6 text-sm font-semibold text-gray-200 uppercase dark:text-white">Follow us</h3>
            <ul>
              <li class="mb-4">
                <a href="#" target="_blank" class="text-gray-600 hover:underline dark:text-gray-400">Github</a>
              </li>
              <li>
                <a href="#" target="_blank" class="text-gray-600 hover:underline dark:text-gray-400">Discord</a>
              </li>
            </ul>
          </div>
          <div>
            <h3 class="mb-6 text-sm font-semibold text-gray-200 uppercase dark:text-white">Legal</h3>
            <ul>
              <li class="mb-4">
                <a href="#" target="_blank" class="text-gray-600 hover:underline dark:text-gray-400">Privacy
                  Policy</a>
              </li>
              <li>
                <a href="#" target="_blank" class="text-gray-600 hover:underline dark:text-gray-400">Terms
                  &amp; Conditions</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
      <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-gray-400 sm:text-center dark:text-gray-400">© {{new Date().getFullYear()}} <a href="https://flowbite.com"
            target="_blank" class="hover:underline"> {{footerData.companyInfo.company_name}}™</a>.  All Rights Reserved.
        </span>
        <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
          <ul class="flex">
            <li v-for="(socialMedia, index) in footerData.socialMedias" :key="index"  class="mr-1" >
               <!-- fa-facebook-f -->
              <a v-if="socialMedia.name.includes('Facebook') " :href="socialMedia.link" target="_blank" class="text-gray-400 hover:text-gray-200 dark:hover:text-white">
                <!-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                    clip-rule="evenodd"></path>
                </svg> -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="#C6C6CC" d="M22.675 8.452h-2.429V5.6c0-.938-.027-2.384 2.4-2.384h2.43v-3.056c0-3.732-2.184-5.477-5.38-5.477C14.633.071 11.77.071 9.492.071c-3.197 0-5.375 1.745-5.375 5.475v3.056h-2.43c-2.427 0-2.4 1.447-2.4 2.384v2.852h2.429v9.917h5.102v-9.917h3.188s.139-2.381 2.42-2.381h3.23v-3.25z"/>
                </svg>

              </a>
            </li>
            <li v-for="(socialMedia, index) in footerData.socialMedias" :key="index"  class="mr-1" >
              <!-- insta -->
              <a v-if="socialMedia.name.includes('Instagram') " :href="socialMedia.link" target="_blank" class="text-gray-400 hover:text-gray-200 dark:hover:text-white">
                <!-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                    clip-rule="evenodd"></path>
                </svg> -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="#C6C6CC" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>

              </a>
            </li>
            <li v-for="(socialMedia, index) in footerData.socialMedias" :key="index"  class="mr-1" >
              <!-- twitter -->
              <a v-if="socialMedia.name.includes('Twitter') " :href="socialMedia.link" target="_blank" class="text-gray-400 hover:text-gray-200 dark:hover:text-white">
                <!-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                  </path>
                </svg> -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="#C6C6CC" d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/>
                </svg>
              </a>
            </li>
            <li v-for="(socialMedia, index) in footerData.socialMedias" :key="index"  class="mr-1" >
               <!-- Github -->
                <a v-if="socialMedia.name.includes('Github') " :href="socialMedia.link" target="_blank" class="text-gray-400 hover:text-gray-200 dark:hover:text-white">
                  <!-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd"
                      d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                      clip-rule="evenodd"></path>
                  </svg> -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="#C6C6CC" d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                  </svg>
                </a>
            </li>
            <li v-for="(socialMedia, index) in footerData.socialMedias" :key="index"  class="mr-1" >
              <!-- LinkedIn -->
              <a v-if="socialMedia.name.includes('Linkedin') " :href="socialMedia.link" target="_blank" class="text-gray-400 hover:text-gray-200 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="#C6C6CC" d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24H22.225c.979 0 1.771-.773 1.771-1.729v-20.542C23.996.774 23.204 0 22.225 0z"/>
                </svg>
              </a>
            </li>
            <li v-for="(socialMedia, index) in footerData.socialMedias" :key="index"  class="mr-1" >
              <!-- Discord -->
              <a v-if="socialMedia.name.includes('Discord') " :href="socialMedia.link" target="_blank" class="text-gray-400 hover:text-gray-200 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="#C6C6CC" d="M22.675 29.179c-.167.363-.25.767-.25 1.2 0 4.635-3.762 8.398-8.397 8.398-4.636 0-8.398-3.763-8.398-8.398 0-.434.083-.837.25-1.2C2.964 24.739 0 20.547 0 16c0-4.968 4.032-9 9-9s9 4.032 9 9c0 4.547-2.964 8.739-7.675 9.179zM11.99 7.252c-.223 0-.55.104-.801.345-.517.517-.517 1.365 0 1.882l2.302 2.302-2.302 2.301c-.517.517-.517 1.365 0 1.882.25.25.578.345.801.345.223 0 .55-.104.801-.345l2.301-2.301 2.302 2.301c.25.25.578.345.801.345.223 0 .55-.104.801-.345.517-.517.517-1.365 0-1.882l-2.302-2.302 2.302-2.301c.517-.517.517-1.365 0-1.882-.25-.25-.578-.345-.801-.345-.223 0-.55.104-.801.345l-2.301 2.301-2.302-2.301c-.25-.25-.578-.345-.801-.345z"/>
                </svg>
              </a>
            </li>
            <li v-for="(socialMedia, index) in footerData.socialMedias" :key="index"  class="mr-1" >
               <!-- <a href="#" class="text-gray-400 hover:text-gray-200 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                    clip-rule="evenodd"></path>
                </svg>
              </a> -->
            </li>
          </ul>
          
         
        </div>
      </div>
    </footer>
  </div>
</div>
</template>
