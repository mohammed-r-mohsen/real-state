<template>
  
        <div class="home-parent">

      


          <!-- property-page-section -->
        <section class="property-page-section property-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'packages'"></sidebar>

                    <div class="col-md-9  col-sm-12 content-side">
                        <div class="myprofile-section">
                       
                            <div class="general-information">
                                <h4 class="title"><i class="ri-discuss-line"></i> {{trans('lang.packages')}} :
                                <router-link to="/add_package" class="title-link"> 
                                     {{trans('lang.buy_package')}} 
                                    </router-link>
                                </h4>
                                
                            </div>
                        </div>
                        <div class="myprofile-section">
                       
                         
                               <div class="table-responsive table-card"  v-if="orders.length!=0 && !$root.loading">
                                <table class="table table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr class="colored">
                                        
                                            <th scope="col">{{trans('lang.id')}}</th>
                                            <th scope="col">{{trans('lang.name')}}</th>
                                            <th scope="col">{{trans('lang.retained_ads')}}</th>
                                            <th scope="col">{{trans('lang.start_at')}}</th>
                                            <th scope="col">{{trans('lang.end_at')}}</th>
                                            <th scope="col">{{trans('lang.features')}}</th>
                                            <th scope="col">{{trans('lang.status')}}</th>
                                            <th scope="col">{{trans('lang.options')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr v-for="order,index in orders" :key="index">
                                        
                                            <td><a class="fw-semibold"># {{order.id}}</a></td>
                                            <td>{{order.package.item}}</td>
                                            <td> {{order.old_ads+order.package_ads_number - order.ads_number }} </td>
                                            <td>{{order.start_at}}</td>
                                            <td>  {{order.end_at}}</td>
                                            <td><div v-html="order.package.item_features"></div></td>
                                            <td>  <div class="badge badge-success" v-if="order.status=='active'"> {{trans('lang.'+order.status)}} </div> 
                                                    <div class="badge badge-danger" v-else> {{trans('lang.'+order.status)}} </div> 
                                            </td>
                                            <td>
                                                <span v-if="order.status=='active'"> 
                                                    <router-link to="/add_package" class="btn btn-success btn-sm"> 
                                                    <i class="ri-anticlockwise-line"></i>
                                                    {{trans('lang.upgrade')}} 
                                                    </router-link>
                                                </span>
                                                <span v-if="order.status=='unavailable'"> 
                                                    <button class="btn btn-primary btn-sm" @click="renew(order)" v-if="!$root.user_package"> 
                                                    <i class="ri-repeat-2-line"></i>
                                                    {{trans('lang.renew')}} 
                                                    </button>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div v-else-if="$root.loading" class="text-center">
                                    <loading :lines="3"></loading>
                                </div>
                                <div v-else>
                                    <no-items :link="'/add_package'" :btn_name="'Buy package'"></no-items>
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
            
             
             this.get_orders()
          
        },
        data(){
            return {
                form :new Form({
                    id:''
                }),
                orders:[],
            }
        },
        methods:{

        get_orders(){
            this.$root.loading=true
            axios.get('/api/get_orders/')
                 .then((resp)=>{
                    this.orders=resp.data
                    this.$root.loading=false
                    this.$root.check_user_package()
                 })
        },
        renew(order){
            swal.fire({
                title: "Are you sure",
                text: "You are going to renew package",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Renew",
            }).then((result) => {
                if (result.value) {
                    axios.post('/api/renew_order/'+order.id)
                         .then((resp)=>{
                            this.get_orders()
                            this.$root.success('Packae Renewed Successfully !')
                         })
                }
            })
        }
       
        
      
        }
    }
</script>