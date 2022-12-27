<template>
  
    <div class="home-parent">

<!-- property-details -->
        <section class="property-details property-details-one" >
            <div class="auto-container">
                <!-- <ad-details-top-section :ad="ad" v-if="!loading && ad"></ad-details-top-section>
                <div class="top-details clearfix" v-else>
                    <Loading :lines="1"></Loading>
                </div> -->
                
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-details-content">
                        <div class="carousel-inner">
                         <div class="bxslider">
                        <div class="slider-content">
                            <div class="product-image">
                                <figure class="image-box">
                                    <img :src="image" alt=""></figure>
                            </div>
                            <div class="slider-pager">
                                <ul class="thumb-box clearfix" v-if="ad.files">
                                    <li @click="silde(ad.image)">
                                        <a :class="{'active':image==ad.image}" data-slide-index="0" href="javascript:void(0)"><figure><img :src="ad.image" alt=""></figure></a>
                                    </li>
                                    <li @click="silde(file.file)"  v-for="file,index in ad.files" :key="index">
                                        <a :class="{'active':image==file.file}" :data-slide-index="index+1" href="javascript:void(0)"><figure><img :src="file.file" alt=""></figure></a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                        
                        </div>
                </div>


                            <!-- <div class="carousel-inner ad-details" v-if="ad.files">
                                <carousel :per-page="1" :mouse-drag="true" :navigationEnabled="true" :paginationEnabled="false">
                                    <slide  >   
                                        <figure class="image-box ad-sliders">
                                            <img :src="ad.image" style="height: 565px;">
                                        </figure>
                                    </slide>
                                    <slide  v-for="file,index in ad.files" :key="index">   
                                        <figure class="image-box ad-sliders">
                                            <img :src="file.file" style="height: 565px;">
                                        </figure>
                                    </slide>
                                </carousel>
                            </div> -->
                           
                        </div>
                    </div>
                    <div v-show="loading"  class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <Loading :lines="3"></Loading>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side" v-if="!loading && ad !=null">
                        <div class="property-details-content">
                         <div class="feature-block-one" >
                            <div class="inner-box">

                                
                                <div class="lower-content">
                                    
                                    <div class="title-text"><h4><router-link :to="{ name: 'view_advertisement', params: { slug: ad.slug }}">{{ad.item_title }}</router-link></h4></div>
                                    <div class="original" v-if="!item_title"> <a @click="show_original_title(ad)" href="javascript:void(0)"> {{trans('lang.show_original')}} </a> </div>
                                    <div class="original" v-else> <a @click="show_item_title(ad)" href="javascript:void(0)"> {{trans('lang.translate')}} </a> </div>

                                    <div class="price-box clearfix">
                                        <div class="price-info pull-left">
                                            <h6><i class="ri-map-pin-line"></i>
                                            {{ad.city.item}} - {{ad.region.item}} - {{ad.neighbor.item}}
                                            </h6>
                                            <p class="text-muted"> {{ad.item_desc |desc_filter}} </p>
                                            <div class="original" v-if="!item_desc"> <a @click="show_original_desc(ad)" href="javascript:void(0)"> {{trans('lang.show_original')}} </a> </div>
                                    <div class="original" v-else> <a @click="show_item_desc(ad)" href="javascript:void(0)"> {{trans('lang.translate')}} </a> </div>
                                            <h6 class="ad-tags">
                                            <span class="tag">{{ad.category.item}}</span>
                                            <span class="tag"> {{ad.type}} </span>
                                            <span class="tag"> {{ad.currency}} {{ad.price}} </span>
                                            </h6>
                                        </div>
                                        <ul class="other-option pull-right clearfix">
                                            <FavoriteButton :ad="ad"></FavoriteButton>
                                        </ul>
                                    </div>
                                    <div class="ad-info">
                                        <ul class="info clearfix">
                                        <li><span class="ad-sub-title">{{trans('lang.id')}}</span>#{{ad.id}}</li>
                                        <li><span class="ad-sub-title">{{trans('lang.category')}}</span> {{ad.category.item}}</li>
                                        <li><span class="ad-sub-title">{{trans('lang.type')}}</span> {{ad.type}}</li>
                                        <li><span class="ad-sub-title">{{trans('lang.price')}}</span> {{ad.currency}} {{ad.price}}</li>
                                        <li><span class="ad-sub-title">{{trans('lang.project_name')}}</span> {{ad.project_title}} </li>
                                        <li><span class="ad-sub-title">{{trans('lang.area')}}</span> {{ad.area}} </li>
                                        <li><span class="ad-sub-title">{{trans('lang.appart_model')}}</span> {{ad.appart_model}} </li>
                                        

                                    </ul>
                                    </div>
                                
                        
                                    <!-- <div class="btn-box"><router-link :to="{ name: 'view_advertisement', params: { slug: ad.slug }}" class="theme-btn btn-two">See Details</router-link></div> -->
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div v-show="loading"  class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <Loading :lines="2"></Loading>
                    </div>

                    
                </div>
                <div class=" property-details-content">
             <div class="row clearfix" v-if="!loading && ad.user!=''">
                 <div class="col-12 mb-10">
                    <div class="discription-box content-widget">
                        <div class="title-box">
                            <h4>Advertisement Description</h4>
                        </div>
                        <div class="text">
                            {{ad.item_desc}}
                        </div>
                        <div class="original" v-if="!item_desc"> <a @click="show_original_desc(ad)" href="javascript:void(0)"> {{trans('lang.show_original')}} </a> </div>
                        <div class="original" v-else> <a @click="show_item_desc(ad)" href="javascript:void(0)"> {{trans('lang.translate')}} </a> </div>
                    </div>
                 </div>
                 <div class="col-md-5 mb-10">
                    <AdDetailsProviderSection v-if="ad.user" :user="ad.user"></AdDetailsProviderSection>
                    <div class="location-box content-widget mt-10" v-if="ad.video">
                        <div class="title-box">
                            <h4>{{trans('lang.video')}}</h4>
                        </div>
                        
                        <div class="video-box">
                            <video width="100%" height="auto" controls>
                        <source :src="ad.video">
                        {{trans('lang.browser_no_support')}}
                        </video>
                        </div>

                </div>
                </div>
                <div class="col-md-7 mb-10">
                    <div class="location-box content-widget">
                        <div class="title-box">
                            <h4>Location</h4>
                        </div>
                        <ul class="info clearfix">
                            <li><span>Address:</span> {{ad.address}}</li>
                            <li v-if="ad.state"><span>State/county:</span> {{ad.state.item}}</li>
                            <li v-if="ad.city"><span>City:</span> {{ad.city.item}}</li>
                            <li v-if="ad.region"><span>Region:</span> {{ad.region.item}}</li>
                            <li v-if="ad.neighbor"><span>Neighborhood:</span> {{ad.neighbor.item}}</li>

                        </ul>
                        <div class="google-map-area" v-if="coordinates.lat!=0 || coordinates.lng!=0">
                            
                            <GmapMap :center="coordinates"
                            :zoom="7"
                            map-type-id="terrain"
                            style="width: 100%; height: 500px"
                            data-icon-path="/assets2/images/icons/map-marker.png"
                            >
                                <GmapMarker
                                    :position="coordinates"
                                    :clickable="true"
                                    :draggable="true"
                                    @click="center=coordinates"
                                />
                            </GmapMap>
                            
                        </div>
                    </div>
                </div>
                
             </div>
             </div>
                
                <div class="similar-content" v-if="ad">
                    <div class="title">
                        <h4>Similar Properties</h4>
                    </div>
                    <SimilerAds :ad_id="ad.id"></SimilerAds>
                </div>

            </div>
        </section>
        
   

    </div>
