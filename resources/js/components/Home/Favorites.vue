<template>
  
    <div class="home-parent">

<!-- property-details -->
        <section class="property-details property-details-one" >
            <div class="auto-container">
                
                <PageTitle :page_title="trans('lang.my_favourites')"></PageTitle>
                <div class="row clearfix" v-if="!loading">
                   
                    <div class="col-md-4 col-sm-6" v-for="favorite,index in favorites.data" :key="index">
                        <AdBlock :item="favorite.advertisement"></AdBlock> 
                    </div>
                    <div class="col-lg-12 pagination-card">
                        <pagination :data="favorites" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <div class="row clearfix" v-else>
                    <div class="col-lg-4 col-md-6 col-sm-12 agents-block" v-for="n,index in 3" :key="index">
                        <div class="agents-block-two">
                            <div class="inner-box">
                                <Loading :lines="3"></Loading>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!loading && favorites.total==0">
                    <NoItems link="/filter_advertisements" :btn_name="trans('lang.brows_properties')"></NoItems>
                </div>
            </div>
        </section>
        
   

    </div>
</template>

    

    

<script>
import PageTitle from './Elements/PageTitle.vue';
import AdBlock from './Elements/AdBlock.vue';
import Loading from './Elements/Loading.vue';
import NoItems from './Elements/NoItems.vue';

    export default {
    mounted() {
        this.$root.get_user();
        if(this.$root.token){
            this.get_favorites()
        }
        Fire.$on(('LoadFavorites'),()=>{
            this.get_favorites()
        })
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            favorites:{},
            loading: false,
        };
    },
    methods: {
        get_favorites(){
            this.loading=true
            axios.get('/api/get_favorites')
            .then((resp)=>{
                this.favorites=resp.data
                this.loading=false
                 })
        },
        getResults(page = 1) {
            axios.get('/api/get_favorites?page=' + page)
                .then(({data}) => (
                    this.favorites = data
                ))
        },
    },
    components: { PageTitle, AdBlock, Loading, NoItems }
}
</script>