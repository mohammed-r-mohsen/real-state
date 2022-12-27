<template>
<div class="agents-block-two">
        <div class="inner-box">
            <figure class="image-box">
                <ImgElement :src="provider.avatar"></ImgElement>
            </figure>
            <div class="content-box">
                <div class="title-inner">
                    <h4><router-link :to="'/provider/'+provider.name+'/'+provider.id">{{$root.check_company(provider)}}</router-link></h4>
                    <div class="provider-rating">
                    <star-rating :increment="0.1" :show-rating="false" :read-only="true" v-model="provider.rating"></star-rating>
                    </div>
                </div>
                <div class="text">
                    <p><i class="ri-map-pin-line"></i> {{provider.state.item}}</p>
                </div>
               
                <div class="shadow-box">
                    <router-link :to="'/provider/'+provider.name+'/'+provider.id" class="shadow-link">View Profile</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ImgElement from './ImgElement.vue';
import StarRating from 'vue-star-rating'
    export default{
    mounted() {
    },
    props: ["provider"],
    data() {
        return {};
    },
    components: { ImgElement, StarRating }
}

</script>