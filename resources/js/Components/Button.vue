<template>
    <button v-if="theme == 'success'" :type="type" class="inline-flex bg-transparent bg-green-600  text-sm font-semibold py-1 px-2 hover:shadow text-white rounded-full shadow-md"><slot></slot></button>
    <button v-if="theme == 'error'" :type="type" class="inline-flex bg-transparent bg-red-500 text-sm font-semibold py-1 px-2 hover:shadow text-white rounded-full shadow-md"><slot></slot></button>
    <button v-if="theme == 'info'" :type="type" class="inline-flex bg-transparent bg-blue-500 text-sm font-semibold py-1 px-2 hover:shadow text-white rounded-full shadow-md"><slot></slot></button>
</template>
<script>
    export default{
        props:{
            type:{default:'button'},
            theme:{default:'success'},
        },
    }
</script>
