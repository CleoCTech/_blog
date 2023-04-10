<script setup>
import {onMounted, ref } from 'vue'
import {useForm, usePage } from '@inertiajs/inertia-vue3'
import Aside from '@/Guest/Partials/Aside.vue';
import Subscribe from '@/Guest/Partials/Subscribe.vue';
import { SwiperSlide } from 'swiper/vue';
import xSwiper from '@/Components/Swiper.vue'
import { Icon } from '@iconify/vue';
import {useNotify} from "@/Composables/useNotify";
import ClipboardJS from 'clipboard';

let {notification} = useNotify();


const loading = ref(true);
const props = defineProps({
  cardData: Object,
  title: String,
  companyInfo: Object,
  pageTitle: String,
  relatedPosts: Object,
  adverts: Object,
  popularPosts: Object,
  config: {},
  auth: {},
});

const isOpen = ref(false);
const selectedOption = ref('Option 1');
const options = ['Option 1', 'Option 2', 'Option 3'];
const tags = [];
const uuid = ref('');
const commentContent = ref('');

const likes = ref(0)
const dislikes = ref(0)
const isliked = ref(false)
const isdisliked = ref(false)
const isCopied = ref(false)
const comments = ref({});
const showingReplyForm = ref(null);
const replyContent = ref('');
const commentEmail = ref('');
const commentName = ref('');
const replyName = ref('');
const replyEmail = ref('');
const replyToId = ref('');

let form = useForm({
    image: '',
});

async function fetchComments() {
  const response = await axios.get('/post/comments/' + props.cardData.uuid );
  // console.log(response.data.comments);
  comments.value = response.data.comments;
}

function showReplyForm(commentId, reply_to_id) {
  // console.log('Reply to Id: '+reply_to_id);
  showingReplyForm.value = commentId;
  replyToId.value = reply_to_id;
}

async function submitReply(commentId) {
  loading.value = true
  if (replyEmail.value == '') {
   
    if (!props.auth.user) {
      loading.value = false
      return notification('Please enter email or login', 'error')
    }
    
  } 
  if (replyContent.value == '') {
    loading.value = false
    return notification('Please write some comment before submitting', 'error')
  } 
  try {
    
    const response = await axios.post('/post/comments/reply', {
      content: replyContent.value,
      post_uuid: props.cardData.uuid,
      comment_id: commentId,
      reply_to_id: replyToId.value ? replyToId.value :'',
      name: replyName.value ? replyName.value : props.auth.user.name,
      email: replyEmail.value ? replyEmail.value : props.auth.user.email,
    });
   
    if (response.data.error) {
      notification(response.data.error, 'error')
    } 
    if (response.data.success) {
      notification(response.data.success, 'success')
    } 
    replyContent.value = '';
    showingReplyForm.value = null;
    replyToId.value = '';
    replyEmail.value = '';
    replyName.value = '';
    fetchComments()
    loading.value = false

  } catch (error) {
    console.log(error);
    notification(error.error, 'error')
    loading.value = false
  }
}

async function submitComment() {
  loading.value = true
  if (replyContent.value == '') {
    loading.value = false
    return notification('Please write some comment before submitting', 'error')
  } 
  if (commentEmail.value == '') {
   
    if (!props.auth.user) {
      loading.value = false
      return notification('Please enter email or login', 'error')
    }
    
  } 
  try {
    const response = await axios.post(`/post/comment`, { 
      content: commentContent.value, 
      uuid: props.cardData.uuid,
      name: commentName.value ? commentName.value : props.auth.user.name,
      email: commentEmail.value ? commentEmail.value : props.auth.user.email,
     });
    if (response.data.error) {
      notification(response.data.error, 'error')
    } 
    if (response.data.success) {
      notification(response.data.success, 'success')
    } 
    fetchComments()
    commentContent.value = '';
    commentName.value = '';
    commentEmail.value = '';
    loading.value = false
  } catch (error) {
    console.log(error.error);
    notification(error.error, 'error')
    loading.value = false
  }
}

