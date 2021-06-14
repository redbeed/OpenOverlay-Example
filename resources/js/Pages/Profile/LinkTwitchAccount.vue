<template>
    <jet-form-section>
        <template #title>
            Link with Twitch
        </template>

        <template #description>
            Update and refresh you connection with twitch
        </template>

        <template #form>

            <template v-if="$page.twitchUser">
                <!-- Username -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label value="Twitch Username"/>
                    {{ $page.twitchUser.service_username }}
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <jet-label value="Twitch User ID"/>
                    {{ $page.twitchUser.service_user_id }}
                </div>
            </template>
            <template v-else>
                <div class="col-span-6 sm:col-span-4">
                    <jet-input-error message="Twitch not connected"/>
                </div>
            </template>

        </template>

        <template #actions>
            <jet-link :href="route('open_overlay.connection.redirect')">
                Link account with Twitch
            </jet-link>
        </template>
    </jet-form-section>
</template>

<script>
import JetLink from '@/Jetstream/Link'
import JetFormSection from '@/Jetstream/FormSection'
import JetLabel from '@/Jetstream/Label'
import JetInputError from '@/Jetstream/InputError'

export default {

    components: {
        JetLink,
        JetFormSection,
        JetLabel,
        JetInputError
    }
}
</script>
