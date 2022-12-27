<template>
 <!-- category-section -->
        <section id="categories" class="category-section centred">
            <div class="auto-container">
                <div class="sec-title centred">
                    <h5>{{trans('lang.categories')}}</h5>
                </div>

                <div  v-if="cats && !loading" class="inner-container" >
        <ul class="category-list  row justify-content-center">
                        <li class="col-md-3 " v-for="cat,index in cats" :key="index">
                            <div class="category-block-one clickable" >
                                <div class="inner-box" @click="choose(cat.id)" :id="'cat'+cat.id">
                                    <div class="icon-box">
                                        <ImgElement :src="cat.image"></ImgElement>
                                    </div>
                                    <h5>{{cat.lang_name}}</h5>
                                </div>
                            </div>
                        </li>
                       
                    </ul>
                    
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
import ImgElement from './ImgElement.vue'
import Loading from './Loading.vue';

export default {
    mounted() {
        this.get_cats();
    },
    data() {
        return {
            loading:false,
            cats: [],
        };
    },
    methods: {
        get_cats() {
            this.loading = true;
            axios.get("/api/get_categories")
                .then((resp) => {
                this.cats = resp.data;
                this.loading = false;
            });
        },
        choose(id) {
            this.$root.filter_ads.category_id=id
            this.$router.push('/filter_advertisements')
        }
    },
    components: { ImgElement, Loading }
}
</script>



