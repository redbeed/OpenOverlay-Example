<template>
    <app-layout>
        <div v-if="$page.message" class="container mx-auto max-w-7xl mx-auto sm:px-6 lg:px-8 my-12">
            <alert :title="$page.message" color="purple"></alert>
        </div>

        <div class="container mx-auto max-w-7xl mx-auto">
            <div class="grid gap-4 md:gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                <bot-card v-for="bot in this.availableBots" :active="userConnectedBots.includes(bot.id)" :bot="bot"/>

                <base-card class="bg-flamingo">
                    <a class="fa-solid fa-plug-circle-plus text-7xl text-flamingo-200 mb-6"
                       :href="route('open_overlay.connection.bot.redirect')" target="_blank"></a>
                    <div class="flex flex-col">
                        <a class="text-xl font-bold text-white"
                           :href="route('open_overlay.connection.bot.redirect')" target="_blank">
                            Add a new Bot
                        </a>
                        <p class="text-flamingo-200 mb-1">Make sure you you login into your Bot account on twitch.</p>
                        <a class="block text-flamingo-300 text-sm underline ml-auto mr-0"
                           href="https://www.openoverlay.dev/docs/bot/add_a_bot" target="_blank">Need help?</a>
                    </div>
                </base-card>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Alert from "@/OpenOverlay/Alert";
import JetLabel from '@/Jetstream/Label';
import JetButton from '@/Jetstream/Button';
import BotCard from "@/Pages/Bot/Components/BotCard";
import BaseCard from "@/Pages/Components/BaseCard";

export default {
    name: "BotList",
    props: {
        availableBots: Array,
        userConnectedBots: Array,
        message: String,
    },

    components: {
        BaseCard,
        BotCard,
        Alert,
        AppLayout,
        JetLabel,
        JetButton,
    },
}
</script>
