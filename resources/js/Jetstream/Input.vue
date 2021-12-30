<template>
    <input class="w-full p-4 text-sm bg-gray-50 focus:outline-none border border-gray-200 rounded-xl text-gray-600 focus:border-flamingo-200 focus:ring focus:ring-flamingo-100 focus:ring-opacity-50" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    })
</script>
