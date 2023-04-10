<script setup>
import {onMounted} from 'vue'
import BrowseNavbar from '@/Guest/Partials/BrowseNavbar.vue'
import {useForm} from '@inertiajs/inertia-vue3'
import { ref, watch } from 'vue';
import Aside from '@/Guest/Partials/Aside.vue';
import Subscribe from '@/Guest/Partials/Subscribe.vue';

  const loading = ref(true);
  const props = defineProps({
    posts: Object,
    subcategories: Object,
    category: Object,
    popularPosts:Object,
    adverts:Object,
  });
  
  let form = useForm({
      image: '',
  });
  watch(() => loading.value, () => {
        // Set the loading state to false once the main content has finished loading
        loading.value = false;
      });
  onMounted(() => {
    // console.log(props.subcategories);
  })
</script>
<template>
    <div>
        <Head title="Browse" />
        <BrowseNavbar :subcategories="subcategories" :category="category"/>

        <div class="container mx-auto flex flex-wrap py-6">
            <section class="w-full md:w-2/3 flex flex-col items-center px-4">
            <!-- Card Blog -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                <!-- Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <Link v-for="(tour, index) in posts.data" :key="index" class="group rounded-xl overflow-hidden" :href="'/post/'+tour.title.replace(/ /g,'-').toLowerCase()">
                    <div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
                    <img class="w-full h-full absolute top-0 left-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl" :src="'/storage/posts/cover_images/'+tour.featured_image" alt="Image Description">
                    <span class="absolute top-0 right-0 rounded-tr-xl rounded-bl-xl text-xs font-medium bg-gray-800 text-white py-1.5 px-3 dark:bg-gray-900">
                        <!-- Sponsored -->
                    </span>
                    </div>

                    <div class="mt-7">
                    <Link  :href="'/post/'+tour.title.replace(/ /g,'-').toLowerCase()" class="rounded-lg hover:opacity-75">
                        <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-gray-200">
                        {{ tour.title}}
                        </h3>
                    </Link>
                    <p class="mt-3 text-gray-800 dark:text-gray-200" v-html="tour.content.length > 100? tour.content.substring(0,100)+'...':tour.content">
                    </p>
                    <Link :href="'/post/'+tour.title.replace(/ /g,'-').toLowerCase()">
                        <p class="mt-5 inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 group-hover:underline font-medium">
                        Read more
                        <svg class="w-2.5 h-2.5" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        </p>
                    </Link>
                    </div>
                </Link>
                </div>
            </div>

            <div class="flex items-center py-8">
                <Component 
                :is="link.url ? 'Link' : 'span'"
                v-for="link in posts.links"
                :href="link.url"
                v-html="link.label" 
                class="px-1 "
                :class="{'text-gray-500' : !link.url, 'h-10 w-10 bg-blue hover:bg-blue-dark font-semibold text-white text-sm flex items-center justify-center' :link.active}"

                />
                
            </div>
            </section>  
    
            <Aside :adverts ="adverts" :popularPosts="popularPosts"/>
   
        </div>
        <Subscribe />
    </div>
</template>
