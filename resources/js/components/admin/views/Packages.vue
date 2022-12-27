<template>
    <div class="vue-content">

         <!-- Create / Update Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel"> {{trans('lang.packages')}} </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form @submit.prevent="editMode?update():create()">
                              <div class="row">
                                <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label for="package_ads" class="form-label">{{trans('lang.ads_numbers')}}</label>
                                          <select id="package_ads" required class="form-select" v-model="form.ads_number" :class="{ 'is-invalid': form.errors.has('ads_number') } " >
                                                <option value=""> Select</option>
                                                <option v-for="ad_number,index in ads_numbers" :key="index" :value="ad_number.ads_number"> {{ad_number.ads_number}} </option>
                                                
                                            </select>
                                           <div class="text-danger" v-if="form.errors.has('ads_number')" v-html="form.errors.get('ads_number')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-4" v-for="i,index in this.name_count" :key="index">
                                      <div class="mb-3">
                                          <label for="teammembersName" class="form-label">{{trans('lang.name_'+name_count[index])}}</label>
                                          <input required :class="{ 'is-invalid': form.errors.has('name') } " v-model="form.name[name_count[index]]"  class="form-control" id="teammembersname_en" >
                                           <div class="text-danger" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                      </div>
                                  </div>
                                <div class="col-lg-3">
                                      <div class="mb-3">
                                          <label for="package_period" class="form-label">{{trans('lang.period')}}</label>
                                            <select id="package_period" required class="form-select" v-model="form.period" :class="{ 'is-invalid': form.errors.has('period') } " >
                                                <option value="1"> 1 month</option>
                                                <option value="3"> 3 months</option>
                                                <option value="6"> 6 months</option>
                                                <option value="12"> 1 Year</option>
                                            </select>
                                           <div class="text-danger" v-if="form.errors.has('period')" v-html="form.errors.get('period')" />
                                      </div>
                                  </div>
                                  
                                  <div class="col-lg-3">
                                      <div class="mb-3">
                                          <label for="package_price" class="form-label">{{trans('lang.price')}}</label>
                                          <input required :class="{ 'is-invalid': form.errors.has('price') } " v-model="form.price" type="number" min="0" step="0.1" class="form-control" id="package_price" >
                                           <div class="text-danger" v-if="form.errors.has('price')" v-html="form.errors.get('price')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-3">
                                      <div class="mb-3">
                                          <label for="package_currency" class="form-label">{{trans('lang.currency')}}</label>
                                          <v-select  v-model="form.currency" :options="currencies" :reduce="currency => currency.sympol" label="sympol"></v-select>
                                           <div class="text-danger" v-if="form.errors.has('currency')" v-html="form.errors.get('currency')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-3">
                                      <div class="mb-3">
                                          <label for="offer_price" class="form-label">{{trans('lang.offer_price')}}</label>
                                          <input :class="{ 'is-invalid': form.errors.has('offer_price') } " v-model="form.offer_price" type="number" min="0" step="0.1" class="form-control" id="offer_price">
                                           <div class="text-danger" v-if="form.errors.has('offer_price')" v-html="form.errors.get('offer_price')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12" v-for="ii,index2 in this.features_count" :key="index2">
                                      <div class="mb-3">
                                          <label for="teammembersName" class="form-label">{{trans('lang.features_'+features_count[index2])}}</label>
                                          <vue-editor v-model="form.features[features_count[index2]]"></vue-editor> 
                                           <div class="text-danger" v-if="form.errors.has('features')" v-html="form.errors.get('features')" />
                                      </div>
                                  </div>
                                  

                                  <div class="col-lg-12">
                                      <div class="hstack gap-2 justify-content-end">
                                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{trans('lang.close')}}</button>
                                          <button v-if="!editMode" type="submit" class="btn btn-success">{{trans('lang.create')}}</button>
                                          <button v-else type="submit" class="btn btn-success">{{trans('lang.update')}}</button>
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
                <div class="row g-2">
                    <div class="col-sm-4">
                        <div class="search-box">
                            <input v-model="$root.search" @keyup="searching()" type="text" class="form-control" :placeholder="trans('admin.search_data')">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-sm-auto ms-auto">
                        <div class="list-grid-nav hstack gap-1">
                            <button class="btn btn-success" @click="newModal()" data-bs-toggle="modal" data-bs-target="#modalID"><i class="ri-add-fill me-1 align-bottom"></i> {{trans('lang.new')}}</button>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
        </div>

        <div class="row" v-show="!$root.loading">
            <div class="col-lg-12">
    <div class="table-responsive table-card">
    <table class="table table-nowrap mb-0">
        <thead class="table-light">
            <tr>
                <th scope="col">{{trans('lang.id')}}</th>
                <th scope="col">{{trans('lang.name')}}</th>
                <th scope="col">{{trans('lang.price')}}</th>
                <th scope="col">{{trans('lang.offer_price')}}</th>
                <th scope="col">{{trans('lang.ads_numbers')}}</th>
                <th scope="col">{{trans('lang.period')}}</th>
                <th scope="col">{{trans('lang.features')}}</th>
                <th scope="col">{{trans('lang.options')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item,index in tableData.data" :key="index">
              
                <td><a href="#" class="fw-semibold"># {{item.id}} </a></td>
                <td>{{item.lang_name}}</td>
                <td>{{item.price}} {{item.currency}}</td>
                <td>{{item.offer_price}} </td>
                <td>{{item.ads_number}}</td>
                <td>{{item.period}} months</td>
                <td>  <div v-html="item.lang_features">  </div></td>
                <td>
                    <button type="button" class="btn btn-sm btn-light">
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
    import { VueEditor } from "vue2-editor";
export default {
    mounted(){
        
        Fire.$on('Load',()=>{
            this.getData()
        })
         this.getData()
         this.get_ads_numbers()
         this.get_currencies()
         this.name_count=Object.keys(this.form.name);
         this.features_count=Object.keys(this.form.features);
    },
    components: {
        VueEditor
    },
    data(){
        return {
            form :new Form({
                id:'',
                name:{
                    en:'',
                    tr:'',
                    ar:'',
                },
                price:'',
                currency:'',
                offer_price:'',
                period:'',
                ads_number:'',
                features:{
                    en:'',
                    tr:'',
                    ar:'',
                },
            }),
            item:{},
            editMode:false,
            tableData:{},
            ads_numbers:[],
            currencies:[],
            name_count:0,
            features_count:0,
        }
    },
    methods:{
        
        
        getData(){
            this.$root.loading=true
            axios.get('/admin/admin_api/packages')
                 .then((resp)=>{
                     this.tableData=resp.data
                     this.$root.loading_more=false
                     this.$root.loading=false
                 })
        },
        get_currencies(){
            axios.get('/admin/admin_api/get_currencies')
                 .then((resp)=>{
                    this.currencies=resp.data
                 })
        },
        get_ads_numbers(){
            axios.get('/admin/admin_api/get_ads_numbers')
                 .then((resp)=>{
                    this.ads_numbers=resp.data
                 })
        },
        newModal(){
          this.form.reset()
          this.form.image=''
            this.editMode=false
        },
        editModal(data){
            this.editMode=true
            this.form.fill(data)
            this.form.image=''
        },
        delModal(item){
            this.item=item
            $('#deleteModal').modal('show')
        },
        
        create(){
            this.form.post('/admin/admin_api/packages')
                .then((resp)=>{
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
            this.form.put('/admin/admin_api/packages/'+this.form.id)
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
          this.form.delete('/admin/admin_api/packages/'+this.item.id)
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

            axios.get('/admin/admin_api/packages?page=' + page)
                .then(({data}) => (
                    this.tableData = data
                ))
        },
        searching(){
               let query=this.$root.search;
                this.$root.loading=true
                axios.get('/admin/admin_api/packages')
                 .then((resp)=>{
                    if(query.length != 0){                
                    this.tableData.data = resp.data.data.filter(result =>
                    result.lang_name.toLowerCase().includes(query.toLowerCase())
                    );
                    this.$root.loading=false
                    }else{
                        this.getData();
                        this.$root.loading=false
                    }
                 })
              
           }, 
    }
}
</script>