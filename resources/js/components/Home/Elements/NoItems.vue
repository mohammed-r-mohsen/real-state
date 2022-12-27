<template>
    <!-- error-section -->
        <section class="error-section centred">
            <div class="auto-container">
                <div class="inner-box" v-if="link==undefined && btn_name==undefined">
                    <h2> {{trans('lang.no_items')}}</h2>
                    <button @click="$router.go(-1)" class="theme-btn btn-one">{{trans('lang.back')}}</button>
                </div>
                <div class="inner-box" v-else>
                    <h2> {{trans('lang.no_items')}}</h2>
                    <button @click="$router.push(link)" class="theme-btn btn-one">{{btn_name}}</button>
                </div>
            </div>
        </section>
</template>

<script>
export default {
    mounted() {
        
    },
    props:['link','btn_name'],
    methods:{
        logout(){
            
        }
    }
}
</script>



