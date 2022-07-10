<template>
    <div class="shadow-xl rounded-lg relative" :class="[this.padding, this.backgroundColor]">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "BaseCard",

    props: {
        padding: {
            type: String,
            default: 'px-6 py-4'
        },

        backgroundColor: {
            type: String,
            default: 'bg-white'
        }
    },

}
</script>
