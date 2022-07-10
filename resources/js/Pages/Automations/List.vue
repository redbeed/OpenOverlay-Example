<template>
    <app-layout>
        <div class="flex flex-col">
            <ui-button v-on:click="this.automationModal.show = true" class="ml-auto mr-0">
                <i class="fa-solid fa-bolt mr-1"></i> Add Automation
            </ui-button>
        </div>
        <section v-for="automationGroup in this.automations" class="mb-10">
            <div class="text-xl">{{ automationGroup.name }}</div>
            <div class="text-slate-500 mb-4">{{ automationGroup.description }}</div>

            <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <automation-card v-for="automation in automationGroup.automations" :automation="automation"/>
            </div>
        </section>
        <modal :show="this.automationModal.show" @close-modal="this.automationModal.show = false">
            <template #title>New Automation</template>
            <template #content>
                <div class="grid gap-4">
                    <div>
                        <form-label value="Choose a Trigger" for="trigger"/>
                        <form-select id="trigger" class="mt-1 block w-full"
                                     :options="this.triggerOptions" required
                                     v-model="this.automationModal.form.trigger"/>
                        <form-error :message="this.automationModal.form.errors.trigger"/>
                    </div>
                    <div>
                        <form-label value="Name" for="name"/>
                        <form-input id="name" class="mt-1 block w-full" required
                                    v-model="this.automationModal.form.name"/>
                        <form-error :message="this.automationModal.form.errors.name"/>
                    </div>
                    <div>
                        <form-label value="Description" for="description"/>
                        <form-textarea id="description" class="mt-1 block w-full"
                                       v-model="this.automationModal.form.description"/>
                        <form-error :message="this.automationModal.form.errors.description"/>
                    </div>
                </div>
            </template>
            <template #buttons>
                <ui-button v-on:click="this.createAutomation" class="ml-auto mr-0">
                    <i class="fa-solid fa-bolt mr-1"></i> Create
                </ui-button>
            </template>
        </modal>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import AutomationCard from "@/Pages/Automations/Components/AutomationCard";
import Modal from "@/Pages/Components/Modal";
import UiButton from "@/Pages/Components/Button";
import FormInput from '@/Jetstream/Input';
import FormTextarea from '@/Jetstream/Textarea';
import FormSelect from '@/Jetstream/Select';
import FormLabel from '@/Jetstream/Label';
import FormError from '@/Jetstream/InputError';
import {useForm} from '@inertiajs/inertia-vue3';

export default {
    name: "List",

    props: {
        automations: Object,
        triggers: Object,
    },

    data() {
        return {
            automationModal: {
                show: false,
                form: useForm({
                    trigger: '',
                    name: '',
                    description: '',
                }),
            },
        }
    },

    methods: {
        createAutomation() {
            this.automationModal.form.post(route('automations.store'));
        },
    },

    computed: {
        triggerOptions() {
            let triggers = this.triggers;
            triggers[''] = 'Choose a Trigger';

            return Object.fromEntries(Object.entries(triggers).sort());
        }
    },

    components: {
        Modal,
        AutomationCard,
        AppLayout,
        FormInput, FormLabel, FormTextarea, UiButton,
        FormSelect, FormError,
    },
}
</script>
