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
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Description</template>
                            <template #value><x-input type="text" v-model="form.description"/></template>
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
                                    <p class="text-white">Blog Categoories:</p>
                                    <ul>
                                        <li v-for="kategory in form.kategories" class="text-gray-300">{{ kategory }}</li>
                                    </ul>
                                <!-- </div> -->
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
                    <x-grid-col class="col-span-3">
                        <x-form-group>
                            <template #label>SVG</template>
                            <template #value><x-input type="text" v-model="form.svg"/></template>
                        </x-form-group>
                    </x-grid-col>
                </x-grid>
                <div class="flex justify-center py-2">
                    <!-- <button type="button" class="btn btn-primary text-white border-2 rounded-lg mr-2" v-on:click="greet(5,9)">Click me</button> -->
                    <!-- <x-button v-on:click="greet(2,9)" type="button">Test</x-button> -->
                    <x-button type="submit">Submit</x-button>
                </div>
            </form>
        </x-create-edit-template>
    </div>
</template>
<script setup>
    // import CreateEditMixin from '@/System/Mixins/CRUD/CreateEditMixin.js'
    import { createEditProps, useCreateEdit } from '@/Composables/useCreateEdit'
    import { ref, reactive } from 'vue'

    const props = defineProps({...createEditProps, categories: []})

    const form = reactive({
        uuid: null,
        title: null,
        description: null,
        svg: null,
        status: null,
        publish_time: null,
        categories: [],
        kategories: [],
    })
    
    const show_image = ref('')

    function setData(){
        if (props.cardData != null && props.cardData.uuid != null) {
            form.uuid = props.cardData.uuid;
            form.title = props.cardData.title;
            form.description = props.cardData.description;
            form.svg = props.cardData.svg;
            form.status = props.cardData.status;
            form.publish_time = props.cardData.publish_time2;

            form.categories = props.categories;
            relationalData();
        } else {
            form.categories = props.categories;
            // console.log(form.categories);
        }
        
    }
    function relationalData() {
        // console.log(props.cardData.categories);
        props.cardData.categories.forEach(element => {
            form.kategories.push(element.uuid);
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

    function greet(a, b){
        console.log(a);
            return alert(a+b);
    }
 
    
</script>
