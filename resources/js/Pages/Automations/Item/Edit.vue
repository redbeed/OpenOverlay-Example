<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-14">
        <div>
            <div class="text-xl text-flamingo font-bold mb-2">
                <slot name="title"/>
            </div>
            <p class="text-slate-500 mb-6">
                <slot name="description"/>
            </p>
        </div>
        <base-card class="col-span-2">
            <div class="grid gap-4">
                <div>
                    <form-label value="Name" for="name"/>
                    <form-input v-model="this.form.name" id="name"/>
                </div>

                <div v-for="element in this.settingsHandler.form">
                    <form-label :value="element.label" :for="element.id"/>

                    <form-checkbox v-if="element.type === 'checkbox'" v-model:checked="this.form[element.id]"
                                   :id="element.id"/>
                    <component v-else :is="`form-${element.type}`"
                               :id="element.id" v-model="this.form[element.id]" :placeholder="element.placeholder"/>

                    <form-error :message="this.form.errors[element.id]"/>
                </div>
                <div class="flex">
                    <ui-button v-on:click="this.updateItem" class="ml-auto mr-0">
                        <i class="fa-solid fa-bolt mr-1"></i> Update
                    </ui-button>
                </div>
            </div>
        </base-card>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import FormInput from '@/Jetstream/Input';
import FormTextarea from '@/Jetstream/Textarea';
import FormSelect from '@/Jetstream/Select';
import FormCheckbox from '@/Jetstream/Checkbox';
import FormLabel from '@/Jetstream/Label';
import FormError from '@/Jetstream/InputError';
import BaseCard from "@/Pages/Components/BaseCard";
import UiButton from "@/Pages/Components/Button";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "EditItem",

    props: {
        automation: Object,
        item: Object,
        settingsHandler: Object,
    },

    data() {
        return {
            fields: {
                name: '',
            },
            form: useForm({}),
        };
    },

    mounted() {
        this.fields.name = this.item.name;

        for (let key in this.settingsHandler.form) {
            const element = this.settingsHandler.form[key];
            this.fields[element.id] = element.value;
        }

        this.form = useForm(this.fields);
    },

    methods: {
        updateItem() {
            this.$emit('update', this.form);
        },
    },

    components: {
        AppLayout, BaseCard, UiButton,
        FormInput, FormTextarea,
        FormSelect, FormLabel,
        FormCheckbox,
        FormError
    }
}
</script>

<style scoped>

</style>
