<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
                  <!--Page Title-->
        <section class="page-title centred" style="background-image: url(/assets2/images/background/page-title-4.jpg);">
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{trans('lang.faqs_title')}}</h1>
                    <ul class="bread-crumb clearfix">
                        <li><router-link to="/">{{trans('lang.home')}}</router-link></li>
                        <li>{{trans('lang.faqs_title')}}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- faq-page-section -->
        <section class="faq-page-section sec-pad">
            <div class="auto-container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                        <div class="faq-content-side">
                            <div class="sec-title">
                                <h5>{{trans('lang.faqs')}}</h5>
                                <h2>{{trans('lang.faqs_title')}}.</h2>
                                
                            </div>
                            <ul class="accordion-box" v-if="faqs.length>0 && !loading">
                                <li class="accordion block" :class="{'active-block':index==0}" v-for="faq,index in faqs" :key="index">
                                    <div class="acc-btn" :class="{'active':index==0}">
                                        <div class="icon-outer"><i class="ri-arrow-down-line"></i></div>
                                        <h5>{{faq.item_question}}</h5>
                                    </div>
                                    <div class="acc-content" :class="{'current':index==0}">
                                        <div class="content-box">
                                            <div v-html="faq.item_answer"></div>
                                        </div>
                                    </div>
                                </li>
                               
                            </ul>
                            <ul class="accordion-box" v-if="loading">
                                <loading :lines="3"></loading>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- faq-page-section end -->

        <page-footer></page-footer>
        </div>
    
</template>

    

    

<script>
import Loading from './Elements/Loading.vue';
import ImgElement from './Elements/ImgElement.vue';
import PageTitle from './Elements/PageTitle.vue';
import PageFooter from './Elements/PageFooter.vue';

    export default {
    mounted() {
        this.get_faqs()
        
    },
    data() {
        return {
            form: new Form({
                id: "",
            }),
            loading:false,
            faqs:[]
        };
    },
    methods: {
        get_faqs(){
            this.loading=true
            axios.get('/api/get_faqs')
                 .then((resp)=>{
                    this.faqs=resp.data
                    this.loading=false
                 })
        }
    },
    components: { Loading, ImgElement, PageTitle, PageFooter },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            //Accordion Box
	if($('.accordion-box').length){
		$(".accordion-box").on('click', '.acc-btn', function() {
			
			var outerBox = $(this).parents('.accordion-box');
			var target = $(this).parents('.accordion');
			
			if($(this).hasClass('active')!==true){
				$(outerBox).find('.accordion .acc-btn').removeClass('active');
			}
			
			if ($(this).next('.acc-content').is(':visible')){
				return false;
			}else{
				$(this).addClass('active');
				$(outerBox).children('.accordion').removeClass('active-block');
				$(outerBox).find('.accordion').children('.acc-content').slideUp(300);
				target.addClass('active-block');
				$(this).next('.acc-content').slideDown(300);	
			}
		});	
	}
        })
    }
}
</script>


