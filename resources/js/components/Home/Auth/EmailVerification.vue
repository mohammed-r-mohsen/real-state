<template>
    <div>
             <!-- ragister-section -->
        <section class="ragister-section centred sec-pad">
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
                    <div class="col-md-5">
                        <div v-if="!$root.loading">
                        <div class="sec-title">
                            <h2> {{trans('lang.email_verification')}}</h2>
                            <p v-if="!verified"> {{trans('lang.we_send_code')}} </p>
                        </div>
                        <div class="tabs-box">
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <form v-if="!verified" method="post" class="default-form" @submit.prevent="verify">
                                          
                                            <div class="form-group">
                                                <label>{{trans('lang.enter_code')}} <strong class="text-danger"> * </strong></label>
                                                <input v-model="form.verification_code" type="tel" inputmode="numeric"  autocomplete="cc-number" maxlength="6"  placeholder="xxxxxx">
                                                <div class="text-danger text-left"  v-html="form.errors.errors.error" />
                                            </div>
                                            <div class="form-group message-btn">
                                                <button v-if="!loading" type="submit" class="theme-btn btn-one"> {{trans('lang.verify')}} </button>
                                                <button v-else disabled type="submit" class="theme-btn btn-one">
                                                    <Waiting></Waiting>
                                                </button>
                                                <div class="mt-10">
                                                <a href="javascript:void(0)" @click="resend"> {{trans('lang.send_again')}} </a>
                                                    <p class="text-muted"> {{trans('lang.check_spam')}} </p>
                                                </div>
                                            </div>
                                        </form>
                                        <div v-else>
                                           <div class="success-box">
                                            <div class="icon-box">
                                                <i class="ri-checkbox-circle-fill"></i>
                                            </div>
                                            <h5> {{trans('lang.well_done')}} </h5>
                                            <p> {{trans('lang.your_email_is_verified')}} </p>
                                            <p> {{trans('lang.redirect_message')}} </p>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="text-center mt-10">
                            <a class="text-muted" href="javascript:void(0)" @click="$root.logout()"> {{trans('lang.use_another_account')}} </a>
                        </div>
                    </div>
                    <div v-else>
                        <loading :lines="6"></loading>
                    </div>
                </div>
                </div>
                
            </div>
        </section>
        <!-- ragister-section end -->
    </div>
</template>

<script>
import Loading from '../Elements/Loading.vue';
import Waiting from '../Elements/Waiting.vue';

    export default {
    mounted() {
        Fire.$on('LoadData',()=>{
            this.check_verified()
        })
    },
    data() {
        return {
            form: new Form({
                verification_code:'',
                email:'',
            }),
            loading:false,
            verified:false,
            code_error:''
        };
    },
    methods: {
        verify() {
            this.loading=true
            this.form.email=this.$root.user.email
            this.form.post("/api/check_email_verification_code")
                .then((resp) => {
                this.loading=false
                this.verified=true
                toast.fire({
                    icon: 'success',
                    title: 'you can now change your password.',  ///Toast Notifiblogion
                    })
                    localStorage.setItem('email_verified_at',resp.data)
                    setTimeout(() => {
                        this.$router.push('/home')
                    }, 2000);
            }).catch((resp)=>{
                this.loading=false
                
            });
        },
        resend(){
            this.form.email=this.$root.user.email
            this.loading=true
                this.form.post("/api/send_verification_link").then((resp) => {
                    this.loading=false
                    toast.fire({
                    icon: 'success',
                    title: this.$root.trans('lang.we_send_code'),  ///Toast Notifiblogion
                    })
                }).catch(()=>{
                    this.loading=false
                })
        },
        check_verified(){
                if(localStorage.getItem('email_verified_at')){
                    this.verified=true
                    setTimeout(() => {
                        this.$router.push('/home')
                    }, 4000);
                }  
        }
    },
    components: { Waiting, Loading }
}
</script>