<template>
    <app-layout>
        <div v-if="$page.message" class="container mx-auto max-w-7xl mx-auto sm:px-6 lg:px-8 my-12">
            <alert :title="$page.message" color="purple"></alert>
        </div>

        <div class="container mx-auto max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex w-full justify-end align-items-end">
                <jet-button-link href="https://www.openoverlay.dev/docs/bot/add_chat_schedule"
                                 target="_blank" class="mr-5">
                    Add Schedule Message
                </jet-button-link>

                <jet-button-link :href="route('bot.chat-command')">
                    Commands
                </jet-button-link>
            </div>

            <div v-for="bot in this.availableBots" class="mt-10">
                <alert :title="bot.bot_username" color="white" class="shadow">

                    <template v-slot:description>
                        <jet-label value="Bot Username"/>
                    </template>

                    <div class="flex items-center mr-0 ml-auto">
                        <a v-if="!userConnectedBots.includes(bot.id)" :href="route('bots.add-to-chat', {botId: bot.id})"
                           class="flex rounded-full bg-purple-500 border-purple-500 text-white border-2 uppercase px-3 py-2 font-bold ml-auto mr-3">
                            Add to my Chat
                        </a>
                        <a v-else :href="route('bots.remove-from-chat', {botId: bot.id})"
                           class="flex rounded-full bg-purple-500 border-purple-500 text-white border-2 uppercase px-3 py-2 font-bold ml-auto mr-3">
                            Remove from Chat
                        </a>
                        <div class="flex items-center mr-0 ml-auto">
                            <a :href="route('open_overlay.connection.bot.redirect')" target="_blank"
                               class="flex rounded-full bg-transparent border-purple-500 whitespace-no-wrap border-2 uppercase px-3 py-2 font-bold ml-auto mr-0">
                                Reconnect
                            </a>
                        </div>
                    </div>
                </alert>
            </div>
        </div>

        <div class="container mx-auto max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-12">
                <alert title="Add a new Bot" color="gray" class="shadow-xl">

                    <template v-slot:description>
                        Make sure you you login into your Bot account on twitch.
                    </template>

                    <div class="flex items-center mr-0 ml-auto">
                        <a :href="route('open_overlay.connection.bot.redirect')" target="_blank"
                           class="flex rounded-full bg-purple-500 border-purple-500 text-white border-2 uppercase px-3 py-2 font-bold ml-auto mr-3">
                            Add Bot
                        </a>
                        <div class="flex items-center mr-0 ml-auto">
                            <a href="https://www.openoverlay.dev/docs/bot/add_a_bot" target="_blank"
                               class="flex rounded-full bg-transparent border-purple-500 whitespace-no-wrap border-2 uppercase px-3 py-2 font-bold ml-auto mr-0">
                                How to
                            </a>
                        </div>
                    </div>
                </alert>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Alert from "@/OpenOverlay/Alert";
import JetLabel from '@/Jetstream/Label';
import JetButton from '@/Jetstream/Button';
import JetButtonLink from '@/Jetstream/ButtonLink'

export default {
    name: "BotList",
    props: {
        availableBots: Array,
        userConnectedBots: Array,
        message: String,
    },

    components: {
        Alert,
        AppLayout,
        JetLabel,
        JetButton,
        JetButtonLink,
    },
}
</script>
