<template>
    <div class="blog-details-content ">    
        
          <!-- Create / Update Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" data-backdrop="static" >
              <div class="modal-dialog modal-dialog-centered" >
                  <div class="modal-content">
                      <form @submit.prevent="add_review()">
                      <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label> Review </label>
                                        <textarea class="form-control" rows="6" v-model="form.review" maxlength="400"></textarea>
                                       <div class="text-danger" v-if="form.errors.has('review')" v-html="form.errors.get('review')" />
                                        <span> {{form.review.length}} / {{maxlength}}  </span> 
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="rating-label"> Rating </label>
                                        <star-rating :show-rating="false" v-model="form.rating"></star-rating>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" >
                                  <span v-if="!loading">  Submit </span>
                                  <span v-else>  <waiting></waiting>  </span>
                                </button>
                                <button type="button" class="btn btn-light" id="close" data-dismiss="modal">{{trans('lang.close')}}</button>
                            </div>
                        </form>
                        </div>
                        <!--end modal-content-->
              </div>
              <!--end modal-dialog-->
          </div>
          <!--end modal-->


        <div class="comments-area reviews">
            <div class="group-title">
                <h4>  Reviews 
                     <button v-if="can_review()" class="btn-link btn-sm pull-right" data-toggle="modal" data-target="#modalID"> Add review </button>
                     <button v-else-if="!$root.user" class="btn-link btn-sm pull-right" @click="$root.login_alert()" >
                        Add review  
                     
                    </button>
                 </h4>
            </div>
            <div v-if="loading" class="text-center no-reviews">
                <loading :lines="2"></loading>
            </div>
            <carousel v-if="reviews.length>0 && !loading" :per-page="1" :mouse-drag="true" :navigationEnabled="false" :paginationEnabled="false" :autoplay="true" :autoplayTimeout="3000" :loop="true">
                <slide v-for="review,index in reviews" :key="index">
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
                </slide>  
            </carousel>
            
            <div v-else-if="reviews.length==0 && !loading" class="text-center no-reviews">
                <p > No Clients Reviews  </p>
                <div v-if="can_review()">
                <button v-if="$root.user" class="theme-btn btn-link" data-toggle="modal" data-target="#modalID"> Add review </button>
                <button v-else class="theme-btn btn-one" @click="$root.login_alert()" > Add review </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import StarRating from 'vue-star-rating'
import { Carousel, Slide } from 'vue-carousel';
import Waiting from './Waiting.vue';
import ImgElement from './ImgElement.vue';
import Loading from './Loading.vue';
    export default{
        mounted(){
            Fire.$on('Load',()=>{
                this.get_reviews()
            })
            this.get_reviews()
            this.check_user_review()
        },
        components:{Carousel, Slide,StarRating,Waiting, ImgElement, Loading },
        props:['provider'],
        data(){
            return {
                form:new Form({
                    rating:1,
                    review:'',
                    provider_id:''
                }),
                maxlength:400,
                loading:false,
                reviews:[],
                checked:false

            }
        },
         methods:{
            add_review(){

                this.loading=true
                this.form.provider_id=this.provider.id
                this.form.post('/api/add_review')
                    .then((resp)=>{
                        this.loading=false
                        Fire.$emit('Load')
                        this.$root.success('Thank you for your review !')
                        $('#close').click()
                        this.form.reset()
                        this.checked=true
                    }).catch(()=>{
                        this.loading=false
                    })
            
            },
            get_reviews(){
                this.loading=true
                axios.get('/api/get_reviews/'+this.provider.id)
                     .then((resp)=>{
                        this.reviews=resp.data
                        this.loading=false
                     })
            },
            check_user_review(){
                if(this.$root.token){
                    axios.get('/api/check_user_review/'+this.provider.id)
                    .then((resp)=>{
                        this.checked=resp.data
                    })
                }
            },
            can_review(){
                let user=this.$root.user
                if(user){
                    if(this.checked==true || user.id==this.provider.id ){
                        return false
                    }else{
                        return true
                    }
                }else{
                        return false
                    }
            }   
        }
    }

</script>