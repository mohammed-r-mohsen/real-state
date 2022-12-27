<template>
    <div class="general-information" >
            <h4><i class="ri-advertisement-line"></i>{{trans('lang.ad_info')}}:</h4>
            <final-section :editMode="false" ad=""></final-section>
            
        </div>
        <!-- <div v-else>
            <loading :lines="4"></loading>
        </div> -->
</template>


<script>
import FinalSection from './FinalSection.vue';
import Loading from './Loading.vue';

export default {
  components: { FinalSection, Loading },
    mounted() {
         this.handle_routes()
    },
    data() {
        return {
            package_id: localStorage.getItem("package_id"),
            loading:false
        };
    },
    methods: {
        handle_routes(){
        this.loading=true
        
        let user =this.$root.user
                if(user.phone==null || user.whatsapp==null || user.state_id==null || user.city_id==null ){
                  this.$router.push('/add_advertisement/1')
                }else{
                    axios.defaults.headers.common["Authorization"]='Bearer '+ this.$root.token;
        axios.get('/api/check_user_package')
        .then((resp)=>{
            if(!resp.data){
                this.$router.push('/add_advertisement/2')
            }
            this.loading=false
                })
                }

        
        }
    },
}
</script>