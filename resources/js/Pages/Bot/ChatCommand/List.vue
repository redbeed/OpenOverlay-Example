<template>
    <app-layout title="Add Bot Chat Command">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="py-3 flex items-center justify-end">
                <div>
                    <button-link class="bg-flamingo-700"
                                 :href="route('bot.chat-command.add')">
                        Add Command
                    </button-link>
                </div>
            </div>

            <div class="vue-table-lite">
                <vue-table-lite
                    :is-slot-mode="true"
                    :columns="this.columns"
                    :rows="this.commands"
                    :total="this.commands.length"
                >
                    <template #actions="data">
                        <div class="flex gab-1">
                            <button-link :href="route('bot.chat-command.edit', {commandId: data.value.id})" class="mr-1">
                                <i class="fa-solid fa-pen pr-1"></i> Edit
                            </button-link>
                            <danger-button-link :href="route('bot.chat-command.delete', {commandId: data.value.id})">
                                <i class="fa-solid fa-trash"></i>
                            </danger-button-link>
                        </div>
                    </template>

                </vue-table-lite>
            </div>
        </div>

    </app-layout>
</template>

<script>
import {defineComponent, reactive} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import VueTableLite from 'vue3-table-lite';
import DangerButtonLink from "@/Jetstream/DangerButtonLink";
import ButtonLink from "@/Jetstream/ButtonLink";

export default defineComponent({
    props: {
        commands: Array,
    },

    setup() {
        const columns = reactive([
            {
                field: 'command',
                label: 'Command',
            },
            {
                field: 'response',
                label: 'Response',
            },
            {
                field: 'actions',
                label: '',
            },
        ]);

        return {
            columns
        };
    },

    components: {
        DangerButtonLink,
        AppLayout,
        VueTableLite,
        ButtonLink,
    },
})
</script>
