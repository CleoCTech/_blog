<template>
     <!-- Sidebar -->
     <div id="docs-sidebar" 
        class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden 
        fixed top-0 left-0 bottom-0 z-[60] w-52 bg-white border-r border-gray-200 py-10 px-8 overflow-y-auto scrollbar-y 
        lg:block lg:translate-x-0 lg:top-0 lg:right-auto lg:bottom-0 lg:left-[max(0px,calc(50%-60rem))] 
        lg:z-10 dark:scrollbar-y dark:bg-slate-900">
      <!-- Navigation Toggle -->
      <button type="button" class="ml-auto flex justify-end lg:hidden text-gray-500 hover:text-gray-600" data-hs-overlay="#docs-sidebar" aria-controls="docs-sidebar" aria-label="Toggle navigation">
        <span class="sr-only">Toggle Navigation</span>
        <svg class="w-5 h-5" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
        </svg>
      </button>
      <!-- End Navigation Toggle -->

      <!-- Nav -->
      <nav id="sidebar-nav" class="relative space-y-8">
        <h5 class="mb-3 ml-0.5 text-sm font-semibold text-slate-900 dark:text-slate-200 pt-8 uppercase">Dashboard</h5>
        <ul class="ml-0.5 space-y-2 border-l-2 border-slate-100 dark:border-slate-800" data-hs-scrollspy="#scrollspy">
            <sidebar-link :href="route('admin.dashboard')" :active="$page.url == '/admin/dashboard'" class="cursor-pointer uppercase">Home</sidebar-link>
            <sidebar-link :href="route('system.company')" :active="$page.url == '/system/company-information'" class="cursor-pointer uppercase">Company Information</sidebar-link>
            <sidebar-link :href="route('system.social')" :active="$page.url == '/system/social-media'" class="cursor-pointer uppercase ">Social Media</sidebar-link>
            <sidebar-link :href="route('logout')" method="post" as="button" class="cursor-pointer uppercase">
                <unicon name="sign-out-alt"/> Log Out
            </sidebar-link>
        </ul>
      </nav>
      <!-- Nav -->
    </div>
    <!-- End Sidebar -->
    <!-- <div class="flex">
        <aside class=" fixed left-0 top-0 h-screen dark:bg-gray-900 pt-20 dark:text-white">
            <sidebar-link :href="route('admin.dashboard')" :active="$page.url == '/admin/dashboard'" class="cursor-pointer uppercase ml-4 hover:bg-gray-100 hover:text-blue-700">Home</sidebar-link>
            <sidebar-link :href="route('system.company')" :active="$page.url == '/system/company-information'" class="cursor-pointer uppercase ml-4 hover:bg-gray-100 hover:text-blue-700">Company Information</sidebar-link>
            <sidebar-link :href="route('system.social')" :active="$page.url == '/system/social-media'" class="cursor-pointer uppercase ml-4 hover:bg-gray-100 hover:text-blue-700">Social Media</sidebar-link>
            <sidebar-link :href="route('logout')" method="post" as="button" class="cursor-pointer uppercase ml-4 hover:bg-gray-100 hover:text-blue-700">
                <unicon name="sign-out-alt"/> Log Out
            </sidebar-link>
        </aside>
    </div> -->
    <!-- <div class="h-screen sticky z-40">
        <div class="bg-theme1 fixed left-0 top-0 h-screen  min-h-screen h-full w-full sm:w-full whitespace-nowrap sticky dark:bg-gray-900 dark:border-gray-600 dark:text-white">
            <sidebar-link :href="route('admin.dashboard')" :active="$page.url == '/admin/dashboard'" class="cursor-pointer uppercase ml-4 hover:bg-gray-100 hover:text-blue-700">Home</sidebar-link>
            <sidebar-link :href="route('system.company')" :active="$page.url == '/system/company-information'" class="cursor-pointer uppercase ml-4 hover:bg-gray-100 hover:text-blue-700">Company Information</sidebar-link>
            <sidebar-link :href="route('system.social')" :active="$page.url == '/system/social-media'" class="cursor-pointer uppercase ml-4 hover:bg-gray-100 hover:text-blue-700">Social Media</sidebar-link>
            <sidebar-link :href="route('logout')" method="post" as="button" class="cursor-pointer uppercase ml-4 hover:bg-gray-100 hover:text-blue-700">
                <unicon name="sign-out-alt"/> Log Out
            </sidebar-link>
        </div>
    </div> -->
</template>
<script>
    import SidebarLink from '@/Components/SidebarLink.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    export default{
        components:{SidebarLink,Link}
    }
</script>
