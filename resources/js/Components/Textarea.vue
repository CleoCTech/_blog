<template>
    <textarea :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="textarea" class="shadow appearance-none border w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled:opacity-40">
        <slot></slot>
    </textarea>
</template>
<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.textarea.focus()
            }
        }
    })
</script>
