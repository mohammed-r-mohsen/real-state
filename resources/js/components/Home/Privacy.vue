<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
                  <!--Page Title-->
        <section class="page-title centred" style="background-image: url(/assets2/images/background/page-title-4.jpg);">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{trans('lang.privacy')}}</h1>
                    <ul class="bread-crumb clearfix">
                        <li><router-link to="/">{{trans('lang.home')}}</router-link></li>
                        <li>{{trans('lang.privacy')}}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- faq-page-section -->
        <section class="faq-page-section sec-pad">
            <div class="auto-container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                        <div class="faq-content-side">
                            <div class="sec-title">
                                <h2>{{trans('lang.privacy')}}.</h2>
                            </div>           
                        </div>
                        <div class="content">
                            <div v-html="page.item_privacy"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- faq-page-section end -->

        <page-footer></page-footer>
        </div>
    
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';
import PageFooter from './Elements/PageFooter.vue';

    export default {
    mounted() {
        this.get_pages()
        
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            loading:false,
            page:''
        };
    },
    methods: {
        get_pages(){
            this.loading=true
            axios.get('/api/get_pages_content')
                 .then((resp)=>{
                    this.page=resp.data
                    this.loading=false
                 })
        }
    },
    components: { Loading, PageFooter },
  
}
</script>