</template>

    

    

<script>
import AdDetailsTopSection from './Elements/AdDetailsTopSection.vue';
import NotFoundComponent from './Elements/NotFoundComponent.vue';
import Loading from "./Elements/Loading.vue";
import SimilerAds from "./Elements/SimilerAds.vue";
import AdDetailsProviderSection from "./Elements/AdDetailsProviderSection.vue";
import FavoriteButton from './Elements/FavoriteButton.vue';
import { Carousel, Slide } from 'vue-carousel';
    export default {
  components: { AdDetailsTopSection, NotFoundComponent, Loading, SimilerAds, AdDetailsProviderSection,
                Carousel,Slide, FavoriteButton },
        mounted(){
            this.$root.get_user()
           this.get_ad()
        },
        data(){
            return {
                form :new Form({
                id:'',
            }),
            image:'',
            loading:false,
            ad:'',
            coordinates:{
                lat:0,
                lng:0
            },
            item_title:'',
            item_desc:'',

            }
        },
        methods:{
            silde(image){
                this.image=image
            },
            show_original_title(ad){
                this.item_title=ad.item_title
                this.ad.item_title= ad.title_original
            },
            show_item_title(ad){
                this.ad.item_title=this.item_title
                this.item_title=''
            },
            show_original_desc(ad){
                this.item_desc=ad.item_desc
                this.ad.item_desc= ad.desc_original
            },
            show_item_desc(ad){
                this.ad.item_desc=this.item_desc
                this.item_desc=''
            },
            get_ad(){
                this.loading=true
                axios.get('/api/get_ad/'+this.$route.params.slug)
                .then((resp)=>{
                    let ad=resp.data
                    if(ad==''){
                        this.$router.push('/not-found')
                    }else if(ad){
                        if(ad.status!='active' && this.$root.user.id!=ad.user_id){
                            this.$router.push('/not-found')
                        }
                    }
                    this.ad=resp.data
                    this.image=resp.data.image
                    this.coordinates.lat=this.ad.lat
                    this.coordinates.lng=this.ad.lng
                    this.loading=false
                     })
            },
            center(coordinates){
                this.coordinates=coordinates
            },
           
        },
       
 
    }
</script>