onMounted(() => {
  
  // notification('Home', 'success');
  // console.log(usePage().config.developer.website);
  console.log(props.auth.user);
  likes.value = props.cardData.likes
  dislikes.value = props.cardData.dislikes
  props.cardData.tags.forEach(element => {
    tags.push(element.title);
  });
  fetchComments()
  loading.value = false;
  // console.log(tags);
})

function selectOption(option) {
  selectedOption.value = option;
  isOpen.value = false;
}
function like() {
  loading.value = true
  likes.value++;
  // console.log(likes);
  axios.post('/post/like', {
      uuid: props.cardData.uuid,
      likes: likes.value
    })
    .then(response => {
      notification(response.data.message, 'success')
      likes.value = response.data.likes;
      isliked.value = true;
      loading.value = false
    })
    .catch(error => {
      console.log(error)
      notification(error.error, 'error')
      loading.value = false
    })
}
function dislike() {
  loading.value = true
  dislikes.value++;
  axios.post('/post/dislike', {
      uuid: props.cardData.uuid,
      dislikes: dislikes.value
    })
    .then(response => {
      notification(response.data.message, 'success')
      console.log(response.data);
      dislikes.value = response.data.dislikes;
      isdisliked.value = true;
      loading.value = false
    })
    .catch(error => {
      console.log(error)
      notification(error.error, 'error')
      loading.value = false
     
    })
}
function copyToClipboard(text) {
  navigator.clipboard.writeText(text)
    .then(() => {
      notification('Copied to clipboard', 'success');
      console.log('Copied to clipboard');
      isCopied.value = true;
    })
    .catch((error) => {
      notification('Failed to copy to clipboard', 'error');
      console.error('Failed to copy to clipboard:', error);
    });
}
// new ClipboardJS('.btnc');
var clipboard = new ClipboardJS('.btnc');

clipboard.on('success', function(e) {
    // notification('Copied', 'success');
    
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    copyToClipboard(e.text);
    // copyToClipboard('hello\nworld')
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    notification(e.action, 'error');
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});
</script>

