<template>
    <select
        :class="`w-full ${ this.backgroundColor } p-4 text-sm border border-gray-200 rounded-lg text-gray-600 focus:outline-none focus:border-flamingo-200 focus:ring focus:ring-flamingo-100 focus:ring-opacity-50`" ref="select"
        @input="$emit('update:modelValue', $event.target.value)">
        <option v-for="(label, value) in options" :value="value" :key="value">{{ label }}</option>
    </select>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        options: {
            type: Object,
            required: true,
        },
        backgroundColor: {
            type: String,
            default: 'bg-gray-50',
        },
    },


    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.select.focus()
        }
    }
})
</script>
