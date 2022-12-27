<template>

                <div class="inner-box default-form final-section">
                    <!-- Create / Update Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel"> {{trans('lang.location')}} </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                           <GmapMap ref="mapRef"
                                :center="myCoordinates"
                                :zoom="7"
                                style="width:100%; height: 300px"
                                >
                                </GmapMap>
                      </div>
                      <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('lang.close')}}</button>
                        <button type="button" @click="save_location()" class="btn btn-primary">{{trans('lang.save_location')}}</button>
                    </div>
                  </div>
                  <!--end modal-content-->
              </div>
              <!--end modal-dialog-->
          </div>
          <!--end modal-->
           <form @submit.prevent="!editMode?create():update()" v-if="editMode && ad!='' && ad.status=='active'">
                    <div class="row">
                        <div class="col-6">
                                <label class="form-label"> {{trans('lang.currency')}}</label>
                                <v-select   v-model="form.currency" :options="currencies" :reduce="currency => currency.sympol" label="sympol"></v-select>
                                <div class="text-danger" v-if="form.errors.has('currency')" v-html="form.errors.get('currency')" />
                                </div>
                                <div class="col-6">
                                <label class="form-label"> {{trans('lang.price')}}</label>
                                <input  :class="{ 'is-invalid': form.errors.has('price') } " v-model="form.price" type="number" min="0" step="0.1" class="form-control" >
                                    <div class="text-danger" v-if="form.errors.has('price')" v-html="form.errors.get('price')" />
                                </div>
                                <div class="row col-12 mt-20">
                        <div class="col-6">
                            
                        </div>
                        <div class="col-6">
                            <button v-if="!loading" :disabled="image_loading || video_loading" class="theme-btn btn-one  pull-right" type="submit">
                                {{trans('lang.submit')}} 
                            </button>
                            <button v-else disabled class="theme-btn btn-one  pull-right" type="submit">
                                <Waiting></Waiting>
                            </button>
                        </div>
                    </div>
                    </div>
            </form>
                    <form @submit.prevent="!editMode?create():update()" v-else>
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userimage" class="form-label">{{trans('lang.main_image')}}</label>
                            <div class="gallery-box">
                            <div class="upload-inner sm centred" v-if="!form.image">
                                <i class="ri-file-upload-line"></i>
                                <div class="upload-box">
                                    <input v-if="!ad_image" @change="upload" type="file" id="check1">
                                    <label v-if="!ad_image" for="check1">{{trans('lang.click_here')}}</label>  
                                </div>
                            </div>
                            <div class="upload-inner sm centred" v-else>
                                
                                <div class="upload-box preview">
                                   <img  :src="form.image">
                                </div>
                            </div>
                        </div>
                            <div class="upload-btns">
                            <button v-if="ad_image" @click="upload_ad_image" :disabled="image_loading" type="button" class="btn btn-primary btn-sm">{{trans('lang.save')}}</button>
                            <button v-else-if="form.image" @click="remove_ad_image"   type="button" class="btn btn-danger btn-sm">{{trans('lang.delete')}}</button>
                            </div>
                            <div class="text-danger" v-if="form.errors.has('image')" v-html="form.errors.get('image')" />
                            <div class="text-danger" v-if="ad_image_error" v-html="ad_image_error[0]" />
                        </div>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userimage" class="form-label">{{trans('lang.video')}}</label>
                            <div class="gallery-box">
                            <div class="upload-inner sm centred" v-if="!form.video">
                                <i class="ri-file-upload-line"></i>
                                <div class="upload-box">
                                    <input v-if="!ad_video" @change="upload_video" type="file" id="check2">
                                    <label v-if="!ad_video" for="check2">{{trans('lang.click_here')}}</label>  
                                </div>
                            </div>
                            <div class="upload-inner sm centred" v-else>
                                
                                <div class="upload-box preview">
                                  <video width="100%" height="100%" controls>
                                <source :src="form.video">
                                {{trans('lang.browser_no_support')}}
                                </video>
                                </div>
                            </div>
                        </div>
                            <div class="upload-btns">
                            <button v-if="ad_video" @click="upload_ad_video" :disabled="video_loading" type="button" class="btn btn-primary btn-sm">{{trans('lang.save')}}</button>
                            <button v-else-if="form.video" @click="remove_ad_video"   type="button" class="btn btn-danger btn-sm">{{trans('lang.delete')}}</button>
                            </div>
                            <div class="text-danger" v-if="form.errors.has('video')" v-html="form.errors.get('video')" />
                            <div class="text-danger" v-if="ad_video_error" v-html="ad_video_error[0]" />
                        </div>
                        
                    </div>
                    <div class="col-lg-12">
                        <Files></Files>
                    </div>
                    <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.ad_title')}}</label>
                                <input type="text"  :class="{ 'is-invalid': form.errors.has('title_original') } " v-model="form.title_original"  class="form-control" >
                                <div class="text-danger" v-if="form.errors.has('title_original')" v-html="form.errors.get('title_original')" />
                            </div>
                    </div>
                    <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.project_name')}}</label>
                                <input type="text"  :class="{ 'is-invalid': form.errors.has('project_title') } " v-model="form.project_title"  class="form-control" >
                                    <div class="text-danger" v-if="form.errors.has('project_title')" v-html="form.errors.get('project_title')" />
                            </div> 
                    </div>
                    <div class="col-12 row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.city')}}</label>
                                <v-select  @input="get_cities" v-model="form.state_id" :options="states" :reduce="state => state.id" label="lang_name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('state_id')" v-html="form.errors.get('state_id')" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.state')}} </label>
                                <v-select  @input="get_regions" v-model="form.city_id" :options="cities" :reduce="city => city.id" label="lang_name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('city_id')" v-html="form.errors.get('city_id')" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.region')}}</label>
                                <v-select  @input="get_neighbors" v-model="form.region_id" :options="regions" :reduce="region => region.id" label="lang_name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('region_id')" v-html="form.errors.get('region_id')" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.neighbor')}}</label>
                                <v-select  v-model="form.neighbor_id" :options="neighbors" :reduce="neighbor => neighbor.id" label="lang_name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('neighbor_id')" v-html="form.errors.get('neighbor_id')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.address')}} </label>
                                <input type="text"  :class="{ 'is-invalid': form.errors.has('address') } " v-model="form.address"  class="form-control" >
                                    <div class="text-danger" v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{trans('lang.location')}}</label>
                            <div class="mb-3">
                                <button type="button" @click="new_modal()" data-toggle="modal" data-target="#modalID" class="theme-btn btn-two"> {{trans('lang.address_in_map')}} </button>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.description')}}</label>
                                <textarea v-model="form.desc_original" :class="{ 'is-invalid': form.errors.has('desc_original') }" class="form-control"  raws="10"></textarea>
                                <div class="text-danger" v-if="form.errors.has('desc_original')" v-html="form.errors.get('desc_original')" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            
                            <div class="row mb-3 ">
                                <div class="col-6 mb-3 ">
                                <label class="form-label">{{trans('lang.ad_category')}}</label>
                                <v-select v-model="form.category_id" :options="cats" :reduce="cat => cat.id" label="lang_name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('category_id')" v-html="form.errors.get('category_id')" />
                                </div>
                                <div class="col-6 mb-3 ">
                                <label class="form-label">{{trans('lang.type')}}</label>
                                <v-select v-model="form.type" :options="types" :reduce="type => type.value" label="name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('type')" v-html="form.errors.get('type')" />
                                </div>
                                <div class="col-6">
                                <label class="form-label"> {{trans('lang.currency')}}</label>
                                <v-select   v-model="form.currency" :options="currencies" :reduce="currency => currency.sympol" label="sympol"></v-select>
                                <div class="text-danger" v-if="form.errors.has('currency')" v-html="form.errors.get('currency')" />
                                </div>
                                <div class="col-6">
                                <label class="form-label"> {{trans('lang.price')}}</label>
                                <input  :class="{ 'is-invalid': form.errors.has('price') } " v-model="form.price" type="number" min="0" step="0.1" class="form-control" >
                                           <div class="text-danger" v-if="form.errors.has('price')" v-html="form.errors.get('price')" />
                                </div>
                            </div>
                        </div>         
                    </div>
                    <div class="col-12 row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.whatsapp')}}</label>
                                <input  type="text" v-model="form.whatsapp" :class="{ 'is-invalid': form.errors.has('whatsapp') }" class="form-control">
                                <div class="text-danger" v-if="form.errors.has('whatsapp')" v-html="form.errors.get('whatsapp')" />
                            </div>
                        </div>
                       
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.area')}}</label>
                                <input type="number" step="0.1" min="1" v-model="form.area" :class="{ 'is-invalid': form.errors.has('area') }" class="form-control">
                                <div class="text-danger" v-if="form.errors.has('area')" v-html="form.errors.get('area')" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"> {{trans('lang.appart_model')}}</label>
                            <v-select   v-model="form.appart_model" :options="models" :reduce="model => model.name" label="name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('appart_model')" v-html="form.errors.get('appart_model')" />
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.floor_arrang')}}</label>
                                <v-select   v-model="form.floor_number_id" :options="floorNumbers" :reduce="floorNumber => floorNumber.id" label="lang_name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('floor_number_id')" v-html="form.errors.get('floor_number_id')" />
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label"> {{trans('lang.floor_count')}}</label>
                            <input type="number" min="0" v-model="form.floor_count" :class="{ 'is-invalid': form.errors.has('floor_count') }" class="form-control">
                            <div class="text-danger" v-if="form.errors.has('floor_count')" v-html="form.errors.get('floor_count')" />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label"> {{trans('lang.building_age')}}</label>
                            <v-select   v-model="form.building_age" :options="ages" :reduce="age => age.name" label="name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('building_age')" v-html="form.errors.get('building_age')" />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label"> {{trans('lang.heating')}}</label>
                            <v-select   v-model="form.heating_id" :options="heatings" :reduce="heating => heating.id" label="lang_name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('heating_id')" v-html="form.errors.get('heating_id')" />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label"> {{trans('lang.title_deed')}}</label>
                            <v-select   v-model="form.title_deed_id" :options="titleDeeds" :reduce="titleDeed => titleDeed.id" label="lang_name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('title_deed_id')" v-html="form.errors.get('title_deed_id')" />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label"> {{trans('lang.bathroom')}}</label>
                            <input type="number" min="0" v-model="form.bathroom" :class="{ 'is-invalid': form.errors.has('bathroom') }" class="form-control">
                            <div class="text-danger" v-if="form.errors.has('bathroom')" v-html="form.errors.get('bathroom')" />
                        </div>
                        <div class="col-md-3 mb-3 ">
                            <label class="form-label">{{trans('lang.balacony')}}</label>
                            <v-select v-model="form.balacony" :options="TrueFalse" :reduce="truefals => truefals.value" label="name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('balacony')" v-html="form.errors.get('balacony')" />
                        </div>
                        <div class="col-md-3 mb-3 ">
                            <label class="form-label">{{trans('lang.furnished')}}</label>
                            <v-select v-model="form.furnished" :options="TrueFalse" :reduce="truefals => truefals.value" label="name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('furnished')" v-html="form.errors.get('furnished')" />
                        </div>
                        <div class="col-md-3 mb-3 ">
                            <label class="form-label">{{trans('lang.available_for_loan')}}</label>
                            <v-select v-model="form.available_for_loan" :options="TrueFalse" :reduce="truefals => truefals.value" label="name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('available_for_loan')" v-html="form.errors.get('available_for_loan')" />
                        </div>



                    </div>
                    <div class="row col-12 mt-20">
                        <div class="col-6">
                            
                        </div>
                        <div class="col-6">
                            <button v-if="!loading" :disabled="image_loading || video_loading" class="theme-btn btn-one  pull-right" type="submit">
                                {{trans('lang.submit_for_review')}} 
                            </button>
                            <button v-else disabled class="theme-btn btn-one  pull-right" type="submit">
                                <Waiting></Waiting>
                            </button>
                        </div>
                    </div>
                </div>
                     </form>
           
                </div>
           
