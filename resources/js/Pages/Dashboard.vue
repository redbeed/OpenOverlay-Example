<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <open-overlay-check :twitch-available="this.twitchAvailable" :app-token-available="this.appTokenAvailable" />

        <div class="my-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import OpenOverlayCheck from '@/OpenOverlay/Check';

    export default {
        props: {
            twitchAvailable: Boolean,
            appTokenAvailable: Boolean,
        },

        components: {
            AppLayout,
            Welcome,
            OpenOverlayCheck,
        },
    }
</script>
