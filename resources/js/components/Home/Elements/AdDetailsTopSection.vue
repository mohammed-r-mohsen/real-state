<template>
    <div class="top-details clearfix" v-if="ad.user">
                    <div class="left-column pull-left clearfix">
                        <h3>{{ad.title}}</h3>
                        <div class="author-info clearfix">
                            <div class="author-box pull-left">
                                <figure class="author-thumb">
                                    <ImgElement :src="ad.user.avatar"></ImgElement>
                                </figure>
                                <h6>{{ad.user.name}}</h6>
                            </div>
                            <star-rating :increment="0.1" :show-rating="false" :read-only="true" v-model="rating"></star-rating>
                        </div>
                    </div>
                    <div class="right-column pull-right clearfix">
                        <div class="price-inner clearfix">
                            <ul class="category clearfix pull-left">
                                <li><a href="javascript:void(0)">For Buy</a></li>
                            </ul>
                            <div class="price-box pull-right">
                                <h3> {{ad.currency}} {{ad.price}}</h3>
                            </div>
                        </div>
                        <ul class="other-option pull-right clearfix">
                            <li><a href="#"><i class="icon-37"></i></a></li>
                            
                            <FavoriteButton :ad="ad"></FavoriteButton>
                        </ul>
                    </div>
                </div>
</template>

<script>
import ImgElement from './ImgElement.vue';
import FavoriteButton from './FavoriteButton.vue';
import StarRating from 'vue-star-rating'
export default {
    props: ["ad"],
    mounted() {
        this.get_raiting()
    },
    data(){
        return {
            rating:0
        }
    },
    methods: {
        get_raiting(){
            axios.get('/api/get_provider_rating/'+this.ad.user_id)
                 .then((resp)=>{
                    this.rating=parseInt(resp.data)
                 })
        }
    },
    components: { ImgElement, FavoriteButton, StarRating }
}
</script>



