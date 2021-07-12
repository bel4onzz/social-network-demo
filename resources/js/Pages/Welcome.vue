<template>
    <div style="background-color: rgb(255, 250, 255) !important" 
    class="relative flex items-top justify-left min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">
                Dashboard
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </inertia-link>

                <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </inertia-link>
            </template>
        </div>

        <div id='content_div_id'>
            <!-- This is an example component -->
            <div class="min-h-screen bg-white">
                <nav class="h-screen flex flex-col w-64 bg-purple-50">
                    <div class="p-4">
                        <img src="https://tailwindcomponents.com/svg/logo-color.svg" />
                    </div>
                    <ul class="p-2 space-y-2 flex-1 overflow-auto" style="scrollbar-width: thin;">

                        <div v-if="canLogin" class="flex justify-senter space-x-6 mt-5">
                            <inertia-link href="#" v-if="$page.props.user">
                                    Dashboard
                            </inertia-link>

                            <template v-else>
                                <inertia-link :href="route('login')" 
                                    class="
                                        bg-purple-50 w-full hover:bg-hoverloginbutton hover:text-white
                                        flex space-x-2 items-center text-gray-600 p-2 bg-gray-200 rounded-lg
                                    "
                                >
                                    LogIn
                                </inertia-link>
                                <inertia-link v-if="canRegister" :href="route('register')"
                                    class="
                                        bg-purple-50 w-full hover:bg-hoverloginbutton hover:text-white
                                        flex space-x-2 items-center text-gray-600 p-2 bg-gray-200 rounded-lg
                                    "
                                >
                                    Register
                                </inertia-link>
                            </template>
                        </div>

                        <p class="mt-10 text-center"> {{ users_count }} Active Users</p>

                        <li>
                            <a href="#" class="flex space-x-2 items-center text-gray-600 p-2 bg-gray-200 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 fill-current" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7.093v-5.093h-3v2.093l3 3zm4 5.907l-12-12-12 12h3v10h7v-5h4v5h7v-10h3zm-5 8h-3v-5h-8v5h-3v-10.26l7-6.912 7 6.99v10.182z"/></svg>
                                <span class="text-gray-900">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex space-x-2 items-center text-gray-600 p-2 hover:bg-gray-200 rounded-lg hover:text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 fill-current" width="24" height="24" viewBox="0 0 24 24"><path d="M17.997 18h-.998c0-1.552.06-1.775-.88-1.993-1.438-.332-2.797-.645-3.293-1.729-.18-.396-.301-1.048.155-1.907 1.021-1.929 1.277-3.583.702-4.538-.672-1.115-2.707-1.12-3.385.017-.576.968-.316 2.613.713 4.512.465.856.348 1.51.168 1.908-.49 1.089-1.836 1.4-3.262 1.728-.982.227-.92.435-.92 2.002h-.995l-.002-.623c0-1.259.1-1.985 1.588-2.329 1.682-.389 3.344-.736 2.545-2.209-2.366-4.365-.676-6.839 1.865-6.839 2.492 0 4.227 2.383 1.867 6.839-.775 1.464.824 1.812 2.545 2.209 1.49.344 1.589 1.072 1.589 2.333l-.002.619zm4.81-2.214c-1.289-.298-2.489-.559-1.908-1.657 1.77-3.342.47-5.129-1.4-5.129-1.265 0-2.248.817-2.248 2.325 0 1.269.574 2.175.904 2.925h1.048c-.17-.75-1.466-2.562-.766-3.736.412-.692 1.704-.693 2.114-.012.38.631.181 1.812-.534 3.161-.388.733-.28 1.301-.121 1.648.305.666.977.987 1.737 1.208 1.507.441 1.368.042 1.368 1.48h.997l.002-.463c0-.945-.074-1.492-1.193-1.75zm-22.805 2.214h.997c0-1.438-.139-1.039 1.368-1.48.761-.221 1.433-.542 1.737-1.208.159-.348.267-.915-.121-1.648-.715-1.349-.914-2.53-.534-3.161.41-.682 1.702-.681 2.114.012.7 1.175-.596 2.986-.766 3.736h1.048c.33-.75.904-1.656.904-2.925.001-1.509-.982-2.326-2.247-2.326-1.87 0-3.17 1.787-1.4 5.129.581 1.099-.619 1.359-1.908 1.657-1.12.258-1.194.805-1.194 1.751l.002.463z"/></svg>
                                <span>Teams</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex space-x-2 items-center text-gray-600 p-2 hover:bg-gray-200 rounded-lg hover:text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 fill-current" width="24" height="24" viewBox="0 0 24 24"><path d="M10 15v-10h-5.033c-2.743 0-4.967 2.239-4.967 5 0 2.762 2.224 5 4.967 5h5.033zm-8-5c0-1.654 1.331-3 2.967-3h3.033v6h-3.033c-1.636 0-2.967-1.346-2.967-3zm22-10v20c-4.839-3.008-8.836-4.491-12-5v-2.014c3.042.438 6.393 1.624 10 3.548v-13.064c-3.622 1.941-6.912 3.099-10 3.544v-2.014c3.124-.498 7.036-1.915 12-5zm-11.993 22.475c-.52-.424-.902-.994-1.095-1.637l-1.151-3.827h-6.146l1.905 5.883c.214.659.828 1.106 1.522 1.106h4.46c.358 0 .677-.225.797-.562.12-.337.015-.713-.263-.939l-.029-.024zm-4.674-.475l-.982-3h1.933l.927 3h-1.878z"/></svg>
                                <span>Announcements</span>
                            </a>
                        </li>
                    </ul>
                    
                    <div class="p-2 flex items-center border-t-2 border-gray-300 space-x-4">
                        <div class="relative inline-flex">
                            <span class="inline-flex bg-red-500 w-2 h-2 absolute right-0 bottom-0 rounded-full ring-2 ring-white transform translate-x-1/3 translate-y-1/3"></span>
                            <img class='w-8 h-8 object-cover rounded-full' alt='User avatar' src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=200' />
                        </div>
                        <div>
                            <h3 class="font-semibold tracking-wide text-gray-800">
                                Danimai
                            </h3>
                            <p class="text-sm text-gray-700">
                                view profile
                            </p>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            users_count: Number,
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>
