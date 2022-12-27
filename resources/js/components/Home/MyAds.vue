<template>
  
        <div class="home-parent">

      


          <!-- property-page-section -->
        <section class="property-page-section property-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'packages'"></sidebar>

                    <div class="col-md-9  col-sm-12 content-side">
                        <div class="myprofile-section">
                       
                            <div class="home-header">
                                <h4 class="title"><i class="ri-advertisement-line"></i> {{trans('lang.advertisements')}} :
                                <router-link to="/add_advertisement/4" class="title-link"> 
                                     {{trans('lang.create_ad')}}
                                    </router-link>
                                </h4>
                                
                            </div>
                        </div>
                        <div class="myprofile-section search-field ">
                       <div class="inner-box">
                            <div class="top-search">
                                <form @submit.prevent="filter()" class="search-form v2">
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <div class="field-input">
                                                    <i class="ri-search-line"></i>
                                                    <input class="form-control2" v-model="form.title"  :placeholder="trans('lang.search_by_title')" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <v-select v-model="form.category_id" :options="cats" :reduce="cat => cat.id" label="lang_name" :placeholder="trans('lang.category')"></v-select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <v-select v-model="form.status" :options="statuses" :reduce="status => status.name_en" label="lang_name" :placeholder="trans('lang.status')"></v-select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-btn">
                                        <button type="submit"><i class="ri-search-line"></i>{{trans('lang.search')}}</button>
                                    </div>
                                </form>
                            </div>
                                       
                                    </div>
                         
                               <div class="table-responsive table-card"  v-if="advertisements.length!=0 && !$root.loading">
                                <table class="table table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr class="colored">
                                        
                                            <th scope="col">{{trans('lang.id')}}</th>
                                            <th scope="col"> {{trans('lang.title')}}</th>
                                            <th scope="col">{{trans('lang.category')}}</th>
                                            <!-- <th scope="col">Start at</th> -->
                                            <th scope="col">{{trans('lang.end_at')}}</th>
                                            <th scope="col">{{trans('lang.status')}}</th>
                                            <th scope="col">{{trans('lang.options')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr v-for="advertisement,index in advertisements" :key="index">
                                        
                                            <td><a class="fw-semibold"># {{advertisement.id}}</a></td>
                                            <td>{{advertisement.item_title}}</td>
                                            <td>{{advertisement.category.item}}</td>
                                            <!-- <td> {{advertisement.created}} </td> -->
                                            <td> {{advertisement.order.end_at}} </td>
                                            <td>  <div class="badge badge-success" v-if="advertisement.status=='active'"> {{advertisement.status}} </div> 
                                                    <div class="badge badge-danger" v-else> {{advertisement.status}} </div> 
                                            </td>
                                            <td>
                                                <router-link class="theme-btn btn-primary btn-sm" :to="'/view_advertisement/'+advertisement.slug"> <i class="ri-slideshow-3-line"></i>   </router-link>
                                                <router-link class="theme-btn btn-success btn-sm" :to="'/edit_advertisement/'+advertisement.slug"> <i class="ri-edit-line"></i>   </router-link>
                                                <button class="theme-btn btn-warning btn-sm" v-if="advertisement.shown=='shown'" @click="toggle_view(advertisement.id)"> <i class="ri-eye-off-line"></i>   </button>
                                                <button class="theme-btn btn-success btn-sm" v-else @click="toggle_view(advertisement.id)"> <i class="ri-eye-line"></i>   </button>
                                                <button @click="del(advertisement.id)" class="theme-btn btn-danger btn-sm" > <i class="ri-delete-bin-line"></i>   </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div v-else-if="$root.loading" class="text-center">
                                    <loading :lines="3"></loading>
                                </div>
                                <div v-else>
                                    <no-items :link="'/add_advertisement/4'" :btn_name="trans('lang.create_ad')"></no-items>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
       
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>

    export default {
        mounted(){
            this.$root.check_auth()
             Fire.$on(('Load'),()=>{
                 this.get_ads()
             })
             this.get_ads()
             this.get_cats()
             
          
        },
        data(){
            return {
                form :new Form({
                    id:'',
                    title:'',
                    category_id:'',
                    status:''
                }),
                advertisements:[],
                cats:[],
                statuses:[
                {'name_en':'active','name_tr':'aktif','name_ar':'فعال'},
                {'name_en':'pending','name_tr':'Bekliyor','name_ar':'بالانتظار'},
                {'name_en':'refused','name_tr':'reddetti','name_ar':'مرفوض'},]
            }
        },
        methods:{
        get_cats(){
            axios.get('/api/get_categories')
                 .then((resp)=>{
                    this.cats=resp.data
                 })
        },
        get_ads(){
            this.$root.loading=true
            axios.get('/api/get_advertisemnts')
                 .then((resp)=>{
                    this.advertisements=resp.data
                    this.$root.loading=false
                 })
        },
        filter(){
            this.$root.loading=true
            this.form.post('/api/filter_my_ads')
                .then((resp)=>{
                    this.advertisements=resp.data
                    this.$root.loading=false
                })
        },
        toggle_view(id){
            axios.post('/api/ad_toggle_view',{'id':id})
                 .then((resp)=>{
                    console.log(resp.data)
                    Fire.$emit('Load')
                    this.$root.success('Updated Successfully');
                 })
        },
        del(id){
            this.form.id=id
                swal.fire({
                    title: "Are you sure",
                    text: "You are going to delete this item permainently!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        this.form.post('/api/delete_ad')
                            .then((resp)=>{
                                Fire.$emit('Load')
                            })
                    }
                });
            
        }
       
        
      
        }
    }
</script>