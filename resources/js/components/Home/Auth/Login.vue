<template>
    <div>
             <!-- ragister-section -->
        <section class="ragister-section centred  mt-20">
            <div class="auto-container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="image_block_2 login">
                                <div class="image-box">
                                    <figure class="image"><img src="/assets2/images/login-bg.jpg" alt=""></figure>
                                    <div class="text wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <h2>20</h2>
                                        <h4>{{trans('lang.years_of')}} <br />{{trans('lang.experience')}}</h4>
                                    </div>
                                </div>
                            </div>
                        <!-- <img src="/assets2/images/news/news-21.jpg" style="height:100%"> -->
                    </div>
                    <!-- <div class="col-md-1"></div> -->
                    <div class="col-md-5">
                        <div class="sec-title">
                        </div>
                        <div class="tabs-box">
                            
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <h3 class="text-center  mb-4">{{trans('lang.login')}}</h3>
                                        <form method="post" class="default-form" @submit.prevent="login">
                                          
                                            <div class="form-group">
                                                <label> {{trans('lang.email_or_phone')}} <strong class="text-danger"> * </strong></label>
                                                <input  type="text" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') } ">
                                                <div class="text-danger text-left"  v-html="form.errors.get('email')" />
                                            </div>
                                            <div class="form-group">
                                                <label>{{trans('lang.password')}}<strong class="text-danger"> * </strong></label>
                                                <input   type="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') } ">
                                                <div class="text-danger text-left"  v-html="form.errors.get('password')" />
                                            </div>
                                            <div class="form-group row">
                                            <div class="form-check text-left col-6">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">{{trans('lang.remember_me')}}</label>
                                            </div>
                                            <div class="form-check text-right col-6">
                                             <router-link to="/forget_password">{{trans('lang.forget_password')}}</router-link>
                                            </div>
                                            </div>
                                           
                                            <div class="form-group message-btn">
                                                <button v-if="!$root.loading"  class="theme-btn btn-one" type="submit">
                                                    {{trans('lang.login')}}
                                                </button>
                                                <button v-else disabled class="theme-btn btn-one" type="submit">
                                                    <Waiting></Waiting>
                                                </button>
                                            </div>
                                        </form>
                                        <div class="othre-text">
                                            <p>{{trans('lang.dont_have_account')}} <router-link to="/register">{{trans('lang.sign_up')}}</router-link></p>
                                        </div>
                                        <div class="social-widget">
                                        <ul class="social-links login clearfix">
                                            <li><a @click="loginFacebook" href="javascript:void(0)"><i class="ri-facebook-line"></i></a></li>
                                            <li><a @click="loginGoogle" href="javascript:void(0)"><i class="ri-google-line"></i></a></li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ragister-section end -->


        


    </div>
</template>


<script>

    export default {
        mounted(){
            
        },
        data(){
            return {
                form :new Form({
                    email:'',
                    password:'',
                    device_name:'browser',
                }),
                
            }
        },
        methods:{
            login(){
                this.$root.loading=true
                this.form.post('/api/login')
                      .then((resp)=>{
                        localStorage.setItem('token',resp.data.token)
                        if(resp.data.email_verified_at!=null){
                            localStorage.setItem('email_verified_at',resp.data.email_verified_at)
                        }
                        this.$root.token=resp.data.token
                        this.$root.user=resp.data
                        let redirect=this.$route.query.redirect
                        this.$root.loading=false
                        if(redirect!=null){
                            this.$router.push(redirect)
                        }else{
                            this.$router.push('/home')
                        }
                            
                      }).catch(()=>{
                        this.$root.loading=false
                      })
            },
            loginGoogle(){
                axios.get('/api/login/google')
                     .then((resp)=>{
                        if(resp.data){
                            window.location.href=resp.data
                        }
                     })
            },
            loginFacebook(){
                axios.get('/api/login/facebook')
                     .then((resp)=>{
                        if(resp.data){
                            window.location.href=resp.data
                        }
                     })
            },
            
        }
    }
</script>