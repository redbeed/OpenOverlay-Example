<template>
    <base-card class="flex flex-col justify-between">
        <div class="text-xl font-bold text-flamingo">{{ this.bot.bot_username }}</div>
        <div class="flex flex-col gap-2 items-center">

            <a v-if="!this.active" :href="route('bots.add-to-chat', {botId: bot.id})"
               class="bg-flamingo text-white px-4 py-2 rounded-lg w-full text-center">
                <i class="fa-solid fa-plug mr-1"></i>Add to my Chat
            </a>
            <a v-else :href="route('bots.remove-from-chat', {botId: bot.id})"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg w-full text-center">
                <i class="fa-solid fa-volume-xmark mr-1"></i>Mute
            </a>

            <a :href="route('open_overlay.connection.bot.redirect')" target="_blank"
               class="text-sm underline text-gray-500">
                Reconnect bot
            </a>
        </div>
    </base-card>
</template>

<script>
import BaseCard from "@/Pages/Components/BaseCard";

export default {
    name: "BotCard",

    props: {
        bot: Object,
        active: {
            type: Boolean,
            default: true,
        },
    },

    components: {BaseCard},
}
</script>
