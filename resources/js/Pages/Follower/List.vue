<template>
    <app-layout>
        <user-list title="Followers" :columns="this.columns" :connections="this.connections">
            <template v-slot:action="data">
                <jet-link :href="`https://twitch.tv/${data.value.follower_username}`" target="_blank">
                    Profile
                </jet-link>
            </template>

            <template v-slot:followed_at="data">
                {{ date(data.value.followed_at) }}
            </template>

            <template v-slot:followed_at_human="data">
                {{ date(data.value.followed_at) }}
            </template>

            <template v-slot:actions="data">
                <jet-link :href="`https://twitch.tv/${data.value.follower_username}`" target="_blank">
                    Profile
                </jet-link>
            </template>
        </user-list>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import UserList from "@/Pages/Follower/UserList";
import JetLink from "@/Jetstream/Link";
import {defineComponent, reactive} from "vue";
import moment from "moment";

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
                field: 'follower_username',
                sortField: 'follower_username',
                label: 'Username',
                sortable: true,
            },
            {
                field: 'followed_at',
                sortField: 'followed_at',
                label: 'Follower since',
                sortable: true,
                overwrite: true,
            },
            {
                field: 'followed_at_human',
                label: '',
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

    methods: {
        date(date) {
            return moment(date).format('MMMM Do YYYY, h:mm:ss a');
        },

        fromNow(date) {
            return moment(date).fromNow();
        },
    },

    components: {AppLayout, UserList, JetLink}
});
</script>
