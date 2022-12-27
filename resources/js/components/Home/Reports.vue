<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
        <section class="property-page-section property-grid reveiws-page">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'reports'"></sidebar>
                    <div class="col-md-9  col-sm-12 content-side">
                        <div class="home-header">
                            <h4 class="title"><i class="ri-numbers-line"></i> {{trans('lang.reports')}} : </h4> 
                        </div>
                        <div class="col-12" v-if="!loading">
                         <div class="row clearfix">
                            <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                                <div class="info-block-one report">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="ri-mail-send-line"></i></div>
                                        <h4>{{trans('lang.email_contacts')}}</h4>
                                        <p>{{reports.email}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                                <div class="info-block-one report">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="ri-phone-line"></i></div>
                                        <h4>{{trans('lang.phone_contacts')}}</h4>
                                        <p>{{reports.phone}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                                <div class="info-block-one report">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="ri-whatsapp-line"></i></div>
                                        <h4> {{trans('lang.whatsapp_contacts')}} </h4>
                                        <p>{{reports.whatsapp}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="row clearfix mt-30">
                            <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                                <div class="info-block-one report ads-report">
                                    <div class="inner-box">
                                        <span class="number">{{reports.refused_ads}} </span>
                                        <div class="icon-box"><i class="ri-advertisement-line"></i></div>
                                        <h4>{{trans('lang.refused_ads')}}</h4>
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                                <div class="info-block-one report ads-report">
                                    <div class="inner-box">
                                        <span class="number"> {{reports.pending_ads}} </span>
                                        <div class="icon-box"><i class="ri-advertisement-line"></i></div>
                                        <h4>{{trans('lang.pending_ads')}}</h4>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                                <div class="info-block-one report ads-report">
                                    <div class="inner-box">
                                        <span class="number"> {{reports.active_ads}} </span>
                                        <div class="icon-box"><i class="ri-advertisement-line"></i></div>
                                        <h4> {{trans('lang.active_ads')}} </h4>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-12" v-else>
                            <div class="row">
                                <div class="col-md-4">
                                    <loading :lines="2"></loading>
                                </div>
                                <div class="col-md-4">
                                    <loading :lines="2"></loading>
                                </div>
                                <div class="col-md-4">
                                    <loading :lines="2"></loading>
                                </div>
                                <div class="col-md-4">
                                    <loading :lines="2"></loading>
                                </div>
                                <div class="col-md-4">
                                    <loading :lines="2"></loading>
                                </div>
                                <div class="col-md-4">
                                    <loading :lines="2"></loading>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';

    export default {
    mounted() {
        this.$root.get_user();
        this.get_reports()
        Fire.$on('LoadData',()=>{
            this.get_reports()
        })
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            loading:false,
            reports:''
        };
    },
    methods: {
        get_reports(){
            if(this.$root.user.id){
                this.loading=true
                axios.get('/api/get_reports/'+this.$root.user.id)
                .then((resp)=>{
                    this.reports=resp.data
                    this.loading=false
                })
            }
            },
    },
    components: { Loading }
}
</script>