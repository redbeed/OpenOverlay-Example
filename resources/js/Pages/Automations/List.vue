<template>
    <app-layout>
        <div class="flex flex-col content-end">
            <a class="bg-flamingo text-white px-4 py-2 rounded-lg w-full text-center">Add Automation</a>
        </div>
        <section v-for="automationGroup in this.automations" class="mb-10">
            <div class="text-xl">{{ automationGroup.name }}</div>
            <div class="text-slate-500 mb-4">{{ automationGroup.description }}</div>

            <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <code-card v-for="automation in automationGroup.automations" :automation="automation"/>
            </div>
        </section>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import CodeCard from "@/Pages/Automations/Components/CodeCard";

export default {
    name: "List",

    props: {
        automations: Array,
    },

    components: {
        CodeCard,
        AppLayout
    },
}
</script>
