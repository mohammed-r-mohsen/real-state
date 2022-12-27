<template>
  
        <div class="home-parent">

      


        <!-- property-page-section -->
        <section class="property-page-section property-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'account'"></sidebar>
                        <div class="col-md-9  col-sm-12 content-side">
                        <div class="general-information myprofile-section" v-if="ad!='' && !loading" >
                        <final-section :editMode="true" :ad="ad"></final-section>
                        </div>
                        <div v-else-if="loading">
                            <loading :lines="4"></loading>
                        </div>
                        <div v-else>
                            <no-items :link="'my_advertisements'" :btn_name="'Go Back'"></no-items>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>
import FinalSection from './Elements/FinalSection.vue';
import Loading from './Elements/Loading.vue';
import NoItems from './Elements/NoItems.vue';

    export default {
    mounted() {
        this.$root.check_auth()
        // vue js code
        this.get_ad()
    },
    data(){
        return {
            ad:'',
            loading:false,
        }
    },
    methods: {
        get_ad(){
            this.loading=true
            axios.get('/api/get_ad/'+this.$route.params.slug)
            .then((resp)=>{
                     this.loading=false
                    this.ad=resp.data
                 })
        }
    },
    components: { FinalSection, Loading, NoItems }
}
</script>