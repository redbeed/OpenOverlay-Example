<template>
    <div class="container mx-auto max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-12">
            <alert v-if="this.twitchAvailable === false" title="Twitch Settings missing.">
                <template v-slot:description>
                    Please add <span class="font-mono">TWITCH_CLIENT_ID</span> and <span class="font-mono">TWITCH_CLIENT_SECRET</span>
                    to your <span class="font-mono">.env</span> file.
                </template>

                <a href="https://www.openoverlay.dev/docs/add_twitch_api" target="_blank"
                   class="flex rounded-full bg-tomato-500 uppercase px-3 py-2 font-bold ml-auto mr-0">
                    How to add
                </a>
            </alert>

            <alert v-if="this.appTokenAvailable === false" title="App Token missing.">
                <template v-slot:description>
                    Please add <span class="font-mono">OVERLAY_TWITCH_APP_TOKEN</span> to your <span
                    class="font-mono">.env</span> file.
                </template>

                <a href="https://www.openoverlay.dev/docs/generate_app_token" target="_blank"
                   class="flex rounded-full bg-tomato-500 uppercase px-3 py-2 font-bold ml-auto mr-0">
                    How to add
                </a>
            </alert>

            <div v-if="this.appTokenAvailable === true && this.twitchAvailable === true" class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                <alert v-if="this.twitchUserConnected === false" title="Connect your twitch account" color="purple">
                    <div class="flex items-center mr-0 ml-auto">
                        <a :href="route('open_overlay.connection.redirect')" target="_blank"
                           class="flex rounded-full bg-purple-500 border-purple-500 whitespace-no-wrap border-2 uppercase px-3 py-2 font-bold ml-auto mr-3">
                            Connect
                        </a>
                        <a href="https://www.openoverlay.dev/docs/connect_to_twitch" target="_blank"
                           class="flex rounded-full bg-transparent border-purple-500 whitespace-no-wrap border-2 uppercase px-3 py-2 font-bold ml-auto mr-0">
                            More information
                        </a>
                    </div>
                </alert>

                <alert v-if="this.botConnected === false" title="Add a Bot" color="gray">
                    <div class="flex items-center mr-0 ml-auto">
                        <a :href="route('open_overlay.connection.bot.redirect')" target="_blank"
                           class="flex rounded-full bg-purple-500 border-purple-500 whitespace-no-wrap border-2 uppercase px-3 py-2 font-bold ml-auto mr-3">
                            Connect
                        </a>
                        <a href="https://www.openoverlay.dev/docs/bot/add_a_bot" target="_blank"
                           class="flex rounded-full bg-transparent border-purple-500 whitespace-no-wrap border-2 uppercase px-3 py-2 font-bold ml-auto mr-0">
                            More information
                        </a>
                    </div>
                </alert>

                <alert v-else-if="this.botUserLinked === false" title="Link a bot to your account" color="gray">

                    <template v-slot:description>
                        You need to connect a bot to your account and restart the bot container.
                    </template>

                    <div class="flex items-center mr-0 ml-auto">
                        <a href="https://www.openoverlay.dev/docs/bot/add_a_bot" target="_blank"
                           class="flex rounded-full bg-transparent border-purple-500 whitespace-no-wrap border-2 uppercase px-3 py-2 font-bold ml-auto mr-0">
                            How to
                        </a>
                    </div>
                </alert>
            </div>
        </div>
    </div>
</template>

<script>

import Alert from "@/OpenOverlay/Alert";

export default {
    props: {
        twitchAvailable: {
            type: Boolean,
            default: true,
        },
        appTokenAvailable: {
            type: Boolean,
            default: true,
        },
        twitchUserConnected: {
            type: Boolean,
            default: true,
        },
        botConnected: {
            type: Boolean,
            default: true,
        },
        botUserLinked: {
            type: Boolean,
            default: true,
        },
    },

    components: {
        Alert
    },
}
</script>
