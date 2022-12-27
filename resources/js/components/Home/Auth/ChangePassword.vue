<template>
  
    <div class="home-parent">
        <!-- property-page-section -->
        <section class="property-page-section property-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <sidebar :page="'account'"></sidebar>

                    <div class="col-md-9  col-sm-12 content-side">
                        <!-- agent-details -->
                    <div class="myprofile-section" v-if="!$root.loading">
                    <div class="general-information">
                         <h4><i class="ri-lock-line"> </i>{{trans('lang.change_password')}}</h4>
                        <div class="inner-box default-form">
                    </div>
                    <form @submit.prevent="update()">
                        <div class="row">
                            <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="userpassword" class="form-label">{{trans('lang.old_password')}} </label>
                            <input autocomplete="new-password"  type="password" :class="{ 'is-invalid': form.errors.has('old_password') } " v-model="form.old_password" class="form-control" id="userold_password" >
                            <div class="text-danger" v-if="form.errors.has('old_password')" v-html="form.errors.get('old_password')" />
                        </div>
                        <div class="mb-3">
                            <label for="userpassword" class="form-label">New {{trans('lang.password')}} </label>
                            <input autocomplete="new-password"  type="password" :class="{ 'is-invalid': form.errors.has('password') } " v-model="form.password" class="form-control" id="userpassword" >
                            <div class="text-danger" v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="userpassword" class="form-label">{{trans('lang.confirm_password')}} </label>
                            <input autocomplete="new-password" type="password" :class="{ 'is-invalid': form.errors.has('password_confirmation') } " v-model="form.password_confirmation" class="form-control" id="userpassword_confirmation">
                            
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                             <div class="text-danger" v-html="error" />
                            
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button v-if="!loading" class="theme-btn btn-one " type="submit">
                                {{trans('lang.update')}}
                            </button>
                            <button v-else disabled class="theme-btn btn-one " type="submit">
                                <Waiting></Waiting>
                            </button>
                        </div>
                    </div>
                        </div>
                    </form>
                    </div>
                    </div>
                    <div class="agents-block-one" v-else>
                        <Loading :lines="3"></Loading>
                    </div>
        <!-- agent-details end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- property-page-section end -->

    </div>
</template>

    

    

<script>
import Loading from '../Elements/Loading.vue';

    export default {
    mounted() {
        this.$root.check_auth();
        // vue js code
    },
    data() {
        return {
            form: new Form({
                id: "",
                old_password:'',
                password:'',
                confirm_password:'',
            }),
            error:'',
            loading:false
        };
    },
    methods:{
        update(){
            this.loading=true
            this.error=''
            this.form.post('/api/update_my_password')
            .then((resp)=>{
                this.loading=false
                if(resp.data.error){

                    this.error=resp.data.error
                }else{

                    this.$router.push('/home')
                    this.$root.success('password changes successfully !')
                }
                
                }).catch((e)=>{
                    this.loading=false
                })
        }
    },
    components: { Loading }
}
</script>