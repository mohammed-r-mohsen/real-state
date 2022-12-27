<template>
  
    <div class="home-parent">

      


        <!-- property-page-section -->
        <section class="property-page-section property-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'account'"></sidebar>

                    <div class="col-md-9  col-sm-12 content-side">
                        
                        <!-- agent-details -->
                <div class="agents-block-one" v-if="$root.user">
                        <div class="inner-box mr-0">
                            <figure class="image-box">
                                <ImgElement :src="$root.user.avatar"></ImgElement>
                            </figure>
                            <div class="content-box">
                                <div class="upper clearfix">
                                    <div class="title-inner pull-left">
                                        <h4>{{$root.user.name}}</h4>
                                        <span class="designation">
                                            {{$root.user_type()}}
                                        </span>
                                    </div>
                                    <ul class="pull-right clearfix">
                                        <li v-if="$root.user.is_provider==1"><router-link class="theme-btn link-btn " :to="'/add_advertisement/4'"><span> + </span> {{trans('lang.create_ad')}}</router-link></li>
                                        <li v-else><router-link class="theme-btn link-btn " :to="'/add_advertisement/4'"><span> + </span> Create Your First Ad </router-link></li>
                                    </ul>
                                </div>
                                <div class="text">
                                    <p v-if="$root.user.address">
                                      <i class="ri-map-pin-line"></i> {{$root.user.address}}
                                    </p>
                                </div>
                                <ul class="info clearfix mr-0">
                                    <li><i class="ri-mail-line"></i>{{$root.user.email}}</li>
                                    <li v-if="$root.user.phone"><i class="ri-phone-line"></i>{{$root.user.phone}}</li>
                                    <li v-if="$root.user.whatsapp"><i class="ri-whatsapp-line"></i>{{$root.user.whatsapp}}</li>
                                </ul>
                                <div class="mt-20">
                                    <router-link class="theme-btn btn-one btn-sm " :to="{'name':'change_password'}"><i class="ri-lock-line"> </i> {{trans('lang.change_password')}} </router-link>
                                    <router-link  to="/edit_profile" class="theme-btn btn-one btn-sm"><i class="ri-edit-box-line"></i> {{trans('lang.edit_profile')}} </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="agents-block-one" v-else>
                        <Loading :lines="3"></Loading>
                    </div>
        <!-- agent-details end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';
import ImgElement from './Elements/ImgElement.vue';
import All_STATES from './Files/get_states.json'
import All_CITIES from './Files/get_cities.json'
import All_REGIONS from './Files/get_regions.json'
import All_NEIGHBORS from './Files/get_neighbors.json'
    export default {
    mounted() {
        this.$root.check_auth();
        // vue js code
    //    this.add_state()
    //    this.add_city()
    //    this.add_region()
    //    this.add_neighbor()
    },
    data() {
        return {
            form: new Form({
                id: "",
                name_en:'',
                name_tr:'',
                name_ar:'',
                country_id:2,
            }),
            form_city: new Form({
                id: "",
                name_en:'',
                name_tr:'',
                name_ar:'',
                state_id:'',
            }),
            form_region: new Form({
                id: "",
                name_en:'',
                name_tr:'',
                name_ar:'',
                city_id:'',
            }),
            form_neighbor: new Form({
                id: "",
                name_en:'',
                name_tr:'',
                name_ar:'',
                region_id:'',
            }),
            states:All_STATES,
            cities:All_CITIES,
            regions:All_REGIONS,
            neighbors:All_NEIGHBORS,

        };
    },
    methods: {
        add_state(){
            setTimeout(() => {
                this.states.forEach(element => {
                    this.form.fill(element)
                    
                    this.form.post('/admin/admin_api/add_state')
                        .then((resp)=>{
                            console.log(resp.data)
                            
                        })
                });
            }, 1000);
        },
        add_city(){
            setTimeout(() => {
                this.cities.forEach(element => {
                    this.form_city.fill(element)
                    this.form_city.post('/admin/admin_api/add_city')
                        .then((resp)=>{
                            console.log(resp.data)
                        })
                });
            }, 1000);
        },
        add_region(){
            setTimeout(() => {
                this.regions.forEach(element => {
                    this.form_region.fill(element)
                    this.form_region.post('/admin/admin_api/add_region')
                        .then((resp)=>{
                            console.log(resp.data)
                        })
                });
            }, 1000);
        },
        add_neighbor(){
            setTimeout(() => {
                this.neighbors.forEach(element => {
                    this.form_neighbor.fill(element)
                    this.form_neighbor.post('/admin/admin_api/add_neighbor')
                        .then((resp)=>{
                            console.log(resp.data)
                        })
                });
            }, 1000);
        },
    },
    components: { Loading, ImgElement }
}
</script>