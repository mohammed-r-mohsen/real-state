<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
                  <!--Page Title-->
        <section class="page-title centred" style="background-image: url(/assets2/images/background/cta-1.jpg);">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{trans('lang.about_us')}}</h1>
                    <ul class="bread-crumb clearfix">
                        <li><router-link to="/">{{trans('lang.home')}}</router-link></li>
                        <li>{{trans('lang.about_us')}}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->


        <!-- about-section -->
        <AboutSection></AboutSection>
        <!-- about-section end -->
        
        <!-- category-section -->
        <categories-section></categories-section>
        <!-- category-section-end -->

        
        <!-- cta-section -->
        <section class="cta-section alternate-2 pb-240 centred" style="background-image: url(/assets2/images/background/cta-1.jpg);">
            <div class="auto-container">
                <div class="inner-box clearfix">
                    <div class="text">
                        <h2>{{trans('lang.looking_message')}} <br /> {{trans('lang.sell_message')}}</h2>
                    </div>
                    <div class="btn-box">
                        <button @click="filter('rent')" class="theme-btn btn-three">{{trans('lang.rent_properties')}}</button>
                        <button  @click="filter('buy')" class="theme-btn btn-one">{{trans('lang.buy_properties')}}</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta-section end -->


        <!-- funfact-section -->
        <!-- <section class="funfact-section centred">
            <div class="auto-container">
                <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                            <div class="funfact-block-one">
                                <div class="inner-box">
                                    <div class="count-outer">
                                        <span>1270</span>
                                    </div>
                                    <p>{{trans('')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                            <div class="funfact-block-one">
                                <div class="inner-box">
                                    <div class="count-outer">
                                        <span>2350</span>
                                    </div>
                                    <p>Total Property Sell</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                            <div class="funfact-block-one">
                                <div class="inner-box">
                                    <div class="count-outer">
                                        <span >2540</span>
                                    </div>
                                    <p>Total Property Rent</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                            <div class="funfact-block-one">
                                <div class="inner-box">
                                    <div class="count-outer">
                                        <span>8270</span>
                                    </div>
                                    <p>Total Customers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- funfact-section end -->

        <!-- categories-section -->
            <welcome-providers></welcome-providers>
        <!-- categories-section-end -->
        <page-footer></page-footer>
        </div>
    
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';
import PageTitle from './Elements/PageTitle.vue';
import CategoriesSection from './Elements/CategoriesSection.vue';
import WelcomeProviders from './WelcomeProviders.vue';
import PageFooter from './Elements/PageFooter.vue';
import AboutSection from './Elements/AboutSection.vue';

    export default {
    mounted() {
        this.$root.get_user();
       
        Fire.$on('LoadData',()=>{
            
        })
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
    components: { Loading, PageTitle, CategoriesSection, WelcomeProviders, PageFooter, AboutSection }
}
</script>


