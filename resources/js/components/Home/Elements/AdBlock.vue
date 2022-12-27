<template>
  <div class="feature-block-one" >
        <div class="inner-box">
            <div class="image-box">
                <figure class="image"><img :src="item.image" alt=""></figure>
                <div class="batch"><i class="ri-price-tag-line"></i></div>
                <span class="category" v-if="item.type=='buy'"> {{trans('lang.buy')}} </span>
                <span class="category" v-else> {{trans('lang.rent')}} </span>
            </div>
            <div class="lower-content">
                
                <div class="title-text"><h4><router-link :to="{ name: 'view_advertisement', params: { slug: item.slug }}">{{item.item_title | title_filter}}</router-link></h4></div>
                <div class="original" v-if="!item_title"> <a @click="show_original_title(item)" href="javascript:void(0)"> {{trans('lang.show_original')}} </a> </div>
                <div class="original" v-else> <a @click="show_item_title(item)" href="javascript:void(0)"> {{trans('lang.translate')}} </a> </div>
                <div class="price-box clearfix">
                    <div class="price-info pull-left">
                        <h6><i class="ri-map-pin-line"></i>
                        {{item.city.item}} - {{item.region.item}} - {{item.neighbor.item}}
                        </h6>
                        <h4>{{item.currency}} {{item.price}}</h4>
                        <h6>
                        {{item.category.item}} | 
                        <span v-if="item.type=='buy'"> {{trans('lang.buy')}} </span>
                        <span v-else> {{trans('lang.rent')}} </span>
                        </h6>
                    </div>
                    <ul class="other-option pull-right clearfix">
                        <FavoriteButton :ad="item"></FavoriteButton>
                    </ul>
                </div>
                <p>{{item.item_desc | desc_filter}}</p>
                <div class="original" v-if="!item_desc"> <a @click="show_original_desc(item)" href="javascript:void(0)"> {{trans('lang.show_original')}} </a> </div>
                <div class="original" v-else> <a @click="show_item_desc(item)" href="javascript:void(0)"> {{trans('lang.translate')}} </a> </div>
    
                <!-- <div class="btn-box"><router-link :to="{ name: 'view_advertisement', params: { slug: item.slug }}" class="theme-btn btn-two">See Details</router-link></div> -->
            </div>
        </div>
    </div>
</template>

<script>
import ImgElement from './ImgElement.vue';
import FavoriteButton from './FavoriteButton.vue';
export default {
    props: ["item"],
    data(){
        return {
            item_desc:'',
            item_title:'',
        }
    },
    mounted() {
        
    },
    methods:{
        show_original_title(ad){
                this.item_title=ad.item_title
                this.item.item_title= ad.title_original
            },
            show_item_title(ad){
                this.item.item_title=this.item_title
                this.item_title=''
            },
            show_original_desc(ad){
                this.item_desc=ad.item_desc
                this.item.item_desc= ad.desc_original
            },
            show_item_desc(ad){
                this.item.item_desc=this.item_desc
                this.item_desc=''
            },
    },
    components: { ImgElement, FavoriteButton }
}
</script>
