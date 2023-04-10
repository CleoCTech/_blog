<template>
    <Head title="Dashboard" />
    <div class="bg-gray-900 ml-3">
        <h4 v-cloak class="text-center text-blue-500 mb-4 text-2xxl sm:text-sm pt-3 mt-3"><em>Hi {{$page.props.auth.user.name}}, welcome to {{$page.props.config.appName}}'s Portal Admin Dashboard</em></h4>
        <Link :href="route('home')" class="text-blue-500 mb-10 text-2xxl text-center pt-3 mt-3 ml-10">
            <h4 v-cloak class="text-center text-blue-500 mb-4 text-2xxl pt-3 mt-3 underline hover:no-underline"><em> Go back to blog [Home]</em></h4>
        </Link>
        <div  class="grid grid-cols-3 gap-4 bg-gray-900">
            <div class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Pageviews</h2>
                <p class="text-4xl font-bold ">{{statistics.totalViews}}</p>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Unique visitors</h2>
                <p class="text-4xl font-bold">5,000</p>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Time on site</h2>
                <p class="text-4xl font-bold">2:30</p>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Bounce rate</h2>
                <p class="text-4xl font-bold">25%</p>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Referral sources</h2>
                <ul class="list-disc list-inside">
                <li>Google: 60%</li>
                <li>Twitter: 20%</li>
                <li>Facebook: 10%</li>
                <li>Other: 10%</li>
                </ul>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Demographics</h2>
                <ul class="list-disc list-inside">
                <li>Age: 25-34</li>
                <li>Gender: Female</li>
                <li>Location: United States</li>
                </ul>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Conversion rates</h2>
                <p class="text-4xl font-bold">5%</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Popular posts</h2>
                <ol class="list-decimal list-inside">
                <li>10 Ways to Increase Your Blog Traffic</li>
                <li>The Importance of SEO for Your Blog</li>
                <li>5 Tips for Writing Engaging Blog Posts</li>
                </ol>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Engagement</h2>
                <ul class="list-disc list-inside">
                <li>Comments: 50</li>
                <li>Shares: 100</li>
                <li>Likes: 200</li>
                </ul>
            </div>
        </div>

        <x-line-chart v-if="!isChartLoading" :chartData="chartsData.clientsChart" :maxHeight="'h-80'" :maxWidth="'w-full'"/>
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
            this.getPageViews();
            // this.reload();
            // this.getStatistics();
            // this.getChartsData('all','monthly');
        },
        // updated() {
        //     console.log('updated!');
        //     this.reload();
        // },

        methods:{
            // reload(){
            //     window.location.reload();
            // },
            // vnodeUpdated() {
            //     console.log("vnodeUpdated")
            //     window.location.reload();
            // },
            getPageViews(){
                this.isLoading = true;
                var self = this;
                axios.get('/admin/dashboard/statistics').then(response => {
                    if(response.data != null){
                        var statistics = response.data;
                        self.statistics = statistics;
                        this.isLoading = false;
                    }
                }).catch((error) => {
                    console.log(error);
                })
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
