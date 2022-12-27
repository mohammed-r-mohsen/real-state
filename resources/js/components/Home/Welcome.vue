<template>
    <div>
        
        <!-- banner-style-two -->
        <banner-section></banner-section>
        <!-- banner-style-two end -->

        <top-filter></top-filter>


        <!-- category-section -->    
        <categories-section></categories-section>
        <!-- category-section-end -->

        <!-- Recent-Ad-section -->    
        <recent-section></recent-section>
        <!-- Recent-Ad-section-end -->


        <!-- category-section -->    
        <packages-container></packages-container>
        <!-- category-section-end -->
		<how-it-work></how-it-work>
		<categories-with-ads></categories-with-ads>
		
		<welcome-providers></welcome-providers>
		<page-footer></page-footer>
	</div>
</template>

<script>
import jQuery from "jquery";
import BannerSection from './Elements/BannerSection.vue';
import TopFilter from "./Elements/TopFilter.vue";
import PackagesContainer from "./Elements/PackagesContainer.vue";
import RecentSection from "./Elements/RecentSection.vue";
import CategoriesWithAds from './Elements/CategoriesWithAds.vue';
import WelcomeProviders from './WelcomeProviders.vue';
import PageFooter from './Elements/PageFooter.vue';
import HowItWork from './Elements/HowItWork.vue';
global.jQuery=jQuery
global.$=jQuery
    export default {
  components: { BannerSection, TopFilter, PackagesContainer, RecentSection,CategoriesWithAds, WelcomeProviders, PageFooter, HowItWork },
       
  
  mounted(){
			
   
         },
        beforeRouteEnter(to, from, next) {
        next(vm => {
			
            if($('.tabs-box').length){
		$('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));
			
			if ($(target).is(':visible')){
				return false;
			}else{
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(300);
				$(target).addClass('active-tab');
			}
		});
	}
            if ($(".switch_btn_one").length) {
	    $(".search__toggler").on("click", function(){
	    	$(".search-field .switch_btn_one").toggleClass("active");
	    })     
	    $(".switch_btn_one .close-btn").on("click", function(){
	    	$(".search-field .switch_btn_one").removeClass("active");
	    }) 
    }
	
        })
},
        data(){
            return {

            }
        }
    }
</script>