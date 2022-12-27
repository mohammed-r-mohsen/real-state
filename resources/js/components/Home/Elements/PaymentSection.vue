<template>

            <section class="pricing-section centred">
            <div class="auto-container">
                    <h3> Not Staplished Yet </h3>
               
            </div>

            <div class="row mt-10">
                <div class="col-6">
                    <router-link to="/add_advertisement/2" class="theme-btn btn-two pull-left"> {{trans('lang.back')}} </router-link>
                </div>
                <div class="col-6">
                    <button  @click="buy()" class="theme-btn btn-one pull-right"> {{trans('lang.next')}} </button>
                </div>
            </div>
        </section>

        
                           
</template>

<script>

    export default {
        mounted(){

        },
        data(){
            return {
                packages:[],
                form:new Form({
                    id:''
                })
            }
        },
        methods:{
            buy(){
            this.form.id=this.$root.package_id
            this.form.post('/api/buy_package')
                 .then((resp)=>{
                    toast.fire({
                    icon: 'success',
                    title: this.$root.trans('lang.package_added_successfully'),  ///Toast Notifiblogion
                    })
                    this.$router.push('/add_advertisement/4')
                 }).catch(()=>{
                    toast.fire({
                    icon: 'error',
                    title: 'somesing went wrong!',  ///Toast Notifiblogion
                    })
                 })
        }
        
      
        }
    }
</script>