<template>
    <card class="min-h-[10rem] md:col-span-2">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold"><slot name="title"/></h2>
                <p class="text-flamingo-800 font-bold"><slot name="description"/></p>
            </div>
            <div class="text-3xl text-flamingo-800 font-bold">
                {{ this.maxFollow }}
            </div>
        </div>
        <div
            ref="chart"
            class="absolute inset-0 rounded-b-lg ct-chart top-[40%]"
        />
    </card>
</template>

<script>

import Card from "@/Pages/Dashboard/Components/Card";

import Chartist from 'chartist';
import 'chartist/dist/chartist.min.css';
import 'chartist-plugin-tooltips';
import 'chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css';

export default {
    name: "UserMetricsCard",

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
            maxFollow: 0,
        }
    },

    mounted() {
        this.maxFollow = Math.max(...this.chartData.series[0]);
        const low = Math.min(...this.chartData.series[0]);

        this.chartist = new Chartist.Line(this.$refs.chart, this.chartData, {
            lineSmooth: Chartist.Interpolation.none(),
            fullWidth: true,
            showPoint: true,
            showLine: true,
            showArea: true,
            chartPadding: {
                top: 10,
                right: 0,
                bottom: 0,
                left: 0,
            },
            low: low,
            high: this.maxFollow,
            areaBase: 0,
            axisX: {
                showGrid: false,
                showLabel: true,
                offset: 0,
            },
            axisY: {
                showGrid: true,
                showLabel: true,
                offset: 0,
            },
            plugins: [
                Chartist.plugins.tooltip({
                    anchorToPoint: true,
                }),
            ]
        });
    },

    components: {
        Card,
    },
}
</script>
