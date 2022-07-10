<template>
    <app-layout>
        <edit-item
            :automation="this.automation" :item="this.filter" :settings-handler="this.settingsHandler"
            @update="this.updateFilter">
            <template #title>
                <i class="fa-solid fa-filter mr-1"></i> Filter Settings
            </template>
            <template #description>
                You can set a alias name for your filter to make it easier to remember. All filters having different
                settings.
            </template>
        </edit-item>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import EditItem from "@/Pages/Automations/Item/Edit";

export default {
    name: "EditFilter",

    props: {
        automation: Object,
        filter: Object,
        settingsHandler: Object,
    },

    methods: {
        updateFilter(form) {
            form.post(this.route('automations.filters.update', {
                automation: this.automation.id,
                filter: this.filter.id
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
