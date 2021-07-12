<template>
    <form @submit.prevent="ignoreRequest">
        <jet-danger-button type="submit" class="text-xs">
            <semipolar-spinner
                :animation-duration="1500"
                :size="20"
                class="text-whtie"
                v-if="loading"
            />
            <template v-else>
                Ignore
                <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>
            </template>
        </jet-danger-button>
    </form>
</template>

<script>
import { SemipolarSpinner  } from 'epic-spinners'
import JetDangerButton from '@/Jetstream/DangerButton'
export default {
    props:['profile'],
    components:{
        SemipolarSpinner,
        JetDangerButton,
    },
    data(){
        return{
            ignoreFriendForm: this.$inertia.form({
                user:this.profile
            }),
            loading: false
        }
    },
    methods:{
        ignoreRequest(){
            console.log("IgnoreRequest");
            this.loading = true,
            this.ignoreFriendForm.get(this.route('friends.deny', this.profile.id), {
                onSuccess:()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully Ignored!'
                    });
                    this.loading = false;
                },
            });
        }
    }
}
</script>