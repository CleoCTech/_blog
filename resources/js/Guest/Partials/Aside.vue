<script setup>
import { SwiperSlide } from 'swiper/vue';
import xSwiper from '@/Components/Swiper.vue'

const props = defineProps({
    adverts: Object,
    popularPosts:Object,
});

</script>
<template>
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3 ">
      <!-- Sidebar   <div class="lg:col-span-1 lg:w-full lg:h-full ">-->
      <div class="col-span-1 w-full h-full ">
        <div class="sticky top-0 left-0 py-8 lg:pl-4 lg:pl-8">
          <!-- Avatar Media -->
          <div class="group flex items-center gap-x-3 border-b border-gray-200 pb-8 mb-8 dark:border-gray-700">
            <a class="block flex-shrink-0" href="#">
              <!-- <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Image Description"> -->
            </a>

            <a class="group grow block" href="">
              <h5 class="group-hover:text-gray-600 text-sm font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                Popular Articles
              </h5>
              <p class="text-sm text-gray-500">
                
              </p>
            </a>

            <div class="grow">
              <div class="flex justify-end">
              <a href="https://twitter.com/cleo_hacker" target="_blank" >
                <button type="button" class="py-1.5 px-2.5 inline-flex justify-center items-center gap-x-1.5 rounded-full border border-transparent font-semibold bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 text-xs">
                    <i class="fab fa-twitter mr-2"></i> Follow @cleo_hacker
                </button>
              </a>
              </div>
            </div>
          </div>
          <!-- End Avatar Media -->
          <div class="space-y-6">
            <!-- Media -->
            <Link v-for="(post,index) in popularPosts" :key="index" class="group flex items-center gap-x-6" 
            :href="'/post/'+post.title.replace(/ /g,'-').toLowerCase()">
              <div class="grow">
                <span class="text-sm font-bold text-gray-800 group-hover:text-blue-600 dark:text-gray-200 dark:group-hover:text-blue-500">
                 {{ post.title }}
                </span>
              </div>

              <div class="flex-shrink-0 relative rounded-lg overflow-hidden w-20 h-20">
                <img class="w-full h-full absolute top-0 left-0 object-cover rounded-lg" :src="'/storage/posts/cover_images/'+post.featured_image" alt="Image Description">
              </div>
            </Link>
            
          </div>

          <x-swiper :slidesPerView="1">
            <swiper-slide v-for="(advert,index) in adverts" :key="index">
                <!-- <img loading="lazy" :src="'/storage/adverts/cover_images/'+advert.image_url" alt=""/>  -->
               
                <Link  class="group mt-6 relative flex flex-col w-full min-h-[15rem] bg-center bg-cover rounded-xl hover:shadow-lg transition" 
                    v-bind:style="{ 'background-image': 'url(' + '/storage/adverts/cover_images/'+advert.image_url + ')' }"
                    target="_blank"
                    :href="advert.link">
                    <div class="flex-auto p-4 md:p-6">
                    <h3 class="text-xl text-white/[.9] group-hover:text-white" ><span class="font-bold">{{advert.title}}</span>
                        <p v-html="advert.description"></p>
                    </h3>
                    </div>
                    <div class="pt-0 p-4 md:p-6">
                        <div class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/[.7]">
                            Visit the site
                            <svg class="w-2.5 h-2.5" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </Link>
            </swiper-slide>
          </x-swiper>
          
        </div>
        
      </div>
      <!-- End Sidebar -->
    </aside>
</template>
