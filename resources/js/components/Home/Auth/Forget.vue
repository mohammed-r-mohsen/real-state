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
                            <h2>{{trans('lang.send_reset_password')}}</h2>
                        </div>
                        <div class="tabs-box">
                            
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        
                                        <form method="post" class="default-form" @submit.prevent="forget">
                                          
                                            <div class="form-group">
                                                <label>{{trans('lang.email')}}<strong class="text-danger"> * </strong></label>
                                                <input  type="text" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') } ">
                                                <div class="text-danger text-left"  v-html="form.errors.get('email')" />
                                                <div class="text-danger text-left"  v-html="form.errors.errors.error" />
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
    },
    data() {
        return {
            form: new Form({
                email: "",
            }),
            loading:false
        };
    },
    methods: {
        forget() {
            this.loading=true
            this.form.post("/api/forget_password")
                .then((resp) => {
                localStorage.setItem('email_forgetten_password',this.form.email)
                this.$router.push('/reset_password')
                this.loading=false
            }).catch((resp)=>{
                this.loading=false

            });
        }
    },
    components: { Waiting }
}
</script>