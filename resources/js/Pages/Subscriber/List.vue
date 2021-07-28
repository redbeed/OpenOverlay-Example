<template>
    <app-layout>
        <template #header>
            <div class="flex items-center mr-0 ml-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Subscriber
                </h2>
                <div class="flex items-center mr-0 ml-auto">

                    <a
                        v-for="connection in connections.list" :href="route('subscribers', {connection: connection.id})"
                        class="flex whitespace-no-wrap uppercase px-3 font-bold text-gray-600 ml-auto mr-3 hover:underline">
                        {{ connection.service_username }}
                    </a>
                </div>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="py-3 flex items-center justify-between ">
                <input
                    type="text" placeholder="Username.." v-model="usernameSearch"
                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">

                <div>
                    {{ this.subscribers }} Subscribers
                </div>
            </div>
            <vuetable
                ref="vuetable"
                :fields="fields"
                :css="tableStyling.table"
                :api-url="route('subscribers.list', {connection: connections.selected, query: this.usernameSearch})"
                :per-page="50"
                :first-page="1"
                data-path="data"
                pagination-path=""
                @vuetable:pagination-data="onPaginationData"
            >

                <div slot="actions" slot-scope="props">
                    <jet-link :href="`https://twitch.tv/${props.rowData.subscriber_username}`" target="_blank">
                        Profile
                    </jet-link>
                </div>

            </vuetable>

            <div class="py-3 flex items-center justify-between border-t border-gray-200">

                <div class="flex-1 flex items-center justify-between">
                    <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>

                    <vuetable-pagination
                        ref="pagination" :css="tableStyling.pagination"
                        @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
                </div>
            </div>
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
import Vuetable from 'vuetable-2';
import VuetablePagination from "vuetable-2/src/components/VuetablePagination";
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
import TableStyling from "@/Pages/Follower/TableStyling";
import JetNavLink from '@/Jetstream/NavLink';
import debounce from "@/debounce";
import JetButton from "@/Jetstream/Button";
import JetDangerButton from "@/Jetstream/DangerButton";

export default {
    name: "List",

    props: {
        connections: {
            list: Object,
            selected: Number,
        },
    },
    data() {
        return {
            subscribers: 0,
            usernameSearch: '',
            fields: [
                {
                    name: 'subscriber_username',
                    sortField: 'subscriber_username',
                    title: 'Username',
                    titleClass: 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
                    dataClass: 'px-6 py-4 whitespace-nowrap',
                },
                {
                    name: 'tier',
                    sortField: 'tier',
                    title: 'Tier',
                    titleClass: 'pl-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
                    dataClass: 'pl-6 py-4 whitespace-nowrap',
                    formatter(tier) {
                        return tier / 1000;
                    }
                },
                {
                    name: 'tier_name',
                    sortField: 'tier',
                    title: 'Tier Title',
                    titleClass: 'pl-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
                    dataClass: 'pl-6 py-4 whitespace-nowrap',
                },
                {
                    name: 'is_gift',
                    sortField: 'is_gift',
                    title: 'Gift',
                    titleClass: 'pl-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
                    dataClass: 'pl-6 py-4 whitespace-nowrap',
                    formatter(status) {
                        return status ? 'YES' : '';
                    }
                },
                {
                    name: 'actions',
                    title: '',
                }
            ],
        };
    },

    methods: {
        onPaginationData(paginationData) {
            this.$refs.pagination.setPaginationData(paginationData);
            this.$refs.paginationInfo.setPaginationData(paginationData);

            this.subscribers = paginationData.total;
        },

        onChangePage(page) {
            this.$refs.vuetable.changePage(page);
        }
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
        usernameSearch() {
            debounce(() => {
                this.$refs.vuetable.reload();
            }, 350);
        }
    },

    components: {
        Alert,
        AppLayout,
        JetLink,
        JetFormSection,
        JetLabel,
        JetInputError,
        Vuetable,
        VuetablePagination,
        VuetablePaginationInfo,
        JetNavLink,
        JetButton,
        JetDangerButton,
    },
}
</script>
