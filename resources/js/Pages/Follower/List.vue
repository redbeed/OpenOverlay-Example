<template>
    <app-layout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="py-3 flex items-center justify-between ">
                <input
                    type="text" placeholder="Username.." v-model="usernameSearch"
                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">

                <div>
                    {{ this.followers }} Followers
                </div>
            </div>

            <vue-table-lite
                :is-slot-mode="true"
                :is-loading="isLoading"
                :columns="columns"
                :rows="rows"
                :total="followers"
                :page-size="perPage"
                @do-search="loadFollowers"
                @is-finished="isLoading = false"
            >
                <template v-slot:actions="data">
                    <jet-link :href="`https://twitch.tv/${data.value.follower_username}`" target="_blank">
                        Profile
                    </jet-link>
                </template>

                <template v-slot:followed_at="data">
                    {{ date(data.value.followed_at) }}
                </template>

                <template v-slot:followed_at_human="data">
                    {{ fromNow(data.value.followed_at) }}
                </template>
            </vue-table-lite>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Alert from "@/OpenOverlay/Alert";
import JetLabel from '@/Jetstream/Label';
import JetLink from "@/Jetstream/Link";
import JetFormSection from "@/Jetstream/FormSection";
import JetInputError from "@/Jetstream/InputError";
import moment from 'moment';
import TableStyling from "@/Pages/Follower/TableStyling";
import JetNavLink from '@/Jetstream/NavLink';
import debounce from "lodash/debounce"
import JetButton from "@/Jetstream/Button";
import JetDangerButton from "@/Jetstream/DangerButton";
import VueTableLite from 'vue3-table-lite';
import {defineComponent, reactive, ref} from "vue";

export default defineComponent({
    mounted() {
        this.loadFollowers(0, this.perPage, 'follower_username', 'asc');
    },

    props: {
        connections: {
            list: Object,
            selected: Number,
        },
    },

    setup() {
        const isLoading = ref(true);
        const perPage = ref(15);
        const followers = ref(0);
        const usernameSearch = ref('');
        const rows = ref([]);
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
                sortable: true
            },
            {
                field: 'followed_at_human',
                label: ''
            },
            {
                field: 'actions',
                label: '',
            }
        ]);

        return {
            isLoading, perPage, followers,
            usernameSearch, rows, columns,
        };
    },

    methods: {
        loadFollowers(offset, limit, sort, order) {
            this.isLoading = true;

            let url = route('followers.list', {
                connection: this.connections.selected,
                query: this.usernameSearch,
                per_page: limit,
                page: (1 + (offset / limit)),
                sort_by: sort,
                sort_order: order,
            });

            axios.get(url)
                .then((response) => {
                    this.rows = response.data.data;
                    this.followers = response.data.total;

                });
        },

        date(date) {
            return moment(date).format('MMMM Do YYYY, h:mm:ss a');
        },

        fromNow(date) {
            return moment(date).fromNow();
        },
    },

    filters: {
        date: function (date) {
            return moment(date).format('MMMM Do YYYY, h:mm:ss a');
        },

        fromNow: function (date) {
            return moment(date).fromNow();
        },
    },

    computed: {
        tableStyling() {
            return TableStyling;
        }
    },

    watch: {
        usernameSearch: debounce(function () {
            this.loadFollowers(
                0,
                this.perPage,
                'follower_username',
                'asc'
            );
        }, 350)
    },

    components: {
        Alert,
        AppLayout,
        JetLink,
        JetFormSection,
        JetLabel,
        JetInputError,
        VueTableLite,
        JetNavLink,
        JetButton,
        JetDangerButton,
    },
});
</script>
