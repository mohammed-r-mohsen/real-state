<template>
    <ul class="profile-social-list clearfix mb-20">
    <li><a class="phone" @click.prevent="communicate('phone','tel:'+provider.phone)"><i class="ri-phone-line"></i></a></li>
    <li><a class="whatsapp" @click.prevent="communicate('whatsapp','https://wa.me/'+provider.whatsapp+'?text=Hello')" ><i class="ri-whatsapp-line"></i></a></li>
    <li><a class="email" @click.prevent="communicate('email','mailto:'+provider.email)"><i class="ri-mail-line"></i></a></li>
    </ul>
</template>

<script>

    export default{
        mounted(){

        },
        props:['provider'],
        data(){
            return {
                form:new Form({
                    provider_id:'',
                    tool:''
                })
            }
        },
        methods:{
            communicate(tool,href){
                if(this.$root.token){
                    this.form.tool=tool
                    this.form.provider_id=this.provider.id
                    this.form.post('/api/create_communication')
                    .then((resp)=>{
                        //action here
                        window.location.href=href
                    })
                }else{
                    this.$root.login_alert()
                }
            },
            
        }
    }

</script>