<template>
    <app-layout title="Dashboard">
        <div class="max-w-7xl mx-auto">
            <div class="grid gird-cols-1 md:grid-cols-2 gap-4">
                <user-metrics-card
                    v-if="this.followChartData"
                    :chart-data="this.followChartData">
                    <template #title>Followers</template>
                    <template #description>metrics of last 30 day</template>
                </user-metrics-card>
                <user-metrics-card
                    v-if="this.subscriberChartData"
                    :chart-data="this.subscriberChartData">
                    <template #title>Subscriber</template>
                    <template #description>metrics of last 30 day</template>
                </user-metrics-card>
                <event-history-card :event-history="this.eventHistory"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import {Inertia} from "@inertiajs/inertia";
import UserMetricsCard from "@/Pages/Dashboard/Components/UserMetricsCard";
import EventHistoryCard from "@/Pages/Dashboard/Components/EventHistoryCard";

export default defineComponent({

    data() {
        return {
            followChartData: null,
            subscriberChartData: null,
            eventHistory: null,
            chartist: null,
        }
    },

    mounted() {
        Inertia.reload({
            only: ['followChartData', 'subscriberChartData', 'eventHistory'],
            onSuccess: page => {
                this.followChartData = page.props.followChartData;
                this.subscriberChartData = page.props.subscriberChartData;
                this.eventHistory = page.props.eventHistory;
            }
        });
    },

    components: {
        EventHistoryCard,
        UserMetricsCard,
        AppLayout,
    },
})
</script>
