<template>

            <section class="pricing-section centred">
            <div class="auto-container">
                <div class="tabs-box" >

                        <div class="tab active-tab">
                            <div class="row"> 
                                <div class="col-12">
                                    <p class="ads_number"> <span> {{trans('lang.package_question')}} </span>
                                        <select @change="filter" class="form-control" required  v-model="form.ads_number"  >
                                            <option v-for="num,index in ads_numbers" :key="index" :value="num.ads_number">{{num.ads_number}}</option>
                                        </select>
                                    </p>
                                </div>    
                            </div>
                            <div   v-if="packages.length>0">
                            <div class="row justify-content-center" v-if="view==2">
                                <div class="col-lg-6 col-md-6 col-sm-12 pricing-block" v-for="pack,index in packages" :key="index">
                                    <package-box :pack="pack"></package-box>
                                </div> 
                            </div>
                            <div class="row justify-content-center" v-else-if="view==4">
                                <div class="col-lg-3 col-md-6 col-sm-12 pricing-block" v-for="pack,index in packages" :key="index">
                                    <package-box :pack="pack"></package-box>
                                </div> 
                            </div>
                            </div>
                            <div v-else>
                                <no-items></no-items>
                            </div>
                          
                            
                        </div>
                       
                            
                    </div>
               
            </div>
        </section>
                           
</template>

<script>
import PackageBox from './PackageBox.vue'

    export default {
        mounted(){
         this.$root.check_user_package()
         this.get_ads_numbers()
         this.filter()
        },
        props:['view'],
        components:{PackageBox},
        data(){
            return {
                form :new Form({
                    id:'',
                    ads_number:12
                }),
                packages:[],
                ads_numbers:[]
            }
        },
        methods:{
        
        
        filter(){
            this.$root.loading=true
            axios.get('/api/filter_packages/'+this.form.ads_number) 
            .then((resp)=>{
                this.packages=resp.data
                this.$root.loading=false
                 })
        },
        get_ads_numbers(){
            axios.get('/api/get_ads_numbers')
                 .then((resp)=>{
                    this.ads_numbers=resp.data
                 })
        }
        
      
        }
    }
</script>