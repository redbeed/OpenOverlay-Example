<template>
    <div class="my-12">
        <alert v-if="this.twitchAvailable === false" title="Twitch Settings missing.">
            <template v-slot:description>
                Please ass <span class="font-mono">TWITCH_CLIENT_ID</span> and <span class="font-mono">TWITCH_CLIENT_SECRET</span>
                to your <span class="font-mono">.env</span> file.
            </template>

            <button class="flex rounded-full bg-tomato-500 uppercase px-3 py-2 font-bold ml-auto mr-0">
                How to add
            </button>
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
        }
    },

    components: {
        Alert
    },
}
</script>
