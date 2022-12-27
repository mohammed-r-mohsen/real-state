<template>
     <div>
         <!--  Modal -->
          <div class="modal fade" id="modalID" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel"> Privacy Policy </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <div v-html="page.item_privacy"></div>
                          
                      </div>
                      <div class="modal-footer">
                        <button @click="check()" class="theme-btn btn-one" data-dismiss="modal" for="privacy-check"> Agree to privacy policy  </button>
                      </div>
                  </div>
                  <!--end modal-content-->
              </div>
              <!--end modal-dialog-->
          </div>
          <!--end modal-->


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
                                        <h4>Years of <br />Experience</h4>
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
                                        <h3 class="text-center mb-4">{{trans('lang.sign_up')}} </h3>
                                        <form method="post" class="default-form" @submit.prevent="register">
                                            <div class="row">
                                            <div class="form-group col-12">
                                                <label>{{trans('lang.name')}}  <strong class="text-danger"> * </strong></label>
                                                <input type="text" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') } ">
                                                <div class="text-danger text-left"  v-html="form.errors.get('name')" />
                                            </div>
                                            <div class="form-group col-12">
                                                <label>{{trans('lang.phone')}}  <strong class="text-danger"> * </strong></label>
                                                <v-select class="inline-input code"  required v-model="form.phone_code" :options="countries" :reduce="country => country.phone_code">
                                                <template slot="option" slot-scope="option">
                                                    <span :class="option.icon"></span>
                                                    {{ option.country_code }} ({{option.phone_code}})
                                                </template>
                                                <template slot="selected-option" slot-scope="option">
                                                    <span :class="option.icon"></span>
                                                    {{ option.country_code }} ({{option.phone_code}})
                                                </template>    
                                                 </v-select>
                                                <input class="inline-input" type="number" min="0" v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') } ">
                                                <div class="text-danger text-left"  v-html="form.errors.get('phone')" />
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label>{{trans('lang.email')}}  <strong class="text-danger"> * </strong></label>
                                                <input autocomplete="new-password" type="text" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') } ">
                                                <div class="text-danger text-left"  v-html="form.errors.get('email')" />
                                            </div>
                                            <div class="form-group">
                                                <label>{{trans('lang.city')}} <strong class="text-danger"> * </strong></label>
                                            <v-select v-model="form.state_id" :options="states" :reduce="state => state.id" label="lang_name"></v-select>
                                                <div class="text-danger text-left"  v-html="form.errors.get('state_id')" />
                                            </div>
                                            <div class="form-group">
                                                <label>{{trans('lang.password')}} <strong class="text-danger"> * </strong></label>
                                                <input autocomplete="new-password"  type="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') } ">
                                                <div class="text-danger text-left"  v-html="form.errors.get('password')" />
                                            </div>
                                            <div class="form-group">
                                                <label> {{trans('lang.confirm_password')}}  <strong class="text-danger"> * </strong></label>
                                                <input type="password" v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') } ">
                                              
                                            </div>
                                            <div class="form-group text-left">
                                            
                                                <div class="form-check">
                                                    <input v-model="form.is_provider" class="form-check-input" type="checkbox" name="is_provider"  id="is-prvider">
                                                    <label class="form-check-label" for="is-prvider"> {{trans('lang.are_you_provider')}}  </label>
                                                </div>
                                                <div class="form-check">
                                                    <input  required  class="form-check-input" type="checkbox" :checked="checked" id="privacy-check">
                                                    <label class="form-check-label"
                                                    data-toggle="modal" data-target="#modalID"> {{trans('lang.agree_to_privacy')}}    </label>
                                                </div>
                                                
                                                </div>
                                            <div class="form-group message-btn">
                                                <button v-if="!$root.loading"  class="theme-btn btn-one" type="submit">
                                                    {{trans('lang.sign_up')}}
                                                </button>
                                                <button v-else disabled class="theme-btn btn-one" type="submit">
                                                    <Waiting></Waiting>
                                                </button>
                                               
                                            </div>
                                        </form>

                                        <div class="othre-text">
                                            <p>{{trans('lang.already_have_account')}}  <router-link to="/login">{{trans('lang.login')}} </router-link></p>
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
            this.get_countries()
            this.get_states()
            this.get_pages()
        },
        data(){
            return {
                form :new Form({
                    name:'',
                    phone:'',
                    email:'',
                    is_provider:false,
                    password:'',
                    password_confirmation:'',
                    device_name:'browser',
                    phone_code:'',
                    state_id:'',
                }),
                states:[],
                page:'',
                checked:false,
                countries:[],
                test:''
            }
        },
        methods:{
            get_countries(){
                axios.get('/api/get_countries')
                     .then((resp)=>{
                        this.countries=resp.data
                        if(resp.data.length>0){
                            this.form.phone_code=resp.data[0].phone_code
                        }
                     })
            },
            register(){
                this.$root.loading=true
                this.form.post('/api/register')
                      .then((resp)=>{
                        
                            this.login()
                            
                            // setTimeout(() => {
                            //     this.$router.push('/login')
                            // }, 1000);
                      }).catch(()=>{
                        this.$root.loading=false
                      })
            },
            login(){
                this.form.post('/api/login')
                      .then((resp)=>{
                        toast.fire({
                            icon: 'success',
                            title: this.$root.trans('lang.account_created_successfuly'),  ///Toast Notifiblogion
                            })
                        this.$root.loading=false
                        localStorage.setItem('token',resp.data.token)
                        this.$root.token=resp.data.token
                        this.$root.user=resp.data
                        this.$router.push('/home')
                            
                      })
            
            },
            get_pages(){
            axios.get('/api/get_pages_content')
                 .then((resp)=>{
                    this.page=resp.data
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
            check(){
                this.checked=true
            },
            get_states(){
                axios.get('/api/get_states')
                     .then((resp)=>{
                        this.states=resp.data
                     })
            },
            
        }
    }
</script>