<template>
    <base-card class="cursor-not-allowed">
        <div class="text-flamingo-800 font-bold text-xl">{{ automation.name }}</div>
        <div class="text-slate-500 mb-2">{{ automation.description }}</div>
        <div class="flex gap-2 text-xs mb-6">
            <div class="bg-slate-500 text-white px-2 py-1 rounded-lg">{{ automation.filters }} Filters</div>
            <div class="bg-slate-500 text-white px-2 py-1 rounded-lg">{{ automation.actions }} Actions</div>
        </div>

        <div class="text-slate-400 text-xs italic">This Automation can't be edit, it is configured in the code.</div>
    </base-card>
</template>

<script>
import BaseCard from "@/Pages/Components/BaseCard";

export default {
    name: "CodeCard",

    props: {
        automation: Object,
    },

    components: {BaseCard}
}
</script>

<style scoped>

</style>
