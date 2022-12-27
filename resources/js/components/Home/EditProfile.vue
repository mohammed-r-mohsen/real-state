<template>
  
        <div class="home-parent">

      


        <!-- property-page-section -->
        <section class="property-page-section property-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'account'"></sidebar>
                        <div class="col-md-9  col-sm-12 content-side">
                    <user-info :after_update="'/home'"></user-info>
                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>
import UserInfo from './Elements/UserInfo.vue';

    export default {
  components: { UserInfo },
        mounted(){
            
            this.$root.loading=true
            axios.defaults.headers.common["Authorization"]='Bearer '+ this.$root.token;
            axios.get('/api/user')
            .then((resp)=>{
                this.$root.user=resp.data 
                Fire.$emit('LoadUser')
                this.$root.loading=false
             }).catch(()=>{
                    localStorage.removeItem("token");
                    this.$router.push('/login')
             })
             // vue js code
        },
        methods:{  
        
        
        }
    }
</script>