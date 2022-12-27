<template>
  <!-- property-page-section -->
        <section class="property-page-section property-grid">
            <div class="large-container">
                <PageTitle :page_title="'Advertisements'"></PageTitle> 
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar property-sidebar">
                            <div class="filter-widget sidebar-widget">
                            
                                <div class="widget-content">
                                    <div class="default-form select-box">
                                         <input @keyup="filter()" placeholder="search ....." type="text" class="form-control " v-model="$root.filter_ads.search">
                                    </div>
                                    <div class="select-box">
                                         <v-select @input="filter()" :placeholder="trans('lang.all_categories')" v-model="$root.filter_ads.category_id" :options="cats" :reduce="cat => cat.id" label="lang_name"></v-select>
                                    </div>
                                    <div class="select-box">
                                         <v-select @input="filter()" :placeholder="trans('lang.all_types')" v-model="$root.filter_ads.type" :options="types" :reduce="type => type.value" label="name"></v-select>
                                    </div>
                                    
                                    
                                </div>
                            </div>

                            <div class="filter-widget sidebar-widget">
                              
                                <div class="widget-content">
                                    <div class="select-box">
                                    <div class="select-box">
                                        
                                        <v-select @input="get_cities" :placeholder="trans('lang.all_cities')" v-model="$root.filter_ads.state_id" :options="states" :reduce="state => state.id" label="lang_name"></v-select>
                                    </div>
                                        <div class="select-box">
                                         <v-select @input="get_regions"  :placeholder="trans('lang.all_states')" v-model="$root.filter_ads.city_id" :options="cities" :reduce="city => city.id" label="lang_name"></v-select>
                                         </div>
                                         <div class="select-box">
                                         <v-select @input="get_neighbors"  :placeholder="trans('lang.all_regions')" v-model="$root.filter_ads.region_id" :options="regions" :reduce="region => region.id" label="lang_name"></v-select>
                                        </div>
                                        <div class="select-box">
                                         <v-select :placeholder="trans('lang.all_neighbors')" v-model="$root.filter_ads.neighbor_id" :options="neighbors" :reduce="neighbor => neighbor.id" label="lang_name"></v-select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="price-filter sidebar-widget">
                                <div class="widget-title">
                                    <h5>{{trans('lang.select_price')}}</h5>
                                </div>
                                <div class="range-slider clearfix customized">
                                    <div class="row">
                                        <div class="col-6">
                                            <label> {{trans('lang.from')}} </label>
                                            <input @keyup="filter()" :placeholder="trans('lang.all')" type="number" min="0" v-model="$root.filter_ads.price_from" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label> {{trans('lang.to')}} </label>
                                            <input @keyup="filter()" :placeholder="trans('lang.all')" type="number" min="0" v-model="$root.filter_ads.price_to" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-20">
                                 <v-select @input="filter()" :placeholder="trans('lang.any_currency')" v-model="$root.filter_ads.currency" :options="currencies" :reduce="currency => currency.sympol" label="sympol"></v-select>
                                    </div>
                                </div>
                            <div class="price-filter sidebar-widget customized">
                                <div class="widget-title">
                                    <h5>{{trans('lang.select_area')}}</h5>
                                </div>
                                <div class="row">
                                        <div class="col-6">
                                            <label> {{trans('lang.from')}} </label>
                                            <input @keyup="filter()" :placeholder="trans('lang.all')" type="number" min="0" v-model="$root.filter_ads.area_from" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label> {{trans('lang.to')}} </label>
                                            <input @keyup="filter()" :placeholder="trans('lang.all')" type="number" min="0" v-model="$root.filter_ads.area_to" class="form-control">
                                        </div>
                                    </div>
                            </div>
                            <div class="price-filter sidebar-widget">
                                <div class="widget-title">
                                    <h5>{{trans('lang.other')}}</h5>
                                </div>
                                <div class="mt-20">
                                 <v-select multiple @input="filter()" :placeholder="trans('lang.heating')" v-model="$root.filter_ads.heatings" :options="heatings" :reduce="heating => heating.id" label="lang_name"></v-select>
                                </div>
                                <div class="mt-20">
                                 <v-select multiple @input="filter()" :placeholder="trans('lang.title_deed')" v-model="$root.filter_ads.title_deeds" :options="titleDeeds" :reduce="titleDeed => titleDeed.id" label="lang_name"></v-select>
                                </div>
                                <div class="mt-20">
                                <v-select @input="filter()" :placeholder="trans('lang.balacony')" v-model="$root.filter_ads.balacony" :options="TrueFalse" :reduce="truefals => truefals.value" label="name"></v-select>
                                </div>
                                <div class="mt-20">
                                <v-select @input="filter()" :placeholder="trans('lang.furnished')" v-model="$root.filter_ads.furnished" :options="TrueFalse" :reduce="truefals => truefals.value" label="name"></v-select>
                                </div>
                                <div class="mt-20">
                                <v-select @input="filter()" :placeholder="trans('lang.available_for_loan')" v-model="$root.filter_ads.available_for_loan" :options="TrueFalse" :reduce="truefals => truefals.value" label="name"></v-select>
                                </div>
                                <div class="mt-20">
                                 <v-select  @input="filter()" :placeholder="trans('lang.bathroom')" v-model="$root.filter_ads.bathroom" :options="bathrooms" :reduce="bathroom => bathroom.id" label="item"></v-select>
                                </div>
                                <div class="mt-20">
                                 <v-select  @input="filter()" :placeholder="trans('lang.floor_count')" v-model="$root.filter_ads.floor_count" :options="floorCounts" :reduce="floorCount => floorCount.id" label="item"></v-select>
                                </div>
                                </div>
                            
                            <div class="category-widget sidebar-widget ">
                             
                                <div class="filter-btn">
                                        <a href="javascript:void(0)" @click="filter()" data-target="html" class="theme-btn btn-one mb-10 scroll-to-target"><i class="ri-filter-3-line"></i>&nbsp;Filter</a>
                                        <a href="javascript:void(0)" @click="clear()" data-target="html" class="btn btn-warning btn-lg scroll-to-target"><i class="fas fa-clear"></i>&nbsp;Clear</a>
                                    </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-9 no-padding col-md-12 col-sm-12 content-side">
                        <div class="property-content-side">
                           
                            <div class="wrapper grid">
                                <div class="deals-grid-content grid-item">
                                    <div class="clearfix advertisements text-center" v-if="!loading && ads.data">
                                        <div class="ad-single feature-block"
                                        v-for="ad,index in ads.data" :key="index">
                                            <ad-block :item="ad"></ad-block>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row clearfix" v-else-if="loading">
                                        <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                            <Loading :lines="4"></Loading>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                            <Loading :lines="4"></Loading>
                                        </div>
                                    </div>
                                    <div v-if="!loading && ads.total==0">
                                        <div class="error-section centred">
                                        <div class="auto-container">
                                            <div class="inner-box">
                                                <h2>No items found </h2>
                                                <button @click="clear()" class="btn btn-warning btn-lg"> {{trans('lang.clear')}}</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="pagination-wrapper">
                                 <pagination :data="ads" @pagination-change-page="getResults"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';
