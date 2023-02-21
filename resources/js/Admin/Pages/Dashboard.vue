<template>
    <Head title="Dashboard" />
    <div class="container bg-gray-800 mx-auto sm:py-16 sm:px-4 rounded-lg bg-gray-800 shadow-md" >

        <h4 v-cloak class="text-center text-gray-400 mb-4 text-xs sm:text-sm"><em>Hi {{$page.props.auth.user.name}}, welcome to {{$page.props.config.appName}}'s Portal Admin Dashboard</em></h4>
       
        <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 gap-4 p-4">

            
            <h1 class="text-white" >Dashboard</h1>
            <!-- <x-tile class="bg-red-500 border-red-700">
                <template #icon><collection-icon class="icon-sm"/></template>
                <template #value><x-loading v-if="isLoading"/><span v-if="!isLoading">{{statistics.totalIndustries}}</span></template>
                <template #label><x-link href="/admin/industries" class="underline text-md">Total Industries</x-link></template>
            </x-tile>
            <x-tile class="bg-green-500 border-green-700">
                <template #icon><collection-icon class="icon-sm"/></template>
                <template #value><x-loading v-if="isLoading"/><span v-if="!isLoading">{{statistics.totalSolutions}}</span></template>
                <template #label><x-link href="/admin/solution" class="underline text-md">Total Solutions</x-link></template>
            </x-tile>
            <x-tile class="bg-yellow-500 border-yellow-700">
                <template #icon><badge-check-icon class="icon-sm"/></template>
                <template #value><x-loading v-if="isLoading"/><span v-if="!isLoading">{{statistics.totalClients}}</span></template>
                <template #label><x-link href="/admin/client" class="underline">Total Clients</x-link></template>
            </x-tile>
            <x-tile class="bg-gray-500 border-gray-700">
                <template #icon><user-group-icon class="icon-sm"/></template>
                <template #value><x-loading v-if="isLoading"/><span v-if="!isLoading">{{statistics.totalAdminUsers}}</span></template>
                <template #label><x-link href="/system/admin-user" class="underline">Total Admin Users</x-link></template>
            </x-tile>
            <x-tile class="bg-pink-600 border-pink-700">
                <template #icon><user-group-icon class="icon-sm"/></template>
                <template #value><x-loading v-if="isLoading"/><span v-if="!isLoading">{{statistics.totalPublicUsers}}</span></template>
                <template #label>Total Public Users</template>
            </x-tile> -->

        </div>
        <!-- <x-line-chart v-if="!isChartLoading" :chartData="chartsData.clientsChart" :maxHeight="'h-80'" :maxWidth="'w-full'"/> -->
    </div>
</template>
<script>
    import xTile from '@/Components/Tile.vue'
    import xLink from '@/Components/Link.vue'
    import xLoading from '@/Components/Loading.vue'
    import { Head } from '@inertiajs/inertia-vue3';
    import { usePage } from '@inertiajs/inertia-vue3'

    export default{
        components:{
            xTile,
            xLink,
            xLoading,
            Head,
        },
        props:{
            cardData:Object,
            setup:Object,
        },
        data(){
            return {
                statistics:[],
                chartsData:[],
                isLoading:true,
                isChartLoading:true,
            }
            //
        },
        mounted(){
            // this.reload();
            // this.getStatistics();
            // this.getChartsData('all','monthly');
        },
        updated() {
            console.log('updated!');
            this.reload();
        },

        methods:{
            reload(){
                window.location.reload();
            },
            vnodeUpdated() {
                console.log("vnodeUpdated")
                window.location.reload();
            }
            // getStatistics(){
            //     this.isLoading = true;
            //     var self = this;
            //     axios.get('/admin/dashboard/statistics').then(response => {
            //         if(response.data != null){
            //             var statistics = response.data;
            //             self.statistics = statistics;
            //             this.isLoading = false;
            //         }
            //     }).catch((error) => {

            //     })
            // },
            // getChartsData(category,duration){
            //     var self = this;
            //     if(category == 'all'){
            //         this.isChartLoading = true;
            //     }else{
            //         this[category] = true;
            //     }
            //     axios.get('/admin/dashboard/charts/'+category+'/'+duration).then(response => {
            //         if(response.data != null){
            //             var data = response.data;
            //             if(category == 'all'){
            //                 self.chartsData = data;
            //                 this.isChartLoading = false;
            //             }else{
            //                 self.chartsData[category] = data;
            //                  this[category] = false;
            //             }
            //         }
            //     }).catch((error) => {

            //     })
            // }
        },

    }

</script>
