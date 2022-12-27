<template>
    <div class="top-details clearfix">
        <h4 class="page_title"> <strong> <router-link to="/"><i class="ri-home-8-line"></i> {{trans('lang.home')}}</router-link></strong>  
        <span v-if="page_subtitle"> 
        <strong >  
        <router-link :to="title_link"> / {{page_title}} </router-link> 
        </strong>
        <span v-if="page_subtitle">/ {{page_subtitle}} </span>  
        </span>
      <span v-else> / {{page_title}} </span>  
        </h4>
    </div>
</template>
<script>

    export default{
        mounted(){

        },
        props:['page_title','title_link','page_subtitle'],
        data(){
            return {

            }
        }
    }

</script>