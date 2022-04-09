<template>
    <card class="md:col-span-2 lg:col-span-3  max-h-[20rem] flex flex-col" padding="p-0">
        <div class="flex justify-between items-center px-6 py-4">
            <div>
                <h2 class="text-xl font-bold">Event History</h2>
                <p class="text-flamingo-800 font-bold">What happened lately?</p>
            </div>
        </div>

        <div class="h-full overflow-y-scroll grid gird-cols-1 gap-1 rounded-b-lg">
            <div
                v-for="(event, index) in this.eventHistory"
                class="px-6 py-1" :class="{'bg-gray-100': index%2 === 0}"
                v-html="event.description"/>
        </div>
    </card>
</template>

<script>
import Card from "@/Pages/Dashboard/Components/Card";

export default {
    name: "EventHistoryCard",

    props: {
        eventHistory: {
            type: Array,
            default: []
        }
    },

    components: {Card}
}
</script>

<style scoped>

</style>
