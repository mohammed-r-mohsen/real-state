<template>
 <!-- category-section -->
        <section class="">
            <div class="auto-container">
                <div  v-if="cats && !loading" class="inner-container" >
                    <div class="cats-with-ads" v-for="cat,index in cats" :key="index">
                    <div class="sec-title">
                        <h2> {{cat.lang_name}} 
                            <a class="pull-right header-link" @click="view_more(cat)" href="javascript:void(0)"> {{trans('lang.view_more')}}  </a> 
                        </h2>
                    </div>
                    <div class="row mb-40" v-if="cat.ads">
                        <div class="col-md-4" v-for="ad,index in cat.ads.data" :key="index">
                            <ad-block :item="ad"></ad-block>
                        </div>
                    </div>
                    <div class="row" v-else>
                        <p class="text-center"> {{trans('lang.no_items')}} </p>
                    </div>
                    </div>
                </div>
                <div v-else>
                    <ul class="category-list  row justify-content-center">
                        <li class="col-md-3 ">
                            <Loading :lines="2"></Loading>
                        </li>
                        <li class="col-md-3 ">
                            <Loading :lines="2"></Loading>
                        </li>
                        <li class="col-md-3 ">
                            <Loading :lines="2"></Loading>
                        </li>
                       
                    </ul>
                        
                </div>
            </div>
        </section>
        <!-- category-section end -->
                    
</template>

<script>
import AdBlock from './AdBlock.vue';
import ImgElement from './ImgElement.vue'
import Loading from './Loading.vue';

export default {
    mounted() {
        this.get_cats_with_ads();
    },
    data() {
        return {
            loading:false,
            cats: [],
        };
    },
    methods: {
        get_cats_with_ads() {
            this.loading = true;
            axios.get("/api/get_categories_with_ads")
                .then((resp) => {
                this.cats = resp.data;
                this.loading = false;
            });
        },
        view_more(cat){
            this.$root.filter_ads.category_id=cat.id
            this.$router.push('/filter_advertisements')
        }
    },
    components: { ImgElement, Loading, AdBlock }
}
</script>



