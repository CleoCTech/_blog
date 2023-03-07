<template>
     <!-- Sidebar -->
     <div id="docs-sidebar" 
        class="flex hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden 
        fixed top-0 left-0 bottom-0 z-[60] w-56 bg-white border-r border-gray-200 py-10 px-8 overflow-y-auto scrollbar-y 
        lg:block lg:translate-x-0 lg:top-0 lg:right-auto lg:bottom-0 lg:left-[max(0px,calc(50%-60rem))] 
        lg:z-10 dark:scrollbar-y dark:bg-slate-900 mr-2">
      <!-- Navigation Toggle -->
      <button type="button" class="ml-auto flex justify-end lg:hidden text-gray-500 hover:text-gray-600" data-hs-overlay="#docs-sidebar" aria-controls="docs-sidebar" aria-label="Toggle navigation">
        <span class="sr-only">Toggle Navigation</span>
        <svg class="w-5 h-5" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
        </svg>
      </button>
      <!-- End Navigation Toggle -->
      
      <Icon icon="mdi:arrow-left-circle" class="text-3xl bg-white text-gray-900 rounded-full absolute -right-2 top-14 cursor-pointer "/>
      <!-- Nav -->
      <nav id="sidebar-nav" class="relative space-y-8">
        <h5 class="mb-3 ml-0.5 text-sm font-semibold text-slate-900 dark:text-slate-200 pt-8 uppercase">Dashboard</h5>
        <ul class="ml-0.5 space-y-2 border-l-2 border-slate-100 dark:border-slate-800" data-hs-scrollspy="#scrollspy">
            <sidebar-link :href="route('admin.dashboard')" :active="$page.url == '/admin/dashboard'" class="cursor-pointer uppercase"><Icon icon="mdi:home" class="inline-block text-3xl -pt-3 -top-1"/> Home</sidebar-link>
            <sidebar-link :href="route('system.company')" :active="$page.url == '/system/company-information'" class="cursor-pointer uppercase"> <Icon icon="mdi:account-box-multiple-outline" class="inline-block text-2xl mr-1"/>Company Information</sidebar-link>
            <sidebar-link :href="route('system.social')" :active="$page.url == '/system/social-media'" class="cursor-pointer uppercase "><Icon icon="mdi:transit-connection-horizontal" class="inline-block text-2xl mr-1 "/>Social Media</sidebar-link>
          
        </ul>
        <ul 
        class="py-1 pl-4 ml-0.5 space-y-2 border-l-2 border-slate-100 text-slate-500  cursor-pointer
        hover:border-slate-400
        dark:text-slate-400 dark:hover:text-slate-300 hs-scrollspy-active:font-medium 
        hs-scrollspy-active:text-blue-600 dark:hs-scrollspy-active:text-blue-400 active
        dark:border-slate-800 uppercase" 
        data-hs-scrollspy="#scrollspy">
        <Icon icon="mdi:list-box-outline" class="inline-block text-2xl mr-1 "/>
            Posts 
            <span class="inline-block ml-5 cursor-pointer">
                <Icon icon="mdi:chevron-down" />
            </span>
            <sidebar-link :href="route('category.post')" :active="$page.url == '/admin/category-post'" class="cursor-pointer  "><Icon icon="mdi:chevron-right" class="inline-block mr-1 "/>Post Categories</sidebar-link>
            <sidebar-link :href="route('category.subcategory')" :active="$page.url == '/admin/category-post-sub-categories'" class="cursor-pointer  "><Icon icon="mdi:chevron-right" class="inline-block mr-1 "/>Post Sub-Categories</sidebar-link>
            <sidebar-link :href="route('tag.post')" :active="$page.url == '/admin/tag-post'" class="cursor-pointer  "><Icon icon="mdi:chevron-right" class="inline-block mr-1 "/>Tags</sidebar-link>
            <sidebar-link :href="route('post')" :active="$page.url == '/admin/post'" class="cursor-pointer  "><Icon icon="mdi:chevron-right" class="inline-block mr-1 "/>Posts</sidebar-link>
            <!-- <li><a href="#" class="text-sm block px-4 py-2 text-gray-800 hover:bg-gray-100">Sub-item 2</a></li>
            <li><a href="#" class="text-sm block px-4 py-2 text-gray-800 hover:bg-gray-100">Sub-item 3</a></li> -->
        </ul>

        <ul class="ml-0.5 space-y-2 border-l-2 border-slate-100 dark:border-slate-800 " data-hs-scrollspy="#scrollspy">
            <sidebar-link :href="route('logout')" method="post" as="button" class="cursor-pointer uppercase">
                <Icon icon="mdi:logout" class="inline-block text-2xl mr-1"/>  Log Out
            </sidebar-link>
        </ul>
      </nav>
      <!-- Nav -->
    </div>
    <!-- End Sidebar -->
    
</template>
<script setup>
    import SidebarLink from '@/Components/SidebarLink.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import { IoArrowBackCircleOutline } from "oh-vue-icons/icons";

    import { Icon } from '@iconify/vue';

</script>
