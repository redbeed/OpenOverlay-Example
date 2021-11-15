<template>
    <div :class="this.alertClass">
        <span class="inline-block align-middle mr-8">
            <b class="capitalize block text-xl">{{ this.title }}</b>
            <slot name="description">
                {{ this.description }}
            </slot>
        </span>
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "Alert",
    props: {
        color: {
            type: String,
            default: 'tomato',
        },
        title: {
            type: String,
        },
        description: {
            type: String,
        }
    },

    computed: {
        alertClass() {
            let backgroundColor = this.color !== 'white' ? `bg-${this.color}-800` : `bg-${this.color}`;
            let textColor = this.color !== 'white' ? 'text-white' : 'text-black';

            return [
                'flex flex-col sm:flex-row items-center justify-items-center px-6 py-4 border-0 sm:rounded-lg relative mb-4',
                backgroundColor, textColor
            ];
        }
    }
}
</script>

<style scoped>

</style>
