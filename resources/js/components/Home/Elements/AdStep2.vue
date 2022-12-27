<template>
    <div class="general-information" v-if="!loading">
            <h4><i class="ri-discuss-line"></i>{{trans('lang.select_package')}}:</h4>
            <select-package></select-package>
            
        </div>
        <div v-else>
            <loading :lines="4">  </loading>
        </div>
</template>


<script>
import SelectPackage from './SelectPackage.vue';
import Loading from './Loading.vue';

export default {
    mounted() {
        this.handle_routes()
    },
    data() {
        return {
            loading:false
        };
    },
    methods: {
    handle_routes(){
        this.loading=true
        axios.defaults.headers.common["Authorization"]='Bearer '+ this.$root.token;
        axios.get('/api/check_user_package')
        .then((resp)=>{
            if(resp.data){
                this.$router.push('/add_advertisement/4')
            }
            this.loading=false
                })
        }
    },
    components: { SelectPackage, Loading }
}
</script>