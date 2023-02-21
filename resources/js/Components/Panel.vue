<template>
    <div class="flex justify-center">
        <div class="panel rounded-mdx w-screen sm:w-full $maxWidth">
            <!-- <div class="panel-header bg-theme1 flex justify-center py-1 px-1 text-white text-sm w-full">
                <slot name="title"></slot>
            </div> -->
            <div class="panel-body p-2 w-full">
                <slot name="body"></slot>
            </div>
            <div class="panel-footer w-full bg-gray-300">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>
