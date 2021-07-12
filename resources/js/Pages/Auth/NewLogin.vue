<template>
<!-- component -->
<body>
    <section class="min-h-screen flex items-stretch text-white ">
            <div class="w-full z-20">
                <new-welcome>
                    <jet-authentication-card-new>
                    <template #logo>
                        <!-- <inertia-link :href="route('welcome')">
                            <img :src="'storage/images/logo.png'" alt="LogoImage">
                        </inertia-link> -->
                        <!-- <jet-authentication-card-logo /> -->
                    </template>

                    <jet-validation-errors class="mb-4" />

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                        {{ status }}
                    </div>


                    <form @submit.prevent="submit" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                        <div class="pb-2 pt-4">
                            <jet-input id="email" type="email" class="block w-full p-4 text-lg rounded-sm bg-black" v-model="form.email" required autofocus />
                        </div>
                        <div class="pb-2 pt-4">
                            <jet-input id="password" type="password" class="block w-full p-4 text-lg rounded-sm bg-black" v-model="form.password" required autocomplete="current-password" />
                        </div>
                        <div class="pb-2 pt-4">
                            <label class="flex items-center">
                                <jet-checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ml-2 text-sm text-white-600">Remember me</span>
                            </label>
                        </div>
                        <div class="px-4 pb-2 pt-4">
                            <inertia-link v-if="canResetPassword" :href="route('password.request')">
                                Forgot your password?
                            </inertia-link>
                        </div>
                        <div class="px-4 pb-2 pt-4">
                            <inertia-link :href="route('register')">
                                Register
                            </inertia-link>
                        </div>
                        <div class="px-4 pb-2 pt-4">
                            <button class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">sign in</button>
                        </div>
                    </form>
                    </jet-authentication-card-new>
                </new-welcome>
            </div>

    </section>
</body>
</template>

<script>
    import NewWelocome from '@/Pages/NewWelcome'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardNew from '@/Jetstream/AuthenticationCardNew'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
import NewWelcome from '../NewWelcome.vue'

    export default {
        components: {
            NewWelcome,
            JetAuthenticationCard,
            JetAuthenticationCardNew,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
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
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
