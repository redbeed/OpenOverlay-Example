<template>
    <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
        <slot></slot>
    </a>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        type: {
            type: String,
            default: 'button',
        },
    }
})
</script>
