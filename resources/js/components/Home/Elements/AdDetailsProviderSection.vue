<template>
    <div class="property-sidebar default-sidebar">
            <div class="author-widget sidebar-widget">
                <div class="author-box">
                    <figure class="author-thumb">
                        <ImgElement :src="user.avatar"></ImgElement>
                    </figure>
                    <div class="inner">
                        <h4>{{$root.check_company(user)}}</h4>
                        
                        <ul class="info clearfix">
                            <li><i class="ri-map-pin-line"></i>{{user.state.name_en}}</li>  
                        </ul>
                        <!-- <div class="user-rating">
                         <star-rating :increment="0.1" :show-rating="false" :read-only="true" v-model="rating"></star-rating>
                        </div> -->
                        <social-buttons v-if="user" :provider="user"></social-buttons>
                        
                         <div class="btn-box"><router-link :to="'/provider/'+user.name+'/'+user.id">View Profile</router-link></div>
                    </div>
                </div>
                
            </div>
            
        </div>
</template>

<script>
import ImgElement from './ImgElement.vue';
import SocialButtons from './SocialButtons.vue';
import StarRating from 'vue-star-rating'
export default {
    props: ["user"],
    mounted() {
        this.get_rating()
    },
    data(){
        return {
            rating:0
        }
    },
    methods: {
        get_rating(){
            // axios.get('/api/get_provider_rating/'+this.user.id)
            //      .then((resp)=>{
            //         this.rating=parseInt(resp.data)
            //      })
        }
    },
    components: { ImgElement, SocialButtons, StarRating }
}
</script>



