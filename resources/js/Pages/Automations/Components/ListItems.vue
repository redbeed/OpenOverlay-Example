<template>
    <div>
        <div class="text-xl text-flamingo font-bold mb-2">
            <slot name="title"/>

        </div>
        <p class="text-slate-500 mb-6 md:max-w-sm">
            <slot name="description"/>
        </p>
        <div class="grid gap-4 md:gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
            <base-card
                v-for="item in this.items" v-on:click="this.editItem(item)"
                class="hover:shadow-md cursor-pointer transition-all relative">
                <div v-if="item.subtitle" class="text-flamingo-400 font-bold text-sm">{{ item.subtitle }}</div>
                <div class="text-flamingo font-bold text-xl">{{ item.name }}</div>
                <div class="text-slate-500 mb-2">{{ item.description }}</div>
                <i class="fa-solid fa-circle-right text-xl text-flamingo absolute inset-y-1/2 -translate-y-1/2 translate-x-1/2 right-0 w-5 h-5 flex justify-center items-center"></i>
            </base-card>
            <base-card
                v-on:click="this.modal.show = true" background-color="bg-flamingo"
                class="text-white hover:shadow-md hover:bg-flamingo-900 cursor-pointer transition-all">
                <slot name="add-item-button"/>
            </base-card>
        </div>
        <modal :show="this.modal.show" @close-modal="this.modal.show = false">
            <template #title>
                <slot name="motal-title"/>
            </template>
            <template #content>
                <div class="grid grid-cols-2 gap-4">
                    <div v-for="(item, itemFormClass) in this.itemsFormList" :key="itemFormClass"
                         v-on:click="this.addItem(itemFormClass)"
                         class="bg-slate-200 px-4 py-2 rounded-lg hover:bg-slate-300 cursor-pointer transition-all">
                        <div class="font-bold text-slate-700">{{ item.name }}</div>
                        <div class="text-slate-500 text-sm">{{ item.description }}</div>
                    </div>
                </div>
            </template>
        </modal>
    </div>
</template>

<script>
import BaseCard from "@/Pages/Components/BaseCard";
import Modal from "@/Pages/Components/Modal";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "ListItems",

    props: {
        automation: {
            type: Object,
            required: true,
        },
        items: {
            type: Array,
            required: true,
        },
        itemsFormList: {
            type: Object,
            default: {}
        }
    },

    data() {
        return {
            modal: {
                show: false,
            },
        };
    },

    methods: {
        addItem(className) {
            this.$emit('add-item', className);
        },

        editItem(item) {
            this.$emit('edit-item', item);
        },
    },

    components: {Modal, BaseCard}
}
</script>

<style scoped>

</style>