<template>
  <div v-if="!loading.value">
     <Head>
        <title>Post</title>
         <!-- Facebook, Whatsapp -->
        <meta property="og:site_name" content="Wenla Systems™" head-key="og:site_name">
        <meta property="og:title" :content="cardData.title" head-key="og:title">
        <meta property="og:description" :content="cardData.meta.seo_description.length > 100? cardData.meta.seo_description.substring(0,100)+'...':cardData.meta.seo_description" head-key="og:description">
        <meta property="og:image" :content="'/storage/posts/cover_images/'+cardData.featured_image"  head-key="og:image">
        <meta property="og:url" :content="$page.props.config.company.website+'/post/'+title" head-key="og:url">

        <!-- Twitter -->
        <meta name="twitter:title" :content="cardData.title" head-key="twitter:title">
        <meta name="twitter:description" :content="cardData.meta.seo_description.length > 100? cardData.meta.seo_description.substring(0,100)+'...':cardData.meta.seo_description" head-key="twitter:description">
        <meta name="twitter:image" :content="'/storage/posts/cover_images/'+cardData.featured_image" head-key="twitter:image">
        <meta property="twitter:url" :content="$page.props.config.company.website+'/post/'+title" head-key="twitter:url">
        <meta name="twitter:card" :content="cardData.meta.seo_description.length > 100? cardData.meta.seo_description.substring(0,100)+'...':cardData.meta.seo_description" head-key="twitter:card">
     </Head>

    <header class="pl-4 md:pl-0 h-64 bg-gray-800 bg-center bg-cover"
      v-bind:style="{ 'background-image': 'url(' + '/storage/posts/cover_images/'+cardData.featured_image + ')' }"
      style=" min-height: 500px;">
      <div class="container mx-auto h-full flex items-center justify-center">
        <div class="text-start w-full">
          <p class="text-xs font-bold tracking-wide text-gray-200">Published in <span class="text-white">World News</span>
          </p>
          <h1 class="text-4xl font-bold text-white mb-2">{{ cardData.title }}</h1>
          <p class="text-xl text-lg text-gray-100 mb-8" v-html="cardData.content.length > 100? cardData.content.substring(0,100)+'...':cardData.content"></p>
          <!-- <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Published in January 2021</p> -->
        </div>
      </div>
    </header>
  
    <div class="container mx-auto sm:py-16 sm:px-4 rounded-lg bg-gray-800 shadow-md" style="margin-top: -5rem;">
      <div class="relative">
        <div class="flex">
          <div class="w-3/3 md:w-2/3 px-4 py-8">
            <div class="flex items-center justify-between mb-4">
              <div class="text-gray-700 text-sm font-semibold tracking-wide">
                <span class="text-gray-400">By <a href="#" class="text-white">Article Writer</a> </span>
                <span class="mx-2">|</span>
                <span class="text-gray-400">{{cardData.created_at}}</span>
              </div>
              
            </div>
            <div class="flex">
              <div class="w-1/3 ">
                <div class="sticky top-0">
                  
                  <div class="flex flex-col rounded-lg" style="width: 3.5rem;">
                    <button class="py-2 px-4 bg-gray-900 text-white rounded-t-lg hover:opacity-50 hover:bg-gray-800 hover:border-2 hover:border-gray-500 hover:rounded-lg transition duration-300 ease-in-out disabled:hover:cursor-not-allowed" disabled>
                      <Icon icon="mdi:headphones" class="text-2xl text-gray-600"/>
                    </button>
                    <button class="py-2 px-4 bg-gray-900 text-white hover:opacity-50 hover:bg-gray-800 hover:border-2 hover:border-gray-500 hover:rounded-lg transition duration-300 ease-in-out disabled:hover:cursor-not-allowed" disabled>
                      <Icon icon="mdi:eye" class="text-1xl "/>
                      <p class="text-xs text-center">{{cardData.views}}</p>
                    </button>
                    <button @click="like" class="py-2 px-4 bg-gray-900 text-white hover:bg-gray-800 hover:border-2 hover:border-gray-500 hover:rounded-lg transition duration-300 ease-in-out disabled:hover:cursor-not-allowed" :disabled="loading">
                      <Icon v-if="isliked"
                       icon="mdi:thumb-up"
                      class="text-1xl text-gray-200"/>
                      <Icon v-else
                       icon="mdi:thumb-up-outline"
                      class="text-1xl text-gray-200"/>

                      <p class="text-xs text-left" >{{ likes }}</p>
                    </button>
                    <button @click="dislike" class="py-2 px-4 bg-gray-900 text-white hover:bg-gray-800 hover:border-2 hover:border-gray-500 hover:rounded-lg transition duration-300 ease-in-out disabled:hover:cursor-not-allowed" :disabled="loading">
                      <Icon v-if="isdisliked" icon="mdi:thumb-down" class="text-1xl text-gray-200"/>
                      <Icon v-else icon="mdi:thumb-down-outline" class="text-1xl text-gray-200"/>
                      <p class="text-xs text-center" v-text="dislikes"></p>
                    </button>
                    <div class="relative bg-gray-900">
                      <button 
                        class="py-2 px-4 bg-gray-900 text-white hover:bg-gray-800 hover:border-2 hover:border-gray-500 hover:rounded-lg transition duration-300 ease-in-out"
                        @click="isOpen = !isOpen"
                      >
                        <Icon icon="mdi:share" class="text-1xl"/>
                      </button>
                      <div 
                        class="absolute z-20 bg-white inline-flex rounded-lg shadow-lg py-2 mt-1 dark:bg-gray-800 dark:border-gray-700"
                        v-if="isOpen"
                        @click="isOpen = false"
                      >

                      <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
                        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
                          <h3 class="font-bold text-gray-800 dark:text-white">
                            Share
                            <div class="overflow-y-auto">
                            <p class="text-sm font-normal text-gray-800 dark:text-white">{{ cardData.title }}</p>
                            </div> 
                          </h3>
                          
                          <button type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800" data-hs-overlay="#hs-vertically-centered-modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z" fill="currentColor"/>
                            </svg>
                          </button>
                        </div>
                        
                        <div class="p-4 overflow-y-auto">
                          <div class="flex justify-center inline-flex gap-4">
                          <button  class="hover:bg-gray-900 text-white font-bold py-2 px-3 rounded-full flex items-center">
                            <ShareNetwork
                                network="twitter"
                                :url="$page.props.config.company.website+'/post/'+title"
                                :title="cardData.title"
                                :description="cardData.meta.seo_description"
                                :media="'/storage/posts/cover_images/'+cardData.featured_image"
                                twitter-user="cleo_hacker"
                                :hashtags="tags">
                                <svg height="20px" width="20px" id="Capa_1" viewBox="0 -4 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Twitter-color</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Color-" transform="translate(-300.000000, -164.000000)" fill="#00AAEC"> <path d="M348,168.735283 C346.236309,169.538462 344.337383,170.081618 342.345483,170.324305 C344.379644,169.076201 345.940482,167.097147 346.675823,164.739617 C344.771263,165.895269 342.666667,166.736006 340.418384,167.18671 C338.626519,165.224991 336.065504,164 333.231203,164 C327.796443,164 323.387216,168.521488 323.387216,174.097508 C323.387216,174.88913 323.471738,175.657638 323.640782,176.397255 C315.456242,175.975442 308.201444,171.959552 303.341433,165.843265 C302.493397,167.339834 302.008804,169.076201 302.008804,170.925244 C302.008804,174.426869 303.747139,177.518238 306.389857,179.329722 C304.778306,179.280607 303.256911,178.821235 301.9271,178.070061 L301.9271,178.194294 C301.9271,183.08848 305.322064,187.17082 309.8299,188.095341 C309.004402,188.33225 308.133826,188.450704 307.235077,188.450704 C306.601162,188.450704 305.981335,188.390033 305.381229,188.271578 C306.634971,192.28169 310.269414,195.2026 314.580032,195.280607 C311.210424,197.99061 306.961789,199.605634 302.349709,199.605634 C301.555203,199.605634 300.769149,199.559408 300,199.466956 C304.358514,202.327194 309.53689,204 315.095615,204 C333.211481,204 343.114633,188.615385 343.114633,175.270495 C343.114633,174.831347 343.106181,174.392199 343.089276,173.961719 C345.013559,172.537378 346.684275,170.760563 348,168.735283" id="Twitter"> </path> </g> </g> </g></svg>                          

                            </ShareNetwork>
                          </button>
                          <button class=" hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-full flex items-center">
                            <ShareNetwork
                                network="whatsapp"
                                :url="$page.props.config.company.website+'/post/'+title"
                                :title="cardData.title"
                                :description="cardData.meta.seo_description"
                                :media="'/storage/posts/cover_images/'+cardData.featured_image"
                                >
                                <svg height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 58 58" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path style="fill:#2CB742;" d="M0,58l4.988-14.963C2.457,38.78,1,33.812,1,28.5C1,12.76,13.76,0,29.5,0S58,12.76,58,28.5 S45.24,57,29.5,57c-4.789,0-9.299-1.187-13.26-3.273L0,58z"></path> <path style="fill:#FFFFFF;" d="M47.683,37.985c-1.316-2.487-6.169-5.331-6.169-5.331c-1.098-0.626-2.423-0.696-3.049,0.42 c0,0-1.577,1.891-1.978,2.163c-1.832,1.241-3.529,1.193-5.242-0.52l-3.981-3.981l-3.981-3.981c-1.713-1.713-1.761-3.41-0.52-5.242 c0.272-0.401,2.163-1.978,2.163-1.978c1.116-0.627,1.046-1.951,0.42-3.049c0,0-2.844-4.853-5.331-6.169 c-1.058-0.56-2.357-0.364-3.203,0.482l-1.758,1.758c-5.577,5.577-2.831,11.873,2.746,17.45l5.097,5.097l5.097,5.097 c5.577,5.577,11.873,8.323,17.45,2.746l1.758-1.758C48.048,40.341,48.243,39.042,47.683,37.985z"></path> </g> </g></svg>

                            </ShareNetwork>
                          </button>
                          <button href="#" class=" hover:bg-gray-900 text-white font-bold py-2 px-3 rounded-full flex items-center">
                            <ShareNetwork
                                network="linkedin"
                                :url="$page.props.config.company.website+'/post/'+title"
                                :title="cardData.title"
                                :description="cardData.meta.seo_description"
                                :media="'/storage/posts/cover_images/'+cardData.featured_image"
                                :hashtags="tags">
                                <svg height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.02 512.02" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(0 -1)"> <path style="fill:#007AAA;" d="M61.813,5.424c33.545,0,61.793,28.248,61.793,61.793c0,35.31-30.014,62.676-61.793,61.793 C29.151,129.893,0.02,102.527,0.02,67.217C-0.863,32.789,27.386,5.424,61.813,5.424"></path> <path style="fill:#007AAA;" d="M96.241,508.596H25.62c-9.71,0-17.655-7.945-17.655-17.655V181.976 c0-9.71,7.062-17.655,16.772-17.655h71.503c9.71,0,17.655,7.945,17.655,17.655v309.848 C113.896,500.651,105.951,508.596,96.241,508.596"></path> <path style="fill:#007AAA;" d="M511.137,272.017c0-65.324-48.552-116.524-113.876-116.524h-18.538 c-35.31,0-69.738,16.772-88.276,44.138c-6.179,6.179-8.828,8.828-8.828,8.828v-35.31c0-3.531-5.297-8.828-8.828-8.828h-88.276 c-3.531,0-8.828,3.531-8.828,7.945v329.269c0,3.531,5.297,7.062,8.828,7.062h97.103c3.531,0,8.828-3.531,8.828-7.062V310.858 c0-32.662,24.717-60.028,57.379-60.91c16.772,0,31.779,6.179,43.255,17.655c10.593,10.593,15.007,25.6,15.007,42.372v189.793 c0,3.531,5.297,8.828,8.828,8.828h88.276c3.531,0,8.828-5.297,8.828-8.828V272.017H511.137z"></path> </g> </g></svg>
                            </ShareNetwork>
                          </button>
                          <button class=" hover:bg-gray-900 text-white font-bold py-2 px-3 rounded-full flex items-center">
                            <ShareNetwork
                                network="facebook"
                                :url="$page.props.config.company.website+'/post/'+title"
                                :title="cardData.title"
                                :description="cardData.meta.seo_description"
                                :media="'/storage/posts/cover_images/'+cardData.featured_image"
                                :hashtags="tags">
                                <svg height="20px" width="20px" version="1.1"  viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="16" cy="16" r="14" fill="url(#paint0_linear_87_7208)"></circle> <path d="M21.2137 20.2816L21.8356 16.3301H17.9452V13.767C17.9452 12.6857 18.4877 11.6311 20.2302 11.6311H22V8.26699C22 8.26699 20.3945 8 18.8603 8C15.6548 8 13.5617 9.89294 13.5617 13.3184V16.3301H10V20.2816H13.5617V29.8345C14.2767 29.944 15.0082 30 15.7534 30C16.4986 30 17.2302 29.944 17.9452 29.8345V20.2816H21.2137Z" fill="white"></path> <defs> <linearGradient id="paint0_linear_87_7208" x1="16" y1="2" x2="16" y2="29.917" gradientUnits="userSpaceOnUse"> <stop stop-color="#18ACFE"></stop> <stop offset="1" stop-color="#0163E0"></stop> </linearGradient> </defs> </g></svg>

                            </ShareNetwork>
                          </button>

                          </div>
                        </div>
                        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-gray-700">
                          <p class="text-sm text-gray-400">Copyright &#169; {{new Date().getFullYear()}} <span><a class="underline hover:no-underline" :href="$page.props.config.developer.website" target="_blank" rel="noopener noreferrer">{{$page.props.config.developer.name}}</a> </span> </p>
                        </div>
                      </div>
                        <!-- <template v-for="(option, index) in options"  :key="index" >
                          <button 
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:shadow-outline-gray w-full text-left"
                            @click="selectOption(option)"
                          >
                            {{ option }}
                          </button>
                        </template> -->
                      </div>
                    </div>
                    <input class="hidden" id="copylink" :value="$page.props.config.company.website+'/post/'+title">
                    <button data-clipboard-target="#copylink" class="btnc py-2 px-4 bg-gray-900 text-white hover:bg-gray-800 hover:border-2 hover:border-gray-500 hover:rounded-lg transition duration-300 ease-in-out">
                      <Icon v-if="isCopied" icon="mdi:check-bold" class="text-1xl"/>
                      <Icon v-else icon="mdi:link-variant" class="text-1xl"/>
                    </button>
                    <button class=" py-2 px-4 bg-gray-900 text-white rounded-b-lg hover:bg-gray-800 hover:border-2 hover:border-gray-500 hover:rounded-lg transition duration-300 ease-in-out">
                      <Icon icon="mdi:dots-vertical" class="text-1xl "/>
                    </button>
                  </div>
                </div>

                <div class="relative">
                  <!-- <button 
                    class="py-3 px-4  justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
                    @click="isOpen = !isOpen"
                  >
                    {{ selectedOption }}
                    <svg 
                      class="h-5 w-5 ml-2" 
                      viewBox="0 0 20 20" 
                      fill="currentColor"
                    >
                      <path 
                        fill-rule="evenodd" 
                        d="M10 12a1 1 0 01-.7-.3l-4-4a1 1 0 011.4-1.4L10 10.58l3.3-3.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-.7.3z" 
                        clip-rule="evenodd"
                      />
                    </svg> 
                  </button> -->

                  
                </div>
                </div>


              <div class="w-3/3">
                <article class="bg-gray-800 rounded-lg shadow-md p-8">
                  <h2 class="text-2xl font-bold text-gray-100 mb-4">{{cardData.title}}</h2>
                  <img class="w-full rounded-lg shadow-md mb-4" :src="'/storage/posts/cover_images/'+cardData.featured_image" 
                    alt="Article Image">
                  <p class="text-lg text-gray-400 mb-8" v-html="cardData.content"></p>
                </article>
              </div>
            </div>
           

            <div class="bg-gray-800 py-4 px-6 mb-4">
              <h3 class="text-xl text-white font-bold mb-2">Comment section</h3>
              <form  @submit.prevent="submitComment">
                <label class="block mb-2 font-bold text-gray-400" for="comment">Leave a comment:</label>
                <textarea v-model="commentContent" class="w-full p-2 border-solid border-2 border-sky-500  rounded-lg text-white bg-gray-800"
                  name="comment" id="comment" rows="4"></textarea>
                 <div v-if="!$page.props.auth.user">
                  <input v-model="commentEmail"  type="email" id="email-input" name="email-input" class="py-3 mt-3 px-4 block w-full border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" placeholder="Enter your email" required>
                  <label  class="block mt-2 -mb-2 text-gray-400 text-sm" for="comment">Optional</label>
                  <input v-model="commentName" type="text" id="name-input" name="name-input" class="py-3 px-4 mt-3 block w-full border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" placeholder="Enter your name">
                </div>
                  <button
                      type="submit"
                      class="px-4 py-2 mt-4 bg-gray-800 rounded-lg shadow-md text-gray-400 
                      border-2 border-gray-700 font-semibold 
                      hover:bg-gray-700 hover:text-white 
                      focus:bg-gray-700 focus:text-white 
                      transition duration-150 ease-in-out disabled:hover:cursor-not-allowed" :disabled="loading">
                      Post Comment
                  </button>
              </form>
            </div>

            <div>
              <article v-for="comment in comments" :key="comment.id" class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900" :id="comment.id">
                  <footer class="flex justify-between items-center mb-2">
                      <div class="flex items-center">
                          <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <Icon icon="mdi:account-circle"  class="mr-2 w-6 h-6 rounded-full"/>
                                  {{ comment.name }}
                            </p>
                          <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                  title="February 8th, 2022">{{ comment.created_at }}</time></p>
                      </div>
                      <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                          class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                          type="button">
                          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                              </path>
                          </svg>
                          <span class="sr-only">Comment settings</span>
                      </button>
                      <!-- Dropdown menu -->
                      <div id="dropdownComment1"
                          class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                          <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                              aria-labelledby="dropdownMenuIconHorizontalButton">
                              <li>
                                  <a href="#"
                                      class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                              </li>
                              <li>
                                  <a href="#"
                                      class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                              </li>
                              <li>
                                  <a href="#"
                                      class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                              </li>
                          </ul>
                      </div>
                  </footer>
                  <p class="text-gray-300">{{ comment.content }}
                  </p>
                  <div class="flex items-center mt-4 space-x-4">
                      <button type="button" @click="showReplyForm(comment.id, '')"
                          class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                          <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                          Reply
                      </button>
                  </div>
                  <div v-if="comment.replies">
                    <article v-for="reply in comment.replies" :key="reply.id" 
                    class="p-6 mb-6 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900"
                    :data-set="comment.id"
                    :id="reply.id"
                     v-bind:class="reply.reply_to_id ? 'ml-6' : 'ml-6'"
                    >
                        <input type="hidden" :value="reply.reply_to_id" id="replyto">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                  <Icon icon="mdi:account-circle"  class="mr-2 w-6 h-6 rounded-full"/>
                                  {{ reply.name }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-12"
                                        title="February 12th, 2022">{{ reply.created_at }}</time></p>
                            </div>
                            <button id="dropdownComment2Button" data-dropdown-toggle="dropdownComment2"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                    </path>
                                </svg>
                                <span class="sr-only">Comment settings</span>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownComment2"
                                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <a href="#"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                    </li>
                                </ul>
                            </div>
                        </footer>
                        <p class="text-gray-300">{{ reply.content }}</p>
                        <!-- <p class="text-gray-300">{{ reply.reply_to_id }}</p> -->
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button" @click="showReplyForm(comment.id, reply.id)"
                                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                                <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                Reply
                            </button>
                        </div>
                    </article>
                  </div>
                  <form v-if="showingReplyForm === comment.id" @submit.prevent="submitReply(comment.id)">
                    
                    <textarea v-model="replyContent" class="w-full p-2 border-solid border-2 border-sky-500  rounded-lg text-white bg-gray-800"></textarea>
                    <div v-if="!$page.props.auth.user">
                      <input v-model="replyEmail"  type="email" id="email-input" name="email-input" class="py-3 mt-3 px-4 block w-full border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" placeholder="Enter your email" required>
                      <label  class="block mt-2 -mb-2 text-gray-400 text-sm" for="comment">Optional</label>
                      <input v-model="replyName" type="text" id="name-input" name="name-input" class="py-3 px-4 mt-3 block w-full border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" placeholder="Enter your name">
                    </div>
                    <button type="submit" class="px-4 py-2 mt-4 bg-gray-800 rounded-lg shadow-md text-gray-400 
                      border-2 border-gray-700 font-semibold 
                      hover:bg-gray-700 hover:text-white 
                      focus:bg-gray-700 focus:text-white 
                      transition duration-150 ease-in-out disabled:hover:cursor-not-allowed" :disabled="loading">Submit</button>
                  </form>
              </article>
              <!-- <ul>
                <li v-for="comment in comments" :key="comment.id">
                  <div>{{ comment.content }}</div>
                  <button
                   @click="showReplyForm(comment.id)"
                   class="px-4 py-2 mt-4 bg-gray-800 rounded-lg shadow-md text-gray-400 
                      border-2 border-gray-700 font-semibold 
                      hover:bg-gray-700 hover:text-white 
                      focus:bg-gray-700 focus:text-white 
                      transition duration-150 ease-in-out"
                   >Reply</button>
                  <ul v-if="comment.replies">
                    <li v-for="reply in comment.replies" :key="reply.id">
                      <div>{{ reply.content }}</div>
                    </li>
                  </ul>
                  <form v-if="showingReplyForm === comment.id" @submit.prevent="submitReply(comment.id)">
                    <textarea v-model="replyContent"></textarea>
                    <button type="submit">Submit</button>
                  </form>
                </li>
              </ul> -->
            </div>

          </div>

          
          <div class="hidden md:w-1/3 px-4 py-8 md:flex">
            <div class="sticky top-32 bottom-0">
              <h3 class="text-xl font-bold text-gray-100 mb-4">Popular Articles</h3>
              <ul class="list-reset">
                <li v-for="(post,index) in popularPosts" :key="index" class="flex items-stretch mb-8">
                  <div class="bg-gray-800 rounded-lg shadow-lg p-1">
                    <div class="flex items-center">
                      <!-- Image -->
                      <img class="w-28 h-28 rounded-lg shadow-md mr-8" :src="'/storage/posts/cover_images/'+post.featured_image"
                        alt="Article Image">
                      <!-- Text -->
                      <div class="text-gray-100">
                        <h3 class="text-xl font-bold mb-4">{{ post.title }}</h3>
                        <p class="text-gray-400 mb-4" v-html="post.content.length > 100? post.content.substring(0,100)+'...':post.content"></p>
                        <Link class="text-blue-500 font-bold py-2 px-0 underline  hover:no-underline" :href="'/post/'+post.title.replace(/ /g,'-').toLowerCase()">Read in minutes</Link>
                      </div>
                    </div>
                  </div>
                </li>
                
              </ul>

              <div class="grid grid-cols-1 gap-4 ">
                <div class="relative bg-gray-800 rounded-lg overflow-hidden">
                  <x-swiper :slidesPerView="1">
                    <swiper-slide v-for="(advert,index) in adverts" :key="index">
                      <Link :href="advert.link">
                        <img class="object-cover h-64 w-full" :src="'/storage/adverts/cover_images/'+advert.image_url" alt="Card Image">
                        <div class="p-4">
                          <h3 class="text-lg font-medium text-white">{{advert.title}}</h3>
                          <p class="text-gray-400 " v-html="advert.description"></p>
                        </div>
                      </Link>
                    </swiper-slide>
                  </x-swiper>
                </div>
               
              </div>

            </div>
          </div>
          
        </div>
      </div>
      <Aside class=" md:hidden" :adverts ="adverts" :popularPosts="popularPosts"/>
    </div>
  
  
    <!-- Container -->
    <div class="container mx-auto py-8 pl-5 sm:pl-0 bg-gray-900">
      <h3 class="text-xl font-bold text-gray-100 mb-4">Related Articles</h3>
    </div>

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
          <!-- Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <Link v-for="(tour, index) in relatedPosts" :key="index" class="group rounded-xl overflow-hidden" :href="'/post/'+tour.title.replace(/ /g,'-').toLowerCase()">
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
    <Subscribe />
    <!-- Container -->
    <!-- <div class="w-full py-16 text-center bg-gray-800">
      <h2 class="text-2xl font-bold text-white mb-4">Sign up for our newsletter</h2>
      <div class="max-w-2xl mx-auto ">
        <p class="text-gray-400 mb-4">Stay up to date with the roadmap progress, announcements and exclusive discounts
          feel free to sign up with your email.</p>
      </div>
      <div class="flex items-center justify-center">
        <input type="email" class="w-64 px-3 py-2 rounded-lg shadow-md mr-2" placeholder="Enter your email address">
  
        <button
              class="px-4 py-2 bg-gray-800 rounded-lg shadow-md text-gray-400 
              border-2 border-gray-700 font-semibold 
              hover:bg-gray-700 hover:text-white 
              focus:bg-gray-700 focus:text-white 
              transition duration-150 ease-in-out">
              Subscribe
        </button>
       
      </div>
    </div> -->
  </div>
</template>
  
