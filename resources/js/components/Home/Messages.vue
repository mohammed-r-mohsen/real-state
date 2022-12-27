<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
        <section class="property-page-section property-grid reveiws-page">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'messages'"></sidebar>
                    <div class="col-md-9  col-sm-12 content-side">
                        <div class="home-header">
                            <h4 class="title"><i class="ri-message-line"></i> Messages : </h4> 
                        </div>
                        
                        <div class="card">
                            <div class="card-body message-title"> 
                                Messages box
                            </div>
                            <div class="comments-area messages">
                                <div class="comment-box">
                                    <div class="comment">
                                        <figure class="thumb-box">
                                            <img src="/assets2/images/news/comment-1.jpg" alt="">
                                        </figure>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix">
                                                <h5>Rebeka Dawson</h5>
                                                <span>3 minutes ago</span>
                                            </div>
                                            <div class="text">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nos trud exerc.</p>
                                            </div>
                                        </div>
                                    </div>
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