<template>
    <ul class="tab-btns tab-buttons clearfix">
            <li :class="{'active-btn':this.$route.params.step>=1}">
                  <span>1</span>{{trans('lang.general_information')}}
            </li>
            <li  :class="{'active-btn':this.$route.params.step>=2}" ><span>2</span>{{trans('lang.packages')}}</li>
            <li  :class="{'active-btn':this.$route.params.step>=3}"><span>3</span> {{trans('lang.payment')}} </li>
            <li  :class="{'active-btn':this.$route.params.step>=4}"><span>4</span>{{trans('lang.create_ad')}}</li>
        </ul>
</template>

<script>
export default {
    mounted() {
        
    },
    methods:{
        
    }
}
</script>



