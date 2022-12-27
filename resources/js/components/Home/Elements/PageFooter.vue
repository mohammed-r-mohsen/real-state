<template>
     <!-- main-footer -->
        <footer class="main-footer">
            <div class="footer-top bg-color-2">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget about-widget">
                                <div class="widget-title">
                                    <h3>{{trans('lang.about')}}</h3>
                                </div>
                                <div class="text">
                                    <p> {{page.item_about_title}} </p>
                             
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget links-widget ml-70">
                                <div class="widget-title">
                                    <h3>{{trans('lang.useefull_links')}}</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list class">
                                        <li><router-link to="/">{{trans('lang.home')}}</router-link></li>
                                        <li><router-link to="/about">{{trans('lang.about')}}</router-link></li>
                                        <!-- <li><router-link to="#">How It Works</router-link></li> -->
                                        <li><router-link to="/providers">{{trans('lang.providers')}}</router-link></li>
                                        <li><router-link to="/contact">{{trans('lang.contact_us')}}</router-link></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget links-widget ml-70">
                                <div class="widget-title">
                                    <h3> {{trans('lang.company')}} </h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list class">
                                        <li><router-link to="/terms">{{trans('lang.terms')}}</router-link></li>
                                        <li><router-link to="/privacy">{{trans('lang.privacy')}}</router-link></li>
                                        <li><router-link to="/contact">{{trans('lang.contact_us')}}</router-link></li>
                                        <li><router-link to="/faqs">{{trans('lang.faqs')}}</router-link></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget contact-widget">
                                <div class="widget-title">
                                    <h3>{{trans('lang.contacts')}}</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="info-list clearfix">
                                        <li><i class="ri-map-pin-line"></i>{{settings.address}}</li>
                                        <li><i class="ri-phone-line"></i><a :href="'tel:'+settings.phone">{{settings.phone}}</a></li>
                                        <li><i class="ri-mail-line"></i><a :href="'mailto:'+settings.email">{{settings.email}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="inner-box clearfix">
                        <figure class="footer-logo"><router-link to="/"><img src="/assets2/images/logo.png" alt=""></router-link></figure>
                        <div class="copyright pull-left">
                            <p><router-link to="/">{{settings.site_name}}</router-link> &copy;  All Right Reserved</p>
                        </div>
                        <ul class="footer-nav pull-right clearfix">
                            <li><router-link to="/terms">{{trans('lang.terms')}}</router-link></li>
                            <li><router-link to="/privacy">{{trans('lang.privacy')}}</router-link></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end -->
</template>

<script >

    export default {
        mounted(){
            this.get_pages()
            this.get_settings()
        },
        props:['footer'],
        data(){
            return {
                page:'',
                settings:'',
            }
        },
        methods:{
            get_pages(){
            axios.get('/api/get_pages_content')
                 .then((resp)=>{
                    this.page=resp.data
                 })
        },
        get_settings(){
            axios.get('/api/get_settings')
                 .then((resp)=>{
                    this.settings=resp.data
                 })
        }
        }
    }

</script>