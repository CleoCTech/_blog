<template>
    <div class="px-1">
        <div class="flex gap-1 sm:gap-2 items-center text-gray-300">
            <h3 class="text-xs px-2 underline py-1 font-semibold">Attachments</h3>
            <button @click="this.isNew = !this.isNew" class="flex gap-1 text-xs items-center"><unicon name="plus" fill="black" class="icon-xs"/>New</button>
        </div>
        <div v-if="!isLoading">
            <form v-if="isNew" v-on:submit.prevent="submitAttachment" action="#" method="POST" enctype="multipart/form-data">
                <div class="flex gap-1 flex-col md:flex-row pb-1 px-4 md:px-0">
                    <input type="text" v-model="form.description" class="py-0 w-28 text-xs pl-1" placeholder="description" required>
                    <input type="file" @input="onFileChange($event)" ref="input" class="py-0 w-28 text-xs" required>
                    <button type="submit" class="text-xs bg-yellow-500 rounded-sm text-white px-1 w-18">Upload</button>
                </div>
            </form>
            <x-table>
                <template #thead>
                    <x-tableth>Description</x-tableth>
                    <x-tableth>Action</x-tableth>
                </template>
                <template #tbody>
                    <x-tabletr v-for="(attachment,index) in attachments" v-bind:key="index" :row="attachment.id+'#'+index" :url="''">
                        <x-tabletd>{{attachment.description}}</x-tabletd>
                        <x-tabletd>
                            <span class="flex gap-1 items-center">
                                <a :href="'/system/attachment/show/'+attachment.id" class="text-xs flex items-center gap-1" target="_blank"><unicon name="eye" fill="black" class="icon-xs"/>View</a>
                                <button @click="deleteAttachment(attachment.id)" class="text-xs flex items-center gap-1"><unicon name="times" fill="red" class="icon-xs"/> Delete</button>
                            </span>
                        </x-tabletd>
                    </x-tabletr>
                </template>
            </x-table>
            <span v-if="attachments.length == 0"><em class="text-xs">No attachments found</em></span>
        </div>
        <div v-if="isLoading" class="flex justify-center">
            <x-loading/>
        </div>
    </div>
</template>
<script>
    import xTable from '@/Components/Table/Table.vue'
    import xTabletd from '@/Components/Table/Td.vue'
    import xTableth from '@/Components/Table/Th.vue'
    import xTabletr from '@/Components/Table/Tr.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import xGrid from '@/Components/Grid.vue'
    import xGridCol from '@/Components/GridCol.vue'
    import xInput from '@/Components/Input.vue'
    import xLoading from '@/Components/Loading.vue'
    import { usePage } from '@inertiajs/inertia-vue3'
    export default{
        components:{xTable,xTabletd,xTableth,xTabletr,Link,xGrid,xGridCol,xInput,xLoading},
        props:{
            record:{default:''},
            setup:Object,
            selected:{default:[]},
        },
        data(){
            return{
                attachments:[],
                form:{
                    description:'',
                    attachment:'',
                    tableName:'',
                    recordId:'',
                },
                isNew:false,
                isLoading:true,
            }
        },
        mounted(){
            this.form.tableName = this.setup.tableName;
            this.form.recordId = this.selected[0].split('#')[0];
            this.getAttachments();
        },
        methods:{
            getAttachments(){
                var self = this;

                axios.get('/system/attachment/index/'+this.form.tableName+'/'+this.form.recordId).then(response => {
                    self.attachments = response.data;
                    this.isLoading = false;
                }).catch((error) => {
                    //
                })
            },
            submitAttachment(){
                this.isLoading = true;
                let formData = new FormData();
                for ( var key in this.form ) {
                    formData.append(key, this.form[key]);
                }
                axios.post('/system/attachment/store',formData).then(response => {
                    if(response.status == 200){
                        if(response.data.success !== undefined){
                            this.$notify({
                                text:response.data.success,
                                type:'success'
                            });
                        }
                        else{
                            this.$notify({
                                text:usePage().props.value.def_errors.permission,
                                type:'error'
                            });
                        }
                    }
                    else{
                        this.$notify({
                            text:usePage().props.value.def_errors.default,
                            type:'error'
                        });
                    }

                    this.getAttachments();
                    this.resetData();
                    // this.isLoading = false;
                }).catch((error) => {
                    if(error.response.status == 422){
                        var errors= [];
                        errors = error.response.data.errors;
                        for (let field of Object.keys(errors)) {
                            this.$notify({
                                text:errors[field][0],
                                type:'error'
                            });
                        }
                    }else{
                        this.$notify({
                            text:usePage().props.value.def_errors.default,
                            type:'error'
                        });
                    }
                    this.isLoading = false;
                })
            },
            onFileChange(event) {
                let files = event.target.files;
                if (files.length)
                    this.form.attachment = files[0];
            },
            resetData(){
                this.form.description = '';
                this.form.attachment = '';
                this.isNew = false;
            },
            deleteAttachment(id){
                if(confirm("Do you really want to delete this attachment?")){
                    this.isLoading = true;
                    var self = this;
                    axios.delete('/system/attachment/delete/'+id).then(response => {
                        this.$notify({
                            text:'Deleted Successfully',
                            type:'error'
                        });
                        this.getAttachments();
                    }).catch((error) => {
                        //
                    })
                }
            },
        },
    }
</script>

