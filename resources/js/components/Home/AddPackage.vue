<template>
  
        <div class="home-parent">

      


        <!-- property-page-section -->
        <section class="property-page-section property-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'packages'"></sidebar>

                    <div class="col-md-9  col-sm-12 content-side">
                        <div class="myprofile-section">
                       
                            <div class="general-information">
                                <h4 class="title"><i class="ri-discuss-line"></i> Select package :
                                <router-link to="/my_packages" class="title-link"> 
                                     my packages
                                    </router-link>
                                </h4>
                                
                            </div>
                        </div>
                      
                       <packages-section :view="2"></packages-section>
        
                        </div>
                  
                </div>
            </div>
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>

    export default {
        mounted(){
            this.$root.check_auth()
            // this.get_packages()
        },
        data(){
            return {
                packages:[],
            }
        },
        methods:{
            
        get_packages(){
            this.$root.loading=true
            axios.get('/api/get_packages')
                 .then((resp)=>{
                    this.packages=resp.data
                    this.$root.loading=false
                 })
        },
        }
       
       
    }
</script>