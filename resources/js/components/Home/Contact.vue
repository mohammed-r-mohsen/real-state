<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
                  <!--Page Title-->
        <section class="page-title centred" style="background-image: url(/assets2/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{trans('lang.contact_us')}}</h1>
                    <ul class="bread-crumb clearfix">
                        <li><router-link to="/">{{trans('lang.home')}}</router-link></li>
                        <li>{{trans('lang.contact_us')}}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- contact-info-section -->
        <section class="contact-info-section sec-pad centred">
            <div class="auto-container">
                <div class="sec-title">
                    <h5>{{trans('lang.contact_us')}}</h5>
                    <h2>{{trans('lang.get_in_touch')}}</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                        <div class="info-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="ri-mail-line"></i></div>
                                <h4>{{trans('lang.email_address')}}</h4>
                                <p><a :href="'mailto:'+settings.email">{{settings.email}}</a><br /></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                        <div class="info-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="ri-phone-line"></i></div>
                                <h4>{{trans('lang.phone_number')}}</h4>
                                <p><a :href="'tel:'+settings.phone">{{settings.phone}}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                        <div class="info-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="ri-home-line"></i></div>
                                <h4>{{trans('lang.address')}}</h4>
                                <p> {{settings.address}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-info-section end -->
        <page-footer></page-footer>
        </div>
    
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';
import ImgElement from './Elements/ImgElement.vue';
import PageTitle from './Elements/PageTitle.vue';
import PageFooter from './Elements/PageFooter.vue';

    export default {
    mounted() {
        this.get_settings()
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            loading:false,
            settings:''
        };
    },
    methods: {
        get_settings(){
            axios.get('/api/get_settings')
                 .then((resp)=>{
                    this.settings=resp.data
                 })
        }
    },
    components: { Loading, ImgElement, PageTitle, PageFooter }
}
</script>


