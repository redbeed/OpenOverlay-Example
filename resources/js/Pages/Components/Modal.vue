<template>
    <div class="w-full h-full top-0 left-0 fixed" :class="this.show ? '' : 'hidden'">
        <div class="w-full h-full bg-gray-700/30 top-0 left-0 absolute" v-on:click="this.closeModal"></div>
        <div
            class="sm:w-[385px] sm:min-w-[40vw] min-w-[80vw] flex flex-col gap-2 -translate-y-1/2 p-6 bg-white rounded-lg top-1/2 left-1/2 -translate-x-1/2 absolute">
            <button class="text-slate-500 text-3xl absolute right-0 top-0 translate-x-1/2 -translate-y-1/2"
                    v-on:click="this.closeModal">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
            <div class="text-flamingo text-xl font-bold w-100 flex justify-between">
                <slot name="title"></slot>
            </div>
            <div class="text-slate-500 flex flex-col gap-4">
                <slot name="content"></slot>

                <div class="ml-auto">
                    <slot name="buttons"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",

    props: {
        show: {
            type: Boolean,
            default: false,
        }
    },

    mounted() {
        document.addEventListener('keydown', this.escapeClose);
    },

    unmounted() {
        document.removeEventListener('keydown', this.escapeClose);
    },

    methods: {
        closeModal() {
            this.$emit('close-modal');
        },

        escapeClose(e) {
            if (this.show && e.key === 'Escape') {
                this.closeModal();
            }
        }
    }
}
</script>
