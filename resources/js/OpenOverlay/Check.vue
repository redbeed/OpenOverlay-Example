<template>
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
                Please add <span class="font-mono">OVERLAY_TWITCH_APP_TOKEN</span> to your <span class="font-mono">.env</span> file.
            </template>

            <a href="https://www.openoverlay.dev/docs/generate_app_token" target="_blank"
               class="flex rounded-full bg-tomato-500 uppercase px-3 py-2 font-bold ml-auto mr-0">
                How to add
            </a>
        </alert>
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
        }
    },

    components: {
        Alert
    },
}
</script>
