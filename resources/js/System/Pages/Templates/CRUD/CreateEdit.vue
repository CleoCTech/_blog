<template>
    <div>
        <x-menu-bar v-bind="{setup,selected}" class="w-full"></x-menu-bar>
        <div class="flex flex-col md:flex-row mt-1 sm:mt-16 w-full bg-gray-800 border rounded-lg shadow-md">
            <x-panel class="grow w-full">
                <template #title>{{setup.pageTitle}}</template>
                <template #body>
                    <slot></slot>
                </template>
            </x-panel>
            <x-attachment v-if="isAttachments && setup.pageType == 'edit'" class="flex-none pr-2 md:max-w-xs" :setup="setup" :selected="selected"/>
        </div>
    </div>
</template>
<script>
    import xPanel from '@/Components/Panel.vue'
    import xButton from '@/Components/Button.vue'
    import xMenuBar from '@/Components/MenuBar.vue'
    import xAttachment from '@/Components/Attachment.vue'
    export default {
        components:{xPanel,xButton,xMenuBar,xAttachment},
        props:{
            setup:Object,
            selected:{default:[]},
        },
        data(){
            return{
                isAttachments:false,
            }
        }
    }
</script>
