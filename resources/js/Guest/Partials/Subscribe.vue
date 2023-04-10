<script setup>
import {onMounted, ref } from 'vue'
import {useNotify} from "@/Composables/useNotify";


let {notification} = useNotify();
const loading = ref(false);
const customerEmail = ref(''); 

function subscribe() {
  loading.value = true

  setTimeout(function() {
    console.log("After waiting");
    customerEmail.value = ''
    loading.value = false
    notification('Thank you for subscribing, we promise not to spam you or share your data', 'success')
}, 3000); // 5000 milliseconds = 5 seconds
  
//   likes.value++;
//   // console.log(likes);
//   axios.post('/post/like', {
//       uuid: props.cardData.uuid,
//       likes: likes.value
//     })
//     .then(response => {
//       notification(response.data.message, 'success')
//       likes.value = response.data.likes;
//       isliked.value = true;
//       loading.value = false
//     })
//     .catch(error => {
//       console.log(error)
//       notification(error.error, 'error')
//       loading.value = false
//     })
}

</script>

<template>
    <div>
        <!-- Subscribe -->
        <div class="max-w-6xl py-16 px-4 sm:px-6 lg:px-8 lg:py-16 mx-auto bg-gray-800">
            <div class="max-w-xl text-center mx-auto">
                <div class="mb-5">
                <h2 class="text-2xl font-bold md:text-3xl md:leading-tight dark:text-white">Sign up to our newsletter</h2>
                </div>

                <form  @submit.prevent="subscribe">
                <div class="mt-5 lg:mt-8 flex flex-col items-center gap-2 sm:flex-row sm:gap-3">
                    <div class="w-full">
                    <label for="hero-input" class="sr-only">Search</label>
                    <input v-model="customerEmail" type="email" id="hero-input" name="hero-input" class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Enter your email" required>
                    </div>
                    <button 
                    class="w-full sm:w-auto whitespace-nowrap inline-flex justify-center 
                    items-center gap-x-3 text-center bg-blue-600 
                    hover:bg-blue-700 border border-transparent text-white font-medium rounded-md 
                    focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 
                    focus:ring-offset-white transition py-3 px-4 
                    dark:focus:ring-offset-gray-800 disabled:hover:cursor-not-allowed" :disabled="loading" >
                        Subscribe
                    </button>
                </div>
                </form>
            </div>
        </div>
        <!-- End Subscribe -->
    </div>
</template>



<style  scoped>

</style>