<template>
    <section class="banner-style-two centred">
        <div class="auto-container">
        <div class="banner-section" v-if="!loading" >
        <carousel :per-page="1" :mouse-drag="true" dir="ltr" :navigationEnabled="true" :paginationEnabled="false">
            <slide v-for="slider,index in sliders" :key="index" >  
                <div class="slide-item" >
                    <div class="image-overlayer">
                        <img-element :src="slider.slider"></img-element>
                    </div>
                </div>
            </slide>
            </carousel>
            <div class="api-links">
                <div class="google-play">
                    <a href="">
                    <img src="/assets2/images/google-play.jpg">
                    <span> {{trans('lang.download_now')}}</span>
                    </a>
                </div>
                <div class="google-play">
                    <a href="">
                    <img src="/assets2/images/ios.jpg">
                    <span> {{trans('lang.download_now')}}</span>
                    </a>
                </div>
            </div>
            <div class="content-box">
                <div class="in-box">
                <h2>{{page.item_banner}}</h2>
                </div>
                <p class="mt-20 p-button"> <router-link to="/filter_advertisements" class="theme-btn btn-one"> {{trans('lang.brows_properties')}}</router-link> </p>
            </div> 
                 


          
        </div>
        <div class="banner-section" v-else>
            <div class="row">
                <div class="col-md-9">
                    <loading :lines="4"></loading>
                </div>
                <div class="col-md-3">
                    <loading :lines="4"></loading>
                </div>
            </div>
        </div>
           
            </div>
        </section>  
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import ImgElement from './ImgElement.vue';
import Loading from './Loading.vue';
export default {
    components:{Carousel, Slide, ImgElement, Loading },
    mounted() {
     this.get_sliders()
     this.get_pages()
    },
    data(){
        return {
            loading:false,
            sliders:[],
            page:''
        }
       },
    methods:{
    get_sliders(){
        this.loading=true
        axios.get('/api/get_sliders')
        .then((resp)=>{
            this.sliders=resp.data
            
            this.loading=false
            
             })
    },
    get_pages(){
            this.loading=true
            axios.get('/api/get_pages_content')
                 .then((resp)=>{
                    this.page=resp.data
                    this.loading=false
                 })
        }
    }
}
</script>



