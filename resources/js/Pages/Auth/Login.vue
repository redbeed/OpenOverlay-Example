<template>
    <Head title="Log in"/>

    <div class="bg-gray-50 min-h-screen">
        <nav class="z-10 inset-0 flex justify-center h-20 bg-white">
            <div class="flex items-center justify-center px-5 w-full max-w-nav">
                <jet-authentication-card-logo/>
            </div>
        </nav>

        <jet-authentication-card class="min-h-0 pt-0 sm:mt-10 bg-gray-50">
            <div class="mb-4">
                <p class="text-flamingo-800 font-bold">Sign In</p>
                <h2 class="text-xl font-bold">Start manage your Overlay</h2>
            </div>

            <jet-validation-errors class="mb-4"/>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="email" value="Email" class="hidden"/>
                    <jet-input id="email" placeholder="Email" type="email" class="mt-1 block w-full"
                               v-model="form.email" required autofocus/>
                </div>

                <div class="mt-4">
                    <jet-label for="password" value="Password" class="hidden"/>
                    <jet-input id="password" placeholder="Password" type="password" class="mt-1 block w-full" v-model="form.password" required
                               autocomplete="current-password"/>
                </div>

                <div class="block mt-4">
                    <jet-button class="w-full justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </jet-button>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <label class="flex items-center">
                        <jet-checkbox name="remember" v-model:checked="form.remember"/>
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    <Link v-if="canResetPassword" :href="route('password.request')"
                          class="underline text-sm text-gray-600 hover:text-gray-900 ml-4">
                        Forgot password?
                    </Link>
                </div>
            </form>
        </jet-authentication-card>
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import {Head, Link} from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ...data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    }
})
</script>
