<template>
    <app-layout>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-14">
            <div>
                <div class="text-xl text-flamingo font-bold mb-2">Automation Settings</div>
                <p class="text-slate-500 mb-6">
                    You can change a automation in real time. Please keep in mind that not all filters working with all
                    triggers in combination.
                </p>
                <p class="text-slate-400 text-sm">Created by: {{ this.automation.user_id }}</p>
                <p class="text-slate-400 text-sm">Created at: {{ this.automation.created_at }}</p>
            </div>
            <base-card class="col-span-2">
                <div class="grid gap-4">
                    <div>
                        <form-label value="Trigger" for="trigger"/>
                        <form-select :options="this.triggersList" v-model="this.automationForm.trigger"/>
                    </div>
                    <div>
                        <form-label value="Name" for="name"/>
                        <form-input v-model="this.automationForm.name" id="name"/>
                    </div>
                    <div>
                        <form-label value="Description" for="description"/>
                        <form-textarea v-model="this.automationForm.description" id="description"/>
                    </div>
                    <div class="flex">
                        <ui-button v-on:click="this.updateAutomation" class="ml-auto mr-0">
                            <i class="fa-solid fa-bolt mr-1"></i> Update
                        </ui-button>
                    </div>
                </div>
            </base-card>
        </div>

        <list-items
            class="mb-14"
            :automation="this.automation" :items="this.filters" :items-form-list="this.filtersFormList"
            @add-item="this.addFilter" @edit-item="this.editFilter">
            <template #title>
                <i class="fa-solid fa-filter mr-1"></i> Filters
            </template>
            <template #description>
                Filters running in order, if one filter fails the automation will be stopped.
            </template>
            <template #add-item-button>
                <span class="fa-solid fa-filter text-7xl text-flamingo-200 mb-6"/>
                <div class="flex flex-col">
                    <div class="text-xl font-bold text-white">
                        Add filter
                    </div>
                </div>
            </template>
            <template #motal-title>Add new filter</template>
        </list-items>

        <list-items
            class="mb-14"
            :automation="this.automation" :items="this.actions" :items-form-list="this.actionsFormList"
            @add-item="this.addAction" @edit-item="this.editAction">
            <template #title>
                <i class="fa-solid fa-fire mr-1"></i> Actions
            </template>
            <template #description>
                If all filters pass, all actions will be executed.
            </template>
            <template #add-item-button>
                <span class="fa-solid fa-fire text-7xl text-flamingo-200 mb-6"/>
                <div class="flex flex-col">
                    <div class="text-xl font-bold text-white">
                        Add action
                    </div>
                </div>
            </template>
            <template #motal-title>Add new action</template>
        </list-items>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import UiButton from "@/Pages/Components/Button";
import FormInput from '@/Jetstream/Input';
import FormTextarea from '@/Jetstream/Textarea';
import FormSelect from '@/Jetstream/Select';
import FormLabel from '@/Jetstream/Label';
import {useForm} from '@inertiajs/inertia-vue3';
import BaseCard from "@/Pages/Components/BaseCard";
import ListItems from "@/Pages/Automations/Components/ListItems";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "List",

    props: {
        automation: Object,
        filters: Array,
        actions: Array,
        triggersList: Object,
        filtersFormList: Object,
        actionsFormList: Object,
    },

    data() {
        return {
            automationForm: useForm({
                trigger: '',
                name: '',
                description: '',
            }),
        }
    },

    mounted() {
        this.setupForm();
    },

    methods: {
        updateAutomation() {
            this.automationForm
                .post(
                    route('automations.update', {automation: this.automation.id}),
                    {
                        preserveScroll: true,
                        only: ['automation'],
                        onSuccess: () => {
                            this.setupForm();
                        },
                    });
        },

        setupForm() {
            this.automationForm.trigger = this.automation.trigger;
            this.automationForm.name = this.automation.name;
            this.automationForm.description = this.automation.description;
        },

        addFilter(itemClassName) {
            Inertia.post(this.route('automations.filters.create', {automation: this.automation.id}), {
                form_class: itemClassName,
            });
        },

        editFilter(item) {
            Inertia.visit(this.route('automations.filters.edit', {automation: this.automation.id, filter: item.id}));
        },

        addAction(itemClassName) {
            Inertia.post(this.route('automations.actions.create', {automation: this.automation.id}), {
                form_class: itemClassName,
            });
        },

        editAction(item) {
            Inertia.visit(this.route('automations.actions.edit', {automation: this.automation.id, action: item.id}));
        },
    },

    components: {
        ListItems,
        BaseCard,
        AppLayout,
        FormInput, FormLabel, FormTextarea, UiButton,
        FormSelect,
    },
}
</script>
