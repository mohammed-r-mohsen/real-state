<template>
    <div class="general-information">
            <h4><i class="ri-currency-line"></i>{{trans('lang.payment')}}:</h4>
            <payment-section></payment-section>
            
        </div>
</template>


<script>
import PaymentSection from './PaymentSection.vue';

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
            }else if(this.$root.package_id == ''){
                this.$router.push('/add_advertisement/2')
            }
            this.loading=false
                })
        }
    },
    components: { PaymentSection }
}
</script>