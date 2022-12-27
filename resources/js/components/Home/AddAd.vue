<template>
  
        <div class="home-parent">

      


        <!-- property-page-section -->
        <section class="myprofile-section sec-pad">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'add_ad'"></sidebar>
                    <div class="col-md-9  col-sm-12 content-side">
                        <div class="tabs-box" v-if="!$root.loading">
                            <ad-nav></ad-nav>
                    <div class="tabs-content">
                        <div class="" v-if="this.$route.params.step==1">
                        <ad-step-1></ad-step-1>
                        </div>
                        <div class=""  v-if="this.$route.params.step==2">
                            <ad-step2></ad-step2>
                        </div>
                        <div class=""  v-if="this.$route.params.step==3">
                            <ad-step-3></ad-step-3>
                        </div>
                        <div class=""  v-if="this.$route.params.step==4">
                           <ad-step-4></ad-step-4>
                        </div>
                        
                    </div>
                </div>
                        <div v-else>
                            <loading :lines="6"></loading>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>
import AdNav from './Elements/AdNav.vue';
import AdStep1 from './Elements/AdStep1.vue';
import AdStep2 from './Elements/AdStep2.vue';
import AdStep3 from './Elements/AdStep3.vue';
import AdStep4 from './Elements/AdStep4.vue';


    export default {
  components: { AdNav, AdStep1, AdStep2, AdStep3, AdStep4 },
        mounted(){
            this.$root.loading=true
            if(this.$route.params.step >=1 && this.$route.params.step <5){
                // this.handle_routes()
            axios.defaults.headers.common["Authorization"]='Bearer '+ this.$root.token;
            axios.get('/api/user')
            .then((resp)=>{
                this.$root.user=resp.data 
                this.$root.loading=false
             }).catch(()=>{
                    localStorage.removeItem("token");
                    this.$router.push('/login')
             })
             // vue js code
             
            }else{
                this.$router.push('/home')
            }
        },
        data(){
            return {
               step1:false,
               step2:false,
               step3:false,
               step4:false,
               package_id:''
            }
        },
        
        methods:{
            handle_routes(){
                if(this.$route.params.step==1){
                    if(this.check_user_info()){
                        this.$router.push('/add_advertisement/2')
                    }
                }else if(this.$route.params.step==2 || this.$route.params.step==3){
                    if(this.check_user_package()){
                        this.$router.push('/add_advertisement/4')
                    }
                }
            },
            check_user_info(){
                let user =this.$root.user
                if(user.whatsapp!='' && user.state_id!='' && user.city_id!='' ){
                    return true
                }else{
                    return false
                }
            },
            check_user_package(){
            axios.defaults.headers.common["Authorization"]='Bearer '+ this.$root.token;
            axios.post('/api/check_user_package')
                     .then((resp)=>{
                        return resp.data
                     })
            },

        }
    }
</script>