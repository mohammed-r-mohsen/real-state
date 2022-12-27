<template>
    <div class="vue-content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                <div class="card-body text-center p-4">
                    <img class="ad-image" :src="ad.image" alt="" height="300">
                    <h5 class="mb-1 mt-4"><a href="javascript:void(0)" class="link-primary">{{ad.item_title}}</a></h5>
                    <p class="text-muted mb-4">{{ad.item_title}}</p>
                    
                    <div class="mt-4">
                        <a href="javascript:void(0)" class="btn btn-light w-100"> {{trans('lang.image')}} </a>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                <div class="card-body text-center p-4">
                    <div v-if="ad.video">
                    <video width="100%" height="300" controls>
                                <source :src="ad.video">
                                {{trans('lang.browser_no_support')}}
                                </video>
                    <h5 class="mb-1 mt-4"><a href="javascript:void(0)" class="link-primary">{{ad.item_title}}</a></h5>
                    <p class="text-muted mb-4">{{ad.item_title}}</p>
                    </div>
                    <div class="" v-else> {{trans('lang.no_video')}} </div>
                    <div class="mt-4">
                        <a href="javascript:void(0)" class="btn btn-light w-100"> {{trans('lang.video')}}</a>
                    </div>
                </div>
            </div>
            </div>


            <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                 
                    <div class="table-card">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.id')}}</td>
                                    <td>#{{ad.id}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.title')}}</td>
                                    <td>{{ad.item_title}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.project_name')}}</td>
                                    <td>{{ad.project_title}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.shown')}}</td>
                                    <td>
                                        <span class="badge badge-soft-success" v-if="ad.shown=='shown'">{{trans('lang.'+ad.shown)}}</span>
                                        <span class="badge badge-soft-danger" v-else>{{trans('lang.'+ad.shown)}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.status')}}</td>
                                    <td>
                                        <span class="badge badge-soft-secondary" v-if="ad.status=='active'">{{trans('lang.'+ad.status)}}</span>
                                        <span class="badge badge-soft-warning" v-else-if="ad.status=='pending'">{{trans('lang.'+ad.status)}}</span>
                                        <span class="badge badge-soft-danger" v-else>{{trans('lang.'+ad.status)}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.address')}}</td>
                                    <td>{{ad.address}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                 
                    <div class="table-card">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.category')}}</td>
                                    <td>{{ad.category.item}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.type')}}</td>
                                    <td>{{ad.type}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.state')}}</td>
                                    <td>{{ad.state.item}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.city')}}</td>
                                    <td>
                                      {{ad.city.item}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{trans('lang.region')}}</td>
                                    <td>
                                      {{ad.region.item}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium"> {{trans('lang.neighbor')}}</td>
                                    <td>
                                      {{ad.neighbor.item}}
                                    </td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                </div>
            </div>
            </div>

             <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <h5 class="mb-1 mt-4">  {{trans('lang.description')}}  </h5>
                        <p class="text-muted mb-4"> {{ad.item_desc}} </p>
                    </div>
                </div>
            </div>
             <div class="col-md-12">
                <div class="card mb-5">
                    <form @submit.prevent="update()">
                    <div class="card-body">
                        <h5 class="mb-1 mt-4"> {{trans('lang.action')}}  </h5>
                        <div class="mb-3">
                            <label> {{trans('lang.status')}} </label>
                            <v-select required v-model="form.status" :options="statuses" :reduce="status => status.name_en" :label="'name_'+$root.lang"></v-select>
                                <div class="text-danger" v-if="form.errors.has('status')" v-html="form.errors.get('status')" />
                        </div>
                        <div class="mb-3" v-if="form.status=='pending' || form.status=='refused'">
                           <input required class="form-control" type="text" v-model="form.message" placeholder="Enter Reasons" >
                                <div class="text-danger" v-if="form.errors.has('message')" v-html="form.errors.get('message')" />
                        </div>
                        <div class="mb-3" >
                            <button :disabled="!form.status" type="submit" class="btn btn-primary"> {{trans('admin.submit')}} </button>
                        </div>
                    
                    </div>
                    </form>
                </div>
            </div>


            </div>
     </div>
              
          
</template>

<script>
export default {
    mounted(){
        this.form.status=this.ad.status
    },
    props:['ad'],
    data(){
        return {
            
            form:new Form({
                id:'',
                user_id:'',
                status:'',
                message:'',
            }),
            statuses:[
                {'name_en':'active','name_tr':'aktif','name_ar':'فعال'},
                {'name_en':'pending','name_tr':'Bekliyor','name_ar':'بالانتظار'},
                {'name_en':'refused','name_tr':'reddetti','name_ar':'مرفوض'},
                ],
        }
    },
    methods:{
        update(){
            this.form.id=this.ad.id
            this.form.user_id=this.ad.user_id
            this.form.post('/admin/admin_api/update_status')
                     .then((resp)=>{
                        if(resp.data=='success'){
                            window.location.href="/admin/advertisements"
                        }
                     })
        }
    }
   
}
</script>