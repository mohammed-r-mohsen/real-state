<template>
    <div class="vue-content">

         <!-- Create / Update Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel"> {{trans('lang.all_users')}} </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form @submit.prevent="editMode?update():create()">
                              <div class="row">
                                   <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label for="teammembersName" class="form-label">{{trans('lang.name')}} *</label>
                                          <input required :class="{ 'is-invalid': form.errors.has('name') } " v-model="form.name" name="name" class="form-control" id="teammembersname" >
                                           <div class="text-danger" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label for="userphone" class="form-label">{{trans('lang.phone')}} *</label>
                                          <div class="row">
                                            <div class="col-5">
                                            <v-select class="phone_code" :options="countries" :reduce="country => country.id" label="country_phone_code" 
                                            v-model="form.country_id">
                                            </v-select>
                                            </div>
                                            <div class="col-7">
                                             <input required :class="{ 'is-invalid': form.errors.has('phone') } " v-model="form.phone" class="form-control" id="userphone" >
                                            </div>
                                        </div>
                                           <div class="text-danger" v-if="form.errors.has('phone')" v-html="form.errors.get('phone')" />
                                        </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label for="usermail" class="form-label">{{trans('lang.email')}} *</label>
                                          <input required autocomplete="new-password"  type="email" :class="{ 'is-invalid': form.errors.has('email') } " v-model="form.email" class="form-control" id="usermail" >
                                           <div class="text-danger" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label for="useravatar" class="form-label">{{trans('lang.avatar')}} </label>
                                          <input :class="{ 'is-invalid': form.errors.has('avatar') }" @change="upload" type="file" class="form-control" id="useravatar">
                                           <div class="text-danger" v-if="form.errors.has('avatar')" v-html="form.errors.get('avatar')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label for="teammembersName" class="form-label">{{trans('lang.city')}} </label>
                                          <v-select required v-model="form.state_id" :options="states" :reduce="state => state.id" label="lang_name"></v-select>
                                           <div class="text-danger" v-if="form.errors.has('state_id')" v-html="form.errors.get('state_id')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label for="useraddress" class="form-label">{{trans('lang.address')}} </label>
                                          <input :class="{ 'is-invalid': form.errors.has('address') }" v-model="form.address"  class="form-control" id="useraddress">
                                           <div class="text-danger" v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
                                      </div>
                                  </div>
                                  
                                  <div class="col-lg-6">
                                      <div class="mb-3">
                                          <label for="userpassword" class="form-label">{{trans('lang.password')}} </label>
                                          <input autocomplete="new-password" :required="!editMode" type="password" :class="{ 'is-invalid': form.errors.has('password') } " v-model="form.password" class="form-control" id="userpassword" >
                                           <div class="text-danger" v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                      <div class="mb-3">
                                          <label for="userpassword" class="form-label">{{trans('lang.confirm_password')}} </label>
                                          <input  type="password" :class="{ 'is-invalid': form.errors.has('password_confirmation') } " v-model="form.password_confirmation" class="form-control" id="userpassword_confirmation" >
                                           
                                      </div>
                                  </div>
                                
                                  <div class="form-group text-left" >
                                        <div class="form-check">
                                            <input v-model="form.is_provider" class="form-check-input" type="checkbox"   id="is-prvider">
                                            <label class="form-check-label"  for="is-prvider"> {{trans('lang.are_you_provider')}}  </label>
                                        </div>      
                                     </div>
                                    <div class="form-group text-left col-6" >
                                        <div class="form-check">
                                            <input v-model="form.is_company" class="form-check-input" type="checkbox"   id="is-company">
                                            <label class="form-check-label"  for="is-company"> Are you company?  </label>
                                        </div>      
                                     </div>
                                     <div class="col-12 row" v-if="form.is_company==1">

                                      <div class="mb-3 col-lg-6">
                                          <label  class="form-label">Company {{trans('lang.name')}} *</label>
                                          <input  type="text" :class="{ 'is-invalid': form.errors.has('c_name') } " v-model="form.c_name" class="form-control" >
                                           <div class="text-danger" v-if="form.errors.has('c_name')" v-html="form.errors.get('c_name')" />
                                      </div>
                                      <div class="mb-3 col-lg-6">
                                          <label  class="form-label">Lisence number *</label>
                                          <input  type="text" :class="{ 'is-invalid': form.errors.has('lisence_number') } " v-model="form.lisence_number" class="form-control" >
                                         <div class="text-danger" v-if="form.errors.has('lisence_number')" v-html="form.errors.get('lisence_number')" />
                                        </div>
                                      <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label for="userdocemnt" class="form-label">Lisence document</label>
                                          <input :class="{ 'is-invalid': form.errors.has('lisence_document') }" @change="upload2" type="file" class="form-control" id="userdocemnt">
                                           <div class="text-danger" v-if="form.errors.has('lisence_document')" v-html="form.errors.get('lisence_document')" />
                                      </div>
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
                <th scope="col">{{trans('lang.type')}}</th>
                <th scope="col">{{trans('lang.avatar')}}</th>
                <th scope="col">{{trans('lang.phone')}}</th>
                <th scope="col">{{trans('lang.email')}}</th>
                <th scope="col">{{trans('lang.address')}}</th>
                <th scope="col">{{trans('lang.options')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item,index in tableData.data" :key="index">
              
                <td><a href="#" class="fw-semibold"># {{item.id}} </a></td>
                <td>{{item.name}}</td>
                <td> 
                    <div class="badge badge-soft-primary" v-if="item.is_provider==1"> {{trans('lang.provider')}} </div> 
                     <div class="badge badge-soft-danger" v-else> {{trans('lang.ordinary_user')}} </div> 
                 </td>
                <td> <div v-if="item.avatar!=null"><img class="table-avatar" :src="item.avatar"></div></td>
                <td>{{item.phone}}</td>
                <td>{{item.email}}</td>
                <td>{{item.address}}</td>
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
export default {
    mounted(){
        
        Fire.$on('Load',()=>{
            this.getData()
        })
         this.getData()
         this.get_states()
         this.get_countries()
    },
    data(){
        return {
            form :new Form({
                id:'',
                name:'',
                phone:'',
                avatar:'',
                address:'',
                email:'',
                country_id:'',
                state_id:'',
                password:'',
                password_confirmation:'',
                is_provider:false,
                is_company:false,
                c_name:'',
                lisence_number:'',
                lisence_document:'',

            }),
            item:{},
            editMode:false,
            tableData:{},
            states:[],
            countries:[],
        }
    },
    methods:{
        
        
        getData(){
            this.$root.loading=true
            axios.get('/admin/admin_api/all_users')
                 .then((resp)=>{
                     this.tableData=resp.data
                     this.$root.loading_more=false
                     this.$root.loading=false
                 })
        },
        get_states(){
            axios.get('/admin/admin_api/get_states')
                 .then((resp)=>{
                    this.states=resp.data
                 })
        },
        get_countries(){
            axios.get('/admin/admin_api/get_countries')
                 .then((resp)=>{
                    this.countries=resp.data
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
            this.form.avatar=''
            this.form.lisence_document=''
            this.form.is_provider=parseInt(this.form.is_provider)
            this.form.is_company=parseInt(this.form.is_company)
        },
        delModal(item){
            this.item=item
            $('#deleteModal').modal('show')
        },
        upload(e){
          let file=e.target.files[0]
          const reader=new FileReader()
          reader.onload= ()=>{
            this.form.avatar=reader.result
          }
          reader.readAsDataURL(file)
        },
        
        create(){
            this.form.post('/admin/admin_api/all_users')
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
            this.form.put('/admin/admin_api/all_users/'+this.form.id)
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
          this.form.delete('/admin/admin_api/all_users/'+this.item.id)
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

            axios.get('/admin/admin_api/all_users?page=' + page)
                .then(({data}) => (
                    this.tableData = data
                ))
        },
        searching(){
               let query=this.$root.search;
                this.$root.loading=true
              if(query.length != 0){                
              axios.get('/admin/admin_api/all_users/search/'+query)
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