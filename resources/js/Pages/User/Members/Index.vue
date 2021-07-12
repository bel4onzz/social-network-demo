<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <inertia-link :href="route('members.index')" class="capitalize underline">
                        Members
                    </inertia-link>
                </h2>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    Visit your
                    <inertia-link href="#" class="undeline hover:text-green-500">
                        friends
                    </inertia-link>
                </span>
            </div>

            <div class="sm:flex sm:flex-wrap">
                <inertia-link :href="route('profiles.show', member.username)" 
                    class="sm:w-1/2"
                    v-for="(member, index) in members" :key="index"
                >
                    <div class="flex items-center bg-gray-50 px-2 py-3 border-l border-gray-500 mt-5 hover:bg-gray-400 hover:text-blue-800">
                        <div class="flex flex-shrink-0">
                            <img :src="member.profile_photo_url" :alt="member.username" 
                                class="h-8 w-8 rounded-full object-cover"
                            >
                        </div>
                        <div class="flex flex-grow overflow-hidden">
                            <span class="text-lg ml-3">
                                {{member.username}}
                            </span>
                        </div>
                    </div>
                </inertia-link>
            </div>
        </template>

        <user-block :items= "members"></user-block>
    </pages-layout>
</template>

<script>
import PagesLayout from '@/Layouts/PagesLayout'
import UserBlock from '@/Components/UserBlock.vue'
export default {
    props:['members'],
    components:{
        PagesLayout,
        UserBlock,
    }
}
</script>