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
                        <div class="sec-title">
                            <h2> {{trans('lang.reser_your_password')}}</h2>
                            <p v-if="!verified"> {{trans('lang.we_send_code')}} </p>
                            <p v-else> {{trans('lang.you_can_change_password')}} </p>
                        </div>
                        <div class="tabs-box">
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        
                                        <form v-if="!verified" method="post" class="default-form" @submit.prevent="verify">
                                          
                                            <div class="form-group">
                                                <label>{{trans('lang.enter_code')}} <strong class="text-danger"> * </strong></label>
                                                <input v-model="form.verification_code" type="tel" inputmode="numeric"  autocomplete="cc-number" maxlength="6" placeholder="xxxxxx">
                                                <div class="text-danger text-left"  v-html="form.errors.errors.error" />
                                                <div class="text-danger text-left"  v-html="form.errors.get('verification_code')" />
                                            </div>
                                            <div class="form-group message-btn">
                                                <button v-if="!loading" type="submit" class="theme-btn btn-one"> {{trans('lang.verify')}} </button>
                                                <button v-else disabled type="submit" class="theme-btn btn-one">
                                                    <Waiting></Waiting>
                                                </button>
                                                <div class="mt-10 text-center"> 
                                                    <a href="javascript:void(0)" @click="forget"> {{trans('lang.send_again')}} </a>
                                                    <p class="text-muted"> {{trans('lang.check_spam')}} </p>
                                                </div>
                                            </div>
                                        </form>
                                        <form v-else method="post" class="default-form" @submit.prevent="change_password">
                                          
                                            <div class="form-group">
                                                <label>{{trans('lang.password')}}<strong class="text-danger"> * </strong></label>
                                                <input autocomplete="new-password"  type="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') } ">
                                                <div class="text-danger text-left"  v-html="form.errors.get('password')" />
                                            </div>
                                            <div class="form-group">
                                                <label>{{trans('lang.confirm_password')}}<strong class="text-danger"> * </strong></label>
                                                <input type="password" v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') } ">
                                              
                                            </div>
                                            <div class="form-group message-btn">
                                                <button v-if="!loading" type="submit" class="theme-btn btn-one">{{trans('lang.submit')}}</button>
                                                <button v-else disabled type="submit" class="theme-btn btn-one">
                                                    <Waiting></Waiting>
                                                </button>
                                            </div>
                                        </form>
                                     
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
import Waiting from '../Elements/Waiting.vue';

    export default {
    mounted() {
        this.check_email()
        this.form.email=localStorage.getItem('email_forgetten_password')
    },
    data() {
        return {
            form: new Form({
                email:'',
                verification_code:'',
                password:'',
                password_confirmation:''
            }),
            loading:false,
            verified:false,
            code_error:''
        };
    },
    methods: {
        verify() {
            this.loading=true
            
            this.form.post("/api/verify_code")
                .then((resp) => {
                this.loading=false
                this.verified=true
                toast.fire({
                    icon: 'success',
                    title: 'you can now change your password.',  ///Toast Notifiblogion
                    })
            }).catch((resp)=>{
                this.loading=false
                
            });
        },
        forget() {
            this.loading=true
            this.form.post("/api/forget_password")
                .then((resp) => {
                this.loading=false
                toast.fire({
                    icon: 'success',
                    title: this.$root.trans('lang.we_send_code'),  ///Toast Notifiblogion
                    })
            }).catch((resp)=>{
                this.loading=false

            });
        },
        change_password() {
            this.loading=true
            this.form.post("/api/change_password")
                .then((resp) => {
                    toast.fire({
                    icon: 'success',
                    title: 'Password changed successfully.',  ///Toast Notifiblogion
                    })
                this.loading=false
                localStorage.removeItem('email_forgetten_password')
                this.$router.push('/login')
            }).catch((resp)=>{
                this.loading=false
            });
        },
        check_email(){
            let email_forgetten_password=localStorage.getItem('email_forgetten_password')
            if(email_forgetten_password!=null){
                
            }else{
                this.$router.push('/forget_password')
            }
        }
    },
    components: { Waiting }
}
</script>