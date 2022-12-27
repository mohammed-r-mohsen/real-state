<template>
  
    <div class="home-parent">

<!-- property-details -->
        <section class="property-details property-details-one" >
            <div class="auto-container">
                
                <PageTitle :page_title="trans('lang.providers')"></PageTitle>
                <div class="row clearfix ">
                   <div class="col-12">
                    <div class="wrapper grid">
                        <div class="agents-grid-content grid-item">
                            <div class="providers" v-if="!loading">
                                <div class="single-provider agents-block" v-for="provider,index in providers.data" :key="index">
                                    <ProviderBox :provider="provider"></ProviderBox>
                                </div>
                            <div class="col-lg-12 pagination-card">
                                <pagination :data="providers" @pagination-change-page="getResults"></pagination>
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
        
   
        <page-footer></page-footer>
    </div>
</template>

    

    

<script>
import PageTitle from './Elements/PageTitle.vue';
import ProviderBox from './Elements/ProviderBox.vue';
import Loading from './Elements/Loading.vue';
import PageFooter from './Elements/PageFooter.vue';

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
            axios.get('/api/get_providers')
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
    components: { PageTitle, ProviderBox, Loading, PageFooter }
}
</script>