<template>
    

<section class="about-section about-page pb-0">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row align-items-center clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                            <div class="image_block_2">
                                <div class="image-box">
                                    <figure class="image"><img src="/assets2/images/resource/about-2.jpg" alt=""></figure>
                                    <div class="text wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <h2>20</h2>
                                        <h4>{{trans('lang.years_of')}} <br />{{trans('lang.experience')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                            <div class="content_block_3">
                                <div class="content-box">
                                    <div class="sec-title">
                                        <h5>{{trans('lang.about_no_comission')}}</h5>
                                        <h2>{{page.item_about_title}} </h2>
                                    </div>
                                    <div v-html="page.item_about_desc"></div>
                                    <div class="btn-box">
                                        <router-link to="/contact" class="theme-btn btn-one">{{trans('lang.contact_us')}}</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</template>
<script>

    export default {
        mounted(){
            this.get_pages()
        },
        data(){
            return {
                page:''
            }
        },
        methods:{
            get_pages(){
                axios.get('/api/get_pages_content')
                 .then((resp)=>{
                    this.page=resp.data
                 })
            }
        }
    }


</script>