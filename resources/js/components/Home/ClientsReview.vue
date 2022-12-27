<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
        <section class="property-page-section property-grid reveiws-page">
            <div class="auto-container">

                <div class="row clearfix">
                    <sidebar :page="'clients_review'"></sidebar>

                    <div class="col-md-9  col-sm-12 content-side">
                        <div class="home-header">
                                <h4 class="title"><i class="ri-star-line"></i> {{trans('lang.clients_reviews')}} :
                               
                                </h4>
                                
                            </div>
                     <div  class="comments-area">
                    <div v-if="loading" class="text-center no-reviews">
                        <loading :lines="2"></loading>
                    </div>
                    <div v-if="reviews.length>0 && !loading">
                    <div class="agents-block-one" >
                        <div v-for="review,index in reviews" :key="index">
                            <div class="comment-box">
                                <div class="comment" v-if="review.user">
                                    <figure class="thumb-box" >
                                        <img-element :src="review.user.avatar"></img-element>
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h5>{{review.user.name}}</h5>
                                            <span>{{review.created_at | date_filter}}</span>
                                            <span class="review"> 
                                                
                                            <star-rating :show-rating="false" :read-only="true" v-model="review.rating"></star-rating>
                                            </span>
                                        </div>
                                        <div class="text">
                                            <p> {{review.review}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                   <div v-else-if="reviews.length==0 && !loading" class="text-center no-reviews">
                        <p > {{trans('lang.no_client_reviews')}} </p>
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
import StarRating from 'vue-star-rating'
import Loading from './Elements/Loading.vue';
import ImgElement from './Elements/ImgElement.vue';
import PageTitle from './Elements/PageTitle.vue';

    export default {
    mounted() {
        this.$root.get_user();
        this.get_reviews()
        Fire.$on('LoadData',()=>{
            this.get_reviews()
        })
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            loading:false,
            reviews:[]
        };
    },
    methods: {
        get_reviews(){
            if(this.$root.user.id){
                this.loading=true
                axios.get('/api/get_reviews/'+this.$root.user.id)
                .then((resp)=>{
                    this.reviews=resp.data
                    this.loading=false
                })
            }
            },
    },
    components: { Loading, ImgElement, StarRating, PageTitle }
}
</script>