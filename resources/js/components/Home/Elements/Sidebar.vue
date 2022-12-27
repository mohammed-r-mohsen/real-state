<template>
    <div class="col-md-3  col-sm-12 sidebar-side">
                        <div class="default-sidebar property-sidebar">
                            
                            <!-- <div class="category-widget sidebar-widget">
                                <div v-if="$root.user">
                                <div class="widget-title" style="margin-top:0">
                                    <div class="avatar">
                                        <img v-if="$root.user.avatar!=null" :src="$root.user.avatar">
                                        <img v-else src="/assets2/images/user-icon.jpg">
                                    </div>
                                </div>
                                <ul class="category-list no-before clearfix text-center">
                                    <li><i class="ri-user-3-line"></i>  {{$root.user.name}} </li>
                                    <li><i class="ri-mail-line"></i>  {{$root.user.email}} </li>
                                    <li v-if="$root.user.phone"><i class="ri-phone-line"></i>  {{$root.user.phone}} </li>
                                    <router-link  to="/edit_profile" class="theme-btn btn-one btn-sm mt-10"><i class="ri-edit-box-line"></i> Edit</router-link>
                                    <button @click="$root.logout()" class="theme-btn text-danger btn-default btn-sm mt-10">Logout</button>
                                </ul>
                                </div>
                                <div v-else>
                                    <loading :lines="2"></loading>
                                </div>
                            </div> -->
                            <div class="category-widget sidebar-widget">
                                <div class="widget-title" style="margin-top:0">
                                    <h5>{{trans('lang.account_management')}}</h5>
                                </div>
                                <ul class="category-list no-before clearfix">
                                    <li><router-link :class="{'active':page=='account'}" to="/home"><i class="ri-user-3-line"></i>  {{trans('lang.account')}} </router-link></li>
                                    <li><router-link :class="{'active':page=='packages'}" to="/my_packages"><i class="ri-discuss-line"></i> {{trans('lang.packages')}}  </router-link></li>
                                </ul>
                                <div class="widget-title">
                                    <h5> {{trans('lang.advertisements')}} </h5>
                                </div>
                                <ul class="category-list no-before clearfix">
                                    <li><router-link :class="{'active':page=='add_ad'}" to="/add_advertisement/4"><i class="ri-file-add-line"></i> {{trans('lang.add_advertisement')}} </router-link></li>
                                    <li><router-link :class="{'active':page=='ads'}" to="/my_advertisements"><i class="ri-advertisement-line"></i> {{trans('lang.advertisements')}} </router-link></li>
                                </ul>
                                <div class="widget-title">
                                    <h5> {{trans('lang.help_center')}} </h5>
                                </div>
                                <ul class="category-list no-before clearfix">
                                    <li><router-link :class="{'active':page=='contact'}" to="/contact"><i class="ri-phone-line"></i> {{trans('lang.contact')}} </router-link></li>
                                    <!-- <li><router-link :class="{'active':page=='messages'}" to="/messages"><i class="ri-message-line"></i> Messages  </router-link></li> -->
                                </ul>
                                 <div class="widget-title">
                                    <h5> {{trans('lang.other')}} </h5>
                                </div>
                                <ul class="category-list no-before clearfix">
                                    <li><router-link :class="{'active':page=='reports'}" to="/reports"><i class="ri-numbers-line"></i>  {{trans('lang.reports')}} </router-link></li>
                                    <li><router-link :class="{'active':page=='clients_review'}" to="/clients_review"><i class="ri-star-line"></i> {{trans('lang.clients_reviews')}}  </router-link></li>
                                    <li> <button @click="$root.logout()" class="theme-btn text-danger btn-default btn-sm mt-10  logout-btn">{{trans('lang.logout')}}</button> </li>
                                </ul>
                            </div>
                            
                           
                        </div>
                    </div>
</template>

<script>
import Loading from './Loading.vue'
    
export default {
  components: { Loading },
    mounted() {
        
    },
    props:['page'],
    methods:{
        logout(){
            
        }
    }
}
</script>



