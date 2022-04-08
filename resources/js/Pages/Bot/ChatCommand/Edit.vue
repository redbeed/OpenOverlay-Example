<template>
    <app-layout title="Add Bot Chat Command">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between w-full mb-4">
                <a :href="route('bot.chat-command')" class="text-sm font-medium text-gray-500">
                    <i class="fa-solid fa-angles-left"></i> Command List
                </a>
                <jet-button-link href="https://www.openoverlay.dev/docs/bot/add_chat_command" target="_blank">
                    Add Complex Command
                </jet-button-link>
            </div>

            <jet-form-section @submitted="addCommand">
                <template #title>
                    Edit Bot Chat Command
                </template>

                <template #description>
                    Change your Chat Command. Make sure your command is unique.
                </template>

                <template #form>

                    <!-- Command -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="command" value="Command"/>
                        <jet-input id="command" type="text" class="mt-1 block w-full" v-model="form.command"
                                   placeholder="!command"/>
                        <jet-input-error :message="form.errors.command" class="mt-2"/>
                    </div>

                    <!-- Response -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="response" value="Response"/>
                        <jet-textarea id="response" class="mt-1 block w-full" v-model="form.response"
                                      placeholder="This is a response text"/>
                        <jet-input-error :message="form.errors.response" class="mt-2"/>
                    </div>

                </template>

                <template #actions>
                    <jet-button type="submit" :disable="this.form.processing">
                        Save Command
                    </jet-button>
                </template>
            </jet-form-section>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from "@/Jetstream/Button";
import JetButtonLink from "@/Jetstream/ButtonLink";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetTextarea from "@/Jetstream/Textarea";
import {useForm} from '@inertiajs/inertia-vue3';

export default defineComponent({

    props: {
        command: Object,
    },

    setup(props) {
        let form = useForm({
            command: props.command.command,
            response: props.command.response,
        });

        return {form};
    },

    methods: {
        addCommand() {
            this.form.post(
                route(
                    'bot.chat-command.edit.post',
                    {commandId: this.command.id}
                )
            );
        }
    },

    components: {
        AppLayout,
        JetButton,
        JetFormSection,
        JetLabel,
        JetInput,
        JetTextarea,
        JetInputError,
    },
})
</script>
