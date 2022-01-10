<template>
    <textarea
        :class="`w-full ${ this.backgroundColor } p-4 text-sm border border-gray-200 rounded-xl text-gray-600 focus:outline-none focus:border-flamingo-200 focus:ring focus:ring-flamingo-100 focus:ring-opacity-50`"
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"></textarea>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        modelValue: String,
        backgroundColor: {
            type: String,
            default: 'bg-gray-50',
        },
    },

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
})
</script>
