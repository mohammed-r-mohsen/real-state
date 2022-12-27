<template>
  
    <div class="home-parent">

<!-- property-details -->
        <section class="property-details property-details-one" >
            <div class="auto-container">
                <div class="sec-title">
                        <h2> Providers 
                            <router-link class="pull-right header-link"  to="/providers"> {{trans('lang.view_more')}}  </router-link> 
                        </h2>
                    </div>
                <div class="row clearfix ">
                   <div class="col-12">
                    <div class="wrapper grid">
                        <div class="agents-grid-content grid-item">
                            <div class="providers" v-if="!loading">
                                <div class="single-provider agents-block" v-for="provider,index in providers.data" :key="index">
                                    <ProviderBox :provider="provider"></ProviderBox>
                                </div>
                          
                            </div>
                            <div class="row clearfix" v-else>
                                <div class="col-lg-3 col-md-6 col-sm-12 agents-block" v-for="n,index in 4" :key="index">
                                    <div class="agents-block-two">
                                        <div class="inner-box">
                                            <Loading :lines="3"></Loading>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>
                </div>
            </div>
        </section>
        
   

    </div>
</template>

    

    

<script>
import PageTitle from './Elements/PageTitle.vue';
import ProviderBox from './Elements/ProviderBox.vue';
import Loading from './Elements/Loading.vue';

    export default {
    mounted() {
        // this.$root.get_user();
        this.get_providers()
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            providers:{},
            loading: false,
        };
    },
    methods: {
        get_providers(){
            this.loading=true
            axios.get('/api/get_providers/5')
            .then((resp)=>{
                this.providers=resp.data
                this.loading=false
                 })
        },
        getResults(page = 1) {

            axios.get('/api/get_providers?page=' + page)
                .then(({data}) => (
                    this.providers = data
                ))
        },
    },
    components: { PageTitle, ProviderBox, Loading }
}
</script>