<template>
    <div>
        <x-menu-bar v-bind="{setup,selected}"></x-menu-bar>
        <div class="flex flex-col sm:flex-row gap-1 sm:gap-0 mt-1 sm:mt-16 bg-gray-800">
            <x-filter v-if="setup.settings.isSearch" :columns="setup.columns" ref='filter'/>
            <slot></slot>
            <form method="POST" action="/admin/data-export" ref="exportData" target="_blank">
                <input type="hidden" name="_token" :value="$page.props.csrf_token"/>
                <input type="hidden" name="data" :value="JSON.stringify(listData.data !== undefined? listData.data:listData)"/>
                <input type="hidden" name="fileName" :value="setup.settings.caption+'.csv'"/>
                <input type="hidden" name="model" :value="setup.settings.model"/>
            </form>
        </div>
        <div v-if="listData.data !== undefined && listData.data.length > 0">
            <x-pagination :links="listData.links"/>
        </div>
        <span  v-if="listData.data !== undefined && listData.data.length == 0" class="flex justify-center text-sm p-2"><em>** No records found **</em></span>
    </div>
</template>
<script>
    import xFilter from '@/Components/Filter.vue'
    import xPagination from '@/Components/Pagination.vue'
    import xMenuBar from '@/Components/MenuBar.vue'
    export default{
        components:{xFilter,xPagination,xMenuBar},
        props:{
            setup:Object,
            listData:Object,
            selected:{default:[]},
        }
    }
</script>
