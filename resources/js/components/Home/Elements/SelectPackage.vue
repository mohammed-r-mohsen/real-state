<template>

            <section class="pricing-section centred">
            <div class="auto-container">
                <div class="tabs-box">

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
                            <div class="row justify-content-center" v-if="packages.length!=0">
                                <div class="col-lg-6 col-md-6 col-sm-12 pricing-block" v-for="pack,index in packages" :key="index">
                                    <div :id="'table'+pack.id" class="pricing-block-one type animated"  style="visibility: visible; animation-duration: 1000ms; animation-delay: 0ms; animation-name: fadeInUp;">
                                        <div class="pricing-table">
                                            <div class="table-header">
                                                <div class="shape-1" style="background-image: url(/assets2/images/shape/shape-4.png);"></div>
                                                <div class="shape-2" style="background-image: url(/assets2/images/shape/shape-5.png);"></div>
                                                <h4>{{pack.lang_name}}</h4>
                                                <h2>
                                                {{pack.price}} <span class="currency">{{pack.currency}} 
                                                <span v-if="pack.period!=1"> / {{pack.period}} {{trans('lang.mo')}} </span>  
                                                <span v-else> /  {{trans('lang.mo')}} </span>  
                                                </span>    
                                                </h2>
                                            </div>
                                            <div class="table-content" v-html="pack.lang_features">
                                                
                                            </div>
                                            <div class="table-footer">
                                                <a  :id="'btn'+pack.id" @click.prevent="select_package(pack.id)" class="link-btn">{{trans('lang.select')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                           
                            <div v-else>
                                <no-items></no-items>
                            </div>
                        </div>
                       
                    </div>
               
            </div>

            <div class="row mt-10">
                <div class="col-6">
                    <!-- <router-link to="/add_advertisement/1" class="theme-btn btn-two pull-left"> {{trans('lang.back')}} </router-link> -->
                </div>
                <div class="col-6">
                    <button :disabled="$root.package_id==''" @click="go_paid()" class="theme-btn btn-one pull-right"> {{trans('lang.next')}} </button>
                </div>
            </div>
        </section>

        
                           
</template>

<script>

    export default {
        mounted(){
            this.get_ads_numbers()
             this.filter()
        },
        data(){
            return {
                packages:[],
                ads_numbers:[],
                loading:false,
                form :new Form({
                    id:'',
                    ads_number:12
                }),
            }
        },
        methods:{

        filter(){
            this.loading=true
            axios.get('/api/filter_packages/'+this.form.ads_number) 
            .then((resp)=>{
                this.packages=resp.data
                this.loading=false
                 })
        },
        select_package(id){
            
            this.$root.package_id=id
            var element = document.getElementById('table'+id);
            var elements = document.getElementsByClassName("type");
            for (let index = 0; index < elements.length; index++) {
                elements[index].classList.remove("active");
                
            }
            element.classList.add("active");
            
         
            
        },
        go_paid(){
            this.$router.push('/add_advertisement/3')
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