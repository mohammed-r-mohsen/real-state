<template>
    <user-info :is_provider="true" :after_update="'/add_advertisement/2'"></user-info>
</template>


<script>
import UserInfo from './UserInfo.vue'
export default {
  components: { UserInfo },
    mounted() {
     this.handle_routes()
    },
    data(){
            return {
                
           
            }
        },
        methods:{
        handle_routes(){
          let user =this.$root.user
                if(user.phone!=null && user.whatsapp!=null && user.state_id!=null && user.city_id!=null ){
                  this.$router.push('/add_advertisement/2')
                }
        

        }
    }
}
</script>