<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
                  <!--Page Title-->
        <section class="page-title centred" style="background-image: url(/assets2/images/background/cta-1.jpg);">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{trans('lang.services')}}</h1>
                    <ul class="bread-crumb clearfix">
                        <li><router-link to="/">{{trans('lang.home')}}</router-link></li>
                        <li>{{trans('lang.services')}}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->


        
        <!-- category-section -->
        <categories-section></categories-section>
        <!-- category-section-end -->

        

        <page-footer></page-footer>
        </div>
    
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';
import PageTitle from './Elements/PageTitle.vue';
import CategoriesSection from './Elements/CategoriesSection.vue';
import WelcomeProviders from './WelcomeProviders.vue';
import PageFooter from './Elements/PageFooter.vue';

    export default {
    mounted() {
        this.$root.get_user();
       
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            loading:false,
            reviews:[]
        };
    },
    methods: {
        filter(type){
            this.$root.filter_ads.type=type
            this.$router.push('/filter_advertisements')
        }
    },
    components: { Loading, PageTitle, CategoriesSection, WelcomeProviders,PageFooter }
}
</script>


