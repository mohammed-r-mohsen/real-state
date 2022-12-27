<template>
    <div class="row clearfix recent-slider pb-10">
                            <div class="col-lg-5 col-md-5 col-sm-12 deals-block">
                                <div class="deals-block-one">
                                    <div class="inner-box">
                                      
                                        
                                        <div class="lower-content recent-block">
                                            <div class="title-text"><h4><router-link :to="'view_advertisement/'+ad.slug" >{{ad.item_title}}</router-link></h4></div>
                                            <div class="original" v-if="!item_title"> <a @click="show_original_title(ad)" href="javascript:void(0)"> {{trans('lang.show_original')}} </a> </div>
                <div class="original" v-else> <a @click="show_item_title(ad)" href="javascript:void(0)"> {{trans('lang.translate')}} </a> </div>
                                            <h6><i class="ri-map-pin-line"></i>
                                            {{ad.city.item}} - {{ad.region.item}} - {{ad.neighbor.item}}
                                            </h6>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-left"> 
                                                    <h6 class="ad-tags">
                                                        <span class="tag">{{ad.category.item}}</span>
                                                        <span class="tag"> {{trans('lang.'+ad.type)}} </span>
                                                        <span class="tag"> {{ad.currency}} {{ad.price}} </span>
                                                        </h6>
                                                </div>
                                                <ul class="other-option pull-right clearfix">
                                                    <favorite-button :ad="ad"></favorite-button>
                                                </ul>
                                            </div>
                                            
                                            <p>{{ad.item_desc | desc_filter2}}</p>
                                            <div class="original" v-if="!item_desc"> <a @click="show_original_desc(ad)" href="javascript:void(0)"> {{trans('lang.show_original')}} </a> </div>
                                            <div class="original" v-else> <a @click="show_item_desc(ad)" href="javascript:void(0)"> {{trans('lang.translate')}} </a> </div>
                                           
                                            <div class="btn-box"><router-link :to="'view_advertisement/'+ad.slug" class="theme-btn btn-one"> {{trans('lang.see_details')}} </router-link></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 "></div>
                            <div class="col-lg-6 col-md-6 col-sm-12 deals-block">
                                <div class="image-box">
                                    <figure class="image"><img class="recent-img" :src="ad.image" alt=""></figure>
                                    <div v-if="ad.video" class="text wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms"
                                    :style="{'background':'url('+ad.image+')'}">
                                        <div class="video-btn">
                                            <a @click="newModal(ad.video)" data-toggle="modal" data-target="#modalID"><i class="ri-play-circle-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
</template>

<script>
import Loading from './Loading.vue';
import FavoriteButton from './FavoriteButton.vue';
    export default{
        mounted(){

        },
        components: { Loading, FavoriteButton },
        props:['ad'],
        data(){
            return {
                item_title:'',
            item_desc:''
            }
        },
        methods:{
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
        }
    }
</script>