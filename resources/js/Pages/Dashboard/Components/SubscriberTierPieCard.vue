<template>
    <base-card class="min-h-[10rem]">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Subscriber Tiers</h2>
        </div>
        <ul class="shrink-0">
            <li
                v-for="item in this.formattedChartData"
                :key="item.value"
                class="text-xs leading-normal"
            >
                <span class="font-mono">{{ item.percent }}%</span>
                {{ item.name }} ({{ item.value }})
            </li>
        </ul>
        <div
            ref="chart"
            class="rounded-b-lg ct-chart mt-2"
        />
    </base-card>
</template>

<script>

import Chartist from 'chartist';
import 'chartist/dist/chartist.min.css';
import 'chartist-plugin-tooltips';
import 'chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css';
import BaseCard from "@/Pages/Components/BaseCard";

export default {
    name: "SubscriberTierPieCard",

    props: {
        chartData: {
            type: Object,
            default: {
                labels: [],
                series: [],
            },
        },
    },

    data() {
        return {
            chartist: null,
        }
    },

    mounted() {
        this.chartist = new Chartist.Pie(this.$refs.chart, this.chartData, {
            donut: true,
            donutWidth: 10,
            donutSolid: true,
            startAngle: 270,
            showLabel: false,
        });
    },

    computed: {
        total() {
            return this.chartData.series.reduce((acc, item) => acc + item.value, 0);
        },

        formattedChartData() {
            return this.chartData.series.map(item => {
                return {
                    name: item.name,
                    value: item.value,
                    percent: (item.value / this.total * 100).toLocaleString(undefined, {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                    }),
                }
            });
        },
    },

    components: {
        BaseCard,
    },
}
</script>
