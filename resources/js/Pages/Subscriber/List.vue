<template>
    <app-layout>
        <user-list title="Subscribers"
                   user-list-url="subscribers.list" default-sort-field="subscriber_username"
                   :columns="columns" :connections="this.connections">
            <template v-slot:actions="data">
                <jet-link :href="`https://twitch.tv/${data.value.subscriber_username}`" target="_blank">
                    Profile
                </jet-link>
            </template>

            <template v-slot:tier="data">
                {{ data.value.tier_name }} ({{ data.value.tier }})
            </template>
        </user-list>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import UserList from "@/Pages/Follower/UserList";
import JetLink from "@/Jetstream/Link";
import {defineComponent, reactive} from "vue";

export default defineComponent({

    props: {
        connections: {
            list: Object,
            selected: Number,
        },
    },

    setup() {
        const columns = reactive([
            {
                field: 'subscriber_username',
                label: 'Username',
                sortable: true,
            },
            {
                field: 'gifter_username',
                label: 'Gifted By',
                sortable: true
            },
            {
                field: 'tier',
                label: 'Tier',
                sortable: true,
                overwrite: true,
            },
            {
                field: 'actions',
                label: '',
                overwrite: true,
            }
        ]);

        return {columns};
    },

    components: {AppLayout, UserList, JetLink}
});
</script>
