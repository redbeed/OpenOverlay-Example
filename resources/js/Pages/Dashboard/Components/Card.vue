<template>
    <div class="bg-white shadow-xl sm:rounded-lg relative" :class="[this.padding]">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "Card",

    props: {
        padding: {
            type: String,
            default: 'px-6 py-4'
        }
    },

}
</script>