</template>

<script>

import Waiting from './Waiting.vue'
import Files from './Files.vue'
export default {
    mounted() {
        this.get_states();
        this.get_currencies();
        this.get_cats();
        this.get_appart_models();
        this.get_building_ages();
        this.get_floor_numbers();
        this.get_heatings();
        this.get_title_deeds();
        this.$refs.mapRef.$mapPromise.then(map => this.map = map);
        if(this.ad!=''){
            this.form.fill(this.ad)
            this.get_cities2()
            this.get_regions2()
            this.get_neighbors()
        }
    },
    computed: {
        mapCoordinates() {
            if (!this.map) {
                return {
                    lat: 0,
                    lng: 0
                };
            }
            return {
                lat: this.map.getCenter().lat(),
                lng: this.map.getCenter().lng()
            };
        }
    },
    props:['editMode','ad'],
    data() {
        return {
            map: null,
            myCoordinates: {
                lat: 0,
                lng: 0,
            },
            loading: false,
            form: new Form({
                id: "",
                project_title: "",
                state_id: "",
                city_id: "",
                region_id: "",
                neighbor_id: "",
                category_id: "",
                user_id: "",
                image: "",
                video: "",
                title_original: "",
                address: "",
                currency: "",
                price: "",
                desc_original: "",
                whatsapp: "",
                area: "",
                appart_model: "",
                floor_number_id: "",
                lat: 0,
                lng: 0,
                type:'',
                balacony:'',
                furnished:'',
                available_for_loan:'',
                floor_count:'',
                heating_id:'',
                title_deed_id:'',
                building_age:'',
                bathroom:'',
                sliders:[]
            }),
            states: [],
            cities: [],
            regions: [],
            neighbors: [],
            currencies: [],
            cats: [],
            models: [],
            ages: [],
            floorNumbers: [],
            heatings: [],
            titleDeeds: [],
            types:[
                {'value':'buy','name':this.$root.trans('lang.buy')},
                {'value':'rent','name':this.$root.trans('lang.rent')},
                {'value':'daily_rent','name':this.$root.trans('lang.daily_rent')},
            ],
            TrueFalse:[
                {'value':0,'name':this.$root.trans('no')},
                {'value':1,'name':this.$root.trans('yes')},
            ],
        
            ad_image:'',
            video_image:'',
            image_loading:false,
            video_loading:false,
            ad_image:'',
            ad_video:'',
            ad_image_error:'',
            ad_video_error:'',
        };
    },
    methods: {
       upload(e){
          let file=e.target.files[0]
          this.ad_image=file
        },
        upload_video(e){
          let file=e.target.files[0]
          this.ad_video=file
        },
        upload_ad_image(){
            this.image_loading=true
            const formdata=new FormData
            formdata.append('image',this.ad_image)
            this.ad_image_error=''
            axios.post('/api/upload_ad_image',formdata)
                 .then((resp)=>{
                    if(resp.data.errors){
                        this.ad_image_error=resp.data.errors.image
                        this.image_loading=false
                        this.ad_image=''
                    }else{
                        this.form.image=resp.data
                        this.ad_image=''
                        this.image_loading=false
                    }
                 })
        },
        upload_ad_video(){
            this.video_loading=true
            const formdata=new FormData
            formdata.append('video',this.ad_video)
                        this.ad_video_error=''
            axios.post('/api/upload_ad_video',formdata)
                 .then((resp)=>{
                     if(resp.data.errors){
                        this.ad_video_error=resp.data.errors.video
                        this.video_loading=false
                        this.ad_video=''
                    }else{
                        this.form.video=resp.data
                        this.ad_video=''
                        this.video_loading=false
                    }
                 })
        },
        remove_ad_image(){
            axios.post('/api/remove_ad_image',{path:this.form.image})
                .then((resp)=>{
                    this.form.image=''
                })
        },
        remove_ad_video(){
            axios.post('/api/remove_ad_video',{path:this.form.video})
                .then((resp)=>{
                    this.form.video=''
                })
        },
        new_modal() {
            if(this.ad){
                this.myCoordinates.lat=this.ad.lat
                this.myCoordinates.lng=this.ad.lng
            }else{
                this.$getLocation()
                .then(coordinates => {
                    console.log(coordinates);
                    this.myCoordinates.lat=coordinates.lat
                this.myCoordinates.lng=coordinates.lng
                });
            }
            // $("#modalID").modal("show");
        },
        save_location() {
            // $("#modalID").modal("hide");
            this.form.lat = this.mapCoordinates.lat;
            this.form.lng = this.mapCoordinates.lng;
            $('#close').click()
        },
        get_states() {
            axios.get("/api/get_states")
                .then((resp) => {
                this.states = resp.data;
            });
        },
        get_cities() {
            axios.get("/api/get_cities/" + this.form.state_id)
                .then((resp) => {
                this.form.city_id = "";
                this.form.region_id = "";
                this.form.neighbor_id = "";
                this.regions = [];
                this.cities = resp.data;
            });
        },
        get_cities2() {
            axios.get("/api/get_cities/" + this.form.state_id)
                .then((resp) => {
                this.cities = resp.data;
            });
        },
        get_regions() {
            axios.get("/api/get_regions/" + this.form.city_id)
                .then((resp) => {
                this.form.region_id = "";
                this.form.neighbor_id = "";
                this.neighbors = [];
                this.regions = resp.data;
            });
        },
        get_regions2() {
            axios.get("/api/get_regions/" + this.form.city_id)
                .then((resp) => {
                this.regions = resp.data;
            });
        },
        get_neighbors() {
            axios.get("/api/get_neighbors/" + this.form.region_id)
                .then((resp) => {
                if (resp.data == "") {
                    this.form.neighbor_id = "";
                }
                this.neighbors = resp.data;
            });
        },
      
        
        get_currencies() {
            axios.get("/api/get_currencies")
                .then((resp) => {
                this.currencies = resp.data;
            });
        },
        get_cats() {
            axios.get("/api/get_categories")
                .then((resp) => {
                this.cats = resp.data;
            });
        },
        get_appart_models() {
            axios.get("/api/get_appart_models")
                .then((resp) => {
                this.models = resp.data;
            });
        },
        get_building_ages() {
            axios.get("/api/get_building_ages")
                .then((resp) => {
                this.ages = resp.data;
            });
        },
        get_floor_numbers() {
            axios.get("/api/get_floor_numbers")
                .then((resp) => {
                this.floorNumbers = resp.data;
            });
        },
        get_heatings() {
            axios.get("/api/get_heatings")
                .then((resp) => {
                this.heatings = resp.data;
            });
        },
        get_title_deeds() {
            axios.get("/api/get_title_deeds")
                .then((resp) => {
                this.titleDeeds = resp.data;
            });
        },
        create() {
            this.loading = true;
            this.form.user_id = this.$root.user.id;
            this.form.post("/api/create_advertisement")
                .then((resp) => {
                this.$router.push("/my_advertisements");
                this.loading = false;
                swal.fire({
                    title: this.$root.trans('lang.ad_added_successfully'),
                    text: this.$root.trans('lang.waiting_for_approval'),
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: this.$root.trans('lang.view_details'),
                }).then((result) => {
                    if (result.value) {
                        this.$router.push("/view_advertisement/"+resp.data.slug);
                    }
                });
            }).catch(() => {
                this.loading = false;
            });
        },
        update(){
            this.loading = true;
            this.form.user_id = this.$root.user.id;
            this.form.post("/api/update_advertisement")
            .then((resp) => {
                console.log(resp.data)
               this.$router.push("/my_advertisements");
                this.loading = false;
                if(this.ad.status=='active'){
                   this.$root.swal_push(this.$root.trans('ad_updated_successfully'),'',
                    this.$root.trans('lang.view_details'),"/view_advertisement/"+resp.data.slug)
                }else{
                   this.$root.swal_push(this.$root.trans('ad_updated_successfully'),this.$root.trans('lang.waiting_for_approval'),
                    this.$root.trans('lang.view_details'),"/view_advertisement/"+resp.data.slug)
                }
                
                
            }).catch(() => {
                this.loading = false;
            });
        }
    },
    components: { Waiting,Files }
}
</script>