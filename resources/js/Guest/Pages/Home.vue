<template>
  <Head>
    <title>Home</title>
  </Head>
   <!-- Header -->
  <header class="pl-4 md:pl-0 h-64 bg-gray-800 bg-center bg-cover"
    style="background-image: url('https://picsum.photos/id/10/2500/1667'); min-height: 500px;">
    <div class="container mx-auto h-full flex items-center justify-center">
      <div class="text-start w-full">
        <p class="text-xs font-bold tracking-wide text-gray-200">Published in <span class="text-white">World News</span>
        </p>
        <h1 class="text-4xl font-bold text-white mb-2">Flowbite Blocks Tutorial - Learn how to get started with custom
          sections using the Flowbite Blocks</h1>
        <p class="text-xl text-lg text-gray-100 mb-8">Before going digital, you might scribbling down some ideas in a
          sketchbook.</p>
        <!-- <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Published in January 2021</p> -->
      </div>
    </div>
  </header>

  <!-- Main content -->
  <div class="container mx-auto sm:py-16 sm:px-4 rounded-lg bg-gray-800 shadow-md" style="margin-top: -5rem;">
    <div class="relative">
      <div class="flex">
        <div class="w-3/3 md:w-2/3 px-4 py-8">
          <div class="flex items-center justify-between mb-4">
            <div class="text-gray-700 text-sm font-semibold tracking-wide">
              <span class="text-gray-400">By <a href="http://" class="text-white">Article Writer</a> </span>
              <span class="mx-2">|</span>
              <span class="text-gray-400">August 3, 2022, 2:20am EDT</span>
            </div>
            <div class="flex items-center text-gray-700 text-sm font-semibold tracking-wide">
              <!-- Social media links and icons -->
              <a href="#" class="mr-3 text-gray-400">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="mr-3 text-gray-400">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="mr-3 text-gray-400">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <!-- Copy link icon -->
              <a href="#" class="mr-3 text-gray-400">
                <i class="fas fa-link"></i>
              </a>
              <!-- Save article icon -->
              <a href="#" class="mr-3 text-gray-400">
                <i class="fas fa-bookmark"></i>
              </a>
              <!-- Three dotted menu -->
              <div class="relative inline-block">
                <button class="text-gray-400 hover:text-gray-800 focus:outline-none">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
                <!-- <ul class="absolute right-0 w-48 py-2 mt-2 rounded-lg bg-gray-900 shadow-md">
                    <li><a href="#" class="block px-4 py-2 text-gray-400 hover:bg-gray-800 hover:text-white">Menu item 1</a></li>
                    <li><a href="#" class="block px-4 py-2 text-gray-400 hover:bg-gray-800 hover:text-white">Menu item 2</a></li>
                  </ul> -->
              </div>
            </div>
          </div>
          <article class="bg-gray-800 rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-100 mb-4">Article Title</h2>
            <img class="w-full rounded-lg shadow-md mb-4" src="https://picsum.photos/id/10/2500/1667"
              alt="Article Image">
            <p class="text-lg text-gray-400 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget
              ligula a elit aliquam vehicula. Etiam nec condimentum purus. Donec ut arcu in quam fermentum ultricies eu
              ac nisi. Proin sed dolor at neque vehicula efficitur. Aliquam at ornare diam, eget egestas diam. Duis
              volutpat diam quis ipsum placerat, vel interdum nunc pretium. Mauris eu magna metus. Nam in erat a metus
              consectetur placerat. Nullam tempus, tortor sed pharetra auctor, quam eros consectetur nulla, quis tempus
              arcu est in tellus.</p>
            <p class="text-lg text-gray-400 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget
              ligula a elit aliquam vehicula. Etiam nec condimentum purus. Donec ut arcu in quam fermentum ultricies eu
              ac nisi. Proin sed dolor at neque vehicula efficitur. Aliquam at ornare diam, eget egestas diam. Duis
              volutpat diam quis ipsum placerat, vel interdum nunc pretium. Mauris eu magna metus. Nam in erat a metus
              consectetur placerat. Nullam tempus, tortor sed pharetra auctor, quam eros consectetur nulla, quis tempus
              arcu est in tellus.</p>

            <p class="text-lg text-gray-400 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget
              ligula a elit aliquam vehicula. Etiam nec condimentum purus. Donec ut arcu in quam fermentum ultricies eu
              ac nisi. Proin sed dolor at neque vehicula efficitur. Aliquam at ornare diam, eget egestas diam. Duis
              volutpat diam quis ipsum placerat, vel interdum nunc pretium. Mauris eu magna metus. Nam in erat a metus
              consectetur placerat. Nullam tempus, tortor sed pharetra auctor, quam eros consectetur nulla, quis tempus
              arcu est in tellus.</p>

            <p class="text-lg text-gray-400 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget
              ligula a elit aliquam vehicula. Etiam nec condimentum purus. Donec ut arcu in quam fermentum ultricies eu
              ac nisi. Proin sed dolor at neque vehicula efficitur. Aliquam at ornare diam, eget egestas diam. Duis
              volutpat diam quis ipsum placerat, vel interdum nunc pretium. Mauris eu magna metus. Nam in erat a metus
              consectetur placerat. Nullam tempus, tortor sed pharetra auctor, quam eros consectetur nulla, quis tempus
              arcu est in tellus.</p>

            <p class="text-lg text-gray-400 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget
              ligula a elit aliquam vehicula. Etiam nec condimentum purus. Donec ut arcu in quam fermentum ultricies eu
              ac nisi. Proin sed dolor at neque vehicula efficitur. Aliquam at ornare diam, eget egestas diam. Duis
              volutpat diam quis ipsum placerat, vel interdum nunc pretium. Mauris eu magna metus. Nam in erat a metus
              consectetur placerat. Nullam tempus, tortor sed pharetra auctor, quam eros consectetur nulla, quis tempus
              arcu est in tellus.</p>

            <p class="text-lg text-gray-400 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget
              ligula a elit aliquam vehicula. Etiam nec condimentum purus. Donec ut arcu in quam fermentum ultricies eu
              ac nisi. Proin sed dolor at neque vehicula efficitur. Aliquam at ornare diam, eget egestas diam. Duis
              volutpat diam quis ipsum placerat, vel interdum nunc pretium. Mauris eu magna metus. Nam in erat a metus
              consectetur placerat. Nullam tempus, tortor sed pharetra auctor, quam eros consectetur nulla, quis tempus
              arcu est in tellus.</p>

            <p class="text-lg text-gray-400 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget
              ligula a elit aliquam vehicula. Etiam nec condimentum purus. Donec ut arcu in quam fermentum ultricies eu
              ac nisi. Proin sed dolor at neque vehicula efficitur. Aliquam at ornare diam, eget egestas diam. Duis
              volutpat diam quis ipsum placerat, vel interdum nunc pretium. Mauris eu magna metus. Nam in erat a metus
              consectetur placerat. Nullam tempus, tortor sed pharetra auctor, quam eros consectetur nulla, quis tempus
              arcu est in tellus.</p>

            <p class="text-lg text-gray-400 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget
              ligula a elit aliquam vehicula. Etiam nec condimentum purus. Donec ut arcu in quam fermentum ultricies eu
              ac nisi. Proin sed dolor at neque vehicula efficitur. Aliquam at ornare diam, eget egestas diam. Duis
              volutpat diam quis ipsum placerat, vel interdum nunc pretium. Mauris eu magna metus. Nam in erat a metus
              consectetur placerat. Nullam tempus, tortor sed pharetra auctor, quam eros consectetur nulla, quis tempus
              arcu est in tellus.</p>


          </article>
          <div class="bg-gray-800 py-4 px-6 mb-4">
            <h3 class="text-xl text-white font-bold mb-2">Comment section</h3>
            <form>
              <label class="block mb-2 font-bold text-gray-400" for="comment">Leave a comment:</label>
              <textarea class="w-full p-2 border-solid border-2 border-sky-500  rounded-lg text-white bg-gray-800"
                name="comment" id="comment" rows="4"></textarea>
                <button
                    class="px-4 py-2 mt-4 bg-gray-800 rounded-lg shadow-md text-gray-400 
                    border-2 border-gray-700 font-semibold 
                    hover:bg-gray-700 hover:text-white 
                    focus:bg-gray-700 focus:text-white 
                    transition duration-150 ease-in-out">
                    Submit
                </button>
            </form>
          </div>
        </div>
        <div class="hidden md:w-1/3 px-4 py-8 md:flex">
          <div class="sticky top-32 bottom-0">
            <h3 class="text-xl font-bold text-gray-100 mb-4">Latest Articles</h3>
            <ul class="list-reset">
              <li class="flex items-stretch mb-8">
                <div class="bg-gray-800 rounded-lg shadow-lg p-1">
                  <div class="flex items-center">
                    <!-- Image -->
                    <img class="w-28 h-28 rounded-lg shadow-md mr-8" src="https://picsum.photos/id/10/2500/1667"
                      alt="Article Image">
                    <!-- Text -->
                    <div class="text-gray-100">
                      <h3 class="text-xl font-bold mb-4">Article Title</h3>
                      <p class="text-gray-400 mb-4">Brief description of the article</p>
                      <a class="text-blue-500 font-bold py-2 px-0 underline  hover:no-underline" href="#">Read in 9
                        minutes</a>
                    </div>
                  </div>
                </div>
              </li>
              <li class="flex items-stretch mb-8">
                <div class="bg-gray-800 rounded-lg shadow-lg p-1">
                  <div class="flex items-center">
                    <!-- Image -->
                    <img class="w-28 h-28 rounded-lg shadow-md mr-8" src="https://picsum.photos/id/10/2500/1667"
                      alt="Article Image">
                    <!-- Text -->
                    <div class="text-gray-100">
                      <h3 class="text-xl font-bold mb-4">Enterprise Design tips</h3>
                      <p class="text-gray-400 mb-4">Over the past year, Volosoft has undergone changes.</p>
                      <a class="text-blue-500 font-bold py-2 px-0 underline  hover:no-underline" href="#">Read in 9
                        minutes</a>
                    </div>
                  </div>
                </div>
              </li>
              <li class="flex items-stretch mb-8">
                <div class="bg-gray-800 rounded-lg shadow-lg p-1">
                  <div class="flex items-center">
                    <!-- Image -->
                    <img class="w-28 h-28 rounded-lg shadow-md mr-8" src="https://picsum.photos/id/10/2500/1667"
                      alt="Article Image">
                    <!-- Text -->
                    <div class="text-gray-100">
                      <h3 class="text-xl font-bold mb-4">Partnered up with Google</h3>
                      <p class="text-gray-400 mb-4">Over the past year, Volosoft has undergone changes.</p>
                      <a class="text-blue-500 font-bold py-2 px-0 underline  hover:no-underline" href="#">Read in 9
                        minutes</a>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
            <div class="grid grid-cols-1 gap-4 ">
              <div class="relative bg-gray-800 rounded-lg overflow-hidden">
                <img class="object-cover h-64 w-full" src="https://picsum.photos/id/10/2500/1667" alt="Card Image">
                <div class="p-4">
                  <h3 class="text-lg font-medium text-white">Advertismnet</h3>
                  <p class="text-gray-400">Some additional information about the card.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Container -->
  <div class="container mx-auto py-8 pl-5 sm:pl-0 bg-gray-900">
    <h3 class="text-xl font-bold text-gray-100 mb-4">Related Articles</h3>
  </div>
  <div class="container mx-auto py-8  bg-gray-900">
    <div class="grid grid-cols-1 px-4 md:grid-cols-2 sm:px-0 gap-4 ">
      <!-- Column 1 -->
      <div class="col-span-1">
        <!-- Card 1 -->
        <div class="bg-gray-900 rounded-lg shadow-lg p-1">
          <div class="flex items-center">
            <!-- Image -->
            <img class="w-32 h-32 md:w-44 h-44 rounded-lg shadow-md mr-8" src="https://picsum.photos/id/10/2500/1667"
              alt="Article Image">
            <!-- Text -->
            <div class="text-gray-100">
              <h3 class="text-xl font-bold mb-4"> Enterprise design tips</h3>
              <p class="text-gray-400 mb-4">Over the past year, Volosoft has undergone many changes! After months of
                preparation.</p>
              <a class="text-blue-500 font-bold py-2 px-0 underline  hover:no-underline" href="#">Read in 9 minutes</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Column 2 -->
      <div class="col-span-1">
        <!-- Card 2 -->
        <div class="bg-gray-900 rounded-lg shadow-lg p-1">
          <div class="flex items-center">
            <!-- Image -->
            <img class="w-32 h-32 md:w-44 h-44 rounded-lg shadow-md mr-8" src="https://picsum.photos/id/10/2500/1667"
              alt="Article Image">
            <!-- Text -->
            <div class="text-gray-100">
              <h3 class="text-xl font-bold mb-4">Article Title</h3>
              <p class="text-gray-400 mb-4">Brief description of the article</p>
              <a class="text-blue-500 font-bold py-2 px-0 underline  hover:no-underline" href="#">Read in 9 minutes</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mx-auto py-8 bg-gray-900">
    <div class="grid grid-cols-1 px-4 md:grid-cols-2 sm:px-0 gap-4 ">
      <!-- Column 1 -->
      <div class="col-span-1">
        <!-- Card 1 -->
        <div class="bg-gray-900 rounded-lg shadow-lg p-1">
          <div class="flex items-center">
            <!-- Image -->
            <img class="w-32 h-32 md:w-44 h-44 rounded-lg shadow-md mr-8" src="https://picsum.photos/id/10/2500/1667"
              alt="Article Image">
            <!-- Text -->
            <div class="text-gray-100">
              <h3 class="text-xl font-bold mb-4">Article Title</h3>
              <p class="text-gray-400 mb-4">Brief description of the article</p>
              <a class="text-blue-500 font-bold py-2 px-0 underline  hover:no-underline" href="#">Read in 9 minutes</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Column 2 -->
      <div class="col-span-1">
        <!-- Card 2 -->
        <div class="bg-gray-900 rounded-lg shadow-lg p-1">
          <div class="flex items-center">
            <!-- Image -->
            <img class="w-32 h-32 md:w-44 h-44 rounded-lg shadow-md mr-8" src="https://picsum.photos/id/10/2500/1667"
              alt="Article Image">
            <!-- Text -->
            <div class="text-gray-100">
              <h3 class="text-xl font-bold mb-4">Article Title</h3>
              <p class="text-gray-400 mb-4">Brief description of the article</p>
              <a class="text-blue-500 font-bold py-2 px-0 underline  hover:no-underline" href="#">Read in 9 minutes</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Container -->
  <div class="w-full py-16 text-center bg-gray-800">
    <!-- Title -->
    <h2 class="text-2xl font-bold text-white mb-4">Sign up for our newsletter</h2>
    <div class="max-w-2xl mx-auto ">
      <p class="text-gray-400 mb-4">Stay up to date with the roadmap progress, announcements and exclusive discounts
        feel free to sign up with your email.</p>
    </div>
    <!-- Email input and button -->
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
  </div>

</template>

<script setup>
  // import { Head } from '@inertiajs/inertia-vue3';

</script>