<template>
    <div>
             <!-- ragister-section -->
        <section class="ragister-section centred sec-pad">
           please wait ....
        </section>
        <!-- ragister-section end -->
    </div>
</template>

<script>

    export default {
        mounted(){
            this.request_login()
        },
        data(){
            return {
                form :new Form({
                    email:'',
                    password:'',
                    device_name:'browser',
                })
            }
        },
        methods:{
            login(){
                this.form.post('/api/login')
                      .then((resp)=>{
                        localStorage.setItem('token',resp.data)
                        this.$root.token=resp.data
                        this.$router.push('/home')
                            
                      })
            },
            request_login(){
                axios.get('/api/facebook/callback?code='+this.$route.query.code)
                     .then((resp)=>{
                        localStorage.setItem('token',resp.data)
                        this.$root.token=resp.data
                        this.$router.push('/home')
                     })
            }
        }
    }
</script>