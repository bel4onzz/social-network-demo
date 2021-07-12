<template>
    <div class="flex mt-5 sm:mt-0">
        <template v-if="friendRequestRecivedFrom">
            <accept :profile="profile"></accept>
            <ignore :profile="profile" class="ml-3"></ignore>
        </template>
        
        <template v-else-if="friendRequestSentTo">
            <h3 class="font-semibold text-md text-gray-800 leading-tight">Pending</h3>
        </template>

        <template v-else-if="isFriendsWith">
            <form @submit.prevent="deleteFriend">
                <jet-danger-button type="submit">
                    <semipolar-spinner
                        :animation-duration="1500"
                        :size="20"
                        class="text-whtie"
                        v-if="loading"
                    />
                    <template v-else>
                        Unfriend
                        <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>
                    </template>
                </jet-danger-button>
            </form>
        </template>
        
        <template v-else-if="$page.props.user.id != profile.id">
            <form @submit.prevent="addFriend">
                <blue-button type="submit">
                    <semipolar-spinner
                        :animation-duration="1500"
                        :size="20"
                        class="text-whtie"
                        v-if="loading"
                    />

                    <template v-else>
                        Add Friend
                        <icon name="user-plus" class="w-4 h-4 fill-current ml-1"></icon>
                    </template>
                </blue-button>
            </form>
        </template>
    </div>
</template>

<script>
import { SemipolarSpinner  } from 'epic-spinners'
import Accept from './Accept'
import Ignore from './Ignore'
import BlueButton from '@/Components/Buttons/BlueButton'
import JetDangerButton from '@/Jetstream/DangerButton'
export default {
    props:['profile', 'isFriendsWith', 'friendRequestSentTo', 'friendRequestRecivedFrom'],
    components:{
        SemipolarSpinner,
        Ignore,
        Accept,
        BlueButton,
        JetDangerButton
    },
    data(){
        return {
            addFriendForm: this.$inertia.form({
                user:this.profile
            }),
            deleteFriendForm: this.$inertia.form({
                user: this.profile
            }),
            loading: false,
        }
    },
    methods:{
        addFriend(){
            this.loading = true,
            this.addFriendForm.post(this.route('friends.store', this.profile.id),{
                preserveScroll: true,
                onSuccess:()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully Sent!'
                    });
                    this.loading = false;
                },
            })
        },

        deleteFriend(){
            this.loading = true,
            this.deleteFriendForm.delete(this.route('friends.destroy', this.profile.id),{
                preserveScroll: true,
                onSuccess:()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully Deleted!'
                    });
                    this.loading = false;
                },
            })
        }
    }
}
</script>