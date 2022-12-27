<template>
    <div class="pricing-block-one animated"  style="visibility: visible; animation-duration: 1000ms; animation-delay: 0ms; animation-name: fadeInUp;">
            <div class="pricing-table">
                <div class="table-header">
                    <div class="shape-1" style="background-image: url(/assets2/images/shape/shape-4.png);"></div>
                    <div class="shape-2" style="background-image: url(/assets2/images/shape/shape-5.png);"></div>
                    <h4>{{pack.lang_name}}</h4>
                    <h2> {{pack.price}} <span class="currency">{{pack.currency}} 
                            <span v-if="pack.period!=1"> / {{pack.period}} {{trans('lang.mo')}} </span>  
                            <span v-else> /  {{trans('lang.mo')}} </span>  
                            </span>
                    </h2>
                </div>
                <div class="table-content" v-html="pack.lang_features">
                    
                </div>
                <div class="table-footer">
                    <a @click.prevent="buy(pack.id)" class="link-btn">{{trans('lang.buy_now')}}</a>
                </div>
            </div>
        </div>
</template>

<script>
export default{
    props:['pack'],
    mounted(){

    },
    data(){
        return {
            form :new Form({
                    id:'',
                    ads_number:12
                }),
        }
    },
    methods:{
        buy(id){
            this.form.id=id
            if(!this.$root.user){
                // swal fire pushing
                this.$root.swal_push('Login Alert','Your should login to your account befour adding package!',
                'Login','/login')
            }else{

           
            if(this.$root.user_package){
                
                swal.fire({
                title:this.$root.trans('lang.package_change_warning'),
                text:this.$root.trans('lang.package_will_not_available'),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText:'Continue',
            }).then((result) => {
                if (result.value) {
                    this.confirm()
                }
            });
            
            }else{
                this.confirm()
            }
             
             }
        },
        confirm(){
            this.form.post('/api/buy_package')
                 .then((resp)=>{
                    this.$router.push('/my_packages') 
                    swal.fire({
                title:this.$root.trans('lang.package_added_successfully'),
                text:this.$root.trans('lang.can_create_ad'),
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText:this.$root.trans('lang.create_ad'),
            }).then((result) => {
                if (result.value) {
                    this.$router.push('/add_advertisement/1')         
                }
            });
                    
                 }).catch(()=>{
                    toast.fire({
                    icon: 'error',
                    title:this.$root.trans('lang.somethisg_wrong') ,  ///Toast Notifiblogion
                    })
                 })
        },
    }
}
</script>