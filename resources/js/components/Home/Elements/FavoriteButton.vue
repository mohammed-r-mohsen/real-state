<template>
    <li><button @click="toggle(ad)" :class="{'checked':this.checked}" href="javascript:void(0)"><i class="ri-heart-line"></i></button></li>
</template>
<script>

    export default{
        mounted(){
            this.check_favorite()
        },
        props:['ad'],
        data(){
            return {
                checked:false
            }
        },
        methods:{
            toggle(ad){
                if(this.$root.user){
                    if(this.checked){
                        this.checked=false
                        axios.post('/api/remove_favorite/'+this.ad.id)
                             .then((resp)=>{
                                Fire.$emit('LoadFavorites')
                             })
                    }else{
                        this.checked=true
                        axios.post('/api/add_favorite/'+this.ad.id)
                             .then((resp)=>{
                                Fire.$emit('LoadFavorites')
                             })
                    }
                }else{
                    this.$root.swal_push('Login Alert','You should login to your account before this action',
                    'Login','/login')
                }
            },
            check_favorite(){
                if(this.$root.token){
                    axios.get('/api/check_favorite/'+this.ad.id)
                    .then((resp)=>{
                        this.checked= resp.data
                    })
                }else{
                    this.checked=false
                }
            }
            
        }
    }

</script>