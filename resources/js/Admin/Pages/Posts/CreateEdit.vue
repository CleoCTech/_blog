<template>
    <div>
        <x-create-edit-template :setup="setup" :selected="selected">
            <form v-on:submit.prevent="submit" action="#" method="POST" enctype="multipart/form-data">
                <x-grid>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Title</template>
                            <template #value><x-input type="text" v-model="form.title"/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-3">
                        <x-form-group class="sm:grid-cols-1">
                            <template #label>Content</template>
                            <template #value>
                                <ckeditor v-cloak :editor="editor" v-model="form.content" @ready="cardData != null? form.content = cardData.content:'' "></ckeditor>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Belongs To Category?</template>
                            <template #value>
                                <!-- <div class="inline-block" > -->
                                    <label v-for="category in form.categories" :key="category.uuid" class="flex items-center inline-block">
                                        <!-- <x-checkbox v-model="form.kategories" :value="category.id" /> -->
                                        <input type="checkbox" v-model="form.kategories" :value="category.uuid" 
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-100">{{category.title}}</span>
                                    </label>
                                <!-- </div> -->
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Select sub-categories</template>
                            <template #value>
                                <!-- <div class="inline-block" > -->
                                    <label v-for="category in form.sub_categories" :key="category.uuid" class="flex items-center inline-block">
                                        <!-- <x-checkbox v-model="form.kategories" :value="category.id" /> -->
                                        <input type="checkbox" v-model="form.sub_kategories" :value="category.uuid" 
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-100">{{category.title}}</span>
                                    </label>
                                   
                                <!-- </div> -->
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Select Tags (optional)</template>
                            <template #value>
                                <!-- <div class="inline-block" > -->
                                    <label v-for="tag in form.tags" :key="tag.uuid" class="flex items-center inline-block">
                                        <!-- <x-checkbox v-model="form.kategories" :value="category.id" /> -->
                                        <input type="checkbox" v-model="form.tagss" :value="tag.uuid" 
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-100">{{tag.title}}</span>
                                    </label>
                                    
                                <!-- </div> -->
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>SEO Title</template>
                            <template #value><x-input type="text" v-model="form.seo_title"/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>SEO Description</template>
                            <template #value><x-input type="text" v-model="form.seo_description"/></template>
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
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Visibility</template>
                            <template #value>
                                <x-select v-model="form.visibility">
                                    <option value="">--select--</option>
                                    <option v-for="(visibility,index) in setup.visibilities" :key="index" :value="visibility.id">{{visibility.caption}}</option>
                                </x-select>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-2">
                        <x-form-group>
                            <template #label>Featured Image</template>
                            <template #value>
                                <img v-if="show_image == '' && form.featured_image != null && form.featured_image != 'null'" :src="$page.props.storagePaths[setup.settings.storageName].posts.readPath+form.featured_image" class="h-20 w-20">
                                <x-input type="file"  @input="onFileChange($event,'featured_image', show_image)" ref="input" class="shadow appearance-none border w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline disabled:opacity-40"/>
                                <img v-if="show_image != ''" :src="show_image" class="h-20 w-20">
                            </template>
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
<script setup>
    // import CreateEditMixin from '@/System/Mixins/CRUD/CreateEditMixin.js'
    import { createEditProps, useCreateEdit } from '@/Composables/useCreateEdit'
    import { ref, reactive, computed  } from 'vue'

    const props = defineProps({...createEditProps, tags:[], categories:[], sub_categories:[]})

    const form = reactive({
        uuid: null,
        title: null,
        content: null,
        featured_image:null,
        status: null,
        visibility: null,
        publish_time: null,
        seo_title: null,
        seo_description: null,
        categories: [],
        kategories: [],
        sub_categories: [],
        sub_kategories: [],
        tags: [],
        tagss: [],
    })
    
    const show_image = ref('');

    function setData(){
        if (props.cardData != null && props.cardData.uuid != null) {
           
            form.uuid = props.cardData.uuid;
            form.title = props.cardData.title;
            form.content = props.cardData.content;
            form.featured_image = props.cardData.featured_image;
            form.status = props.cardData.status;
            form.visibility = props.cardData.visibility;
            form.publish_time = props.cardData.publish_time2;
            form.seo_title = props.cardData.meta.seo_title;
            form.seo_description = props.cardData.meta.seo_description;

            // console.log(props.categories);
            form.categories = props.categories;
            form.sub_categories = props.sub_categories;
            form.tags = props.tags;

            relationalData();
        } else {
            form.categories = props.categories;
            form.sub_categories = props.sub_categories;
            form.tags = props.tags;
            // console.log(form.categories);
        }
    }
    function relationalData() {
        // console.log(props.cardData.categories);
        props.cardData.categories.forEach(element => {
            form.kategories.push(element.uuid);
        });
        props.cardData.sub_categories.forEach(element => {
            form.sub_kategories.push(element.uuid);
        });
        props.cardData.tags.forEach(element => {
            form.tagss.push(element.uuid);
        });
        // console.log(form.kategories);
    }
    const { editor,editorConfig, submit, onFileChange, ckeditor, xGrid,
        xFormGroup,
        xGridCol,
        xLoading,
        xPanel,
        xInput,
        xSelect,
        xTextarea,
        xCheckbox,
        xButton,
        AppLayout,
        xCreateEditTemplate, TextInput } = useCreateEdit(props, setData, form )


    // computed(() => {
    //     console.log(props.cardData.categories);
    //     props.cardData.categories.forEach(element => {
    //         form.kategories.push(element.uuid);
    //     });
    //     console.log(form.kategories);
        
    //     // return message.value.length;
    // });
    
</script>
