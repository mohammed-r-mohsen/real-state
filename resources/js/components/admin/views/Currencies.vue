<template>
    <div class="vue-content">

         <!-- Create / Update Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel"> {{trans('lang.currencies')}} </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form @submit.prevent="editMode?update():create()">
                              <div class="row">
                                  <div class="col-lg-12" v-for="i,index in this.name_count" :key="index">
                                      <div class="mb-3">
                                          <label for="teammembersName" class="form-label">{{trans('lang.name_'+name_count[index])}}</label>
                                          <input required :class="{ 'is-invalid': form.errors.has('name') } " v-model="form.name[name_count[index]]"  class="form-control" id="teammembersname_en" >
                                           <div class="text-danger" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                      </div>
                                  </div>
                                 
                                  <div class="col-lg-12">
                                      <div class="mb-3">
                                          <label class="form-label">{{trans('lang.sympol')}}</label>
                                          <input required :class="{ 'is-invalid': form.errors.has('sympol') } " v-model="form.sympol"  class="form-control">
                                           <div class="text-danger" v-if="form.errors.has('sympol')" v-html="form.errors.get('sympol')" />
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
                <th scope="col">{{trans('lang.sympol')}}</th>
                <th scope="col">{{trans('lang.options')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item,index in tableData.data" :key="index">
              
                <td><a href="#" class="fw-semibold"># {{item.id}} </a></td>
                <td>{{item.lang_name}}</td>
                <td>{{item.sympol}}</td>
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
         this.name_count=Object.keys(this.form.name);
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
                sympol:'',

            }),
            item:{},
            editMode:false,
            tableData:{},
            name_count:0
        }
    },
    methods:{
        
        
        getData(){
            this.$root.loading=true
            axios.get('/admin/admin_api/currencies')
                 .then((resp)=>{
                     this.tableData=resp.data
                     this.$root.loading_more=false
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
            
        },
        delModal(item){
            this.item=item
            $('#deleteModal').modal('show')
        },
        
        create(){
            this.form.post('/admin/admin_api/currencies')
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
            this.form.put('/admin/admin_api/currencies/'+this.form.id)
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
          this.form.delete('/admin/admin_api/currencies/'+this.item.id)
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

            axios.get('/admin/admin_api/currencies?page=' + page)
                .then(({data}) => (
                    this.tableData = data
                ))
        },
        searching(){
               let query=this.$root.search;
                this.$root.loading=true
                axios.get('/admin/admin_api/currencies')
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