import ImgElement from './Elements/ImgElement.vue';
import AdBlock from './Elements/AdBlock.vue';
import NoItems from './Elements/NoItems.vue';
import PageTitle from './Elements/PageTitle.vue';
// import jQuery from "jquery";
// global.jQuery=jQuery
// global.$=jQuery

    export default {
    mounted() {
        this.$root.filter_ads.user_id==''
        this.filter_ads()
        this.get_cats();
        this.get_states();
        this.get_currencies();
        this.get_building_ages();
        this.get_floor_numbers();
        this.get_heatings();
        this.get_title_deeds();
    },
    data() {
        return {
            ads:{},
            states:[],
            cities:[],
            regions:[],
            neighbors:[],
            cats:[],
            currencies:[],
            ages: [],
            floorNumbers: [],
            heatings: [],
            titleDeeds: [],
            types:[
                {'value':'buy','name':this.$root.trans('lang.buy')},
                {'value':'rent','name':this.$root.trans('lang.rent')},
                {'value':'daily_rent','name':this.$root.trans('lang.daily_rent')},
            ],
            TrueFalse:[
                {'value':0,'name':this.$root.trans('no')},
                {'value':1,'name':this.$root.trans('yes')},
            ],
            bathrooms:[
                {id:1,item:1},
                {id:2,item:2},
                {id:3,item:3},
                {id:4,item:4},
                {id:5,item:5},
                {id:6,item:6},
                {id:7,item:this.$root.trans('lang.morethan_6')},
            ],
            floorCounts:[
                {id:1,item:1},
                {id:2,item:2},
                {id:3,item:3},
                {id:4,item:4},
                {id:5,item:5},
                {id:6,item:6},
                {id:7,item:7},
                {id:8,item:8},
                {id:9,item:9},
                {id:10,item:10},
                {id:11,item:11},
                {id:12,item:12},
                {id:13,item:13},
                {id:14,item:14},
                {id:15,item:15},
                {id:16,item:16},
                {id:17,item:17},
                {id:18,item:18},
                {id:19,item:19},
                {id:20,item:20},
                {id:21,item:21},
                {id:22,item:22},
                {id:23,item:23},
                {id:24,item:24},
                {id:25,item:25},
                {id:26,item:26},
                {id:27,item:27},
                {id:28,item:28},
                {id:29,item:29},
                {id:30,item:30},
                {id:31,item:this.$root.trans('lang.morethan_30')},
            ],
            loading:false,
        };
    },
    methods: {
        filter_ads(){
            this.$root.filter_ads.user_id=''
            this.loading=true
            this.$root.filter_ads.post('/api/ads_filteration')
            .then((resp)=>{
                this.ads=resp.data
                this.loading=false
                      })
        },
        getResults(page = 1) {
            this.$root.filter_ads.post('/api/ads_filteration?page=' + page)
                .then(({data}) => (
                    this.ads = data
                ))
        },
        filter(){
           
            this.$root.filter_ads.user_id=''
            this.filter_ads()
        },
        clear(){
            this.$root.filter_ads.reset()
            this.filter_ads()
        },
        get_states() {
            axios.get("/api/get_states")
                .then((resp) => {
                this.states = resp.data;
            });
        },
        get_building_ages() {
            axios.get("/api/get_building_ages")
                .then((resp) => {
                this.ages = resp.data;
            });
        },
        get_floor_numbers() {
            axios.get("/api/get_floor_numbers")
                .then((resp) => {
                this.floorNumbers = resp.data;
            });
        },
        get_heatings() {
            axios.get("/api/get_heatings")
                .then((resp) => {
                this.heatings = resp.data;
            });
        },
        get_title_deeds() {
            axios.get("/api/get_title_deeds")
                .then((resp) => {
                this.titleDeeds = resp.data;
            });
        },
        get_cities() {
            this.filter()
            axios.get("/api/get_cities/" + this.$root.filter_ads.state_id)
                .then((resp) => {
                this.$root.filter_ads.city_id = "";
                this.$root.filter_ads.region_id = "";
                this.$root.filter_ads.neighbor_id = "";
                this.regions = [];
                this.cities = resp.data;
            });
        },
        
        get_regions() {
            this.filter()
            axios.get("/api/get_regions/" + this.$root.filter_ads.city_id)
                .then((resp) => {
                this.$root.filter_ads.region_id = "";
                this.$root.filter_ads.neighbor_id = "";
                this.neighbors = [];
                this.regions = resp.data;
            });
        },
        get_neighbors() {
            this.filter()
            axios.get("/api/get_neighbors/" + this.$root.filter_ads.region_id)
                .then((resp) => {
                if (resp.data == "") {
                    this.$root.filter_ads.neighbor_id = "";
                }
                this.neighbors = resp.data;
            });
        },
      
        
        get_currencies() {
            axios.get("/api/get_currencies")
                .then((resp) => {
                this.currencies = resp.data;
            });
        },
        get_cats() {
            axios.get("/api/get_categories")
                .then((resp) => {
                this.cats = resp.data;
            });
        },
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            $(document).ready(function() {
            if($('.price-range-slider').length){
		$( ".price-range-slider" ).slider({
			range: true,
			min: 0,
			max: 100000,
			values: [ 0, 100000 ],
			slide: function( event, ui ) {
			$( "input.property-amount" ).val( ui.values[ 0 ] + "," + ui.values[ 1 ] );
			}
		});
		
		$( "input.property-amount" ).val( $( ".price-range-slider" ).slider( "values", 0 ) + "," + $( ".price-range-slider" ).slider( "values", 1 ) );	
	}
    //Area Range Slider
	if($('.area-range-slider').length){
		$( ".area-range-slider" ).slider({
			range: true,
			min: 0,
			max: 7000,
			values: [ 0, 7000 ],
			slide: function( event, ui ) {
			$( "input.area-range" ).val( ui.values[ 0 ] + "," + ui.values[ 1 ] );
			}
		});
		
		$( "input.area-range" ).val( $( ".area-range-slider" ).slider( "values", 0 ) + "," + $( ".area-range-slider" ).slider( "values", 1 ) );	
	}
    if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 1000);
	
		});
	}
        })
        })

    },
    components: { Loading, ImgElement, AdBlock, NoItems, PageTitle }
}
</script>