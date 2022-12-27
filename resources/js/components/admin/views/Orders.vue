<template>
    <div class="vue-content">

         <!-- Create / Update Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 v-if="!editMode" class="modal-title" id="myModalLabel"> {{trans('lang.orders')}} </h5>
                          <h5 v-else class="modal-title" id="myModalLabel"> Upgrade user package </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form @submit.prevent="editMode?update():create()">
                              <div class="row">
                                  <div class="col-lg-12" v-if="!editMode">
                                      <div class="mb-3">
                                          <label class="form-label">  {{trans('lang.user')}}</label>
                                           <v-select required v-model="form.user_id" :options="users" :reduce="user => user.id" label="name"></v-select>
                                           <div class="text-danger" v-if="form.errors.has('user_id')" v-html="form.errors.get('user_id')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label class="form-label">{{trans('lang.package')}}</label>
                                           <v-select required v-model="form.package_id" :options="packages" :reduce="pac => pac.id" label="lang_name"></v-select>
                                           <div class="text-danger" v-if="form.errors.has('package_id')" v-html="form.errors.get('package_id')" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12" v-if="editMode">
                                      <div class="mb-3">
                                          <label class="form-label">{{trans('lang.status')}}</label>
                                           <v-select placeholder="select status" v-model="form.status" :options="statuses" ></v-select>
                                           <div class="text-danger" v-if="form.errors.has('status')" v-html="form.errors.get('status')" />
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
                    <div class="col-md-3">
                        <div class="mb-3">
                            <v-select :placeholder="trans('admin.user')" v-model="form_filter.user_id" :options="users_has_packages" :reduce="user => user.id" label="name"></v-select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <v-select :placeholder="trans('admin.package')" v-model="form_filter.package_id" :options="packages" :reduce="pac => pac.id" label="lang_name"></v-select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <v-select :placeholder="trans('admin.status')" v-model="form_filter.status" :options="statuses" ></v-select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-sm-auto ms-auto">
                        <div class="list-grid-nav hstack gap-1">
                            <button class="btn btn-primary" @click="filter()" ><i class="ri-search-2-line me-1 align-bottom"></i> {{trans('lang.filter')}}</button>
                            <button class="btn btn-warning" @click="clear()" ><i class="ri-chat-delete-line me-1 align-bottom"></i>{{trans('lang.clear')}}</button>
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
                    <tr class="colored">
                    
                        <th scope="col">{{trans('lang.id')}}</th>
                        <th scope="col">{{trans('lang.user')}}</th>
                        <th scope="col">{{trans('lang.package')}}</th>
                        <th scope="col">{{trans('lang.features')}}</th>
                        <th scope="col">{{trans('lang.start_at')}}</th>
                        <th scope="col">{{trans('lang.end_at')}}</th>
                        <th scope="col">{{trans('lang.state')}}</th>
                        <th scope="col">{{trans('lang.options')}}</th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="item,index in tableData.data" :key="index">
                    
                        <td><a class="fw-semibold"># {{item.id}}</a></td>
                        <td>{{item.user.name}}</td>
                        <td><button type="button" class="btn btn-primary btn-sm">
                        {{item.package.lang_name}} <span class="badge bg-success ms-1">{{item.package.price}} $</span>
                    </button></td>
                        <td><div v-html="item.package.lang_features"></div></td>
                        <td>{{item.start_at}}</td>
                        <td>  {{item.end_at}}</td>
                        <td>  <div class="badge badge-label bg-success" v-if="item.status=='active'"> {{item.status}} </div> 
                                <div class="badge badge-label bg-danger" v-else> {{item.status}} </div> 
                        </td>
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
        this.get_filter_requirements()
    },
    data(){
        return {
            form :new Form({
                id: "",
                user_id:'',
                package_id:'',
                status:'',
            }),
            form_filter :new Form({
                status: "",
                user_id:'',
                package_id:''
            }),
            item:{},
            editMode:false,
            tableData:{},
            users:[],
            users_has_packages:[],
            packages:[],
            statuses:['active','unavailable'],
        }
    },
    methods:{
        getData(){
            this.$root.loading=true
            axios.get('/admin/admin_api/orders')
                 .then((resp)=>{
                     this.tableData=resp.data
                     this.$root.loading=false
                 })
        },
       
        newModal(){
          this.form.reset()
            this.editMode=false
            this.get_requirements()
        },
        editModal(data){
            this.get_requirements()
            this.editMode=true
            this.form.fill(data)
        },
        get_requirements(){
            axios.get('/admin/admin_api/get_users_no_packages').then((resp)=>{
                this.users=resp.data
                axios.get('/admin/admin_api/get_packages')
                     .then((resp)=>{
                        this.packages=resp.data
                     })
            })
        },
        get_filter_requirements(){
            axios.get('/admin/admin_api/get_users_has_packages').then((resp)=>{
                this.users_has_packages=resp.data
                axios.get('/admin/admin_api/get_packages')
                     .then((resp)=>{
                        this.packages=resp.data
                     })
            })
        },
        delModal(item){
            this.item=item
            $('#deleteModal').modal('show')
        },
        
        create(){
            this.form.post('/admin/admin_api/orders')
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
            this.form.put('/admin/admin_api/orders/'+this.form.id)
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
          this.form.delete('/admin/admin_api/orders/'+this.item.id)
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

            axios.get('/admin/admin_api/orders?page=' + page)
                .then(({data}) => (
                    this.tableData = data
                ))
        },
        filter(){
            this.$root.loading=true
            this.form_filter.post('/admin/admin_api/filter_orders')
            .then((resp)=>{
                this.tableData=resp.data
                this.$root.loading=false
                })
        },
        clear(){
            this.form_filter.reset()
            this.getData()
        }
       
    }
}
</script>