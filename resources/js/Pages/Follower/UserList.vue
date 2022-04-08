<template>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="py-3 flex items-center justify-between ">
            <div class="w-1/2 max-w-xs">
                <jet-input v-model="usernameSearch" placeholder="Username.." background-color="bg-white"></jet-input>
            </div>

            <div>
                <slot name="title">{{ this.users }} {{ this.title }}</slot>
            </div>
        </div>

        <div class="vue-table-lite">
            <vue-table-lite
                :is-slot-mode="true"
                :is-loading="isLoading"
                :columns="columns"
                :rows="rows"
                :total="users"
                :page-size="perPage"
                @do-search="loadFollowers"
                @is-finished="isLoading = false"
            >
                <template v-for="column in overwriteColumns" v-slot:[column]="data">
                    <slot :name="column" :value="data.value"></slot>
                </template>

            </vue-table-lite>
        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Alert from "@/OpenOverlay/Alert";
import JetLabel from '@/Jetstream/Label';
import JetLink from "@/Jetstream/Link";
import JetFormSection from "@/Jetstream/FormSection";
import JetInputError from "@/Jetstream/InputError";
import JetNavLink from '@/Jetstream/NavLink';
import debounce from "lodash/debounce"
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetDangerButton from "@/Jetstream/DangerButton";
import VueTableLite from 'vue3-table-lite';
import {defineComponent, reactive, ref} from "vue";

export default defineComponent({
    mounted() {
        this.loadFollowers(0, this.perPage, this.defaultSortField, 'asc');
    },

    props: {
        title: {
            type: String,
            default: 'Followers'
        },
        userListUrl: {
            type: String,
            default: 'followers.list',
        },
        defaultSortField: {
            type: String,
            default: 'follower_username',
        },
        connections: {
            list: Object,
            selected: Number,
        },
        columns: {
            type: Object,
            default: {},
        },
    },

    setup() {
        const isLoading = ref(true);
        const perPage = ref(15);
        const users = ref(0);
        const usernameSearch = ref('');
        const rows = ref([]);

        return {
            isLoading, perPage, users,
            usernameSearch, rows,
        };
    },

    methods: {
        loadFollowers(offset, limit, sort, order) {
            this.isLoading = true;

            let url = route(this.userListUrl, {
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
                    this.users = response.data.total;

                });
        },
    },

    computed: {
        overwriteColumns() {
            const columns = [];

            for(let columnIndex in this.columns) {
                if(this.columns[columnIndex].overwrite) {
                    columns.push(this.columns[columnIndex].field);
                }
            }

            return columns;
        },
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
        JetInput,
    },
});
</script>
