<template>
    <div class="vue-content">

         <!-- Create / Update Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
              <div class="modal-dialog modal-xl modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel"> {{trans('lang.advertisements')}} </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form @submit.prevent="editMode?update():create()">
                              <div class="row">
                        <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userimage" class="form-label">{{trans('lang.image')}}</label>
                            <div class="input-group">
                            <input type="file" @change="upload" class="form-control" id="inputGroupFile02">
                     <button v-if="form.image=='' && !image_loading" class="btn btn-outline-success" @click="upload_ad_image()" :disabled="!ad_image" type="button" id="inputGroupFileAddon04">{{trans('lang.upload')}}</button>
                     <button v-else-if="image_loading" class="btn btn-outline-success"  type="button" >
                        <Waiting></Waiting>
                    </button>
                     <button v-else class="btn btn-outline-danger" @click="remove_ad_image()" :disabled="!form.image" type="button" id="inputGroupFileAddon04">{{trans('lang.remove')}}</button>
                               
                        </div>
                            <div class="text-danger" v-if="form.errors.has('image')" v-html="form.errors.get('image')" />
                            <div class="text-danger" v-if="ad_image_error" v-html="ad_image_error" />
                        </div>
                        <div class="mb-3">
                            <div class="img-preview" v-if="form.image!=''">
                                <img :src="form.image" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userimage" class="form-label">{{trans('lang.video')}}</label>
                            <div class="input-group">
                            <input type="file" @change="upload_video" class="form-control" id="inputGroupFile02">
                     <button v-if="form.video=='' && !video_loading" class="btn btn-outline-success" @click="upload_ad_video()" :disabled="!ad_video" type="button" id="inputGroupFileAddon04">{{trans('lang.upload')}}</button>
                     <button v-else-if="video_loading" class="btn btn-outline-success"  type="button" >
                        <Waiting></Waiting>
                    </button>
                     <button v-else class="btn btn-outline-danger" @click="remove_ad_video()" :disabled="!form.video" type="button" id="inputGroupFileAddon04">{{trans('lang.remove')}}</button>
                               
                        </div>
                            <div class="text-danger" v-if="form.errors.has('video')" v-html="form.errors.get('video')" />
                            <div class="text-danger" v-if="ad_video_error" v-html="ad_video_error" />
                        </div>
                        <div class="mb-3">
                            <div class="img-preview" v-if="form.video!=''">
                                <video width="320" height="240" controls>
                                <source :src="form.video">
                                {{trans('lang.browser_no_support')}}
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                     <div class="mb-3">
                                <label class="form-label">  {{trans('lang.user')}}</label>
                                <v-select :disabled="editMode" @input="check_order"   v-model="form.user_id" :options="users" :reduce="user => user.id" label="name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('user_id')" v-html="form.errors.get('user_id')" />
                            </div>                  
                    </div>
                    <div class="col-lg-4">
                     <div class="mb-3">
                                <label class="form-label">{{trans('lang.check_package')}}</label>
                                <div class="alert alert-danger" v-if="form.user_id && order=='' && !checkuser_loading">this user doesn't subscribe in any package</div>
                                <div class="alert alert-success" v-else-if="form.user_id && order!='' && !checkuser_loading">checked successfully</div>
                                <div class="text-primary" v-else-if="checkuser_loading"> checking ..... </div>
                                <div class="alert alert-warning" v-else>select user to check </div>
                                <div class="text-danger" v-if="form.errors.has('order_id')" v-html="form.errors.get('order_id')" />
                            </div>                  
                    </div>
                    
                    <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.project_name')}}</label>
                                <input type="text"  :class="{ 'is-invalid': form.errors.has('project_title') } " v-model="form.project_title"  class="form-control" >
                                    <div class="text-danger" v-if="form.errors.has('project_title')" v-html="form.errors.get('project_title')" />
                            </div>
                   
                    </div>
                    <div class="col-12 row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.city')}} </label>
                                <v-select  @input="get_cities" v-model="form.state_id" :options="states" :reduce="state => state.id" label="lang_name"></v-select>
                                <div class="text-danger" v-if="form.errors.has('state_id')" v-html="form.errors.get('state_id')" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.state')}}</label>
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
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.address')}} </label>
                                <input type="text"  :class="{ 'is-invalid': form.errors.has('address') } " v-model="form.address"  class="form-control" >
                                    <div class="text-danger" v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-12 row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.description')}}</label>
                                <textarea rows="10" v-model="form.desc_original" :class="{ 'is-invalid': form.errors.has('desc_original') }" class="form-control"  raws="10"></textarea>
                                <div class="text-danger" v-if="form.errors.has('desc_original')" v-html="form.errors.get('desc_original')" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.ad_title')}}</label>
                                <input type="text"  :class="{ 'is-invalid': form.errors.has('title_original') } " v-model="form.title_original"  class="form-control" >
                                <div class="text-danger" v-if="form.errors.has('title_original')" v-html="form.errors.get('title_original')" />
                            </div>
                            <div class="row mb-3 ">
                                <div class="col-12 mb-3 ">
                                <label class="form-label">{{trans('lang.ad_category')}}</label>
                                <v-select v-model="form.category_id" :options="cats" :reduce="cat => cat.id" label="item"></v-select>
                                <div class="text-danger" v-if="form.errors.has('category_id')" v-html="form.errors.get('category_id')" />
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
                            <v-select   v-model="form.appart_model" :options="models" :reduce="model => model.name_en" label="name"></v-select>
                            <div class="text-danger" v-if="form.errors.has('appart_model')" v-html="form.errors.get('appart_model')" />
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.floor_arrang')}}</label>
                                <input type="number" min="0" v-model="form.floor_number" :class="{ 'is-invalid': form.errors.has('floor_number') }" class="form-control">
                                <div class="text-danger" v-if="form.errors.has('floor_number')" v-html="form.errors.get('floor_number')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.status')}}</label>
                                <v-select v-model="form.status" :options="statuses" ></v-select>
                                <div class="text-danger" v-if="form.errors.has('status')" v-html="form.errors.get('status')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.shown')}}</label>
                                <v-select v-model="form.shown" :options="showns" ></v-select>
                                <div class="text-danger" v-if="form.errors.has('shown')" v-html="form.errors.get('shown')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{trans('lang.type')}}</label>
                                <v-select v-model="form.type" :options="['buy','rent']" ></v-select>
                                <div class="text-danger" v-if="form.errors.has('type')" v-html="form.errors.get('type')" />
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 mt-20 justify-content-end">
                       
                        <div class="col-12">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{trans('lang.close')}}</button>
                            <button v-if="!loading" :disabled="video_loading || image_loading" class="btn btn-success" type="submit">
                                Submit
                            </button>
                            <button v-else disabled class="btn btn-success" type="submit">
                                <Waiting></Waiting>
                            </button>
                        </div>
                    </div>
                </div>
                          </form>
                      </div>
                  </div>
                  <!--end modal-content-->
              </div>
              <!--end modal-dialog-->
          </div>
          <!--end modal-->

