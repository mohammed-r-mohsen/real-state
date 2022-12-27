<template>
<!-- search-field-section -->
    <section class="search-field-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="search-field">
                    <div class="tabs-box">
                       
                        <div class="tabs-content info-group">
                            <div class="tab active-tab" id="tab-1">
                                <div class="inner-box">
                                    <div class="top-search">
                                        <form action="#" method="post" class="search-form">
                                            <div class="row clearfix" style="z-index:999999999">
                                               
                                                <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>{{trans('lang.category')}}</label>
                                                        <v-select :placeholder="trans('lang.all_categories')" v-model="$root.filter_ads.category_id" :options="cats" :reduce="cat => cat.id" label="lang_name"></v-select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label> {{trans('lang.type')}}</label>
                                                        <v-select :placeholder="trans('lang.all_types')" v-model="$root.filter_ads.type" :options="types" :reduce="type => type.value" label="name" ></v-select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label> {{trans('lang.city')}} </label>
                                                        <v-select :placeholder="trans('lang.all_cities')" v-model="$root.filter_ads.state_id" :options="states" :reduce="state => state.id" label="lang_name"></v-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="search-btn">
                                                <button type="button" @click="filter()" ><i class="ri-search-line"></i>{{trans('lang.search')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="switch_btn_one ">
                                        <button class="nav-btn nav-toggler navSidebar-button clearfix search__toggler"> {{trans('lang.advanced_search')}} <i class="ri-arrow-down-line"></i></button>
                                        <div class="advanced-search">
                                            <div class="close-btn">
                                                <a href="javascript:void(0)" class="close-side-widget"><i class="ri-close-line"></i></a>
                                            </div>
                                        
                                             <div class="range-box">
                                                    <div class="row clearfix">
                                                         <div class="col-lg-4 col-md-4 col-sm-12 column">
                                                            <div class="form-group">
                                                                <label> {{trans('lang.currency')}} </label>
                                                                <v-select :placeholder="trans('lang.any_currency')" v-model="$root.filter_ads.currency" :options="currencies" :reduce="currency => currency.sympol" label="sympol"></v-select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 column">
                                                            <div class="form-group customized">
                                                                <label> {{trans('lang.price')}}  </label>
                                                                <div class="row">
                                                                    <div class="col-5">
                                                                    <input :placeholder="trans('lang.from')" type="number" min="0" v-model="$root.filter_ads.price_from" class="form-control">
                                                                    </div>
                                                                    <div class="col-2"><span class="to">{{trans('lang.to')}}</span></div>
                                                                    <div class="col-5">
                                                                    <input :placeholder="trans('lang.to')" type="number" min="0" v-model="$root.filter_ads.price_to" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 column">
                                                            <div class="form-group customized">
                                                                <label> {{trans('lang.area')}}  </label>
                                                               <div class="row">
                                                                    <div class="col-5">
                                                                    <input :placeholder="trans('lang.from')" type="number" min="0" v-model="$root.filter_ads.area_from" class="form-control">
                                                                    </div>
                                                                    <div class="col-2"><span class="to">{{trans('lang.to')}}</span></div>
                                                                    <div class="col-5">
                                                                    <input :placeholder="trans('lang.to')" type="number" min="0" v-model="$root.filter_ads.area_to" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- search-field-section end -->
</template>

<script>
export default {
    mounted() {
        this.get_cats()
        this.get_states()
        this.get_currencies()
        
    },
    data(){
        return {
            cats:[],
            states:[],
            currencies:[],
            form:new Form({
                category_id:'',
                state_id:'',
                type:'',

            }),
            types:[
                {'value':'buy','name':this.$root.trans('lang.buy')},
                {'value':'rent','name':this.$root.trans('lang.rent')},
                {'value':'daily_rent','name':this.$root.trans('lang.daily_rent')},
            ],
        }
    },
    methods:{
        get_cats(){
            axios.get('/api/get_categories')
                 .then((resp)=>{
                    this.cats=resp.data
                 })
        },
        get_states(){
            axios.get('/api/get_states')
                 .then((resp)=>{
                    this.states=resp.data
                 })
        },
        get_currencies(){
            axios.get('/api/get_currencies')
                 .then((resp)=>{
                    this.currencies=resp.data
                 })
        },
        filter(){
            this.$router.push('/filter_advertisements')
        }
    }
}
</script>
