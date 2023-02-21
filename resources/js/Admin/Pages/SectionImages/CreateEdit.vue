<template>
    <div>
         <x-create-edit-template :setup="setup" :selected="selected">
            <form v-on:submit.prevent="submit" action="#" method="POST" enctype="multipart/form-data">
                <x-grid>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Section Title</template>
                            <template #value><x-input type="text" v-model="form.area"/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-2">
                        <x-form-group>
                            <template #label>Cover Image</template>
                            <template #value>
                                <img v-if="show_image == '' && form.cover_image != null" :src="$page.props.storagePaths[setup.settings.storageName].cover_images.readPath+form.cover_image" class="h-20 w-20">
                                <input type="file" @input="onFileChange($event,'cover_image','show_image')" ref="input" class="shadow appearance-none border w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline disabled:opacity-40"/>
                                <img v-if="show_image != ''" :src="show_image" class="h-20 w-20">
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-3">
                        <x-form-group class="sm:grid-cols-1">
                            <template #label>Highlight</template>
                            <template #value>
                                <ckeditor :editor="editor" v-model="form.highlight" @ready="cardData != null? form.highlight = cardData.highlight:''"></ckeditor>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Status</template>
                            <template #value>
                                <x-select v-model="form.status">
                                    <option value="">--select--</option>
                                    <option v-for="(status,index) in setup.statuses" :key="index" :value="status.id">{{status.caption}}</option>
                                </x-select>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col v-if="form.status == 3">
                        <x-form-group>
                            <template #label>Publish Time</template>
                            <template #value><x-input type="datetime-local" v-model="form.publish_time"/></template>
                        </x-form-group>
                    </x-grid-col>
                </x-grid>
                <div class="flex justify-center py-2">
                    <x-button type="submit">Submit</x-button>
                </div>
            </form>
        </x-create-edit-template>
    </div>
</template>
<script>
    import CreateEditMixin from '@/System/Mixins/CRUD/CreateEditMixin.js'
    export default {
        mixins:[CreateEditMixin],
        data(){
            return{
                form:{
                    uuid: null,
                    area: null,
                    highlight: null,
                    cover_image: null,
                    status: null,
                    publish_time: null,
                },
                show_image:'',
            }
        },
        methods:{
            setData(){
                this.form.uuid = this.cardData.uuid
                this.form.area = this.cardData.area
                this.form.highlight = this.cardData.highlight
                this.form.cover_image = this.cardData.cover_image
                this.form.status = this.cardData.status;
                this.form.publish_time = this.cardData.publish_time2;
            },
        },
    }
</script>
