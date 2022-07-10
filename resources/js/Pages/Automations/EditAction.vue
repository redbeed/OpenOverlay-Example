<template>
    <app-layout>
        <edit-item
            :automation="this.automation" :item="this.action" :settings-handler="this.settingsHandler"
            @update="this.updateAction">
            <template #title>
                <i class="fa-solid fa-action mr-1"></i> Action Settings
            </template>
            <template #description>
                You can set a alias name for your action to make it easier to remember. All actions having different
                settings.
            </template>
        </edit-item>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import EditItem from "@/Pages/Automations/Item/Edit";

export default {
    name: "EditAction",

    props: {
        automation: Object,
        action: Object,
        settingsHandler: Object,
    },

    methods: {
        updateAction(form) {
            form.post(this.route('automations.actions.update', {
                automation: this.automation.id,
                action: this.action.id
            }));
        },
    },

    components: {
        EditItem,
        AppLayout
    }
}
</script>

<style scoped>

</style>
