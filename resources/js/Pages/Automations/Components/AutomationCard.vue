<template>
    <base-card
        :class="this.automation.editable ? 'transition-shadow hover:shadow-md cursor-pointer' : 'cursor-not-allowed'"
        v-on:click="this.open()">
        <div class="flex flex-col h-full">
            <div class="text-flamingo-800 font-bold text-xl">{{ automation.name }}</div>
            <div class="text-slate-500 mb-2">{{ automation.description }}</div>
            <div class="flex gap-2 text-xs mb-6">
                <div class="bg-slate-500 text-white px-2 py-1 rounded-lg">{{ automation.filters }} Filters</div>
                <div class="bg-slate-500 text-white px-2 py-1 rounded-lg">{{ automation.actions }} Actions</div>
            </div>

            <div v-if="!this.automation.editable" class="text-slate-400 text-xs italic mt-auto mb-0">
                This Automation can't be edit, it is configured in the code.
            </div>
        </div>
    </base-card>
</template>

<script>
import BaseCard from "@/Pages/Components/BaseCard";
import {Inertia} from '@inertiajs/inertia'

export default {
    name: "AutomationCard",

    props: {
        automation: Object,
    },

    methods: {
        open() {
            if (this.automation.editable) {
                Inertia.get(this.route('automations.edit', {automation: this.automation.id}));
            }
        }
    },

    components: {BaseCard}
}
</script>

<style scoped>

</style>