<!-- Delete modal -->
    <div id="deleteModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div> <i class="ri-alert-line me-3 align-middle fs-100 text-danger"></i> </div>
                <div class="mt-4">
                    <h4 class="mb-3">{{trans('lang.delete_msg')}} </h4>
                    <p class="text-muted mb-4">{{trans('lang.assuring')}}</p>
                    <div class="hstack gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{trans('lang.close')}}</button>
                        <a @click="del()" href="javascript:void(0);" class="btn btn-danger">{{trans('lang.delete')}}</a>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

      
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="search-box">
                            <input v-model="form_filter.search"  type="text" class="form-control" :placeholder="trans('admin.ad_search')">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <v-select :placeholder="trans('admin.select_city')"  @input="get_cities" v-model="form_filter.state_id" :options="states" :reduce="state => state.id" label="lang_name"></v-select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <v-select :placeholder="trans('admin.select_state')"   @input="get_regions" v-model="form_filter.city_id" :options="cities" :reduce="city => city.id" label="lang_name"></v-select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <v-select :placeholder="trans('admin.select_region')"  @input="get_neighbors" v-model="form_filter.region_id" :options="regions" :reduce="region => region.id" label="lang_name"></v-select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <v-select :placeholder="trans('admin.select_neighbor')" v-model="form_filter.neighbor_id" :options="neighbors" :reduce="neighbor => neighbor.id" label="lang_name"></v-select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <v-select :placeholder="trans('admin.status')" v-model="form_filter.status" :options="statuses" ></v-select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <v-select :placeholder="trans('admin.shown')" v-model="form_filter.shown" :options="showns" ></v-select>
                            </div>
                        </div>
                       <div class="col-sm-auto ms-auto">
                        <div class="list-grid-nav hstack gap-1">
                            <button class="btn btn-primary" @click="filter()" ><i class="ri-search-2-line me-1 align-bottom"></i> {{trans('lang.filter')}}</button>
                            <button class="btn btn-warning" @click="clear()" ><i class="ri-chat-delete-line me-1 align-bottom"></i>{{trans('lang.clear')}}</button>
                            <button class="btn btn-success" @click="newModal()" data-bs-toggle="modal" data-bs-target="#modalID"><i class="ri-add-fill me-1 align-bottom"></i> {{trans('lang.new')}}</button>
                        </div>
                    </div>
                       
                    </div>
              
            </div>
        </div>

        <div class="row" v-show="!$root.loading">
            <div class="col-lg-12">
                <div class="table-responsive table-card">
    <table class="table table-nowrap mb-0">
        <thead class="table-light">
            <tr>
               
                <th scope="col">{{trans('lang.id')}}</th>
                <th scope="col">{{trans('lang.title')}}</th>
                <th scope="col">{{trans('lang.user')}}</th>
                <th scope="col">{{trans('lang.category')}}</th>
                <th scope="col">{{trans('lang.status')}}</th>
                <th scope="col">{{trans('lang.shown')}}</th>
                <th scope="col">{{trans('lang.options')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item,index in tableData.data" :key="index">
              
                <td><a href="#" class="fw-semibold"># {{item.id}} </a></td>
                <td>{{item.item_title}}</td>
                <td>{{item.user.name}}</td>
                <td>{{item.category.item}}</td>

                <td>  
                    <div class="badge badge-label bg-success" v-if="item.status=='active'"> {{item.status}} </div> 
                    <div class="badge badge-label bg-warning" v-else-if="item.status=='pending'"> {{item.status}} </div> 
                    <div class="badge badge-label bg-danger" v-else-if="item.status=='finished'"> {{item.status}} </div> 
                </td>
                <td>  
                    <div class="badge badge-label bg-primary" v-if="item.shown=='shown'"> {{item.shown}} </div> 
                    <div class="badge badge-label bg-dark" v-else-if="item.shown=='hidden'"> {{item.shown}} </div> 
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-light">
                        <a class="btn btn-sm btn-secondary edit-item-btn" :href="'/admin/view_advertisement/'+item.slug"><i class="ri-eye-fill  align-middle"></i></a>
                        <a @click="editModal(item)" data-bs-toggle="modal" data-bs-target="#modalID" class="btn btn-sm btn-primary edit-item-btn" href="javascript:void(0);"><i class="ri-edit-fill  align-middle"></i></a>
                        <a @click="delModal(item)" class="btn btn-sm btn-danger remove-item-btn" href="javascript:void(0);"><i class="ri-delete-bin-5-line  align-middle"></i></a>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class=" pt-4 pagination-card">
        <pagination :data="tableData" @pagination-change-page="getResults"></pagination>
    </div>
</div>
            </div><!-- end col -->
        </div>
        <!--end row-->
        <div class="row" v-show="$root.loading"> 
            <!-- Border spinner -->
            <div class="spinner-border text-primary custom-spinner" role="status">
                <span class="sr-only">Loading...</span>
            </div>    
         </div>
    </div>
</template>

<script>

export default {

    mounted(){
        
        Fire.$on('Load',()=>{
            this.getData()
        })
         this.getData()
        this.get_currencies();
        this.get_cats();
        this.get_appart_models();
        this.get_users();
    },
    props:['admin'],
    data(){
        return {
            form :new Form({
                id: "",
                project_title: "",
                state_id: "",
                city_id: "",
                region_id: "",
                neighbor_id: "",
                category_id: "",
                user_id: "",
                order_id: "",
                image: "",
                video: "",
                title_original:"",
                address: "",
                title: "",
                currency: "",
                price: "",
                desc_original: "",
                whatsapp: "",
                area: "",
                appart_model: "",
                floor_number: "",
                lat: 0,
                lng: 0,
                status:'active',
                shown:'shown',
                type:'',

            }),
            form_filter:new Form({
                seacrh:'',
                state_id:'',
                city_id:'',
                region_id:'',
                neighbor_id:'',
                status:'',
                shown:'',
            }),
            statuses:['active','pending','refused'],
            showns:['shown','hidden'],
            loading:false,
            image_loading:false,
            video_loading:false,
            checkuser_loading:false,
            ad_image:'',
            ad_video:'',
            ad_image_error:'',
            ad_video_error:'',
            item:{},
            editMode:false,
            tableData:{},
            states:[],
            cities:[],
            regions:[],
            neighbors:[],
            models:[],
            currencies:[],
            cats:[],
            users:[],
            packages:[],
            order:'',
        }
    },
    methods:{
        getData(){
            this.$root.loading=true
            axios.get('/admin/admin_api/ads')
                 .then((resp)=>{
                     this.tableData=resp.data
                              this.get_states();
                     this.$root.loading=false
                 })
        },
          
        newModal(){
          this.form.reset()
            this.editMode=false
        },
        editModal(data){
            this.editMode=true
            this.form.fill(data)
            this.check_order()
            this.get_cities('edit')
            this.get_regions('edit')
            this.get_neighbors('edit')
        },
        delModal(item){
            this.item=item
            $('#deleteModal').modal('show')
        },
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
            axios.post('/admin/admin_api/upload_ad_image',formdata)
                 .then((resp)=>{
                    if(resp.data.errors){
                        this.ad_image_error=resp.data.errors.image
                        this.image_loading=false
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
            axios.post('/admin/admin_api/upload_ad_video',formdata)
                 .then((resp)=>{
                    if(resp.data.errors){
                        this.ad_video_error=resp.data.errors.video
                        this.video_loading=false
                    }else{
                        this.form.video=resp.data
                        this.ad_video=''
                        this.video_loading=false
                    }
                 })
        },
        remove_ad_image(){
            this.form.image=''
        },
        remove_ad_video(){
            this.form.video=''
        },
        get_users() {
            axios.get("/admin/admin_api/get_users")
                .then((resp) => {
                this.users = resp.data;
            });
        },
        check_order() {
            this.checkuser_loading=true
            axios.get("/admin/admin_api/get_order/"+this.form.user_id)
                .then((resp) => {
                    this.checkuser_loading=false
                this.order = resp.data;
                if(this.order!=''){
                    this.form.order_id=this.order.id
                }
            });
        },
        filter(){
            this.$root.loading=true
            this.form_filter.post('/admin/admin_api/filter_ads')
            .then((resp)=>{
                this.tableData=resp.data
                this.$root.loading=false
                })
        },
        clear(){
            this.form_filter.reset()
            this.getData()
        },
        get_states() {
            axios.get("/admin/admin_api/get_states")
                .then((resp) => {
                this.states = resp.data;
            });
        },
        get_cities(type='') {
            axios.get("/admin/admin_api/get_cities/" + this.form.state_id)
                .then((resp) => {
                    if(type==''){
                        this.form.city_id = "";
                        this.form.region_id = "";
                        this.form.neighbor_id = "";
                        this.regions = [];
                    }
                this.cities = resp.data;
            });
        },
        get_regions(type='') {
            axios.get("/admin/admin_api/get_regions/" + this.form.city_id)
                .then((resp) => {
                    if(type==''){
                        this.form.region_id = "";
                        this.form.neighbor_id = "";
                        this.neighbors = [];
                    }
                this.regions = resp.data;
            });
        },
        get_neighbors() {
            axios.get("/admin/admin_api/get_neighbors/" + this.form.region_id)
                .then((resp) => {
                if (resp.data == "") {
                    this.form.neighbor_id = "";
                }
                this.neighbors = resp.data;
            });
        },
        get_regions() {
            axios.get("/admin/admin_api/get_regions/" + this.form.city_id)
                .then((resp) => {
                if (resp.data == "") {
                    this.form.region_id = "";
                }
                this.regions = resp.data;
            });
        },
        get_currencies() {
            axios.get("/admin/admin_api/get_currencies")
                .then((resp) => {
                this.currencies = resp.data;
            });
        },
        get_cats() {
            axios.get("/admin/admin_api/get_categories")
                .then((resp) => {
                this.cats = resp.data;
            });
        },
        get_appart_models() {
            axios.get("/admin/admin_api/get_appart_models")
                .then((resp) => {
                this.models = resp.data;
            });
        },
        create(){
            this.loading=true
            this.form.post('/admin/admin_api/ads')
                .then((resp)=>{
                    this.loading=true
                    Fire.$emit('Load')
                    //alert
                    var element = document.getElementById("createdAlert");
                    element.classList.add("show");
                    setTimeout(() => {
                        element.classList.remove('show')
                    }, 3000);
                    //end alert
                    $('#modalID').modal('hide')
                })
        },
      
        update(){
            this.form.put('/admin/admin_api/ads/'+this.form.id)
                .then(()=>{
                    Fire.$emit('Load')
                    //alert
                    var element = document.getElementById("updatedAlert");
                    element.classList.add("show");
                    setTimeout(() => {
                        element.classList.remove('show')
                    }, 3000);
                    //end alert
                    this.form.reset()
                    $('#modalID').modal('hide')
                })
        },
        del(){
          this.form.delete('/admin/admin_api/ads/'+this.item.id)
                        .then(()=>{ 
                         Fire.$emit('Load');
                         $('#deleteModal').modal('hide')
                         //alert
                        var element = document.getElementById("deletedAlert");
                        element.classList.add("show");
                        setTimeout(() => {
                            element.classList.remove('show')
                        }, 3000);
                        //end alert
                        }).catch(()=>{
                            
                         })
        },
         getResults(page = 1) {

            axios.get('/admin/admin_api/ads?page=' + page)
                .then(({data}) => (
                    this.tableData = data
                ))
        },
        searching(){
               let query=this.$root.search;
                this.$root.loading=true
              if(query.length != 0){                
              axios.get('/admin/admin_api/ads/search/'+query)
                        .then((response)=>{  
                        this.tableData=response.data 
                        this.$root.loading=false
                })
              }else{
                this.getData();
                this.$root.loading=false
              }
           }, 
    }
}
</script>