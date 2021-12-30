<template>
    <button :type="type" class="inline-flex items-center p-4 bg-flamingo-800 border border-transparent rounded-xl font-bold text-xs text-white tracking-widest hover:bg-flamingo-700 active:bg-flamingo-900 focus:outline-none focus:border-flamingo-900 focus:ring focus:ring-flamingo-300 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    })
</script>
