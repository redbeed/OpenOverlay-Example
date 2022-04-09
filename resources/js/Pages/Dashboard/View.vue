<template>
    <app-layout title="Dashboard">
        <div class="max-w-7xl mx-auto">
            <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <user-metrics-card
                    v-if="this.followChartData"
                    :chart-data="this.followChartData">
                    <template #title>
                        <Link :href="route('followers')">Followers</Link>
                    </template>
                    <template #description>metrics of last 30 day</template>
                </user-metrics-card>
                <user-metrics-card
                    v-if="this.subscriberChartData"
                    :chart-data="this.subscriberChartData">
                    <template #title>
                        <Link :href="route('subscribers')">Subscriber</Link>
                    </template>
                    <template #description>metrics of last 30 day</template>
                </user-metrics-card>
                <event-history-card :event-history="this.eventHistory"/>
                <subscriber-tier-pie-card
                    v-if="this.subscriberTierChartData" :chart-data="this.subscriberTierChartData"/>
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
import {Link} from '@inertiajs/inertia-vue3'
import SubscriberTierPieCard from "@/Pages/Dashboard/Components/SubscriberTierPieCard";

export default defineComponent({

    data() {
        return {
            followChartData: null,
            subscriberChartData: null,
            subscriberTierChartData: null,
            eventHistory: null,
            chartist: null,
        }
    },

    mounted() {
        Inertia.reload({
            only: ['followChartData', 'subscriberChartData', 'eventHistory', 'subscriberTierChartData'],
            onSuccess: page => {
                this.followChartData = page.props.followChartData;
                this.subscriberChartData = page.props.subscriberChartData;
                this.eventHistory = page.props.eventHistory;
                this.subscriberTierChartData = page.props.subscriberTierChartData;
            }
        });
    },

    components: {
        SubscriberTierPieCard,
        Link,
        EventHistoryCard,
        UserMetricsCard,
        AppLayout,
    },
})
</script>
