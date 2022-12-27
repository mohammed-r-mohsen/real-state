<template>
  <!-- deals-section -->
        <section class="deals-section sec-pad bg-color-1" >

            <!-- Create / Update Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" >
              <div class="modal-dialog modal-dialog-centered" >
                  <div class="modal-content">
                     
                      <div class="modal-body">
                            <video width="100%" height="400" controls v-if="video">
                                <source :src="video">
                                {{trans('lang.browser_no_support')}}
                            </video>
                            <div v-else>
                                no video
                            </div>
                      </div>
                      <div class="modal-footer">
                       <button type="button" class="btn btn-light" data-dismiss="modal">{{trans('lang.close')}}</button>
                      </div>
                  </div>
                  <!--end modal-content-->
              </div>
              <!--end modal-dialog-->
          </div>
          <!--end modal-->


            <div class="auto-container">
                <div class="sec-title">
                    <!-- <h5>Hot Property</h5> -->
                    <h2 class="pb-30">{{trans('lang.recently_added')}}</h2>
                </div>
     <carousel :per-page="1" :mouse-drag="false" :navigationEnabled="true" :paginationEnabled="false">
     <slide  v-for="ad,index in ads" :key="index">
                        <recent-ad-block :ad="ad"></recent-ad-block>
                 </slide>
                 </carousel>

                    </div>
         
                    
               
        </section>
        <!-- deals-section end -->
                    
</template>

<script>
import Loading from './Loading.vue';
import { Carousel, Slide } from 'vue-carousel';
import FavoriteButton from './FavoriteButton.vue';
import RecentAdBlock from './RecentAdBlock.vue';

export default {
    mounted() {
        this.get_recent_featured();
    },
    data() {
        return {
            loading:false,
            ads: [],
            video:'',
            item_title:'',
            item_desc:''
        };
    },
    methods: {
        
        get_recent_featured() {
            this.loading = true;
            axios.get("/api/get_recent_feartured")
                .then((resp) => {
                this.ads = resp.data.data;
                this.loading = false;
            });
        },
        newModal(video){
            // $('#modalID').modal('show')
            this.video=video
        },
        
       
    },
    components: { Loading, Carousel, Slide, FavoriteButton, RecentAdBlock }
}
</script>



